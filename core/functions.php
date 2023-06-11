<?php
	function makeImage($character){
		$path  = "../assets/img/profile/".time().".png";
		$image = imagecreate(200, 200);
		$red   = rand(0, 255);
		$green = rand(0, 255);
		$blue  = rand(0, 255);
		imagecolorallocate($image, $red, $green, $blue);  
		$textcolor = imagecolorallocate($image, 255,255,255);  
		$font = "../assets/fonts/Pokemon.ttf";
		imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);  
		imagepng($image, $path);
		imagedestroy($image);
		return $path;
	}
?>