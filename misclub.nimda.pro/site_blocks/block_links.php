<?

/// Вывод подразделов
							if ($blocks['block_type']=="2")
					{
				$hidden ="";
				if ($blocks['content']!="")
					{
						$blocks_info =  explode("::",$blocks['content']);
						if ($blocks_info[0]!="")
						{
					$hidden_cats = explode(",",$blocks_info[0]);
						}
						else
						{
							$hidden_cats = array();
						}
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
					$block_cat_id = $m_id;
					}
					if ($block_style=="")
					{
						if ($blocks['block_sub_type']==0)
							{
					$block_style= "block_titles";
							}
							if ($blocks['block_sub_type']==1)
							{
					$block_style= "block_title_descr";
							}
							if ($blocks['block_sub_type']==2)
							{
					$block_style= "block_mozaic";
							}

							if ($blocks['block_sub_type']==4)
							{
					$block_style= "block_mozaic_icons";
							}

							if ($blocks['block_sub_type']==3)
							{
					$block_style= "block_links_icons";
							}
					}
					foreach ($hidden_cats as $key=>$val)
						{
							if (trim($val)=="")
								{
								unset($hidden_cats[$key]);
									}
							}
							if (count($hidden_cats)!=0)
								{
									$hidden ="AND id NOT IN(".implode(", ",$hidden_cats).")";
								}
						// Считаем сколько всего подразделов
						$q = "SELECT COUNT(id) as total FROM menu_items WHERE cat_id='$block_cat_id' $hidden ORDER BY position";

						$count = mysql_fetch_assoc(doquery($q));
						//
						$q = "SELECT id,name,full_name, key_name, short_description,cat_id, link FROM menu_items WHERE cat_id='$block_cat_id' $hidden ORDER BY position";

						$list_pages ="";
						if ($num_on_page !=0)
						{
							if (!isset($_GET['p'])) $_GET['p']=1;
							$total_pages = ceil($count['total']/$num_on_page);
							$start = ($_GET['p']-1)*$num_on_page;
							$list_pages = get_pages($_GET['p'],$total_pages);
							$q.=" LIMIT $start,$num_on_page";
						}

							$links = doquery($q);

					echo "<table border='0' cellpadding='5' cellspacing='3' width='100%' class='$block_style'><tr>";
													$i=0;
													$td_width = round(100/$num_cols) . "%";
														while ($subs = mysql_fetch_assoc($links))
															{
															$i++;
															if ($options['rewrite_url']=="1")
																{
															$link = $options['site_url'] . build_url($subs['cat_id']) . $subs['key_name'] . "/";
																}
																else
																{
																	$link = $options['site_url'] . "index.php/" .$subs['key_name'];
																}
																$target_blank = "";
																	if ($subs['link']!="")
																		{
																			$target = explode("::","$subs[link]");
																				if (isset($target[1]))
																					{
																						$target_blank = "target='_blank'";
																					}
																					$link = $target[0];
																		}
											$name = $subs["name"];
												if ($subs["full_name"]!="") $name = $subs["full_name"];
												$img = "";
													if (is_file("page_icons/$subs[id].jpg"))
														{
														$img = "<img src='page_icons/$subs[id].jpg' border='0'>";
														}
														////////////////////////////////////////////
														if ($blocks['block_sub_type']=="0")
													{
															echo "<td width='$td_width' align='left' valign='top'><div class='block_links_header'> <a href='$link' $target_blank>$name</a></div></td>";

													}
												if ($blocks['block_sub_type']=="1")
													{
												echo  "<td align='left' valign='top' width='$td_width' ><div class='block_links_header'> <a href='$link' $target_blank>$name</a></div>";
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


																echo "<td width='$td_width'  align='center' valign='top'><a href='$link' $target_blank><div class='icon'>$img</div><div class='name'> $name</div></a></td>";
														}

														if ($blocks['block_sub_type']=="4")
														{


																echo "<td width='$td_width'  align='center' valign='top'><a href='$link' $target_blank><div class='icon'>$img</div></a></td>";
														}


														if ($blocks['block_sub_type']=="3")
														{
															$img = "";
													if (is_file("page_icons/$subs[id].jpg"))
														{
														$img = "<div class='icon'><img src='page_icons/$subs[id].jpg' style='margin:5px;' border='0'></div>";
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
																echo "<td width='$td_width'  align='left' valign='top'>$img<div class='name'><a href='$link' $target_blank>$name</a></div><div class='description'>$description</div></td>";
														}



																	if ($i==$num_cols)
																		{
																		echo "</tr><tr>";
																		$i=0;
																		}
															}
															echo "</table>";

										if ($total_pages>1)
{
	 $get_tmp = file_get_contents( "$DOC_ROOT"."templates/block_links_pages.html" );
$get_tmp = str_replace("\"","\\\"",$get_tmp);
eval ("\$str = \"$get_tmp\";");
										echo "$str";
}
					}
?>