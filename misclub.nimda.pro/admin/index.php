<?php
session_start();
require("../functions/main.func.php");
require("../functions/admin.func.php");
require("check_login.php");

$webcms=get_webcms_version();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>WebCMS  <? echo "$webcms[webcms]"; ?></title>
</head>
<frameset name="fset" id="fset" cols="300,*" border="0">
	<frame name="site_structure" src="menu_items.php" scrolling="no" frameborder="0" onresize="" style="">
	<frameset rows="90,*" border="0" frameborder="0" framespacing="0" bordercolor="#ffffff">
		<frame id="menu_frame" name="Menu" src="top_menu.php" scrolling="no" frameborder="0" noresize="noresize">
		<frame id="main_frame" name="main" src="main.php"  scrolling="Yes" style="overflow-x: hidden; scrollbar-3dlight-color:#8791a4;
	scrollbar-arrow-color:#010000;
	scrollbar-highlight-color: #f9f9f9;
	scrollbar-face-color:#f9f9f9;
	scrollbar-shadow-color:#f9f9f9;
	scrollbar-darkshadow-color:#8791a4;
	scrollbar-track-color: #e3e5ea;" frameborder="0">
	</frameset>
<frame src="UntitledFrame-1"></frameset>
<noframes>This software requires a browser with support for frames.</noframes>
</html>
