<?
////// РАБОТА С ФОТОГРАФИЯМИ
/// Фотогалерея
if (!isset($_GET['p']) or $_GET['p']=="") $_GET['p']=1;
if (!isset($_GET['gal'])) $_GET['gal']="";
					if ($blocks['block_type']=="1")
					{
					echo "<div id='block_$blocks[id]' class='quick_edit_block'  onmouseover=\"if (edit_block_id=='all') { move_to='block_$blocks[id]';}\">
					<input type=\"hidden\" id='pos_block_$blocks[id]' value='$blocks[position]' name='block_pos[$blocks[id]]'>";

					echo "<div style='float:right; padding-right:5px; padding-top:5px;'>";
     					echo "<a href='$clear_uri?quick_edit=delete_block&block_id=$blocks[id]'  onclick=\"if(confirm('Блок и его содержимое будут полностью удалены!\\r\\n \\r\\nВы уверены?')){return true;} else {return false;}\"><img src='images/webcms/ico_block_del.gif' align='absmiddle' border='0' /></a> <img title='Переместить блок' src='images/webcms/topdown_sm.gif'  onmousedown=\"startMoveBlock('block_$blocks[id]','all'); return false;\" border='0' style='cursor:pointer;' align='absmiddle'></div>";

					$page_now = 1;
					if ($_GET['gal']==$blocks['id'])
						{
      $page_now = $_GET['p'];							}
                          $message[$blocks['id']] ="";

						if ($blocks['content']!="")
					{
						$blocks_info =  explode("::",$blocks['content']);
						$num_cols = $blocks_info[0];
						$num_on_page = $blocks_info[1];
						$block_style = $blocks_info[2];
						$preview_w = $blocks_info[3];
						$preview_h = $blocks_info[4];
						$preview_color = $blocks_info[5];
						$preview_cut = $blocks_info[6];
					}
					else
					{

						$num_cols = $options['photogallery_num_cols'];
						$num_on_page = $options['photogallery_on_page'];
						$block_style = "";

						$preview_w = $options['max_photothumb_big'];
						$preview_h = $options['max_photothumb_small'];
						$preview_color = str_replace("#","",$options['photogallery_preview_color']);
						$preview_cut = $options['photothumb_cut'];
					}


					if (!isset($_GET['b'])) $_GET['b']="";




if (isset($_GET['adm']) and $_GET['adm']=="add_photo" and $_GET['b']==$blocks['id'])
			                    	{
                            $path_info = pathinfo($_FILES['photofile']['name']);
	if (filesize($_FILES['photofile']['tmp_name'])>return_bytes(ini_get('post_max_size')) or filesize($_FILES['photofile']['tmp_name'])>return_bytes(ini_get('upload_max_filesize')))
		{
		 $message[$blocks['id']] = "<span style='font-weight:bold; color:#990000;'>Размер файла не должен превышать ".return_bytes(ini_get('upload_max_filesize'))/(1024*1024)." Мбайт</span>";
		}
		else
		{

		// Последняя позиция
$get_last_pos = "SELECT MAX(position) as max FROM photos WHERE block_id='$blocks[id]'";
	$max_pos = mysql_fetch_assoc(doquery($get_last_pos));
	$max_pos  = $max_pos['max'];
	if ($path_info['extension']=="zip")
				{
// Сохраняем файл во временную папку
copy($_FILES['photofile']['tmp_name'],"admin/tmp/photos.zip");
require("functions/pclzip.lib.php");
 $archive = new PclZip("admin/tmp/photos.zip");
$list = $archive->extract(PCLZIP_OPT_PATH, "admin/tmp/unzip", PCLZIP_OPT_REMOVE_ALL_PATH);


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

								$filename = createname("$m_id"."_"."$blocks[id]"."_", "photogallery/thumbs/","jpg");
							if (upload_photo($source_src,$filename, "photogallery", $blocks['id']))
								{
									// Добавляем информацию в базу данных

					$q = "INSERT INTO photos SET block_id='$blocks[id]', photo='$filename', description='" . $_POST['photo_descr_' . $blocks['id']] . "', position='$max_pos'";
										doquery($q);
								}

							}

						   remove_dir("tmp");
						  // mkdir("tmp");
				}
			else
				{
	$source_src = $_FILES['photofile']['tmp_name'];
	$filename = createname("$m_id"."_"."$blocks[id]"."_", "photogallery/thumbs/","jpg");
				if (upload_photo($source_src,$filename, "photogallery", $blocks['id']))
					{
						// Добавляем информацию в базу данных
						$q = "INSERT INTO photos SET block_id='$blocks[id]', photo='$filename', description='" . $_POST['photo_descr_' . $blocks['id']] . "', position='$max_pos'";
							doquery($q);
					}
				}

}

			                    		}


			                    if (isset($_GET['adm']) and $_GET['adm']=="save_photos_pos" and $_GET['b']==$blocks['id'])
			                    	{
			                        foreach ($_POST['photo_pos'] as $photo_id => $new_pos)
											{
											$q = "UPDATE photos SET position='$new_pos' WHERE id='$photo_id'";
											doquery($q);
											}
										update_date_edit($m_id);

			                    		}

			                    		// Удаление фото
			                    		if (isset($_GET['adm']) and $_GET['adm']=="del_photo" and $_GET['b']==$blocks['id'])
			                    	{

			                    	$q = "SELECT * FROM photos WHERE id='$_GET[ph_id]'";
		$photo = mysql_fetch_assoc(doquery($q));
		if (is_file("photogallery/thumbs/$photo[photo].jpg"))
		{
			unlink("photogallery/thumbs/$photo[photo].jpg");
		}
		if (is_file("photogallery/originals/$photo[photo].jpg"))
		{
			unlink("photogallery/originals/$photo[photo].jpg");
		}
		if (is_file("photogallery/photos/$photo[photo].jpg"))
		{
			unlink("photogallery/photos/$photo[photo].jpg");
		}


		$q = "DELETE FROM photos WHERE id='$_GET[ph_id]'";
			doquery($q);
			                    		}
			                    		//////// Сохранение настроек
			                    		if (isset($_GET['adm']) and $_GET['adm']=="save_photoblock_settings" and $_GET['b']==$blocks['id'])
			                    		{

                                            if ($_POST['cut_img_'.$blocks['id']]=="true")
									{
										$set_cut = 1;
									}
									else
									{
										$set_cut = 0;
									}
								$q = "UPDATE page_blocks SET content='$_POST[num_cols]::$_POST[num_on_page]::$_POST[block_style]::$_POST[w]::$_POST[h]::$_POST[color]::$set_cut' WHERE id='$_GET[b]'";
								$num_cols = $_POST['num_cols'];
					$num_on_page = "$_POST[num_on_page]";
					$block_style = "$_POST[block_style]";
						$preview_w = $_POST['w'];
						$preview_h = $_POST['h'];
						$preview_color = $_POST['color'];
						$preview_cut =$set_cut;
											doquery($q);
												// Очистка кэша
													 $q = "SELECT photo FROM photos WHERE block_id='$blocks[id]' ORDER BY position";
													 $del = doquery($q);
													 while ($del_ph = mysql_fetch_assoc($del))
													 	{
														if (is_file("photogallery/thumbs/$del_ph[photo].jpg"))
																{
																	unlink("photogallery/thumbs/$del_ph[photo].jpg");
																}
														}
			                    			}
					// Выводим форму сохранения порядка
                         echo "<form name='edit_block_$blocks[id]' action='$clear_uri?p=$_GET[p]&adm=save_photos_pos&b=$blocks[id]' method='post' style='margin:0px;'>";
                         echo "<table border='0' cellpadding='0' cellspacing='0' id='save_block_btn_top_$blocks[id]' style='display:none; margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='#' onclick=\"document.edit_block_$blocks[id].submit(); return false;\"><img src='/images/webcms/ico_save.gif' border='0' align='absmiddle'> Сохранить изменения</a></div></td>
