<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

\Bitrix\Main\UI\Extension::load('ui.fonts.opensans');



$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';
?>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
			<?foreach($arResult["ITEMS"] as $arItem){?>
            <div class='col-md-4'>
                <div class='card mb-4 box-shadow'>
                    <img class='card-img-top' src='<?=$arItem['PREVIEW_PICTURE']['SRC']?>'>
                    <div class='card-body'>
                        <p style='font-weight:bold'><?=$arItem['NAME']?></p>
                        <p class='card-text'><?= $arItem["DETAIL_TEXT"]?></p>
                        <div class='d-flex justify-content-between align-items-center'>
                            <div class='btn-group'>
                                <a href='<?=$arItem["DETAIL_PAGE_URL"]?>'><button type='button' class='btn btn-sm btn-outline-secondary'>Подробнее</button></a>
                            </div>
                            <small class='text-muted'><?=$arItem["TIMESTAMP_X"]?></small>
                        </div>
                    </div>
                </div>
            </div>
			<?}
			?>
<?
// echo "<pre>";
// print_r($arResult);
// echo "</pre>";?>

