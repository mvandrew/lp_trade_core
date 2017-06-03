<?php
defined("_IN_INDEX") or die("Access Denied");

/**
 * Created by PhpStorm.
 * User: msav
 * Date: 21.05.2017
 * Time: 22:42
 */
class DB {

	/**
	 * Экземпляр текущего класса доступа к БД
	 *
	 * @var DB
	 */
	private static $instance = null;
	/**
	 * Состояние выполнения соединения с БД
	 *
	 * @var bool
	 */
	public $connected;
	/**
	 * Экземпляр доступа к БД
	 *
	 * @var mysqli
	 */
	public $db;
	public $connection_error;

	public function __construct() {

		$this->connected = false;

		// Пытаемся подключиться в БД
		$this->db = new mysqli(_DB_HOST, _DB_USER, _DB_PASSWORD, _DB_CATALOG);
		if ($this->db->connect_errno) {
			$this->connection_error = $this->db->connect_errno;
			$this->connected = false;
			$this->db = null;
		} else {
			$this->connection_error = "";
			$this->connected = true;
			$this->db->query("set names utf8");
		}

	} // __construct

	/**
	 * Возвращает текущий экземпляр доступа к БД.
	 *
	 * При необходимости выполняет процедуру инициализации.
	 *
	 * @return DB
	 */
	public static function get_instance() {

		if (self::$instance == null)
			self::$instance = new DB();

		return self::$instance;

	} // get_instance

}