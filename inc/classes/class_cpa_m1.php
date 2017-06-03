<?php
defined("_IN_INDEX") or die("Access Denied");

/**
 * Операции взаимодействия с партнёрской сетью M1
 * Class cpaM1
 */
class cpaM1 {

	/**
	 * Представление экземпляра текущего класса
	 *
	 * @var cpaM1
	 */
	private static $instance = null;
	/**
	 * Цена текущая
	 *
	 * @var int
	 */
	public $price;
	/**
	 * Цена старая
	 *
	 * @var int
	 */
	public $old_price;
	/**
	 * Стоимость доставки
	 *
	 * @var int
	 */
	public $delivery;

	/**
	 * Возвращает экземпляр текущего класса. При необходимости, создаёт его.
	 *
	 * @return cpaM1
	 */
	public static function get_instance() {
		if (self::$instance == null) {
			self::$instance = new cpaM1();
		}
		return self::$instance;
	}

	/**
	 * cpaM1 constructor.
	 */
	public function __construct() {

		$this->price = _INV_PRICE;
		$this->old_price = _INV_OLD_PRICE;
		$this->delivery = _INV_DELIVERY;


		//
		// Получение цены от M1
		//
		$url = "http://m1-shop.ru/form_lending.js?p=" . _M1_PRODUCT;
		$data = @file_get_contents($url);
		$param = (array) json_decode($data);

		// Текущая цена
		if ( isset($param['priceLand']) ) {
			$this->price = (int)$param['priceLand'];
			if ($this->price <= 0) {
				$this->price = _INV_PRICE;
			}
		}

		// Старая цена
		if ( isset($param['priceOldLand']) ) {
			$this->old_price = (int)$param['priceOldLand'];
			if ($this->old_price <= 0) {
				$this->old_price = _INV_PRICE;
			}
		}

		// Стоимость доставки
		if ( isset($param['deliverLand']) ) {
			$this->delivery = (int)$param['deliverLand'];
			if ($this->delivery <= 0) {
				$this->delivery = _INV_PRICE;
			}
		}

		// __construct
	}


	/**
	 * Возвращает процент скидки
	 *
	 * @return float|int
	 */
	public function get_discount() {

		$res = 0;

		if ($this->old_price > 0 && $this->price > 0) {
			$res = 100 - round($this->price * 100 / $this->old_price, 0);
		}

		return $res;

		// get_discount
	}

}