<?
function get_site_structure($menu_id, $cat_now)
{
global $options;
	$q = "SELECT * FROM menu_items WHERE menu_id='$menu_id' AND cat_id='$cat_now' ORDER BY position";
		$do = doquery($q);
			while ($menu = mysql_fetch_assoc($do))
				{
				$padding = (($menu['level']-1)*14)+2 .'px';
				$sub_link = "";
				$childs = false;
				if (check_childs($menu_id, $menu['id']))
					{
					$childs = true;
					}
if ($options['rewrite_url']==0)
{
$link ="index.php/$menu[key_name]";
}
else
{
$link ="$menu[key_name]";
}
	if ($menu['id']==$options['index_id'])
		{
		$link = $options['site_url'];
		}
				echo "- <a href='$link'>$menu[name]</a><br />";
				if ($childs)
				{
				echo "<div style='padding-left:". 10*$menu['level'] . "px;'>";
					
					get_site_structure($menu_id, "$menu[id]");
					echo "</div>";
				}
				}
}
echo get_site_structure(1,0);
echo get_site_structure(2,0);
?>
