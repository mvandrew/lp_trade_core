<?php
defined("_IN_INDEX") or die("Access Denied");

require_once( _INC_PATH . "/mailer/PHPMailerAutoload.php" );

/**
 * Обработка поступающих заказов
 *
 * Class Order
 */
class Order {

	/**
	 * Имя клиента
	 *
	 * @var string
	 */
	public $cust_name;
	/**
	 * Номер телефона клиента
	 *
	 * @var string
	 */
	public $cust_phone;
	/**
	 * Признак для проверки на предмет бота
	 *
	 * @var string
	 */
	public $key;
	/**
	 * IP адрес заказчика
	 *
	 * @var string
	 */
	public $ip_address;
	/**
	 * Наименование товара
	 *
	 * @var string
	 */
	public $item;
	/**
	 * Количество
	 *
	 * @var int
	 */
	public $qty;
	/**
	 * Цена
	 *
	 * @var int
	 */
	public $price;
	/**
	 * Стоимость заказа
	 *
	 * @var int
	 */
	public $amount;
	/**
	 * Домен лендинга
	 *
	 * @var string
	 */
	public $site;
	/**
	 * Признак спамного заказа
	 *
	 * @var int
	 */
	public $is_fake;
	/**
	 * Партнёрская сеть
	 *
	 * @var string
	 */
	public $cpa;

	/**
	 * Determination of the real IP address.
	 *
	 * @return string
	 */
	public static function get_real_ip() {

		$res = $_SERVER["REMOTE_ADDR"];
		if ( $res == '127.0.0.1' && @$_SERVER['HTTP_X_REAL_IP'] != '' ) {
			$res = @$_SERVER['HTTP_X_REAL_IP'];
		}

		return $res;

		// get_real_ip
	}

	/**
	 * Order constructor.
	 */
	public function __construct() {

		// Получение данных заказчика
		$this->cust_name = Page::get_query_value("name");
		$this->cust_phone = Page::get_query_value("phone");
		$this->key = Page::get_query_value("mode");
		$this->ip_address = self::get_real_ip();
		$this->item = Page::get_query_value("item");
		$this->site = $_SERVER["HTTP_HOST"];
		$this->is_fake = $this->key == "" ? 1 : 0;
		$this->cpa = Page::get_query_value("cpa");

		$test_pattern = '/^\d+$/';
		$this->qty = Page::get_query_value("qty");
		if ( !preg_match($test_pattern, $this->qty) ) {
			$this->qty = 1;
		}

		$this->price = Page::get_query_value("price");
		if ( !preg_match($test_pattern, $this->price)) {
			$this->price = _INV_PRICE;
		}

		$this->amount = ceil( $this->qty * $this->price );

	} // __construct

	/**
	 * Регистрация заказа в БД
	 *
	 * @return void
	 */
	public function db_register() {

		$query = "INSERT INTO orders "
		         . "(name, phone, reg_date, ip_address, is_fake, item, qty, price, amount, site, cpa) "
		         . "VALUES ('$this->cust_name', '$this->cust_phone', NOW(), '$this->ip_address', $this->is_fake, "
		         . "'$this->item', '$this->qty', $this->price, $this->amount, '$this->site', '$this->cpa')";
		if (DB::get_instance()->connected) {
			DB::get_instance()->db->query($query);
		}

	} // db_register

	/**
	 * Отправка заказа на почту
	 *
	 * @return void
	 */
	public function mail_order() {

		$cur_date = new DateTime();

		$subject = sprintf( "Заказ Товара: %s от %s %s", $this->item, $this->cust_name, $this->cust_phone );

		$message_format = "<p>Заказ Товара: %s</p>"
		                  ."<p>Дата заказа: %s</p>"
		                  ."<p>Заказчик: %s</p>"
		                  ."<p>Номер телефона: %s</p>"
		                  ."<p>Количество: %d</p>"
		                  ."<p>Цена: %s</p>"
		                  ."<p>Сумма заказа: %s</p>"
		                  ."<p>Лендинг: %s</p>"
		                  ."<p>IP адрес заказчика: %s</p>"
		                  ."<p>Фейковый заказ: %s</p>"
		                  ."<p>CPA сеть: %s</p>";
		$message = sprintf( $message_format,
			$this->item,
			$cur_date->format("H:i:s d.m.Y"),
			$this->cust_name,
			$this->cust_phone,
			$this->qty,
			number_format($this->price, 0, ',', ' '),
			number_format($this->amount, 0, ',', ' '),
			$this->site,
			$this->ip_address,
			$this->is_fake == 1 ? "Да" : "Нет",
			$this->cpa);


		$mail = new PHPMailer();
		$mail->CharSet = 'utf-8';
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = _MAIL_HOST;
		$mail->Port = _MAIL_PORT;
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = 'ssl';
		$mail->Username = _MAIL_USER;
		$mail->Password = _MAIL_PASS;
		$mail->setFrom(_MAIL_USER);
		$mail->addAddress(_MAIL_ORDER);
		$mail->Subject = $subject;
		$mail->msgHTML($message);

		$mail->send();

	} // mail_order

	/**
	 * Запускает процесс обработки заказа
	 *
	 * @return void
	 */
	public static function process() {

		$order = new Order();

		if ( trim($order->cust_name) != '' && trim($order->cust_phone) != '' ) {
			$order->db_register();
			$order->mail_order();
			if ($order->is_fake == 1) {
				$target_url = '/thanks-maybe.php';
			} else {
				$target_url = '/thanks.php';
			}
		} else {
			$target_url = '/';
		}

		header('Location: ' . $target_url);

	} // process

	/**
	 * Отображает скрытые поля формы заказа
	 *
	 * @return void
	 */
	public static function order_form_fields() {

		$file_name = _TEMPLATES_PATH . "/order.fields.php";
		if ( file_exists($file_name) ) {
			include ($file_name);
		}

		// order_form_fields
	}

}