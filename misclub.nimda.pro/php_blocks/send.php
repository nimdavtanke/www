<?
error_reporting(0);
$error="";
$date = date("d.m.Y H:i");
$error="";
$show_form = true;
if (isset($_POST['send']) and $_POST['send'])
{
// Проверка обязательных полей

foreach ($_POST as $key=>$val)
	{
			if (isset($_POST["$key"."_required"]) and $val=="")
				{
					$error .= "Не заполнено поле &quot;".$_POST["$key"."_required"]."&quot;<br />";
				}
	}
		if (isset($_SESSION['crypt_code']) and !empty($_SESSION['crypt_code']) and $_SESSION['crypt_code']!=$_POST['order_captha'])
		{
			$error .= "Код подтверждения введен неверно!<br />";
		}
	if ($error=="")
		{
		$send_body = file_get_contents( "$DOC_ROOT"."templates/send_form/letter.html" );
$send_body = str_replace("\"","\\\"",$send_body);
eval ("\$send_body = \"$send_body\";");
		if (send_mail($options["admin_email"], "Письмо", "$send_body", $options["admin_email"], ""))
			{
				 $get_tmp = file_get_contents( "$DOC_ROOT"."templates/send_form/send_ok.html" );
					$get_tmp = str_replace("\"","\\\"",$get_tmp);
					eval ("\$error = \"$get_tmp\";");
					$show_form = false;
			}
		}
}

if ($show_form)
{

 $get_tmp = file_get_contents( "templates/send_form/form.html" );
$get_tmp = str_replace("\"","\\\"",$get_tmp);
eval ("\$str = \"$get_tmp\";");
echo "$str";
}
else
{
	echo "$error";
}
?>
