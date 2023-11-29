<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use Bitrix\Main\Engine\Contract\Controllerable;


if (!Loader::includeModule("highloadblock")) {
    ShowError("Module 'highloadblock' is not installed");
    return;
}

class celendar extends CBitrixComponent implements Controllerable
{
    public function onPrepareComponentParams($params){
        if (! $params['HL_ID']){
            $this->arParams['HL_ID'] = 4;
        }else{
            $this->arParams['HL_ID'] = $params["HL_ID"];
        }
        return $params;

    }

    public function executeComponent(){
        $this->getItems();
        $this->includeComponentTemplate();
    }

    public function getItems(){
        $mY = date('Y-m');
        $timestamp = strtotime($mY . '-01');
 
        $entity = HL\HighloadBlockTable::compileEntity($this->arParams['HL_ID']); 
        $entity_data_class = $entity->getDataClass(); 
        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("UF_DATA" => "ASC"),
            "filter" => array('>UF_DATA' => date('01.m.Y', $timestamp), 
                            '<UF_DATA' => date('t.m.Y', $timestamp) 
            )
         ));
        $arData = $rsData->fetchAll();
        $this->arResult['ITEMS'] = $arData;

        for ($i = 1; $i < date('t', $timestamp); $i++){
            $this->arResult['dateItems'][$i] = [];
        }


        for ($i = 1; $i < date('t', $timestamp); $i++){
            foreach($arData as $value){
                if ($value['UF_DATA'] == date("$i.m.Y", $timestamp)){
                    array_push($this->arResult['dateItems'][$i], $value);
                }
            }
        }
    }

    public function configureActions()
        {
            return [
                'getItem' => [
                    'prefilters' => [],
                    'postfilters' => []
                ]
            ];
        }

    public function getItemAction($id, $hlId){
        $entity = HL\HighloadBlockTable::compileEntity($hlId); 
        $entity_data_class = $entity->getDataClass(); 
        $rsData = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("UF_DATA" => "ASC"),
            "filter" => array("=ID" => $id),             
            )
         )->Fetch();
        
        $rsData['nameS'] = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("UF_DATA" => "ASC"),
            "filter" => array("ID" => $rsData["UF_HIGH"]),             
            )
         )->Fetch()["UF_NAME"];
        
        $rsData['image'] = CFile::GetPath($rsData['UF_IMAGE']);
        
        return $rsData;
        }
};