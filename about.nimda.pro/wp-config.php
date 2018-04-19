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
             define('DB_NAME', 'DBMAIN');

             /** Имя пользователя MySQL */
             define('DB_USER', 'dbuser');

             /** Пароль к базе данных MySQL */
             define('DB_PASSWORD', 'delpHI01work');

             /** Имя сервера MySQL */
             define('DB_HOST', 'localhost');

 /** Кодировка базы данных для создания таблиц. */
define('DB_HOST', 'localhost');
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
                     define('AUTH_KEY',         ']B|FH(= S%rSR9sU|jgEU%!i8F^.FP~y?Sq-<=W]9}]t|n&l.q5)]=+>B&QQ!j|r');
                     define('SECURE_AUTH_KEY',  ';rw<^Qr-|7H.S+u(2x3iG) [MEZU;1aWWP|f{ne]dK1+4A.]n1^H2yk_pwZ:}+}D');
                     define('LOGGED_IN_KEY',    'M2JL!|.2MlR!jRLHQq.)BUe5s!s][yiX/rORS,~WC}{(rUUHy$b(HU(EaZ,~,Jl+');
                     define('NONCE_KEY',        'y(,3~+(#^G8|N)$0k|VWp:U9Lr!?m>l(:[7}:,*s&eNha;P-hL<d@t0+;Yu2P)&E');
                     define('AUTH_SALT',        '7TK+?L`|_t>ZAbQ0>N?A4?M0XyIOD&(PKZ<$OM3+a$ %`4ao-Tl#YfH]!H9ASYj=');
                     define('SECURE_AUTH_SALT', ']U,1EB=pu+6T=tgz[Gu4!|S*1lK6(96lXu,Tw/;p/24QThwzvmpD-@$|M3Tanb$N');
                     define('LOGGED_IN_SALT',   'FIOHO#+hz67TbLNjZlq[-F5%wV3q| !pM4/dynS];eYh#}R[1.~Gp*J.u=6$&,TC');
                     define('NONCE_SALT',       '; H4-LFuR|.H;!+xl|pUIRrS  5nH-3G(rb;EYRI8(#tlUh)R:2E6O(z@w_}@s66');

                 /**#@-*/

                     /**
                      * Префикс таблиц в базе данных WordPress.
                       *
                        * Можно установить несколько блогов в одну базу данных, если вы будете использовать
                         * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
  */
 $table_prefix  = 'fuck_';

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

define('FS_CHMOD_DIR', ( 0755 & ~ umask() ));
define('FS_CHMOD_FILE', ( 0644 & ~ umask() ));

define('WP_TEMP_DIR', '/var/www/html/about.nimda.pro/tmp');

define('FS_METHOD', 'ftpext');
define('FTP_BASE', '/var/www/html/about.nimda.pro/');
define('FTP_CONTENT_DIR', '/var/www/html/about.nimda.pro/wp-content/');
define('FTP_PLUGIN_DIR ', '/var/www/html/about.nimda.pro/wp-content/plugins/');
define('FTP_USER', 'ftpuser');
define('FTP_PASS', 'delpHI01work');
define('FTP_HOST', 'nimda.pro');
define('FTP_SSL', false);
