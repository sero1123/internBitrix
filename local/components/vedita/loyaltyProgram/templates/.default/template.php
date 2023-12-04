

<p>ваш текущий уровень скидки <?=$arResult['LOYALTY_LEVEL']*2?> %</p>
<?if($arResult['BALANCE_TO_NEXT_LEVEL']){?>
    <p>До скидки <?=($arResult['LOYALTY_LEVEL']+1)*2?> % осталось оплатить <?=$arResult['BALANCE_TO_NEXT_LEVEL']?></p>
    <?}?>
<table id = 'loyaltyProgramTable'>
<tr class='loyaltyProgramTr'>
    <th class='loyaltyProgramTh'>Размер скидки</th>
    <th class='loyaltyProgramTh'>Сумма заказа</th>
</tr>
<tr class='loyaltyProgramTr'>
    <td class='loyaltyProgramTd percentLoyalty' data-level = '0'>0%</td>
    <td class='loyaltyProgramTd'>до 5000 руб</td>
</tr>
<tr class='loyaltyProgramTr'>
    <td class='loyaltyProgramTd percentLoyalty' data-level = '1'>2%</td>
    <td class='loyaltyProgramTd'>5000-10000 руб</td>
</tr>
<tr class='loyaltyProgramTr'>
    <td class='loyaltyProgramTd percentLoyalty' data-level = '2'>4%</td>
    <td class='loyaltyProgramTd'>10000-15000 руб</td>
</tr>
<tr class='loyaltyProgramTr'>
    <td class='loyaltyProgramTd percentLoyalty' data-level = '3'>6%</td>
    <td class='loyaltyProgramTd'>15000-20000 руб</td>
</tr>
<tr class='loyaltyProgramTr'>
    <td class='loyaltyProgramTd percentLoyalty' data-level = '4'>8%</td>
    <td class='loyaltyProgramTd'>20000-25000 руб</td>
</tr>
<tr class='loyaltyProgramTr'>
    <td class='loyaltyProgramTd percentLoyalty' data-level = "5" >10%</td>
    <td class='loyaltyProgramTd'>25000+ руб</td>
</tr>
</table>
<script>
    $(document).ready(function(){
        $('.loyaltyProgramTr').removeClass('highlighted');
        
        $('.percentLoyalty[data-level="' + <?=$arResult['LOYALTY_LEVEL']?> + '"]').closest('tr').css({
            'color' : 'white',
            'background-color' : 'black',
        })
    })


</script>