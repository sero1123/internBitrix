<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
class itemsManipulation{
    private $element;
    private $data = [
                'status'=>true,
                "action"=>false,
                'hasErrors'=>false,
                'message' => 'успешно выполнено',
                'data' => []
                ];
        
    
    public function getData(){
        return $this->data;
    }
    public function __construct()
    {
        $this->element = new CIBlockElement();
        if (key_exists("action", $_GET)){
            $this->data['action'] = $_GET['action'];
            if ($_GET["action"] == 'getItems' and key_exists("iblockId", $_GET) && (CIBlockElement::GetByID($_GET['iblockId']) !== false) && is_numeric($_GET['iblockId'])){
                $this->getItems();
            }else if($_GET["action"] == 'updateItems' and key_exists("itemId", $_GET) && CIBlockElement::GetByID($_GET['itemId']) !== false && is_numeric($_GET['itemId'])){
                $this->updateItems();
            } else if ($_GET["action"] == 'addItems'){
                $this->addItems();
            } else if($_GET["action"] == 'deleteItems' and key_exists("itemId", $_GET) && CIBlockElement::GetByID($_GET['itemId']) !== false && is_numeric($_GET['itemId'])){
                $this->deleteItems();
            }
            else{
                $this->setErrors("ошибка в передаваемых параметрах");
            }
        }else{
            $this->setErrors("нет параметра актион");
        }
    }

    private function deleteItems(){
        if(!($PRODUCT_ID = $this->element->Delete($_GET['itemId']))){
            $this->setErrors('ошибка при удалении');
        }else{
            $this->data['data'] = $PRODUCT_ID;
        }
    }

    private function addItems(){
        $arrFields = 
        ["ACTIVE" => "Y",
            "IBLOCK_ID" => 1,
            "NAME" => "новая новость",
            "DETAIL_TEXT" => "новейшая новость нового мира",
            "PREVIEW_TEXT"   => "текст для списка элементов",
            "CODE" => 'newNews',
        ];
        
        if(!($PRODUCT_ID = $this->element->Add($arrFields))){
            $this->setErrors($PRODUCT_ID->LAST_ERROR);
            }
            else{
                $this->data['data'] = $PRODUCT_ID;
            }
    }

    private function updateItems(){
        if(!($PRODUCT_ID = $this->element->Update($_GET['itemId'], ['ACTIVE' => "N"]))){
            $this->setErrors("ошибка в изменении");
        }else{   
            $this->data['data'] = $PRODUCT_ID;
        }
    }

    private function getItems(){
        $limit = INF;

        if (key_exists("limit", $_GET) && is_numeric($_GET["limit"])){
            $limit = $_GET["limit"];
        }

        $arFilterInfo = ["IBLOCK_ID"=>$_GET['iblockId']];
        if(!($PRODUCT_ID = $this->element->GetList(Array("SORT"=>"ASC"), $arFilterInfo, false, ['nTopCount' => $limit]))){
                $this->setErrors("ошибка в показе");
            }else{
                $arr_result = [];

                while ($object = $PRODUCT_ID->GetNextElement()){
                    array_push($arr_result, $object);
                }

                $this->data['data'] = $arr_result;
            }
        

    }

    private function setErrors($error){
        $this->data['status'] = false;
        if (key_exists('action', $_GET)) $this->data['action'] = $_GET['action'];
        $this->data['hasErrors'] = true;
        $this->data['message'] = $error;
    }
}