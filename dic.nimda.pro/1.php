<?php
error_reporting(0);
$dic_uid = "JohnLi"; // Идентификатор партнера
$dic_sid = "1344"; // Идентификатор сайта
$dic_did = "induism";
// параметры ниже можно изменять
$dic_showtitle = 1; // 1 - показывать название словаря; 0 - не показывать.
$dic_lnum = 1; // Количество показываемых символов в оглавлении
$dic_col = 2; // Количество колонок для показа списка слов.
$dic_codepage = 'UTF-8'; // Используемая на сайте кодировка (UTF-8, cp1251).

// Используемые стили. Установлены по умолчанию. Можно убрать или изменить
$dic_div_style = "width:800px; padding:5px; overflow: auto; "; // Стиль DIV-контейнера, содержащего словарь
$dic_style_title = "color: #505050; font-size:24px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;"; // стиль показа заголовка
$dic_style_words = "color: #282828; font-size:20px; font-family: ;Verdana, Arial, Helvetica, sans-serif;"; // стиль показа терминов в списке
$dic_style_letters = "color: #007cad; font-size:20px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;"; // стиль показа букв оглавления
$dic_style_thermin = "color: #212121; font-size:24px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;"; // стиль показа термина.
$dic_style_descr = "color: #1c1c1c; font-size:20px; font-family: Verdana, Arial, Helvetica, sans-serif;"; // стиль показа описания термина.

$debugMode = 0; // Включает режим вывода отладочной информации (1 - вывод есть; 0 - вывода нет)
// Используйте $debugMode = 1; если есть какие-то проблемы. Полученую отладочную информацию нужно отправить разработчикам для выяснения причин отказа.

/*************************************************************************************************/

 $useCDATA = 1;   //  ������������ CDATA ��� ������ �� ��������.
 $array4values = Array();   //  ����� ����� ����������� ������ �������� - ��������


function q_code2utf ($s, $codepage='cp1251')
{
  if ($codepage === 'utf-8') return $s;
  if (function_exists('iconv')) return iconv($codepage,'UTF-8',$s);
   else if (function_exists('mb_convert_encoding')) return mb_convert_encoding($s, "UTF-8",  $codepage);
    else return $s;
}

function q_utf2code ($s, $codepage='cp1251')
{
  if ($codepage === 'utf-8') return $s;
  if (function_exists('iconv')) return iconv('UTF-8',$codepage,$s);
   else if (function_exists('mb_convert_encoding')) return mb_convert_encoding($s, $codepage,  "UTF-8");
    else return $s;
}

function ToUpper($st)
{
  return strtr($st, "��������������������������������abcdefghigklmnopqrstuvwxyz", "��������������������������������ABCDEFGHIJKLMNOPQRSTUVWXYZ");
}
function ToLower($st)
{
  return strtr($st, "��������������������������������ABCDEFGHIJKLMNOPQRSTUVWXYZ", "��������������������������������abcdefghigklmnopqrstuvwxyz");
}


class XMLparser
{

  var $parser;          //  ���������� ������ XML
//  ��������� ����������.
  var $waiting4value;
  var $waiting4name;
  var $currentname;
  var $datacollectionmode;   //  ���� ���� ������!

  function XMLparser()
  {
    global $array4values;

    $this->parser = xml_parser_create();
    $array4values = Array();
    xml_set_object($this->parser, $this);
    xml_parser_set_option ($this->parser, XML_OPTION_CASE_FOLDING, 0);
//    xml_parser_set_option ($this->parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
    xml_parser_set_option ($this->parser, XML_OPTION_SKIP_WHITE, 1);
    xml_set_element_handler($this->parser, "startElement", "endElement");
    xml_set_character_data_handler($this->parser, "character_data");
//    register_shutdown_function(array(&$this, 'destruct'));
  }

  function printArray($msg)
  {
    global $array4values;
    foreach(@$array4values as $k=>$v) echo "<li>($msg)---> $k: $v";
  }

  function setValue($key, $val)
  {
    $array4values[$key] = $val;
  }

  function getValue($key, $val)
  {
    return $array4values[$key];
  }

