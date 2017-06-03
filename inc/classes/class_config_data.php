<?php
defined("_IN_INDEX") or die("Access Denied");

/**
 * Подготавливает служебные данные для передачи в JSON формате
 *
 * Class ConfigData
 */
class ConfigData {

	/**
	 * Стоимость цели (руб.)
	 *
	 * @var int
	 */
	public $goal_value;
	/**
	 * Идентификатор счётчика Yandex.Metrika
	 *
	 * @var string
	 */
	public $yandex_counter;
	/**
	 * Идентификатор события Yandex.Metrika
	 *
	 * @var string
	 */
	public $yandex_goal;
	/**
	 * Идентификатор счётчика Mail.ru
	 *
	 * @var string
	 */
	public $mail_ru_counter;
	/**
	 * Идентификатор события Mail.ru
	 *
	 * @var string
	 */
	public $mail_ru_goal;
	/**
	 * Категория цели Google.Analytics
	 *
	 * @var string
	 */
	public $google_category;
	/**
	 * Категория цели Google.Analytics
	 *
	 * @var string
	 */
	public $google_goal;
	/**
	 * Тип цели для Facebook
	 *
	 * @var string
	 */
	public $facebook_goal;
	/**
	 * Экземпляр текущего класса
	 *
	 * @var ConfigData
	 */
	public static $INSTANCE = null;


	/**
	 * ConfigData constructor.
	 */
	public function __construct() {

		// Заполнение переменных
		$this->goal_value           = _GOAL_VALUE;

		$this->yandex_counter       = _COUNTER_YANDEX;
		$this->yandex_goal          = _GOAL_YANDEX;

		$this->mail_ru_counter      = _COUNTER_MAIL;
		$this->mail_ru_goal         = _GOAL_MAIL_RU;

		$this->google_category      = _GOAL_GA_CATEGORY;
		$this->google_goal          = _GOAL_GA_GOAL;

		$this->facebook_goal        = _GOAL_FACEBOOK;


		// __construct
	}


	public function get_json() {

		return json_encode( $this );

		// get_json
	}


	/**
	 * Возвращает экземпляр текущего класса. При необходимости
	 * создаёт его.
	 *
	 * @return ConfigData
	 */
	public static function get_instance() {

		if ( self::$INSTANCE == null ) {
			self::$INSTANCE = new ConfigData();
		}

		return self::$INSTANCE;

		// get_instance
	}


	/**
	 * Выдаёт ответ в формате JSON
	 *
	 * @return void
	 */
	public static function get_response() {

		echo self::get_instance()->get_json();

		// get_response
	}
}