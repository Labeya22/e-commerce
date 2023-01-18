<?php

require dirname(__DIR__) . "/vendor/autoload.php";

define("SOURCES", dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR . "dist");
define("UPLOADED_PATH", dirname(dirname($_SERVER['SCRIPT_NAME']))  . "uploaded");
define("UPLOADER_PATH", dirname(__DIR__)  . DIRECTORY_SEPARATOR . "uploader" );
define("VIEW_PATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . "views");
define("LAYOUT_PATH", dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates");

define('SESSION_ADMIN', 'admin__');

define('SESSION_USER', 'user__');
define('SESSION_SAVE_MEMORY', 'saveMemory__');
define('SESSION_FORGOT', 'forgot__');
define('SESSION_FLASH', 'flash');
define('COOKIE_USER', 'cookie_user__');
define('NOTIFICATION', [
    'primary' => 'panier',
    'account' => 'compte',
    'checkout' => 'compte banquaire'
]);
/**
 * @var PDO
 */
define('DATABASE', getPDO());


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
    'user' => '/@user/login',
    'user.create' => '/@user/create',
    'user.profil' => '/myprofil',
    'user.confirm' => '/@user/account/confirm',
    'user.logout' => '/@user/logout',
    'user.edit' => '/edit/account',
    'user.change-pass' => '/change/password',
    'user.delete' => '/delete/account',
    'user.your-email' => '/@user/forgot/your-email/sendcode',
    'user.code' => '/@user/forgot/code-reset',
    'user.forgot' => '/@user/forgot/change-pass',
    'cart' => '/cart',
    'cart.checkout' => '/_cart/checkout',
    'cart.delete' => '/_cart/delete',
    'cart.add' => '/_cart/add',
    'cart.quantity' => '/_cart/update/quantity',
    'cart.news' => '/_cart/news',
    'contact' => '/contact',
    'about' => '/about',
    'facture' => '/@facture/generer',
    'facture.all' => '/factures',
    'facture.eye' => '/@facture/eye',
    'notif.all' => '/notifications',
    'notif.eye' => '/notification/eye',
    'notif.delete' => '/_notification/delete',
    'notif.navbell' => '/_notification/refresh/navbell',
    'notif.optionbell' => '/_notification/refresh/optionbell',
    'trans.home' => '/transactions',
    'admin.dash' => '/@admin/dashboard',
    'admin.types' => '/@admin/types',
    'admin.type-del' => '/_admin/types/delete',
    'admin.type-create' => '/@admin/types/create',
    'admin.type-update' => '/@admin/types/update',
    'admin.marques' => '/@admin/marques',
    'admin.marque-del' => '/_admin/marques/delete',
    'admin.marque-create' => '/@admin/marques/create',
    'admin.marque-update' => '/@admin/marques/update',
    'admin.vehicules' => '/@admin/vehicules',
    'admin.vehicule-del' => '/_admin/vehicule/delete',
    'admin.vehicule-create' => '/@admin/vehicule/create',
    'admin.vehicule-upload' => '/@admin/vehicule/uploader/image',
    'admin.vehicule-uploaded' => '/_admin/vehicule/uploader/image',

    
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
    'user.profil' => '/users/myprofil.php',
    'user.logout' => '/users/logout.php',
    'user.edit' => '/users/actions/edit.php',
    'user.change-pass' => '/users/actions/change.php',
    'user.delete' => '/users/actions/delete.php',
    'user.your-email' => '/users/forgot/yourEmail.php',
    'user.code' => '/users/forgot/code.php',
    'user.forgot' => '/users/forgot/forgot.php',
    'cart' => 'cart/cart.php',
    'cart.checkout' => 'cart/checkout.php',
    'cart.news' => 'cart/news.php',
    'cart.delete' => 'cart/delete.php',
    'cart.add' => 'cart/add.php',
    'cart.quantity' => 'cart/quantity.php',
    'contact' => 'contact/contact.php',
    'about' => 'about.php',
    'facture' => 'invoices/lastFacture.php',
    'facture.all' => 'invoices/factures.php',
    'facture.eye' => 'invoices/facture.php',
    'notif.all' => 'notifications/notification.php',
    'notif.eye' => 'notifications/eye.php',
    'notif.delete' => 'notifications/delete.php',
    'notif.navbell' => 'notifications/navbell.php',
    'notif.optionbell' => 'notifications/optionbell.php',
    'trans.home' => 'transactions/home.php',
    'admin.dash' => 'admin/dashboard.php',
    'admin.types' => 'admin/types/index.php',
    'admin.type-del' => 'admin/types/_delete.php',
    'admin.type-create' => 'admin/types/create.php',
    'admin.type-update' => 'admin/types/update.php',
    'admin.marques' => 'admin/marques/index.php',
    'admin.marque-del' => 'admin/marques/_delete.php',
    'admin.marque-create' => 'admin/marques/create.php',
    'admin.marque-update' => 'admin/marques/update.php',
    'admin.vehicules' => 'admin/vehicules/index.php',
    'admin.vehicule-del' => 'admin/vehicules/_delete.php',
    'admin.vehicule-create' => 'admin/vehicules/create.php',
    'admin.vehicule-upload' => 'admin/vehicules/upload.php',
    'admin.vehicule-uploaded' => 'admin/vehicules/_upload.php',

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

if (strpos($route, '_') === false) {
    $content = ob_get_clean();
    require sprintf("%s/%s", LAYOUT_PATH, layout($route));
}

