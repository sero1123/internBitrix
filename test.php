<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
echo "<pre>";

$dbRes = \Bitrix\Sale\Order::getList([
	'select' => ['*'],
	'filter' => [
		'ID' => 26, 
	]
])->fetch();

print_r($dbRes);

// $status = CSaleStatus::GetByID('26');

// print_r($status);
echo "</pre>";

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
