<?
////// РАБОТА С ФОТОГРАФИЯМИ
/// Фотогалерея
if (!isset($_GET['p']) or $_GET['p']=="") $_GET['p']=1;
if (!isset($_GET['gal'])) $_GET['gal']="";
					if ($blocks['block_type']=="1")
					{
					$page_now = 1;
					if ($_GET['gal']==$blocks['id'])
						{
      $page_now = $_GET['p'];
							}
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
		$start = ($page_now-1)*$num_on_page;
					// Считаем фотки
									$count_photos = "SELECT COUNT(*) as total FROM photos WHERE block_id='$blocks[id]'";
									$count = mysql_fetch_assoc(doquery($count_photos));
									$count = $count["total"];
								$js = "";
	$pages = "";
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
                                                 if ($p!="1")
																	{
											$link = "$clear_uri"."page/$p?gal=$blocks[id]";
																	}
																	else
																	{
                                                                    $link = "$clear_uri";																		}
											}
									$pages .="<a href='$link'>$p</a> ";
									}
									if ($total_pages>=40 and $p==ceil($total_pages/2))
										{
										$pages .= "<br />";
										}
							}
								/// ПОЛУЧАЕМ ФОТКИ
						 $q = "SELECT * FROM photos WHERE block_id='$blocks[id]' ORDER BY position  LIMIT $start, $num_on_page";

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

									$params = getimagesize("photogallery/thumbs/$photos[photo].jpg");
									$params_full = getimagesize("photogallery/photos/$photos[photo].jpg");

												$i++;
												$js .= "photos[$blocks[id]][$ph_num] = 'photogallery/photos/$photos[photo].jpg';";
													echo "<td valign='top'><div class='photo'><img width='$params[0]' height='$params[1]' src='photogallery/thumbs/$photos[photo].jpg' onclick=\"show_photo($blocks[id],'$ph_num');\" border='0'/></div><div class='description'>$photos[description]</div></td>";
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
														$params = getimagesize("photogallery/thumbs/$photos[photo].jpg");
									$params_full = getimagesize("photogallery/photos/$photos[photo].jpg");


												echo "<td valign='top'><div><div class='photo' style='float:left;'><img width='$params[0]' height='$params[1]' src='photogallery/thumbs/$photos[photo].jpg' onclick=\"show_photo($blocks[id],'$ph_num');\" border='0'/></div> $photos[description]</div></td>";
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
															$params = getimagesize("photogallery/thumbs/$photos[photo].jpg");
									$params_full = getimagesize("photogallery/photos/$photos[photo].jpg");
									$js .= "photos[$blocks[id]][$ph_num] = 'photogallery/photos/$photos[photo].jpg';";


													echo "<td valign='top'><div><div class='photo' style='float:right;'><img width='$params[0]' height='$params[1]' src='photogallery/thumbs/$photos[photo].jpg' onclick=\"show_photo($blocks[id],'$ph_num');\" border='0'/></div> $photos[description]</div></td>";
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
											if ($pages!="" and $total_pages>1)
												{
												echo " <div class='pages'>Страницы: $pages</div>";
												}
							}

?>