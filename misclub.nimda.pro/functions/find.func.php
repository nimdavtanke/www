<?
$perfective_gerund_1[] = "��";
$perfective_gerund_1[] = "��";
$perfective_gerund_1[] = "����";
$perfective_gerund_1[] = "����";
$perfective_gerund_1[] = "������";
$perfective_gerund_1[] = "������";

$perfective_gerund_2[] = "��";
$perfective_gerund_2[] = "����";
$perfective_gerund_2[] = "������";
$perfective_gerund_2[] = "��";
$perfective_gerund_2[] = "����";
$perfective_gerund_2[] = "������";

$reflexive[] = "��";
$reflexive[] = "��";

$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "���";
$adjective[] = "���";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "���";
$adjective[] = "���";
$adjective[] = "���";
$adjective[] = "���";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";
$adjective[] = "��";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "����";
$verb_1[] = "����";

$verb_1[] = "����";
$verb_1[] = "����";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "��";
$verb_1[] = "��";

$verb_1[] = "��";
$verb_1[] = "��";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "��";
$verb_1[] = "��";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "���";
$verb_1[] = "���";

$verb_1[] = "����";
$verb_1[] = "����";

$verb_1[] = "����";
$verb_1[] = "����";


$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "����";
$verb_2[] = "����";
$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "��";
$verb_2[] = "��";
$verb_2[] = "��";
$verb_2[] = "��";
$verb_2[] = "��";
$verb_2[] = "��";
$verb_2[] = "��";
$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "��";
$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "��";
$verb_2[] = "��";
$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "���";
$verb_2[] = "��";
$verb_2[] = "�";

$noun[] = "�";
$noun[] = "��";
$noun[] = "��";
$noun[] = "��";
$noun[] = "��";
$noun[] = "�";
$noun[] = "����";
$noun[] = "���";
$noun[] = "���";
$noun[] = "��";
$noun[] = "��";
$noun[] = "�";
$noun[] = "��";
$noun[] = "��";
$noun[] = "��";
$noun[] = "��";
$noun[] = "�";
$noun[] = "���";
$noun[] = "��";
$noun[] = "���";
$noun[] = "��";
$noun[] = "��";
$noun[] = "��";
$noun[] = "�";
$noun[] = "�";
$noun[] = "��";
$noun[] = "���";
$noun[] = "��";
$noun[] = "�";
$noun[] = "�";
$noun[] = "��";
$noun[] = "��";
$noun[] = "�";
$noun[] = "��";
$noun[] = "��";
$noun[] = "�";


function cut_while($word,$arr)
{
global $perfective_gerund_1, $perfective_gerund_2, $adjective, $verb_1,$verb_2, $noun;
$array = $$arr;
	for ($i=0;$i<count($array);$i++)
			{
			if (substr($word,strlen($word)-strlen($array[$i]), strlen($array[$i]))==$array[$i])
				{
				
					if ($arr=="verb_1" or $arr=="perfective_gerund_1")
					{
				return substr($word,0, strlen($word)-strlen($array[$i])+1);
					}
					else
					{
					return substr($word,0, strlen($word)-strlen($array[$i]));
					}
				}
			}
}

