<?
////// РАБОТА С ФОТОГРАФИЯМИ
/// Фотогалерея

					if ($blocks['block_type']=="1")
					{



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

					if (isset($_GET['block_action']) and $_GET['block_action']=="save_settings" and isset($_GET['block_id']) and $_GET['block_id']==$blocks['id'])
							{

								if ($_GET['set_cut']=="true")
									{
										$set_cut = 1;
									}
									else
									{
										$set_cut = 0;
									}
								$q = "UPDATE page_blocks SET content='$_GET[set_num_cols]::$_GET[set_num_on_page]::$_GET[set_block_style]::$_GET[set_w]::$_GET[set_h]::$_GET[set_color]::$set_cut' WHERE id='$blocks[id]'";
								$num_cols = $_GET['set_num_cols'];
					$num_on_page = "$_GET[set_num_on_page]";
					$block_style = "$_GET[set_block_style]";
						$preview_w = $_GET['set_w'];
						$preview_h = $_GET['set_h'];
						$preview_color = $_GET['set_color'];
						$preview_cut =$set_cut;
											doquery($q);
												// Очистка кэша
													 $q = "SELECT photo FROM photos WHERE block_id='$blocks[id]' ORDER BY position";
													 $del = doquery($q);
													 while ($del_ph = mysql_fetch_assoc($del))
													 	{
														if (is_file("../photogallery/thumbs/$del_ph[photo].jpg"))
																{
																	unlink("../photogallery/thumbs/$del_ph[photo].jpg");
																}
														}
											//echo "$q<br />";
							}

					echo  "<div align='right'><div style='float:left; font-size:10px;'><img src='../images/webcms/arrow_down.gif' border='0' align='absmiddle'> <a href='#' onclick=\" select_all('photo_block_$blocks[id]'); return false;\">Выделить все</a> / <a href='#' onclick=\"unselect_all('photo_block_$blocks[id]'); return false;\">Снять выделение со всех</a> |";
					if (!isset($_SESSION['move_photos']) or count($_SESSION['move_photos'])==0 or $_SESSION['move_photos']=="")
							{

					echo  " С выделенными фотографиями: <a href='#' onclick=\"get_id('block_action').value='move_photos'; document.blocks_form.submit(); return false;\"><img align='absmiddle' src='../images/webcms/ico_photo_move.gif' width='15' height='15' border='0'  title='Переместить выделенные фотографии'></a> <a href='#' onclick=\"if(confirm('Выделенные фотографии будут удалены!\\r\\n \\r\\nВы уверены?')){get_id('block_action').value='photo_mass_delete'; document.blocks_form.submit();} return false;\"><img src='../images/webcms/ico_photo_del.gif' width='17' height='15' border='0' alt='Удалить выделенные фотографии'  title='Удалить выделенные фотографии' align='absmiddle'></a>";
					 		}
							echo "</div>$block_menu</div>";
							echo  "<div style='clear:both;'><table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='cursor:pointer; border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"location.href='pages.php?action=photogallery&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id';\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='../images/webcms/ico_add_photogal.gif' border='0' align='absmiddle'> Добавить фото</div></td></tr></table>";
	if (isset($_SESSION['move_photos']) and count($_SESSION['move_photos'])!=0 and $_SESSION['move_photos']!="")
							{
							echo  "<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffea';\" style='cursor:pointer; border:1px solid #8791a4; background-color:#ffffea;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"location.href='pages.php?action=do_mass_move&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id';\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='../images/webcms/ico_photo_move.gif' border='0' align='absmiddle'> Переместить в эту фотогалерею</div></td></tr></table>";
echo  "<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffea';\" style='cursor:pointer; border:1px solid #8791a4; background-color:#ffffea;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"location.href='pages.php?action=unset_move_photos&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id';\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='../images/webcms/ico_photo_cancel.gif' border='0' align='absmiddle'> Отменить перемещение</div></td></tr></table>";
							}
							echo "</div>";
							echo "<div id='photo_block_$blocks[id]' style='clear:both;'>";
						/// Разбираемся, какой тип у фотогалереи
								switch ($blocks['block_sub_type'])
									{
									case "0": $float="float:left"; $float_img="";  break;
									case "1": $float=""; $float_img="float:left"; break;
									case "2": $float=""; $float_img="float:right";  break;
									}
						/// ПОЛУЧАЕМ ФОТКИ
						 $q = "SELECT * FROM photos WHERE block_id='$blocks[id]' ORDER BY position";
						 	$do_photos = doquery($q);
								if ($options["max_photothumb_big"] > $options["max_photothumb_small"]) $div_size="$options[max_photothumb_big]px";
								else $div_size="$options[max_photothumb_small]px";

								while ($photos = mysql_fetch_assoc($do_photos))
									{
									$menu_photo_edit = "<div style='float:left; margin-top:-2px;'><input type='checkbox' id='photo_$photos[id]' name='selected_photos[]' value='$photos[id]'></div> <div style='float:rigth;'><a href='../photogallery/photos/$photos[photo].jpg' target='_blank'><img src='../images/webcms/ico_photo_zoom.gif' width='18' height='15' border='0' alt='Просмотр фотографии' title='Просмотр фотографии'></a> <a href='pages.php?action=photogallery&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]'><img src='../images/webcms/ico_photo_edit.gif' width='17' height='15' border='0' alt='Изменить описание фотографии' title='Изменить описание фотографии'></a> <a href='pages.php?action=photo_rotate&degr=270&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]&return='><img src='../images/webcms/ico_photo_rotate_cw.gif' width='17' height='15' border='0' alt='Повернуть фотографию по часовой стрелке' title='Повернуть фотографию по часовой стрелке'></a> <a href='pages.php?action=photo_rotate&degr=90&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]&return='><img src='../images/webcms/ico_photo_rotate_ccw.gif' width='17' height='15' border='0' alt='Повернуть фотографию против часовой стрелки' title='Повернуть фотографию против часовой стрелки'></a> <a href='photothumber.php?block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]&return='><img src='../images/webcms/ico_photo_cut.gif' width='15' height='15' border='0' title='Изменить превью фотографии' ></a> <a href='pages.php?action=move_photos&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id&selected_photos[]=$photos[id]'><img src='../images/webcms/ico_photo_move.gif' width='15' height='15' border='0' title='Переместить фотографию'></a> <a href='pages.php?action=delete_photo&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id&photo_id=$photos[id]&return=' onclick=\"if(confirm('Фотография будет удалена!\\r\\n \\r\\nВы уверены?')){return true;} else {return false;}\"><img src='../images/webcms/ico_photo_del.gif' width='17' height='15' border='0' alt='Удалить фотографию' title='Удалить фотографию'></a></div>";
									if (!isset($_SESSION['move_photos']) or !in_array($photos["id"],$_SESSION['move_photos']))
										{
										$opacity = "";
										}
										else
										{
										$opacity = "opacity:0.5; filter:progid:DXImageTransform.Microsoft.Alpha(opacity=50);";
										}
										//
										$rand = md5((rand(0,999)+rand(0,999))/rand(0,999));
										if (!is_file("../photogallery/thumbs/$photos[photo].jpg"))
											{
												$params[0] = $preview_w;
												$params[1] = $preview_h;
												$img = "<img width='$params[0]' height='$params[1]' src='../img.php?dst=photogallery/thumbs/$photos[photo].jpg&name=photogallery/originals/$photos[photo].jpg&cut=$preview_cut&w=$preview_w&h=$preview_h&bgcolor=$preview_color' border='0'/>";
											}
											else
											{
												$params = getimagesize("../photogallery/thumbs/$photos[photo].jpg");
											$img = "<img width='$params[0]' height='$params[1]' src='../photogallery/thumbs/$photos[photo].jpg?rand=$rand' border='0'/>";
											}


										switch ($blocks['block_sub_type'])
												{
									case "0": $div_w = "width:" . ($params[0]+10) . "px;";  break;
									case "1": $div_w=""; break;
									case "2": $div_w="";  break;
											}

									echo  "<div id='photo_$photos[id]' style='$float; padding:5px; margin-left:2px; margin-right:2px; margin-top:5px; $div_w background-color:#ffffff; border:1px solid #e0e0e0; $opacity' align='center' onmousedown=\"do_move_ph=true; startMoveBlock('photo_$photos[id]'); return false;\"  onmouseover=\"move_photo_to='photo_$photos[id]';\">
									<div style='border:1px solid #e0e0e0; background-color:#f9f9f9; padding:2px; margin-bottom:3px;' align='right'>

								$menu_photo_edit

									</div><input type=\"hidden\" id='pos_photo_$photos[id]' value='$photos[position]' name='photo_pos[$photos[id]]' onclick=\"get_id('save_block_btn').style.display='';\">
									<div style='$float_img; padding-left:5px; padding-right:5px;'>$img</div>
<div align='left'>$photos[description]</div><div style='clear:both'></div></div>";

									}


					$block_h =  $div_size-($div_size/2)+20 . "px";
					$padding_top = ($div_size/2)-15 . "px";



					//echo  "<div id='add_photo_$blocks[id]' style='cursor:pointer; margin-top:5px; float:left; background:#ffffff url(../images/webcms/add_photo.gif) center no-repeat; border:1px solid #e0e0e0; padding:5px; width:100px; height:100px;' align='center' onclick=\"location.href='pages.php?action=photogallery&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id';\"></div>";

						echo  "<div style='clear:both;'><table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='cursor:pointer; border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"location.href='pages.php?action=photogallery&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id';\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='../images/webcms/ico_add_photogal.gif' border='0' align='absmiddle'> Добавить фото</div></td></tr></table>";

	if (isset($_SESSION['move_photos']) and count($_SESSION['move_photos'])!=0 and $_SESSION['move_photos']!="")
							{
							echo  "<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffea';\" style='cursor:pointer; border:1px solid #8791a4; background-color:#ffffea;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"location.href='pages.php?action=do_mass_move&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id';\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='../images/webcms/ico_photo_move.gif' border='0' align='absmiddle'> Переместить в эту фотогалерею</div></td></tr></table>";
echo  "<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffea';\" style='cursor:pointer; border:1px solid #8791a4; background-color:#ffffea;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"location.href='pages.php?action=unset_move_photos&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id';\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='../images/webcms/ico_photo_cancel.gif' border='0' align='absmiddle'> Отменить перемещение</div></td></tr></table>";
							}
echo "</div>";
echo "<div style='clear:both;'></div><div align='right' style='padding-top:3px;'><div style='float:left; font-size:10px;'><img src='../images/webcms/arrow_up.gif' border='0' align='absmiddle'> <a href='#' onclick=\" select_all('photo_block_$blocks[id]'); return false;\">Выделить все</a> / <a href='#' onclick=\"unselect_all('photo_block_$blocks[id]'); return false;\">Снять выделение со всех</a> |";
					if (!isset($_SESSION['move_photos']) or count($_SESSION['move_photos'])==0 or $_SESSION['move_photos']=="")
							{

					echo  " С выделенными фотографиями: <a href='#' onclick=\"get_id('block_action').value='move_photos'; document.blocks_form.submit(); return false;\"><img align='absmiddle' src='../images/webcms/ico_photo_move.gif' width='15' height='15' border='0'  title='Переместить выделенные фотографии'></a> <a href='#' onclick=\"if(confirm('Выделенные фотографии будут удалены!\\r\\n \\r\\nВы уверены?')){get_id('block_action').value='photo_mass_delete'; document.blocks_form.submit();} return false;\"><img src='../images/webcms/ico_photo_del.gif' width='17' height='15' border='0' alt='Удалить выделенные фотографии'  title='Удалить выделенные фотографии' align='absmiddle'></a>";
					 		}
							echo "</div>$block_menu</div>";
					echo  "<div style='clear:both;'></div></div>";
						if ($blocks['block_sub_type']==0)
					{
					echo "<script>upd_photos[upd_photos.length]='photo_block_$blocks[id]';</script>";
					}

					//
					$pr_cut = array("","");
					$pr_cut[$preview_cut] = "checked";
					echo "<table border='0' cellpadding='0' cellspacing='2' style='margin:1px;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='cursor:pointer; border:1px solid #8791a4;' nowrap='nowrap'> <div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"if (get_id('block_settings_$blocks[id]').style.display=='') {get_id('block_settings_$blocks[id]').style.display='none';} else {get_id('block_settings_$blocks[id]').style.display='';}\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='../images/webcms/ico_settings.gif' border='0' align='absmiddle'> Настройки блока</div></td>
</tr></table>";

echo "<div id='block_settings_$blocks[id]' style='display:none; border-top:1px solid #cccccc; padding-top:4px; margin-top:7px; '>
<table border='0' cellpadding='3' cellspacing='0'>
<tr>
<td>Количество колонок:</td><td><input id='num_cols_$blocks[id]' type='text' value='$num_cols' class='admin_input'  style='width:40px; text-align:center;'></td>
</tr>
<tr>
<td>Фотографий на странице:</td><td><input type='text' id='num_on_page_$blocks[id]' value='$num_on_page' style='width:40px; text-align:center;' class='admin_input'></td>
</tr>
<tr>
<td>Обрезать изображения:</td><td> <label><input type='radio' name='cut_img_$blocks[id]' id='cut_y_$blocks[id]' value='1' $pr_cut[1]> Да</label> <label><input type='radio' name='cut_img_$blocks[id]' value='0' $pr_cut[0]> Нет</label></td>
</tr>
<tr>
<td>Размер превью (ШxВ):</td><td> <input type='text' id='w_$blocks[id]' value='$preview_w' style='width:40px; text-align:center;' class='admin_input'>x<input type='text' id='h_$blocks[id]' value='$preview_h' style='width:40px; text-align:center;' class='admin_input'>
</td>
</tr>
<tr>
<td>
Цвет фона</td><td> #<input type='text' id='color_$blocks[id]' value='$preview_color' style='width:50px; text-align:left;' maxlength=6 class='admin_input'></td>
</tr>
<td>CSS-стиль:</td><td> <input id='block_style_$blocks[id]' type='text' value='$block_style' style='width:70px;' class='admin_input'></td>
</tr>
<tr>
<td colspan='2' align='center'>
<input type='button' value='Сохранить' class='admin_input' onclick=\"location.href='pages.php?menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]&block_id=$blocks[id]&block_action=save_settings&set_num_cols='+get_val('num_cols_$blocks[id]')+'&set_num_on_page='+get_val('num_on_page_$blocks[id]')+'&set_block_style='+get_val('block_style_$blocks[id]')+'&set_w='+get_val('w_$blocks[id]')+'&set_h='+get_val('h_$blocks[id]')+'&set_color='+get_val('color_$blocks[id]')+'&set_cut='+get_id('cut_y_$blocks[id]').checked;\">
</td>
</tr>
</table>

</div>";
//location.href='pages.php?menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]&block_id=$blocks[id]&block_action=save_settings&set_num_cols='+get_val('num_cols_$blocks[id]')+'&set_num_on_page='+get_val('num_on_page_$blocks[id]')+'&set_block_style='+get_val('block_style_$blocks[id]')+'&set_w='+get_val('w_$blocks[id]')+'&set_h='+get_val('h_$blocks[id]')+'&set_color='+get_val('color_$blocks[id]')+'&set_cut=get_id('cut_y_$block[id]').checked';
					}
?>