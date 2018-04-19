<?
header('Content-type: text/html; charset=windows-1251');
require("../functions/main.func.php");
require("../functions/admin.func.php");
$showhide_frame = true;
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
$q = "SELECT * FROM users WHERE id='$_SESSION[logged_user_id]'";
		$logged_user = mysql_fetch_assoc(doquery($q));
echo "<strong>Пользователь <span style='font-size:14px;'>$logged_user[name] $logged_user[lastname]</span></strong><br />";
if ($action=="edit")
	{
		$q = "UPDATE users SET name='$_POST[name]', lastname='$_POST[lastname]', email='$_POST[email]' WHERE id='$_GET[user]'";
			doquery($q);
			$error = "<br /><span style='color:#009900;'>Изменения сохранены!</span><br />";
	}
	
	if ($action=="edit_userpass")
	{
	if (md5($_POST['pass'])!=$logged_user['password'])
		{
		$error = "Ошибка! Текущий пароль введен неверно!";
		}
		else
		{
			if (md5($_POST['new_pass'])!=md5($_POST['new_pass_confirm']))
				{
				$error = "Ошибка! Введенные пароли не совпадают!";
				}
				else
				{
		$q = "UPDATE users SET login='$_POST[login]', password='". md5("$_POST[new_pass]") . "' WHERE id='$_GET[user]'";
			doquery($q);
		$error = "<br /><span style='color:#009900;'>Пароль изменен!</span><br />";
				}
		}
	}
	
if (isset($error) and $error!="")
				{
				echo "<span style='color:#ff0000; font-weight:bold; font-size:14px;'>$error</span>";
				}

			echo "<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'><div id='close_userinfo' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"document.edit_user.style.display='none';get_id('close_userinfo').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму'  title='Скрыть форму' border='0'></div>
<a onclick=\"if (document.edit_user.style.display==''){document.edit_user.style.display='none';get_id('close_userinfo').style.display='none';} else {document.edit_user.style.display='';get_id('close_userinfo').style.display='';}\"><strong>Данные пользователя</strong></a><br />
<form name='edit_user' action='useredit.php?action=edit&user=$logged_user[id]' method='post' target='main' style='margin:0px; padding:2px; display:none;'>
<br /><strong>Имя</strong>
<div style='margin-top:2px; padding-top:3px;'>
<input type='text' value='$logged_user[name]' name='name' class='admin_input' style='width:600px;'></div>
<br /><strong>Фамилия</strong>
<div style='margin-top:2px; padding-top:3px;'>
<input type='text' value='$logged_user[lastname]' name='lastname' class='admin_input' style='width:600px;'></div>
<br /><strong>E-mail</strong>
<div style='margin-top:2px; padding-top:3px;'>
<input type='text' value='$logged_user[email]' name='email' class='admin_input' style='width:600px;'></div>
			<div align='right' style='padding-top:5px;'><input type='button' onclick=\"edit_user.submit();\" value='Подтвердить изменения' class='admin_input_button'></div>
			</form></div>
			</td></tr></table>";
		
					echo "<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'><div id='close_userpass' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"document.edit_userpass.style.display='none';get_id('close_userpass').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму'  title='Скрыть форму' border='0'></div>
<a onclick=\"if (document.edit_userpass.style.display==''){document.edit_userpass.style.display='none';get_id('close_userpass').style.display='none';} else {document.edit_userpass.style.display='';get_id('close_userpass').style.display='';}\"><strong>Изменение доступа</strong></a><br />
<form name='edit_userpass' action='useredit.php?action=edit_userpass&user=$logged_user[id]' method='post' target='main' style='margin:0px; padding:2px; display:none;'>
<br /><strong>Логин</strong>
<div style='margin-top:2px; padding-top:3px;'>
<input type='text' value='$logged_user[login]' name='login' class='admin_input' style='width:600px;'></div>
<br /><strong>Текущий пароль</strong>
<div style='margin-top:2px; padding-top:3px;'>
<input type='password' value='' name='pass' class='admin_input' style='width:600px;'></div>
<br /><strong>Новый пароль</strong>
<div style='margin-top:2px; padding-top:3px;'>
<input type='password' value='' name='new_pass' class='admin_input' style='width:600px;'></div>
<br /><strong>Подтвердите новый пароль</strong>
<div style='margin-top:2px; padding-top:3px;'>
<input type='password' value='' name='new_pass_confirm' class='admin_input' style='width:600px;'></div>
			<div align='right' style='padding-top:5px;'><input type='button' onclick=\"edit_userpass.submit();\" value='Подтвердить изменения' class='admin_input_button'></div>
			</form></div>
			</td></tr></table>";	
		
			?>
			<?

require("../templates/admin_footer.php");
?>