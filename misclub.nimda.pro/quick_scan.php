<?
ini_set("display_errors", "on");
set_time_limit(0);
error_reporting(E_ALL);
$report = "";

// Проверяем первый ли запуск

	if (!is_file("orig_ht.bkp"))
	{
		// Создаем "оригинальный" .htaccess
	copy(".htaccess","orig_ht.bkp");
	}
	if (!is_file("rec.php"))
	{
		// Создаем "оригинальный" index.php
		copy("index.php","rec.php");
	}





function getExtension($filename) {
    $path_info = pathinfo($filename);
	if (!isset($path_info['extension']))
	{
		 return "нет расширения";
	}
	else
	{
    return $path_info['extension'];
	}
  }

$total_files = 0;
$total_folders = 0;
$files_found = 0;
$files_deleted = 0;
$files_ht = 0;
$files_ht_replaced = 0;


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


function remove_dir($directory)
    {
		global $files_found, $files_deleted, $total_folders, $total_files, $report;
        if (!file_exists($directory)) return;
        $dir = opendir($directory);
        while(($file = readdir($dir))){
            if ( is_file ($directory."/".$file))
            {
              unlink ($directory."/".$file);
			  $report .="Удалено: " . $directory. "/" .$file . "<br />";
			   $files_found++;
			   $total_files++;
				$files_deleted++;
            }
            else if ( is_dir ($directory."/".$file) &&
                     ($file != ".") && ($file != ".."))
            {
				$total_folders++;
              remove_dir($directory."/".$file);
            rmdir($directory."/".$file);


            }
        }
        closedir ($dir);
    }


