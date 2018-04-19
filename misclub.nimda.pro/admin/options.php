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
if (isset($_GET['action']))
{
$action = $_GET['action'];
}
if (isset($_POST['action']))
{
$action = $_POST['action'];
}
if (!isset($action)) $action="";

if ($action =="")
	{
	 echo "<strong>Настройки сайта</strong><br />";
	 echo "<form action='options.php?action=save' method='post' style='padding:0px; margin:0px;'>";
		$q = "SELECT * FROM settings_groups ORDER BY group_position";
		$do = doquery($q);
		while ($group = mysql_fetch_array($do))
		{
		echo "<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'
><div id='close_$group[id]' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"get_id('edit_$group[id]').style.display='none';get_id('close_$group[id]').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму' title='Скрыть форму' border='0'></div>
<a onclick=\"if (get_id('edit_$group[id]').style.display==''){get_id('edit_$group[id]').style.display='none';get_id('close_$group[id]').style.display='none';} else {get_id('edit_$group[id]').style.display='';get_id('close_$group[id]').style.display='';}\"><strong>$group[group_name]</strong></a><br />
<div id='edit_$group[id]' style='display:none;'>";
			$get_opt = "SELECT * FROM settings WHERE option_groupid='$group[id]' ORDER BY position";
				$do_opt = doquery($get_opt);
				while ($opt = mysql_fetch_array($do_opt))
				{
				echo "<br /><br /><strong>$opt[option_name]</strong><br />
<div class='helptext'>$opt[option_descr]</div>";
if ($opt["option_type"]=="text")
{
echo "<input type='text' class='admin_input' value='$opt[option_value]' name='edit[$opt[option_var]]' style='width:350px;'>";
}
elseif($opt["option_type"]=="textarea")
{
echo "<textarea class='admin_input' name='edit[$opt[option_var]]' cols=50 rows=8 style='width:350px;'>$opt[option_value]</textarea>";
}
elseif($opt["option_type"]=="yesno")
{
$selected = get_selected_opt ($opt["option_value"],"2");
echo "<label>
      <input type='radio' name='edit[$opt[option_var]]' value='1' $selected[1] >
      Да</label>
    <label>
      <input type='radio'  name='edit[$opt[option_var]]' value='0' $selected[0]>
     Нет</label>";
}
elseif($opt["option_type"]=="select")
{
echo "<select class='admin_input' name='edit[$opt[option_var]]'>";
$options = explode("|",$opt["option_select"]);
	for ($o=0; $o<count($options);$o++)
		{
			$val = explode("=",$options[$o]);
			if ($val[1]!=$opt["option_value"])
				{
		echo "<option value='$val[1]'>$val[0]</option>";
				}
				else
				{
				echo "<option value='$val[1]' selected='selected'>$val[0]</option>";
				}
		}
echo "</select>";
}
				}
				echo "<br /><div style='padding:5px;' align='right'><input type='submit' id='but_save'  class='admin_input' value='Сохранить'></div><br />";

			echo "</div></td></tr></table>";
		}
	echo "</form>";

		echo "<form action='options.php?action=upload_style' method='post'  ENCTYPE=\"multipart/form-data\"><table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'
><div id='close_style' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"get_id('edit_style').style.display='none';get_id('close_style').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму' title='Скрыть форму' border='0'></div>
<a onclick=\"if (get_id('close_style').style.display==''){get_id('edit_style').style.display='none';get_id('close_style').style.display='none';} else {get_id('edit_style').style.display='';get_id('close_style').style.display='';}\"><strong>Загрузить стиль</strong></a><br />
<div id='edit_style' style='display:none;'><br />
<strong>.ZIP-архив со стилем</strong><br /><input type='file' name='style' class='admin_input' style='width:400px;'>";

				echo "<div style='padding:5px;' align='right'><input type='submit' id='but_save'  class='admin_input' value='Сохранить'></div><br />";

			echo "</div></td></tr></table></form>";

			echo "<form action='options.php?action=upload_mod' method='post'  ENCTYPE=\"multipart/form-data\"><table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;'>
<tr>
<td>
<div style='padding:3px 7px 3px 7px;'
><div id='close_modules' style='float:right; display:none;'><img style='cursor:pointer;' onclick=\"get_id('edit_modules').style.display='none';get_id('close_modules').style.display='none';\" src='../images/webcms/ico_close.gif' alt='Скрыть форму' title='Скрыть форму' border='0'></div>
<a onclick=\"if (get_id('close_modules').style.display==''){get_id('edit_modules').style.display='none';get_id('close_modules').style.display='none';} else {get_id('edit_modules').style.display='';get_id('close_modules').style.display='';}\"><strong>Загрузить/обновить дополнения</strong></a><br />
<div id='edit_modules' style='display:none;'><br />
<strong>.ZIP-архив с модулем</strong><br /><input type='file' name='module' class='admin_input' style='width:400px;'>";

				echo "<div style='padding:5px;' align='right'><input type='submit' id='but_save'  class='admin_input' value='Сохранить'></div><br />";

			echo "</div></td></tr></table></form>";


	}
