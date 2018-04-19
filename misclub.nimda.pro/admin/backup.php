<?
header('Content-type: text/html; charset=windows-1251');
require("../functions/main.func.php");
require("../functions/admin.func.php");
$showhide_frame = true;
require("../templates/admin_header.php");
error_reporting(E_ALL);
if (isset($_GET['action']))
{
$action = $_GET['action'];
}
if (isset($_POST['action']))
{
$action = $_POST['action'];
}
if (!isset($action)) $action="";
?>
<div style="padding-left:7px;">
<?
echo "<h3>Управление резервными копиями</h3>";
$message = "";


if ($action=="do_files_backup")
	{
	require("../functions/pclzip.lib.php");
	$archive = new PclZip('backup/backup_files.zip');
  			$v_list = $archive->create('../',
                	            PCLZIP_OPT_REMOVE_PATH, '../',
                	            PCLZIP_OPT_ADD_PATH, '');
			if ($v_list == 0)
			{
				$message .= "Error : ".$archive->errorInfo(true);
  			}
			$message = "<span style='color:#009900;'>Копия файлов сайта создана!</span><br />";
	  $action="";
	}
if ($action=="do_backup")
	{
	 $time_start=microtime(1);

 // Открывается файл для записис дампа
 $file=fopen("backup/".date("d-m-Y_h-i").".sql","w");

 fwrite($file,"#######################################\n");
 fwrite($file,"# Дамп базы данных\n");
 fwrite($file,"# ".date("d.m.Y H:i",time())."\n");
 fwrite($file,"#######################################\n\n");
     $list_table_query=mysql_list_tables($mysql_database);
     while($row2=mysql_fetch_array($list_table_query))
     {
         $list_tables[]=$row2[0];
     }

	foreach($list_tables as $table)
     {
         fwrite($file,"# Дамп таблицы $table\n\n");
         $query_fields=mysql_query("SHOW FIELDS FROM $table");
         $str="CREATE TABLE IF NOT EXISTS $table (";

         $fields=array();
         $k=0; // Количество извлеченных колонок таблицы до цикла извлечения их из выполненного выше запроса
         $i=0; // Индекс массива колонок
         while($row3=mysql_fetch_array($query_fields))
         {
             $k++;

             $fields[$i]=$row3["Field"]; // Имя
             $type=$row3["Type"]; // Тип
             $null=$row3["Null"]; // Признак NULL
             $key=$row3["Key"]; // Ключевое или нет
             $default=$row3["Default"]; // Значение по-умолчанию
             $extra=$row3["Extra"]; // Дополнительные параметры (auto_increment)

             $str.=" `$fields[$i]` ".strtoupper($type);

             if($null=="NO")
             {
                 $str.=" NOT NULL";
             }

             if($key=="PRI")
             {
                 $str.=" PRIMARY KEY";
             }

             if(!empty($default))
             {
                 $str.=" DEFAULT $default";
             }

             if($extra=="auto_increment")
             {
                 $str.=" AUTO_INCREMENT";
             }

             if($k<mysql_num_rows($query_fields))
             {
                 $str.=",";
             }

             $i++;
         }

         $str.=");";

         fwrite($file,"$str\n\n");

         $query_data=mysql_query("SELECT * FROM $table");

         while($row4=mysql_fetch_array($query_data))
         {
             $str="INSERT INTO $table VALUES (";
             for($i=0;$i<count($fields);$i++)
             {
                 $field_type=mysql_field_type($query_data,$i);

                 if($field_type=="string" || $field_type=="blob")
                 {
                     $str.="'";
                 }
                 $row4[$fields[$i]] = str_replace("\r","",$row4[$fields[$i]]);
				 $row4[$fields[$i]] = str_replace("\n","",$row4[$fields[$i]]);
                 $str.=$row4[$fields[$i]];

                 if($field_type=="string" || $field_type=="blob")
                 {
                     $str.="'";
                 }

                 if($i+1<count($fields))
                 {
                     $str.=",";
                 }
             }

             $str.=");";
             fwrite($file,"$str\n\n");
         }
         fwrite($file,"# Конец дампа таблицы $table\n\n");
         unset($fields);
     }
	  $message = "<span style='color:#009900;'>Копия базы данных создана!</span><br />";
	  $action="";
	}
		if ($action=="delete")
			{
				if (!isset($_GET['file']))
				 	{
					$message = "<span style='color:#990000;'>Ошибка! Не указан файл!</span><br />";
					}
					else
					{
					if ($_GET['file']=="clear.sql")
				 	{
					$message = "<span style='color:#990000;'>Базовую копию БД удалить нельзя!</span><br />";
					}
					else
					{
						if (unlink("backup/$_GET[file]"))
							{
							$message = "<span style='color:#009900;'>Резервная копия удалена!</span><br />";
							}
					}
					}
					$action="";
			}
			if ($action=="get_backup")
			{
				if (!isset($_GET['file']))
				 	{
					$message = "<span style='color:#990000;'>Ошибка! Не указан файл!</span><br />";
					}
					else
					{
						// Очищаем талицы БД
						 $list_table_query=mysql_list_tables($mysql_database);
								 while($row2=mysql_fetch_array($list_table_query))
								 {
								 $message.= "Таблица $row2[0] ... ";
									$q = "TRUNCATE $row2[0]";
										if (doquery($q))
											{
											$message.= " очищена!<br />";
											}
											else
											{
											$message.= "очистить не удалось!<br />";
											}

								 }
								 $sql_file = file("backup/$_GET[file]");
								 $message.= "Загрузка данных ... ";
								 	foreach($sql_file as $key=>$q)
										{
											if (trim($q)!="" and $q[0]!="#")
												{
													if (!doquery($q))
														{
														$message.= "Ошибка! <br />";
														}
												}
										}
										$message.= "завершено!<br /><br />";

					}
					$action="";
			}
		if ($action=="")
			{

				echo "$message";
					echo "<strong>Резервные копии БД</strong><br /><br />";
						// Получаем доступные копии
						$dir = "backup";
							$opend_dir = opendir($dir);
							echo "<table border='0' cellpadding='6' cellspacing='0' style='border:1px solid #8791a4; background-color:#ffffff;'>

	<tr><td style='border-bottom:1px solid #8791a4;'><strong>Дата</strong></td><td style='border-bottom:1px solid #8791a4;'><strong>Файл</strong></td><td style='border-bottom:1px solid #8791a4;'>&nbsp;</td><td style='border-bottom:1px solid #8791a4;'>&nbsp;</td></tr>";
	$copies = 0;
								 while ($get_file = readdir($opend_dir))
									{
									$filename = $dir . "/".$get_file;
									$path_parts = pathinfo($filename);
									if (is_file($filename) and ($path_parts['extension']=="sql"))
										{
										$file_date = date("d.m.Y H:i", filemtime($filename));
										echo "<tr><td style='border-bottom:1px solid #8791a4;'>$file_date</td><td style='border-bottom:1px solid #8791a4;'>$get_file</td><td style='font-size:11px; border-bottom:1px solid #8791a4;'><a href='#' onclick=\"if (confirm('Внимание! Текущая конфигурация базы данных будет полностью замещена резервной копией. \\r\\n \\r\\nПродолжить?')) {location.href='backup.php?action=get_backup&file=$get_file';}\">восстановить</a></td><td style='font-size:11px; border-bottom:1px solid #8791a4;'><a href='backup.php?action=delete&file=$get_file'>удалить</a></td></tr>";
										$copies++;
										}
									}
									if ($copies==0)
										{
										echo "<tr><td colspan='5'><center>Не найдено ни одной копии</center></td></tr>";
										}
									echo "</table>";

									echo "<br /><a href='backup.php?action=do_backup'>Создать резервную копию базы данных</a>";

									// Файловая копия
										echo "<br /><br /><strong>Копия файлов сайта</strong><br /><br />";
						// Получаем доступные копии

							echo "<table border='0' cellpadding='6' cellspacing='0' style='border:1px solid #8791a4; background-color:#ffffff;'>

	<tr><td style='border-bottom:1px solid #8791a4;'><strong>Дата</strong></td><td style='border-bottom:1px solid #8791a4;'>&nbsp;</td><td style='border-bottom:1px solid #8791a4;'>&nbsp;</td></tr>";
	$copies = 0;

									if (is_file("backup/backup_files.zip"))
										{
										$file_date = date("d.m.Y H:i", filemtime("backup/backup_files.zip"));
										echo "<tr><td style='border-bottom:1px solid #8791a4;'>$file_date</td><td style='font-size:11px; border-bottom:1px solid #8791a4;'><a href='backup/backup_files.zip' target='_blank'>скачать</a></td><td style='font-size:11px; border-bottom:1px solid #8791a4;'><a href='backup.php?action=delete&file=backup_files.zip'>удалить</a></td></tr>";
										$copies++;
										}
										else
										{

										echo "<tr><td colspan='5'><center>Не найдено файловых копий</center></td></tr>";
										}
									echo "</table>";
									echo "<br /><a href='backup.php?action=do_files_backup'>Создать резервную копию файлов сайта</a>";


			}

?>
</div>