  function getArray()
  {  //  ������ � ������
    global $array4values;

    $Dummy = Array();
    foreach (@$array4values as $k=>$v) $Dummy[$k] = $v;
    return $Dummy;
  }



  function destruct()
  {
    xml_parser_free($this->parser);
  }

  function parse_xml($xml, $cp1251=1)
  {
    global $array4values;

    $this->waiting4value = 0;
    $this->waiting4name = 0;
    $this->currentname = "";
    $this->datacollectionmode = 0;
    $arr4Val = Array();
    unset($array4values);
    xml_parse($this->parser, $xml);

    //return $array4values;
    $arr4Val = $this->getArray();
    return $arr4Val;
  }


  function startElement($parser, $tag, $attributes=NULL)
  {
//echo "<br>�������� ����: $tag, $attributes \n";
    $this->datacollectionmode = 0;  //  ���� ������ ���� �� �������.
    switch ($tag)
    {
      case "name":
         $this->waiting4name = 1;
         $this->waiting4value = 0;
         break;
      case "value":
         $this->waiting4value = 1;
         $this->waiting4name = 0;
         break;
      case "methodName":
         $this->waiting4name = 0;
         $this->waiting4value = 1;
         $this->currentname = "__methodName";
         break;
      case "faultString":
         $this->waiting4name = 0;
         $this->waiting4value = 1;
         $this->currentname = "__faultString";
         break;
      case "faultCode":
         $this->waiting4name = 0;
         $this->waiting4value = 1;
         $this->currentname = "__faultCode";
         break;
    }
 }

  function endElement($parser, $tag, $attributes=NULL)
  {
//echo "<br>����������. tag=$tag\n";
    //  ���� ��� ����� ����� ������, ��, �.�. ��������� ���������� ����, ���������� �������� ������
    if($this->datacollectionmode) $this->waiting4value = 0;
    $this->datacollectionmode = 0;
  }


  function character_data($parser, $data)
  {
    global $array4values;
//    global $this->array4values;

//echo "<br>character_data: '$data' ($this->datacollectionmode)\n";
    if($this->waiting4name)
    {
    	$this->currentname = $data;  //  ��������� ��� ��������
    	$this->waiting4name = 0;
//    	echo " currentname = $data ";
    }
    if($this->waiting4value)
    {
    	 $array4values[$this->currentname] .= $data;  //  ��������� ����������� �������� ��������.
      $this->datacollectionmode = 1;                              //  ������� ����� ����� ������
//      $this->waiting4value = 0;                                 // ������ ���� ���������� �������� ������ - ��� ����� ������ ������ ������!
    };

  }
}



function make_XMLRPC_request($site, $location, $methodName, $params = NULL, $user_agent = NULL)
{
  global $useCDATA;
  global $dic_codepage;

	$site = explode(':', $site);
	if(isset($site[1]) and is_numeric($site[1])) $port = $site[1];
	else $port = 80;
	$site = $site[0];

	$myData  = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<methodCall>";
/*	$myData  = "<?xml version=\"1.0\" encoding=\"windows-1251\" ?>\n<methodCall>";
*/
	$myData .= "<methodName>$methodName</methodName>\n";
	if ($params)
	{
		$myData .= "<params>\n";
		foreach ($params as $k=>$v)
		{
			$myData .= "<param>\n";
			$myData .= "<name>$k</name>\n";
			if(is_array($v)) $v = serialize($v);
			$v = q_code2utf($v, $dic_codepage);
			if($useCDATA AND !is_numeric($v)) $v = "<![CDATA[$v]]>";
  			else $v = htmlspecialchars($v, ENT_QUOTES);
			$myData .= "<value>$v</value>\n";                    //  �� ��������� �� ���� string
//			$myData .= "<value><string>$v</string></value>\n";
		  $myData .= "</param>\n";
	  }
		$myData .= "</params>\n";
	}
  $myData .= "</methodCall>";


//  ���������� ���������� � ��������.
//  ���� �� ��� ������������� ������� !!!!!!!!!!!!!!!!!!!!!!!!!
	$conn = @fsockopen($site, $port);
	if(!$conn)
	{  //  ������ ��� ����������
  	return array('faultCode'=>16, 'faultString'=>"Connection failed: Couldn't make the connection to $site.");
	  exit;
	}
	//  ��� ���������, ���������� ����.  ��������� ���������.
	if(!$user_agent) $user_agent = "RPC-XML_Academic_UA_1_7";
	$headers  = "POST $location HTTP/1.0\r\n".
	           	"Host: $site\r\n".
	           	"Connection: close\r\n".
	           	"User-Agent: $user_agent\r\n".
	           	"Content-Type: text/xml\r\n" .
	            "Content-Length: ".strlen($myData)."\r\n\r\n";

	fputs($conn, "$headers");
	fputs($conn, $myData);
		#socket_set_blocking ($conn, false);
	//  �������� ����� �� �������
	$response = "";
	while(!feof($conn))	$response .= fgets($conn, 1024);
	fclose($conn);
//  ���� ���������.  ����� ���-�� ������� magic_quotes_runtime...
        $isMagic2 = get_magic_quotes_runtime();
        if($isMagic2) $response = stripslashes($response);

// �������� ��������� ������
	$data = substr($response, strpos($response, "\r\n\r\n")+4);

//  ��������� �������������� �� UTF-8
//  $data = utf2win($data);

//  ������� �� XML ������ � ������� ���.
  $p = new XMLparser();
  $rez = $p->parse_xml($data);
//  $rez = $array4values;
  $p->destruct();

  return $rez;

}


