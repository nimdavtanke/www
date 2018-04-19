<?

/// Вывод подразделов
					if ($blocks['block_type']=="2")
					{



					if ($blocks['content']!="")
					{
						$blocks_info =  explode("::",$blocks['content']);
					$hidden_cats = explode(",",$blocks_info[0]);
					$num_cols = $blocks_info[1];
					$num_on_page = $blocks_info[2];
					$block_style = $blocks_info[3];
					$block_cat_id = $blocks_info[4];
					}
					else
					{
					$hidden_cats = array();
					$num_cols = $options['icon_num_cols'];
					$num_on_page = $options['subs_num_onpage'];
					$block_style = "";
					$block_cat_id = $cat_id;
					}
						echo  "<div style='float:right;'>$block_menu</div>";
						if (isset($_GET['block_action']) and $_GET['block_action']=="save_settings" and isset($_GET['block_id']) and $_GET['block_id']==$blocks['id'])
							{
								$q = "UPDATE page_blocks SET content='".implode(",",$hidden_cats)."::$_GET[set_num_cols]::$_GET[set_num_on_page]::$_GET[set_block_style]::$_GET[set_block_cat_id]' WHERE id='$blocks[id]'";
								$num_cols = $_GET['set_num_cols'];
					$num_on_page = "$_GET[set_num_on_page]";
					$block_style = "$_GET[set_block_style]";
					$block_cat_id ="$_GET[set_block_cat_id]";

											doquery($q);
											//echo "$q<br />";
							}

						if (isset($_GET['block_action']) and $_GET['block_action']=="links_show" and isset($_GET['block_id']) and $_GET['block_id']==$blocks['id'])
							{

								if ($_GET['show']=="0")
									{
									// Ищем в масиве не показываемых
										if (!in_array("$_GET[sub]",$hidden_cats))
											{
											// Добавляем
											$hidden_cats[]=$_GET['sub'];
											$q = "UPDATE page_blocks SET content='".implode(",",$hidden_cats)."::$num_cols::$num_on_page::$block_style::$block_cat_id' WHERE id='$blocks[id]'";

											doquery($q);
											}
									}
									if ($_GET['show']=="1")
									{

									// Ищем в масиве не показываемых
										if (in_array("$_GET[sub]",$hidden_cats))
											{
											// удаляем
											$pos = array_search ( "$_GET[sub]" ,  $hidden_cats );
											unset ($hidden_cats[$pos]);
											$q = "UPDATE page_blocks SET content='".implode(",",$hidden_cats)."::$num_cols::$num_on_page::$block_style::$block_cat_id' WHERE id='$blocks[id]'";
											doquery($q);
											}
									}
							}
						$q = "SELECT id,name,full_name, menu_id, cat_id, short_description FROM menu_items WHERE cat_id='$block_cat_id' ORDER BY position";
							$links = doquery($q);
								if (mysql_num_rows($links)=="0")
									{
										echo  "<br /><i style='color:#8791a4;'>Нет подразделов</i><br /><br />";
									}


														echo "<table border='0' cellpadding='5' cellspacing='3' width='100%' class='block_links_icons'><tr>";
													$i=0;
														while ($subs = mysql_fetch_assoc($links))
															{
															$i++;
															$check = "<a href='pages.php?menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]&block_id=$blocks[id]&block_action=links_show&show=0&sub=$subs[id]#block_$blocks[id]' target='main'><img src='../images/webcms/checked.gif' border='0' alt='Нажмите, чтобы не показывать этот пункт в блоке' title='Нажмите, чтобы не показывать этот пункт в блоке'></a>";
													if (in_array("$subs[id]",$hidden_cats))
														{
														$check = "<a href='pages.php?menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]&block_id=$blocks[id]&block_action=links_show&show=1&&sub=$subs[id]#block_$blocks[id]' target='main'><img src='../images/webcms/unchecked.gif' border='0' alt='Нажмите, чтобы показывать этот пункт в блоке' title='Нажмите, чтобы показывать этот пункт в блоке'></a>";
														}
											$name = $subs["name"];
												if ($subs["full_name"]!="") $name = $subs["full_name"];
												$img = "";
													if (is_file("../page_icons/$subs[id].jpg"))
														{
														$img = "<img src='../page_icons/$subs[id].jpg' border='0'>";
														}

														////////////////////////////////////////////
														if ($blocks['block_sub_type']=="0")
													{
															echo "<td align='left' valign='top'><div class='block_links_header'>$check <a href='pages.php?menu_id=$subs[menu_id]&cat_id=$subs[id]' target='main' onclick=\"select_cat('$subs[menu_id]','$subs[id]');\">$name</a></div></td>";

													}
												if ($blocks['block_sub_type']=="1")
													{
												echo  "<td align='left' valign='top'><div class='block_links_header'>$check <a href='pages.php?menu_id=$subs[menu_id]&cat_id=$subs[id]' target='main' onclick=\"select_cat('$subs[menu_id]','$subs[id]');\">$name</a></div>";
											$description ="";
												if (trim(strip_tags($subs['short_description']))!="")
												{
												$description = $subs['short_description'];
												}
												else
												{
												// Ищем ПЕРВЫЙ текстовый блок
													$q = "SELECT content FROM page_blocks WHERE menu_id='$subs[id]' AND block_type='0' ORDER BY position LIMIT 0,1";
														$get_descr = mysql_fetch_assoc(doquery($q));
															if ($get_descr["content"]!="")
																{
																$description = strip_tags($get_descr["content"]);
																$description = html_cut($description, 60);

																}
												}
												if ($description!="")
												{
													echo  "<div class='block_links_description'>$description</div>";
												}
												echo "</td>";
													}
														///////////////////////////////////////////
														if ($blocks['block_sub_type']=="2")
														{


																echo "<td align='center' valign='top'>$check <a href='pages.php?menu_id=$subs[menu_id]&cat_id=$subs[id]' target='main' onclick=\"select_cat('$subs[menu_id]','$subs[id]');\"><div class='icon'>$img</div><div class='name'> $name</div></a></td>";
														}

														if ($blocks['block_sub_type']=="4")
														{

															if ($img=="") $img = "Иконка отсутствует";
																echo "<td align='center' valign='top'>$check <a href='pages.php?menu_id=$subs[menu_id]&cat_id=$subs[id]' target='main' onclick=\"select_cat('$subs[menu_id]','$subs[id]');\"><div class='icon'>$img</div></a></td>";
														}


														if ($blocks['block_sub_type']=="3")
														{
															$img = "";
													if (is_file("../page_icons/$subs[id].jpg"))
														{
														$img = "<img src='../page_icons/$subs[id].jpg' align='left' style='margin:5px;' border='0'>";
														}
														$description ="";
												if (trim(strip_tags($subs['short_description']))!="")
												{
												$description = $subs['short_description'];
												}
												else
												{
												// Ищем ПЕРВЫЙ текстовый блок
													$q = "SELECT content FROM page_blocks WHERE menu_id='$subs[id]' AND block_type='0' ORDER BY position LIMIT 0,1";
														$get_descr = mysql_fetch_assoc(doquery($q));
															if ($get_descr["content"]!="")
																{
																$description = strip_tags($get_descr["content"]);
																$description = html_cut($description, 60);

																}
												}
																echo "<td align='left' valign='top'>$img $check <a href='pages.php?menu_id=$subs[menu_id]&cat_id=$subs[id]' target='main' onclick=\"select_cat('$subs[menu_id]','$subs[id]');\">$name</a><br /> $description</td>";
														}



																	if ($i==$num_cols)
																		{
																		echo "</tr><tr>";
																		$i=0;
																		}
															}
															echo "</table>";




													echo "<table border='0' cellpadding='0' cellspacing='2' style='margin:1px;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='cursor:pointer; border:1px solid #8791a4;' nowrap='nowrap'> <div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"if (get_id('block_settings_$blocks[id]').style.display=='') {get_id('block_settings_$blocks[id]').style.display='none';} else {get_id('block_settings_$blocks[id]').style.display='';}\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='../images/webcms/ico_settings.gif' border='0' align='absmiddle'> Настройки блока</div></td>
</tr></table>";
													echo "<div id='block_settings_$blocks[id]' style='display:none; border-top:1px solid #cccccc; padding-top:4px; margin-top:7px; '>ID категории: <input id='set_cat_id_$blocks[id]' type='text' value='$block_cat_id' class='admin_input'  style='width:20px; text-align:center;'> | Количество колонок: <input id='num_cols_$blocks[id]' type='text' value='$num_cols' class='admin_input'  style='width:20px; text-align:center;'> | Пунктов на странице: <input type='text' id='num_on_page_$blocks[id]' value='$num_on_page' style='width:20px; text-align:center;' class='admin_input'> | CSS-стиль: <input id='block_style_$blocks[id]' type='text' value='$block_style' style='width:70px;' class='admin_input'> <input type='button' value='Сохранить' class='admin_input' onclick=\"location.href='pages.php?menu_id=$_GET[menu_id]&cat_id=$_GET[cat_id]&block_id=$blocks[id]&block_action=save_settings&set_num_cols='+get_val('num_cols_$blocks[id]')+'&set_num_on_page='+get_val('num_on_page_$blocks[id]')+'&set_block_style='+get_val('block_style_$blocks[id]')+'&set_block_cat_id='+get_val('set_cat_id_$blocks[id]');\"> </div>";
													echo  "<div style='float:right;'>$block_menu</div>";
													}

?>