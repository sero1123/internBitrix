<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
class CDemoSqr extends CBitrixComponent
{
    public function executeComponent()
    {
        var_dump($this->arParams);
        die;

        $arResult = array();
        $this->arResult['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];
        $this->arResult['ITEM'];
        $res = CIBlockElement::GetList([$this->arParams['SORT_BY1']=>$this->arParams['SORT_ORDER1']], ['IBLOCK_ID' => $this->arParams['IBLOCK_ID']], false,
            ["nTopCount" => $this->arParams['IBLOCK_ITEMS_COUNT']]);
        $i = 0;
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $this->arResult["ITEM"][$i] = $arFields;
            $i++;
        }
            $this->IncludeComponentTemplate();
    }

};