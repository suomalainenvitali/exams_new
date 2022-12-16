<?
namespace Vendor\Local\Handlers;

use Bitrix\Main\Localization\Loc;
use Bitrix\Iblock\ElementTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Loc::loadMessages(__FILE__);

define("IBLOCK_CATALOG", 2);
define("MAX_SHOWS", 2);

//Класс работы с событиями для каталога одежда
class Clothes 
{
    //Обработчик преред обновлением элемента
    public function OnBeforeIBlockElementUpdateHandler($arFields)
    {
        global $APPLICATION;

        if ($arFields["IBLOCK_ID"] == IBLOCK_CATALOG) 
        {
            if ($arFields["ACTIVE"] == "N")
            {
                $arSelect = array(
                    "ID", 
                    "IBLOCK_ID", 
                    "NAME", 
                    "SHOW_COUNTER",
                ); 
            
                $arFilter = array(
                    "IBLOCK_ID" => IBLOCK_CATALOG, 
                    "ID" => $arFields["ID"],
                );            

                $arItems = ElementTable::getList(array(
                    'select' => $arSelect,
                    'filter' => $arFilter,
                ))->fetch();

                if ($arItems["SHOW_COUNTER"] > MAX_SHOWS)
                {
                    $exText = Loc::getMessage("MAX_SHOWS", array("#COUNT#" => $arItems["SHOW_COUNTER"]));
                    $APPLICATION->ThrowException($exText);
                    return false;                  
                }
            }
        }  
    }
}