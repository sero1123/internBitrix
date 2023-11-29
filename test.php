<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
$test = new MyTable();
echo "<pre>";
print_r("тут текст главной ветки");
echo "</pre>";

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
