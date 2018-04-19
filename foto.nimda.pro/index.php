<?php

// Hiding notices:
error_reporting(E_ALL^E_NOTICE);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>NIMDA Group Ltd. — российская ИТ-компания, владеющая одноимённой системой в Сети и интернет-порталом.</title>
<meta http-equiv=Content-Type content="text/html;charset=UTF-8">
<link id="page_favicon" href="/favicon.ico" rel="icon" type="image/x-icon" />
<meta property="og:title" content="NIMDA Group Ltd. — российская ИТ-компания, владеющая одноимённой системой в Сети и интернет-порталом.">
<meta property="og:type" content="website">
<meta property="og:site_name" content="NIMDA Group Ltd.">
<meta property="og:locale" content="ru_RU">
<meta property="og:description" content="NIMDA Group Ltd. — российская ИТ-компания, владеющая одноимённой системой в Сети и интернет-порталом.">

<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-darkness/jquery-ui.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.2.6.css" />


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript" src="script.js"></script>

</head>

<body>

<div id="main">
	<p id="orig">&nbsp;</p>
	<h1>FOTO</h1>
        <h2>You can drag and move </h2>

	<hr />

	<div id="gallery">
    
<?php

/* Configuration Start */

$thumb_directory = 'img/thumbs';
$orig_directory = 'img/original';

$stage_width=1600;	// How big is the area the images are scattered on
$stage_height=1000;

/* Configuration end */

$allowed_types=array('jpg','jpeg','gif','png');
$file_parts=array();
$ext='';
$title='';
$i=0;

/* Opening the thumbnail directory and looping through all the thumbs: */

$dir_handle = @opendir($thumb_directory) or die("There is an error with your image directory!");

$i=1;
while ($file = readdir($dir_handle)) 
{
	/* Skipping the system files: */
	if($file=='.' || $file == '..') continue;
	
	$file_parts = explode('.',$file);
	$ext = strtolower(array_pop($file_parts));

	/* Using the file name (withouth the extension) as a image title: */
	$title = implode('.',$file_parts);
	$title = htmlspecialchars($title);

	/* If the file extension is allowed: */	
	if(in_array($ext,$allowed_types))
	{
		/* Generating random values for the position and rotation: */
		$left=rand(0,$stage_width);
		$top=rand(0,400);
		$rot = rand(-40,40);
		
		if($top>$stage_height-130 && $left > $stage_width-230)
		{
			/* Prevent the images from hiding the drop box */
			$top-=120+130;
			$left-=230;
		}
		
		/* Outputting each image: */
		
		echo '
		<div id="pic-'.($i++).'" class="pic" style="top:'.$top.'px;left:'.$left.'px;background:url('.$thumb_directory.'/'.$file.') no-repeat 50% 50%; -moz-transform:rotate('.$rot.'deg); -webkit-transform:rotate('.$rot.'deg);">
		<a class="fancybox" rel="fncbx" href="'.$orig_directory.'/'.$file.'" target="_blank">'.$title.'</a>
		</div>';
	}
}

/* Closing the directory */
closedir($dir_handle);

?>
    <div class="drop-box">
    </div>
    
	</div>
    
	<div class="clear"></div>
    
  	<div class="container tutorial-info"></div>
</div>

<!-- This is later converted to the modal window with the url of the image: -->

<div id="modal" title="Share this picture">
	<form action="">
	<fieldset>
		<label for="url">URL of the image</label>
		<input type="text" name="url" id="url" class="text ui-widget-content ui-corner-all" onfocus="this.select()" />
	</fieldset>
	</form>

</div>

<div class="text-center">
<p>&copy 2016 <a href="https://nimda.pro">NIMDA Group Ltd.</a></p>
</div>
<!-- Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-55487430-8', 'auto');
    ga('send', 'pageview');

</script>
<script>window.home = window.home || {};
window.home['export'] = {};</script>

<!--noindex-->
<div style="display:none" class="page-info">{"static":"2.716"}</div>
<!--/noindex-->

<script src="https://mc.yandex.ru/metrika/watch.js" type="text/javascript"></script>
<script type="text/javascript">(function (w) {
    try {
    w['yaCounter36240815'] = new Ya.Metrika({"id": 36240815, "trackLinks": true});
    if (!w['defaultMetrikaCounter']) {
    w['defaultMetrikaCounter'] = w['yaCounter36240815']
    }
    } catch (e) {
    }
    })(window)</script>

<noscript>
<div><img src="https://mc.yandex.ru/watch/36240815" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- End -->
</body>
</html>
