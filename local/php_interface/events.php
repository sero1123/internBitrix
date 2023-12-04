<?
use Bitrix\Main\Mail\Event;
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use Bitrix\Main\Entity;
use \Bitrix\Sale\Internals\DiscountCouponTable as Coupon;

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("addItems", "OnBeforeIBlockElementAdd"));

class addItems
{
    // создаем обработчик события "OnAfterIBlockAdd"
    public static function OnBeforeIBlockElementAdd(&$arFields)
    {   
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/log.txt' , var_export($arFields, true));
        if($arFields["IBLOCK_ID"] == 1){
            $arFields['ACTIVE'] = "N";

        }
    }
}

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("changeItems", "OnBeforeIBlockElementUpdate"));
class changeItems
{
    // создаем обработчик события "OnBeforeIBlockPropertyUpdate"
    public static function OnBeforeIBlockElementUpdate(&$arFields)
    {        
        if($arFields["IBLOCK_ID"] == 1){
            $arFields["NAME"] = $arFields["NAME"] . " обновлено " . date('d.m.y H:m');
        }
    }
}


AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("MyClass", "OnAfterIBlockElementAddHandler"));
class MyClass
{
    // создаем обработчик события "OnAfterIBlockElementAdd"
    public static function OnAfterIBlockElementAddHandler(&$arFields)
    {   
        $id = $arFields['ID'];
        $sectionId = $arFields['IBLOCK_SECTION'][0];
        if ($arFields["IBLOCK_ID"] == ID_ARTICLES){     
                Event::send([
                    "EVENT_NAME"=>'addArticle',
                    'MESSAGE_ID'=>90,
                    "LID" => "s1",
                    "C_FIELDS"=>['link' => "http://bitrix/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=4&type=services&lang=ru&find_section_section=$sectionId&ID=$id"]
                ]);
        }
    }
}


AddEventHandler("main", "OnEpilog", "MyOnEpilog", 50);
function MyOnEpilog()
{
    global $APPLICATION;
    if($APPLICATION->GetCurPage(false) === '/')
    {
        if ( 9 <= date("h") &&  date("h") < 18)
        {
            $APPLICATION->SetPageProperty("title", "Выгодная покупка на нашем сайте только сегодня");
            $APPLICATION->SetPageProperty("description", "Купить выгодно товары на нашем сайте. Звоните на номер 8 800 555535. Проще позвонить, чем написать");
        }
        else
        {
            $APPLICATION->SetPageProperty("title", "Выгодная покупка на нашем сайте только сегодня и завтра");
            $APPLICATION->SetPageProperty("description", "Купить выгодно товары на нашем сайте. Пишите на test@testseo.test");
        }
        
    }
}

AddEventHandler("sale", 'OnSaleComponentOrderCreated', "changeInPayerTypes");
function changeInPayerTypes($order, &$arUserResult, $request, &$arParams, &$arResult, &$arDeliveryServiceAll, &$arPaySystemServiceAll)
{    

    if(isTheUserAb2bBuyer())
    {
        foreach($arResult["PERSON_TYPE"] as $key => $personType){
            if ($personType['CODE'] !== "ENTITY"){
                unset($arResult["PERSON_TYPE"][$key]);
            }
        }
    }elseif(isTheUserAb2cBuyer())
    {
        foreach($arResult["PERSON_TYPE"] as $key => $personType){
            if ($personType['CODE'] !== "INDIVIDUAL"){
                unset($arResult["PERSON_TYPE"][$key]);
            }
        }
    }
}

// AddEventHandler('sale', "OnOrderUpdate", "actionOnOrderUpdate");
// function actionOnOrderUpdate($ID, $arFields){
//     if (isTheUserAb2cBuyer())
//     {     
//         Event::send([
//             "EVENT_NAME"=>'SALE_CHANGET',
//             'MESSAGE_ID'=>110,
//             "LID" => "s1",
//             "C_FIELDS"=>[]
//         ]);
//     }   
//     elseif(isTheUserAb2bBuyer())
//     {
//         Event::send([
//             "EVENT_NAME"=>'SALE_CHANGET',
//             'MESSAGE_ID'=>109,
//             "LID" => "s1",
//             "C_FIELDS"=>[]
//         ]);
//     }
// }

