<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Engine\Contract\Controllerable;

class CDemoSqr extends CBitrixComponent implements Controllerable
{
    public function onPrepareComponentParams($arParams)
    {
        if (!$arParams['SORT_BY1']){
            $arParams['SORT_BY1'] = 'NAME';
        }
        if (!$arParams['SORT_ORDER1']){
            $arParams['SORT_ORDER1'] = 'ASC';
        }
        if (!$arParams['IBLOCK_ID']){
            $arParams['IBLOCK_ID'] = 4;
        }
        if (!$arParams['IBLOCK_ITEMS_COUNT']){

            $arParams['IBLOCK_ITEMS_COUNT'] = 4;
        }
        return $arParams;
    }

    public function configureActions()
        {
            return [
                'getItems' => [
                    'prefilters' => [],
                    'postfilters' => []
                ]
            ];
        }


    public function getItemsAction($userId, $itemId){
        CModule::IncludeModule("iblock");
        $this->getItem();
        return $this->arResult["ITEM"];
    }
    public function executeComponent()
    {
        $this->getItem();
        $this->IncludeComponentTemplate();
    }

    private function getItem(){
        $res = CIBlockElement::GetList([$this->arParams['SORT_BY1']=>$this->arParams['SORT_ORDER1']], ['IBLOCK_ID' => $this->arParams['IBLOCK_ID']], false,
            ["nTopCount" => $this->arParams['IBLOCK_ITEMS_COUNT']]);
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $this->arResult["ITEM"][] = $arFields;
        }
        return $this->arResult;
    }

};