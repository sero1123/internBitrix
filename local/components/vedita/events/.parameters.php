<?php
// Запрещаем прямой доступ
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Подключаем модуль информационных блоков
//if(!CModule::IncludeModule("iblock"))
//    return;


use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

if (!Loader::includeModule("highloadblock")) {
    ShowError("Module 'highloadblock' is not installed");
    return;
}


// Массив описаний параметов компонента
$arComponentParameters = array(
    // Группы
    "GROUPS" => array(
        "HL_PARAMS" => array(
            "NAME" => GetMessage("HL_PARAMS_NAME")
        )
    ),
    // Массив описания параметров
    "PARAMETERS" => array(
        // ID хайблока
        "HL_ID" => array(
            "PARENT" => "HL_PARAMS",
            "NAME" => "id блока",
            "TYPE" => "STRING",
        ),
    )
);
