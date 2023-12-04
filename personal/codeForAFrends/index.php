<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Промо для друга");
CModule::IncludeModule("highloadblock");
CModule::IncludeModule("catalog");
use Bitrix\Highloadblock\HighloadBlockTable as HL;
use Bitrix\Main\Entity;
use \Bitrix\Sale\Internals\DiscountCouponTable as Coupon;
?>

<?$APPLICATION->IncludeComponent(
	"vedita:setPromo",
	"",
	[]
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
