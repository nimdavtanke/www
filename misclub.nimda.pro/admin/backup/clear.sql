#######################################
# ���� ���� ������
# 08.02.2012 12:40
#######################################

# ���� ������� menu

CREATE TABLE IF NOT EXISTS menu ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `name` TEXT NOT NULL, `style` TEXT NOT NULL);

INSERT INTO menu VALUES (1,'������� ����','main_menu');

# ����� ����� ������� menu

# ���� ������� menu_items

CREATE TABLE IF NOT EXISTS menu_items ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `menu_id` INT(10) UNSIGNED NOT NULL, `cat_id` INT(10) UNSIGNED NOT NULL, `level` INT(11) NOT NULL, `key_name` TEXT NOT NULL, `name` TEXT NOT NULL, `full_name` TEXT NOT NULL, `title` TEXT NOT NULL, `short_description` TEXT NOT NULL, `show_in_menu` ENUM('0','1') NOT NULL DEFAULT 1, `position` INT(11) NOT NULL, `link` TEXT NOT NULL, `date_edit` TEXT NOT NULL, `user_edit` INT(11) NOT NULL);

INSERT INTO menu_items VALUES (1,1,0,1,'glavnaya_stranitsa','������� ��������','������� ��������','','','1',1,'','19.01.2012.15.37',1);

# ����� ����� ������� menu_items

# ���� ������� meta_tags

CREATE TABLE IF NOT EXISTS meta_tags ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `menu_id` INT(11) NOT NULL, `name` TEXT NOT NULL, `description` TEXT NOT NULL);

# ����� ����� ������� meta_tags

# ���� ������� page_blocks

CREATE TABLE IF NOT EXISTS page_blocks ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `menu_id` INT(11) NOT NULL, `block_type` INT(11) NOT NULL, `block_sub_type` INT(11) NOT NULL, `content` LONGTEXT NOT NULL, `width` INT(10) UNSIGNED NOT NULL DEFAULT 100, `position` INT(11) NOT NULL);

INSERT INTO page_blocks VALUES (1,1,0,0,'�� ���� ��� ������ �� ����� ����� www.�������.ru. <br />���� �������� ������ ���������� ��� ������ ������ �����:<br />- ������������� �����;<br />- ������� � ������ �������;<br />- ��� �������� � �������������;<br />- ����������� ������;<br />- ���� �� ������ � ������;<br />- �������� � ��������� ������.<br />�� ����� ����� ����������� ����� �� ������������ ������������� �����, �����������, ��������, ��������, ������������ ������, ������������� �������� � CD-������, ��������, ������ �����, �������� ��������.<br />����� �� ���������� �������� ���������� ������������, ������������� � ����� ����������� �����, � ��� ����� � ����������.<br />������ �������������� �� ���������� �������, ����, ��������.<br /><br />�������� �������� �������� ���� ���� � ���������� �� ���� ������, ��� �� � ��������� ��� ���������, ������� ���� ����������.<br /><br /><br /><br />���� ����� �����, ������� �� ��������� � �������, ������� �� ����������, �� �� ����� ����, ��� ������ �� ����. <br />����������� � ���� ������ ����������� ��������� � �� ������� ����� ����������� ���������� ��� ���!!!<br />�� ������ ����������� �Ѩ! � ��������� ����� ������, ������ ��� �� ��������, ��� ������� ��� ������ � �������.<br />������ ���� ���������.<br />������������ ���� ����.<br />������ ���� ������.<br />� ��� �������� ������ ��������� ����.<br />�� �������� ��� ��� ������ ���� � ���� � �� ������� ����, � ������ � 10-00 �� 18-00, ������ � 12-00 �� 16-00. <br />�� ����� �������������, ����� �������. ���� ������ ������ �� ����� ������!<br />��������� ������ � ���!<br />������� � ����!<br />������ ���!<br />� �� � ����� �������� ��� ����� ������, ����� ������.<br />�� ����� ������� � ��� ����� ��������.<br />',100,2);

INSERT INTO page_blocks VALUES (2,1,0,0,'',100,1);

INSERT INTO page_blocks VALUES (3,1,1,0,'',100,3);

# ����� ����� ������� page_blocks

# ���� ������� photos

CREATE TABLE IF NOT EXISTS photos ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `block_id` INT(11) NOT NULL, `photo` TEXT NOT NULL, `description` TEXT NOT NULL, `position` INT(11) NOT NULL);

# ����� ����� ������� photos

# ���� ������� settings

CREATE TABLE IF NOT EXISTS settings ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `option_groupid` INT(11) NOT NULL DEFAULT 1, `option_name` TEXT NOT NULL, `option_descr` TEXT NOT NULL, `option_var` TEXT, `option_value` TEXT, `option_type` TEXT, `position` INT(11) NOT NULL);

INSERT INTO settings VALUES (1,1,'�������� �����','','site_name','�������� �����','text',1);

INSERT INTO settings VALUES (2,1,'��������� �����','�����, ����������� � ��� TITLE ���� ������� �����','site_title','WebCMS 2.1','text',3);

INSERT INTO settings VALUES (3,1,'���� ������?','��������� ������� ���� ��� �����-���� �����.','is_open','1','yesno',4);

INSERT INTO settings VALUES (4,1,'����� ��������� �����','�����, ������������ �� ���������, ���� ���� ������','closed_text','��������, �� ����� ������� ����������� ������...','textarea',5);