</tr>
</table><div style='clear:both;'></div>" . $message[$blocks['id']];

		$start = ($page_now-1)*$num_on_page;
					// Считаем фотки
									$count_photos = "SELECT COUNT(*) as total FROM photos WHERE block_id='$blocks[id]'";
									$count = mysql_fetch_assoc(doquery($count_photos));
									$count = $count["total"];
								$js = "";
	$pages = "";
	if ($page_now!="all")
								{

					$total_pages = ceil($count/$num_on_page);

					for ($p=1;$p<=$total_pages;$p++)
							{
								if ($page_now==$p)
									{
							$pages .="<span class='selected'>$p</span> ";
									}
									else
									{
										if ($options['rewrite_url']==0)
											{
											$link ="index.php/$key_name/?page=$p&gal=$blocks[id]";
											}
											else
											{
											$link = "$clear_uri"."page/$p?gal=$blocks[id]";
											}
									$pages .="<a href='$link'>$p</a> ";
									}
									if ($total_pages>=40 and $p==ceil($total_pages/2))
										{
										$pages .= "<br />";
										}
							}
							$pages .= "<a href='$clear_uri?p=all&gal=$blocks[id]'>Все</a>";
                             }
                             else
                             {
                               $total_pages=1;                             	}

							/// ПОЛУЧАЕМ ФОТКИ
						 $q = "SELECT * FROM photos WHERE block_id='$blocks[id]' ORDER BY position";
							if ($page_now!="all")
								{
                                      $q .="  LIMIT $start, $num_on_page";									}


						 	$do_photos = doquery($q);
							$js = "
									photos[$blocks[id]] = Array();
							total_photos[$blocks[id]] = ".mysql_num_rows($do_photos) . ";
							";
								///////////// Выводим галерею

								/// Мозайка
								if ($blocks['block_sub_type']=="0")
												{
									$i=0;
									$style = $block_style;
									if ($style=="") $style = "photogallery_mozaic";
								echo "<table border='0' cellpadding='0' cellspacing='0' width='10' align='center' class='$style'><tr>";
								$ph_num = 0;
								while ($photos = mysql_fetch_assoc($do_photos))
									{
								$ph_num++;

								if (!is_file("photogallery/thumbs/$photos[photo].jpg"))
											{
												$params[0] = $preview_w;
												$params[1] = $preview_h;
												$src = "img.php?dst=photogallery/thumbs/$photos[photo].jpg&name=photogallery/originals/$photos[photo].jpg&cut=$preview_cut&w=$preview_w&h=$preview_h&bgcolor=$preview_color";
											}
											else
											{
												$rand = md5((rand(0,999)+rand(0,999))/rand(0,999));
												$params = getimagesize("photogallery/thumbs/$photos[photo].jpg");
											$src = "photogallery/thumbs/$photos[photo].jpg?rand=$rand";
											}


									$params_full = getimagesize("photogallery/photos/$photos[photo].jpg");

												$i++;
												$js .= "photos[$blocks[id]][$ph_num] = 'photogallery/photos/$photos[photo].jpg';";




													echo "<td valign='top' >

													<div class='photo' id='photo_$photos[id]'  onmousedown=\"do_move_ph=true; startMoveBlock('photo_$photos[id]',$blocks[id]); return false;\"  onmouseover=\"if (edit_block_id=='$blocks[id]') { move_photo_to='photo_$photos[id]';}\" style='position:relative;'>
												<input type=\"hidden\" id='pos_photo_$photos[id]' value='$photos[position]' name='photo_pos[$photos[id]]' onclick=\"get_id('save_block_btn').style.display='';\">
													<div style='position:absolute; right:5px; top:5px;'><a href='#' onclick=\"if(confirm('Фото будет удалено!\\r\\n \\r\\nВы уверены?')){location.href='$clear_uri?p=$_GET[p]&adm=del_photo&ph_id=$photos[id]&b=$blocks[id]';} return false;\"><img src='/images/webcms/ico_photo_del.gif' border='0'></a></div><img width='$params[0]' height='$params[1]' src='$src' onclick=\"show_photo($blocks[id],'$ph_num');\" border='0'/>
													<div class='description'>$photos[description]</div>
													</div></td>";
														if ($i==$num_cols)
															{
															echo "</tr><tr>";
															$i=0;
															}

												}
													echo "</tr></table>";
											}
											//Фото слева
										elseif ($blocks['block_sub_type']=="1")
												{

													$ph_num = 0;
									$style = $block_style;
									if ($style=="") $style = "photogallery_left";
													echo "<table border='0' cellpadding='0' cellspacing='0' align='center' class='$style'><tr>";
														$i =0;
														while ($photos = mysql_fetch_assoc($do_photos))
													{
														$ph_num ++;
														$i++;
															$js .= "photos[$blocks[id]][$ph_num] = 'photogallery/photos/$photos[photo].jpg';";



														if (!is_file("photogallery/thumbs/$photos[photo].jpg"))
											{
												$params[0] = $preview_w;
												$params[1] = $preview_h;
												$src = "img.php?dst=photogallery/thumbs/$photos[photo].jpg&name=photogallery/originals/$photos[photo].jpg&cut=$preview_cut&w=$preview_w&h=$preview_h&bgcolor=$preview_color";
											}
											else
											{
												$rand = md5((rand(0,999)+rand(0,999))/rand(0,999));
												$params = getimagesize("photogallery/thumbs/$photos[photo].jpg");
											$src = "photogallery/thumbs/$photos[photo].jpg?rand=$rand";
											}

									$params_full = getimagesize("photogallery/photos/$photos[photo].jpg");


												echo "<td valign='top'>
												<div id='photo_$photos[id]'  onmousedown=\"do_move_ph=true; startMoveBlock('photo_$photos[id]',$blocks[id]); return false;\"  onmouseover=\"if (edit_block_id=='$blocks[id]') { move_photo_to='photo_$photos[id]';}\" style='position:relative;'>
												<input type=\"hidden\" id='pos_photo_$photos[id]' value='$photos[position]' name='photo_pos[$photos[id]]' onclick=\"get_id('save_block_btn').style.display='';\">
													<div style='position:absolute; left:5px; top:5px;'><a href='#' onclick=\"if(confirm('Фото будет удалено!\\r\\n \\r\\nВы уверены?')){location.href='$clear_uri?p=$_GET[p]&adm=del_photo&ph_id=$photos[id]&b=$blocks[id]';} return false;\"><img src='/images/webcms/ico_photo_del.gif' border='0'></a></div>

												<div class='photo' style='float:left;'><img width='$params[0]' height='$params[1]' src='$src' onclick=\"show_photo($blocks[id],'$ph_num');\" border='0'/></div> $photos[description]<div style='clear:both;'></div></div></div></td>";
												if ($i==$num_cols)
															{
															echo "</tr><tr>";
															$i=0;
															}
												}

															echo "</table>";
											}
												//Фото справа
											elseif ($blocks['block_sub_type']=="2")
													{
														$ph_num = 0;
												$style = $block_style;
									if ($style=="") $style = "photogallery_right";
											echo "<table border='0' cellpadding='0' cellspacing='0' align='center' class='$style'><tr>";
											$i=0;
													while ($photos = mysql_fetch_assoc($do_photos))
														{
															$ph_num ++;
															$i++;
															if (!is_file("photogallery/thumbs/$photos[photo].jpg"))
											{
												$params[0] = $preview_w;
												$params[1] = $preview_h;
												$src = "img.php?dst=photogallery/thumbs/$photos[photo].jpg&name=photogallery/originals/$photos[photo].jpg&cut=$preview_cut&w=$preview_w&h=$preview_h&bgcolor=$preview_color";
											}
											else
											{
												$rand = md5((rand(0,999)+rand(0,999))/rand(0,999));
												$params = getimagesize("photogallery/thumbs/$photos[photo].jpg");
											$src = "photogallery/thumbs/$photos[photo].jpg?rand=$rand";
											}
									$params_full = getimagesize("photogallery/photos/$photos[photo].jpg");
									$js .= "photos[$blocks[id]][$ph_num] = 'photogallery/photos/$photos[photo].jpg';";


													echo "<td valign='top'>
													<div id='photo_$photos[id]'  onmousedown=\"do_move_ph=true; startMoveBlock('photo_$photos[id]',$blocks[id]); return false;\"  onmouseover=\"if (edit_block_id=='$blocks[id]') { move_photo_to='photo_$photos[id]';}\" style='position:relative;'>
												<input type=\"hidden\" id='pos_photo_$photos[id]' value='$photos[position]' name='photo_pos[$photos[id]]' onclick=\"get_id('save_block_btn').style.display='';\">
													<div style='position:absolute; right:5px; top:5px;'><a href='#' onclick=\"if(confirm('Фото будет удалено!\\r\\n \\r\\nВы уверены?')){location.href='$clear_uri?p=$_GET[p]&adm=del_photo&ph_id=$photos[id]&b=$blocks[id]';} return false;\"><img src='/images/webcms/ico_photo_del.gif' border='0'></a></div>
													<div><div class='photo' style='float:right;'><img width='$params[0]' height='$params[1]' src='$src' onclick=\"show_photo($blocks[id],'$ph_num');\" border='0'/></div> $photos[description]</div><div style='clear:both;'></div></div></td>";
														if ($i==$num_cols)
															{
															echo "</tr><tr>";
															$i=0;
															}
													}
													echo "</table>";
												}

								echo "<script language='javascript'>
								$js
								</script>";

                echo "<table border='0' cellpadding='0' cellspacing='0' id='save_block_btn_bottom_$blocks[id]' style='display:none; margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='#' onclick=\"document.edit_block_$blocks[id].submit(); return false;\"><img src='/images/webcms/ico_save.gif' border='0' align='absmiddle'> Сохранить изменения</a></div></td>
