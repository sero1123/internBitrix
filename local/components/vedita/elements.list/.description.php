<?php
// Запрещаем прямой доступ
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// Определяем массив
$arComponentDescription = array(
    "NAME" => GetMessage("NAME"), // Имя
    "DESCRIPTION" => GetMessage("DESCR"), // Описание
    "ICON" => "/images/news_all.gif", // Иконка
    "VERSION" => "1.00", // Версия
    "PATH" => array("ID" => "mir", // Расположение в виртуальном дереве компонентов
        "NAME" => GetMessage("MIR_GROUP_NAME"),
        "CHILD" => array("ID" => "system",
            "NAME" => GetMessage("SYSTEM_GROUP_NAME"),
        ),
    ),
    //"CACHE_PATH" => "Y",
    //"COMPLEX" => "Y"
);