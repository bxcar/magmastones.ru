<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
define("WP_CACHE", true);
// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'm3311yfo_magma');

/** Имя пользователя MySQL */
define('DB_USER', 'm3311yfo_magma');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '60J*P3zn');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '!YnP!Vr,aXqpnPqy$ulo{4:ZNARC{F4&Z74@t^cjouKxga>+Cb5Iq*!)Yq$]d7e-');
define('SECURE_AUTH_KEY',  'COIe8ad;S^;Po8 oI%Y,[7cDR`~Os1hVq:H:=?g8(Nt3`$L0B{p4n8vc>;N(OJxg');
define('LOGGED_IN_KEY',    '81K% ;NRHF&5>Zj^Aj~n]PeE55}:<AE@Sl:T=)]M,-G7b Wn2Xbk4;E-~yV%::1Z');
define('NONCE_KEY',        'F0Gy>.%6v7#Y}tNROVzo$KtZQx$MN2{VjV@t^Qi7A*Dja0GH2V$3Hd..|A&v=M(M');
define('AUTH_SALT',        '}iCqku5mKm.85sjN}Z<poN8HqS=2sW#:H}w&F9QixC!fIj6Q?;E_wZlu0>QqzbJ(');
define('SECURE_AUTH_SALT', 'lMp,bm?gu;36,[i$!h%85DI<fCj&/r3_sWrTT)F%(;i[,k7wHz)$pGu?-AuW1,6/');
define('LOGGED_IN_SALT',   'BOyEX:mZm2/)-O3{Ba3h]87A~/%&P9cFYGOo6:LiaxjORH<`RvJKJlOt%&ct4_Hc');
define('NONCE_SALT',       'f8uB+UJ.^n;Si7o/YZt@!@D,h/VK7L?mmq)K1:}|`6p2BG?oj`Fe?J0@1V4Ir/H`');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'jegu3_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
