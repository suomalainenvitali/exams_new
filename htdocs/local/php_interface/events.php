<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\EventManager;
use Vendor\Local\Handlers\Clothes;

//Добавление событий
EventManager::getInstance()->addEventHandler("iblock", "OnBeforeIBlockElementUpdate", array(Clothes::class, "OnBeforeIBlockElementUpdateHandler"));