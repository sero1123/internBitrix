<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Loader;
Loader::includeModule("sale");
Loader::includeModule("catalog");

class LoyaltyProgram extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams) {
        if(!$arParams['USER_ID'])
        {
            global $USER;
            $arParams['USER_ID'] = $USER->getID();
        }
        return $arParams;
    }
    public function executeComponent()
    {
        $sumOrderPrice = 0;
        $orders = \Bitrix\Sale\Order::getList([
            'select' => [
                'PRICE'
            ],
            'filter' => [
                '=USER_ID' => $this->arParams['USER_ID'],
                '=PAYED' => 'Y',
            ]
        ]);
        while ($order = $orders->fetch()) {
            logWrite($order);
            $sumOrderPrice  += (int)$order['PRICE'];
        }

        $this->arResult['SUM'] = $sumOrderPrice;
        $this->getLoyaltyLevel($sumOrderPrice);
        $this->IncludeComponentTemplate();
    }

    private function getLoyaltyLevel(int $sumPriceOrder): void
    {
        if($sumPriceOrder < 5000)
        { 
            $this->arResult['LOYALTY_LEVEL'] = 0;
            $this->arResult['BALANCE_TO_NEXT_LEVEL'] = 5000-$sumPriceOrder;
        }
        elseif($sumPriceOrder >= 5000 and $sumPriceOrder < 10000)
        { 
            $this->arResult['LOYALTY_LEVEL'] = 1;
            $this->arResult['BALANCE_TO_NEXT_LEVEL'] = 10000-$sumPriceOrder;

        }
        elseif($sumPriceOrder >= 10000 and $sumPriceOrder < 15000) 
        { 
            $this->arResult['LOYALTY_LEVEL'] = 2;
            $this->arResult['BALANCE_TO_NEXT_LEVEL'] = 15000-$sumPriceOrder;

        }
        elseif($sumPriceOrder >= 15000 and $sumPriceOrder < 20000)
        { 
            $this->arResult['LOYALTY_LEVEL'] = 3;
            $this->arResult['BALANCE_TO_NEXT_LEVEL'] = 20000-$sumPriceOrder;

        }
        elseif($sumPriceOrder >= 20000 and $sumPriceOrder < 25000)
        { 
            $this->arResult['LOYALTY_LEVEL'] = 4;
            $this->arResult['BALANCE_TO_NEXT_LEVEL'] = 25000-$sumPriceOrder;

        }
        elseif($sumPriceOrder >= 25000)
        { 
            $this->arResult['LOYALTY_LEVEL'] = 5;
        }
    }
}