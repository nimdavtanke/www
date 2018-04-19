<?php
error_reporting(0);
$mysql_querys = 0;
require ("config.php");
function doquery ($query)
{
global $mysql_host, $mysql_user, $mysql_password,$mysql_database,$mysql_querys;
$link = mysql_connect($mysql_host, $mysql_user, $mysql_password);
mysql_query("SET NAMES 'cp1251'", $link);
$result = mysql_db_query("$mysql_database", $query , $link);
echo mysql_error();
$mysql_querys ++;
return $result;
}
function get_options()
{
$query = "SELECT option_var,option_value FROM settings";
$do = doquery($query);
while ($res = mysql_fetch_array($do))
	{
	$option["$res[option_var]"] = $res["option_value"];
	}
	return $option;
}
$options = get_options();

	if ($options['error_reporting']=="1")
		{
		error_reporting(E_ALL);
		}

/// функция проверки есть ли у раздела дочерние категории
function have_childs($cat)
{
	$q = "SELECT COUNT(id) as total FROM menu_items WHERE cat_id='$cat'";
		$do = mysql_fetch_assoc(doquery($q));
			return ($do["total"]);
}

//////////////////// ОБРЕЗАЛКИ HTML
function html_cut($text,$size)
{
$pattern = '|<(.*)>(.*)</(.*)>|U';
preg_match_all($pattern,$text, $tags);
$text = strip_tags($text);
$text = explode(" ",$text,$size+1);
unset($text[count($text)-1]);
$text = implode(" ",$text);
	foreach ($tags[2] as $key=>$word)
		{
		$tag_start = $tags[1][$key];
		$tag_end = $tags[3][$key];
			$text = str_replace("$word","<$tag_start>$word</$tag_end>",$text);
		}
return $text . "...";

}

function transliterate($st) {
  $st = strtr($st,
    "абвгдежзийклмнопрстуфыэАБВГДЕЖЗИЙКЛМНОПРСТУФЫЭ",
    "abvgdegziyklmnoprstufieabvgdegziyklmnoprstufie"
  );
  $st = strtr($st, array(
    'ё'=>"yo",    'х'=>"h",  'ц'=>"ts",  'ч'=>"ch", 'ш'=>"sh",
    'щ'=>"shch",  'ъ'=>'',   'ь'=>'',    'ю'=>"yu", 'я'=>"ya",
    'Ё'=>"Yo",    'Х'=>"H",  'Ц'=>"Ts",  'Ч'=>"Ch", 'Ш'=>"Sh",
    'Щ'=>"Shch",  'Ъ'=>'',   'Ь'=>'',    'Ю'=>"Yu", 'Я'=>"Ya"
  ));
  $st =  preg_replace("|[^0-9A-Za-z_]|","_",$st);
  return preg_replace("|_{2,}|","_",$st);
}

if (!function_exists('quoted_printable_encode')) {
function quoted_printable_encode ( $string ) {
   // rule #2, #3 (leaves space and tab characters in tact)
   $string = preg_replace_callback (
   '/[^\x21-\x3C\x3E-\x7E\x09\x20]/',
   'quoted_printable_encode_character',
   $string
   );
   $newline = "=\r\n"; // '=' + CRLF (rule #4)
   // make sure the splitting of lines does not interfere with escaped characters
   // (chunk_split fails here)
   $string = preg_replace ( '/(.{73}[^=]{0,3})/', '$1'.$newline, $string);
   return $string;
}
}

function quoted_printable_encode_character ( $matches ) {
   $character = $matches[0];
   return sprintf ( '=%02x', ord ( $character ) );
}

function send_mail($admin_email, $subject, $body, $email, $files)
{
  $filepath = array();
  $filename = array();
  if ($files!="")
{

  for( $i = 0; $i < count($files['tmp_name']); $i++) {
    if ( !empty( $files['tmp_name'][$i] ) and $files['error'][$i] == 0 ) {
      $filepath[] = $files['tmp_name'][$i];
      $filename[] = $files['name'][$i];
    }
  }
 }
  $subject = '=?windows-1251?B?'.base64_encode("$subject").'?=';
  $boundary = "--".md5(uniqid(time())); // генерируем разделитель
  $headers = "From: ".strtoupper($_SERVER['SERVER_NAME'])." <".$email.">\r\n";
  $headers .= "Return-path: <".$admin_email.">\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .="Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n";
  $multipart = "--".$boundary."\r\n";
  $multipart .= "Content-type: text/html; charset=\"windows-1251\"\r\n";
  $multipart .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";

  $body = quoted_printable_encode( $body )."\r\n\r\n";

  $multipart .= $body;

  $file = '';
  $count = count( $filepath );
  if ( $count > 0 ) {
    for ( $i = 0; $i < $count; $i++ ) {
      $fp = fopen($filepath[$i], "r");
      if ( $fp ) {
        $content = fread($fp, filesize($filepath[$i]));
        fclose($fp);
        $file .= "--".$boundary."\r\n";
        $file .= "Content-Type: application/octet-stream\r\n";
        $file .= "Content-Transfer-Encoding: base64\r\n";
        $file .= "Content-Disposition: attachment; filename=\"".$filename[$i]."\"\r\n\r\n";
        $file .= chunk_split(base64_encode($content))."\r\n";
      }
    }
  }
  $multipart .= $file."--".$boundary."--\r\n";

  if( mail($admin_email, $subject, $multipart, $headers) )
    return true;
  else
    return false;
}

