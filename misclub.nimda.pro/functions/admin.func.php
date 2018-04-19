<?
$DOC_ROOT = "../";
$bgcolor[1] = "#FFFFFF";
$bgcolor[2] = "#e0e0e0";
$bgcolor[3] = "#FFFFFF";
$bgcolor[4] = "#e0e0e0";
$bgcolor[5] = "#FFFFFF";
$bgcolor[6] = "#e0e0e0";
function get_menu_structure($menu_id, $cat_now)
{
global $bgcolor;
	$q = "SELECT * FROM menu_items WHERE menu_id='$menu_id' AND cat_id='$cat_now' ORDER BY position";
		$do = doquery($q);
			while ($menu = mysql_fetch_assoc($do))
				{
				$padding = (($menu['level']-1)*14)+2 .'px';
				$sub_link = "";
				$childs = false;
				if (check_childs($menu_id, $menu['id']))
					{
					$childs = true;

				////// РАСКРЫТ ЛИ СПИСОК ИЛИ НЕТ
				$show_sub_src = "../images/webcms/show_sub.gif";
				$show_sub_title = "Показать подразделы";
				$display_subs = "none";
				if (isset($_SESSION['showed_cats']) and is_array($_SESSION['showed_cats']))
									{
							if (in_array($menu['id'],$_SESSION['showed_cats']))
								{
								$display_subs = "";
								$show_sub_src = "../images/webcms/hide_sub.gif";
								$show_sub_title = "Скрыть подразделы";
								}
									}
				$sub_link = "<img src='$show_sub_src' title='$show_sub_title' onclick=\"if (get_id('sub_$menu[id]').style.display==''){ hide_sub('$menu[id]'); get_id('sub_$menu[id]').style.display='none'; this.src='../images/webcms/show_sub.gif';} else { show_sub('$menu[id]'); get_id('sub_$menu[id]').style.display=''; this.src='../images/webcms/hide_sub.gif';} return false;\" border='0' align='absmiddle' style='cursor:pointer;'>";

					}
					$level = $menu['level'];
					$color_link  = "";
					if ($menu['show_in_menu']=='0') $color_link = "color:#8791a4;";
$link_ico = "";
$move_arr = "<img id='moveto_$menu[id]' title='Переместить в этот раздел' onclick=\"get_id('form_action').value='move_to'; get_id('form_moveto_menu').value='$menu_id'; get_id('form_moveto').value='$menu[id]'; menu_form.submit();\" src='../images/webcms/arr_right.gif' border='0' style='display:none;'>";
					if ($menu['link']!="")
						{
						$move_arr = "";
						$link_ico = "<a href='$menu[link]' target='_blank'><img alt='Ссылка' title='Ссылка' src='../images/webcms/ico_link.gif' border='0'></a>";
						}
				echo "<div id='menu_item_$menu[id]' style='background-color:$bgcolor[$level];'><table border='0' cellpadding='2' cellspacing='0'  onmouseover=\"move_to='menu_item_$menu[id]'; 	if (move_block=='') {this.style.backgroundColor='#e1ffe6';}\"  onmouseout=\"this.style.backgroundColor='';\" ><tr><td style='padding-left:$padding;' align='right' nowrap>
				$move_arr <input type='checkbox' id='menu_chbox_$menu[id]' name='checked_menu[]' value='$menu[id]' style='display:none;'><img src='../images/webcms/unchecked.gif' id='img_chbox_$menu[id]' onclick=\"check($menu[id],$menu[cat_id]);\" align='absmiddle' style='cursor:pointer;' title='Выделить'></td><td width='10' align='right' nowrap>$sub_link</td><td align='left' width='100%'><input type=\"hidden\" id='pos_menu_item_$menu[id]' value='$menu[position]' name='menu_pos[$menu[id]]'>

				<input name='menu_name[$menu[id]]' type='text' id='input_name_$menu[id]' value='$menu[name]' style='border:1px solid #000000; width:100%; display:none;' onclick=\"\" onblur=\" this.style.display='none'; get_id('link_name_$menu[id]').style.display='inline'; if (this.value!='') {get_id('link_name_$menu[id]').innerHTML =this.value;}\" onchange=\"if (this.value!='') {switch_save_btn();}\" onkeypress=\"if(event.keyCode==13) {this.blur();}\">

				<a style='$color_link' id='link_name_$menu[id]' href='pages.php?menu_id=$menu_id&cat_id=$menu[id]' target='main' ondblclick=\"get_id('input_name_$menu[id]').value=this.innerHTML; get_id('input_name_$menu[id]').style.display='inline'; get_id('input_name_$menu[id]').focus(); this.style.display='none';\" onclick=\"select_cat('$menu_id','$menu[id]');\">$menu[name]</a>

				</td><td align='rigth' width='10'>$link_ico</td><td align='rigth' width='10'><img src='../images/webcms/topdown_sm.gif' onmousedown=\"startMoveBlock('menu_item_$menu[id]'); return false;\" title=\"Переместить раздел\" align='absmiddle' style='cursor:s-resize;'></td></tr></table>";
				if ($childs)
				{
				echo "<div style='display:$display_subs;' id='sub_$menu[id]'>";

					get_menu_structure($menu_id, "$menu[id]");
					echo "</div>";
				}
					echo "</div>";
				}
}

