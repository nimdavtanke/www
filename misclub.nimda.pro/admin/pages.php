<?
header('Content-type: text/html; charset=windows-1251');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
require("../functions/main.func.php");
require("../functions/admin.func.php");

$body_style="background-color:#f9f9f9;  background-image: url(../images/webcms/body_bg.gif); background-position: top left; background-repeat: repeat-y; padding-left:7px;";
$showhide_frame = true;
require("../templates/admin_header.php");
$_SESSION['selected_menu']=$_GET['cat_id'];
$_SESSION['selected_catmenu']=$_GET['menu_id'];
$menu_id = $_GET['menu_id'];
$cat_id = $_GET['cat_id'];
if (isset($_GET['action']))
{
$action = $_GET['action'];
}
if (isset($_POST['action']))
{
$action = $_POST['action'];
}
if (!isset($action)) $action="";
if (!isset($message)) $message="";
$date = date("d.m.Y.H.i");
$show_edit_title = "none";

///// ИЗМЕНЕНИЕ ПОРЯДКА БЛОКОВ И ИХ РАЗМЕРОВ
if ($action=="save_block_pos")
	{
	if (isset($_POST['block_w']))
		{
		foreach ($_POST['block_w'] as $block_id => $new_w)
		{
		$q = "UPDATE page_blocks SET width='$new_w' WHERE id='$block_id'";
		doquery($q);
		}
		}
	foreach ($_POST['block_pos'] as $block_id => $new_pos)
		{
		$q = "UPDATE page_blocks SET position='$new_pos' WHERE id='$block_id'";
		doquery($q);
		}
		if (isset($_POST['photo_pos']))
		{
			foreach ($_POST['photo_pos'] as $photo_id => $new_pos)
			{
			$q = "UPDATE photos SET position='$new_pos' WHERE id='$photo_id'";
			doquery($q);
			}
		}
		update_date_edit($cat_id);
	}
	/// Отмечаем блок для перемещения
	if ($action=="move_block")
	{
		if (!isset($_GET['block_id']) or $_GET['block_id']=="")
		{
		$error = "Не выбран блок для удаления!";
		}
		else
		{
		$_SESSION['selected_block']=$_GET['block_id'];
		}
	}
		if ($action=="move_block_cancel")
	{
		unset($_SESSION['selected_block']);
	}
	if ($action=="do_move_block")
	{
	$q = "UPDATE page_blocks SET menu_id='$_GET[cat_id]' WHERE id='$_SESSION[selected_block]'";
	doquery($q);
		unset($_SESSION['selected_block']);
		update_date_edit($cat_id);
	}
	///// Удаление блока
if ($action=="delete_block")
	{
	if (!isset($_GET['block_id']) or $_GET['block_id']=="")
		{
		$error = "Не выбран блок для удаления!";
		}
		else
		{
				$q = "SELECT block_type FROM page_blocks WHERE id='$_GET[block_id]'";
				$block = mysql_fetch_assoc(doquery($q));
				// Если фотогаллерея, удаляем фотки
					if ($block['block_type']=="1")
						{
						$q = "SELECT * FROM photos WHERE block_id='$_GET[block_id]'";
							$do = doquery($q);
								while ($photo = mysql_fetch_assoc($do))
									{
									unlink("../photogallery/thumbs/$photo[photo].jpg");
									unlink("../photogallery/originals/$photo[photo].jpg");
									unlink("../photogallery/photos/$photo[photo].jpg");
										$q = "DELETE FROM photos WHERE id='$photo[id]'";
										doquery($q);
									}
						}
						$q = "DELETE FROM page_blocks WHERE id='$_GET[block_id]'";
										doquery($q);
										update_date_edit($cat_id);
		}
	}

// Добавление блоков

