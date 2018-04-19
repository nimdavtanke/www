<?
header('Content-type: text/html; charset=windows-1251');
require("../functions/main.func.php");
require("../functions/admin.func.php");
require("../templates/admin_header.php");

if (isset($_GET['action']))
{
$action = $_GET['action'];
}
if (isset($_POST['action']))
{
$action = $_POST['action'];
}
if (!isset($action)) $action="";

if ($action=="show_sub")
	{
	if (!isset($_SESSION['showed_cats'])) $_SESSION['showed_cats'] = array();
	if (!in_array($_GET['id'],$_SESSION['showed_cats']))
		{
		$_SESSION['showed_cats'][]= $_GET['id'];
		}
	}
	
	if ($action=="hide_sub")
	{
	if (!isset($_SESSION['showed_cats'])) $_SESSION['showed_cats'] = array();
		$key = array_search($_GET['id'],$_SESSION['showed_cats']);
		if ($key!==false)
			{
			unset($_SESSION['showed_cats'][$key]);
			}
	}


if ($action == "edit_form")
	{
	if (!isset($_GET['cat_id']) or $_GET['cat_id']=="0")
		{
		$cat_id = "0";
		$name = "Коренной раздел";
		$additional_form = "";
		}
	else
		{
		$q = "SELECT name FROM menu_items WHERE id='$_GET[cat_id]'";
			$res = mysql_fetch_assoc(doquery($q));
			$name = $res['name'];
			$additional_form = "Изменить название $name<br>
<form action='menu_items.php?action=change_name&id=$cat_id' method='post' target='site_structure'>
			<input name='newname' class='admin_input'> <input type='submit' value='Изменить' class='admin_input'>
			</form>";
		}
			echo "$additional_form Добавить пункты в $name<br /><form action='menu_items.php?action=add_item&menu=$_GET[menu_id]&cat_id=$_GET[cat_id]' method='post' target='site_structure'>
			<textarea name='name' class='admin_input' cols='30' rows='2' style='overflow-y:hidden;' onkeyup=\"if(this.scrollHeight >=this.offsetHeight) { this.style.height = this.scrollHeight+10; }\"></textarea> <input type='submit' value='Добавить' class='admin_input'>
			</form>";

	}
	require("../templates/admin_footer.php");
?>