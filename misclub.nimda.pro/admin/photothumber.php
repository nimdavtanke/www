<?

require("../functions/main.func.php");
require("../functions/admin.func.php");

					
					if (isset($_GET['action']))
{
$action = $_GET['action'];
}
if (isset($_POST['action']))
{
$action = $_POST['action'];
}
if (!isset($action)) $action="";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="admin_style.css">
<script type="text/javascript" language="javascript" src="../js/ajax.js"></script>
<script type="text/javascript" language="javascript" src="../js/jscripts.js"></script>
<script type="text/javascript" language="javascript" src="../js/adminjs.js"></script>
<script language="javascript" type="text/javascript" src="../js/photothumber.js"></script>
<script type="text/javascript" language="javascript">
preloader = new Image();
preloader.src="../images/webcms/wait.gif";
check_img = new Image();
check_img.src="../images/webcms/checked.gif";
uncheck_img = new Image();
uncheck_img.src="../images/webcms/unchecked.gif";
</script>
</head>

<body style="margin:0px; padding:0px; background-color:#f9f9f9;" onload="get_id('admin_content').style.display='inline';get_id('div_wait').style.display='none'; <?php
if ($action != "update_photo")
						{
						echo "cut_frame_ini();";
						}
						?>" onunload="admin_unload();">
<div id="div_wait" align="center"><img src="../images/webcms/wait.gif" border="0" /></div>
<div id="admin_content" style="display:none;">
<?php


if (!isset($_GET['block_id'])) $_GET['block_id']=0;
		
		if (!isset($_GET['source']) or $_GET['source']=="photo")
		{				
		$_GET['source']="photo";
	$q = "SELECT * FROM photos WHERE id='$_GET[photo_id]'";
					$photo = mysql_fetch_assoc(doquery($q));
						$photo_dst = "../photogallery/thumbs/";
						$photo_orig_dst = "../photogallery/originals/";
						$opt_width =$options['max_photothumb_big'];
						$opt_height =$options['max_photothumb_small'];
							$opt_var_w = "max_photothumb_big";
						$opt_var_h = "max_photothumb_small";
		}
		//для иконок
		if (isset($_GET['source']) and $_GET['source']=="page_icons")
		{					
					$photo['photo'] = $_GET['photo_id'];
						$photo_dst = "../page_icons/";
						$photo_orig_dst = "../page_icons/originals/";
						$opt_width =$options['icon_w'];
						$opt_height =$options['icon_h'];
						$opt_var_w = "icon_w";
						$opt_var_h = "icon_h";
		}
										if ($action == "update_photo")
						{
						
						// СОХРАНЯЕМ НАСТРОЙКИ, ЕСЛИ ТРЕБУЕТСЯ
						if (isset($_POST['save_sizes']) and $_POST['save_sizes']=="1")
							{
							$q = "UPDATE settings SET option_value='$_POST[thumb_w]' WHERE option_var='$opt_var_w'";
							doquery($q);
							$q = "UPDATE settings SET option_value='$_POST[thumb_h]' WHERE option_var='$opt_var_h'";
							doquery($q);
							}
							
							//Преобразуем фотографию из оригинала
							$params = getimagesize("$photo_orig_dst$photo[photo].jpg");
							$source = imagecreatefromjpeg("$photo_orig_dst$photo[photo].jpg");
							
							/// УМЕНЬШАЕМ ОРИГИНАЛ
							$resource = imagecreatetruecolor($_POST['full_w'], $_POST['full_h']);
							imagecopyresampled($resource, $source, 0, 0, 0, 0, $_POST['full_w'], $_POST['full_h'], $params[0], $params[1]);
							
							unset($source);
							
							// Создаем уменьшенное изображение
							$resource_thumb = imagecreatetruecolor($_POST['thumb_w'], $_POST['thumb_h']);
							imagecopy($resource_thumb,$resource,0,0,$_POST['pos_x'],$_POST['pos_y'],$_POST['thumb_w'], $_POST['thumb_h']);
							unset($resource);
							
							// СОХРАНЯЕМ
								imagejpeg($resource_thumb,"$photo_dst$photo[photo].jpg",100);
									$rand = md5((rand(0,999)+rand(0,999))/rand(0,999));
								echo "<div align='center' style='font-family:tahoma; font-size:14px;'><strong>Изображение преобразовано!</strong><br /><br /><img src='$photo_dst$photo[photo].jpg?rand=$rand' border=0><br />
							<br /><table border='0' cellpadding='10' cellspacing='0' style='border:1px solid #8791a4; background-color:#ffffff; font-size:12px; font-weight:bold;'><tr><td align='left'><a href='photothumber.php?photo_id=$_GET[photo_id]&block_id=$_GET[block_id]&menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]&source=$_GET[source]'>Переделать превью</a><br />";
							if (!isset($_GET['source']) or $_GET['source']=="photo")
									{	
							echo "
<a href='pages.php?action=photogallery&block_id=$_GET[block_id]&menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]'>Вернуться в фотогалерею</a></a><br />";
									}
echo "
<a href='pages.php?block_id=$_GET[block_id]&menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]'>Вернуться в раздел</a></td></tr></table></div>";
								die();
						}
						
					$params = getimagesize("$photo_orig_dst$photo[photo].jpg");
