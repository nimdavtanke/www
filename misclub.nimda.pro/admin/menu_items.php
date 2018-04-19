<?
require("../functions/main.func.php");
require("../functions/admin.func.php");
require("../templates/admin_header.php");
?>

<style type="text/css">
#karta
{
width:294px;
}
</style>

<div><a href="index.php" target="_parent"><img src="../images/webcms/logo.gif" width="117" height="55" hspace="5" vspace="5" border="0" boreder="0" alt="Главная страница"/></a></div>
<div style="background:url(../images/webcms/top_menu_bg.gif) repeat-x top; height:20px; border-top:1px solid #8791a4; border-bottom:1px solid #8791a4; margin-bottom:7px;"><table border="0" cellpadding="0" cellspacing="0" align="left" width="100%"><tr><td width="25" align="center" valign="bottom"><div onmouseover="this.style.borderLeft='1px solid #8791a4'; this.style.borderRight='1px solid #8791a4';" onmouseout="this.style.borderLeft='0px solid #8791a4'; this.style.borderRight='0px solid #8791a4';" style="height:18px; padding-top:2px;"><img style="position:relative;" src="../images/webcms/ico_save_off.gif" id="save_btn_off" width="14" height="14" vspace="1" hspace="3" border="0" align="absmiddle" onmousedown="if (this.id!='save_btn_off') { this.style.paddingTop='1px'; this.style.paddingLeft='1px';}" onmouseup="if (this.id!='save_btn_off') { this.style.paddingTop='0px'; this.style.paddingLeft='0px'; get_id('form_action').value='save_changes'; menu_form.submit(); }" alt="Сохранить изменения" title="Сохранить изменения"/></div></td>
<td width="26" align="center">
<div onmouseover="this.style.borderLeft='1px solid #8791a4'; this.style.borderRight='1px solid #8791a4';" onmouseout="this.style.borderLeft='0px solid #8791a4'; this.style.borderRight='0px solid #8791a4';" style="height:19px; border-left:0px solid #8791a4; border-right:0px solid #8791a4; padding-top:1px;">
<img src="../images/webcms/ico_move_off.gif" id="move_btn_off" width="15" height="16" hspace="3" border="0" align="absmiddle" onmousedown="if (this.id!='move_btn_off') { this.style.paddingTop='1px'; this.style.paddingLeft='1px';}" onmouseup="if (this.id!='move_btn_off') { this.style.paddingTop='0px'; this.style.paddingLeft='0px'; show_move_to();}" alt="Переместить страницы"  title="Переместить страницы"/></div></td>
<td width="26" align="center">
<div onmouseover="this.style.borderLeft='1px solid #8791a4'; this.style.borderRight='1px solid #8791a4';" onmouseout="this.style.borderLeft='0px solid #8791a4'; this.style.borderRight='0px solid #8791a4';" style="height:19px; border-left:0px solid #8791a4; border-right:0px solid #8791a4; padding-top:1px;">
<img src="../images/webcms/ico_del_off.gif" id="del_btn_off" width="17" height="16" hspace="3" border="0" align="absmiddle" onmousedown="if (this.id!='del_btn_off') { this.style.paddingTop='1px'; this.style.paddingLeft='1px';}" onmouseup="if (this.id!='del_btn_off') { this.style.paddingTop='0px'; this.style.paddingLeft='0px'; if (confirm('Выбранные разделы будут полностью удалены!\r\n \r\nВы уверены?')) { get_id('form_action').value='delete'; menu_form.submit();};}" alt="Удалить страницы"  title="Удалить страницы"/></div></td>
<td>&nbsp;</td><td width='24' align="center">
<div onmouseover="this.style.borderLeft='1px solid #8791a4'; this.style.borderRight='1px solid #8791a4';" onmouseout="this.style.borderLeft='0px solid #8791a4'; this.style.borderRight='0px solid #8791a4';" style="height:17px; border-left:0px solid #8791a4; border-right:0px solid #8791a4; padding-top:3px;">
<img  src="../images/webcms/ico_cancel_off.gif" id="cancel_btn_off" width="15" height="15" hspace="3" border="0" align="absmiddle" onmousedown="if (this.id!='cancel_btn_off') { this.style.paddingTop='1px'; this.style.paddingLeft='1px';}" onmouseup="if (this.id!='cancel_btn_off') { this.style.paddingTop='0px'; this.style.paddingLeft='0px'; get_id('form_action').value=''; menu_form.submit();}" alt="Отменить изменения" title="Отменить изменения"/></div></td></tr></table></div>
<div style="display:none; position:absolute;" id="div_ajax"></div>

