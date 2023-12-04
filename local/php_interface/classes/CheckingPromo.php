<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("highloadblock");
CModule::IncludeModule("catalog");
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use Bitrix\Main\Entity;
use \Bitrix\Sale\Internals\DiscountCouponTable as Coupon;

class CheckingPromo
{
    public function checking(&$order): void
    {
        $promoFromTheTable = $this->getPromo();
        $arrPromoOrder = $order->getDiscount()->getApplyResult()['COUPON_LIST'];
        foreach ($arrPromoOrder as $promo => $arValue)
        {
            if ($promo ==  $promoFromTheTable)
            {
                \Bitrix\Sale\DiscountCouponsManager::delete($promo);
            }
        }

    }

    private function getPromo(): string
    {
        $promoHl = HL::getList([
            'filter' => ['=NAME' => 'Promo'],
        ])->fetch();

        $promoObject = HL::compileEntity($promoHl);
        $PromoDataClass = $promoObject->getDataClass();
        global $USER;
        $promo = $PromoDataClass::getList
        ([
            "select" => ["*"],
            "order" => ["ID" => "ASC"],
            'filter' => ['UF_USER_ID' => $USER->getID()]
        ]);
        return $promo->fetch()['UF_PROMO'];
    }
}