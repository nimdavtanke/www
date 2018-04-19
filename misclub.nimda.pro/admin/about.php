<?
header('Content-type: text/html; charset=windows-1251');
require("../functions/main.func.php");
require("../functions/admin.func.php");
$showhide_frame = true;
require("../templates/admin_header.php");
?>
<?
$q = "SELECT * FROM webcms_info";
	$do = doquery($q);
		while ($res = mysql_fetch_assoc($do))
			{
				$info["$res[code]"]["name"] = $res['name'];
				$info["$res[code]"]["version"] = $res['version'];
			}
?>
<div style="padding-left:7px;">
<br />
<strong>Система Управления сайтом Web<span style="color:#0ac32a;">CMS</span> 2</strong><br>
<div style="padding:4px; font-size:11px;"><strong>Установленная версия системы:</strong> 
<?
echo $info['webcms']['version']; 
?>
<br>
<?
$f = file("http://7335.aqq.ru/sys/webcms.txt");
$w = explode("::",$f[0]);
if (trim($w[1])!=trim($info['webcms']['version']))
{
echo "<span style='color:#ff0000;'><strong>Текущая версия системы:</strong> $w[1]</span>";
}
else
{
echo "<strong>Текущая версия системы:</strong> $w[1]";
}
foreach ($f as $key=>$value)
	{
		if ($key!=0)
			{
			$w = explode("::",$value);
			$newest["$w[0]"]=$w[1];
			}
	}
?>
</div><br>
<strong>Установленные модули</strong><br>
<div style="padding:4px; font-size:11px;">
<?
	foreach ($info as $key=>$value)
		{
			if ($key!="webcms")
			{
			echo "<strong>$value[name]:</strong> $value[version] (текущая версия: $newest[$key])<br>";
			}
		}
?>
</div>
<br>
По вопросам обновления Вашей версии WebCMS, установки и обновления программных модулей обращайтесь в компанию "<a href="http://www.web-arena.ru/" target="_blank">Веб-Арена</a>".<br>
<br>

<span style="font-size:11px;">&copy; Все права на распространение, использование и изменение любых частей кода системы WebCMS принадлежат компании "Веб-Арена", 2010 год.</span>
</div>
<?
require("../templates/admin_footer.php");
?>