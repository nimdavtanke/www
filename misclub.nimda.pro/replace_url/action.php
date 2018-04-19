<?
if (preg_match ("|(/action/)([a-z_]*)/|", $key_name,$matches)) 
{
$_GET['action'] = $matches[2];
$key_name = str_replace("/action/$matches[2]","",$key_name);
}

?>