<?php
define( "_IN_INDEX", true );

define( "_INC_PATH", dirname(__FILE__) );
define( "_TEMPLATES_PATH", _INC_PATH . '/templates' );
define( "_CLASS_PATH", _INC_PATH . '/classes' );

require_once(_INC_PATH . '/functions.php' );

// Подключение вспомогательных классов
require_once(_CLASS_PATH . '/class_db.php' );
require_once(_CLASS_PATH . '/class_page.php' );
require_once(_CLASS_PATH . '/class_config_data.php' );
require_once(_CLASS_PATH . '/class_order.php');

// Конфигурация сайта
require_once(_INC_PATH . '/config.php' );

// Подключение класса партнёрской сети M1
if ( defined("_M1_ENABLED") && _M1_ENABLED ) {
	require_once ( _CLASS_PATH . "/class_cpa_m1.php" );
}