if ($action=="add_block")
	{
	$pos = 0;
	$q = "SELECT position FROM page_blocks WHERE menu_id='$cat_id' ORDER BY position DESC LIMIT 0,1";
	$pos = mysql_fetch_assoc(doquery($q));
	$pos = $pos['position']+1;
	if (!isset($_GET['block_sub_type']))
	{
	$block_sub_type="0";
	}
	else
	{
	$block_sub_type=$_GET['block_sub_type'];
	}
	$file= "";
	if (isset($_POST['php_filename']))
		{
		$file = ", content='$_POST[php_filename]'";
		}
		$q = "INSERT INTO page_blocks SET menu_id='$cat_id', block_type='$_GET[block_type]',block_sub_type='$block_sub_type', position='$pos' $file";
		doquery($q);
		update_date_edit($cat_id);
	}
	if ($action=="delete_meta")
	{
		$q = "DELETE FROM meta_tags WHERE id='$_GET[meta_id]'";
		doquery($q);
		update_date_edit($cat_id);
	}
if ($action=="add_meta")
	{
	$q = "INSERT INTO meta_tags SET menu_id='$cat_id', name='$_POST[meta_name]', description='$_POST[meta_description]'";
		doquery($q);
		$show_edit_title = "";
		update_date_edit($cat_id);
	}
	if ($action=="edit_meta")
	{
	foreach ($_POST['meta_name'] as $key =>$value)
		{
		$descripton = $_POST['meta_description'];
	$q = "UPDATE meta_tags SET name='$value', description='$descripton[$key]' WHERE id='$key'";
		doquery($q);
		}
		update_date_edit($cat_id);
	}

if ($action=="edit_title")
	{
	$q = "UPDATE menu_items SET title='$_POST[title]', date_edit='$date' WHERE id='$cat_id' AND (title!='$_POST[title]')";
		doquery($q);
		update_date_edit($cat_id);
	}
	if ($action=="edit_short_descr")
		{
			$q = "UPDATE menu_items SET short_description='$_POST[short_description]', date_edit='$date' WHERE id='$cat_id' AND (short_description!='$_POST[short_description]')";
			doquery($q);
			update_date_edit($cat_id);
		}
	// Сохранение иконки
	if ($action=="edit_ico")
	{
	if (isset($_FILES['file_ico']) and $_FILES['file_ico']['name']!="")
		{
			$source_src = $_FILES['file_ico']['tmp_name'];
			if (upload_icon($source_src,$_GET['cat_id']))
				{
					$message .= "<strong style='color:#009900;'>Иконка сохранена!</strong>";
				}
				else
				{
					$message .= "<strong style='color:#990000;'>Не удалось сохранить иконку!</strong>";
				}
		}
		else
		{
		$message .= "<strong style='color:#990000;'>Не указан файл!</strong>";
		}
	}

		if ($action=="del_ico")
	{

			if (is_file("../page_icons/$_GET[cat_id].jpg"))
				{
					unlink ("../page_icons/$_GET[cat_id].jpg");
						$message .= "<strong style='color:#009900;'>Иконка удалена!</strong>";
				}

	}


	if ($action=="edit_names")
	{
	if ($_POST['name']=="") $_POST['name'] = "Без названия";
	if ($_POST['key_name']=="")
	{
	$key_name = check_key_name(transliterate($_POST['name']),"",$cat_id);
	}
	else
	{
	$key_name = check_key_name(transliterate($_POST['key_name']),"",$cat_id);
	}

	$q = "UPDATE menu_items SET name='$_POST[name]', full_name='$_POST[full_name]', key_name='$key_name',  date_edit='$date' WHERE id='$cat_id' AND (name!='$_POST[name]' or full_name!='$_POST[full_name]' or key_name!='$key_name')";
		doquery($q);
		update_date_edit($cat_id);
	}

	if (!isset($_GET['menu_id']) or $_GET['menu_id']=="0")
		{
		$q = "SELECT * FROM menu WHERE id='$_GET[cat_id]'";
		$menu_id = $_GET['cat_id'];
		 $cat_id= 0;
		$name = mysql_fetch_assoc(doquery($q));
		$name = $name['name'];
		$additional_form = "";
		$is_menu = true;
		$menu_link = false;
		}
	else
		{
			$is_menu = false;
		$q = "SELECT * FROM menu_items WHERE id='$_GET[cat_id]'";
			$res = mysql_fetch_assoc(doquery($q));
			$name = $res['name'];
		}

echo "<div style=\"padding:3px;\">";

