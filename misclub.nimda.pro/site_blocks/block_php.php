<?

/// ������������ �����
					if ($blocks['block_type']=="3") 
					{
						echo "<div style='clear:both;'>";
									if ($blocks['content']!="")
										{
							
													if (is_file("php_blocks/$blocks[content]"))
														{
												require("php_blocks/$blocks[content]");
														}
														else
														{
														echo  "<span style='color:#ff0000; font-weight:bold;'>���� $blocks[content] �� ������!</span>";
														}
												
										}	
												
											echo "</div>";
					}
?>