<?

require("../functions/main.func.php");
require("../functions/admin.func.php");

require("../templates/admin_header.php");

?>
<?
if (isset($_GET['action']))
{
$action = $_GET['action'];
}
if (isset($_POST['action']))
{
$action = $_POST['action'];
}
if (!isset($action)) $action="";

//////////////// ДОБАВЛЕНИЕ БЛОКА МЕНЮ
if ($action =="pos")
{
    $pos = $_POST['pos'];
    	foreach ($pos as $id=>$position)
    		{
    		$q=  "UPDATE menu SET position='$position' WHERE id='$id'";
    		doquery($q);
    			}
    			echo "<strong style='color:#009900;'>Сохранено!</strong>";
    			$action="";	}
	if ($action =="add_menu")
		{
		if ($_POST['name']=="")
			{
			echo "<font color='#FF0000'>Не указано название блока!</font><br>";
			}
			else
			{

			$q = "INSERT INTO menu SET name='$_POST[name]', style='$_POST[style]'";
			doquery($q);
			}
			$action ="";
		}
		if ($action=="")
			{
			$q = "SELECT * FROM menu ORDER BY position";
			$do = doquery($q);
			echo "<form method='POST' action='menu.php?action=pos'><table border='0' cellpadding='0' cellspacing='0'><tr><td bgcolor='#000000'><table border='0' cellpadding='4' cellspacing='1' class='admin_table'><tr><th>ID</th><th>Название</th><th>Порядок</th></tr>";
				while ($menu=mysql_fetch_assoc($do))
					{
					echo "<tr><td>$menu[id]</td><td>$menu[name]</td><td><input type='text' size='5' value='$menu[position]' name='pos[$menu[id]]' class='admin_input'/></td></tr>";
					}
					echo "<tr><td colspan='3'><input type='submit' value='сохранить' class='admin_input'></td></tr></table></td></tr></table></form>";
					///////////////////////// ФОРМА ДОБАВЛЕНИЯ БЛОКА МЕНЮ

			echo "<br><form action='menu.php?action=add_menu' method='POST'><table border='0' cellpadding='3' cellspacing='0' style='border:1px solid #000000;' class='admin_table'>
			<tr><th colspan='2' style='border-bottom:1px solid #000000;'>Добавить блок меню</th></tr>
			<tr><td>Название меню:</td><td><input type='text' class='admin_input' name='name'></td></tr>
			<tr><td>Базовый стиль:</td><td><input type='text' class='admin_input' name='style'></td></tr>
			<tr><td align='center' colspan='2'><input type='submit' class='admin_input' value='Сохранить'></td></tr>
			</table></form>";
			}
?>
<?
require("../templates/admin_footer.php");
?>