#######################################
# Дамп базы данных
# 08.02.2012 12:40
#######################################

# Дамп таблицы menu

CREATE TABLE IF NOT EXISTS menu ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `name` TEXT NOT NULL, `style` TEXT NOT NULL);

INSERT INTO menu VALUES (1,'Главное меню','main_menu');

# Конец дампа таблицы menu

# Дамп таблицы menu_items

CREATE TABLE IF NOT EXISTS menu_items ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `menu_id` INT(10) UNSIGNED NOT NULL, `cat_id` INT(10) UNSIGNED NOT NULL, `level` INT(11) NOT NULL, `key_name` TEXT NOT NULL, `name` TEXT NOT NULL, `full_name` TEXT NOT NULL, `title` TEXT NOT NULL, `short_description` TEXT NOT NULL, `show_in_menu` ENUM('0','1') NOT NULL DEFAULT 1, `position` INT(11) NOT NULL, `link` TEXT NOT NULL, `date_edit` TEXT NOT NULL, `user_edit` INT(11) NOT NULL);

INSERT INTO menu_items VALUES (1,1,0,1,'glavnaya_stranitsa','Главная страница','Главная страница','','','1',1,'','19.01.2012.15.37',1);

# Конец дампа таблицы menu_items

# Дамп таблицы meta_tags

CREATE TABLE IF NOT EXISTS meta_tags ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `menu_id` INT(11) NOT NULL, `name` TEXT NOT NULL, `description` TEXT NOT NULL);

# Конец дампа таблицы meta_tags

# Дамп таблицы page_blocks

CREATE TABLE IF NOT EXISTS page_blocks ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `menu_id` INT(11) NOT NULL, `block_type` INT(11) NOT NULL, `block_sub_type` INT(11) NOT NULL, `content` LONGTEXT NOT NULL, `width` INT(10) UNSIGNED NOT NULL DEFAULT 100, `position` INT(11) NOT NULL);

INSERT INTO page_blocks VALUES (1,1,0,0,'Мы рады вас видеть на нашем сайте www.нашсайт.ru. <br />Наша компания готова предложить вам полный спектр услуг:<br />- строительство домов;<br />- отделка и ремонт квартир;<br />- все операции с недвижимостью;<br />- юридические услуги;<br />- туры по Европе и России;<br />- создание и раскрутка сайтов.<br />Мы также имеет собственный завод по производству подсолнечного масла, профнастила, брезента, асфальта, армированной пленки, пластмассовых ванночек и CD-дисков, унитазов, барных стоек, столовых приборов.<br />Также мы занимаемся сельским хозяйством овцеводством, свиноводством и имеем собственные фермы, в том числе и птицефермы.<br />Помимо вышеописанного мы выращиваем пшеницу, рожь, кукурузу.<br /><br />Вершиной айсберга является сеть кафе и ресторанов по всей стране, где мы и реализуем всю продукцию, которую сами производим.<br /><br /><br /><br />Если среди услуг, которые мы оказываем и товаров, которые мы производим, Вы не нашли того, что искали не беда. <br />Обращайтесь в нашу службу технической поддержки и мы откроем новое направление специально для ВАС!!!<br />Мы готовы производить ВСЁ! И оказывать ЛЮБЫЕ услуги, потому что мы компания, для которой нет границ и преград.<br />Бизнес наше призвание.<br />Производство наша сила.<br />Услуги наше знание.<br />А вам остается только гордиться нами.<br />Мы работаем для Вас каждый день с утра и до поздней ночи, а точнее с 10-00 до 18-00, иногда с 12-00 до 16-00. <br />Мы очень ответственные, очень хорошие. Даже скажем больше мы самые лучшие!<br />Покупайте только у нас!<br />Дружите с нами!<br />Любите нас!<br />А мы в ответ продадим вам любые товары, любые услуги.<br />Мы очень честные и нам можно доверять.<br />',100,2);

INSERT INTO page_blocks VALUES (2,1,0,0,'',100,1);

INSERT INTO page_blocks VALUES (3,1,1,0,'',100,3);

# Конец дампа таблицы page_blocks

# Дамп таблицы photos

CREATE TABLE IF NOT EXISTS photos ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `block_id` INT(11) NOT NULL, `photo` TEXT NOT NULL, `description` TEXT NOT NULL, `position` INT(11) NOT NULL);

# Конец дампа таблицы photos

# Дамп таблицы settings

CREATE TABLE IF NOT EXISTS settings ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `option_groupid` INT(11) NOT NULL DEFAULT 1, `option_name` TEXT NOT NULL, `option_descr` TEXT NOT NULL, `option_var` TEXT, `option_value` TEXT, `option_type` TEXT, `position` INT(11) NOT NULL);

INSERT INTO settings VALUES (1,1,'Название сайта','','site_name','Название сайта','text',1);

INSERT INTO settings VALUES (2,1,'Заголовок сайта','Текст, вставляемый в тег TITLE всех страниц сайта','site_title','WebCMS 2.1','text',3);

INSERT INTO settings VALUES (3,1,'Сайт открыт?','Позволяет закрыть сайт для каких-либо целей.','is_open','1','yesno',4);

INSERT INTO settings VALUES (4,1,'Текст закрытого сайта','Текст, отображаемый на страницах, если сайт закрыт','closed_text','Извините, на сайте ведутся технические работы...','textarea',5);