$last_upd = "";
if (!$is_menu)
{
	if ($res["user_edit"]!="0")
		{
		$d = explode(".",$res["date_edit"]);
		$timestamp = mktime($d[3],$d[4],"0",$d[1],$d[0],$d[2]);
		$last_edit = date("d.m.Y в H:i",$timestamp);
		$user = user_info($res["user_edit"]);
		$last_upd="<span style='font-size:11px; font-style:italic;'>(Последнее изменение $last_edit, пользователем $user[lastname] $user[name] - $user[groupname])</span>";
		}
}
?>
<?


echo "<strong>$name</strong>";
if (isset($res) and $res['id']!="")
{
$build_url = build_url($res['id'],"");
echo " $last_upd<br /> <span style='color:#333333; font-size:11px;'><span style='color:#666666;'>ID:</span> <strong>$res[id]</strong>, <span style='color:#666666;'>ссылка на страницу на сайте:</span> <a href='$options[site_url]$build_url' target='_blank'>$options[site_url]$build_url</a></span><br />$message";
}

/// ДОПОНИТЕЛЬНЫЕ actions
/// ДОСТАЕМ ВСЕ дополнительные actions
$dir = "actions";
	$opend_dir = opendir($dir);
		 while ($get_file = readdir($opend_dir))
			{
			$filename = $dir . "/".$get_file;
			$path_parts = pathinfo($filename);
			if (is_file($filename) and ($path_parts['extension']=="php"))
				{
					require("$filename");
				}
			}


///// ФОРМА ОСНОВНЫХ НАСТРОЕК ПУНКТА МЕНЮ
			if (!$is_menu)
			{
			$disp_link_div = "display:none";
			$show_in_menu = "";
				$target_chk ="";
			if ($res['show_in_menu']=="1")
				{
					$show_in_menu = "checked";
					$disp_link_div = "";
				}
					$is_link[0] ="";
					$is_link[1] ="";
					if ($res['link']=="")
					{
					$is_link[0] = "checked";
					$disp = "display:none";
					$menu_link = false;
					}
					else
					{
					$menu_link = true;
					$target = explode("::",$res["link"]);

						if (isset($target[1]))
							{
								$target_chk ="checked";
								$res["link"] = $target[0];
							}
					$is_link[1] = "checked";
					$disp = "";
					}
			if (isset($error) and $error!="")
				{
				echo "<span style='color:#ff0000; font-weight:bold; font-size:14px;'>$error</span>";
				}
			echo "<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'><div id='close_linkedit' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"document.add_link.style.display='none';get_id('close_linkedit').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму'  title='Скрыть форму' border='0'></div>
<a onclick=\"if (document.add_link.style.display==''){document.add_link.style.display='none';get_id('close_linkedit').style.display='none';} else {document.add_link.style.display='';get_id('close_linkedit').style.display='';}\"><strong>Настройки пункта меню &quot;$name&quot;</strong></a><br />
<form name='add_link' action='menu_items.php?action=edit_menu&menu=$menu_id&cat_id=$cat_id' method='post' target='site_structure' style='margin:0px; padding:2px; display:none;'>
<div class='helptext' style='padding-left:5px; padding-right:5px; border:1px dashed #8791a4;'>Снимите галку, если ссылка на раздел не должна отображаться в меню.</div>
<label><input type='checkbox' name='show_in_menu' value='1' $show_in_menu onclick=\"if (this.checked) {get_id('link_div').style.display='';} else {get_id('link_div').style.display='none'; get_id('input_is_link').click();}\"> Отображать пункт в меню</label><br /><br />
<div id='link_div' style='$disp_link_div'>
<div class='helptext' style='padding-left:5px; padding-right:5px; border:1px dashed #8791a4;'>Что бы пункт меню был ссылкой на другой сайт или какую-либо страницу Вашего сайта, выберите пункт &quot;Ссылка&quot; и укажите URL нужного сайта.<br />
Помните, пункты-ссылки не могут содержать никакой информации, а так же являться родительскими разделами!</div>
<label><input id='input_is_link' type='radio' name='is_link' value='0' $is_link[0] onclick=\"get_id('block_link_setting').style.display='none'; get_id('input_link').value=''; \"> Страница</label><br />
<label><input type='radio' name='is_link' value='1' $is_link[1] onclick=\"get_id('block_link_setting').style.display='';\"> Ссылка </label>
<div id='block_link_setting' style='margin-left:20px; $disp;'>
<span class='helptext'>Адрес ссылки:</span><br />
<input id='input_link' type='text' class='admin_input' style='width:350px;' value='$res[link]' name='link'> <label><input type='checkbox' value='1' name='target' $target_chk>Открывать в новом окне</label><br />
<span style='font-size:11px;'><a onclick=\"if (get_id('div_link_list').style.display=='none') { link_list(); $('#div_link_list').show('fast'); this.innerHTML='Убрать разделы';} else { $('#div_link_list').hide('fast'); this.innerHTML='Выбрать раздел';}\">Выбрать раздел</a> | <a href='#' onclick=\"link_to_file(get_id('input_link'));\">Выбрать файл</a></span>

<div id='div_link_list' style='display:none; border:1px solid #cccccc; font-size:12px;  padding:6px; margin-top:6px; width:340px;'></div>

</div>
</div>
			<div align='right' style='padding-top:5px;'><input type='button' onclick=\"add_link.submit();\" value='Подтвердить изменения' class='admin_input_button'></div>
			</form></div>
			</td></tr></table>";
			}


	// Добавление новых разделов