function make_XMLRPC_response($params)
{
  global $useCDATA;
  global $dic_codepage;

	$myData  = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n<methodResponse>\n";
/*	$myData  = "<?xml version=\"1.0\" encoding=\"windows-1251\" ?>\n<methodResponse>\n";
  */
	if(isset($params['faultCode']) or isset($params['faultString']))
	{  //  ���� �������� ��������� �� ������.
		$myData .= "<fault>\n<value><struct>\n";
		$myData .= "<member>\n";
	  $myData .= "<name>faultCode</name>\n<value><int>".(int)$params['faultCode']."</int></value>\n";
		$myData .= "</member>\n";
		$myData .= "<member>\n";
	  $myData .= "<name>faultString</name>\n<value><string><![CDATA[".$params['faultString']."]]></string></value>\n";
		$myData .= "</member>\n";
    $myData .= "</struct>\n</value>\n</fault>\n";
	}
	else if ($params)
	{
		$myData .= "<params>\n";
		foreach ($params as $k=>$v)
		{
			$myData .= "<param>\n";
			$myData .= "<name>$k</name>\n";
			if(is_array($v)) $v = serialize($v);
 			$v = q_code2utf($v, $dic_codepage);
			if($useCDATA AND !is_numeric($v)) $v = "<![CDATA[$v]]>";
  			else $v = htmlspecialchars($v, ENT_QUOTES);
			$myData .= "<value>$v</value>\n";                    //  �� ��������� �� ���� string
//			$myData .= "<value><string>$v</string></value>\n";
		  $myData .= "</param>\n";
	  }
		$myData .= "</params>\n";
	}
  $myData .= "</methodResponse>";

	header("Connection: close");
	header("Content-Length: " . strlen($myData));
	header("Content-Type: text/xml");
	header("Date: " . date("r"));
  echo $myData;

//writelog("make_XMLRPC_response. �������� �����:\n$myData");

}

function sendError($ErrCode, $ErrMsg)
{  //  ��������� � �������� ��������� �� ������
  writelog("- sendError. $ErrCode ($ErrMsg)");
  $params['faultCode'] = $ErrCode;
  $params['faultString'] = $ErrMsg;
  writelog("- sendError. ����� make_XMLRPC_response");
  make_XMLRPC_response($params);
}



function dic_reverse_htmlentities($mixed)
{
  return $mixed;  //  � ��������� ����� ������ ������� �� ������������!
                  //  ��������� ��� �������� �������������.

//  global $dic_codepage;
//  if($dic_codepage === 'utf-8')return $mixed;   //  ������������ �� ����!!!!!!!!!!!1

  $htmltable = get_html_translation_table(HTML_ENTITIES);
  foreach($htmltable as $key => $value)
  {
    $mixed = ereg_replace(addslashes($value),$key,$mixed);
  }
  return $mixed;
}