</tr>
</table>

<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='#' onclick=\"if (get_id('block_settings_$blocks[id]').style.display=='') {get_id('block_settings_$blocks[id]').style.display='none';} else {get_id('block_settings_$blocks[id]').style.display='';} return false;\" ><img src='/images/webcms/ico_settings.gif' border='0' align='absmiddle'> Настройки блока</a></div></td>
</tr>
</table>

<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='#' onclick=\"if (get_id('add_photo_form_$blocks[id]').style.display=='') {get_id('add_photo_form_$blocks[id]').style.display='none';} else {get_id('add_photo_form_$blocks[id]').style.display='';} return false;\" ><img src='/images/webcms/ico_add_photogal.gif' border='0' align='absmiddle'> Добавить фото</a></div></td>
</tr>
</table>

<div style='clear:both;'></div>";
			echo "</form>";
                        $pr_cut = array("","");
					$pr_cut[$preview_cut] = "checked";
			echo "<div id='add_photo_form_$blocks[id]' style='display:none; border-top:1px solid #cccccc; padding-top:4px; margin-top:7px; '>
			  <form action='$clear_uri?p=$_GET[p]&adm=add_photo&b=$blocks[id]' method='post' enctype='multipart/form-data' style='margin:0px;'>
<table border='0' cellpadding='3' cellspacing='0'>
<tr>
<td><strong>Файл фотографии или .zip-архив с фотографиями:</strong><br />
<span class='helptext'>Внимание! Загрузка больших архивов может занимать продолжительное время!</span>
<br />
<input type='file' style='width:100%' name='photofile' class='admin_input'><br />
<strong>Описание фото:</strong><br />";
$textarea = array();
$textarea_values = array();
$textarea_title = array();
	$textarea[$blocks['id']] = "photo_descr_$blocks[id]";
