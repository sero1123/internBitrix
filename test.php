<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
echo "<pre>";
// $dbRes = \Bitrix\Sale\PropertyValueCollection::getList([
// 	'select' => ['*'],
// 	'filter' => [
// 		'=ORDER_ID' => 26, 
// 	]
// ]);
// while ($item = $dbRes->fetch())
// {
// 	print_r($item);
// }

// $dbRes = \Bitrix\Sale\Order::getList([
// 	'select' => ['*'],
// 	'filter' => [
// 		'ID' => 26, 
// 	]
// ]);
// $item = $dbRes->fetch();
// // while ($item = $dbRes->fetch())
// // {
// 	print_r($item);
// // }


CSaleStatus::GetByID()
echo "</pre>";

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
