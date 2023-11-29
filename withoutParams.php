<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("тесткомпонент");
?><?$APPLICATION->IncludeComponent(
	"vedita:elements.list",
	"ajax",
	Array(
		"IBLOCK_ID" => "2",
		"IBLOCK_ITEMS_COUNT" => "3",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC"
	)
);?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>