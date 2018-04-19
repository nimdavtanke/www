<?php
/*******************************************************************
* Glype is copyright and trademark 2007-2014 UpsideOut, Inc. d/b/a Glype
* and/or its licensors, successors and assigners. All rights reserved.
*
* Use of Glype is subject to the terms of the Software License Agreement.
* http://www.glype.com/license.php
********************************************************************
* This theme configuration file allows easy customization of the
* theme without editing the HTML templates.
*******************************************************************
* Theme: Simple
* Author: Glype
* Website: http://www.glype.com/
******************************************************************/

/*****************************************************************
* Themes can use "theme replacements". These are HTML tags of the format
* <!--[tag_name]--> in the template files. To automatically replace
* these placeholders with other text, use the $themeReplace array.
*  e.g.
* <!--[tag_name]--> will be replaced with the value of $themeReplace['tag_name']
******************************************************************/

// Website name
$themeReplace['site_name'] = $_SERVER['HTTP_HOST'].' Glype&reg; proxy';

// Meta description
$themeReplace['meta_description'] = <<<OUT

OUT;

// Meta keywords (separate with comma)
$themeReplace['meta_keywords'] = <<<OUT

OUT;

// Proxy description text
$themeReplace['description'] = <<<OUT
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5538463974358536";
/* zayden-time_main_Blog1_300x250_as */
google_ad_slot = "8977781610";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5538463974358536";
/* zayden-time_main_Blog1_300x250_as */
google_ad_slot = "8977781610";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
OUT;

// Ad location above the form on the index page
$themeReplace['index_above_form'] = <<<OUT

OUT;

// Ad location below the form on the index page
$themeReplace['index_below_form'] = <<<OUT

OUT;

// Ad location on proxied pages below the url mini-form
$themeReplace['proxied'] = <<<OUT

OUT;
