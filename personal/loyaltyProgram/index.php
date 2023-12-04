<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Программа лояльности");

?>

<?$APPLICATION->IncludeComponent(
	"vedita:loyaltyProgram",
	"",
	[]
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
