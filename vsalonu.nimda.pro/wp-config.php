<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'DBVSALONU');

/** Имя пользователя MySQL */
define('DB_USER', 'dbuser');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'delpHI01work');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sj}o#epcubrRu&i18^05cg3kK?A>[ALe!QZ&gjaIuBTl?0;y~7W5QKunLAbkzw-5');
define('SECURE_AUTH_KEY',  'Q6d>2GeAd;U_Mc6ptU^ di=v]8r6ida]6%Vnu~N0}D/mXf8om-1R<qX45zeAt=g4');
define('LOGGED_IN_KEY',    'Yl@#$GIzR|hM3OY+sAR.@01Xq V8TeL#3kho~ [h.eKDUNu`nJ8&ibxWu3lG_}8O');
define('NONCE_KEY',        'haPL$#S:[83|z-?A3#:]~ho/[t`VRb3-!hG4whJb<3_%WtrC=|ioE[N@jr=9*GTg');
define('AUTH_SALT',        '(Xt!IA2N&#P.x*1J-Ng8yzS?!<}BU&5Uu@G3vGkiN=UW!(v;#AqSB 1?YFr2l8`S');
define('SECURE_AUTH_SALT', 'V7:%=_ ^5h{.^~(89>OFz7 ,O<ekBlo=~<O9LdGl5hc&J|oYT$NLnz]F/A^u8S;X');
define('LOGGED_IN_SALT',   'Z~[xjFx4a/^{{<dg<R[ [*&^vPLegYlc9j|rAR{EEk|d? Nx_ dB.YAPr-.fpiJO');
define('NONCE_SALT',       '>#M>xPo6HrP.#_,.> QwL3w6p6jHIlW=YaNz^i1sh{m?tazFZ~t%^HPNMUjn7:#k');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_mis';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
