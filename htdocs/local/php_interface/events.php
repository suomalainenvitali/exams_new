<?
use Bitrix\Main\EventManager;
use Vendor\Local\Handlers\Clothes;

//Добавление событий
EventManager::getInstance()->addEventHandler("iblock", "OnBeforeIBlockElementUpdate", array(Clothes::class, "OnBeforeIBlockElementUpdateHandler"));