<?php

require dirname(__DIR__) . "/vendor/autoload.php";

define("SOURCES", dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . "dist");
define("UPLOADED_PATH", dirname(dirname($_SERVER['SCRIPT_NAME']))  . "uploaded");
define("VIEW_PATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . "views");
define("LAYOUT_PATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates");

define('SESSION_USER', 'user__');
// define('SESSION_ADMIn', 'admin__');

function dist($source) {
    return sprintf("%s/%s", SOURCES, $source);
}

$route = explode("?", $_SERVER['REQUEST_URI'])[0] ?? '/';


/**
 * tableau des routes
 */

define('ROUTES', [
    'home' => '/',
    'store' => '/store',
    'store.eye' => '/store/voir-produit',
    '_store.filter' => '/_store/filter',
    'user' => '/user/login',
    'user.create' => '/user/create',
    'user.confirm' => '/user/account/confirm',
]);




/**
 * Tableau de views 
 * le fichier à charger si la route existe
 */
define('VIEWS', [
    'home' => 'index.php',
    'store' => '/store/store.php',
    'store.eye' => '/store/eye.php',
    '_store.filter' => '/store/_store.php',
    'user' => '/users/login.php',
    'user.create' => '/users/create.php',
    'user.confirm' => '/users/confirm.php',
]);


/**
 * page introuvable
 * Erreur des routes
 */
$notFound = "error.php";

/**
 * on démarre la buff
 */
ob_start();
$pdo = getPDO();
if (in_array($route, ROUTES)) {
    foreach (ROUTES as $name => $value) {
        if ($route === $value) {
            require sprintf("%s/%s", VIEW_PATH, VIEWS[$name]);
        }
    }
} else {
    http_response_code(404);
    require sprintf("%s/%s", VIEW_PATH, $notFound);
}

if (!strpos($route, '_') !== 1) {


    $content = ob_get_clean();

    /**
     * on charge le template
     */

    require sprintf("%s/%s", LAYOUT_PATH, layout($route));
}

