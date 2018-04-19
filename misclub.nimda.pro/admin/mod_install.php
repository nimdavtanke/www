<?
header('Content-type: text/html; charset=windows-1251');
require("../functions/main.func.php");
require("../functions/admin.func.php");
$showhide_frame = true;
$body_style="background-color:#f9f9f9;  background-image: url(../images/webcms/body_bg.gif); background-position: top left; background-repeat: repeat-y; padding-left:7px;";
require("../templates/admin_header.php");
?>
<div style="padding-left:3px;">

<?
if (is_file("tmp/install.php"))
{
	require("tmp/install.php");
}
else
{
echo "Файл установки модулей не найден!";
}
?>
		</div>	
<?
require("../templates/admin_footer.php");
?>
