<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use lib\ProductsTable;
use Bitrix\Main\Engine\Contract\Controllerable;

class MyTable implements Controllerable
{

    public function addFavorite($idElement, $userID)
    {
        lib\ProductsTable::add(['fields' => ['idProduct' => "$idElement",
                                            'userID' => "$userID"]]);
    }

    public function getIdFavoriteElement($idElement, $userID){
        return lib\ProductsTable::getList(['select' => ['id'],
                                            'filter' => ['=idProduct' => "$idElement",
                                                        "=userID" => "$userID"]])->fetchAll()[0]['id'];
    }

    public function delete($idElement, $userID)
    {
        $id = $this->getIdFavoriteElement($idElement, $userID);
        lib\ProductsTable::delete($id);
    }


    public function getQuantity(){
        return lib\ProductsTable::getCount();
    }

    public function addToFavoritesAction($idElement, $userID){
        $this->addFavorite($idElement, $$userID);
    }

    public function removeFromFavorites($idElement, $userID){
        $this->delete($idElement, $userID);
    }

    public function configureActions()
    {
        return [
            'getItem' => [
                'prefilters' => [],
                'postfilters' => []
            ]
        ];
    }
}
