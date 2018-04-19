<?php
error_reporting(0);
$dic_uid = "JohnLi"; // РРґРµРЅС‚РёС„РёРєР°С‚РѕСЂ РїР°СЂС‚РЅРµСЂР°
$dic_sid = "1344"; // РРґРµРЅС‚РёС„РёРєР°С‚РѕСЂ СЃР°Р№С‚Р°
$dic_did = "induism";
// РїР°СЂР°РјРµС‚СЂС‹ РЅРёР¶Рµ РјРѕР¶РЅРѕ РёР·РјРµРЅСЏС‚СЊ
$dic_showtitle = 1; // 1 - РїРѕРєР°Р·С‹РІР°С‚СЊ РЅР°Р·РІР°РЅРёРµ СЃР»РѕРІР°СЂСЏ; 0 - РЅРµ РїРѕРєР°Р·С‹РІР°С‚СЊ.
$dic_lnum = 1; // РљРѕР»РёС‡РµСЃС‚РІРѕ РїРѕРєР°Р·С‹РІР°РµРјС‹С… СЃРёРјРІРѕР»РѕРІ РІ РѕРіР»Р°РІР»РµРЅРёРё
$dic_col = 2; // РљРѕР»РёС‡РµСЃС‚РІРѕ РєРѕР»РѕРЅРѕРє РґР»СЏ РїРѕРєР°Р·Р° СЃРїРёСЃРєР° СЃР»РѕРІ.
$dic_codepage = 'UTF-8'; // РСЃРїРѕР»СЊР·СѓРµРјР°СЏ РЅР° СЃР°Р№С‚Рµ РєРѕРґРёСЂРѕРІРєР° (UTF-8, cp1251).

// РСЃРїРѕР»СЊР·СѓРµРјС‹Рµ СЃС‚РёР»Рё. РЈСЃС‚Р°РЅРѕРІР»РµРЅС‹ РїРѕ СѓРјРѕР»С‡Р°РЅРёСЋ. РњРѕР¶РЅРѕ СѓР±СЂР°С‚СЊ РёР»Рё РёР·РјРµРЅРёС‚СЊ
$dic_div_style = "width:800px; padding:5px; overflow: auto; "; // РЎС‚РёР»СЊ DIV-РєРѕРЅС‚РµР№РЅРµСЂР°, СЃРѕРґРµСЂР¶Р°С‰РµРіРѕ СЃР»РѕРІР°СЂСЊ
$dic_style_title = "color: #505050; font-size:24px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;"; // СЃС‚РёР»СЊ РїРѕРєР°Р·Р° Р·Р°РіРѕР»РѕРІРєР°
$dic_style_words = "color: #282828; font-size:20px; font-family: ;Verdana, Arial, Helvetica, sans-serif;"; // СЃС‚РёР»СЊ РїРѕРєР°Р·Р° С‚РµСЂРјРёРЅРѕРІ РІ СЃРїРёСЃРєРµ
$dic_style_letters = "color: #007cad; font-size:20px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;"; // СЃС‚РёР»СЊ РїРѕРєР°Р·Р° Р±СѓРєРІ РѕРіР»Р°РІР»РµРЅРёСЏ
$dic_style_thermin = "color: #212121; font-size:24px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;"; // СЃС‚РёР»СЊ РїРѕРєР°Р·Р° С‚РµСЂРјРёРЅР°.
$dic_style_descr = "color: #1c1c1c; font-size:20px; font-family: Verdana, Arial, Helvetica, sans-serif;"; // СЃС‚РёР»СЊ РїРѕРєР°Р·Р° РѕРїРёСЃР°РЅРёСЏ С‚РµСЂРјРёРЅР°.

$debugMode = 0; // Р’РєР»СЋС‡Р°РµС‚ СЂРµР¶РёРј РІС‹РІРѕРґР° РѕС‚Р»Р°РґРѕС‡РЅРѕР№ РёРЅС„РѕСЂРјР°С†РёРё (1 - РІС‹РІРѕРґ РµСЃС‚СЊ; 0 - РІС‹РІРѕРґР° РЅРµС‚)
// РСЃРїРѕР»СЊР·СѓР№С‚Рµ $debugMode = 1; РµСЃР»Рё РµСЃС‚СЊ РєР°РєРёРµ-С‚Рѕ РїСЂРѕР±Р»РµРјС‹. РџРѕР»СѓС‡РµРЅСѓСЋ РѕС‚Р»Р°РґРѕС‡РЅСѓСЋ РёРЅС„РѕСЂРјР°С†РёСЋ РЅСѓР¶РЅРѕ РѕС‚РїСЂР°РІРёС‚СЊ СЂР°Р·СЂР°Р±РѕС‚С‡РёРєР°Рј РґР»СЏ РІС‹СЏСЃРЅРµРЅРёСЏ РїСЂРёС‡РёРЅ РѕС‚РєР°Р·Р°.