echo "
<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'><div id='close_add' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"document.add_menu.style.display='none';get_id('close_add').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму'  title='Скрыть форму' border='0'></div>
<a onclick=\"if (document.add_menu.style.display==''){document.add_menu.style.display='none';get_id('close_add').style.display='none';} else {document.add_menu.style.display='';get_id('close_add').style.display='';}\"><strong>Добавить пункты меню в раздел &quot;$name&quot;</strong></a><br />
<form name='add_menu' action='menu_items.php?action=add_item&menu=$menu_id&cat_id=$cat_id' method='post' target='site_structure' style='margin:0px; padding:2px; display:none;'>
<div class='helptext' style='padding-left:5px; padding-right:5px; border:1px dashed #8791a4;'>Введите названия разделов, которые вы хотите добавить.<br />Каждый раздел должен начинаться с новой строки!</div>
			<textarea id='name' name='name' class='admin_input' cols='70' rows='2' style='overflow-y:hidden;' onkeyup=\"if(this.scrollHeight >=this.offsetHeight) { this.style.height = this.scrollHeight+15 +'px'; }\"></textarea>
			<div align='right' style='padding-top:5px;'><input type='button' onclick=\"add_menu.submit(); get_id('name').value='';\" value='Добавить' class='admin_input_button'></div>
			</form></div>
			</td></tr></table>";

			if (!$is_menu)
				{
				/// ИЗМЕНИТЬ НАЗВАНИЕ
				echo "
<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'
><div id='close_names' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"get_id('edit_names').style.display='none';get_id('close_names').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму'  title='Скрыть форму' border='0'></div>
<a onclick=\"if (get_id('edit_names').style.display==''){get_id('edit_names').style.display='none';get_id('close_names').style.display='none';} else {get_id('edit_names').style.display='';get_id('close_names').style.display='';}\"><strong>Изменить названия раздела</strong></a><br />
<div id='edit_names' style='display:none;'>
<form name='edit_names' action='pages.php?action=edit_names&menu_id=$menu_id&cat_id=$cat_id' method='post' target='main' style='margin:0px; padding:2px; '>
<br /><strong>Название в меню</strong>
<div style='margin-top:2px; padding-top:3px; border-top:1px dashed #8791a4;'>
<input type='text' value='$res[name]' name='name' class='admin_input' style='width:600px;'>
</div>
<br /><strong>Полное название</strong>
<div style='margin-top:2px; padding-top:3px; border-top:1px dashed #8791a4;'>
<input type='text' value='$res[full_name]' name='full_name' class='admin_input' style='width:600px;'></div>
<br /><strong>Псевдоним</strong>
<div class='helptext' style='padding-left:5px; padding-right:5px; border:1px dashed #8791a4;'>Псевдоним используется для формирования адреса страницы, понятного людям.</div>
<div style='margin-top:2px; padding-top:3px;'>
<input type='text' value='$res[key_name]' name='key_name' class='admin_input' style='width:600px;'>
<div align='right' style='padding-top:5px;'><input type='button' onclick=\"edit_names.submit();\" value='Сохранить' class='admin_input_button'></div></div>
			</form></div></td></tr></table>";


/// ИЗМЕНИТЬ ИКОНКУ РАЗДЕЛА
				echo "
<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'
><div id='close_ico' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"get_id('edit_ico').style.display='none';get_id('close_ico').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму'  title='Скрыть форму' border='0'></div>
<a onclick=\"if (get_id('edit_ico').style.display==''){get_id('edit_ico').style.display='none';get_id('close_ico').style.display='none';} else {get_id('edit_ico').style.display='';get_id('close_ico').style.display='';}\"><strong>Изменить иконку раздела</strong></a><br />
<div id='edit_ico' style='display:none;'>
<form name='edit_ico' ENCTYPE=\"multipart/form-data\" action='pages.php?action=edit_ico&menu_id=$menu_id&cat_id=$cat_id' method='post' target='main' style='margin:0px; padding:2px; '>
";
	if (is_file("../page_icons/$_GET[cat_id].jpg"))
		{
		echo "<center><img src='../page_icons/$_GET[cat_id].jpg' border='0'><br /> <a href='photothumber.php?menu_id=$menu_id&cat_id=$cat_id&photo_id=$cat_id&source=page_icons' style='font-size:10px;'>Изменить иконку</a> | <a href='pages.php?action=del_ico&menu_id=$menu_id&cat_id=$cat_id' style='font-size:10px;'>Удалить иконку</a></center>";
		}
echo "
<br /><strong>Файл иконки</strong>
<div class='helptext' style='padding-left:5px; padding-right:5px; border:1px dashed #8791a4;'>Укажите файл-картинку чтобы добавить или изменить иконку раздела.</div>
<div style='margin-top:2px; padding-top:3px; border-top:1px dashed #8791a4;'>
<input type='file' value='' name='file_ico' class='admin_input' style='width:600px;'>
</div>
<div align='right' style='padding-top:5px;'><input type='button' onclick=\"edit_ico.submit();\" value='Сохранить' class='admin_input_button'></div></div>
			</form></div></td></tr></table>";

	if (!$menu_link)
	{

			// Работа с TITLE и META
echo "
<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'
><div id='close_seo' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"get_id('edit_seo').style.display='none';get_id('close_seo').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму'  title='Скрыть форму' border='0'></div>
<a onclick=\"if (get_id('edit_seo').style.display==''){get_id('edit_seo').style.display='none';get_id('close_seo').style.display='none';} else {get_id('edit_seo').style.display='';get_id('close_seo').style.display='';}\"><strong>Редактировать заголовок и META-данные</strong></a><br />
<div id='edit_seo' style='display:$show_edit_title;'>
<form name='edit_title' action='pages.php?action=edit_title&menu_id=$menu_id&cat_id=$cat_id' method='post' target='main' style='margin:0px; padding:2px; '>
<br /><strong>Заголовок страницы (&lt;TITLE&gt;)</strong>
<div style='margin-top:2px; padding-top:3px; border-top:1px dashed #8791a4;'>
<input type='text' value='$res[title]' name='title' class='admin_input' style='width:600px;'>
<div align='right' style='padding-top:5px;'><input type='button' onclick=\"edit_title.submit();\" value='Сохранить' class='admin_input_button'></div></div>
			</form>";
			/// ВЫВОД СПИСКА МЕТА
				$q = "SELECT * FROM meta_tags WHERE menu_id='$cat_id'";
					$do = doquery($q);
						if (mysql_num_rows($do)!="0")
							{
							echo "<form name='edit_meta' action='pages.php?action=edit_meta&menu_id=$menu_id&cat_id=$cat_id' method='post' target='main' style='margin:0px; padding:2px; '>
<strong>Список META-данных</strong><br />
<div style='margin-top:2px; padding-top:3px; border-top:1px dashed #8791a4;'>";
								while ($meta = mysql_fetch_assoc($do))
									{
									$meta_name_list =  get_meta_name_opt("$meta[name]");
									echo "<div style='padding-bottom:3px;'><strong>&lt;META NAME=&quot; <select name='meta_name[$meta[id]]' class='admin_input'>$meta_name_list</select> &quot; CONTENT=&quot; <input type='text' value='$meta[description]' name='meta_description[$meta[id]]' class='admin_input' style='width:240px;'> &quot;&gt;</strong> <a href='pages.php?action=delete_meta&menu_id=$menu_id&cat_id=$cat_id&meta_id=$meta[id]'><img src='../images/webcms/ico_delete.gif' border='0' align='absmiddle' title='Удалить Мета-тег'></a></div>";
									}
echo "<div align='right' style='padding-top:5px;'><input type='button' onclick=\"edit_meta.submit();\" value='Сохранить изменения' class='admin_input_button'></div>
			</div>
			</form>";
							}
				$meta_name_list = get_meta_name_opt("");
			/// ДОБАВИТЬ МЕТА
			echo "<form name='add_meta' action='pages.php?action=add_meta&menu_id=$menu_id&cat_id=$cat_id' method='post' target='main' style='margin:0px; padding:2px; '>
<strong>Добавить META-данные</strong><br />
<div style='margin-top:2px; padding-top:3px; border-top:1px dashed #8791a4;'>
<strong>&lt;META NAME=&quot; <select name='meta_name' class='admin_input'>$meta_name_list</select> &quot; CONTENT=&quot; <input type='text' value='' name='meta_description' class='admin_input' style='width:240px;'> &quot;&gt;</strong>
<div align='right' style='padding-top:5px;'><input type='button' onclick=\"add_meta.submit();\" value='Добавить' class='admin_input_button'></div>
			</div>
			</form>
			</div></div>
			</td></tr></table>";
	}
			/// ИЗМЕНИТЬ КРАТКОЕ ОПИСАНИЕ РАЗДЕЛА
				echo "
<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'
><div id='close_short_descr' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"get_id('edit_short_descr').style.display='none';get_id('close_short_descr').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму'  title='Скрыть форму' border='0'></div>
<a onclick=\"if (get_id('edit_short_descr').style.display==''){get_id('edit_short_descr').style.display='none';get_id('close_short_descr').style.display='none';} else {get_id('edit_short_descr').style.display='';get_id('close_short_descr').style.display='';}\"><strong>Краткое описание раздела</strong></a><br />
<div id='edit_short_descr' style='display:none;'>
<form name='edit_short_descr' action='pages.php?action=edit_short_descr&menu_id=$menu_id&cat_id=$cat_id' method='post' target='main' style='margin:0px; padding:2px; '>
";
echo "
<div class='helptext' style='padding-left:5px; padding-right:5px; border:1px dashed #8791a4;'>Краткое описание раздела выводится в списке подразделов.<br />
Если оставить это поле пустым, описание будет сгенерировано автоматически.</div>
<div style='margin-top:2px; padding-top:3px; border-top:1px dashed #8791a4;'>";
$textarea[] = "short_description";
$textarea_values[] = "$res[short_description]";
$textarea_title[] = "Текст страницы";
show_editor($textarea, $textarea_values, $textarea_title);

echo "
</div>
<div align='right' style='padding-top:5px;'><input type='button' onclick=\"edit_short_descr.submit();\" value='Сохранить' class='admin_input_button'></div></div>
			</form></div></td></tr></table>";
		if (!$menu_link)
	{

			///
				////////////////////// СОДЕРЖИМОЕ СТРАНИЦЫ
				echo "
<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 0px 3px 0px;' id='page_block'><strong>Содержимое раздела &quot;$name&quot;</strong></a><br />
<table border='0' cellpadding='0' cellspacing='0' id='save_block_btn' style='display:none; margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='#' onclick=\"get_id('block_action').value='save_block_pos'; document.blocks_form.submit(); return false;\"><img src='../images/webcms/ico_save.gif' border='0' align='absmiddle'> Сохранить изменения</a></div></td>
</tr>
</table>";


				/// ДОСТАЕМ ВСЕ меню
$dir = "blocks_menu";
	$opend_dir = scandir($dir);
		 foreach ($opend_dir as $get_file)
			{
			$filename = $dir . "/".$get_file;
			$path_parts = pathinfo($filename);
			if (is_file($filename) and ($path_parts['extension']=="php"))
				{
					require("$filename");
				}
			}

if (isset($_SESSION['selected_block']) and $_SESSION['selected_block']!="")
	{
	echo "<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffea';\" style='border:1px solid #8791a4; background-color:#ffffea;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='pages.php?action=do_move_block&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_block_move.gif' border='0' align='absmiddle'> Вставить блок</a></div></td>
</tr>
</table>";
	echo "<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffea';\" style='border:1px solid #8791a4; background-color:#ffffea;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden; '  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='pages.php?action=move_block_cancel&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_block_del.gif' border='0' align='absmiddle'> Отменить перемещение</a></div></td>
</tr>
</table>";
	}
echo "<div style='clear:both;'></div>";
$q = "SELECT * FROM page_blocks WHERE menu_id='$cat_id' ORDER BY position";
	$do = doquery($q);
	echo "<div style='padding:3px;'>";

echo "<form name='blocks_form' action='pages.php?menu_id=$menu_id&cat_id=$cat_id&return=' style='padding:0px; margin:0px;' method='post'><input type='hidden' id='block_action' name='action' value='save_block_pos'>";



		while ($blocks = mysql_fetch_assoc($do))
			{
		 $move_block = "onmousedown=\"startMoveBlock('block_$blocks[id]'); return false;\"";
				$top_down = "<img src='../images/webcms/topdown_sm.gif' border='0' align='absmiddle'  title='Изменить порядок' $move_block>";
				$del_block = "<a href='pages.php?action=delete_block&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id'  onclick=\"if(confirm('Блок и его содержимое будут полностью удалены!\\r\\n \\r\\nВы уверены?')){return true;} else {return false;}\"><img src='../images/webcms/ico_block_del.gif' border='0' align='absmiddle'  title='Удалить блок'></a>";
				$move_block = "<a href='pages.php?action=move_block&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_block_move.gif' border='0' align='absmiddle'  title='Переместить блок'></a>";
				$block_menu = "$move_block $del_block $top_down";

					if (!isset($_SESSION['selected_block']) or $_SESSION['selected_block']!=$blocks["id"])
										{
										$opacity = "";
										}
										else
										{
										$opacity = "opacity:0.5; filter:progid:DXImageTransform.Microsoft.Alpha(opacity=50);";
										}
										//if ($blocks["width"]==100) $blocks["width"] = 99;
			echo  "<table border='0' cellpadding='0' cellspacing='0' style='margin-top:2px; float:left; width:$blocks[width]%;' id='block_$blocks[id]' onmouseover=\"move_to='block_$blocks[id]';\" name='block_$blocks[id]'><td><div  style='border-top:1px solid #8791a4; border-bottom:1px solid #8791a4; $opacity' ><input type=\"hidden\" id='pos_block_$blocks[id]' value='$blocks[position]' name='block_pos[$blocks[id]]'><a name='block_$blocks[id]'>";

			/// ДОСТАЕМ ВСЕ блоки
$dir = "blocks";
	$opend_dir = opendir($dir);
		 while ($get_file = readdir($opend_dir))
			{
			$filename = $dir . "/".$get_file;
			$path_parts = pathinfo($filename);
			if (is_file($filename) and ($path_parts['extension']=="php"))
				{
					require("$filename");
				}
			}



			echo  "<div style='clear:both;'></div><input type='hidden' id='block_$blocks[id]_w' value='$blocks[width]' name='block_w[$blocks[id]]' onclick=\"get_id('save_block_btn').style.display='';\"></div></td><td bgcolor='#e0e0e0' onMouseDown=\"start_resize_block(document.getElementById('block_$blocks[id]'),event)\" onMouseUp=\"end_resize_block()\" style='width:5px; cursor:w-resize;'><img src='../images/webcms/w-resize.gif' width='5'></td></tr></table>";
			}




echo "</form>";

echo "</div>
			<div style='clear:both;'></div></td></tr></table>";
}
	}
echo "</div>";
?>


<?
require("../templates/admin_footer.php");
?>