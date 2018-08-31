<?php	
	ob_start("ob_gzhandler", 9);
	
	require_once("./includes/common.php");
	require_once("./includes/db_init.php");
	
	# VARS ##################################################################################
	
	$fileTypes = array('docx', 'txt', 'rtf', 'pdf', 'xls', 'xml', 'htm', 'html', 'swf', 'zip', 'rar', 'mht', 'wmv', 'avi', 'mp4'); 
	
	# FUNCTIONS #############################################################################
	
	function safeFilename($filename) {
		$filename = str_replace(" ", "_", $filename);
		
		// абвгдеёжзийклмнопрстуфхцчшщьыъэюя
		$trans_lower = array("а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e",
					   "ё" => "e", "ж" => "j", "з" => "z", "и" => "i", "й" => "i", "к" => "k",
					   "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
					   "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h", "ц" => "c",
					   "ч" => "ch", "ш" => "sh", "щ" => "sh", "ь" => "", "ы" => "y", "ъ" => "",
					   "э" => "e", "ю" => "yu", "я" => "ya");
					   
		$trans_upper = array("А" => "a", "Б" => "b", "В" => "v", "Г" => "g", "Д" => "d", "Е" => "e",
					   "Ё" => "e", "Ж" => "j", "З" => "z", "И" => "i", "Й" => "i", "К" => "k",
					   "Л" => "l", "М" => "m", "Н" => "n", "О" => "o", "П" => "p", "Р" => "r",
					   "С" => "s", "Т" => "t", "У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "c",
					   "Ч" => "ch", "Ш" => "sh", "Щ" => "sh", "Ь" => "", "Ы" => "y", "Ъ" => "",
					   "Э" => "e", "Ю" => "yu", "Я" => "ya");
		
		$filename = strtr($filename, $trans_lower);
		$filename = strtr($filename, $trans_upper);
		
		return $filename;
	}
	
	# MAIN ##################################################################################
		
	$verifyToken = md5('unique_salt' . $_POST['timestamp']);
	
	if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
		// Проверяем допустимый тип файла и присваиваем правильное расширение
		$fileParts = pathinfo($_FILES['Filedata']['name']);
		if (in_array($fileParts['extension'], $fileTypes)) {
			$filename = $_FILES['Filedata']['name'];
			$tmp_filename = $_FILES['Filedata']['tmp_name'];

			$newFileName = iconv("UTF-8", "CP1251", $filename);
			$newFileName = safeFilename($filename);
			
			$ret = copy($tmp_filename, UPLOAD_PATH.strip_slashes($newFileName));
		} else {
			echo 'Invalid file type.';
		}
	}
?>