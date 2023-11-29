<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
echo "<pre>";
$result = $arResult["NAV_RESULT"]->arResult;
use MyTable;
global $USER;
$classTable = new MyTable;
$userId = $USER->GetID();


echo "</pre>";?>
<?foreach($result as $value){?>
	<div>
		<p><?=$value['NAME']?></p>
		<? if ($classTable->getIdFavoriteElement($value['ID'], $userId)){?>
			<button data-id = <?=$value['ID']?> onclick="removeFromFavorites(this)">удалить из избранного</button>
		<?}else{?>
			<button data-id = <?=$value['ID']?> onclick="addFavorites(this)">добавить в избранное</button>
		<?}?>
	</div>
<?}?>

<?var_dump($classTable->getIdFavoriteElement(3054651456, 1))?>

<script>
	function addFavorites(element){
		console.log(element);
		$.ajax({
			method: "POST",
			url: "/local/templates/.default/components/bitrix/catalog.section/myTemplate/ajax.php",
			data: {'elementId' : element.dataset.id,
					'userId' : <?=$userId?>,
					'action': 'add'},
			success : function(){
				$(element).empty()
				$(element).append('удалить из избранного')
				$(element).attr('onclick', "removeFromFavorites(this)")
			}
		})

	}

	function removeFromFavorites(element){
		console.log(element);
		$.ajax({
			method: "POST",
			url: "/local/templates/.default/components/bitrix/catalog.section/myTemplate/ajax.php",
			data: {'elementId' : element.dataset.id,
					'userId' : <?=$userId?>,
					'action': 'remove'},
			success : function(){
				$(element).empty()
				$(element).append('добавить в избранное')
				$(element).attr('onclick', "addFavorites(this)")
			}
		})


	}
</script>