INSERT INTO settings VALUES (5,1,'����� �����','URL �����','site_url','http://localhost/webcms/','text',2);

INSERT INTO settings VALUES (6,1,'������ ������� ��������','ID �������, ������������ � �������� ������� �������� �����','index_id','1','text',6);

INSERT INTO settings VALUES (7,1,'Email ��������������','�� ���� ����� ����� ������������ ��� ��������� ����� �����','admin_email','admin@nimda.pro','text',3);

INSERT INTO settings VALUES (8,2,'������ ������������ �����������','������ ������������ ����������� � ��������','max_photothumb_big','260','text',1);

INSERT INTO settings VALUES (9,2,'������� ������ �����������','������ ������� ������� ��������� (� ��������)','max_photo_size','700','text',4);

INSERT INTO settings VALUES (13,2,'������ ������������ �����������','������ ������������ ����������� � ��������','max_photothumb_small','215','text',2);

INSERT INTO settings VALUES (14,2,'�������� �����������?','���� ��, �� ����������� ����������� ����� ����� ��������������� ��������, �� ����� ����������� ��������<br />���� ���, �� ����������� ����������� ����� ��������������� ���������, �� � ���������� �������� ����.','photothumb_cut','0','yesno',3);

INSERT INTO settings VALUES (18,2,'���������� ���������� �� ��������','','photogallery_on_page','10','text',10);

INSERT INTO settings VALUES (19,2,'���������� ������� � �����������','������ �������� ������������� ���������� ������� ��� ����������� � ��������� ��� �����������','photogallery_num_cols','2','text',15);

INSERT INTO settings VALUES (20,1,'������ index.php �� ������� ������?','�� ���������, ������ �� �������� ������ ����� ����� ���: http://www.domain.ru/index.php/nazvanie_stranici<br>��� ����� ������� ������ � ����:http://www.domain.ru/nazvanie_stranici','rewrite_url','1','yesno',7);

INSERT INTO settings VALUES (21,2,'���� ���� ����������� �����������.','������������� ���� ����� ������������ ����������� �����������.<br />������: #ffffff','photogallery_preview_color','#ffffff','text',5);

INSERT INTO settings VALUES (22,3,'������ ������','������ ������ � ��������','icon_w','150','text',1);

INSERT INTO settings VALUES (23,3,'������ ������','������ ������ � ��������','icon_h','150','text',2);

INSERT INTO settings VALUES (24,3,'�������� �����������?','���� ��, �� ������ ����� ����� ��������������� ��������, �� ����� ����������� ��������<br />���� ���, �� ������ ����� ��������������� ���������, �� � �� �������� ����.','icon_cut','0','yesno',3);

INSERT INTO settings VALUES (25,3,'���� ���� ������.','������������� ���� ����� ������������ ������.<br />������: #ffffff','icon_preview_color','#ffffff','text',5);

INSERT INTO settings VALUES (26,3,'���������� ������� � ������ �����������','','icon_num_cols','2','text',6);

INSERT INTO settings VALUES (27,1,'����� ������� �������?','����� ������� ��������� ������������� ������ ��� �������������� � ������ � ������� ��� �� ���������.','error_reporting','0','yesno',100);

INSERT INTO settings VALUES (28,3,'���������� ����������� �� ��������','','subs_num_onpage','18','text',10);

# ����� ����� ������� settings

# ���� ������� settings_groups

CREATE TABLE IF NOT EXISTS settings_groups ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `group_name` TEXT NOT NULL, `group_position` INT(11) NOT NULL DEFAULT 1);

INSERT INTO settings_groups VALUES (1,'�������� ���������',1);

INSERT INTO settings_groups VALUES (2,'��������� �����������',5);

INSERT INTO settings_groups VALUES (3,'��������� ������ �������',2);

# ����� ����� ������� settings_groups

# ���� ������� usergroups

CREATE TABLE IF NOT EXISTS usergroups ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `name` TEXT NOT NULL);

INSERT INTO usergroups VALUES (1,'�������������');

# ����� ����� ������� usergroups

# ���� ������� users

CREATE TABLE IF NOT EXISTS users ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `usergroup` INT(11) NOT NULL, `login` TEXT NOT NULL, `password` TEXT NOT NULL, `name` TEXT NOT NULL, `lastname` TEXT NOT NULL, `email` TEXT NOT NULL);

INSERT INTO users VALUES (1,1,'MininAA','822c7ef90e0f9f34569645f604f58c5b','�����','�����','fillonik@rambler.ru');

INSERT INTO users VALUES (2,1,'admin','21232f297a57a5a743894a0e4a801fc3','�������������','','');

# ����� ����� ������� users

# ���� ������� webcms_info

CREATE TABLE IF NOT EXISTS webcms_info ( `id` INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, `code` TEXT NOT NULL, `name` TEXT NOT NULL, `version` TEXT NOT NULL);

INSERT INTO webcms_info VALUES (1,'webcms','������ �������','2.1.6');

INSERT INTO webcms_info VALUES (2,'photogallery','�����������','1.0.3');

INSERT INTO webcms_info VALUES (3,'photothumber','�������� ����������','1.0');

INSERT INTO webcms_info VALUES (4,'backupper','������� ���������� ����������� � ��������������','1.0');

# ����� ����� ������� webcms_info

