<?
function pages($pg,$total)
{
global $options, $page;
$prev = $pg-1;
$next = $pg+1;
$pt = $total-1;
$ppt = $total-2;
$allpages ="";
for ($i=1; $i<=$total; $i++)
{
if ($i != $pg and $i != $pg-1 and $i != $pg+1 and $i != $total and $i != $pt and $i != 1 and $i != 2)
{
$allpages[$i] = "";
}
else
{
														if ($options['rewrite_url']==0)
															{
														$link = "index.php$_SERVER[PATH_INFO]?p=$i";
															}
														else
															{
															$link = "$options[site_url]$page[key_name]/page/$i/";
															}
$allpages[$i] = "<a href='$link'>$i</a> ";
}
}
if ($pg>=5)
{
$allpages[$pg-2] = " ... ";
}
if ($pg<=$total-4)
{
$allpages[$pg+2] = " ... ";
}
$allpages[$pg] = "<span class='page_selected'>$pg</span> ";
$show_pages = "";
for ($i=1; $i<=$total; $i++)
{
$show_pages .= "$allpages[$i]";
}
return $show_pages;
}
if(!isset($_GET['action'])) 
{
$action="";
}
else
{
$action = $_GET['action'];
}


if ($action=="show_news")
	{
$query = "SELECT * FROM news WHERE id='$_GET[id]'";
$do = doquery($query);
		if (mysql_num_rows($do)!=1)
			{
			echo "<center style='font-size:16px;'>Новость не найдена!</center>";
			}
			else
			{
			$res = mysql_fetch_assoc($do);
			$d = explode(".",$res["date"]);
				$timestamp = mktime($d[3],$d[4],"0",$d[1],$d[0],$d[2]);
				$date = date($options["news_date_format"],$timestamp);
				$title = $res["news_title"];
				$news = $res["news"];
									$news_tmp = file_get_contents( "templates/news/news_full.html" );
					$news_tmp = str_replace("\"","\\\"",$news_tmp);
eval ("\$str = \"$news_tmp\";"); 
echo "$str";
									if ($options['rewrite_url']==0)
															{
														$link = "index.php"."$_SERVER[PATH_INFO]";
															}
														else
															{
															$link = "$options[site_url]$page[key_name]/";
															}
echo "<div align='right' class='newsblock'><a href='$link'>Читать все новости</a></div>";
			}
	}
if ($action =="")
{
if(!isset($_GET['p']) or $_GET['p']=="") $_GET['p']=1;
$date_now = date("d.m.Y.H.i");
$query = "SELECT COUNT(*) as total_news FROM news WHERE STR_TO_DATE(date,'%d.%m.%Y.%H.%i')<=STR_TO_DATE('$date_now','%d.%m.%Y.%H.%i')";

$count = doquery($query);
$total_news = mysql_fetch_assoc($count);
$total_news = $total_news["total_news"];

$total_pages = ceil($total_news/$options["news_num_on_page"]);
$start = ($_GET['p']-1)*$options["news_num_on_page"];

$query = "SELECT * FROM news WHERE STR_TO_DATE(date,'%d.%m.%Y.%H.%i')<=STR_TO_DATE('$date_now','%d.%m.%Y.%H.%i') ORDER BY STR_TO_DATE(date,'%d.%m.%Y.%H.%i') DESC LIMIT $start,$options[news_num_on_page]";
$do = doquery($query);
$list_news = "";
if (mysql_num_rows($do)!="0")
{
	while ($res = mysql_fetch_array($do))
		{
				$d = explode(".",$res["date"]);
				$timestamp = mktime($d[3],$d[4],"0",$d[1],$d[0],$d[2]);
				$date = date($options["news_date_format"],$timestamp);
				$title = $res["news_title"];
				$news = $res["news"];
				$stripped_news = strip_tags($news);
					if (trim(strip_tags($res["news_short"]))=="")
						{
				$short_news = substr($stripped_news,0,500);
					if ($short_news!=$stripped_news)
						{
							$short_news = explode(" ",$short_news);
								unset($short_news[count($short_news)-1]);
								
								$short_news[] = "...";
							$short_news = implode(" ", $short_news);
						}
						}
						else
						{
						$short_news = str_replace("</p>","<br />",$res["news_short"]);
						$short_news = str_replace("<p>","",$short_news);
							if (substr($short_news,strlen($short_news)-6,6)=="<br />")
								{
						$short_news  = substr($short_news,0,strlen($short_news)-6);
								}
								
						$short_news = $short_news;
						}
						if ($options['rewrite_url']==0)
															{
														$link = "index.php"."$_SERVER[PATH_INFO]?action=show_news&id=$res[id]";
															}
														else
															{
															$link = "$options[site_url]$page[key_name]/show_news/$res[id]/";
															}
					$news_tmp = file_get_contents( "templates/news/news.html" );
					$news_tmp = str_replace("\"","\\\"",$news_tmp);
eval ("\$str = \"$news_tmp\";"); 
	echo "$str";
		if ($total_pages>1)
			{
			$pages = pages($_GET['p'],$total_pages);
			$news_tmp = file_get_contents( "templates/news/news_pages.html" );
					$news_tmp = str_replace("\"","\\\"",$news_tmp);
eval ("\$str = \"$news_tmp\";"); 
	echo "$str";
			}
		}
}
}
?>
