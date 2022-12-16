<?
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable; 
use Bitrix\Main\Entity;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class CLabel extends CBitrixComponent
{
    private $arHighloadProperties;

    public function onPrepareComponentParams($arParams)
    {
        $this->arHighloadProperties = $arParams["ITEM"]["PROPERTIES"]["LABELS"];
        return $arParams;
    }

    private function getEntityClass()
    {
        Loader::includeModule("highloadblock");

        if (empty($this->arHighloadProperties)) return null;
        
        $hlBlock = HighloadBlockTable::getRow([
            'filter' => [
                '=TABLE_NAME' => $this->arHighloadProperties["USER_TYPE_SETTINGS"]["TABLE_NAME"],
            ],
        ]);

        if (!isset($hlBlock)) return null;
        
        $entity = HighloadBlockTable::compileEntity($hlBlock);
        $entityClass = $entity->getDataClass(); 

        return $entityClass;
    }

    private function getLabels()
    {
        $arLabels = array();
        $entityClass = $this->getEntityClass();
        
        if (isset($entityClass))
        {
            $arResult = $entityClass::getList([
                'select' => [
                    "NAME" => "UF_NAME",
                    "COLOR" => "UF_COLOR",
                ],
                'filter' => [
                    'UF_XML_ID' => $this->arHighloadProperties["VALUE"],
                ],
            ]);
        }

        while ($label = $arResult->fetch()){
            $arLabels[] = $label;
        }

        return $arLabels;
    }

    public function executeComponent()
    {
        if ($this->StartResultCache())
        {
            $this->arResult["LABELS"] = $this->getLabels();
            $this->IncludeComponentTemplate();
        }
    }
}