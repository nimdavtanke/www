<?php
if (isset($_SESSION["enter_count"]) and $_SESSION["enter_count"]>=3)
{
die("��� ip �������� ������������!");
}

	if (!isset($_SESSION['logged_user_id']) or $_SESSION['logged_user_id']=="")
		{
		 header("Location: admin_login.php");
		echo "�� �������� ����!";
		die();
		}
		else
		{
		$q = "SELECT * FROM users WHERE id='$_SESSION[logged_user_id]'";
		$logged_user = mysql_fetch_assoc(doquery($q));
		}
?>