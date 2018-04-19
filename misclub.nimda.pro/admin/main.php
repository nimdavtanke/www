<?
header('Content-type: text/html; charset=windows-1251');
require("../functions/main.func.php");
require("../functions/admin.func.php");
$showhide_frame = true;
$body_style="background-color:#f9f9f9;  background-image: url(../images/webcms/body_bg.gif); background-position: top left; background-repeat: repeat-y; padding-left:7px;";

require("../templates/admin_header.php");
?>

<h3>Панель управления сайтом</h3>
Приветствуем вас на главной странице Панели управления Вашим сайтом!<br /><br />

Приятной работы!
<?
echo "";
require("../templates/admin_footer.php");
?>