//  ���� ������ ������������ �������.
 function show_dic ($did, $uid, $sid)
 {
    global $_SERVER;
    global $dic_showtitle, $dic_lnum, $dic_col;
    global $dic_div_style, $dic_style_words, $dic_style_letters, $dic_style_title;
    global $dic_style_thermin, $dic_style_descr;
    global $dic_codepage;
    global $debugMode;


    $site = "dic.academic.ru";
    $location = "/rpc/rpc_server2.php";

    if($debugMode) echo "<hr />DebugMode. Start. site='$site' location='$location' <br/>\n";


    //  �������� �� ���������.
    $_dic_showtitle = 1;
    $_dic_lnum      = 1;
    $_dic_col       = 2;
    $_dic_codepage  = 'cp1251';
    $_dic_div_style     = "width:400px; border:solid 1px gray; padding:5px; ";      //  ����� DIV-����������, ����������� �������
    $_dic_style_title   = "font-size:12px; font-weight: bold; color: #666666; font-family: Verdana, Arial, Helvetica, sans-serif;";  // ����� ������ ���������
    $_dic_style_words   = "font-size:10px; font-family: Verdana, Arial, Helvetica, sans-serif;";  // ����� ������ �������� � ������
    $_dic_style_letters = "font-size:10px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;"; // ����� ������ ���� ������������
    $_dic_style_thermin = "font-size:12px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;";  //  ����� ������ �������.
    $_dic_style_descr   = "font-size:10px; font-family: Verdana, Arial, Helvetica, sans-serif;";  //  ����� ������ �������� �������.

    if(!isset($dic_showtitle)) $dic_showtitle  = $_dic_showtitle;
    if(!isset($dic_lnum))      $dic_lnum       = $_dic_lnum;
    if(!isset($dic_col))       $dic_col        = $_dic_col;
    if(!isset($dic_codepage))  $dic_codepage   = $_dic_codepage;
    if(!$dic_div_style)     $dic_div_style     = $dic_div_style;
    if(!$dic_style_title)   $dic_style_title   = $_dic_style_title;
    if(!$dic_style_words)   $dic_style_words   = $_dic_style_words;
    if(!$dic_style_letters) $dic_style_letters = $_dic_style_letters;
    if(!$dic_style_thermin) $dic_style_thermin = $_dic_style_thermin;
    if(!$dic_style_descr)   $dic_style_descr   = $_dic_style_descr;

    $dic_codepage = ToLower($dic_codepage);

    $url = @$_SERVER['PATH_INFO'];
//  ��������� ���������
    $ltr = @$_REQUEST['dic_ltr'];
    $tid = @$_REQUEST['dic_tid'];

    //  �������� ��������� �� URL
    $ParList = Array();
    parse_str($_SERVER['QUERY_STRING'], $ParList);
    //  �������� ��� ����� ���������.
    $url .= "?";
    foreach ($ParList as $k=>$v)
    {
       if ($k == "dic_ltr") continue;  //  ���������� ����������� ���������. ������� �� �����
       if ($k == "dic_tid") continue;  //  ���������� ����������� ���������. ������� �� �����
       $url .= "$k=$v&";
    }

    //  �������� ����������� �������.
//  ���� �������� ������� ������� ����������.
    $params['did'] = $did;
    $params['uid'] = $uid;
    $params['sid'] = $sid;
    $params['tid'] = $tid;
    $params['ltr'] = $ltr;
    $params['lnum'] = $dic_lnum;

    if($debugMode)
    {
      echo "<hr />DebugMode. params2send:\n";
      foreach($params as $kk=>$vv) echo "<li>$kk : $vv</li> \n";
    }

    $response = make_XMLRPC_request($site, $location, "academic.info", $params);
 //  ������������ ��������� ���������.

    if($debugMode)
    {
      echo "<hr />DebugMode. response:<br />\n";
      print_r($response);
    }

    $faultCode   = @$response["__faultCode"];
    $faultString = @$response["__faultString"];
    $faultString = q_utf2code($faultString, $dic_codepage);

    echo "\n<DIV style=\"$dic_div_style\">\n";
    if($faultCode or $faultString)
    {       //  ������ �� ������... :-(
      echo "<p>Error: " . nl2br("($faultCode) $faultString\n");
    }
    else
    { //  ����� �������!!!
      $DicTitle = @$response['title'];
      $DicTitle = q_utf2code($DicTitle, $dic_codepage);

      if ($dic_showtitle) echo "<div style=\"$dic_style_title\">$DicTitle</div>";

      //  ��������� ���. �����
      $before = @$response['before'];
      $after  = @$response['after'];

      if($before)
      {
//        $before = dic_reverse_htmlentities($before);
        $before = q_utf2code($before, $dic_codepage);
        echo $before;
      }
      //  ������ ������� ������� ����������
      $letters = @$response['letters'];
      if($letters)
      {
        $letters = unserialize($letters);
        foreach(@$letters as $k=>$v)
        {
           $v_ = $v;   //  ��� �������� � �������� ���������
           $v = q_utf2code($v, $dic_codepage);
           $v = ToUpper($v);
           if ($v == $ltr) echo "<span style=\"$dic_style_letters\">$v</span> \n";
            else echo "<a href=\"$url"."dic_ltr=".base64_encode($v_)."\" style=\"$dic_style_letters\">$v</a> \n";
        }                           //urlencode(utf8_encode($txt{$i}));
      }

      if($after)
      {
//        $after = dic_reverse_htmlentities($after);
        $after = q_utf2code($after, $dic_codepage);
        echo $after;
      }
      //  ���� ��� ��� ������ ������� �������� ����������, �� ���� ���������� ��������������� ��� �����!
      if($ltr)
      {
         $words = @$response['words'];
         if($words)
         {
           $words = unserialize($words);
           $NNN = count($words);
           //  ���� ��� ��������� ������ ��������! �� ������ � ������ �������.
           $w_ = (int)((100-100%$dic_col)/$dic_col);
           print "\n<TABLE border=0 width=\"100%\">\n";
           $i = 0;
           foreach ($words as $tid_=>$thermin)
           {
             $thermin = q_utf2code($thermin, $dic_codepage);
             //  ������� � ���� ������� � ������ ������ �������
             if($i <= $dic_col) $ww = "width=\"$w_%\"";
              else $ww = "";
             $mod0 = $i % $dic_col;
             $mod1 = ($i+1) % $dic_col;
             if (!$mod0) echo "<TR>";  // �������� ������
             echo "<TD $ww><a href=\"$url"."dic_tid=$tid_\" style=\"$dic_style_words\">$thermin</a></TD>";
             if (!$mod1) echo "</TR>\n";  // ����������� ������
             $i++;
           }
           //  ���� �������� ����������� - ���� �������� ���������� ����� ������
           for ($j=$i; $j % $dic_col; $j++) echo "<TD $ww style=\"$dic_style_words\">&nbsp;</TD>";
           echo "</TR>";
           echo "</TABLE>\n";
         }
      }
      // ���� ��� ������ ID ������, �� ���� �������� ��.
      if($tid)
      {   //  ���� ������� �������� ������ � ������� ����������.  ���������� ������ �����. ����� ������
         $thermin = $response['thermin'];
         $thermin = q_utf2code($thermin, $dic_codepage);
         $description = $response['description'];
//         $description = dic_reverse_htmlentities($description);
         $description = q_utf2code($description, $dic_codepage);

         //  ���� ������� ������ ������.
         // <A HREF="6707">
//         $description = str_replace("<A HREF=\"", "<A HREF=\"$url"."dic_tid=", $description);
         $description = eregi_replace("<A HREF=\"([0-9]*)\">", "<A HREF=\"$url"."dic_tid=\\1\">" , $description);
         echo "<div style=\"$dic_style_thermin\">$thermin</div><br />\n";
         echo "<div style=\"$dic_style_descr\">$description</div>\n";
      }

    }

    //  ��� ��� ����� ������.
    echo "</DIV>\n";
 }


//  �������
  show_dic ($dic_did, $dic_uid, $dic_sid);



?>
