<?
if (preg_match ("|(/page/)([0-9]*)|", $key_name,$matches)) 
{
$_GET['p'] = $matches[2];
$key_name = str_replace("/page/$matches[2]","",$key_name);
$clear_uri = str_replace("/page/$matches[2]","",$clear_uri);

}

?>