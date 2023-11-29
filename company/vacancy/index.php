<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"vacancy", 
	array(
		"IBLOCK_TYPE" => "aspro_max_content",
		"IBLOCK_ID" => "8",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/company/vacancy/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "100000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DETAIL_TEXT",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "CITY",
			1 => "PAY",
			2 => "QUALITY",
			3 => "WORK_TYPE",
			4 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_TEXT",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "CITY",
			1 => "PAY",
			2 => "QUALITY",
			3 => "WORK_TYPE",
			4 => "DOCUMENT",
			5 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"VIEW_TYPE" => "list",
		"SHOW_TABS" => "N",
		"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
		"IMAGE_POSITION" => "left",
		"AJAX_OPTION_ADDITIONAL" => "",
		"USE_REVIEW" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"SHOW_DETAIL_LINK" => "Y",
		"COMPONENT_TEMPLATE" => "vacancy",
		"SET_LAST_MODIFIED" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"FORM" => "Y",
		"FORM_ID" => "",
		"FORM_BUTTON_TITLE" => "",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"USE_SHARE" => "Y",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"SECTION_ELEMENTS_TYPE_VIEW" => "FROM_MODULE",
		"ELEMENT_TYPE_VIEW" => "element_1",
		"FILE_404" => "",
		"SHOW_TOP_VACANCY_BLOCK" => "Y",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>