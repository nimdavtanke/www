<?
echo "<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='cursor:pointer; border:1px solid #8791a4;' nowrap='nowrap'>
<div style='padding:4px; height:15px; overflow-y:hidden;' onclick=\"if (get_id('div_photogal_menu').style.display!=''){get_id('div_photogal_menu').style.display='';} else {get_id('div_photogal_menu').style.display='none';}\"  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\"><img src='images/webcms/ico_add_photogal.gif' border='0' align='absmiddle'> Добавить фотогалерею</div>

<div style='position:absolute; border:1px solid #8791a4; background-color:#ffffff; display:none; width:180px;' id='div_photogal_menu'>
<div style='border-bottom:1px solid #8791a4; padding:4px; height:15px; overflow-y:hidden;' onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='$clear_uri?quick_edit=add_block&block_type=1&block_sub_type=0&cat_id=$m_id'><img src='images/webcms/ico_add_photogal_0.gif' border='0' align='absmiddle'> Описание под фото</a>
</div>
<div style='border-bottom:1px solid #8791a4; padding:4px; height:15px; overflow-y:hidden;' onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='$clear_uri?quick_edit=add_block&block_type=1&block_sub_type=1&cat_id=$m_id'><img src='images/webcms/ico_add_photogal_1.gif' border='0' align='absmiddle'> Описание справа от фото</a>
</div>
<div style=' padding:4px;  height:15px; overflow-y:hidden;' onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<a href='$clear_uri?quick_edit=add_block&block_type=2&block_sub_type=0&cat_id=$m_id'><img src='images/webcms/ico_add_photogal_2.gif' border='0' align='absmiddle'> Описание слева от фото</a>
</div>
</div>
</td>
</tr>
</table>";
?>