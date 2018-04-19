<?
header('Content-type: text/html; charset=windows-1251');
require("../functions/main.func.php");
require("../functions/admin.func.php");
require("../templates/admin_header.php");
?><div style="height:65px;"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td><a href="options.php" onclick="unselect_cat();" target="main"><img src="../images/webcms/menu_settings.gif" width="91" height="62" border="0" /></a> <a href="support.php" onclick="unselect_cat();" target="main"><img src="../images/webcms/menu_support.gif" width="134" height="62" hspace="15" border="0" /></a><a href="docs.php" onclick="unselect_cat();" target="main"><img src="../images/webcms/menu_doc.gif" width="125" height="62" border="0" /></a></td>
<td  width="350" align="right" style="padding-right:15px;"><a href="backup.php" onclick="unselect_cat();" target="main"><img src="../images/webcms/menu_backup.gif" width="148" height="62" border='0'/></a><a href="about.php" onclick="unselect_cat();" target="main"><img src="../images/webcms/menu_about.gif" width="86" height="62" hspace="15" border="0" /></a><a href="admin_login.php?action=logout" onclick="unselect_cat();" target="_parent"><img src="../images/webcms/menu_exit.gif" width="56" height="62" border="0" /></a></td>
</tr></table></div><div style="width:100%; background:url(../images/webcms/top_menu_bg.gif) repeat-x top; padding-top:3px; font-size:11px; height:17px; border-top:1px solid #8791a4; border-bottom:1px solid #8791a4;" align="right"><? echo "<div style='padding-right:20px;'>Здравствуйте, <strong>$logged_user[name]</strong>! | <a href='useredit.php' onclick=\"unselect_cat();\" target='main'>Изменить данные</a></div>"; ?></div>
<?
echo "";
require("../templates/admin_footer.php");
?>