AddEventHandler('main', 'OnBeforeEventAdd', "addInformationCompany");
function addInformationCompany(string &$event,string &$lid,array &$arFields,string &$message_id,array &$files,string $languageId = '')
{

    if($event == 'SALE_STATUS_CHANGED_P') #оплачен формируется к отправке
    {
        $order = \Bitrix\Sale\Order::load($arFields['ORDER_ID']);
        $userId = $order->getField('USER_ID');

        if (isTheUserAb2bBuyerById($userId))
        {
            $message_id = 104;
            $arFields += getEntityData($arFields['ORDER_ID']);
        }
        elseif (isTheUserAb2cBuyerById($userId))
        {
            $message_id = 89;
        }
    }

    if($event == 'SALE_STATUS_CHANGED_N') #принят ожидается оплата
    {
        $order = \Bitrix\Sale\Order::load($arFields['ORDER_ID']);
        $userId = $order->getField('USER_ID');

        if (isTheUserAb2bBuyerById($userId))
        {
            $message_id = 106;
            $arFields += getEntityData($arFields['ORDER_ID']);

        }
        elseif (isTheUserAb2cBuyerById($userId))
        {
            $message_id = 61;
        }

    }
    if($event == 'SALE_STATUS_CHANGED_F') #выполнен
    {
        $order = \Bitrix\Sale\Order::load($arFields['ORDER_ID']);
        $userId = $order->getField('USER_ID');
        if (isTheUserAb2bBuyerById($userId))
        {
            $message_id = 108;
            $arFields += getEntityData($arFields['ORDER_ID']);

        }
        elseif (isTheUserAb2cBuyerById($userId))
        {
            $message_id = 60;
        }

    }
    if($event == 'SALE_CHANGET') #изменение
    {
        $order = \Bitrix\Sale\Order::load($arFields['ORDER_ID']);
        $userId = $order->getField('USER_ID');
        if (isTheUserAb2bBuyerById($userId))
        {
            $message_id = 109;
            $arFields += getEntityData($arFields['ORDER_ID']);

        }
        elseif (isTheUserAb2cBuyerById($userId))
        {
            $message_id = 110;

        }
    }
}

AddEventHandler('main', 'OnAfterUserRegister', "createCoupon");
function createCoupon(&$arFields)
{
    $promoObject = new CreatingAPromo;
    $promoObject->creating($arFields['USER_ID']);
}

AddEventHandler('sale', 'OnAfterSaleOrderFinalAction', "checkingPromoOrder");
function checkingPromoOrder($event)
{
    $test = new CheckingPromo();
    $test->checking($event);
}

AddEventHandler('sale', 'OnSalePayOrder', "couponAction");

function couponAction(int $orderId, string $isPay)
{
    if($isPay == 'Y')
    {
        $couponList = \Bitrix\Sale\Internals\OrderCouponsTable::getList(array(
            'select' => array('COUPON'),
            'filter' => array('=ORDER_ID' => $orderId)
        ));

        $promoHl = HL::getList([
            'filter' => ['=NAME' => 'Promo'],
        ])->fetch();

        $promoObject = HL::compileEntity($promoHl);
        $PromoDataClass = $promoObject->getDataClass();
        while($coupon = $couponList->fetch())
        {
            if ($userId = $PromoDataClass::getList
                ([
                    "select" => ["*"],
                    "order" => ["ID" => "ASC"],
                    'filter' => ['UF_PROMO' => $coupon['COUPON']]
                ])->fetch()['UF_USER_ID'])
            {
                CSaleUserAccount::UpdateAccount($userId, REFERAL_BONUS, 'RUB');
            }
        }
    }
}

?>