<?php

/**
 *
 * @param array $params
 * @return string
 */
function formatQuery(array $params): string {
    if (empty($params)) return "";
    return sprintf('?%s', http_build_query($params));
}

function generate(string $name, array $params = []): ?string {
    return 
        !isset(ROUTES[$name]) ? null 
        :  sprintf('%s%s', ROUTES[$name], formatQuery($params));
}

/**
 *
 * @param string $route
 * @param string $key
 * @param string $value
 * @return string
 */
function urlGenerate(string $route, string $key, string $value): string {
    return sprintf("%s%s", $route, queryParams($key, $value));
}

/**
 * vérifie si un key existe dans le params
 *
 * @param [type] $key
 * @return boolean
 */
function hasQueryParams($key) {
    return isset($_GET[$key]) && !empty($_GET[$key]);
}

/**
 * créer un params 
 *
 * @param string $key
 * @param mixed $value
 * @return void
 */
function queryParams(string $key, mixed $value) {
    $query = http_build_query(array_merge($_GET, [$key => $value]));
    if ($query[0] === '?') return $query;
    return '?' . $query;
}

/**
 * rcupère la valeur du params en int
 *
 * @param string $key
 * @return integer|null
 */
function getQueryParamsInteger(string $key): ?int {
    if (!isset($_GET[$key])) return null;
    return (int)$_GET[$key];
}

/**
 * rcupère la valeur du params en string
 *
 * @param string $key
 * @return string|null
 */
function getQueryParamsString(string $key): ?string {
    if (!isset($_GET[$key])) return null;
    return $_GET[$key];
}


/**
 * permet de donnée le chemin d'un fichier à inclure
 *
 * @param string $path
 * @return string
 */
function inc(string $path): string {
    return sprintf("%s/%s", VIEW_PATH, $path);
}

/**
 *
 * @param string $marque
 * @param mixed $identify
 * @param string $image
 * @return string
 */
function media(string $marque, mixed $identify, string $image): string {
    return sprintf("%s/%s/%s/%s", UPLOADED_PATH, $marque, $identify, $image);
}

/**
 *
 * @param string $route
 * @return string
 */
function layout(string $route): string {

    if (strpos($route, '@user/') !== false) {
        $layout = "user.php";
    } elseif (strpos($route, '/@facture/') !== false) {
        $layout = "facture.php";
    } elseif (strpos($route, '/@admin/') !== false) {
        $layout = "admin.php";
    } else {
        $layout = "layout.php";
    }

    return $layout;
}


/**
 *
 * @param integer $length
 * @return string
 */
function generateToken(int $length = 25): string {
    $alphabet = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

/**
 *
 * @param array $field
 * @return string
 */
function formatQueryInsert(array $field): string {
    return implode(', ', array_map(function ($key) {
        return sprintf("%s = :%s", $key, $key);
    }, $field));
}

/**
 *
 * @param string $pass
 * @return string
 */
function hashPass(string $pass): string {
    return password_hash($pass, PASSWORD_BCRYPT);
}

/**
 *
 * @param string $path
 * @return void
 */
function redirect(string $path): void {
    header("Location: $path", false, 301);
    exit();
}

/**
 *
 * @param string $pass
 * @param string $hash
 * @return boolean
 */
function verifyPassword(string $pass, string $hash): bool {
    return password_verify($pass, $hash);
}

/**
 *
 * @return void
 */
function onSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 *
 * @param string $key
 * @param mixed $value
 * @return void
 */
function setSession(string $key, mixed $value): void {
    onSession();
    $_SESSION[$key] = $value;
}

/**
 *
 * @param string  $key
 * @return mixed
 */
function getSession(string $key): mixed {
    onSession();
    if (hasSession($key)) {
        return $_SESSION[$key];
    }

    return null;
}

/**
 *
 * @param string $key
 * @return boolean
 */
function hasSession(string $key): bool {
    onSession();
    return isset($_SESSION[$key]);
}

/**
 * Permet de supprimer la session
 *
 * @param string $key
 * @return void
 */
function deleteSession(string $key) {
    onSession();
    if (hasSession($key)) {
        unset($_SESSION[$key]);
    }
}

/**
 * Permet de vérifié si l'utilisateur est connecté
 * 
 * @param string $redirect
 * 
 * @return void
 */
function checkUser(string $redirect): void {
    //  on vérifie que l'utilisateur est enregistré dans la session.
    if (!hasSession(SESSION_USER)) {
        // on fait une redirection (header location)
        denied($redirect);
    } else {
        $pdo = getPDO();
        $userSession = getSession(SESSION_USER);
        $user = getUser($pdo, 'utilisateur_id', $userSession['utilisateur_id']);
        if (is_null($user) || empty($user)) {
            deleteSession(SESSION_USER);
            denied($redirect);
        } 
    }
}


/**
 * @param string $redirect
 * 
 * @return void
 */
function denied(string $redirect): void {
    setFlash('danger', "accès refusé", $redirect);
    redirect($redirect);
}


/**
 * Permet de formater une date
 *
 * @param string $date
 * @param string $format
 * @return string
 */
function dateFormat(string $date, string $format = 'd-m-Y à H:i'): string {
    return (new DateTime($date))->format($format);
}

/**
 * Envoi d'email
 *
 * @param string $recipient
 * @param string $subject
 * @param string $message
 * @param string $sender
 * @return bool
 */
function sendMail(string $recipient, string $subject, string $message, $sender = "labeyadev@gmail.com") {
    $headers = [
        "Content-Type: text/html;charset=utf-8",
        "From: $sender"
    ];
    return mail($recipient, $subject, $message, implode("\r\n", $headers));
}



/**
 *
 * @param PDO $pdo
 * @return void
 */
function isConnected() {
    if (hasSession(SESSION_USER)) {
        redirect(generate('store'));
    }
}


/**
 * @param string $string
 * @param int $limit
 * 
 * @return string
 */
function exercept(string $string, int $limit = 50): string {
    if (strlen($string) <= $limit) return $string;
    return substr($string, 0, $limit) . '...';
}