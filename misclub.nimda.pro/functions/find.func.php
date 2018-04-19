<?
$perfective_gerund_1[] = "ав";
$perfective_gerund_1[] = "€в";
$perfective_gerund_1[] = "авши";
$perfective_gerund_1[] = "€вши";
$perfective_gerund_1[] = "авшись";
$perfective_gerund_1[] = "€вшись";

$perfective_gerund_2[] = "ив";
$perfective_gerund_2[] = "ивши";
$perfective_gerund_2[] = "ившись";
$perfective_gerund_2[] = "ыв";
$perfective_gerund_2[] = "ывши";
$perfective_gerund_2[] = "ывшись";

$reflexive[] = "с€";
$reflexive[] = "сь";

$adjective[] = "ее";
$adjective[] = "ие";
$adjective[] = "ые";
$adjective[] = "ое";
$adjective[] = "ыми";
$adjective[] = "ими";
$adjective[] = "ей";
$adjective[] = "ий";
$adjective[] = "ый";
$adjective[] = "ой";
$adjective[] = "ем";
$adjective[] = "им";
$adjective[] = "ым";
$adjective[] = "ом";
$adjective[] = "его";
$adjective[] = "ого";
$adjective[] = "ему";
$adjective[] = "ому";
$adjective[] = "их";
$adjective[] = "ых";
$adjective[] = "ую";
$adjective[] = "юю";
$adjective[] = "а€";
$adjective[] = "€€";
$adjective[] = "ою";
$adjective[] = "ею";

$verb_1[] = "ала";
$verb_1[] = "€ла";

$verb_1[] = "ана";
$verb_1[] = "€на";

$verb_1[] = "аете";
$verb_1[] = "€ете";

$verb_1[] = "айте";
$verb_1[] = "€йте";

$verb_1[] = "али";
$verb_1[] = "€ли";

$verb_1[] = "ай";
$verb_1[] = "€й";

$verb_1[] = "ал";
$verb_1[] = "€л";

$verb_1[] = "аем";
$verb_1[] = "€ем";

$verb_1[] = "ан";
$verb_1[] = "€н";

$verb_1[] = "ало";
$verb_1[] = "€ло";

$verb_1[] = "ано";
$verb_1[] = "€но";

$verb_1[] = "ает";
$verb_1[] = "€ет";

$verb_1[] = "ают";
$verb_1[] = "€ют";

$verb_1[] = "аны";
$verb_1[] = "€ны";

$verb_1[] = "ать";
$verb_1[] = "€ть";

$verb_1[] = "аешь";
$verb_1[] = "€ешь";

$verb_1[] = "анно";
$verb_1[] = "€нно";


$verb_2[] = "ила";
$verb_2[] = "ыла";
$verb_2[] = "ена";
$verb_2[] = "ейте";
$verb_2[] = "уйте";
$verb_2[] = "ите";
$verb_2[] = "или";
$verb_2[] = "ыли";
$verb_2[] = "ей";
$verb_2[] = "уй";
$verb_2[] = "ил";
$verb_2[] = "ыл";
$verb_2[] = "им";
$verb_2[] = "ым";
$verb_2[] = "ен";
$verb_2[] = "ило";
$verb_2[] = "ыло";
$verb_2[] = "ено";
$verb_2[] = "€т";
$verb_2[] = "ует";
$verb_2[] = "уют";
$verb_2[] = "ит";
$verb_2[] = "ыт";
$verb_2[] = "ены";
$verb_2[] = "ить";
$verb_2[] = "ыть";
$verb_2[] = "ишь";
$verb_2[] = "ую";
$verb_2[] = "ю";

$noun[] = "а";
$noun[] = "ев";
$noun[] = "ов";
$noun[] = "ие";
$noun[] = "ье";
$noun[] = "е";
$noun[] = "и€ми";
$noun[] = "€ми";
$noun[] = "ами";
$noun[] = "еи";
$noun[] = "ии";
$noun[] = "и";
$noun[] = "ей";
$noun[] = "Єй";
$noun[] = "ой";
$noun[] = "ий";
$noun[] = "й";
$noun[] = "и€м";
$noun[] = "€м";
$noun[] = "ием";
$noun[] = "ем";
$noun[] = "ам";
$noun[] = "ом";
$noun[] = "о";
$noun[] = "у";
$noun[] = "ах";
$noun[] = "и€х";
$noun[] = "€х";
$noun[] = "ы";
$noun[] = "ь";
$noun[] = "ию";
$noun[] = "ью";
$noun[] = "ю";
$noun[] = "и€";
$noun[] = "ь€";
$noun[] = "€";


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
if ($word[$i]=="у" or $word[$i]=="е" or $word[$i]=="Є" or $word[$i]=="ы" or $word[$i]=="а" or $word[$i]=="о" or $word[$i]=="э" or $word[$i]=="€" or $word[$i]=="и" or $word[$i]=="ю")
	{	
		if ($word[$i+1]!="у" or $word[$i+1]!="е" or $word[$i+1]!="Є" or $word[$i+1]!="ы" or $word[$i+1]!="а" or $word[$i+1]!="о" or $word[$i+1]!="э" or $word[$i+1]!="€" or $word[$i+1]!="и" or $word[$i+1]!="ю")
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
if ($r1[$i]=="у" or $r1[$i]=="е" or $r1[$i]=="Є" or $r1[$i]=="ы" or $r1[$i]=="а" or $r1[$i]=="о" or $r1[$i]=="э" or $r1[$i]=="€" or $r1[$i]=="и" or $r1[$i]=="ю")
	{	
		if ($r1[$i+1]!="у" or $r1[$i+1]!="е" or $r1[$i+1]!="Є" or $r1[$i+1]!="ы" or $r1[$i+1]!="а" or $r1[$i+1]!="о" or $r1[$i+1]!="э" or $r1[$i+1]!="€" or $r1[$i+1]!="и" or $r1[$i+1]!="ю")
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
			
if ($word[strlen($word)-1]=="и")
{
$word = substr($word, 0,strlen($word)-1);
}

if ($r2=="ост")
{
$word = str_replace("ост","",$word);
}
if ($r2=="ость")
{
$word = str_replace("ость","",$word);
}

$check = false;
$len = strlen($word);
if ($word[$len-1]=="н" and $word[$len-2]=="н")
{
$word = substr($word, 0,strlen($word)-2);
$check = true;
}
		if (!$check)
			{
			$check_2 = false;
			if (substr($word, strlen($word)-3,strlen($word))=="ейш")
			{
			$word = substr($word, 0,strlen($word)-3);
			$check_2 = true;
			}
			if (substr($word, strlen($word)-4,strlen($word))=="ейше")
			{
			$word = substr($word, 0,strlen($word)-4);
			$check_2 = true;
			}
			if ($check_2)
			{
			$len = strlen($word);
			if ($word[$len-1]=="н" and $word[$len-2]=="н")
			{
			$word = substr($word, 0,strlen($word)-2);
			}
			}
			}
		if (!$check and ! $check_2)
			{
				if ($word[$len-1]=="ь")
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
