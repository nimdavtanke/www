<?php
if (isset($_SESSION["enter_count"]) and $_SESSION["enter_count"]>=3)
{
die("Ваш ip временно заблокирован!");
}

	if (!isset($_SESSION['logged_user_id']) or $_SESSION['logged_user_id']=="")
		{
		 header("Location: admin_login.php");
		echo "Не выполнен вход!";
		die();
		}
		else
		{
		$q = "SELECT * FROM users WHERE id='$_SESSION[logged_user_id]'";
		$logged_user = mysql_fetch_assoc(doquery($q));
		}
?>