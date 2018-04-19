<?
// файл должен принимать параметры:
//		$dst - путь где должен быть файло
//		$name - ФАЙЛ-оригинал
//		$w - ширина создаваемой иконки
//		$h - высота создаваемой иконки
//		$cut - обрезать изображения, или нет
//		$bgcolor - цвет фона подложки
//
//
	require("functions/main.func.php");
	$dst = $_GET['dst'];
$photo_cut = $_GET["cut"];
$max_photothumb_small=$_GET["h"];
$max_photothumb_big=$_GET["w"];
$source_src = $_GET['name'];
$preview_color = $_GET['bgcolor'];


header("Content - type: image/jpg");
$params = getimagesize($source_src);

if ($params[2]!=1 and $params[2]!=2 and $params[2]!=3)
{
die();
}
switch ( $params[2] ) 
	{
  case 1: $source = imagecreatefromgif($source_src); break;
  case 2: $source = imagecreatefromjpeg($source_src); break;
  case 3: $source = imagecreatefrompng($source_src); break;
	}
	$img_ratio = $params[0]/$params[1];
if ($photo_cut==1)
	{
	if ($params[0]>$max_photothumb_big || $params[1]>$max_photothumb_big)
	{
			
				if($params[0]>$params[1])
					{
				$resource_height = $max_photothumb_small;
				$resource_width = $resource_height*$img_ratio;
					}
					else
					{
						$resource_width = $max_photothumb_big;
						$resource_height = $resource_width/$img_ratio;
					}
			}
			else
			{
			$resource_width = "$params[0]";
			$resource_height = "$params[1]";
			}
		$resource = imagecreatetruecolor($resource_width, $resource_height);
			imagecopyresampled($resource, $source, 0, 0, 0, 0, $resource_width, $resource_height, $params[0], $params[1]);
			
	$resource2 = imagecreatetruecolor($max_photothumb_big, $max_photothumb_small);
			//imagecopyresampled($resource, $source, 0, 0, ($params[0]-$max_photothumb_big) -($params[0]-$max_photothumb_big)/2, 0,$resource_width, $resource_height, $params[0], $params[1]);
			imagecopy ($resource2, $resource, 0, 0, ceil(($resource_width-$max_photothumb_big)/2), ceil(($resource_height-$max_photothumb_small)/2), $resource_width, $resource_height);
			  $resource_src = "$dst";
				if (!imagejpeg($resource2, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}
			
	}
	else
	{
	
	if ($params[0]>$max_photothumb_big || $params[1]>$max_photothumb_big)
	{
			if ($params[0]>$params[1])
				{
				
				$resource_width = $max_photothumb_big;
				$resource_height = $resource_width/$img_ratio;
					if ($resource_height>$max_photothumb_small)
						{
						$resource_height = $max_photothumb_small;
						$resource_width = $resource_height*$img_ratio;
						}
				}
				else
				{
				$resource_height= $max_photothumb_big;
				$resource_width  = $resource_height*$img_ratio;
					if ($resource_width>$max_photothumb_small)
						{
						$resource_width = $max_photothumb_small;
						$resource_height = $resource_width/$img_ratio;
						}
				}
			}
			else
			{
			$resource_width = "$params[0]";
			$resource_height = "$params[1]";
			}
			$resource_width =ceil($resource_width);
			$resource_height =ceil($resource_height);
				// Создаем доп. изображение
					$resource2 =  imagecreatetruecolor($max_photothumb_big, $max_photothumb_small);
					$color = hex2RGB($preview_color);
					 $color = imagecolorallocate ( $resource2, $color['red'], $color['green'], $color['blue']);
						imagefill ( $resource2 , 0 , 0 ,  $color );
						
			$resource = imagecreatetruecolor($resource_width, $resource_height);
			imagecopyresampled($resource, $source, 0, 0, 0, 0, $resource_width, $resource_height, $params[0], $params[1]);
		
			imagecopy ($resource2, $resource,floor(($max_photothumb_big-$resource_width)/2), floor(($max_photothumb_small-$resource_height)/2), 0, 0, $resource_width, $resource_height);
			  $resource_src = "$dst";
				if (!imagejpeg($resource2, $resource_src))
					{
					echo "Не удалось сохранить файл!<br />";
						return false;
					}
	}
imagejpeg($resource2,"",100);
	unset($resource);
	unset($resource2);
?>