INSERT INTO settings VALUES (5,1,'Адрес сайта','URL сайта','site_url','http://localhost/webcms/','text',2);

INSERT INTO settings VALUES (6,1,'Индекс главной страницы','ID раздела, загружаемого в качестве главной страницы сайта','index_id','1','text',6);

INSERT INTO settings VALUES (7,1,'Email администратора','На этот адрес будет отправляться вся исходящая почта сайта','admin_email','admin@nimda.pro','text',3);

INSERT INTO settings VALUES (8,2,'Ширина уменьшенного изображения','Ширина уменьшенного изображения в пикселях','max_photothumb_big','260','text',1);

INSERT INTO settings VALUES (9,2,'Больший размер изображения','Размер большей стороны оригинала (в пикселях)','max_photo_size','700','text',4);

INSERT INTO settings VALUES (13,2,'Высота уменьшенного изображения','Высота уменьшенного изображения в пикселях','max_photothumb_small','215','text',2);

INSERT INTO settings VALUES (14,2,'Обрезать изображения?','Если ДА, то уменьшенное изображение будет точно соответствовать размерам, но часть изображения пропадет<br />Если НЕТ, то уменьшенное изображение будет пропорционально уменьшено, но у фотографии появятся поля.','photothumb_cut','0','yesno',3);

INSERT INTO settings VALUES (18,2,'Количество фотографий на странице','','photogallery_on_page','10','text',10);

INSERT INTO settings VALUES (19,2,'Количество колонок в фотогалерее','Данный параметр устанавливает количество колонок для фотогалерей с описанием ПОД фотографией','photogallery_num_cols','2','text',15);

INSERT INTO settings VALUES (20,1,'Убрать index.php из адресов ссылок?','По умолчанию, ссылки на страницы вашего сайта имеют вид: http://www.domain.ru/index.php/nazvanie_stranici<br>Эта опция приведёт ссылки к виду:http://www.domain.ru/nazvanie_stranici','rewrite_url','1','yesno',7);

INSERT INTO settings VALUES (21,2,'Цвет фона уменьшенных изображений.','Устанавливает цвет полей необрезанных уменьшенных изображений.<br />Пример: #ffffff','photogallery_preview_color','#ffffff','text',5);

INSERT INTO settings VALUES (22,3,'Ширина иконки','Ширина иконки в пикселях','icon_w','150','text',1);

INSERT INTO settings VALUES (23,3,'Высота иконки','Высота иконки в пикселях','icon_h','150','text',2);

INSERT INTO settings VALUES (24,3,'Обрезать изображения?','Если ДА, то иконка будет точно соответствовать размерам, но часть изображения пропадет<br />Если НЕТ, то иконка будет пропорционально уменьшена, но у неё появятся поля.','icon_cut','0','yesno',3);

INSERT INTO settings VALUES (25,3,'Цвет фона иконок.','Устанавливает цвет полей необрезанных иконок.<br />Пример: #ffffff','icon_preview_color','#ffffff','text',5);

INSERT INTO settings VALUES (26,3,'Количество колонок в списке подразделов','','icon_num_cols','2','text',6);

INSERT INTO settings VALUES (27,1,'Режим отладки включен?','Режим отладки позволяет разработчикам видеть все предупреждения и ошибки в системе при их появлении.','error_reporting','0','yesno',100);

INSERT INTO settings VALUES (28,3,'Количество подразделов на странице','','subs_num_onpage','18','text',10);

# Конец дампа таблицы settings

# Дамп таблицы settings_groups

CREATE TABLE IF NOT EXISTS settings_groups ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `group_name` TEXT NOT NULL, `group_position` INT(11) NOT NULL DEFAULT 1);

INSERT INTO settings_groups VALUES (1,'Основные настройки',1);

INSERT INTO settings_groups VALUES (2,'Настройки Фотогалерей',5);

INSERT INTO settings_groups VALUES (3,'Настройки иконок страниц',2);

# Конец дампа таблицы settings_groups

# Дамп таблицы usergroups

CREATE TABLE IF NOT EXISTS usergroups ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `name` TEXT NOT NULL);

INSERT INTO usergroups VALUES (1,'Администратор');

# Конец дампа таблицы usergroups

# Дамп таблицы users

CREATE TABLE IF NOT EXISTS users ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `usergroup` INT(11) NOT NULL, `login` TEXT NOT NULL, `password` TEXT NOT NULL, `name` TEXT NOT NULL, `lastname` TEXT NOT NULL, `email` TEXT NOT NULL);

INSERT INTO users VALUES (1,1,'MininAA','822c7ef90e0f9f34569645f604f58c5b','Антон','Минин','fillonik@rambler.ru');

INSERT INTO users VALUES (2,1,'admin','21232f297a57a5a743894a0e4a801fc3','Администратор','','');

# Конец дампа таблицы users

# Дамп таблицы webcms_info

CREATE TABLE IF NOT EXISTS webcms_info ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `code` TEXT NOT NULL, `name` TEXT NOT NULL, `version` TEXT NOT NULL);

INSERT INTO webcms_info VALUES (1,'webcms','Версия системы','2.1.6');

INSERT INTO webcms_info VALUES (2,'photogallery','Фотогалерея','1.0.3');

INSERT INTO webcms_info VALUES (3,'photothumber','Редактор фотографий','1.0');

INSERT INTO webcms_info VALUES (4,'backupper','Система резервного копирования и восстановления','1.0');

# Конец дампа таблицы webcms_info