echo "<form action='photothumber.php?action=update_photo&photo_id=$_GET[photo_id]&block_id=$_GET[block_id]&menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]&source=$_GET[source]' method='post' style='padding:0px; margin:0px;' onsubmit=\"admin_unload();\">


<div style='padding:10px;'><strong>Создание уменьшенного изображения:</strong>
<table border='0' cellpadding='4' cellspacing='0'>
<tr>
<td>
Ширина уменьшенного изображения:<br />
<input type='text' class='admin_input' size='30' id='thumb_w' name='thumb_w' value='$opt_width' onkeyup=\"if (this.value>0) {get_id('real_cutter').style.width=parseInt(this.value)+'px';}\">
 <input type='hidden' id='full_w' name='full_w' value='$params[0]'>
<input type='hidden'  id='full_h' name='full_h' value='$params[1]'>
<input type='hidden'  id='pos_x' name='pos_x' value='0'>
<input type='hidden' id='pos_y' name='pos_y' value='0'></td>
<td>
Высота уменьшенного изображения:<br />
<input id='thumb_h' name='thumb_h' type='text' size='30' class='admin_input' value='$opt_height' onkeyup=\"if (this.value>0) {get_id('real_cutter').style.height=parseInt(this.value)+'px';}\">
</td>
<td><br />
<label><input type='checkbox' name='save_sizes' value='1'> Сделать размерами по умолчанию</label></td>
</tr><tr>
<td colspan=3 align='right'><input type='submit' class='admin_input' value='Сохранить изображение'></td></tr></table></div></form>";
?>
<div style="border-top:2px solid #8791a4; border-bottom:2px solid #8791a4;" align="left">
<div id="cut_div" style=" position:absolute; top:0px; left:0px; z-index:400;"   onMouseUp="end_drag()" >
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="real_cutter"  onMouseDown="start_drag(document.getElementById('cut_div'),event)" style="z-index:500; border:1px solid #ff0000; width:<?php echo "$opt_width";?>px; height:<?php echo "$opt_height";?>px; overflow:hidden;"><img id="img_obj_cutter" src="<?php echo "$photo_orig_dst$photo[photo].jpg";?>" style="width:<?php echo "$params[0]";?>px; margin-left:0px; margin-top:0px;"/></div>
</td>
<td></td>
</tr>
<tr>
<td></td>
<td onMouseDown="start_resize(document.getElementById('real_cutter'),event)" onMouseUp="end_resize()">
<img src="../images/webcms/resize.gif" width="10" height="10" /></td></tr></table></div>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
<div style="z-index:-1;" id="photo_div">
<img id="img_obj" src="<?php echo "$photo_orig_dst$photo[photo].jpg";?>" style="width:<?php echo "$params[0]";?>px; z-index:-1;"/></div>
</td>
<td bgcolor="#e0e0e0"  onMouseUp="end_resize()">&nbsp;
</td>
</tr>
<tr>
<td align="left" bgcolor="#e0e0e0"  onMouseUp="end_resize()"></td>
<td bgcolor="#e0e0e0" onMouseDown="start_resize(document.getElementById('img_obj'),event)" onMouseUp="end_resize()"><img src="../images/webcms/resize.gif" width="10" height="10" /></td>
</tr>
</table>
</div>
	
			<div class="pan_switcher"><img onclick="if(top.document.getElementById('fset').cols=='0,*') {top.document.getElementById('fset').cols='300,*'; this.src='../images/webcms/hide_panel.gif';} else {top.document.getElementById('fset').cols='0,*'; this.src='../images/webcms/show_panel.gif';}" src="../images/webcms/hide_panel.gif" /></div>
			
</div>
</body>
</html>
