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
    return "<li class=\"toast\" id=\"toast-generate\" deleteTime=\"10000\"  duration=\"10s\">
        <p class=\"toast-message\">
            <i class=\"fa fa-check-circle toast-success toast-icon\"></i>
            {$message}
        </p>
    </li>";
}


function danger($message): string {
    return "<li class=\"toast\" id=\"toast-generate\" deleteTime=\"10000\"  duration=\"10s\">
        <p class=\"toast-message\">
            <i class=\"fa fa-xmark-circle toast-danger toast-icon\"></i>
            {$message}
        </p>
    </li>";
}


function warning($message): string {
    return "<li class=\"toast\" id=\"toast-generate\" deleteTime=\"10000\"  duration=\"10s\">
        <p class=\"toast-message\">
            <i class=\"fa fa-triangle-exclamation toast-warning toast-icon\"></i>
            {$message}
        </p>
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
        ? "<li class=\"star\"><i class=\"fa fa-star\"></i></li>"
        : "<li><i class=\"fa fa-star\"></i></li>";
    }
    return "<div class=\"stars\">
        <ul>$li</ul>
    </div>";
}

function dump(...$vars) {
   
    foreach ($vars as $var) {
        echo "<pre>";
        var_dump($var);
        echo "<pre>";
    }

    die();
}


function bell($user, $toajax = false): ?string
{
    
    $notifications = getNotificationLimit($user);
    $bell = "";
    if (empty($notifications)) return null;
    $eye = '';
    foreach ($notifications as $notification) {
        if ($notification['eye'] !== 1) $eye = 'no-eye';
        $id = $notification['notif_id'];
        $generate = generate('notif.eye', ['notifid' => $id]);
        $content = exercept($notification['content'], 50);
        $title = exercept($notification['title'], 20);
        $bell .= "<a href=\"$generate\" id=\"generate-{$id}\">
            <h5>{$title}</h5>
            <p>{$content}</p>
            <span class=\"date\">{$notification['create_at']}</span>
        </a>";
    }

    $bell = empty($bell) ? "pas de notification" : $bell;
    $linkFooter = generate('notif.all');
    $bellFetch = generate('notif.navbell');
    $optionFetch = generate('notif.optionbell');
    return $toajax ? $bell :  "
    <div class=\"nav-option notification-refresh\"> 
        <a href=\"#\" class=\"link-option $eye\" id=\"option-bell\" url=\"$optionFetch\"><i class=\"fa fa-bell\"></i></a>
        <div class=\"absolute-list nav-bell \" id=\"nav-bell\" url=\"$bellFetch\">
            <h4>notifications</h4>
            <div class=\"bell-body\"> $bell </div>
            <a class=\"bell-footer\" href=\"{$linkFooter}\">Toutes les notifications</a>
        </div>
    </div>
    ";
}


?>