<div style="padding:3px; height:400px; overflow-y:auto; overflow-x:none; scrollbar-3dlight-color:#8791a4;
	scrollbar-arrow-color:#010000;
	scrollbar-highlight-color: #f9f9f9;
	scrollbar-face-color:#f9f9f9;
	scrollbar-shadow-color:#f9f9f9;
	scrollbar-darkshadow-color:#8791a4;
	scrollbar-track-color: #e3e5ea; " id="karta">
<?
$date = date("d.m.Y.H.i");
if (isset($_GET['action']))
{
$action = $_GET['action'];
}
if (isset($_POST['action']))
{
$action = $_POST['action'];
}
if (!isset($action)) $action="";

///// НАСТРОЙКИ ПУНКТА МЕНЮ
if ($action=="edit_menu")
	{
		if (!isset($_POST['show_in_menu']))
		{
		$show_in_menu = 0;
		}
		else
		{
		$show_in_menu = $_POST['show_in_menu'];
		}
		if (isset($_POST['target']) and $_POST['target']=="1" and $_POST['link']!="")
			{
				$_POST['link']=$_POST['link'] . "::true";
			}
		$q = "UPDATE menu_items SET show_in_menu='$show_in_menu', link='$_POST[link]', date_edit='$date', user_edit='$_SESSION[logged_user_id]' WHERE id='$_GET[cat_id]' AND (link!='$_POST[link]' OR show_in_menu!='$show_in_menu')";
		doquery($q);
		$action="";
	}
////////// ПЕРЕМЕЩЕНИЕ РАЗДЕЛОВ
if ($action=="move_to")
	{
	$q = "SELECT level FROM menu_items WHERE id='$_POST[moveto]'";
		$menu = mysql_fetch_assoc(doquery($q));
		$checked_menu = $_POST['checked_menu'];
		while (count($checked_menu)!=0)
			{

			$value = $checked_menu[0];
			$new_lev = $menu['level']+1;
			$q = "UPDATE menu_items SET menu_id='$_POST[moveto_menu]', cat_id='$_POST[moveto]', level='$new_lev' WHERE id='$value'";
			doquery($q);
			// ищем детей

				$checked_menu = move_childs($checked_menu, $value,$_POST['moveto_menu'], $new_lev+1);
							unset($checked_menu[0]);
					$checked_menu = array_values($checked_menu);
			}
			$action="";
	}
	if ($action=="delete")
	{
		foreach($_POST['checked_menu'] as $value)
		{
		// ПОЛУЧАЕМ БЛОКИ
		$q = "SELECT id,block_type FROM page_blocks WHERE menu_id='$value'";
				$do = doquery($q);
				while ($bl = mysql_fetch_assoc($do))
					{
						if ($bl['block_type']=="1")
							{
									$q = "SELECT id,photo FROM photos WHERE block_id='$bl[id]'";
												$do_ph = doquery($q);
												while ($photo = mysql_fetch_assoc($do_ph))
													{
														unlink("../photogallery/thumbs/$photo[photo].jpg");
														unlink("../photogallery/originals/$photo[photo].jpg");
														unlink("../photogallery/photos/$photo[photo].jpg");
														$q = "DELETE FROM photos WHERE id='$photo[id]'";
														doquery($q);
													}
							}
							$q = "DELETE FROM page_blocks WHERE id='$bl[id]'";
														doquery($q);
					}
			$q = "DELETE FROM menu_items WHERE id='$value' LIMIT 1";
			doquery($q);
				if (is_file("../page_icons/$value.jpg"))
					{
					unlink("../page_icons/$value.jpg");
					}
		}
		$action="";
	}
