<?
set_time_limit(0);
if ($action=="save_photos_pos")
{
	foreach ($_POST['photo_pos'] as $photo_id => $new_pos)
		{
		$q = "UPDATE photos SET position='$new_pos' WHERE id='$photo_id'";
		doquery($q);
		}
		$action = "photogallery";
		update_date_edit($menu_id);
}
if ($action=="add_photo")
	{
           $upload_files =$_FILES['photofile'];

           	foreach ($upload_files['name'] as $id=>$val)
           	{

	 $path_info = pathinfo($upload_files['name'][$id]);
	if (filesize($upload_files['tmp_name'][$id])>return_bytes(ini_get('post_max_size')) or filesize($upload_files['photofile'][$id])>return_bytes(ini_get('upload_max_filesize')))
		{
		$message = "<span style='font-weight:bold; color:#990000;'>Размер файла не должен превышать ".return_bytes(ini_get('upload_max_filesize'))/(1024*1024)." Мбайт</span>";
		}
		else
		{
		// Последняя позиция
$get_last_pos = "SELECT MAX(position) as max FROM photos WHERE block_id='$_GET[block_id]'";
	$max_pos = mysql_fetch_assoc(doquery($get_last_pos));
	$max_pos  = $max_pos['max'];

	if ($path_info['extension']=="zip")
				{
// Сохраняем файл во временную папку
copy($upload_files['tmp_name'][$id],"tmp/photos.zip");
require_once("../functions/pclzip.lib.php");
 $archive = new PclZip("tmp/photos.zip");
$list = $archive->extract(PCLZIP_OPT_PATH, "tmp/unzip", PCLZIP_OPT_REMOVE_ALL_PATH);


		$list_sort = $list;
	foreach ($list_sort as $key => $row) {
    $stored_filename[$key]  = $row['stored_filename'];
}
asort($stored_filename);
array_multisort ($list, $stored_filename);

						  foreach($list as $key => $file)
						  	{
						  	$max_pos++;
								$source_src = $file['filename'];

								$filename = createname("$cat_id"."_"."$_GET[block_id]"."_", "../photogallery/thumbs/","jpg");
							if (upload_photo($source_src,$filename,"../photogallery",$_GET['block_id']))
								{
									// Добавляем информацию в базу данных
									$q = "INSERT INTO photos SET block_id='$_GET[block_id]', photo='$filename', description='$_POST[photo_descr]', position='$max_pos'";
										doquery($q);
								}

							}

						   remove_dir("tmp");
						  // mkdir("tmp");
				}
			else
				{
	$source_src = $upload_files['tmp_name'][$id];
	$filename = createname("$cat_id"."_"."$_GET[block_id]"."_", "../photogallery/thumbs/","jpg");
				if (upload_photo($source_src,$filename,"../photogallery", $_GET['block_id']))
					{
						// Добавляем информацию в базу данных
						$q = "INSERT INTO photos SET block_id='$_GET[block_id]', photo='$filename', description='$_POST[photo_descr]', position='$max_pos'";
							doquery($q);
					}
				}

}
	}
	$action = "photogallery";
	}

	if ($action=="edit_photo")
	{
		$q = "UPDATE photos SET description='$_POST[photo_descr]' WHERE id='$_GET[photo_id]'";
			doquery($q);
		unset($_GET['photo_id']);
		update_date_edit($menu_id);
	$action = "photogallery";
	}

		if ($action=="move_photos")
			{

			if (isset($_POST['selected_photos']))
			{
			$_SESSION['move_photos'] = $_POST['selected_photos'];
			}
			else
			{
			if (isset($_GET['selected_photos']))
			{
			$_SESSION['move_photos'] = $_GET['selected_photos'];
			}
			else
			{
			$error = "Не выделено ни одной фотографии!";
			}
			}

			}
			if ($action=="do_mass_move")
			{
				foreach ($_SESSION['move_photos'] as $key =>$photo_id)
					{
						$q = "UPDATE photos SET block_id='$_GET[block_id]' WHERE id='$photo_id'";
							doquery($q);
					}
					update_date_edit($menu_id);
					unset ($_SESSION['move_photos']);
			}
			if ($action=="unset_move_photos")
				{
				unset ($_SESSION['move_photos']);
				}

	if ($action=="delete_photo")
	{
	$q = "SELECT * FROM photos WHERE id='$_GET[photo_id]'";
		$photo = mysql_fetch_assoc(doquery($q));
			unlink("../photogallery/thumbs/$photo[photo].jpg");
			unlink("../photogallery/originals/$photo[photo].jpg");
			unlink("../photogallery/photos/$photo[photo].jpg");
		$q = "DELETE FROM photos WHERE id='$_GET[photo_id]'";
			doquery($q);
			update_date_edit($menu_id);
	unset($_GET['photo_id']);

	$action = $_GET['return'];
	}

	if ($action=="photo_rotate")
	{
	$q = "SELECT * FROM photos WHERE id='$_GET[photo_id]'";
		$photo = mysql_fetch_assoc(doquery($q));
		$source_src = "../photogallery/thumbs/$photo[photo].jpg";
		$source = imagecreatefromjpeg($source_src);
		$rotate = imagerotate($source, $_GET['degr'], 0);
		$resource_src = "../photogallery/thumbs/$photo[photo].jpg";
		imagejpeg($rotate, $resource_src,100);

		$source_src = "../photogallery/photos/$photo[photo].jpg";
		$source = imagecreatefromjpeg($source_src);
		$rotate = imagerotate($source, $_GET['degr'], 0);
		$resource_src = "../photogallery/photos/$photo[photo].jpg";
		imagejpeg($rotate, $resource_src,100);

		$source_src = "../photogallery/originals/$photo[photo].jpg";
		$source = imagecreatefromjpeg($source_src);
		$rotate = imagerotate($source, $_GET['degr'], 0);
		$resource_src = "../photogallery/originals/$photo[photo].jpg";
		imagejpeg($rotate, $resource_src,100);
		update_date_edit($menu_id);

	unset($_GET['photo_id']);
	$action = $_GET['return'];
	}


	if ($action=="photo_mass_delete")
		{
		if (!isset($_POST['selected_photos']))
		{
		$error = "Не выделено ни одной фотографии!";
		}
		else
		{
		foreach ($_POST['selected_photos'] as $key =>$photo_id)
			{
			$q = "SELECT * FROM photos WHERE id='$photo_id'";
					$photo = mysql_fetch_assoc(doquery($q));
						unlink("../photogallery/thumbs/$photo[photo].jpg");
						unlink("../photogallery/originals/$photo[photo].jpg");
						unlink("../photogallery/photos/$photo[photo].jpg");
					$q = "DELETE FROM photos WHERE id='$photo_id'";
						doquery($q);
			}
			update_date_edit($menu_id);
		}
		$action = $_GET['return'];
		}

