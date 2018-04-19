<?

/// Динамические блоки
					if ($blocks['block_type']=="3") 
					{
						echo  "<div style='float:right;'>$block_menu</div>";
						echo "<div style='clear:both;'>";
									if ($blocks['content']!="")
										{
											if (is_file("php_blocks/$blocks[content]"))
												{
												require("php_blocks/$blocks[content]");
												}
												else
												{
													if (is_file("../php_blocks/$blocks[content]"))
														{
												require("../php_blocks/$blocks[content]");
														}
														else
														{
														echo  "<span style='color:#ff0000; font-weight:bold;'>Файл $blocks[content] не найден!</span>";
														}
												}
										}	
												
											echo "</div>";
						echo  "<div style='float:right;'>$block_menu</div>";
					}
?>