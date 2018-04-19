<?
	if ($blocks['block_type']=="0") 
				{
				echo  "<div style='float:right;'><a href='pages.php?action=edit_block&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_edit.gif' align='absmiddle' border='0'  title='Изменить текст'></a> $block_menu</div>";
					if (trim(strip_tags($blocks['content'],"<img>"))=="") $blocks['content'] = "<br /><i style='color:#8791a4;'>Пустой текстовый блок</i><br /><br />";	
					echo  "$blocks[content]";	
					echo  "<div style='float:right;'><a href='pages.php?action=edit_block&block_id=$blocks[id]&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_edit.gif' align='absmiddle' border='0'  title='Изменить текст'></a> $block_menu</div>";
				}
?>