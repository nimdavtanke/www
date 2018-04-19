<?
error_reporting (E_ALL);
if ($blocks['block_type']=="0")
				{
 echo "<div id='block_$blocks[id]' class='quick_edit_block'  onmouseover=\"if (edit_block_id=='all') { move_to='block_$blocks[id]';}\" >
 <input type=\"hidden\" id='pos_block_$blocks[id]' value='$blocks[position]' name='block_pos[$blocks[id]]'>
";


                    if (isset($_GET['adm']) and $_GET['adm']=="save_tb")
                    	{
                         $q = "UPDATE page_blocks SET content='$_POST[edit_block]' WHERE id='$_GET[block_id]'";
							if (doquery($q))
							{
							update_date_edit($m_id);
       echo "<script language='javascript'>location.href='$clear_uri';</script>";
							 }                    		}

     			if (isset($_GET['adm']) and $_GET['adm']=="edit_tb" and isset($_GET['b']) and $_GET['b']==$blocks['id'])
     				{
     				echo "<form name='edit_block_$blocks[id]' action='$clear_uri?adm=save_tb&block_id=$_GET[b]' method='post' style='margin:0px; padding:2px; '>";
         					// Редактирование блока
         					 $textarea = array();
         					  $textarea_values = array();                              $textarea_title = array();

         					  $textarea[] = "edit_block";
$textarea_values[] = "$blocks[content]";
$textarea_title[] = "Текст страницы";
show_editor($textarea, $textarea_values, $textarea_title);

echo "</form><a name='block_$blocks[id]'>";     					}
     					else
     					{
     					echo "<div style='float:right; padding-right:5px; padding-top:5px;'><a href='$clear_uri?adm=edit_tb&b=$blocks[id]#block_$blocks[id]'><img title='Редактировать текстовый блок' src='images/webcms/ico_edit.gif' border='0' align='absmiddle'></a> <a href='$clear_uri?quick_edit=delete_block&block_id=$blocks[id]'  onclick=\"if(confirm('Блок и его содержимое будут полностью удалены!\\r\\n \\r\\nВы уверены?')){return true;} else {return false;}\"><img src='images/webcms/ico_block_del.gif' align='absmiddle' border='0' /></a> ";
     					echo "<img title='Переместить блок' src='images/webcms/topdown_sm.gif'  onmousedown=\"startMoveBlock('block_$blocks[id]','all'); return false;\" border='0' style='cursor:pointer;' align='absmiddle'></div>";
                        echo  "$blocks[content]";
                        	echo "<div style='float:right; padding-right:5px; padding-top:5px;'><a href='$clear_uri?adm=edit_tb&b=$blocks[id]#block_$blocks[id]'><img title='Редактировать текстовый блок' src='images/webcms/ico_edit.gif' border='0' align='absmiddle'></a> <a href='$clear_uri?quick_edit=delete_block&block_id=$blocks[id]'  onclick=\"if(confirm('Блок и его содержимое будут полностью удалены!\\r\\n \\r\\nВы уверены?')){return true;} else {return false;}\"><img src='images/webcms/ico_block_del.gif' align='absmiddle' border='0' /></a> ";
     					echo "<img title='Переместить блок' src='images/webcms/topdown_sm.gif'  onmousedown=\"startMoveBlock('block_$blocks[id]','all'); return false;\" border='0' style='cursor:pointer;' align='absmiddle'></div><div style='clear:both;'></div>";     						}                    echo "</div>";
				}
?>