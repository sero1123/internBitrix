<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
CModule::IncludeModule("highloadblock");
CModule::IncludeModule("catalog");
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use Bitrix\Main\Entity;
use \Bitrix\Sale\Internals\DiscountCouponTable as Coupon;

class SetPromo extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams) {
        if(!$arParams['USER_ID'])
        {
            global $USER;
            $arParams['USER_ID'] = $USER->getID();
        }
        return $arParams;
    }
    public function executeComponent()
    {

        $promoHl = HL::getList([
            'filter' => ['=NAME' => 'Promo'],
            ])->fetch();
            
        $promoObject = HL::compileEntity($promoHl);
        $PromoDataClass = $promoObject->getDataClass();
        $promo = $PromoDataClass::getList
        ([
        'select' => ['*'],
        'order' => ['ID' => 'ASC'],
        'filter' => ['UF_USER_ID' => $this->arParams['USER_ID']]
        ]);
        $this->arResult["PROMO"] = $promo->fetch()['UF_PROMO'];
        $this->IncludeComponentTemplate();
    }
}