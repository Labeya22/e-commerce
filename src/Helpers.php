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
 * Permet de générer un lien 
 *
 * @param string $title
 * @param string|null $link
 * @return string|null
 */
function li(string $title, ?string $link = null) {

    if (is_null($link)) return null;

    if ($link === $_SERVER['REQUEST_URI']) {
        return "<li class=\"nav-item\"><a href=\"$link\" class=\"nav-link active\">$title</a></li>";
    }

    return "<li class=\"nav-item\"><a href=\"$link\" class=\"nav-link \">$title</a></li>";
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
 * Pagine les résultats en page (1, 2, 3, etc.)
 *
 * @param array $options
 * @return string|null
 */
function pagination(array $options): ?string {
    $pages = $options['pages'] ?? 0;
    $page = $options['page'] ?? 1;
    
    if (is_string($page) && empty($page)) {
        $page = 1;
    }
    $limit = 5;

    if ($pages <= 1) {
        return null;
    }

    $li = "";
    for ($start = ($page - $limit); $start  <= $page - 1; $start++) {
        if ($start > 0) {
            $route = queryParams('page', $start);
            $li .= "<li><a href=\"{$route}\">{$start}</a></li>";
        }
    }

    $route = queryParams('page', $page);

    $li .= "<li><a href=\"{$route} \" class=\"active\">{$page}</a></li>";

    for ($end = $page + 1; $end  < ($page + $limit); $end++) {
        if ($end <= $pages) {
            $route = queryParams('page', $end);
            $li .= "<li><a href=\"{$route}\">{$end}</a></li>";
        }
    }


    $prevContent = null;
    $nextContent = null;
    if ($page < $pages) {
        $next = queryParams('page', ($page + 1));
        $nextContent = "<a href=\"{$next}\" class=\"prev\">&raquo;</a>";
    }

    if ($page > 1) {
        $prev = queryParams('page', ($page - 1));
        $prevContent = "<a href=\"{$prev}\" class=\"prev\">&laquo;</a>";
    }

    return "
    <ul>
        {$prevContent}
        {$li}
        {$nextContent}
    </ul>";
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


function createToastError(array $toasts) {
    if (empty($toasts)) return  null;

    $toast = "";

    foreach (array_values($toasts) as $error) {
        $toast .= "
        <li class=\"toast danger\">
            <div class=\"content\">
                <span class=\"fa-solid fa-circle-xmark icon-type\"></span>
                <span class=\"text\">
                $error
                </span>
            </div>
            <span class=\"fa-solid fa-xmark toast-close\"></span>
        </li>
        ";
    }

    return "
    <ul class=\"toasts\"> $toast </ul>
    ";
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

function getSession($key, $value) {
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