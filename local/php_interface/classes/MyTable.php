<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use lib\ProductsTable;
use Bitrix\Main\Engine\Contract\Controllerable;


class MyTable
{
    private $isAutorization;

    public function __construct($component = null){
        $this -> isAutorization = $this->isAutorization();
    }
    private function isAutorization()
    {
        global $USER;
        return $USER->IsAuthorized();
    }

    public function addFavorite($idElement, $userID)
    {
        if ($this->isAutorization)
        {
            ProductsTable::add(['fields' => [
                'idProduct' => "$idElement",
                'userID' => "$userID"
            ]]);
        }
        else
        {
            $_SESSION['item'][0] = [];
            $_SESSION['item'][] = [
                'idProduct' => "$idElement",
                'userID' => "$userID"
            ];
            // array_push($_SESSION, ['idProduct' => "$idElement",
            // 'userID' => "$userID"]);
        }
    }

    public function getIdFavoriteElement($idElement, $userID)
    {
        if ($this->isAutorization)
        {
            return ProductsTable::getList([
                'select' => ['id'],
                'filter' => [
                    '=idProduct' => (string) $idElement,
                    "=userID" => "$userID"
                ],
                'limit'=>1
            ])->fetch()['id'];
        }
        else
        {
            return array_search([
                'idProduct' => "$idElement",
                'userID' => "$userID"
            ], $_SESSION['item']);
        }
    }

    public function delete($idElement, $userID)
    {
        $id = $this->getIdFavoriteElement($idElement, $userID);
        if ($this->isAutorization)
        {
            ProductsTable::delete($id);
        }
        else
        {
            unset($_SESSION['item'][$id]);
        }
    }

    public function getQuantity()
    {
        return ProductsTable::getCount();
    }
}