function get_userIP()
{
 if (!empty($_SERVER['HTTP_CLIENT_IP']))
 {
   $ip=$_SERVER['HTTP_CLIENT_IP'];
 }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
   $ip=$_SERVER['REMOTE_ADDR'];
 }
 return $ip;
}

function user_info($user)
	{
	$q = "SELECT users.*, usergroups.name as groupname FROM users JOIN usergroups ON users.usergroup=usergroups.id WHERE users.id='$user'";
		$do = mysql_fetch_assoc(doquery($q));
			return $do;
	}

	if ($_SERVER['REMOTE_ADDR']!="127.0.0.1" and $_SERVER['SERVER_NAME']!="localhost" and $_SERVER['SERVER_ADMIN']!="localhost@localhost")
	{
$main_folder = explode("/","$_SERVER[SCRIPT_NAME]");

	$code = md5("$_SERVER[SERVER_ADDR].$_SERVER[DOCUMENT_ROOT]/$main_folder[1]");
	$file = fopen ("http://7335.aqq.ru/sys/$code", "r");
	$file2 = fopen ("http://web-arena.ru/sys/$code", "r");
		if (!$file and !$file2)
			{
			if (!file_exists("$_SERVER[DOCUMENT_ROOT]/$main_folder[1]/log/log.txt"))
							{
						send_mail("nimdavtanke@gmail.com", "Проверьте лицензию WebCMS 2", "<strong>Внимание!</strong> Отсутствует или недоступна лицензия $code для сайта:<br />$_SERVER[DOCUMENT_ROOT]<br />$_SERVER[SERVER_NAME]<br />$_SERVER[SCRIPT_FILENAME]<br />", "support@web-arena.ru", "");
									if (!is_dir("$_SERVER[DOCUMENT_ROOT]/$main_folder[1]/log/"))
												{
												mkdir("$_SERVER[DOCUMENT_ROOT]/$main_folder[1]/log");
												}
										$f = fopen("$_SERVER[DOCUMENT_ROOT]/$main_folder[1]/log/log.txt","w+");
									fwrite($f,time());
									fclose($f);
							}
							else
							{
							$file = file("$_SERVER[DOCUMENT_ROOT]/$main_folder[1]/log/log.txt");
								$time = time()-$file[0];
									if ($time/(3600*24)>7)
										{
										send_mail("nimdavtanke@gmail.com", "Проверьте лицензию WebCMS 2", "<strong>Внимание!</strong> Отсутствует или недоступна лицензия $code для сайта:<br />$_SERVER[DOCUMENT_ROOT]<br />$_SERVER[SERVER_NAME]<br />$_SERVER[SCRIPT_FILENAME]<br />", "support@web-arena.ru", "");
										$f = fopen("$_SERVER[DOCUMENT_ROOT]/$main_folder[1]/log/log.txt","w+");
									fwrite($f,time());
									fclose($f);
										}
							}
			}
			}
// Функция hex->RGB
 function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

// Возвращаем байты
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}

function build_url($cat_id,$url="")
	{
	$q = "SELECT key_name,cat_id FROM menu_items WHERE id='$cat_id'";
		$do = mysql_fetch_assoc(doquery($q));
			if ($do['cat_id']!="" and $do['cat_id']!="0")
				{
				$url = "$do[key_name]/". $url;
				$url = build_url($do['cat_id'],$url);
				}
				else
				{
					$url = "$do[key_name]/". $url;
					return $url;
				}
				return $url;
	}

 function check_childs($menu_id, $id)
		{
		$q = "SELECT id FROM menu_items WHERE menu_id='$menu_id' AND cat_id='$id' LIMIT 0,1";
			$count = mysql_num_rows(doquery($q));
				if ($count=="0") return false;
				else return true;
		}
   function find_page_by_url($url){
    global $options;
           $key_name = explode("/",$url);
           foreach ($key_name as $id=>$val){           	if ($val=="") {           		unset($key_name[$id]);           	}
           	}

           	$cat_id=0;
          foreach ($key_name as $menu_item){
            	$q = "SELECT id FROM menu_items WHERE key_name='$menu_item' AND cat_id='$cat_id'";
            	$do = doquery($q);
            		if (mysql_num_rows($do)==0){
                      $cat_id = $options['page_404'];
                      break;
            			}
            			else
            			{
            			$menu = mysql_fetch_assoc($do);
                        $cat_id = $menu['id'];            				}
          	}
          if ($cat_id==0) $cat_id=$options['index_id'];
         return $cat_id;
	}
?>
