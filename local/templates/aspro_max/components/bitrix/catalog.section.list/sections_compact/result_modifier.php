<?php
global $arRegion;
if( isset($arParams["ASPRO_COUNT_ELEMENTS"]) && $arParams["ASPRO_COUNT_ELEMENTS"] === "Y" ){
	foreach($arResult["SECTIONS"] as &$arSection){
		$arOrder = [
			'CACHE' => [
				'MULTI' => 'N', 
				'TAG' => CMaxCache::GetIBlockCacheTag($arParams["IBLOCK_ID"])
			]
		];

		$elementCountFilter = [
			'IBLOCK_ID' => $arSection['IBLOCK_ID'],
			'SECTION_ID' => $arSection['ID'],
			'CHECK_PERMISSIONS' => 'Y',
			'MIN_PERMISSION' => 'R',
			'INCLUDE_SUBSECTIONS' => 'Y',
			'ACTIVE' => 'Y',
		];

		if( $arParams['HIDE_NOT_AVAILABLE'] === 'Y' )
			$elementCountFilter['AVAILABLE'] = 'Y';

		$arFilter = $elementCountFilter;

		CMax::makeElementFilterInRegion($arFilter);

		if( is_array($GLOBALS['arRegionLink']) && CMax::GetFrontParametrValue('REGIONALITY_FILTER_ITEM') == 'Y' && CMax::GetFrontParametrValue('REGIONALITY_FILTER_CATALOG') == 'Y' ){
			$arFilter = array_merge($GLOBALS['arRegionLink'], $arFilter);
		}

		if( $arRegion ){			
			if( $arRegion['LIST_STORES'] && $arParams['HIDE_NOT_AVAILABLE'] === 'Y' ){
				$arStoresFilter = [];

				if(CMax::checkVersionModule('18.6.200', 'iblock')){
					$arStoresFilter = [
						'STORE_NUMBER' => $arParams['STORES'],
						'>STORE_AMOUNT' => 0,
					];
				}else{
					if(count($arParams['STORES']) > 1){
						$arStoresFilter = ['LOGIC' => 'OR'];

						foreach($arParams['STORES'] as $storeID){
							$arStoresFilter[] = [">CATALOG_STORE_AMOUNT_".$storeID => 0];
						}
					}else{
						foreach($arParams['STORES'] as $storeID){
							$arStoresFilter = [">CATALOG_STORE_AMOUNT_".$storeID => 0];
						}
					}
				}

				$arTmpFilter = [ '!TYPE' => ['2', '3'] ];
				
				if($arStoresFilter){
					if(!CMax::checkVersionModule('18.6.200', 'iblock') && count($arStoresFilter) > 1){
						$arTmpFilter[] = $arStoresFilter;
					}else{
						$arTmpFilter = array_merge($arTmpFilter, $arStoresFilter);
					}
				}

				$arFilter[] = [
					'LOGIC' => 'OR',
					['TYPE' => ['2', '3']],
					$arTmpFilter,
				];
			}
		}

		$countElements = CMaxCache::CIBlockElement_GetList($arOrder, $arFilter, []);

		$arSection['ELEMENT_CNT'] = $countElements;
	}
}
?>