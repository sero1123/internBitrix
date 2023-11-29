<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<button class="btn">нажать</button>

<table id="content">
<tr>
    <td>имя</td>
    <td>ид</td>
    <td>код</td>
    <td>дата создания</td></tr>
</table>
<script>;
    $(document).ready(function (){
    BX.ajax.runComponentAction("vedita:elements.list",
        "getItems", {
            mode: 'class',
            data: {             itemId: 4,
                userId: 5
            },
        })
        .then(function(response) {
            if (response.status === 'success') {
                console.log(response);
                getItem(response.data);
            }
         })});
    function getItem(arr){
        var i, len;
        console.log(arr);

        for (i = 0, len = arr.length; i<len; ++i) {

            $('#content').append($("<tr></tr>").append
                            ($("<td></td>").html(arr[i]['NAME']),
                            $("<td></td>").html(arr[i]['ID']),
                            $("<td></td>").html(arr[i]['CODE']),
                            $("<td></td>").html(arr[i]['DATE_CREATE']),
                            ))}
        }
</script>

