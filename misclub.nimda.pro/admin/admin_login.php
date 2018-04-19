<?
session_start();
if (isset($_SESSION["enter_count"]) and $_SESSION["enter_count"]>=3) die("Ваш ip временно заблокирован!");
if (isset($_GET['action']) and $_GET['action']=="logout")
{
unset($_SESSION["logged_user"]);
unset($_SESSION['logged_user_id']);
session_destroy();
}
require("../functions/admin.func.php");
require("../functions/main.func.php");

$webcms=get_webcms_version();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>WebCMS  <? echo "$webcms[webcms]"; ?></title>
<link rel="stylesheet" type="text/css" href="admin_style.css">
<link rel="stylesheet" type="text/css" href="../style.css">
<script type="text/javascript" language="javascript" src="../js/ajax.js"></script>
<script type="text/javascript" language="javascript" src="../js/jscripts.js"></script>
<script type="text/javascript" language="javascript" src="../js/adminjs.js"></script>
<script type="text/javascript" language="javascript">
preloader = new Image();
preloader.src="../images/webcms/wait.gif";
check_img = new Image();
check_img.src="../images/webcms/checked.gif";
uncheck_img = new Image();
uncheck_img.src="../images/webcms/unchecked.gif";
</script>
</head>

<body style="margin:0px; padding:0px; background-color:#f9f9f9;" onunload="admin_unload();">
<div id="div_wait" align="center"><img src="../images/webcms/wait.gif" border="0" /></div>
<div id="admin_content" style="display:none;" align="center">
<div align="center">
<table border="0" cellpadding="4" cellspacing="0">
<tr>
<td align="left">
<img src="../images/webcms/logo.gif" boreder="0" vspace="5" hspace="5"/>
</td>
</tr>
<tr>
<td style="border:1px solid #8791a4; " align="left">
	<h3 style="padding:0px; margin:0px;">Вход в панель управления</h3>
    <?
	if (isset($_GET['error']))
		{
		$pop =  3-$_SESSION['enter_count'];
			switch($_GET['error'])
				{
				case "1": echo "<br /><span style='color:#ff0000'><strong>Логин или пароль введены неверно!</strong><br />Ваш IP будет заблокирован, после " .$pop . " попытки</span><br /><br />"; break;
				}
		}
	?>
    	<form action="authorize.php" method="post" style="padding:0px; margin:0px;">
        <table border="0" cellpadding="4" cellspacing="0">
        <tr>
        <td>Логин:</td>
        <td><input type="text" class="admin_input" name="login"/></td>
        </tr>
        <tr>
        <td>Пароль:</td>
        <td><input type="password" class="admin_input" name="password"/></td>
        </tr>
        <tr>
        <td align="center" colspan="2"><input type="Submit" value="Вход" class="admin_input_button" name="submit"/></td>
        </tr>
        </table>
        </form>
</td>
</tr>
</table>
</div>
</div>
</body>
</html>