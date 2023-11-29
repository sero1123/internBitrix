<?php

namespace lib;

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ORM\Data\DataManager,
	Bitrix\Main\ORM\Fields\IntegerField,
	Bitrix\Main\ORM\Fields\StringField,
	Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);

/**
 * Class ProductsTable
 * 
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> userID string(100) mandatory
 * <li> idProduct string(100) mandatory
 * </ul>
 *
 * @package Bitrix\Favorite
 **/

class ProductsTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'b_favorite_products';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return [
			new IntegerField(
				'id',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => Loc::getMessage('PRODUCTS_ENTITY_ID_FIELD')
				]
			),
			new StringField(
				'userID',
				[
					'required' => true,
					'validation' => [__CLASS__, 'validateUserid'],
					'title' => Loc::getMessage('PRODUCTS_ENTITY_USERID_FIELD')
				]
			),
			new StringField(
				'idProduct',
				[
					'required' => true,
					'validation' => [__CLASS__, 'validateIdproduct'],
					'title' => Loc::getMessage('PRODUCTS_ENTITY_IDPRODUCT_FIELD')
				]
			),
		];
	}

	/**
	 * Returns validators for userID field.
	 *
	 * @return array
	 */
	public static function validateUserid()
	{
		return [
			new LengthValidator(null, 100),
		];
	}

	/**
	 * Returns validators for idProduct field.
	 *
	 * @return array
	 */
	public static function validateIdproduct()
	{
		return [
			new LengthValidator(null, 100),
		];
	}
}