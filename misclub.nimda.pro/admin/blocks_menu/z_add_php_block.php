<?
echo "<table border='0' cellpadding='0' cellspacing='0' style='margin:1px; float:left; cursor:pointer;'><tr>
<td onmouseover=\"this.style.backgroundColor='#e0e0e0';\" onmouseout=\"this.style.backgroundColor='#ffffff';\" style='border:1px solid #8791a4; background-color:#ffffff;' nowrap='nowrap'> 

<div onclick=\"if (get_id('div_php').style.display!=''){get_id('div_php').style.display='';} else {get_id('div_php').style.display='none';}\" style='padding:4px; height:15px; overflow-y:hidden;'  onmousedown=\"this.style.height='14px'; this.style.paddingTop='5px'; this.style.paddingLeft='5px';\" onmouseup=\"this.style.paddingTop='4px'; this.style.paddingLeft='4px'; this.style.height='15px';\">
<img src='../images/webcms/ico_add_php.gif' border='0' align='absmiddle'> Добавить php-блок</div>

<div style='position:absolute; border:1px solid #8791a4; padding:3px; background-color:#ffffff; display:none;' id='div_php'>
<form action='pages.php?action=add_block&block_type=3&block_sub_type=0&menu_id=$menu_id&cat_id=$cat_id' method='POST' style='padding:0px; margin:0px;'>
<strong style='font-size:11px;'>PHP-файл:</strong><br />
<input type='text' class='admin_input' name='php_filename' value=''> <input type='submit' value='Добавить' class='admin_input'>
</form>
</div>
</td>
</tr>
</table>";
?>