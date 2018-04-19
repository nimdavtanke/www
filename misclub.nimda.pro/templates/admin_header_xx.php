<?
session_start();
require_once("check_login.php");
if(!isset($showhide_frame)) $showhide_frame = false;

if(!isset($body_style)) $body_style="background-color:#f9f9f9;";
if ($showhide_frame)
{
$body_style="background-color:#f9f9f9;  background-image: url(../images/webcms/body_bg.gif); background-position: top left; background-repeat: repeat-y; padding-left:7px;";
}
$webcms=get_webcms_version();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>WebCMS <? echo "$webcms[webcms]"; ?></title>
<link rel="stylesheet" type="text/css" href="admin_style.css">
<link rel="stylesheet" type="text/css" href="../style.css">
<script type="text/javascript" language="javascript" src="../js/ajax.js"></script>
<script type="text/javascript" language="javascript" src="../js/jscripts.js"></script>
<script type="text/javascript" language="javascript" src="../js/resize_block.js"></script>
<script type="text/javascript" language="javascript" src="../js/adminjs.js"></script>
<script type="text/javascript" language="javascript" src="../js/calendar.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../editor/ckeditor.js"></script>
<script type="text/javascript" language="javascript">
preloader = new Image();
preloader.src="../images/webcms/wait.gif";
check_img = new Image();
check_img.src="../images/webcms/checked.gif";
uncheck_img = new Image();
uncheck_img.src="../images/webcms/unchecked.gif";
</script>
</head>

<body style="margin:0px; padding:0px; <? echo "$body_style"; ?>" onunload="admin_unload();" onresize="if (document.getElementById('karta')) {get_id('karta').style.height = getClientHeight()-102 + 'px';}">
<div id="div_wait" align="center"><img src="../images/webcms/wait.gif" border="0" /></div>
<div id="admin_content" style="display:none;">
<?

if ($showhide_frame)
{
?>
<div class="pan_switcher"><img id="img_show_hide_frame" onclick="if(top.document.getElementById('fset').cols=='0,*') {top.document.getElementById('fset').cols='300,*'; this.src='../images/webcms/hide_panel.gif';} else {top.document.getElementById('fset').cols='0,*'; this.src='../images/webcms/show_panel.gif';}" src="../images/webcms/hide_panel.gif"/></div>
<?
}
?>