/*************************************************************************************************/

 $useCDATA = 1;   //  Использовать CDATA для работы со строками.
 $array4values = Array();   //  Здесь будем накапливать массив Параметр - Значение


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
  return strtr($st, "абвгдежзийклмнопрстуфхцчшщъыьэюяabcdefghigklmnopqrstuvwxyz", "АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯABCDEFGHIJKLMNOPQRSTUVWXYZ");
}
function ToLower($st)
{
  return strtr($st, "АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯABCDEFGHIJKLMNOPQRSTUVWXYZ", "абвгдежзийклмнопрстуфхцчшщъыьэюяabcdefghigklmnopqrstuvwxyz");
}


class XMLparser
{

  var $parser;          //  Собственно парсер XML
//  Служебные переменные.
  var $waiting4value;
  var $waiting4name;
  var $currentname;
  var $datacollectionmode;   //  Идет сбор данных!

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
  {  //  Пляски с бубном
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
//echo "<br>Открытие тега: $tag, $attributes \n";
    $this->datacollectionmode = 0;  //  Сбор данных пока не начался.
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
//echo "<br>Завершение. tag=$tag\n";
    //  Если был режим сбора данных, то, т.к. встретили завершение тега, прекращаем ожидание данных
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
    	$this->currentname = $data;  //  Запомнили имя атрибута
    	$this->waiting4name = 0;
//    	echo " currentname = $data ";
    }
    if($this->waiting4value)
    {
    	 $array4values[$this->currentname] .= $data;  //  Присвоили запомненому элементу значение.
      $this->datacollectionmode = 1;                              //  Начался режим сбора данных
//      $this->waiting4value = 0;                                 // Нельзя пока прекращать ожидание данных - они могут бытьна другой строке!
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
			$myData .= "<value>$v</value>\n";                    //  По умолчанию всё типа string
//			$myData .= "<value><string>$v</string></value>\n";
		  $myData .= "</param>\n";
	  }
		$myData .= "</params>\n";
	}
  $myData .= "</methodCall>";


//  Организуем соединение с сервером.
//  Надо бы еще устанавливать таймаут !!!!!!!!!!!!!!!!!!!!!!!!!
	$conn = @fsockopen($site, $port);
	if(!$conn)
	{  //  Ошибка при соединении
  	return array('faultCode'=>16, 'faultString'=>"Connection failed: Couldn't make the connection to $site.");
	  exit;
	}
	//  Все нормально, соединение есть.  Формируем заголовок.
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
	//  Получаем ответ от сервера
	$response = "";
	while(!feof($conn))	$response .= fgets($conn, 1024);
	fclose($conn);
//  Надо проверить.  Вдруг кто-то включил magic_quotes_runtime...
        $isMagic2 = get_magic_quotes_runtime();
        if($isMagic2) $response = stripslashes($response);

// Отрезаем заголовок ответа
	$data = substr($response, strpos($response, "\r\n\r\n")+4);

//  Попробуем перекодировать из UTF-8
//  $data = utf2win($data);

//  Выделим из XML массив и отдадим его.
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
	{  //  Надо посылать сообщение об ошибке.
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
			$myData .= "<value>$v</value>\n";                    //  По умолчанию всё типа string
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

//writelog("make_XMLRPC_response. Посылаем ответ:\n$myData");

}

function sendError($ErrCode, $ErrMsg)
{  //  Форимруем и отсылаем сообщение об ошибке
  writelog("- sendError. $ErrCode ($ErrMsg)");
  $params['faultCode'] = $ErrCode;
  $params['faultString'] = $ErrMsg;
  writelog("- sendError. перед make_XMLRPC_response");
  make_XMLRPC_response($params);
}



function dic_reverse_htmlentities($mixed)
{
  return $mixed;  //  В настоящее время данная функция не используется!
                  //  Оставлено для обратной совместимости.

//  global $dic_codepage;
//  if($dic_codepage === 'utf-8')return $mixed;   //  Обрабатывать не надо!!!!!!!!!!!1

  $htmltable = get_html_translation_table(HTML_ENTITIES);
  foreach($htmltable as $key => $value)
  {
    $mixed = ereg_replace(addslashes($value),$key,$mixed);
  }
  return $mixed;
}


