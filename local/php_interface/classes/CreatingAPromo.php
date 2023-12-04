<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("highloadblock");
CModule::IncludeModule("catalog");
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use Bitrix\Main\Entity;
use \Bitrix\Sale\Internals\DiscountCouponTable as Coupon;


class CreatingAPromo
{
    public function creating(int $USER_ID): void
    {
        $promoHl = HL::getList([
            'filter' => ['=NAME' => 'Promo'],
        ])->fetch();
        $promoObject = HL::compileEntity($promoHl);
        $PromoDataClass = $promoObject->getDataClass();

        $PromoDataClass::add
        ([
            'UF_PROMO' => $this->addCoupon(),
            'UF_USER_ID' => $USER_ID,
        ]);
    }

    private function addCoupon(): string
    {
        $coupon = CatalogGenerateCoupon();
        $addCoupon = Coupon::add
        ([
            'COUPON' => $coupon,
            "ACTIVE" => "Y",
            "ONE_TIME" => "Y",
            'DISCOUNT_ID' => '2',
            "DATE_APPLY" => false,
            'TYPE' => '2',
        ]);
        return $coupon;
    }
}