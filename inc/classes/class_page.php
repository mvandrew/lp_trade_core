<?php
defined("_IN_INDEX") or die("Access Denied");
/**
 * Created by PhpStorm.
 * User: msav
 * Date: 21.05.2017
 * Time: 20:19
 */
class Page {

	/**
	 * Открывает обработку страницы
	 *
	 * @return void
	 */
	public static function start() {

		ob_start();

	} // start

	/**
	 * Завершает обработку страницы
	 *
	 * @return void
	 */
	public static function finish() {

		$output = ob_get_clean();
		// Ставим условие обработки только HTML файлов
		if ( preg_match( '/^\<!doctype html/u', mb_strtolower( $output ) ) && _CFG_COMPRESS_HTML ) {

			// Удаление переносов строк и табуляций
			$pattern = '/(\n\r|\n|\r|\t)/u';
			$output  = preg_replace( $pattern, ' ', $output );

			// Удаление дублей пробелов
			$pattern = '/[\s]+/u';
			$output  = preg_replace( $pattern, ' ', $output );

			// Удаление пробелов между тэгами
			$pattern = '/>\s</u';
			$output  = preg_replace( $pattern, '><', $output );

			// Удаление HTML комментариев
			$pattern = '/<!--\s*[^\[]([\s\S]*?)\s*-->/u';
			$output  = preg_replace( $pattern, '', $output );
		}
		echo $output;

		// finish
	}

	/**
	 * Возвращает безопасное значение переменной из запроса пользователя.
	 *
	 * @param string $name - Идентификатор переменной
	 *
	 * @return string
	 */
	public static function get_query_value($name) {

		if (isset($_POST[$name])) {
			$value = $_POST[$name];
		} elseif (isset($_GET[$name])) {
			$value = $_GET[$name];
		} else {
			$value = '';
		}

		if ($value != '') {
			$value = DB::get_instance()->db->real_escape_string($value);
			$value = stripslashes($value);
			$value = htmlentities($value);
			$value = strip_tags($value);
		}

		return $value;

		// get_query_value
	}


	/**
	 * Выводит счётчики Яндекс Метрика и Google Analytics
	 *
	 * @return void
	 */
	public static function counters() {

		//
		// Яндекс Метрика
		//
		if ( defined( "_COUNTER_YANDEX" ) && _COUNTER_YANDEX != "" ) {
			include (_TEMPLATES_PATH . "/yandex.metrika.php");
		}


		//
		// Google Analytics
		//
		if ( defined( "_COUNTER_GOOGLE") && _COUNTER_GOOGLE != "" ) {
			include (_TEMPLATES_PATH . "/google.analytics.php");
		}


		//
		// TOP Mail.Ru
		//
		if ( defined( "_COUNTER_MAIL" ) && _COUNTER_MAIL != "" ) {
			include (_TEMPLATES_PATH . "/top.mail.ru.php");
		}

		// counters
	}

	/**
	 * Выводит код эксперимента Google
	 *
	 * @param $key
	 * @return void
	 */
	public static function google_experiment($key) {

		global $ge_key;
		$ge_key = $key;
		include (_TEMPLATES_PATH . "/google_experiment.php");

		// google_experiment
	}

	/**
	 * Отображает дополнительные сведения для тэга body.
	 *
	 * Используется для передачи данных взаимодействия с CPA сетями.
	 *
	 * @return void
	 */
	public static function body_data() {

		$result = '';

		if ( defined("_M1_ENABLED") && _M1_ENABLED ) {
			$result .= ' data-ref="' . _M1_REF . '"'
			           . ' data-product="' . _M1_PRODUCT . '"'
			           . ' data-link="' . _M1_LINK . '"';
		}

		echo $result;

		// body_data
	}


	/**
	 * Форматирует стоимость для представления на сайте.
	 *
	 * @param $price float
	 *
	 * @return string
	 */
	public static function format_price($price) {
		return number_format($price, 0, ',', '&nbsp;');
	}


	/**
	 * Формирует тэги для отображения иконок в шапке сайта.
	 *
	 * @return string
	 */
	public static function favicon() {

		$root_path = $_SERVER['DOCUMENT_ROOT'];
		$result = '';

		$icons = array(
			array( "type" => "image/png", "file" => "favicon.png" ),
			array( "type" => "image/x-icon", "file" => "favicon.ico" )
		);

		foreach ( $icons as $icon ) {
			if ( file_exists($root_path . '/' . $icon['file']) ) {
				$result .= '<link rel="shortcut icon" type="' . $icon['type'] . '" href="/' . $icon['file'] . '">';
			}
		}

		return $result;

		// favicon
	}


	/**
	 * Подключает локальную версию файла.
	 *
	 * @param $file_name string
	 * @return void
	 */
	public static function include_template_local_file( $file_name ) {

		$path = dirname($file_name);
		$file = basename($file_name);

		$local_file = $path . '/local.' . $file;

		if ( file_exists($local_file) ) {
			include ($local_file);
		}

		// include_template_local_file
	}

}