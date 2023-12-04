<?

require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


class BonusSistem
{
    public function Sistem($id, $val)
    {
        $orderProperties = $this->definingOrderProperties($val, $id);
        $productListId = $this->gettingProductListId($id);

        if ($orderProperties["PAYED"])
        {

            $this->accrualOfBonuses($productListId, $orderProperties["USER_ID"], $val);
        }
        elseif ($orderProperties['CANCELED'] == "Y")
        {

            $this->accrualOfBonuses($productListId, $orderProperties["USER_ID"], "N");
        }
    }

    private function definingOrderProperties($val, $id)
    {

        $propertiesOrder = \Bitrix\Sale\Order::getList(
            [
                'select' => ['*'],
                'filter' => ['ID' => $id]
            ]
        )->fetch();


        if ($val == 'Y')
        {
            if ($propertiesOrder["STATUS_ID"] == "F" or  $propertiesOrder["STATUS_ID"] == "P")
            {
                $result = ["PAYED" => true, "USER_ID" => $propertiesOrder["USER_ID"], "CANCELED" => $propertiesOrder['CANCELED']];
                return $result;
            }
        }
        else return $result = ["PAYED" => false, "USER_ID" => $propertiesOrder["USER_ID"], "CANCELED" => $propertiesOrder['CANCELED']];
    }

    private function gettingProductListId($orderId)
    {
        $resultId = [];
        $order = CSaleBasket::GetList(
            ["ID" => "ASC"],
            ['=ORDER_ID' => $orderId],
            false,
            false,
            ["PRODUCT_ID"]
        );

        while ($item = $order->fetch())
        {
            $resultId[] = $item["PRODUCT_ID"];
        }

        return $resultId;
    }

    private function calculationOfBonusForProduct($productId)
    {
        $bonus = 0;

        $productProperties = CIBlockElement::GetByID($productId)->GetNextElement()->GetProperties();

        if ($productProperties['ACCRUAL_OF_BONUSES']["VALUE_XML_ID"] == "Y")
        {
            $bonus = (int)$productProperties["MINIMUM_PRICE"]["VALUE"] * BONUS_PERCENT / 100;
        }
        return $bonus;
    }

    private function accrualOfBonuses(array $productsListId, $userId, $val)
    {
        $bonusSum = 0;
        foreach ($productsListId as $id)
        {
            $bonusSum += $this->calculationOfBonusForProduct($id);
        }

        if ($val == "Y") CSaleUserAccount::UpdateAccount($userId, $bonusSum, 'RUB');
        elseif ($val == 'N')
        {
            $bonusSum = -$bonusSum;
            CSaleUserAccount::UpdateAccount($userId, $bonusSum, 'RUB');
        }
    }
}