if ($action=="save")
{
$error = false;
for ($i=0; $i<count($_POST['edit']); $i++)
{
$opt_edit = each($_POST['edit']);
$key = $opt_edit["key"];
$q = "UPDATE settings SET option_value='$opt_edit[value]' WHERE option_var='$key'";
	if ($key == "rewrite_url")
		{
		// Обработка .htaccess
			if ($opt_edit['value']==0)
				{
					if (is_file("../.htaccess"))
						{
							$file = file("../.htaccess");
							$start_del = false;
								foreach ($file as $key=>$val)
									{
									$val = str_replace("\r","",$val);
									$val = str_replace("\n","",$val);
									$val =trim($val);
										if ($start_del)
											{
											unset($file[$key]);
											}
											if($val=="# WebCMS #")
												{
													if (!$start_del)
														{
														$start_del = true;
														unset($file[$key]);
														}
														else
														{
														$start_del = false;
														unset($file[$key]);
														}
												}


									}
									$file = implode("\r\n",$file);
										// Записать в файл
										$fp = fopen( "../.htaccess", "w");
											fwrite($fp, $file);
												fclose($fp);
						}
				}
				else // Если надо переписать URLs
				{
				if (!is_file("../.htaccess"))
					{
					$fp = fopen( "../.htaccess", "w");
					fclose($fp);
					}
				$file = file("../.htaccess");
							$start_del = false;
								foreach ($file as $key=>$val)
									{
									$val = str_replace("\r","",$val);
									$val = str_replace("\n","",$val);
									$val =trim($val);
										if ($start_del)
											{
											unset($file[$key]);
											}
											if($val=="# WebCMS #")
												{
													if (!$start_del)
														{
														$start_del = true;
														unset($file[$key]);
														}
														else
														{
														$start_del = false;
														unset($file[$key]);
														}
												}


									}
								$base = str_replace("/admin/options.php?action=save","",$_SERVER['REQUEST_URI']);
								$file[] = "# WebCMS #
<IfModule mod_rewrite.c>
Options +FollowSymLinks
RewriteEngine On
RewriteBase $base/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . $base/index.php [L]
</IfModule>
# WebCMS #";
									$file = implode("\r\n",$file);
										// Записать в файл
										$fp = fopen( "../.htaccess", "w");
											fwrite($fp, $file);
												fclose($fp);

				}
		}
if(!doquery($q))
{
$error==true;
}
}
echo "<h3>Сохранение</h3>";
if ($error)
{
echo "Произошла ошибка!";
}
else
{
echo "Настройки сохранены!";
}
}

if ($action=="upload_style")
{
error_reporting(E_ALL);
  $path_info = pathinfo($_FILES['style']['name']);

if ($path_info['extension']=="zip")
{
require("../functions/pclzip.lib.php");
// Сохраняем файл во временную папку
copy($_FILES['style']['tmp_name'],"tmp/style.zip");
$archive = new PclZip("tmp/style.zip");
$list = $archive->extract(PCLZIP_OPT_PATH, "tmp/unzip", PCLZIP_OPT_ADD_PATH,"");
if (is_file("tmp/unzip/style.css"))
	{
		if (copy("tmp/unzip/style.css","../style.css"))
			{
			echo "Файл <strong>style.css</strong> обновлен!<br />";
			}
	}

if (is_file("tmp/unzip/main.html"))
	{
		if (copy("tmp/unzip/main.html","../templates/main.html"))
			{
			echo "Файл <strong>main.html</strong> обновлен!<br />";
			}
	}

										$main_dir = "tmp/unzip/images/design";
										if (is_dir($main_dir))
											{
									 $open_sub=opendir("$main_dir");

														  while ($get_file = readdir($open_sub))
															{

															$filename = $main_dir . "/".$get_file;

															if (is_file($filename))
															{
															$w = "загружен";
															if (is_file("../images/design/$get_file"))
																{
																$w = "обновлен";
																}
															if (copy("$filename","../images/design/$get_file"))
																{
																echo "Файл <strong>$filename</strong> $w!<br />";
																}
															}
															}
												}
															if (is_dir("tmp/unzip/templates"))
																{
																	upload_modules("tmp/unzip/templates","tmp/unzip/");
																}
															if (is_dir("tmp/unzip/blocks_include"))
																{
																	upload_modules("tmp/unzip/blocks_include","tmp/unzip/");
																}
							remove_dir("tmp");
}
else
{
	echo "<strong style='color:#990000;'>Ошибка загрузки стиля! Закачайте ZIP архив!</strong>";
}
}

if ($action=="upload_mod")
{

$path_info = pathinfo($_FILES['module']['name']);

if ($path_info['extension']=="zip")
{
require("../functions/pclzip.lib.php");
// Сохраняем файл во временную папку
copy($_FILES['module']['tmp_name'],"tmp/module.zip");
$archive = new PclZip("tmp/module.zip");
$list = $archive->extract(PCLZIP_OPT_PATH, "tmp", PCLZIP_OPT_ADD_PATH,"");
if (is_file("tmp/install.php"))
	{
require("tmp/install.php");
	}
	else
	{
	echo "<strong style='color:#990000;'>Ошибка! Не найден файл установки модуля!</strong>";
	}
}
else
{
	echo "<strong style='color:#990000;'>Ошибка загрузки модуля! Закачайте ZIP архив!</strong>";
}

}
?>

		</div>
<?
require("../templates/admin_footer.php");
?>
