<?
CModule::AddAutoloadClasses('', [
    "itemsManipulation" => "/local/php_interface/classes/classItems.php",
    "lib\ProductsTable" => "/local/php_interface/classes/ProductsTable.php",
    'MyTable' => "/local/php_interface/classes/MyTable.php",
    'BonusSistem' => "/local/php_interface/classes/BonusSistem.php",
    'CreatingAPromo' => "/local/php_interface/classes/CreatingAPromo.php",
    'CheckingPromo' => "/local/php_interface/classes/CheckingPromo.php",

]);


require_once("const.php");
require_once('functions.php');
require_once('events.php');
