<?php
	# SETTINGS######################################################################
	
	$width = 100;		//ширина изображения
	$height = 25;		//высота изображения
	
	session_start();
	$code = $_SESSION['text'];
	
	# MAIN #########################################################################	
	
	// Создаем изображение 
	$image = imagecreate($width, $height);
		
	// Регистрируем используемые цвета
	$colorBackgr 	= imagecolorallocate($image, 255, 255, 255);
	$colorText 		= imagecolorallocate($image, 0, 0, 0);
	$colorBorder	= imagecolorallocate($image, 192, 192, 192);
	$colorLine 		= imagecolorallocate($image, 64,64,64);
	
	// заливаем цветом фона 
	imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $colorBackgr);
	imagerectangle($image, 0, 0, $width - 1, $height - 1, $colorBorder);
	
	// рисуем сетку
	for ($i = 0; $i <= $width; $i += 5) imageline($image, $i, 0, $i, $height, $colorBorder);
	for ($i = 0; $i <= $height; $i += 5) imageline($image, 0, $i, $width, $i, $colorBorder);
	
	for ($i = 0; $i < 4; $i++) imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $colorLine);
	
	// выводим текст 
	imagestring($image, 6, 25, 5, $code, $colorText);
	
	header("Content-type: image/png");
	imagepng($image);
?>