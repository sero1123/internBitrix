<?
$month = date('m'); 
$year = date("Y"); 
$firstDayOfMonth = date("N", strtotime("$year-$month-01"));
?>

<div id="pop" class="modalMy">
  <div>
    <p id='detail'></p>
    <img src="" id="image">
    <p id="an"></p>
    <button id="close">close</button>
  </div>
</div>

<ul class="weekdays">
<li>Пн</li>
<li>Вт</li>
<li>Ср</li>
<li>Чт</li>
<li>Пт</li>
<li>Сб</li>
<li>Вс</li>
</ul>

<ul class="days">
    <? for ($i = 1; $i < $firstDayOfMonth; $i++){?>
        <li></li>
    <?}?>

    <? foreach($arResult['dateItems'] as $key=>$value){?>
        <li>
            <?=$key?><br>
            <?foreach($value as $event){?>
                <button data-value = "<?=$event["ID"]?>"  data-id-hl = '<?=$arParams['HL_ID']?>' onclick="getItem(this)"><?=$event['UF_NAME']?></button> <br>
                <?}?>
        </li>
        <?}?>
<li></li>
</ul>



<script>
    function getItem(Element){
        console.log(Element.dataset.value)

    $(document).ready(function (){
        BX.ajax.runComponentAction("vedita:events",
            "getItem", {
                mode: 'class',
                data: {id:Element.dataset.value,
                        hlId :Element.dataset.idHl
                },
            })
            .then(function(response) {
                if (response.status === 'success') {
                    console.log(response);
                    popUp(response, Element)
                }
            })});
    }

    function popUp(response, Element){
        $("#an").empty();
        $("#an").append(response.data["nameS"]);  

        $("#detail").empty();
        $("#detail").append(response.data['UF_DETAIL']);

        $("#image").empty();
        $("#image").attr('src', response.data["image"]);  



        $("#pop").show();
    }

    $(document).ready(function(){
        $("#close").click(function(){
            $("#pop").hide();
        })
    })



</script>