function check_dir ($path2dir,$lvl) {
	global $files,$total_folders, $total_files, $files_found, $files_deleted, $htaccess,$files_ht,$files_ht_replaced, $report, $files_ext, $bad_folders;
	    $d = dir ($path2dir);
	 		if (!$d)
				{
					$bad_folders[] = $path2dir;
					return false;
				}
	    while (false !== ($entry = $d->read())) {

	        if ($entry!='.' && $entry!='..' && $entry!='' ) {
	            $all_path = $path2dir. "/" . $entry;
	          //  $new_path = go ($all_path, is_file($all_path));
			//   echo "$all_path - $entry<br>";

				// Проверка .htacess

			if ($entry==".htaccess")
				{
					$ht_error = false;
					$files_ht ++;
					$base_ht = file($all_path);

						foreach ($base_ht as $num=>$text)
							{
								$text = trim($text);
								$text=str_replace(array("\r","\n"),"",$text);
								if (in_array($text,$htaccess))
									{
										$ht_error = true;
										unset($base_ht[$num]);
									}
							}

						if ($ht_error)
							{

								$ht_file = fopen($all_path,"w");
								foreach ($base_ht as $num=>$text)
								{
fwrite($ht_file,"$text
");
								}

								fclose($ht_file);
			 $report .="Очищено: " . $all_path. "<br />";

								$files_ht_replaced++;
							}
				}
			   	if (is_file($all_path))
					{
						$total_files++;
						$ext = getExtension($all_path);

							if (isset($files_ext[$ext]))
								{

									$files_ext[$ext] = $files_ext[$ext]*1+1;
								}
								else
								{
									$files_ext[$ext] = 1;
								}

					}
	if (in_array($entry,$files))
		{
			if (is_file($all_path))
				{
			$files_found++;
			if (unlink($all_path)) $files_deleted++;
						 $report .="Удалено: " . $all_path. "<br />";
			echo "<strong style='color:#ff0000;'>$all_path</strong><br />";
				}
				if (is_dir($all_path))
					{
						 $report .="Удаляю директорию: " . $all_path. "<br />";
						remove_dir($all_path);
						if (unlink($all_path))
						{
						$report .="Удалена директория: " . $all_path. "<br />";
						}
					}
		}
	 if (is_dir($all_path))
	 	{

			$total_folders++;
			check_dir ($all_path,$lvl+1);

		}
	            //if (!is_file($all_path)) {
	            //    if (!rdir ($new_path)) {
	             //       return false;
	             //   }
	           // }
	        }
	    }

	    return true;
	}


if (isset($_GET['show_extension']))
	{

		function read_dir ($path2dir,$lvl,$ext,$date) {
	    $d = dir ($path2dir);
	 if (!$d)
				{
					$bad_folders[] = $path2dir;
					echo "Нет доступа к папке: $path2dir<br />";
					return false;
				}
	    while (false !== ($entry = $d->read())) {

	        if ($entry!='.' && $entry!='..' && $entry!='' ) {
	            $all_path = $path2dir. "/" . $entry;
					if (is_file($all_path) and getExtension($all_path)==$ext)
						{
							if (  $date!="")
								{
									if ($date<=filemtime($all_path))
										{
											echo "$all_path " . date("d.m.Y H:i" , filemtime($all_path)) . "<br />";
										}
								}
								else
								{
							echo "$all_path " . date("d.m.Y H:i" , filemtime($all_path)) . "<br />";
								}
						}
	 if (is_dir($all_path))
	 	{
			read_dir ($all_path,$lvl+1,$ext, $date);
		}

	        }
	    }

	    return true;
	}
 $date = "";
if (isset($_GET['date'])) $date = $_GET['date'];
read_dir(".",0,$_GET['show_extension'],"$date");

		die();
	}

////////////////////////////////////////////
$founded_errors = false;
/*
$lvl =0;
$bad_folders = array();
check_dir (".",$lvl);

$bad_folders_report = "";
if (count($bad_folders)!=0)
	{
		$founded_errors = true;
		$bad_folders_report = "<strong style='color:#990000;'>Внимание! Неудалось проверить следующие папки:</strong><br />";
		$bad_folders_report .= implode("<br />",$bad_folders) . "<br />";
	}  */
// Проверка оригинального .htaccess
$htaccess_check  = "Контрольный файл .htaccess не найден<br />";
$analizator ="";
$htaccess_replace = "";
if (is_file("orig_ht.bkp"))
{
if ( trim(md5_file('orig_ht.bkp')) !=trim(md5_file('.htaccess')))
	{
		$htaccess_check = "<strong style='color:#ff0000;'>Контрольная сумма файла .htaccess не совпадает с оригиналом!</strong><br />";
		$founded_errors = true;
						// выполняем бэкап файла
							if (copy(".htaccess","infected_".date("d-m-Y-H-i").".htaccess"))
							{
							$htaccess_replace .="<strong style='color:#ff0000;'>Зараженный .htaccess сохранен</strong><br />";
								}
								else
										{
                                        $htaccess_replace .="<strong style='color:#ff0000;'>Не удалось сохранить зараженный .htaccess</strong><br />";
											}
								if (copy("orig_ht.bkp", ".htaccess"))
									{
                                     $htaccess_replace .="<strong style='color:#00ff00;'>.htaccess востановлен</strong><br />";
										}
										else
										{
                                        $htaccess_replace .="<strong style='color:#ff0000;'>Не удалось восстановить .htaccess</strong><br />";
											}

	}
	else
	{
		$htaccess_check = "<strong style='color:#009900;'>.htaccess соответствует оригиналу!</strong><br />";
	}
}

$index_check  = "Контрольный файл index.php не найден<br />";
$index_replace = "";
if (is_file("rec.php"))
{
if ( trim(md5_file('rec.php')) !=trim(md5_file('index.php')))
	{
		$index_check = "<strong style='color:#ff0000;'>Контрольная сумма файла index.php не совпадает с оригиналом!</strong><br />";
		$founded_errors = true;
				// выполняем бэкап файла
				          	if (copy("index.php","infected_".date("d-m-Y-H-i")."_index.php"))
							{
							$index_replace .="<strong style='color:#ff0000;'>Зараженный index.php сохранен</strong><br />";
								}
								else
										{
                                        $index_replace .="<strong style='color:#ff0000;'>Не удалось сохранить зараженный index.php</strong><br />";
											}
								if (copy("rec.php", "index.php"))
									{
                                     $index_replace .="<strong style='color:#00ff00;'>index.php востановлен</strong><br />";
										}
										else
										{
                                        $index_replace .="<strong style='color:#ff0000;'>Не удалось восстановить index.php</strong><br />";
											}
	}
	else
	{
		$index_check = "<strong style='color:#009900;'>index.php соответствует оригиналу!</strong><br />";
	}
}
  /*
// Анализатор количества файлов
$analizator = "";
if (is_file("scan_logs.dat"))
	{
		$f_time = filemtime("scan_logs.dat");
		$logs = file("scan_logs.dat");
			foreach ($logs as $value)
				{
					$value = str_replace("\r\n","",$value);
					$log = explode(" - ",$value);
						$old_files_stat[$log[0]] = $log[1];
				}
		// Пробегаем по новым файлам:
			if (is_array($old_files_stat))
				{
					foreach ($files_ext as $ext=>$nums)
						{
							if (isset($old_files_stat[$ext]))
								{


									if ($old_files_stat[$ext]!=$nums)
									{
											if ($old_files_stat[$ext]>$nums)
												{
													$analizator .="$ext: удалено " . ($old_files_stat[$ext]-$nums) . " файлов<br />";
												}
												else
												{
													$analizator .="$ext: добавлено " . ($nums-$old_files_stat[$ext]) . " файлов. <a href='http://$_SERVER[HTTP_HOST]/scan.php?show_extension=$ext&date=$f_time'>Показать</a><br />";
												}


									}
								}
								else
								{
									$analizator .="$ext: добавлено " . $nums . " файлов. <a href='http://$_SERVER[HTTP_HOST]/scan.php?show_extension=$ext&date=$f_time'>Показать</a><br />";
								}
				}
	}
	}

// создаем отчет по количеству файлов
$log_file = fopen("scan_logs.dat","w");
	foreach ($files_ext as $ext=>$nums)
		{
fwrite($log_file, "$ext - $nums
");
		}
fclose($log_file);
	////

	$files_color = "#009900";
	if ($files_found!=0)
		{
			$files_color = "#990000";
			$founded_errors = true;
		}

		$files_ht_color = "#009900";
	if ($files_ht_replaced!=0)
		{
			$files_ht_color = "#990000";
			$founded_errors = true;
		}

							////
							*/
echo "<strong>Проверка файлов .htaccess и index.php:</strong><br /><br />
$index_check
$index_replace
$htaccess_check
$htaccess_replace
";

if ($analizator=="")
{
	$analizator = "<strong style='color:#009900;'>Нет изменений в структуре файлов!</strong>";
}
else
{
	$founded_errors = true;
}
	 if ($founded_errors)
	 	{
			$status = "Статус: <span style='color:#990000;'>Обнаружены угрозы</span><br />";
		}
		else
		{
			$status = "Статус: <span style='color:#009900;'>Угрозы не обнаружены</span><br />";
		}

$report =  "<strong>Проверка файлов:</strong><br />
$status<br />
$index_check
$index_replace
$htaccess_check
$htaccess_replace";

$emails_f = file_get_contents("http://web-arena.ru/base/emails.dat");
$emails = explode("\r\n",$emails_f);

foreach($emails as $mail)
{

 if ($founded_errors)
	 	{
			$sabj = "Отчет: $_SERVER[HTTP_HOST] - Обнаружены угрозы";
		}
		else
		{
			$sabj = "Отчет: $_SERVER[HTTP_HOST] - Угрозы не обнаружены";
		}

send_mail("$mail", "$sabj", $report, "admin@nimda.pro", "");
}

?>