<?php

session_start();
header('Content-type: text/html; charset=windows-1251');
require("functions/main.func.php");
require("functions/site.func.php");


	$key_name = $_SERVER['REQUEST_URI'];
		$clear_uri = str_replace("?$_SERVER[QUERY_STRING]","","$key_name");
		$key_name = str_replace("?$_SERVER[QUERY_STRING]","","$key_name");
	$dir = "replace_url";
	$opend_dir = opendir($dir);
		 while ($get_file = readdir($opend_dir))
			{
			$filename = $dir . "/".$get_file;
			$path_parts = pathinfo($filename);
			if (is_file($filename) and ($path_parts['extension']=="php"))
				{
					require("$filename");
				}
			}
		if ($clear_uri!="")
		{
		$clear_uri = ($clear_uri[strlen($clear_uri)-1]=="/")?$clear_uri:$clear_uri."/";
         }

         $m_id = find_page_by_url($key_name);
         $q = "SELECT * FROM menu_items WHERE id='$m_id'";


	$do = doquery($q);
	if (mysql_num_rows($do)==0)
		{
		// Страница не найдена
			if (isset($options['page_404']) and $options['page_404']!="" and $options['page_404']!=0)
				{
	$q = "SELECT * FROM menu_items WHERE id='$options[page_404]' LIMIT 0,1";
				}
				else
				{
	$q = "SELECT * FROM menu_items WHERE id='$options[index_id]' LIMIT 0,1";
				}
		$do = doquery($q);
		}
	$page = mysql_fetch_assoc($do);
	$m_id = $page["id"];
	$selected_cats = array("$m_id");
	$selected_cats = get_selected($selected_cats, $m_id);
	$name_header  = $page["name"];
		if ($page["full_name"]!="")
			{
			$name_header = $page["full_name"];
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<?
	// ПОЛУЧАЕМ МЕТЫ
	$q = "SELECT * FROM meta_tags WHERE menu_id='$page[id]'";
					$do = doquery($q);
					while ($meta = mysql_fetch_assoc($do))
									{

									echo "<META NAME=\"$meta[name]\" CONTENT=\"$meta[description]\">
									";
									}
?>

<title><? echo "$options[site_title] $page[title]"; ?></title>
<base href="<? echo "$options[site_url]"; ?>">

<link rel="stylesheet" type="text/css" href="admin/admin_style.css">

<?
// Подключаем css
$dir = "css";
	$opend_dir = opendir($dir);
		 while ($get_file = readdir($opend_dir))
			{
			$filename = $dir . "/".$get_file;
			$path_parts = pathinfo($filename);
			if (is_file($filename) and ($path_parts['extension']=="css"))
				{
					echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$filename\">";
				}
			}
?>
<script type="text/javascript" language="javascript" src="/js/site.js"></script>
<script type="text/javascript" language="javascript" src="/js/site.js"></script>
<script type="text/javascript" language="javascript" src="/js/ajax.js"></script>
<script type="text/javascript" language="javascript" src="/js/jscripts.js"></script>
<script type="text/javascript" language="javascript" src="/js/site.js"></script>
<script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="/js/photoviewer.js"></script>
<script type="text/javascript" language="javascript">
</script>
</head>


<?
$is_admin = false;
if ($options['is_open']=="1" or (isset($_SESSION['logged_user_id']) and $_SESSION['logged_user_id']!="" and $_SESSION['logged_user_id']!="0"))
{
///
// Вставка доп модулей
///
$dir = "blocks_include";
	$opend_dir = opendir($dir);
		 while ($get_file = readdir($opend_dir))
			{
			$filename = $dir . "/".$get_file;
			$path_parts = pathinfo($filename);
			if (is_file($filename) and ($path_parts['extension']=="php"))
				{
					require("$filename");
				}
			}

if (isset($_SESSION['logged_user_id']) and $_SESSION['logged_user_id']!="" and $_SESSION['logged_user_id']!="0")
{
$is_admin=true;
require("functions/admin.func.php");

echo "<script type='text/javascript' language='javascript' src='/js/quickedit.js'></script>
  <script type='text/javascript' language='javascript' src='/editor/ckeditor.js'></script>";

    // quickEdit
    require("quick_edit.php");
}



 $tmp = file_get_contents( "templates/main.html" );

$tmp = explode("[!webCMS main!]",$tmp);


$tmp[0] = str_replace("\"","\\\"",$tmp[0]);
eval ("\$str = \"$tmp[0]\";");
						echo "$str";

              if ($is_admin)
              	{
              	echo "<table border='0' cellpadding='0' cellspacing='0' id='save_all_top' style='display:none; margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='#' onclick=\"save_block_positions('$clear_uri'); return false;\"><img src='/images/webcms/ico_save.gif' border='0' align='absmiddle'> Сохранить изменения</a></div></td>
</tr>
</table>";              		}

//получаем блоки
$q = "SELECT * FROM page_blocks WHERE menu_id='$page[id]' ORDER BY position";
	$do = doquery($q);
	while ($blocks = mysql_fetch_assoc($do))
			{
			echo "<div style='width:$blocks[width]%; float:left;'><div class='inner_padding'>";
                 if ($is_admin and $_SESSION['quick_edit_mode'])
					{
			$dir = "quick_edit";
					}
					else
					{
					  $dir = "site_blocks";						}
	$opend_dir = scandir($dir);
		 foreach ($opend_dir as $get_file)
			{
			$filename = $dir . "/".$get_file;
			$path_parts = pathinfo($filename);
			if (is_file($filename) and ($path_parts['extension']=="php"))
				{
					require("$filename");
				}
			}
					echo "</div></div>";
			}

					 if ($is_admin and $_SESSION['quick_edit_mode'])
              	{
              	echo "<table border='0' cellpadding='0' cellspacing='0' id='save_all_bottom' style='display:none; margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='#' onclick=\"save_block_positions('$clear_uri'); return false;\"><img src='/images/webcms/ico_save.gif' border='0' align='absmiddle'> Сохранить изменения</a></div></td>
</tr>
</table>";
// Получаем кнопки быстро-вставки
$dir = "blocks_menu";
    $opend_dir = scandir($dir);
		 foreach ($opend_dir as $get_file)
			{
			$filename = $dir . "/".$get_file;
			$path_parts = pathinfo($filename);
			if (is_file($filename) and ($path_parts['extension']=="php"))
				{
					require("$filename");
				}
			}
              		}

			echo "<div style='clear:both;'></div>";
			$tmp[1] = str_replace("\"","\\\"",$tmp[1]);
			eval ("\$str = \"$tmp[1]\";");
						echo "$str";
						}


else
{
echo "$options[closed_text]";
}
?>
<div id="fly_block" style="display:none; position:absolute; z-index:370;">

<div class="photo_top_corner_l"></div>
<div class="photo_top_corner_r"></div>
<div class="photo_bottom_corner_l"></div>
<div class="photo_bottom_corner_r"></div>
<div class="photo_top_bottom"></div>
<div class="photo_left_right"></div>

<div style="position:relative; z-index:500;">
<div align="right" style="padding:0px 6px 6px 6px;"><a href="#" onclick="hide('fly_block'); return false;"></a></div> <img src="images/webcms/wait.gif" id="fly_block_wait" style="position:absolute; left:50%;"><img onclick="hide('fly_block');" id="full_img" src="images/webcms/wait.gif" ><br />
<div id="fly_block_text"></div>
                         </div>
</div>

<div id="TB_overlay" style="display:none;"></div>


</body>
</html>