if ($action=="photogallery")
{
if (isset($error) and $error!="")
				{
				echo "<span style='color:#ff0000; font-weight:bold; font-size:14px;'>$error</span>";
				}
echo "<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;' width='90%'>
<tr>
<td><div style='padding:3px 7px 3px 7px;'><strong style='margin-left:10px;'>$name / Фотогалерея</strong><br />";

//// ФОРМА ДОБАВЛЕНИЯ ФОТОГРАФИИ
if (!isset($_GET['photo_id']) or $_GET['photo_id']=="" or $_GET['photo_id']=="0")
{
echo "<br /><form ENCTYPE=\"multipart/form-data\" onsubmit=\"admin_unload();\" name='add_photo' action='pages.php?action=add_photo&block_id=$_GET[block_id]&menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]' method='post' target='main' style='background-color:#ffffff; border:1px solid #8791a4; margin:0px; padding:5px; '>
<strong>Добавить фотографию</strong><br />
<br /><strong>Фотографии или .zip-архивы с фотографиями:</strong><br />
<span class='helptext'>Внимание! Загрузка большого количества фотографий может занимать продолжительное время!</span>
<br />
<input type='file' style='width:100%'  name='photofile[]' class='admin_input'  multiple><br />
<strong>Описание фото:</strong><br />";
	$textarea[] = "photo_descr";
$textarea_values[] = "";
$textarea_title[] = "Описание фотографии";
show_editor($textarea, $textarea_values, $textarea_title);


echo "<div style='text-align:right; padding-top:5px;'><input type='submit' class='admin_input' value='Сохранить'></div></form>";
}
else
{
$q = "SELECT * FROM photos WHERE id='$_GET[photo_id]'";
$photo = mysql_fetch_assoc(doquery($q));

echo "<br /><form ENCTYPE=\"multipart/form-data\" name='edit_photo' action='pages.php?action=edit_photo&block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$_GET[photo_id]' method='post' target='main' style='background-color:#ffffff; border:1px solid #8791a4; margin:0px; padding:5px; '>
<strong>Изменить фотографию</strong><br />
<i>Нажмите на изображение, чтобы изменить превью</i><br />
<a href='photothumber.php?block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$_GET[photo_id]&return=photogallery'><img src='../photogallery/thumbs/$photo[photo].jpg' border='0'></a><br /><br />
<strong>Описание фото:</strong><br />";
$textarea[] = "photo_descr";
$textarea_values[] = "$photo[description]";
$textarea_title[] = "Описание фотографии";
show_editor($textarea, $textarea_values, $textarea_title);


echo "<div style='text-align:right; padding-top:5px;'><input type='submit' class='admin_input' value='Сохранить'></div></form>";
}

////// ВЫВОД ФОТОГРАФИЙ
echo "<form name='blocks_form' action='pages.php?menu_id=$menu_id&cat_id=$cat_id&block_id=$_GET[block_id]&return=photogallery' style='padding:0px; margin:0px;' method='post'>
<input type='hidden' id='block_action' name='action' value='save_photos_pos'>
<div id='photo_block_$_GET[block_id]' style='margin-top:3px; border:1px solid #8791a4; padding:3px;'>";
echo "<table border='0' cellpadding='0' cellspacing='4' style='margin:3px;'><tr>
<td id='save_block_btn' style='display:none;'>
<div style='padding:4px; border:1px solid #8791a4; height:15px; overflow-y:hidden;' onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='#' onclick=\"document.blocks_form.submit(); return false;\"><img src='../images/webcms/ico_save.gif' border='0' align='absmiddle'> Сохранить изменения</a></div></td></tr></table>";
					echo "<div align='right'><div style='float:left;'><img src='../images/webcms/arrow_down.gif' border='0' align='absmiddle'> <a href='#' onclick=\" select_all('photo_block_$_GET[block_id]'); return false;\">Выделить все</a> / <a href='#' onclick=\"unselect_all('photo_block_$_GET[block_id]'); return false;\">Снять выделение со всех</a> |";
					if (isset($_SESSION['move_photos']) and count($_SESSION['move_photos'])!=0 and $_SESSION['move_photos']!="")
							{
							echo " <a href='pages.php?action=unset_move_photos&block_id=photo_block_$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id'><strong style='color:#ff0000;'>Отменить перемещение фотографий</strong></a>";
							}
							else
							{

					 echo " С выделенными фотографиями: <a href='#' onclick=\"get_id('block_action').value='move_photos'; document.blocks_form.submit(); return false;\"><img align='absmiddle' src='../images/webcms/ico_photo_move.gif' width='15' height='15' border='0' title='Переместить выделенные фотографии'></a> <a href='#' onclick=\"if(confirm('Выделенные фотографии будут удалены!\\r\\n \\r\\nВы уверены?')){get_id('block_action').value='photo_mass_delete'; document.blocks_form.submit();} return false;\"><img src='../images/webcms/ico_photo_del.gif' width='17' height='15' border='0' alt='Удалить выделенные фотографии'  title='Удалить выделенные фотографии'  align='absmiddle'></a>";
					 		}
							echo "</div></div><div style='clear:both;'></div>";
							$q = "SELECT block_sub_type FROM page_blocks WHERE id='$_GET[block_id]'";
							$blocks = mysql_fetch_assoc(doquery($q));
							/// Разбираемся, какой тип у фотогалереи
								switch ($blocks['block_sub_type'])
									{
									case "0": $float="float:left"; $float_img="";  break;
									case "1": $float=""; $float_img="float:left"; break;
									case "2": $float=""; $float_img="float:right"; break;
									}
						/// ПОЛУЧАЕМ ФОТКИ
						 $q = "SELECT * FROM photos WHERE block_id='$_GET[block_id]' ORDER BY position";
						 	$do_photos = doquery($q);
								if ($options["max_photothumb_big"] > $options["max_photothumb_small"]) $div_size="$options[max_photothumb_big]px";
								else $div_size="$options[max_photothumb_small]px";
								while ($photos = mysql_fetch_assoc($do_photos))
									{
					$params = getimagesize("../photogallery/thumbs/$photos[photo].jpg");
					switch ($blocks['block_sub_type'])
												{
									case "0": $div_w = "width:" . ($params[0]+10) . "px;";  break;
									case "1": $div_w=""; break;
									case "2": $div_w="";  break;
											}
									if (trim(strip_tags("$photos[description]"))=="" or trim(strip_tags("$photos[description]"))=="&nbsp;")
									{
									$photos["description"] ="";
									}
								$rand = md5((rand(0,999)+rand(0,999))/rand(0,999));
									echo "<div id='photo_$photos[id]' style='$float; padding:5px; margin-top:5px; margin-right:5px; $div_w background-color:#ffffff; border:1px solid #e0e0e0;' align='center' onmousedown=\"do_move_ph=true; startMoveBlock('photo_$photos[id]'); return false;\"  onmouseover=\"move_photo_to='photo_$photos[id]';\">

									<div style='border:1px solid #e0e0e0; background-color:#f9f9f9; padding:2px; margin-bottom:3px;' align='right'>

								<div style='float:left; margin-top:-2px;'><input type='checkbox' id='photo_$photos[id]' name='selected_photos[]' value='$photos[id]'></div> <div style='float:rigth;'><a href='../photogallery/photos/$photos[photo].jpg' target='_blank'><img src='../images/webcms/ico_photo_zoom.gif' width='18' height='15' border='0' alt='Просмотр фотографии' title='Просмотр фотографии'></a> <a href='pages.php?action=photogallery&block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]'><img src='../images/webcms/ico_photo_edit.gif' width='17' height='15' border='0' alt='Изменить подпись к фотографии' title='Изменить подпись к фотографии'></a> <a href='pages.php?action=photo_rotate&degr=270&block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]&return=photogallery'><img src='../images/webcms/ico_photo_rotate_cw.gif' width='17' height='15' border='0' alt='Повернуть фотографию по часовой стрелке' title='Повернуть фотографию по часовой стрелке'></a> <a href='pages.php?action=photo_rotate&degr=90&block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]&return=photogallery'><img src='../images/webcms/ico_photo_rotate_ccw.gif' width='17' height='15' border='0' alt='Повернуть фотографию против часовой стрелки' title='Повернуть фотографию против часовой стрелки'></a> <a href='photothumber.php?block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]&return='><img src='../images/webcms/ico_photo_cut.gif' title='Изменить превью фотографии' width='15' height='15' border='0'></a> <a href='pages.php?action=move_photos&block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id&selected_photos[]=$photos[id]'><img src='../images/webcms/ico_photo_move.gif' width='15' height='15' border='0' title='Переместить фото'></a> <a href='pages.php?action=delete_photo&block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]&return=photogallery' onclick=\"if(confirm('Фотография будет удалена!\\r\\n \\r\\nВы уверены?')){return true;} else {return false;}\"><img src='../images/webcms/ico_photo_del.gif' width='17' height='15' border='0' alt='Удалить фотографию' title='Удалить фотографию'></a></div></div>


									<input type=\"hidden\" id='pos_photo_$photos[id]' value='$photos[position]' name='photo_pos[$photos[id]]' onclick=\"get_id('save_block_btn').style.display='';\">
									<div style='$float_img; padding-left:5px; padding-right:5px;'><img width='$params[0]' height='$params[1]' src='../photogallery/thumbs/$photos[photo].jpg?rand=$rand' border='0'/></div>
<div align='left'>$photos[description]</div><div style='clear:both'></div></div>";
									}
					if (isset($_GET['photo_id']) or isset($_POST['photo_id']))
						{

						echo  "<div style='clear:both;'><table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='cursor:pointer; border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"location.href='pages.php?action=photogallery&block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id';\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='../images/webcms/ico_add_photogal.gif' border='0' align='absmiddle'> Добавить фото</div></td></tr></table>";
echo "</div>";

				//	echo "<div id='add_photo_$_GET[block_id]' style='cursor:pointer; margin-top:5px; float:left; background:#ffffff url(../images/webcms/add_photo.gif) center no-repeat; border:1px solid #e0e0e0; padding:5px; width:100px; height:100px;' align='center' onclick=\"location.href='pages.php?action=photogallery&block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id';\"></div>";
						}
					echo "<div style='clear:both;'>&nbsp;</div></div></form><br>";
					if ($blocks['block_sub_type']==0)
					{
					echo "<script>upd_photos[upd_photos.length]='photo_block_$_GET[block_id]';</script>";
					}
					echo  "</div></td></tr></table>";
die();
}

?>