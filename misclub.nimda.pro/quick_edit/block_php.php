<?

/// ������������ �����
					if ($blocks['block_type']=="3")
					{
						echo "<div id='block_$blocks[id]' class='quick_edit_block'  onmouseover=\"if (edit_block_id=='all') { move_to='block_$blocks[id]';}\">
					<input type=\"hidden\" id='pos_block_$blocks[id]' value='$blocks[position]' name='block_pos[$blocks[id]]'>";

					echo "<div style='float:right; padding-right:5px; padding-top:5px;'>";
     					echo "<a href='$clear_uri?quick_edit=delete_block&block_id=$blocks[id]'  onclick=\"if(confirm('���� � ��� ���������� ����� ��������� �������!\\r\\n \\r\\n�� �������?')){return true;} else {return false;}\"><img src='images/webcms/ico_block_del.gif' align='absmiddle' border='0' /></a> <img title='����������� ����' src='images/webcms/topdown_sm.gif'  onmousedown=\"startMoveBlock('block_$blocks[id]','all'); return false;\" border='0' style='cursor:pointer;' align='absmiddle'></div>";

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

										echo "<div style='float:right; padding-right:5px; padding-bottom:5px;'>";
     					echo "<a href='$clear_uri?quick_edit=delete_block&block_id=$blocks[id]'  onclick=\"if(confirm('���� � ��� ���������� ����� ��������� �������!\\r\\n \\r\\n�� �������?')){return true;} else {return false;}\"><img src='images/webcms/ico_block_del.gif' align='absmiddle' border='0' /></a> <img title='����������� ����' src='images/webcms/topdown_sm.gif'  onmousedown=\"startMoveBlock('block_$blocks[id]','all'); return false;\" border='0' style='cursor:pointer;' align='absmiddle'></div><div style='clear:both;'></div>";
											echo "</div></div>";
					}
?>