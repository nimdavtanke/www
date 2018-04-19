<?

echo "<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='cursor:pointer; border:1px solid #8791a4;' nowrap='nowrap'>
<div onclick=\"if (get_id('div_subs').style.display!=''){get_id('div_subs').style.display='';} else {get_id('div_subs').style.display='none';}\" style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<img src='../images/webcms/ico_add_link_list.gif' border='0' align='absmiddle'> Добавить блок подразделов</div>

<div style='position:absolute; border:1px solid #8791a4; background-color:#ffffff; display:none; width:220px;' id='div_subs'>
<div style='border-bottom:1px solid #8791a4; padding:4px; height:15px; overflow-y:hidden;' onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='pages.php?action=add_block&block_type=2&block_sub_type=0&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_add_links_0.gif' border='0' align='absmiddle'> Только заголовки</a>
</div>
<div style='border-bottom:1px solid #8791a4; padding:4px; height:15px; overflow-y:hidden;' onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='pages.php?action=add_block&block_type=2&block_sub_type=1&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_add_links_1.gif' border='0' align='absmiddle'> Заголовок+описание</a>
</div>
<div style='border-bottom:1px solid #8791a4; padding:4px; height:15px; overflow-y:hidden;' onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='pages.php?action=add_block&block_type=2&block_sub_type=2&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_add_photogal_0.gif' border='0' align='absmiddle'> Заголовок+иконка</a>
</div>
<div style='border-bottom:1px solid #8791a4; padding:4px; height:15px; overflow-y:hidden;' onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='pages.php?action=add_block&block_type=2&block_sub_type=4&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_add_links_4.gif' border='0' align='absmiddle'> Только иконка</a>
</div>
<div style='border-bottom:1px solid #8791a4; padding:4px; height:15px; overflow-y:hidden;' onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='pages.php?action=add_block&block_type=2&block_sub_type=3&menu_id=$menu_id&cat_id=$cat_id'><img src='../images/webcms/ico_add_links_3.gif' border='0' align='absmiddle'> Заголовок, иконка, описание</a>
</div>
</div>

</td></tr></table>";

?>