//  Ниже модуль отображающий словарь.
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


    //  значения по умолчанию.
    $_dic_showtitle = 1;
    $_dic_lnum      = 1;
    $_dic_col       = 2;
    $_dic_codepage  = 'cp1251';
    $_dic_div_style     = "width:400px; border:solid 1px gray; padding:5px; ";      //  Стиль DIV-контейнера, содержащего словарь
    $_dic_style_title   = "font-size:12px; font-weight: bold; color: #666666; font-family: Verdana, Arial, Helvetica, sans-serif;";  // стиль показа заголовка
    $_dic_style_words   = "font-size:10px; font-family: Verdana, Arial, Helvetica, sans-serif;";  // стиль показа терминов в списке
    $_dic_style_letters = "font-size:10px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;"; // стиль показа букв оглалавления
    $_dic_style_thermin = "font-size:12px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif;";  //  стиль показа термина.
    $_dic_style_descr   = "font-size:10px; font-family: Verdana, Arial, Helvetica, sans-serif;";  //  стиль показа описания термина.

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
//  Извлекаем параметры
    $ltr = @$_REQUEST['dic_ltr'];
    $tid = @$_REQUEST['dic_tid'];

    //  Запомним параметры из URL
    $ParList = Array();
    parse_str($_SERVER['QUERY_STRING'], $ParList);
    //  Сохраним все чужие параметры.
    $url .= "?";
    foreach ($ParList as $k=>$v)
    {
       if ($k == "dic_ltr") continue;  //  Пропускаем собственные параметры. добавим их после
       if ($k == "dic_tid") continue;  //  Пропускаем собственные параметры. добавим их после
       $url .= "$k=$v&";
    }

    //  Посылаем необходимые запросы.
//  Надо получить сначала верхнее оглавление.
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
 //  Обрабатываем пришедший результат.

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
    {       //  Запрос не удался... :-(
      echo "<p>Error: " . nl2br("($faultCode) $faultString\n");
    }
    else
    { //  Ответ получен!!!
      $DicTitle = @$response['title'];
      $DicTitle = q_utf2code($DicTitle, $dic_codepage);

      if ($dic_showtitle) echo "<div style=\"$dic_style_title\">$DicTitle</div>";

      //  Определим доп. текст
      $before = @$response['before'];
      $after  = @$response['after'];

      if($before)
      {
//        $before = dic_reverse_htmlentities($before);
        $before = q_utf2code($before, $dic_codepage);
        echo $before;
      }
      //  Теперь выводим верхнее оглавление
      $letters = @$response['letters'];
      if($letters)
      {
        $letters = unserialize($letters);
        foreach(@$letters as $k=>$v)
        {
           $v_ = $v;   //  Для передачи в качестве параметра
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
      //  Если уже был выбран элемент верхнего оглавления, то надо показывать соответствующие ему слова!
      if($ltr)
      {
         $words = @$response['words'];
         if($words)
         {
           $words = unserialize($words);
           $NNN = count($words);
           //  Надо еще указывать ширину столбцов! Но только в первой колонке.
           $w_ = (int)((100-100%$dic_col)/$dic_col);
           print "\n<TABLE border=0 width=\"100%\">\n";
           $i = 0;
           foreach ($words as $tid_=>$thermin)
           {
             $thermin = q_utf2code($thermin, $dic_codepage);
             //  Выводим в виде таблицы с нужным числом колонок
             if($i <= $dic_col) $ww = "width=\"$w_%\"";
              else $ww = "";
             $mod0 = $i % $dic_col;
             $mod1 = ($i+1) % $dic_col;
             if (!$mod0) echo "<TR>";  // начинаем строку
             echo "<TD $ww><a href=\"$url"."dic_tid=$tid_\" style=\"$dic_style_words\">$thermin</a></TD>";
             if (!$mod1) echo "</TR>\n";  // заканчиваем строку
             $i++;
           }
           //  Хотя элементы закончились - надо дописать оставшуюся часть строки
           for ($j=$i; $j % $dic_col; $j++) echo "<TD $ww style=\"$dic_style_words\">&nbsp;</TD>";
           echo "</TR>";
           echo "</TABLE>\n";
         }
      }
      // Если был указан ID статьи, то надо выводить ее.
      if($tid)
      {   //  Надо вывести описание статьи и верхнее оглавление.  Необходимо делать соотв. вывод данных
         $thermin = $response['thermin'];
         $thermin = q_utf2code($thermin, $dic_codepage);
         $description = $response['description'];
//         $description = dic_reverse_htmlentities($description);
         $description = q_utf2code($description, $dic_codepage);

         //  Надо сделать замену ссылок.
         // <A HREF="6707">
//         $description = str_replace("<A HREF=\"", "<A HREF=\"$url"."dic_tid=", $description);
         $description = eregi_replace("<A HREF=\"([0-9]*)\">", "<A HREF=\"$url"."dic_tid=\\1\">" , $description);
         echo "<div style=\"$dic_style_thermin\">$thermin</div><br />\n";
         echo "<div style=\"$dic_style_descr\">$description</div>\n";
      }

    }

    //  Все что можно вывели.
    echo "</DIV>\n";
 }


//  Выводим
  show_dic ($dic_did, $dic_uid, $dic_sid);



?>
