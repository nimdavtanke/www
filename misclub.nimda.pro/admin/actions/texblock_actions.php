<?
/// СОХРАНЕНИЕ текста блока
if ($action=="save_block")
	{
	$q = "UPDATE page_blocks SET content='$_POST[content]' WHERE id='$_GET[block_id]'";
		doquery($q);
		update_date_edit($cat_id);
	}

if ($action=="edit_block")
{
$q = "SELECT content FROM page_blocks WHERE id='$_GET[block_id]'";
	$edit_block = mysql_fetch_assoc(doquery($q));
echo "<table border='0' cellpadding='0' cellspacing='0' style='margin-top:7px; border:1px solid #8791a4; background-color:#ffffff;' width='100%'>
<tr>
<td><div style='padding:3px 7px 3px 7px;'><strong style='margin-left:10px;'>$name / Текстовый блок</strong><br />";

//// редактор
				echo  "<form name='edit_block' action='pages.php?action=save_block&block_id=$_GET[block_id]&menu_id=$menu_id&cat_id=$cat_id' method='post' target='main' style='margin:0px; padding:2px; '>
				";
				/*
				include("../editor/spaw.inc.php");
$spaw1 = new SpawEditor("content","$edit_block[content]");
$spaw1->show();*/
$textarea[] = "content";
$textarea_values[] = "$edit_block[content]";
$textarea_title[] = "Текст страницы";
show_editor($textarea, $textarea_values, $textarea_title);
echo  "<div style='text-align:right; padding-top:5px;'><input type='submit' class='admin_input' value='Сохранить'></div></form></td></tr></table>";
die();
}


?>