<?php
// @codingStandardsIgnoreFile

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    header('HTTP/1.1 500 Internal Server Error');
    exit('Upgrade PHP to version 5.3 or greater.');
}

define('_ENV_PROJECT_BASE', dirName($_SERVER['SCRIPT_FILENAME']));

// a handful of PHP lib functions are locale aware. A common default locale
// is 'C', which fails (on env and prod) to read multibyte characters
if (strpos(strtolower(setlocale(LC_ALL, 0)), '.utf') === false) {
    setlocale(LC_ALL, 'en_US.UTF-8');
    setlocale(LC_ALL, 'C.UTF-8');
}

require_once(_ENV_PROJECT_BASE . '/classes/commons/includes/Router.php');
require_once(_ENV_PROJECT_BASE . '/classes/commons/includes/CanonicalUri.php');

if (array_key_exists('DEBUG', $_SERVER) && $_SERVER['DEBUG'] == 'TRUE') {
    define('_DEBUG', true);
} else {
    define('_DEBUG', false);
}

$uri = new CanonicalUri($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']);
$uri->enforceCanonical();

$router = new Router();
require_once(_ENV_PROJECT_BASE . $router->include);

exit;
