<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/* SPECIALDATE */

if (isset($arResult["DATE_FIRST_NEWS"]))
{
    $APPLICATION->SetPageProperty("specialdate", $arResult["DATE_FIRST_NEWS"]);
}