function cut_end($word)
{
global $reflexive;

$r1 = "";
for ($i=0;$i<strlen($word)-1;$i++)
{
if ($word[$i]=="�" or $word[$i]=="�" or $word[$i]=="�" or $word[$i]=="�" or $word[$i]=="�" or $word[$i]=="�" or $word[$i]=="�" or $word[$i]=="�" or $word[$i]=="�" or $word[$i]=="�")
	{	
		if ($word[$i+1]!="�" or $word[$i+1]!="�" or $word[$i+1]!="�" or $word[$i+1]!="�" or $word[$i+1]!="�" or $word[$i+1]!="�" or $word[$i+1]!="�" or $word[$i+1]!="�" or $word[$i+1]!="�" or $word[$i+1]!="�")
	{
		if ($r1=="")
		{
		$r1 = substr($word,$i+2,strlen($word));
		}
	}
	}
}
$r2="";
if ($r1!="")
{
for ($i=0;$i<strlen($r1)-1;$i++)
{
if ($r1[$i]=="�" or $r1[$i]=="�" or $r1[$i]=="�" or $r1[$i]=="�" or $r1[$i]=="�" or $r1[$i]=="�" or $r1[$i]=="�" or $r1[$i]=="�" or $r1[$i]=="�" or $r1[$i]=="�")
	{	
		if ($r1[$i+1]!="�" or $r1[$i+1]!="�" or $r1[$i+1]!="�" or $r1[$i+1]!="�" or $r1[$i+1]!="�" or $r1[$i+1]!="�" or $r1[$i+1]!="�" or $r1[$i+1]!="�" or $r1[$i+1]!="�" or $r1[$i+1]!="�")
	{
		if ($r2=="")
		{
		$r2 = substr($r1,$i+2,strlen($r1));
		}
	}
	}
}
}
$find = cut_while($word,"perfective_gerund_1");
	if ($find)
	{
	$word = $find;
	}
	else
	{
		$find = cut_while($word,"perfective_gerund_2");
		if ($find)
		{
			$word = $find;
		}
		else
		{	
			for ($i=0;$i<count($reflexive);$i++)
			{
			if (substr($word,strlen($word)-strlen($reflexive[$i]), strlen($reflexive[$i]))==$reflexive[$i])
				{
				$word = substr($word,0, strlen($word)-strlen($reflexive[$i]));
				}
			}
				$find = cut_while($word,"adjective");
				if ($find)
				{
				$word = $find;
				}	
				else
				{

				$find = cut_while($word,"verb_1");
				if ($find)
				{
				$word = $find;
				}
				else
				{
				$find = cut_while($word,"verb_2");
				if ($find)
				{
				$word = $find;
				}	
				else
				{

				$find = cut_while($word,"noun");
				if ($find)
				{
				$word = $find;
				}	
				}
				}
				}
				}
				}
			
if ($word[strlen($word)-1]=="�")
{
$word = substr($word, 0,strlen($word)-1);
}

if ($r2=="���")
{
$word = str_replace("���","",$word);
}
if ($r2=="����")
{
$word = str_replace("����","",$word);
}

$check = false;
$len = strlen($word);
if ($word[$len-1]=="�" and $word[$len-2]=="�")
{
$word = substr($word, 0,strlen($word)-2);
$check = true;
}
		if (!$check)
			{
			$check_2 = false;
			if (substr($word, strlen($word)-3,strlen($word))=="���")
			{
			$word = substr($word, 0,strlen($word)-3);
			$check_2 = true;
			}
			if (substr($word, strlen($word)-4,strlen($word))=="����")
			{
			$word = substr($word, 0,strlen($word)-4);
			$check_2 = true;
			}
			if ($check_2)
			{
			$len = strlen($word);
			if ($word[$len-1]=="�" and $word[$len-2]=="�")
			{
			$word = substr($word, 0,strlen($word)-2);
			}
			}
			}
		if (!$check and ! $check_2)
			{
				if ($word[$len-1]=="�")
				{
					$word = substr($word, 0,strlen($word)-1);
				}
			}

return($word);
}

if(!function_exists('str_ireplace')){
  function str_ireplace($search,$replace,$subject){
    $token = chr(1);
    $haystack = strtolower($subject);
    $needle = strtolower($search);
    while (($pos=strpos($haystack,$needle))!==FALSE){
      $subject = substr_replace($subject,$token,$pos,strlen($search));
      $haystack = substr_replace($haystack,$token,$pos,strlen($search));
    }
    $subject = str_replace($token,$replace,$subject);
    return $subject;
  }
}

if(!function_exists('stripos'))
{

function stripos($haystack, $needle){
    return strpos($haystack, stristr( $haystack, $needle ));
}
}

function pages($page,$total)
{
global $m, $action;
$prev = $page-1;
$next = $page+1;
$pt = $total-1;
$ppt = $total-2;
$allpages ="";
for ($i=1; $i<=$total; $i++)
{
if ($i != $page and $i != $page-1 and $i != $page+1 and $i != $total and $i != $pt and $i != 1 and $i != 2)
{
$allpages[$i] = "";
}
else
{
$allpages[$i] = "<a href='?m=$m&p=$i&action=$action'>$i</a> ";
}
}
if ($page>=5)
{
$allpages[$page-2] = " ... ";
}
if ($page<=$total-4)
{
$allpages[$page+2] = " ... ";
}
$allpages[$page] = "<font color='red'>$page</font> ";
$show_pages = "";
for ($i=1; $i<=$total; $i++)
{
$show_pages .= "$allpages[$i]";
}
return $show_pages;
}
?>
