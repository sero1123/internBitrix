<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<style>
#treansactionTable {
width: 100%;
border-collapse: collapse;
}

#treansactionTable, .thTransaction, .tdTransaction {
border: 1px solid black;
padding: 8px;
}

.thTransaction {
background-color: #f2f2f2;
}

.trTransaction:nth-child(even) {
background-color: #f2f2f2;
}

#balance {
text-align: right;
font-weight: bold;
}
</style>


<?
global $USER;
$id = $USER->GetID();
$balance = \CSaleUserAccount::getList(array(), array('USER_ID' => 1))->Fetch()['CURRENT_BUDGET'];

?>


<h2 id="balance">Состояние счета: <?=$balance?> руб.</h2>

<table id='treansactionTable'>
<tr class = 'trTransaction'>
    <th class="thTransaction">Дата</th>
    <th class="thTransaction">Тип операции</th>
    <th class="thTransaction">Размер</th>
</tr>
<?
$res = CSaleUserTransact::GetList(Array("ID" => "DESC"), array("=USER_ID" => $id));

while ($item = $res->Fetch()){?>
    <tr class = 'trTransaction'>
        <td class="tdTransaction"><?=$item["TRANSACT_DATE"]?></td>
        <?if($item['DEBIT'] == "N") $type = 'списание'; else $type = 'начисление'?>
        <td class="tdTransaction"><?=$type?></td>
        <td class="tdTransaction"><?=$item["AMOUNT"]?></td>
    </tr>

<?}?>

</table>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
