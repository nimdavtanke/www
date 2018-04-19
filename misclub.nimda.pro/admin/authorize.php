<?
session_start();
require("../functions/main.func.php");
if (!isset($_SESSION["enter_count"])) $_SESSION["enter_count"]=0;
if ($_SESSION["enter_count"]>=3) die("Ваш ip временно заблокирован!");
	if (!isset($_POST['submit']))
		{
		header("Location: admin_login.php");
		}
		else
		{
			// получаем данные администраторв
			$q = "SELECT * FROM users WHERE login='".mysql_escape_string("$_POST[login]")."' AND password='".mysql_escape_string(md5("$_POST[password]"))."'";
				$do = doquery($q);
					if (mysql_num_rows($do)!="1")
						{
						$_SESSION["enter_count"] = $_SESSION["enter_count"]+1;
							if ($_SESSION["enter_count"]==3)
								{
								$ip = get_userIP();
								send_mail($options["admin_email"], "Неудачная попытка входа в панель управления!", "Пользователь с ip $ip трижды ввел неправильные данные для входа в Панель управления.", $options["admin_email"], "");
								}
								header("Location: admin_login.php?error=1");
						}
						else
						{
						$user = mysql_fetch_assoc($do);
							$_SESSION["logged_user_id"] = $user["id"];
									$_SESSION['KCFINDER'] = array();
									$_SESSION['KCFINDER']['disabled'] = false;
							header("Location: index.php");
						}
						
		}
?>