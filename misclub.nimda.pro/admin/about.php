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
<strong>������� ���������� ������ Web<span style="color:#0ac32a;">CMS</span> 2</strong><br>
<div style="padding:4px; font-size:11px;"><strong>������������� ������ �������:</strong> 
<?
echo $info['webcms']['version']; 
?>
<br>
<?
$f = file("http://7335.aqq.ru/sys/webcms.txt");
$w = explode("::",$f[0]);
if (trim($w[1])!=trim($info['webcms']['version']))
{
echo "<span style='color:#ff0000;'><strong>������� ������ �������:</strong> $w[1]</span>";
}
else
{
echo "<strong>������� ������ �������:</strong> $w[1]";
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
<strong>������������� ������</strong><br>
<div style="padding:4px; font-size:11px;">
<?
	foreach ($info as $key=>$value)
		{
			if ($key!="webcms")
			{
			echo "<strong>$value[name]:</strong> $value[version] (������� ������: $newest[$key])<br>";
			}
		}
?>
</div>
<br>
�� �������� ���������� ����� ������ WebCMS, ��������� � ���������� ����������� ������� ����������� � �������� "<a href="http://www.web-arena.ru/" target="_blank">���-�����</a>".<br>
<br>

<span style="font-size:11px;">&copy; ��� ����� �� ���������������, ������������� � ��������� ����� ������ ���� ������� WebCMS ����������� �������� "���-�����", 2010 ���.</span>
</div>
<?
require("../templates/admin_footer.php");
?>