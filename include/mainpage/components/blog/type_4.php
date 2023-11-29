<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"front_news", 
	array(
		"IBLOCK_TYPE" => "aspro_max_content",
		"IBLOCK_ID" => CMaxCache::$arIBlocks[SITE_ID]['aspro_max_content']['aspro_max_articles'][0],
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arRegionLinkFront",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DATE_ACTIVE_FROM",
		),
		"PROPERTY_CODE" => array(
			0 => "PERIOD",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d F Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "ajax",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"IMG_POSITION" => "right",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "front_news",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"TITLE_BLOCK" => "Блог",
		"TITLE_BLOCK_ALL" => "Все статьи",
		"ALL_URL" => "blog/",
		"SIZE_IN_ROW" => "5",
		"TYPE_IMG" => "md",
		"SHOW_SECTION_NAME" => "Y",
		"BORDERED" => "Y",
		"FON_BLOCK_2_COLS" => "Y",
		"BG_POSITION" => "center",
		"INCLUDE_FILE" => "",
		"SHOW_SUBSCRIBE" => "Y",
		"TITLE_SUBSCRIBE" => "Подписаться",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MOBILE_TEMPLATE" => $GLOBALS['arTheme']['MOBILE_BLOG']['VALUE'],
		"CHECK_REQUEST_BLOCK" => CMax::checkRequestBlock('blog'),
		"IS_AJAX" => CMax::checkAjaxRequest(),
		"MESSAGE_404" => ""
	),
	false
);?>