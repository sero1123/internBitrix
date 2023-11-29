<?php
// Запрещаем прямой доступ
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Подключаем модуль информационных блоков
if(!CModule::IncludeModule("iblock"))
    return;
$arSorts = [
    "ASC"=>'по возрастанию',
    "DESC"=>'по убыванию',
];
$arSortFields = [
    "ID"=>'id',
    "NAME"=>'имя',
];

// Получаем список инфоблоков
$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
    $arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

// Массив описаний параметов компонента
$arComponentParameters = array(
    // Группы
    "GROUPS" => array(
        "IBLOCK_PARAMS" => array(
            "NAME" => GetMessage("IBLOCK_PARAMS_NAME")
        )
    ),
    // Массив описания параметров
    "PARAMETERS" => array(
        // ID инфоблока
        "IBLOCK_ID" => array(
            "PARENT" => "IBLOCK_PARAMS",
            "NAME" => "id инфоблока",
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y"
        ),
        // Количество элементов инфоблока для выборки
        "IBLOCK_ITEMS_COUNT" => array(
            "PARENT" => "IBLOCK_PARAMS",
            "NAME" => 'количество элементов',
            "TYPE" => "STRING",
            "DEFAULT" => '10',
        ),
        "SORT_BY1" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => 'по какому полю сортировка',
            "TYPE" => "LIST",
            "DEFAULT" => "ACTIVE_FROM",
            "VALUES" => $arSortFields,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "SORT_ORDER1" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => 'как сортировка',
            "TYPE" => "LIST",
            "DEFAULT" => "DESC",
            "VALUES" => $arSorts,
            "ADDITIONAL_VALUES" => "Y",
        ],
    )
);