function get_last_position ($menu_id,$level)
	{
	$q = "SELECT position FROM menu_items WHERE menu_id='$menu_id' AND level='$level' ORDER BY position DESC LIMIT 0,1";
		$res = mysql_fetch_assoc(doquery($q));

			return $res['position'];
	}


	////// очищение массива выбранных разделов от "детей"
	function move_childs($checked_menu,$menu_id,$menu,$level)
			{
				$q = "SELECT id, cat_id, level FROM menu_items WHERE cat_id='$menu_id'";
					$do = doquery($q);
						while ($menus = mysql_fetch_assoc($do))
							{

							$q = "UPDATE menu_items SET level='$level', menu_id='$menu' WHERE id='$menus[id]'";
								doquery($q);

									$find_key = array_search($menus['id'],$checked_menu);
									if ($find_key!==false)
										{
										unset($checked_menu[$find_key]);
										$checked_menu = array_values($checked_menu);
										$new_level = $menus['level']+1;
										$checked_menu = move_childs($checked_menu,$menus['id'],$menu,$new_level);
										}

							}
							return $checked_menu;
			}
			// ПОЛУЧЕНИЕ СПИСКА МЕТА NAME
		function	get_meta_name_opt ($selected)
			{
			$meta_name[] = "Robots";
			$meta_name[] ="Description";
			$meta_name[] ="Keywords";
			$meta_name[] ="Document-state";
			$meta_name[] ="URL";
			$meta_name[] ="Author";
			$meta_name[] ="Generator";
			$meta_name[] ="Copyright";
			$meta_name[] ="Distribution";
			$meta_name[] ="Resource-type";
			$meta_list ="";
				for ($i=0;$i<count($meta_name);$i++)
					{
					$meta_list .= "<option value='$meta_name[$i]'";
						if ($selected =="$meta_name[$i]")
							{
							$meta_list .= " selected";
							}
					$meta_list .= ">$meta_name[$i]</option>";
					}
					return $meta_list;
			}

			/////// Списки да/нет
			function get_selected_opt ($value,$kolvo)
{
for ($i=0;$i<$kolvo;$i++)
{

if ($i==$value)
{
$perem["$i"] = "checked";
}
else
{
$perem["$i"] = "";
}
}
return $perem;
}

/////// СОЗДАНИЕ ИМЕНИ createname (prefix:string, destination:string,file_type:string):string;
	function createname($prefix, $dest,$file_type)
		{
			$filename = "$prefix" . md5(rand(0,1000000)."webCMS random codding".rand(1000,1000000));
				if (file_exists("$dest"."$filename".".$file_type"))
					{
					createname($prefix, $dest,$file_type);
					}
					else
					{
					return $filename;
					}
		}
