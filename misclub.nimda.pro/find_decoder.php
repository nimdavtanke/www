<?php
ini_set("display_errors", "on");
set_time_limit(0);
error_reporting(E_ALL);

$base64 = array("\\142\\","\\x61\\", "\\x73\\","\\145\\","\\x36\\","\\x34\\","\\x5F\\","\\x64\\","\\145\\","\\x63\\","\\x6F\\","\\x64\\","\\145\\");
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


//проверка папки samples
if (is_dir("editor/samples")){
 remove_dir("editor/samples");
}

function check_dir ($path2dir,$lvl) {
global $base64;
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

               //  echo "$all_path<br />";

//echo "$all_path<br />";
if ($all_path =="./find_decoder.php") continue;
               if ($entry=="backup_files.zip") continue;

               if ($entry=="worker.php" || $entry=="style.php" || $entry=="folder.php" || $entry=="zoo.phtml" || $entry=="lol3.jpg" || $entry=="plugin.class.php" || $entry=="module.zip" || $entry=="init.php" || $entry=="helper.php" || $entry=="ccs.php" || $entry=="css.php")
               {
               	echo "<strong>$all_path</strong> - ";
               		if (unlink($all_path)){
               		echo "<strong style='color:#009900;'>удалено!</strong><br />";
               		}
               		else
               		{
               		 echo "<strong style='color:#ff0000;'>не удалось удалить!</strong><br />";
               		}
               	continue;
               }
			   	if (is_file($all_path))
					{

						$file_cont = file_get_contents($all_path);
							if (strpos($file_cont,"base64_decode")!==false){
							echo "<strong style='color:#ff0000;'>$all_path</strong> - base64_decode (" .mb_substr_count($file_cont,"base64_decode") .")<br />";
							}
							else
							{
							$founded_base = 0;
								foreach ($base64 as $val){
								if (strpos($file_cont,"$val")!==false){
								$founded_base++;
								}
								}
								if ($founded_base==count($base64)){
								echo "<strong style='color:#ff0000;'>$all_path</strong> - base64_decode<br />";
								}
							}



							if (strpos($file_cont,"include")!==false){
							echo "<strong style='color:#ff0000;'>$all_path</strong> - include (" .mb_substr_count($file_cont,"include") .")<br />";
							}

							if (strpos($file_cont,"class ML")!==false){
							echo "<strong style='color:#ff0000;'>$all_path</strong> - class ML (" .mb_substr_count($file_cont,"class ML") .")<br />";
							}


							if (strpos($file_cont,"init.php")!==false){
							echo "<strong style='color:#ff0000;'>$all_path</strong> - init.php (" .mb_substr_count($file_cont,"init.php") .")<br />";
							}



							 	if (strpos($file_cont,"preg_replace")!==false){
							echo "<strong style='color:#ff0000;'>$all_path</strong> - preg_replace (" .mb_substr_count($file_cont,"preg_replace") .")<br />";
							}

							  if (strpos($file_cont,"urldecode")!==false){
							echo "<strong style='color:#ff0000;'>$all_path</strong> - urldecode (" .mb_substr_count($file_cont,"urldecode") .")<br />";
							}
							if (strpos($file_cont,"Hack")!==false or strpos($file_cont,"hack")!==false){
							echo "<strong style='color:#ff0000;'>$all_path</strong> - Hack (" .mb_substr_count($file_cont,"Hack") .")<br />";
							}
							if (strpos($file_cont,"curl_init")!==false){
							echo "<strong style='color:#ff0000;'>$all_path</strong> - curl_init (" .mb_substr_count($file_cont,"curl_init") .") ";

							if (unlink($all_path)){
               		echo "<strong style='color:#009900;'>удалено!</strong><br />";
               		}
               		else
               		{
               		 echo "<strong style='color:#ff0000;'>не удалось удалить!</strong><br />";
               		}

							}

							if (strpos($file_cont,"iphone")!==false){
							 echo "<strong style='color:#ff0000;'>$all_path</strong> - iphone (" .mb_substr_count($file_cont,"iphone") .")<br />";
							}

							if (strpos($file_cont,"android")!==false){
							 echo "<strong style='color:#ff0000;'>$all_path</strong> - android (" .mb_substr_count($file_cont,"android") .")<br />";
							}


                             if (strpos($file_cont,"HTTP_USER_AGENT")!==false){
							 echo "<strong style='color:#ff0000;'>$all_path</strong> - HTTP_USER_AGENT (" .mb_substr_count($file_cont,"HTTP_USER_AGENT") .")<br />";
							}

 if (strpos($file_cont,"Mailer")!==false){
							 echo "<strong style='color:#ff0000;'>$all_path</strong> - Mailer (" .mb_substr_count($file_cont,"Mailer") .")<br />";
							}




					}
	 if (is_dir($all_path))
	 	{

    //     echo "<a href='find_decoder.php?dir=$all_path&level=".($lvl+1)."' target='_blank'>$all_path</a><br />";
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
       if (!isset($_GET['dir']) and !isset($_GET['level'])){
  check_dir (".",0);
  }
  else
  {
  check_dir ($_GET['dir'],$_GET['level']);
  }
?>