///// ВНЕСЕНИЕ ИЗМЕНЕНИЙ (КНОПКА SAVE)
if ($action=="save_changes")
	{
	// Обновляем расположение
	$new_name = $_POST['menu_name'];
	foreach ($_POST['menu_pos'] as $id => $pos)
		{

		$q = "UPDATE menu_items SET position='$pos', name='$new_name[$id]', full_name='$new_name[$id]',  key_name='".transliterate($new_name["$id"])."', date_edit='$date', user_edit='$_SESSION[logged_user_id]' WHERE id='$id' AND (position!='$pos' OR name!='$new_name[$id]')";
		//echo "$q<br />";
		doquery($q);
		}
	$action= "";
	}

/////////// ДОБАВЛЕНИЕ ПУНКТОВ
if ($action=="add_item")
	{
	if (!isset($link)) $link="";
		if ($_GET['cat_id']=="0")
		{
		$level=1;
		}
		else
		{
		$q = "SELECT level FROM menu_items WHERE menu_id='$_GET[menu]' AND id='$_GET[cat_id]'";
		$res = mysql_fetch_assoc(doquery($q));
		$level = $res["level"]+1;
		}

		$names = explode("\r\n",$_POST['name']);
			for ($i=0;$i<count($names);$i++)
				{
				$names[$i] = trim($names[$i]);
				if ($names[$i]!="")
					{
		$position = get_last_position ($_GET['menu'],$level) +1;
		$key_name =  check_key_name(transliterate($names[$i]),"");
	$q = "INSERT INTO menu_items SET menu_id='$_GET[menu]', name='$names[$i]', full_name='$names[$i]', key_name='$key_name', cat_id='$_GET[cat_id]', link='$link',level='$level', position='$position'";
	doquery($q);
					}
				}
	$action="";
	}

if ($action=="")
{
	$q = "SELECT * FROM menu ORDER BY position";
	$do = doquery($q);
	echo "<form name='menu_form' action='menu_items.php' style='padding:0px; margin:0px;' method='post'>
	<input type='hidden' id='form_action' name='action' value=''>
	<input type='hidden' id='form_moveto' name='moveto' value=''>
	<input type='hidden' id='form_moveto_menu' name='moveto_menu' value='0'>";

		while ($menu = mysql_fetch_assoc($do))
			{


			echo "<div style='border:1px solid #8791a4; background-color:#ffffff; padding:2px;' id='cat_menu_item_$menu[id]'><img id='moveto_cats_$menu[id]' align='absmiddle' onclick=\"get_id('form_action').value='move_to'; get_id('form_moveto_menu').value='$menu[id]'; get_id('form_moveto').value='0'; menu_form.submit();\" src='../images/webcms/arr_right.gif' border='0' style='display:none;' title='Переместить в этот раздел'> <a href='pages.php?menu_id=0&cat_id=$menu[id]' onclick=\"select_cat('0','$menu[id]');\" target='main'><strong>$menu[name]</strong></a></div>
			<div style='border:1px solid #8791a4;  margin-top:7px;'><div>";
			get_menu_structure($menu['id'], "0");
			echo "</div></div>";
			/// ССЫЛКА
			echo "<div style='clear:both;'></div><br /><br />";
			}
	echo "</form>";

		if (isset($_SESSION['selected_menu']))
				{
				echo "<script type=\"text/javascript\" language=\"javascript\">
				select_cat($_SESSION[selected_catmenu],$_SESSION[selected_menu]);
				parent.main.location.href='pages.php?menu_id=$_SESSION[selected_catmenu]&cat_id=$_SESSION[selected_menu]';
				</script>";
				}
}
?>
</div>
<script language="javascript" type="text/javascript">
get_id('karta').style.height = getClientHeight()-102 + 'px';
</script>
<?
require("../templates/admin_footer.php");
?>