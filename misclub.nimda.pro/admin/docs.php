<?
header('Content-type: text/html; charset=windows-1251');
require("../functions/main.func.php");
require("../functions/admin.func.php");
$showhide_frame = true;
require("../templates/admin_header.php");
?>
<?
$q = "SELECT * FROM webcms_info";
	$do = doquery($q);
		while ($res = mysql_fetch_assoc($do))
			{
				$info["$res[code]"]["name"] = $res['name'];
				$info["$res[code]"]["version"] = $res['version'];
			}
			function get_last_mod( $uri )
{
    // default
    $unixtime = 0;
    
    $fp = fopen( $uri, "r" );
    if( !$fp ) {return;}
    
    $MetaData = stream_get_meta_data( $fp );
        
    foreach( $MetaData['wrapper_data'] as $response )
    {
        // case: redirection
        if( substr( strtolower($response), 0, 10 ) == 'location: ' )
        {
            $newUri = substr( $response, 10 );
            fclose( $fp );
            return GetRemoteLastModified( $newUri );
        }
        // case: last-modified
        elseif( substr( strtolower($response), 0, 15 ) == 'last-modified: ' )
        {
            $unixtime = strtotime( substr($response, 15) );
            break;
        }
    }
    fclose( $fp );
    return $unixtime;
}
?>
<div style="padding-left:7px;">
<br />
<strong>Документация по использованию системы управления сайтом Web<span style="color:#0ac32a;">CMS</span> 2</strong><br><br />
<strong><a href="http://7335.aqq.ru/sys/webCMS.docx" target="_blank">Скачать документацию в формате *.docx</a></strong><br />
<span style="font-size:11px;">
Последнее изменение файла:  
<?

echo date("d.m.Y H:i",get_last_mod("http://7335.aqq.ru/sys/webCMS.docx"));
?></span><br /><br />
<strong><a href="http://7335.aqq.ru/sys/webCMS.zip" target="_blank">Скачать документацию в формате *.zip</strong></a><br />
<span style="font-size:11px;">
Последнее изменение файла:  
<?

echo date("d.m.Y H:i",get_last_mod("http://7335.aqq.ru/sys/webCMS.zip"));
?></span>
</div>
<?
require("../templates/admin_footer.php");
?>