$textarea_values[$blocks['id']] = "";
$textarea_title[$blocks['id']] = "Описание фотографии";
show_editor($textarea, $textarea_values, $textarea_title);
echo "
</td>
</tr>
<tr>
<td align='right'>
<input type='submit' value='Добавить фото' class='admin_input' />
</td>
</tr>
</table>
        </form>
</div>";

echo "<div id='block_settings_$blocks[id]' style='display:none; border-top:1px solid #cccccc; padding-top:4px; margin-top:7px; '>
			  <form action='$clear_uri?p=$_GET[p]&adm=save_photoblock_settings&b=$blocks[id]' method='post' style='margin:0px;'>
<table border='0' cellpadding='3' cellspacing='0'>
<tr>
<td>Количество колонок:</td><td><input name='num_cols' type='text' value='$num_cols' class='admin_input'  style='width:40px; text-align:center;'></td>
</tr>
<tr>
<td>Фотографий на странице:</td><td><input type='text' name='num_on_page' value='$num_on_page' style='width:40px; text-align:center;' class='admin_input'></td>
</tr>
<tr>
<td>Обрезать изображения:</td><td> <label><input type='radio' name='cut_img_$blocks[id]' value='1' $pr_cut[1]> Да</label> <label><input type='radio' name='cut_img_$blocks[id]' value='0' $pr_cut[0]> Нет</label></td>
</tr>
<tr>
<td>Размер превью (ШxВ):</td><td> <input type='text' name='w' value='$preview_w' style='width:40px; text-align:center;' class='admin_input'>x<input type='text' name='h' value='$preview_h' style='width:40px; text-align:center;' class='admin_input'>
</td>
</tr>
<tr>
<td>
Цвет фона</td><td> #<input type='text' name='color' value='$preview_color' style='width:50px; text-align:left;' maxlength=6 class='admin_input'></td>
</tr>
<td>CSS-стиль:</td><td> <input name='block_style' type='text' value='$block_style' style='width:70px;' class='admin_input'></td>
</tr>
<tr>
<td colspan='2' align='center'>
<input type='submit' value='Сохранить' class='admin_input' />
</td>
</tr>
</table>
        </form>
</div>";

			if ($pages!="" and $total_pages>1)
												{
												echo " <div class='pages'>Страницы: $pages</div>";
												}
										echo "<div style='float:right; padding-right:5px; padding-bottom:5px;'>";
     					echo "<a href='$clear_uri?quick_edit=delete_block&block_id=$blocks[id]'  onclick=\"if(confirm('Блок и его содержимое будут полностью удалены!\\r\\n \\r\\nВы уверены?')){return true;} else {return false;}\"><img src='images/webcms/ico_block_del.gif' align='absmiddle' border='0' /></a> <img title='Переместить блок' src='images/webcms/topdown_sm.gif'  onmousedown=\"startMoveBlock('block_$blocks[id]','all'); return false;\" border='0' style='cursor:pointer;' align='absmiddle'></div><div style='clear:both;'></div>";
							echo "</div>";
							}

?>