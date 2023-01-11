<?php



function getFlashType($key) {
    onSession();
    return $_SESSION[SESSION_FLASH][$key] ?? null;
}

function setFlash(string $type, string $message, string $destination) {
    onSession();
    $_SESSION[SESSION_FLASH] = [
        $type => $message, 
        'dest' => $destination
    ];
}


function getFlash() {
    onSession();
    if (hasSession(SESSION_FLASH)) {
        $flash = $_SESSION[SESSION_FLASH];
        deleteSession(SESSION_FLASH);
        return $flash;
    }

    return null;
}


function flash() {
 
    $flash = getFlash();
    $uri = $_SERVER['REQUEST_URI'];


    if (is_null($flash)) return $flash;
    
    $success = $flash['success'] ?? null;
    $danger = $flash['danger'] ?? null;
    $warning = $flash['warning'] ?? null;
    $destination = $flash['dest'] ?? null;

    $toast = null;

    if ($uri == $destination && !is_null($success)) {
        $toast = success($success);
    } elseif ($uri == $destination && !is_null($danger)) {
        $toast = danger($danger);
    } elseif ($uri == $destination && !is_null($warning)) {
        $toast = warning($warning);
    }
    
    if (is_null($toast)) return $toast;

    return "<ul class=\"toasts\"> $toast </ul>";
}


function success($message) {
    return "<li class=\"toast success\" id=\"toast-generate\" deleteTime=\"10000\"  duration=\"10s\">
    <div class=\"content\">
        <span class=\"fa-solid fa-circle-check icon-type\"></span>
        <span class=\"text\">
            <strong> succès :</strong> $message
        </span>
    </div>
    <span class=\"fa-solid fa-xmark toast-close\"></span>
</li>";
}


function danger($message): string {
    return "<li class=\"toast danger\" id=\"toast-generate\" deleteTime=\"10000\" duration=\"10s\">
        <div class=\"content\">
            <span class=\"fa-solid fa-circle-xmark icon-type\"></span>
            <span class=\"text\">
                <strong> Erreur :</strong> $message
            </span>
        </div>
        <span class=\"fa-solid fa-xmark toast-close\"></span>
    </li>";
}


function warning($message): string {
    return "<li class=\"toast warning\" id=\"toast-generate\" deleteTime=\"10000\" duration=\"10s\">
        <div class=\"content\">
            <span class=\"fa-solid fa-triangle-exclamation icon-type\"></span>
            <span class=\"text\">
                <strong> avertissement :</strong> $message
            </span>
        </div>
        <span class=\"fa-solid fa-xmark toast-close\"></span>
    </li>";
}

function linkOption(
    ?string $link = null, 
    string $icon = '', 
    array $attribute = [], 
    string $class = ''): ?string {
    
    if (is_null($link)) return null;

    $attributes = empty($attribute) ? '' : arrayToString($attribute);

    if ($link === $_SERVER['REQUEST_URI']) {
        return "<a href=\"$link\" class=\"link-option $class active\" $attributes><i class=\"$icon\"></i></a>";
    }

    return "<a href=\"$link\" class=\"link-option $class\" $attributes><i class=\"$icon\"></i></a>";
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


function star(int $star) {
    $li = "";
    for ($index = 1; $index <= 5; $index++) {
        $li .=  $index <= $star 
        ? "<li class=\"is\"><i class=\"fa fa-star\"></i></li>"
        : "<li><i class=\"fa fa-star\"></i></li>";
    }
    return "<div class=\"stars\"><ul> $li </ul></div>";
}