<?php
class watermark{

 function rotateImage($image) {
      $width = imagesx($image);
      $height = imagesy($image);
      $newImage= imagecreatetruecolor($height, $width);
      imagealphablending($newImage, false);
      imagesavealpha($newImage, true);
      for($w=0; $w<$width; $w++)
          for($h=0; $h<$height; $h++) {
              $ref = imagecolorat($image, $w, $h);
              imagesetpixel($newImage, $h, ($width-1)-$w, $ref);
          }
      return $newImage;
  }
  
        function create_watermark( $main_img_obj, $watermark_img_obj) {


                $main_img_obj_w        = imagesx( $main_img_obj );
                $main_img_obj_h        = imagesy( $main_img_obj );
                $watermark_img_obj_w        = imagesx( $watermark_img_obj );
                $watermark_img_obj_h        = imagesy( $watermark_img_obj );
						
						if ($watermark_img_obj_w >$main_img_obj_w)
						{
$watermark_img_obj =  $this->rotateImage($watermark_img_obj);
						}
						
 				$watermark_img_obj_w        = imagesx( $watermark_img_obj );
                $watermark_img_obj_h        = imagesy( $watermark_img_obj );
				
                $main_img_obj_min_x        = floor( ( $main_img_obj_w ) - ( $watermark_img_obj_w ) );
                $main_img_obj_max_x        = ceil( ( $main_img_obj_w  ) + ( $watermark_img_obj_w ) );
                $main_img_obj_min_y        = floor( ( $main_img_obj_h ) - ( $watermark_img_obj_h ) );
                $main_img_obj_max_y        = ceil( ( $main_img_obj_h ) + ( $watermark_img_obj_h ) );


                $return_img        = imagecreatetruecolor( $main_img_obj_w, $main_img_obj_h );
				imagecopy ($return_img,$main_img_obj,0,0,0,0,$main_img_obj_w,$main_img_obj_h);
				imagecopy ($return_img,$watermark_img_obj,$main_img_obj_min_x,$main_img_obj_min_y,0,0, $watermark_img_obj_w, $watermark_img_obj_h);
                return $return_img;

        }

} 
?>