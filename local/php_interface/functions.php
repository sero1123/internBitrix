<?

use Bitrix\Main\Type\DateTime;
function testPrint()
{
    echo '123';
}

function logWrite($data)
{
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/log.txt', var_export($data, true));
}

function getIdb2bBayerGroup()
{
    $gr = CGroup::GetList();
    while ($group = $gr->NavNext())
    {
        if ($group['STRING_ID'] === 'b2b')
        {
            return $group["ID"];
        }
    }
}

function getIdb2cBayerGroup()
{
    $gr = CGroup::GetList();
    while ($group = $gr->NavNext())
    {
        if ($group['STRING_ID'] === 'b2c')
        {
            return $group["ID"];
        }
    }
}

function isTheUserAb2bBuyer()
{
    global $USER;
    $arrIdGroupUser = $USER->GetUserGroupArray();
    $b2bGroupId = getIdb2bBayerGroup();
    return in_array($b2bGroupId, $arrIdGroupUser);
}

function isTheUserAb2cBuyer()
{
    global $USER;
    $arrIdGroupUser = $USER->GetUserGroupArray();
    $b2cGroupId = getIdb2cBayerGroup();
    return in_array($b2cGroupId, $arrIdGroupUser);
}

function isTheUserAb2cBuyerById($userId)
{
    $arrIdGroupUser = CUser::GetUserGroup($userId);
    $b2cGroupId = getIdb2cBayerGroup();
    return in_array($b2cGroupId, $arrIdGroupUser);
}

function isTheUserAb2bBuyerById($userId)
{
    $arrIdGroupUser = CUser::GetUserGroup($userId);
    $b2bGroupId = getIdb2bBayerGroup();
    return in_array($b2bGroupId, $arrIdGroupUser);
}

function getEntityData($orderId)
{
    $arResult = [];
    $dbRes = \Bitrix\Sale\PropertyValueCollection::getList([
        'select' => ['*'],
        'filter' => [
            '=ORDER_ID' => $orderId,
        ]
    ])->fetchAll();
    foreach ($dbRes as $value)
    {
        if ($value['CODE'] == 'COMPANY')
        {
            $arResult['COMPANY_NAME'] = $value['VALUE'];
        }
        if ($value['CODE'] == 'INN')
        {
            $arResult['INN'] = $value['VALUE'];
        }
        if ($value['CODE'] == 'PHONE')
        {
            $arResult['TELEPHONE'] = $value['VALUE'];
        }
    }
    return $arResult;
}

function checkingBonuses()
{
    $listOrder = \Bitrix\Sale\Order::getList([
        'select' => ['*'],
        'filter' =>
        [
            '<=DATE_UPDATE' => DateTime::createFromTimestamp(strtotime("-2	days")),
            '>=DATE_UPDATE' => DateTime::createFromTimestamp(strtotime("-3	days")),
        ]
    ]);

    while ($order = $listOrder->fetch())
    {
        $payed = $order["PAYED"];
        $id = (int) $order["ID"];
        $bonus = new BonusSistem;
        if (
            $order["DATE_UPDATE"] > DateTime::createFromTimestamp(strtotime("-2	days")) &&
            $order["DATE_UPDATE"] < DateTime::createFromTimestamp(strtotime("-3	days"))
        )
        {
            $bonus->Sistem($id, $payed);
        }
        else $bonus->Sistem($id, "N");
    }
    return 'checkingBonuses();';
}
