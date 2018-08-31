<?php
	error_reporting(0);
	
	# DEFINES ############################################################################
	
	require_once("./includes/config.php");

	if (!isset($_SESSION['lang_encoding'])) $enc = 'utf-8';
		else $enc = $_SESSION['lang_encoding'];
	header("Content-type: text/html; charset=".$enc);

	define("ADMIN_PATH", 'admin/');
	define('FASTTEMPLATES_PATH', 'includes/');
	define('TEMPLATES_PATH', 'template/');
	define('DATABASES_PATH', 'databases/');
	define('MODULES_PATH', 'modules/');
	define('IMAGES_PATH', 'upload/images/');
	define('PREVIEWS_PATH', 'upload/previews/');
	define('UPLOAD_PATH', 'upload/files/');
	define('PAGE_TEMPLATES_PATH', '../page_templates/');
	define('PAGE_MODULES_PATH', '../modules/');

	define("SITE_HOST", getenv("HTTP_HOST"));

	# FUNCTIONS ############################################################################
	
	function isTable($name) {
		$i = 0;
		if ($listTables = db_list_tables())
		while ($i < db_num_rows($listTables)) {
			if ($name == db_tablename($listTables, $i))
				return true;
			$i++;
		}
		return false;
	}
	
	function removeBreaks($str) {
		$str = str_replace("\n", ' | ', $str);
		$str = str_replace("\r", ' ', $str);
		return $str;
	}
	
	// Шифруем строку. $encrypt = false дешифруем
	function crypt_string($str, $encrypt = true) {
		if ($encrypt) {
			$crypt_str = base64_encode($str);
			$crypt_str = urlencode($crypt_str);
			return $crypt_str;
		} else {
			$str = urldecode($str);
			$crypt_str = base64_decode($str);
			return $crypt_str;
		}
		return 0;
	}
	
	function get_ip() {
	    global $REMOTE_ADDR;
	    global $HTTP_X_FORWARDED_FOR, $HTTP_X_FORWARDED, $HTTP_FORWARDED_FOR, $HTTP_FORWARDED;
	    global $HTTP_VIA, $HTTP_X_COMING_FROM, $HTTP_COMING_FROM;
		
	    // Get some server/environment variables values
	    if (empty($REMOTE_ADDR)) {
	        if (!empty($_SERVER) && isset($_SERVER['REMOTE_ADDR'])) {
	            $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
	        }
	        else if (!empty($_ENV) && isset($_ENV['REMOTE_ADDR'])) {
	            $REMOTE_ADDR = $_ENV['REMOTE_ADDR'];
	        }
	        else if (@getenv('REMOTE_ADDR')) {
	            $REMOTE_ADDR = getenv('REMOTE_ADDR');
	        }
	    } // end if
	    if (empty($HTTP_X_FORWARDED_FOR)) {
	        if (!empty($_SERVER) && isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	            $HTTP_X_FORWARDED_FOR = $_SERVER['HTTP_X_FORWARDED_FOR'];
	        }
	        else if (!empty($_ENV) && isset($_ENV['HTTP_X_FORWARDED_FOR'])) {
	            $HTTP_X_FORWARDED_FOR = $_ENV['HTTP_X_FORWARDED_FOR'];
		        }
	        else if (@getenv('HTTP_X_FORWARDED_FOR')) {
	            $HTTP_X_FORWARDED_FOR = getenv('HTTP_X_FORWARDED_FOR');
	        }
	    } // end if
	    if (empty($HTTP_X_FORWARDED)) {
	        if (!empty($_SERVER) && isset($_SERVER['HTTP_X_FORWARDED'])) {
	            $HTTP_X_FORWARDED = $_SERVER['HTTP_X_FORWARDED'];
	        }
	        else if (!empty($_ENV) && isset($_ENV['HTTP_X_FORWARDED'])) {
	            $HTTP_X_FORWARDED = $_ENV['HTTP_X_FORWARDED'];
	        }
	        else if (@getenv('HTTP_X_FORWARDED')) {
	            $HTTP_X_FORWARDED = getenv('HTTP_X_FORWARDED');
	        }
	    } // end if
	    if (empty($HTTP_FORWARDED_FOR)) {
	        if (!empty($_SERVER) && isset($_SERVER['HTTP_FORWARDED_FOR'])) {
	            $HTTP_FORWARDED_FOR = $_SERVER['HTTP_FORWARDED_FOR'];
	        }
	        else if (!empty($_ENV) && isset($_ENV['HTTP_FORWARDED_FOR'])) {
	            $HTTP_FORWARDED_FOR = $_ENV['HTTP_FORWARDED_FOR'];
	        }
	        else if (@getenv('HTTP_FORWARDED_FOR')) {
	            $HTTP_FORWARDED_FOR = getenv('HTTP_FORWARDED_FOR');
	        }
	    } // end if
	    if (empty($HTTP_FORWARDED)) {
	        if (!empty($_SERVER) && isset($_SERVER['HTTP_FORWARDED'])) {
	            $HTTP_FORWARDED = $_SERVER['HTTP_FORWARDED'];
	        }
	        else if (!empty($_ENV) && isset($_ENV['HTTP_FORWARDED'])) {
	            $HTTP_FORWARDED = $_ENV['HTTP_FORWARDED'];
	        }
	        else if (@getenv('HTTP_FORWARDED')) {
	            $HTTP_FORWARDED = getenv('HTTP_FORWARDED');
	        }
	    } // end if
	    if (empty($HTTP_VIA)) {
	        if (!empty($_SERVER) && isset($_SERVER['HTTP_VIA'])) {
	            $HTTP_VIA = $_SERVER['HTTP_VIA'];
	        }
	        else if (!empty($_ENV) && isset($_ENV['HTTP_VIA'])) {
	            $HTTP_VIA = $_ENV['HTTP_VIA'];
	        }
	        else if (@getenv('HTTP_VIA')) {
	            $HTTP_VIA = getenv('HTTP_VIA');
	        }
	    } // end if
	    if (empty($HTTP_X_COMING_FROM)) {
	        if (!empty($_SERVER) && isset($_SERVER['HTTP_X_COMING_FROM'])) {
	            $HTTP_X_COMING_FROM = $_SERVER['HTTP_X_COMING_FROM'];
	        }
	        else if (!empty($_ENV) && isset($_ENV['HTTP_X_COMING_FROM'])) {
	            $HTTP_X_COMING_FROM = $_ENV['HTTP_X_COMING_FROM'];
	        }
	        else if (@getenv('HTTP_X_COMING_FROM')) {
	            $HTTP_X_COMING_FROM = getenv('HTTP_X_COMING_FROM');
	        }
	    } // end if
	    if (empty($HTTP_COMING_FROM)) {
	        if (!empty($_SERVER) && isset($_SERVER['HTTP_COMING_FROM'])) {
	            $HTTP_COMING_FROM = $_SERVER['HTTP_COMING_FROM'];
	        }
	        else if (!empty($_ENV) && isset($_ENV['HTTP_COMING_FROM'])) {
	            $HTTP_COMING_FROM = $_ENV['HTTP_COMING_FROM'];
	        }
	        else if (@getenv('HTTP_COMING_FROM')) {
	            $HTTP_COMING_FROM = getenv('HTTP_COMING_FROM');
	        }
	    } // end if
		
	    // Gets the default ip sent by the user
	    if (!empty($REMOTE_ADDR)) {
	        $direct_ip = $REMOTE_ADDR;
	    }
		
	    // Gets the proxy ip sent by the user
	    $proxy_ip = '';
	   	if (!empty($HTTP_X_FORWARDED_FOR)) {
	        $proxy_ip = $HTTP_X_FORWARDED_FOR;
	    } else if (!empty($HTTP_X_FORWARDED)) {
	        $proxy_ip = $HTTP_X_FORWARDED;
	    } else if (!empty($HTTP_FORWARDED_FOR)) {
	        $proxy_ip = $HTTP_FORWARDED_FOR;
	    } else if (!empty($HTTP_FORWARDED)) {
	        $proxy_ip = $HTTP_FORWARDED;
	    } else if (!empty($HTTP_VIA)) {
	        $proxy_ip = $HTTP_VIA;
	    } else if (!empty($HTTP_X_COMING_FROM)) {
	        $proxy_ip = $HTTP_X_COMING_FROM;
	    } else if (!empty($HTTP_COMING_FROM)) {
	        $proxy_ip = $HTTP_COMING_FROM;
	    } // end if... else if...
		
	   // Returns the true IP if it has been found, else FALSE
	    if (empty($proxy_ip)) {
	        // True IP without proxy
	        return $direct_ip;
	    } else {
	        $is_ip = preg_match('|^([0-9]{1,3}\.){3,3}[0-9]{1,3}|', $proxy_ip, $regs);
	        if ($is_ip && (count($regs) > 0)) {
	            // True IP behind a proxy
	            return $regs[0];
	        } else {
	            // Can't define IP: there is a proxy but we don't have
	            // information about the true IP
	            return FALSE;
	        }
	    } // end if... else...
	}
	
	function getImage($id) {
		$result = db_query("SELECT * FROM images WHERE id = ".$id." LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			
			if ($row['width'] == 0 || $row['height']) {
				if (file_exists(IMAGES_PATH.$row['url'])) {
					$size = getimagesize(IMAGES_PATH.$row['url']);
					$row['width'] = $size[0];
					$row['height'] = $size[1];
				}
			}
			
			if ($row['thumb_width'] == 0 || $row['thumb_height'] == 0) {
				if (file_exists(PREVIEWS_PATH.$row['url'])) {
					$size = getimagesize(PREVIEWS_PATH.$row['url']);
					$row['thumb_width'] = $size[0];
					$row['thumb_height'] = $size[1];
				}
			}
			
			// !!! ------------------------------
			
			return $row;
		} else {
			$image = array("id" => 0, "group_id" => 0, "page_id" => 0, "title" => "", "type" => "", "url" => "", "width" => 0, "height" => 0, "thumb_width" => 0, "thumb_height" => 0);
			return $image;
		}
	}
	
	function modifyImagesPath($str) { 
		$str = preg_replace("/(?:http\:\/\/[a-zA-Z.]+){0,1}[\/]{0,1}admin\/upload\/(images|previews)\/([0-9]+)([a-zA-Z.]+)/e", "newImagePath('\\1', '\\2', '\\3');", $str);
		return $str;
	}
	
	function newImagePath($el1, $el2, $el3){
		 return "upload/".$el1."/".$el2.$el3;
	}
	
	function strip_quotes($str) {
		$str = str_replace("&quot;", "\"", $str);
		return $str;
	}
	
	function strip_slashes($str) {
		if (get_magic_quotes_gpc()) {
			return stripslashes($str);
		}
		return $str;
	}

	function add_slashes($str) {
		$str = add_quotes($str);
		if (!get_magic_quotes_gpc()) {
			return addslashes($str);
		}
		return $str;
	}
	
	function add_quotes($str) {
		$str = str_replace("\"", "&quot;", $str);
		return $str;
	}
	
	function getDirFiles($path, $folders = false) {
		$dirHandle = opendir($path);
		while ($filename = readdir($dirHandle)) {
			if ($filename != '.' && $filename != '..') {
				if ($folders == true) {
					if (is_dir($path.$filename)) $result[] = $filename;
				} else {
					$result[] = $filename;
				}
			}
		}

		return $result;
	}
	
	function assignList($assignTo, $valuesArray, $selectedValue = '', $fieldName = '') {
		$option = '';

		if (count($valuesArray)) {
			if (!is_array($selectedValue)) {
				foreach ($valuesArray as $value => $label) {
					if ($value == $selectedValue)
						$selected = ' selected';
					else
						$selected = '';
						
					$option .= '<option value="'.$value.'"'.$selected.'>'.$label.'</option>';
				}
			} else {
				foreach ($valuesArray as $value => $label) {
					if (isset($selectedValue[$value]))
						$checked = 'checked';
					else
						$checked = '';

					$option .= '<input type="checkbox" name="'.$fieldName.'['.$value.']" value="1" '.$checked.'>'.$label.'</option><br>';
				}
			}
		}

		$GLOBALS['tpl']->assign($assignTo, $option);
	}
?>