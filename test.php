<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
$test = new MyTable();
echo "<pre>";
print_r("тут новый текст новой ветки");
echo "</pre>";

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
