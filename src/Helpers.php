<?php


function formatQuery(array $params) {
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

function media($marque, $identify, $image) {
    return sprintf("%s/%s/%s/%s", UPLOADED_PATH, $marque, $identify, $image);
}

function layout($route) {
    if (strpos($route, 'user')) {
        $layout = "user";
    } else {
        $layout = "layout";
    }

    return sprintf("%s.php", $layout);
}



function generateToken($length = 25) {
    $alphabet = '0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN';
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}


function formatQueryInsert(array $field) {
    return implode(', ', array_map(function ($key) {
        return sprintf("%s = :%s", $key, $key);
    }, $field));
}

function hashPass($pass) {
    return password_hash($pass, PASSWORD_BCRYPT);
}


function redirect($path): void
{
    header("Location: $path", false, 301);
    exit();
}

function verifyPassword($pass, $hash) {
    return password_verify($pass, $hash);
}

function onSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function setSession($key, $value) {
    onSession();
    $_SESSION[$key] = $value;
}

function getSession($key) {
    onSession();
    if (hasSession($key)) {
        return $_SESSION[$key];
    }

    return null;
}

function hasSession($key) {
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
        redirect($redirect);
    }
}



/**
 * Permet de formater une date
 *
 * @param string $date
 * @param string $format
 * @return string
 */
function dateFormat(string $date, string $format = 'd-m-Y à H:i:s'): string {
    return (new DateTime($date))->format($format);
}

function sendMail(string $recipient, string $subject, string $message, $sender = "labeyadev@gmail.com") {
    $headers = [
        "Content-Type: text/html;charset=utf-8",
        "From: $sender"
    ];
    return mail($recipient, $subject, $message, implode("\r\n", $headers));
}