////////////////////////////////////// ЗАКАЧКА ФОТОГРАФИЙ
function upload_photo($source_src,$filename, $dst,$block_id)
{
global $options;
$params = getimagesize($source_src);
$photo_cut = $options["photothumb_cut"];
$max_photothumb_small=$options["max_photothumb_small"];
$max_photothumb_big=$options["max_photothumb_big"];
$preview_color = $options['photogallery_preview_color'];
// Получаем настройки блока
$q = "SELECT content FROM page_blocks WHERE id='$block_id'";
$do = mysql_fetch_assoc(doquery($q));
$block_opt = $do['content'];
if ($block_opt!="")
	{
		$block_opt = explode("::",$block_opt);

			$photo_cut = $block_opt[6];
			$max_photothumb_small= $block_opt[4];
			$max_photothumb_big= $block_opt[3];
			$preview_color = $block_opt[5];

	}

if ($params[2]!=1 and $params[2]!=2 and $params[2]!=3)
{
echo "Недопустимое расширение файла!<br />";
return false;
}
switch ( $params[2] )
	{
  case 1: $source = imagecreatefromgif($source_src); break;
  case 2: $source = imagecreatefromjpeg($source_src); break;
  case 3: $source = imagecreatefrompng($source_src); break;
	}
	$img_ratio = $params[0]/$params[1];
if ($photo_cut==1)
	{
	if ($params[0]>$max_photothumb_big || $params[1]>$max_photothumb_big)
	{

				if($params[0]>$params[1])
					{
				$resource_height = $max_photothumb_small;
				$resource_width = $resource_height*$img_ratio;
					}
					else
					{
						$resource_width = $max_photothumb_big;
						$resource_height = $resource_width/$img_ratio;
					}
			}
			else
			{
			$resource_width = "$params[0]";
			$resource_height = "$params[1]";
			}
		$resource = imagecreatetruecolor($resource_width, $resource_height);
			imagecopyresampled($resource, $source, 0, 0, 0, 0, $resource_width, $resource_height, $params[0], $params[1]);

	$resource2 = imagecreatetruecolor($max_photothumb_big, $max_photothumb_small);
			//imagecopyresampled($resource, $source, 0, 0, ($params[0]-$max_photothumb_big) -($params[0]-$max_photothumb_big)/2, 0,$resource_width, $resource_height, $params[0], $params[1]);
			imagecopy ($resource2, $resource, 0, 0, ceil(($resource_width-$max_photothumb_big)/2), ceil(($resource_height-$max_photothumb_small)/2), $resource_width, $resource_height);
			  $resource_src = "$dst/thumbs/$filename".".jpg";
				if (!imagejpeg($resource2, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}

	}
	else
	{

	if ($params[0]>$max_photothumb_big || $params[1]>$max_photothumb_big)
	{
			if ($params[0]>$params[1])
				{

				$resource_width = $max_photothumb_big;
				$resource_height = $resource_width/$img_ratio;
					if ($resource_height>$max_photothumb_small)
						{
						$resource_height = $max_photothumb_small;
						$resource_width = $resource_height*$img_ratio;
						}
				}
				else
				{
				$resource_height= $max_photothumb_big;
				$resource_width  = $resource_height*$img_ratio;
					if ($resource_width>$max_photothumb_small)
						{
						$resource_width = $max_photothumb_small;
						$resource_height = $resource_width/$img_ratio;
						}
				}
			}
			else
			{
			$resource_width = "$params[0]";
			$resource_height = "$params[1]";
			}
			$resource_width =ceil($resource_width);
			$resource_height =ceil($resource_height);
				// Создаем доп. изображение
					$resource2 =  imagecreatetruecolor($max_photothumb_big, $max_photothumb_small);
					$color = hex2RGB($preview_color);
					 $color = imagecolorallocate ( $resource2, $color['red'], $color['green'], $color['blue']);
						imagefill ( $resource2 , 0 , 0 ,  $color );

			$resource = imagecreatetruecolor($resource_width, $resource_height);
			imagecopyresampled($resource, $source, 0, 0, 0, 0, $resource_width, $resource_height, $params[0], $params[1]);

			imagecopy ($resource2, $resource,floor(($max_photothumb_big-$resource_width)/2), floor(($max_photothumb_small-$resource_height)/2), 0, 0, $resource_width, $resource_height);
			  $resource_src = "$dst/thumbs/$filename".".jpg";

				if (!imagejpeg($resource2, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}
	}
	unset($resource);
	unset($resource2);
		//// Сохраняем "рабочий" вариант
			$max_size = $options["max_photo_size"];
				if ($params[0]>$max_size || $params[1]>$max_size)
					{
						if ($params[0]>$params[1])
							{
								$resourse_w = $max_size;
								$resourse_h = ceil($resourse_w/$img_ratio);
							}
							else
							{
								$resourse_h = $max_size;
								$resourse_w = ceil($resourse_h*$img_ratio);
							}
					}
					else
					{
					$resourse_w = $params[0];
					$resourse_h = $params[1];
					}
			$resource = imagecreatetruecolor($resourse_w, $resourse_h);
			imagecopyresampled($resource, $source, 0, 0, 0, 0, $resourse_w, $resourse_h, $params[0], $params[1]);
			  $resource_src = "$dst/photos/$filename".".jpg";
					if (!imagejpeg($resource, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}
					/// Сохраняем оригинал
				  $resource_src = "$dst/originals/$filename".".jpg";
						if (!imagejpeg($source, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}
					return true;
}

// Закачка иконки
////////////////////////////////////// ЗАКАЧКА ФОТОГРАФИЙ
function upload_icon($source_src,$filename)
{
global $options;
$params = getimagesize($source_src);
$photo_cut = $options["icon_cut"];
$max_photothumb_small=$options["icon_h"];
$max_photothumb_big=$options["icon_w"];
if ($params[2]!=1 and $params[2]!=2 and $params[2]!=3)
{
echo "Недопустимое расширение файла!<br />";
return false;
}
switch ( $params[2] )
	{
  case 1: $source = imagecreatefromgif($source_src); break;
  case 2: $source = imagecreatefromjpeg($source_src); break;
  case 3: $source = imagecreatefrompng($source_src); break;
	}
	$img_ratio = $params[0]/$params[1];
if ($photo_cut==1)
	{
	if ($params[0]>$max_photothumb_big || $params[1]>$max_photothumb_big)
	{

				if($params[0]>$params[1])
					{
				$resource_height = $max_photothumb_small;
				$resource_width = $resource_height*$img_ratio;
					}
					else
					{
						$resource_width = $max_photothumb_big;
						$resource_height = $resource_width/$img_ratio;
					}
			}
			else
			{
			$resource_width = "$params[0]";
			$resource_height = "$params[1]";
			}
		$resource = imagecreatetruecolor($resource_width, $resource_height);
			imagecopyresampled($resource, $source, 0, 0, 0, 0, $resource_width, $resource_height, $params[0], $params[1]);

	$resource2 = imagecreatetruecolor($max_photothumb_big, $max_photothumb_small);
			//imagecopyresampled($resource, $source, 0, 0, ($params[0]-$max_photothumb_big) -($params[0]-$max_photothumb_big)/2, 0,$resource_width, $resource_height, $params[0], $params[1]);
			imagecopy ($resource2, $resource, 0, 0, ceil(($resource_width-$max_photothumb_big)/2), ceil(($resource_height-$max_photothumb_small)/2), $resource_width, $resource_height);
			  $resource_src = "../page_icons/$filename".".jpg";
				if (!imagejpeg($resource2, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}
					  $resource_src = "../page_icons/originals/$filename".".jpg";

				if (!imagejpeg($source, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}

	}
	else
	{

	if ($params[0]>$max_photothumb_big || $params[1]>$max_photothumb_big)
	{
			if ($params[0]>$params[1])
				{

				$resource_width = $max_photothumb_big;
				$resource_height = $resource_width/$img_ratio;
					if ($resource_height>$max_photothumb_small)
						{
						$resource_height = $max_photothumb_small;
						$resource_width = $resource_height*$img_ratio;
						}
				}
				else
				{
				$resource_height= $max_photothumb_big;
				$resource_width  = $resource_height*$img_ratio;
					if ($resource_width>$max_photothumb_small)
						{
						$resource_width = $max_photothumb_small;
						$resource_height = $resource_width/$img_ratio;
						}
				}
			}
			else
			{
			$resource_width = "$params[0]";
			$resource_height = "$params[1]";
			}
			$resource_width =ceil($resource_width);
			$resource_height =ceil($resource_height);
				// Создаем доп. изображение
					$resource2 =  imagecreatetruecolor($max_photothumb_big, $max_photothumb_small);
					$color = hex2RGB($options['icon_preview_color']);
					 $color = imagecolorallocate ( $resource2, $color['red'], $color['green'], $color['blue']);
						imagefill ( $resource2 , 0 , 0 ,  $color );

			$resource = imagecreatetruecolor($resource_width, $resource_height);
			imagecopyresampled($resource, $source, 0, 0, 0, 0, $resource_width, $resource_height, $params[0], $params[1]);

			imagecopy ($resource2, $resource,floor(($max_photothumb_big-$resource_width)/2), floor(($max_photothumb_small-$resource_height)/2), 0, 0, $resource_width, $resource_height);
			  $resource_src = "../page_icons/$filename".".jpg";

				if (!imagejpeg($resource2, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}
					  $resource_src = "../page_icons/originals/$filename".".jpg";

				if (!imagejpeg($source, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}

	}
	unset($resource);
	unset($resource2);
					return true;
}

function check_key_name($name, $postfix, $exception="")
	{
	if ($postfix!="")
		{
			$check_name = $name."_".$postfix;
		}
		else
		{
		$check_name = $name;
		}
		$q = "SELECT id FROM menu_items WHERE key_name='$check_name'";
		if ($exception!="") $q .= "AND id!='$exception'";
			$do = doquery($q);
				if (mysql_num_rows($do)==0)
					{
					return $check_name;
					}
				else
					{
					if ($postfix !="")
						{
						$postfix = $postfix+1;
						}
						else
						{
						$postfix = "2";
						}
						$check_name = check_key_name($name, $postfix);
						return $check_name;
					}
	}
function update_date_edit($menu_id)
{
$date = date("d.m.Y.H.i");
	$q = "UPDATE menu_items SET date_edit='$date', user_edit='$_SESSION[logged_user_id]' WHERE id='$menu_id'";
	doquery($q);
}
function del_short_word (&$item1, $key) { if (strlen($item1)<3) $item1=""; }

function remove_dir($directory)
    {
        if (!file_exists($directory)) return;
        $dir = opendir($directory);
        while(($file = readdir($dir))){
            if ( is_file ($directory."/".$file))
            {
              unlink ($directory."/".$file);
            }
            else if ( is_dir ($directory."/".$file) &&
                     ($file != ".") && ($file != ".."))
            {
              remove_dir($directory."/".$file);
            rmdir($directory."/".$file);


            }
        }
        closedir ($dir);
    }
// Функция Вывод "Поля с датой"
function input_date($name, $width, $value)
	{
	echo "<div id='calendar_$name' style='position:absolute; z-index:220; visibility:hidden; margin-top:21px;' class='calendar'></div><input type='text' name='$name' id='$name' class='admin_input' value='$value' style='width:$width;'> <a onclick=\"set_date('$name','calendar_$name');\"><img src=\"../images/webcms/calendar.gif\" border=\"0\" align=\"absmiddle\"></a>";
	}
// Функция установки модулей - копирование файлов
	function upload_modules($dir,$base)
		{
			$open_dir = opendir("$dir");
				while ($get_file = readdir($open_dir))
						{
						if ($get_file!="install.php" and $get_file!="module.zip")
							{
						$filename = $dir . "/".$get_file;
						$path_parts = pathinfo($filename);
							if ($get_file!="." and $get_file!="..")
							{
								if (is_dir($filename))
								{
								$const_dir = str_replace("$base","../",$filename);
								if (!is_dir($const_dir))
									{
									echo "Создаю каталог $const_dir... ";
										if (mkdir($const_dir))
											{
											echo "<strong>готово!</strong><br />";
											}
											else
											{
											echo "<strong style='color:#990000;'>неудача!</strong><br />";
												die();
											}
									}
								upload_modules($filename,$base);
								}
								else
								{

									$dest = str_replace("$base","../",$filename);
								echo "Копирую файл $filename в $dest... ";
								$mess = "скопирован!";
									if (is_file($dest))
										{
										$mess = "обновлен!";
										}
										if (copy($filename, $dest))
											{
											echo "<strong>$mess</strong><br />";
											}
											else
											{
											echo "<strong style='color:#990000;'>неудача!</strong><br />";
												die();
											}
								}
								}
							}
						}
		}
/// Редактор !!!!
// CKEditor
function show_editor($textareas = array(), $values = array(), $titles = array())
{
	global $options;
	if (count($textareas)!=0)
		{


			$disp = "";
			$color = "#f0f0f0";
	$editor_tabs = $editors =$js_func= "";
			foreach ($textareas as $key=>$id)
				{
					$js_func .="get_id('div_$id').style.backgroundColor='#ffffff';
					get_id('editor_$id').style.display='none';
					";
					$editor_tabs .= "<div id='div_$id' onclick=\"editor_select_tab('$id');\" style='cursor:pointer; background-color:$color; float:left; margin-right:4px; padding:4px 8px; border:1px solid #cccccc; border-bottom:0px solid #cccccc; '>$titles[$key]</div>";

			$editors.= "<div style='display:$disp;' id='editor_$id'><textarea name='$id' id='$id'>$values[$key]</textarea>";
			$editors.= "
			<script type=\"text/javascript\">
			//<![CDATA[

				CKEDITOR.replace( '$id',
					{
						skin : 'moono',
						extraPlugins : 'autogrow',
						autoGrow_maxHeight : 800,

	filebrowserBrowseUrl:'$options[site_url]filemanager/browse.php?type=files',
   filebrowserImageBrowseUrl : '$options[site_url]filemanager/browse.php?type=images',
   filebrowserFlashBrowseUrl : '$options[site_url]filemanager/browse.php?type=flash',
   filebrowserUploadUrl : '$options[site_url]filemanager/upload.php?type=files',
   filebrowserImageUploadUrl: '$options[site_url]filemanager/upload.php?type=images',
   filebrowserFlashUploadUrl : '$options[site_url]filemanager/upload.php?type=flash',
					});

			//]]>
			</script>";
			$editors.= "</div>";
			$disp = "none";
			$color ="#ffffff";
				}

				// Выводим...
					// js
					if (count($textareas)>1 )
						{
			echo "<script type=\"text/javascript\">
			function editor_select_tab (select)
				{
					$js_func
					get_id('div_'+select).style.backgroundColor = '#f0f0f0';
					get_id('editor_'+select).style.display = '';
				}
			</script>";
			echo "$editor_tabs<div style='clear:both;'></div>";
						}
			echo "$editors";
		}
}

//// Получение массива настроек
function get_options_array($options)
{
$where = array();
	foreach ($options as $opt_var)
		{
		$where[] = "option_var='$opt_var'";
		}
$query = "SELECT * FROM settings WHERE ".implode(" OR ", $where)."";
$do_opt = doquery($query);
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

}


function get_link_to_page_list($menu_id=0, $cat_now=0,$dont_show=0,$selected=array())
{
global $options;
	$q = "SELECT menu_items.* FROM menu_items WHERE menu_items.menu_id='$menu_id' AND menu_items.cat_id='$cat_now' ORDER BY position";
		$do = doquery($q);
			while ($menu = mysql_fetch_assoc($do))
				{
				$padding = (($menu['level']-1)*14)+2 .'px';
				$sub_link = "";
				$childs = false;
				if (check_childs($menu_id, $menu['id']))
					{
					$childs = true;
					}
if ($menu['id']!=$dont_show)
	{
	 $checked="";
	if (in_array($menu['id'],$selected)) $checked="checked";

                                   $link = "/" . build_url("$menu[id]");
                                   			 $s = "";
                                   			if (isset($_GET['selected']) and $_GET['selected']=="$link")
                                   				{
                                       $s = "font-weight:bold;";                                   					}
					echo "<a onclick=\"get_id('input_link').value='$link'; $('#div_link_list').hide('fast');\" style='$s'>$menu[name]</a><br />";

	}
				if ($childs)
				{
				echo "<div style='padding-left:". 10*$menu['level'] . "px;'>";

					get_link_to_page_list($menu_id, "$menu[id]",$dont_show,$selected);
					echo "</div>";
				}
				}
}

// Функция упорядоченного вывода каталогов из всех меню
	function get_link_to_page_show($dont_show=0,$selected = array())
{
global $options;
	$q = "SELECT * FROM menu";
		$do = doquery($q);
			while ($menu = mysql_fetch_assoc($do))
				{
					get_link_to_page_list($menu['id'], 0,$dont_show,$selected);
				}
}

function get_webcms_version()
{
// Текущая версия
$q ="SELECT * FROM webcms_info";
$get_version = doquery($q);
$webcms = array();
while ($v=mysql_fetch_assoc($get_version))
	{
          $webcms[$v['code']] = $v['version'];
		}
		return $webcms;	}

?>