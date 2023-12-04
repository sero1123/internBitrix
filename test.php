<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use Bitrix\Main\Entity;
use \Bitrix\Sale\Internals\DiscountCouponTable as Coupon;
CModule::IncludeModule("highloadblock");
CModule::IncludeModule("catalog");

echo "<pre>";
$couponList = \Bitrix\Sale\Internals\OrderCouponsTable::getList(array(
    'select' => array('COUPON'),
    'filter' => array('=ORDER_ID' => 34)
));
print_r($couponList->fetch());
echo "</pre>";


?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
