<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Статьи");


$GLOBALS['arrFilter'] = ["PROPERTY_popular" => "1"];

require_once("newsParam.php");


$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"test", 
	$arrParamNews,
	false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
