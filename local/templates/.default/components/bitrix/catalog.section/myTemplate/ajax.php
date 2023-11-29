<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

use MyTable;
$table = new MyTable;
echo 'зашел';

if ($_POST['action'] == 'add'){
    $table->addFavorite($_POST['elementId'], $_POST['userId']);
    echo 'добавил';
    print_r($_SESSION);


}elseif($_POST['action'] == 'remove'){
    $table->delete($_POST['elementId'], $_POST['userId']);
    echo 'удалил';
    print_r($_SESSION);


}