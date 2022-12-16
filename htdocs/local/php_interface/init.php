<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/vendor/autoload.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/vendor/autoload.php");
}

if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/events.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/events.php");
}