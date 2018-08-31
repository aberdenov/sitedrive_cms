<?php
	error_reporting(E_ALL);
	//set_magic_quotes_runtime(0);

	if (!defined('IN_SITEDRIVE')) { die("Hacking attempt"); }

	# DEFINES ###############################################################################

	define("PATH_PREFIX", './admin/');
	define("DATABASES_PATH", 'databases/');
	define("PAGETEMPLATES_PATH", 'page_templates/');
	define("INCLUDES_PATH", './admin/includes/');
	define("ROWS_PER_PAGE", 50);
	define("SITE_HOST", getenv("HTTP_HOST"));
	define("SITE_URL", "http://".getenv("HTTP_HOST").$_SERVER['PHP_SELF']);
	define("PHP_VER", substr(PHP_VERSION, 0, 1));

	# INCLUDES ##############################################################################

	require_once (PATH_PREFIX . "includes/db_config.php");
	require_once (PATH_PREFIX . DATABASES_PATH . DB_TYPE);

	# VARS ##################################################################################

	$_MONTHS_RU = array ( 1=>
		'ÑÐ½Ð²Ð°Ñ€Ñ',
		'Ñ„ÐµÐ²Ñ€Ð°Ð»Ñ',
		'Ð¼Ð°Ñ€Ñ‚Ð°',
		'Ð°Ð¿Ñ€ÐµÐ»Ñ',
		'Ð¼Ð°Ñ',
		'Ð¸ÑŽÐ½Ñ',
		'Ð¸ÑŽÐ»Ñ',
		'Ð°Ð²Ð³ÑƒÑÑ‚Ð°',
		'ÑÐµÐ½Ñ‚ÑÐ±Ñ€Ñ',
		'Ð¾ÐºÑ‚ÑÐ±Ñ€Ñ',
		'Ð½Ð¾ÑÐ±Ñ€Ñ',
		'Ð´ÐµÐºÐ°Ð±Ñ€Ñ'
	);
	
	$_MONTHS_EN = array ( 1=>
		'january',
		'february',
		'march',
		'april',
		'may',
		'june',
		'july',
		'august',
		'september',
		'october',
		'november',
		'december'
	);
	
	$_MONTHS_KZ = array ( 1=>
		'Ò›Ð°Ò£Ñ‚Ð°Ñ€',
		'Ð°Ò›Ð¿Ð°Ð½',
		'Ð½Ð°ÑƒÑ€Ñ‹Ð·',
		'ÑÓ™ÑƒÑ–Ñ€',
		'Ð¼Ð°Ð¼Ñ‹Ñ€',
		'Ð¼Ð°ÑƒÑÑ‹Ð¼',
		'ÑˆÑ–Ð»Ð´Ðµ',
		'Ñ‚Ð°Ð¼Ñ‹Ð·',
		'Ò›Ñ‹Ñ€ÐºÒ¯Ð¹ÐµÐº',
		'Ò›Ð°Ð·Ð°Ð½',
		'Ò›Ð°Ñ€Ð°ÑˆÐ°',
		'Ð¶ÐµÐ»Ñ‚Ð¾Ò›ÑÐ°Ð½'
	);
	
	# FUNCTIONS #############################################################################
	
	// Ïðîâîäèò èíèöèàëèçàöèþ è ïðîâåðêó ñèñòåìíûõ ïåðåìåííûõ
 	function Initialize(&$param_array) {
		//$old_error_handler = set_error_handler("debug_error_handler");
		$array = array('page_id', 'lang', 'page', 'article_id', 'news_id', 'poll_id', 'gallery_id', 'image', 'parent_id');
		if (is_array($param_array)) {
			foreach ($param_array as $key => $val) {	
				$varname = preg_match("/^page_[0-9]+$/", $key);
				if ($varname > 0) $array[] = $key;				
			}					
		}
		initVars($array, 'int', $param_array);
	}
	
	// Ïðîâåðÿåò ïàðàìåòð íà äîïóñòèìûå ñèìâîëû (ïðîâåðêà òèïà)
	// param: ïàðàìåòð [string], type: òèï [string] int òîëüêî öèôðû; string - áóêâû, öèôðû è íèæíåå ïîä÷åðêèâàíèå
	function validateParam($param, $type) {
		switch ($type) {
			case 'int': {
				if (preg_match("/^[0-9]+$/", $param)) return true;
				break;
			}
			case 'string': {
				if (preg_match("/^[a-zA-Z0-9_@.]+$/", $param)) return true;
				break;
			}
		}
		
		return false;
	}
	
	// Ïðîâåðêà óêàçàííûõ ïåðåìåííûõ íà ñîîòâåòñòâèå òèïó è ïðèâåäåíèå ê áåçîïàñíîìó âèäó
	function initVars($param_array, $type, &$arr) {
		if (is_array($param_array)) {
			foreach ($param_array as $varname) {
				if (isset($arr[$varname])) {
					if (!validateParam($arr[$varname], $type)) {
						selfRedirect();
					} else {
						if ($type == 'int') $arr[$varname] = abs(intval($arr[$varname]));
						if ($type == 'string') $GLOBALS[$array_name][$val] = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $GLOBALS[$array_name][$val]);
					}
				}
			}
		}
	}
	
	// Èíèöèàëèçàöèÿ è ïðèâåäåíèå ïåðåìåííîé ê óêàçàííîìó òèïó
	function initVar($value_name, $type) {
		if ($type == 'int') $result = 0;
		if ($type == 'string') $result = '';
		if ($type == 'bool') $result = false;
		
		if (isset($_REQUEST[$value_name])) {
			switch ($type) {
				case 'int': {
					$result = $_REQUEST[$value_name];
					if (is_numeric($result)) $result = abs(intval($result)); else $result = 0;
					break;
				}
				case 'string': {
					$result = $_REQUEST[$value_name];
					$result = str_replace(array("\n", "\r"), "", $result);
					$result = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $result);
					break;
				}
				case 'bool': {
					$result = true;
					break;
				}
				default: {
					$result = false;
					break;
				}
			}
		}
		
		return $result;
	}
	
	// Ïåðåãðóæàåò ñòðàíèöó íà ïðåäûäóùóþ, åñëè óêàçàííûé ïàðàìåòð íå ñîâïàäàåò ñ íåîáõîäèìûì òèïîì
	function redirectIsBad($param, $type) {
		if (is_array($param)) {
			foreach ($param as $val) {
				if (!validateParam($val, $type)) selfRedirect();
			}
		} else {
			if (!validateParam($param, $type)) selfRedirect();
		}
	}
	
	// Ïðîèçâîäèò îáðàòíîå ñëýøèðîâàíèå ñòðîêè èëè ìàññèâà ñòðîê
	function adds(&$el,$level=0) {
	  if (is_array($el)) {
	    if (get_magic_quotes_gpc()) return;
	    foreach($el as $k=>$v) adds($el[$k],$level+1);
	  } else { 
	    if (!get_magic_quotes_gpc()) $el = addslashes($el);
	    if (!$level) return $el;
	  }
	}

	// Ïåðåãðóæàåò ñòðàíèöó
	function selfRedirect($params='') {
		if (!isset($GLOBALS['_SERVER']["HTTP_REFERER"])) {
			header("Location: page.php");
		}
		else
			header("Location: " . $GLOBALS['_SERVER']["HTTP_REFERER"] . $params);
		exit;
	}

	// Ïåðåãðóæàåò ñòðàíèöó ñ íîâûìè ïàðàìåòðàìè url
	function pageReload($params = '') {
		if (empty($params)) {
			header("Location: ".$GLOBALS['_SERVER']["REQUEST_URI"]);
			exit;
		}
		
		$pos      = strpos($params, "#");
		$fragment = substr($params, $pos, strlen($params)-$pos);
		$params   = str_replace($fragment, "", $params);
		
		parse_str($GLOBALS['_SERVER']["QUERY_STRING"], $url_params);
		parse_str($params, $str_params);
		
		foreach ($url_params as $key => $val) {
			if (isset($str_params[$key])) {
				$url_params[$key] = $str_params[$key];
				unset($str_params[$key]);
			}
		}
		
		$param_array = array_merge($url_params, $str_params);
		
		$url = "";
		$i = 0;
		$count = count($param_array);
		
		foreach ($param_array as $key => $val) {
			$i++;
			$url.= $key."=".$val;
			if ($i < $count) $url.= "&";
		}
		
		$url = SITE_URL."?".$url.$fragment;
		
		header("Location: ".$url);
		exit;
	}

	// Ïðîâåðÿåò ñóùåñòâóåò ëè èçîáðàæåíèå ñ óêàçàííûì ID
	function isImageExists($id) {
		$result = db_query("SELECT * FROM images WHERE id = ".$id." LIMIT 1");
		if (db_num_rows($result) > 0) return true;
		
		return false;
	}

	// Âîçâðàùàåò URL èçîáðàæåíèÿ
	function getImageUrl($id, $is_image = '') {
		$file = '';
		$result = db_query("SELECT type, url FROM images WHERE id=".$id." LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_object($result);
			if ($is_image) {
				$file = "upload/images/".$row->url;
			} else {
				$file = "upload/previews/".$row->url;
				if (!file_exists($file)) $file = '';
			}
		}
		
		return $file;
	}

	// Âûâîäèò ñîîáùåíèå
	function showMessage($messageType, $location='') {
		if (!$location) $location = $GLOBALS['_SERVER']["HTTP_REFERER"];
		$location = urlencode($location);
		header("Location: page.php?page_id=29&sender=$location&message=$messageType");
		exit;
	}

	// Îòîáðàæàåì ñîîáùåíèå î ïðîäåëàííîé îïåðàöèè
	function showResult($text, $css_class) {
		$result = '<div class="'.$css_class.'" align="center">'.$text.'</div>';
		return $result;
	}

	// Ôîðìèðóåò âûïàäàþùèé ñïèñîê èç ìàññèâà çíà÷åíèé
	function assignList($assignTo, $valuesArray, $selectedValue = '', $fieldName = '') {
		$option = '';
		if (is_array($valuesArray)) {
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

	function assignRadioList($assignTo, $valuesArray, $selectedValue = '', $fieldName = '') {
		$option = '';
		if (is_array($valuesArray)) {
			foreach ($valuesArray as $value => $label) {
				if ($value == $selectedValue)
					$checked = 'checked';
				else
					$checked = '';
				$option .= '<input type="radio" name="'.$fieldName.'" value="'.$label.'" '.$checked.'>&nbsp;'.$label.'</option><br>';
			}
		}
		$GLOBALS['tpl']->assign($assignTo, $option);
	}

	// Èíèöèàëèçèðóåò ãëîáàëüíûå ïåðåìåííûå page_id è lang
	function setValidPage() {
		if (!isset($_GET['lang']) && !isset($_GET['page_id'])) {
			$lang_id = db_get_data("SELECT id FROM languages WHERE main = 1 AND blocked = 0", "id");
			$_GET['lang'] = abs($lang_id);
		}
		
		if (!isset($_GET['page_id'])) {
			$start_page = getStartPage();
			if ($start_page == 0) {
				$first_page = db_get_data("SELECT id FROM pages WHERE lang_id = '".$_GET['lang']."' ORDER BY id LIMIT 1", "id");
				$_GET['page_id'] = abs($first_page);
			} else {
				$_GET['page_id'] = $start_page;
			}
		} else {
			$lang_id = db_get_data("SELECT lang_id FROM pages WHERE id = '".$_GET['page_id']."' LIMIT 1", "lang_id");
			$_GET['lang'] = abs($lang_id);
		}		
	}

	// Îòîáðàæàåò äàòó â óêàçàííîì ôîðìàòå
  	function showDate($format, $date) {
		if (strpos($date, ":")) {
			ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $date, $regs);
			$time = mktime($regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1]);
		} else {
			ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date, $regs);
			$time = mktime(0, 0, 0, $regs[2], $regs[3], $regs[1]);
		}
		return date($format, $time);
  	}

  	// Ïåðåâîäèò ñòðîêó datetime â ìàññèâ datetime
  	function getFromDate($date) {
		$result = array();
		ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})", $date, $regs);
		$result['year'] = $regs['1'];
		$result['month'] = abs($regs['2']);
		$result['day'] = abs($regs['3']);
		$result['hour'] = $regs['4'];
		$result['minute'] = $regs['5'];
		$result['second'] = $regs['6'];
		return $result;
	}

  	// Âîçâðàùàåò äàòó â ôîðìàòå "j F Y"
	function showNormalDate($date) {
		$result = showDate("j F Y", $date);
		$engMonths = array(1=>
				'January',
				'February',
				'March',
				'April',
				'May',
				'June',
				'July',
				'August',
				'September',
				'October',
				'November',
				'December',
			);
		$result = str_replace($engMonths, $GLOBALS['_MONTHS'], $result);
		return $result;
	}

  	// Ïðîèçâîäèò óäàëåíèå ñèìâîëîâ "['\"\\]" èç ñòðîêè ëèìèòèðóåò äî óêàçàííîé äëèíû
	function makeSafeString($string, $length = 0) {
		$string = ereg_replace("['\"\\]", '', $string);
		if (isset($length))
			$string = substr($string, 0, $length);
		return $string;
	}

	// Âîçâðàùàåò èíôîðìàöèþ î èçîáðàæåíèè
	function getImage($id) {
		$result = db_query("SELECT * FROM images WHERE id = ".$id." LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row;
		}
	}
	
	// Âîçâðàùàåò çíà÷åíèå ïàðàìåòðà â óêàçàííîé ñòðîêå ïàðàìåòðîâ
	function parseParams($str, $var) {
		ereg(" ".$var."=([a-z0-9]+) ", $str, $regs);
	  if (isset($regs[1])) return $regs[1];
	}
	
	// Âîçâðàùàåò HTML òýã èçîáðàæåíèÿ
	function getImageTag($id, $align, $size = 1) {
		$tag = '';
		$result = db_query("SELECT * FROM images WHERE id = ".$id." LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			
			if (strtolower($row['type']) == 'swf') {
				$flashFile = "admin/upload/images/".$row['url'];
				$str = str_replace(" ", "&", $align);
				parse_str($str, $out);
				if (@$out['width'] > 0 && @$out['height'] > 0) {
					$width = $out['width'];
					$height = $out['height'];
				} else {
					$size = getimagesize($flashFile);
					$width = $size[0];
					$height = $size[1];
				}
				
				$tag = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="'.$width.'" height="'.$height.'">';
			   	$tag.= '<param name="bgcolor" VALUE="#FFFFFF">';
			   	$tag.= '<param name="movie" value="'.$flashFile.'">';
			   	$tag.= '<param name="quality" value="high">';
				$tag.= '<param name="menu" value="false">';
			   	$tag.= '<embed src="'.$flashFile.'" menu="false" quality="high" BGCOLOR="#FFFFFF" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'"></embed>';
			   	$tag.= '</object>';
			} else {
				if ($row['width'] && $row['height'] && $size == 1) $params = ' width="'.$row['width'].'" height="'.$row['height'].'"';
					else $params = '';
				
				if (!empty($align)) $params .= ' '.$align;
				if (empty($params)) $border = ' border="0"'; else $border = '';
				
				if ($size == 2) {
					$tag = '<img src="admin/upload/previews/'.$row['url'].'"'.$border.$params.' onclick="showPhoto(\'admin/upload/images/'.$row['url'].'\', '.$row['width'].', '.$row['height'].', \''.$row['title'].'\')" style="cursor: hand;">';
				} else {
					$tag = '<img src="admin/upload/images/'.$row['url'].'"'.$border.$params.'>';
				}
			}
		}
		
		return $tag;
	}

  // Ïðåîáðàçîâûâàåò ñïåö òýãè <IMAGE> â îáû÷íûå <IMG SRC>
  function addImages($str) {
		$str = str_replace("upload/images", "admin/upload/images", $str);
		//$str = preg_replace("/(?:(?:\<IMAGE=)|(?:\<image=))[\\\]{0,1}[\'\"]{0,1}(?:&quot;){0,1}([0-9]+)[\\\]{0,1}[\'\"]{0,1}(?:&quot;){0,1}[\s](?:sizeimg=)[\\\]{0,1}[\'\"]{0,1}(?:&quot;){0,1}([0-9])[\\\]{0,1}[\'\"]{0,1}(?:&quot;){0,1} ([a-zA-Z0-9 =\'\"(?:&quot;);:#]*)\>/e", "getImageTag('\\1', '\\3', '\\2')", $str);
		return $str;
	}

	# EXTENDED API FUNCTIONS #################################################################

	// Âîçâðàùàåò àðãóìåíò èëè ýëåìåíò ìàññèâà ñ óêàçàííûì èíäåêñîì
	function choose() {
		if (func_num_args() < 2) return 'Nothing to choose';
		$index = func_get_arg(0);
		
		if (func_num_args() == 2 && is_array(func_get_arg(1))) {
			$arr = func_get_arg(1);
			if (isset($arr[$index]))
				$result = $arr[$index];
			 else
			    $result = 'Key ['.$index.'] does not exist in array.';
		} else {
			if (func_num_args() > $index)
				$result = func_get_arg($index);
			 else
				$result = 'Wrong parameter count. Argument '.$index.' not passed.';
		}
		
		return $result;
	}

	// Âîçâðàùàåò çàãîëîâîê ñòðàíèöû
	function getPageTitle($page_id, $get_parent = false, $type = '') {
		if ($get_parent) $from_id = 'parent_id'; else $from_id = 'id';
		if ($type != 'all') $where_type = " AND type != 'menu'"; else $where_type = '';
		
		$result = db_query("SELECT title FROM pages WHERE ".$from_id." = ".$page_id.$where_type);
		if (db_num_rows($result) > 0) {
			$row = db_fetch_object($result);
			if ($row->title != '') return $row->title;
				else return 'Empty title';
		}
		return false;
	}

	// Âîçâðàùàåò êîëè÷åñòâî âëîæåííûõ ñòðàíèö
	function getPagesCount($parent_id) {
		return db_get_data("SELECT COUNT(*) AS num FROM pages WHERE parent_id = ".$parent_id." AND lang_id = ".LANG_ID." AND visible = 1", "num");
	}
	
	// Âîçâðàùàåò ID ñòàðòîâîé ñòðàíèöû ñàéòà
	function getStartPage() {
		$result = db_query("SELECT id FROM pages WHERE lang_id = ".$_GET['lang']." AND startpage = 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_object($result);
			return $row->id;
		}
		
		return 0;
	}
	
	// Ïðîâåðÿåò íàëè÷èå óêàçàííîé ñòðàíèöû
	function isPageExists($page_id = 0, $lang_id = 0) {
		/*
		$result = db_query("SELECT * FROM pages WHERE id = ".$page_id." AND lang_id = ".$lang_id." LIMIT 1");
		if (db_num_rows($result) > 0) return true;
			else return false;
		*/
		$result = db_query("SELECT pages.id FROM pages, languages WHERE pages.id = ".$page_id." AND pages.lang_id = ".$lang_id." AND (pages.lang_id = languages.id AND languages.blocked = 0) LIMIT 1");
		if (db_num_rows($result) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Âîçâðàùàåò ID ñëåäóþùåé ñòðàíèöû
	function getNextPageID($start_id, $order_field = 'id') {
		$result = db_query("SELECT id FROM pages WHERE id > ".$start_id." ORDER BY ".$order_field." LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row['id'];
		}
		return 0;
	}
	
	// Âîçâðàùàåò ID ïðåäûäóùåé ñòðàíèöû
	function getPrevPageID($start_id, $order_field = 'id') {
		$result = db_query("SELECT id FROM pages WHERE id < ".$start_id." ORDER BY ".$order_field." DESC LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row['id'];
		}
		return 0;
	}
	
	// Âîçâðàùàåò ID ñëåäóþùåé ñòàòüè
	function getNextArticleID($start_id, $order_field = 'id') {
		$result = db_query("SELECT id FROM module_article WHERE page_id = ".$GLOBALS['HTTP_GET_VARS']['page_id']." AND id > ".$start_id." ORDER BY ".$order_field." LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row['id'];
		}
		return 0;
	}
	
	// Âîçâðàùàåò ID ïðåäûäóùåé ñòàòüè
	function getPrevArticleID($start_id, $order_field = 'id') {
		$result = db_query("SELECT id FROM module_article WHERE page_id = ".$GLOBALS['HTTP_GET_VARS']['page_id']." AND id < ".$start_id." ORDER BY ".$order_field." DESC LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row['id'];
		}
		return 0;
	}
	
	// Ïðîâåðÿåò ñóùåñòâóåò ëè õîòü îäíà ñòàòüÿ äëÿ äàííîé ñòðàíèöå
	function isArticleExists($page_id) {
		$result = db_query("SELECT id FROM module_article WHERE page_id = ".$page_id." LIMIT 1");
		if (db_num_rows($result) > 0) return true;
		return false;
	}

	// Âîçâðàùàåò pade_id ïåðâîé âëîæåííîé ñòðàíèöû
	function getFirstChildID($page_id) {
		$result = db_query("SELECT id FROM pages WHERE parent_id = ".$page_id." ORDER BY sortfield LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row[0];
		}
		
		return 0;
	}
	
	// Âîçâðàùàåò ID ñòðàíèöû óêàçàííîãî òèïà è ÿçûêà
	function getModulePageID($type, $lang = 0) {
		if ($lang == 0) $lang = LANG_ID;
		$result = db_query("SELECT id FROM pages WHERE lang_id = ".$lang." AND type ='".$type."' LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row[0];
		}
		
		return 0;
	}
	
	// Âîçâðàùàåò ID ðîäèòåëüñêîé ñòðàíèöû
	function getPageParentID($page_id) {
		$result = db_query("SELECT parent_id FROM pages WHERE id = ".$page_id." LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row[0];
		}
		
		return 0;
	}
	
	// Âîçâðàùàåò ID ñòðàíèöû ñ óêàçàííûì content, lang è parent_id
	function getPageID($content, $lang, $parent_id = 0) {
		if ($parent_id > 0) $condition = ' AND id = '.$parent_id; else $condition = '';
		$result = db_query("SELECT id FROM pages WHERE content = '".$content."' AND lang_id = ".$lang.$condition." ORDER BY sortfield LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row[0];
		}
		
		return 0;
	}
	
	// Âîçâðàùàåò ID èçîáðàæåíèÿ óêàçàííîé ñòðàíèöû
	function getPageIcon($page_id) {
		$result = db_query("SELECT icon FROM pages WHERE id = ".$page_id." LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row[0];
		}
		
		return 0;
	}
	
	// Âîçâðàùàåò ñòðàíèöó ñ óêàçàííûì ID
	function getPage($page_id) {
  	$result = db_query("SELECT * FROM pages WHERE id = ".$page_id." LIMIT 1");
		if (db_num_rows($result) > 0) {
			$row = db_fetch_array($result);
			return $row;
		}
	}
	
	// Ïîëó÷àåì ññûëêó íà ñòðàíèöó
	function getPageUrl($page, $args = '', $id = 0) {
		if (empty($page) || $id > 0) {
			$page = db_get_data("SELECT id, lang_id, external_link FROM pages WHERE id = ".$id." LIMIT 1");
		}
		
		if (empty($page['external_link'])) $item_url = SITE_URL."?page_id=".$page['id']."&lang=".$page['lang_id'].$args;
			else $item_url = $page['external_link'];
		
		return $item_url;
	}
	
	// Ïðîâåðÿåò ñòàòóñ âèäèìîñòè ñòðàíèöû: true - âèäèìàÿ, false - çàêðûòàÿ
	function isPageVisible($page_id) {
		$result = db_query("SELECT visible FROM pages WHERE id = ".$page_id." AND visible = 1 LIMIT 1");
		if (db_num_rows($result) > 0) return true;
		
		return false;
	}
	
	// Âîçâðàùàåò ñòðîêó íàâèãàöèè çàãîëîâêîâ ñòðàíèö PARENT / CHILD / .. / SUBCHILD
	function getPagesChains($page_id, $delimiter, $css_class, $uri_params) {
		$items = array(1=> array("title" => "", "url" => ""));
		$items[1]['title'] = '<span style="color: #a04205">'.getPageTitle($page_id).'</span>';
		$items[1]['url'] = '';
		
    	$parent_id = getPageParentID($page_id);
		$i = 1;
		
		while ($parent_id > 0) {
			$result = db_query("SELECT * FROM pages WHERE id = ".$parent_id." LIMIT 1");
			if (db_num_rows($result) > 0) {
				$row = db_fetch_array($result);
				$result2 = db_query("SELECT * FROM pages WHERE id = ".$row['id']." LIMIT 1");
				if (db_num_rows($result2) > 0) {
					$i++;
					$row2 = db_fetch_array($result2);
					$parent_id = $row2['parent_id'];
					$items[$i]['title'] = $row['title'];
					$url = 'page.php?page_id='.$row2['id'].'&lang='.$row['lang_id'];
					if (!empty($uri_params)) $url.= '&'.$uri_params;
					$items[$i]['url'] = $url;
				} else { $parent_id = 0; }
			} else { $parent_id = 0; }
		}
		
		$str = '';
		$items_count = count($items);
		if ($items_count > 1) $items_count = $items_count - 1;
		
		for ($i = $items_count; $i > 0; $i--) {
			$title = $items[$i]['title'];
			
			if ($i != 1) $str.= '<a href="'.$items[$i]['url'].'" class="'.$css_class.'">'.$title.'</a>';
				else $str.= $title;
			
			if ($i != 1) $str.= '<span class="ptit">'.$delimiter.'</span>';
		}
		
		return $str;
	}

	// Âîçâðàùàåò ïîðÿäîê ñîðòèðîâêè ñòðàíèöû
	function getPageSort($page) {
		$sort = array("sortField" => "sortfield", "sortOrder" => "ASC");
		
		if (is_array($page)) {
			$sort['sortField'] = $page['sort_by'];
			$sort['sortOrder'] = $page['sort_order'];
		} else {
			$result = db_query("SELECT sort_by, sort_order FROM pages WHERE id = ".$page." LIMIT 1");
			if (db_num_rows($result) > 0) {
				$row = db_fetch_array($result);
				
				$sort['sortField'] = $row['sort_by'];
				$sort['sortOrder'] = $row['sort_order'];
			}
		}
		
		if (empty($sort['sortField'])) $sort['sortField'] = 'sortfield';
		if ($sort['sortOrder'] == 0) $sort['sortOrder'] = "ASC"; else $sort['sortOrder'] = "DESC";
		$order = " ORDER BY ".$sort['sortField']." ".$sort['sortOrder'];
		
		return $order;
	}

	// Ðàáîòà ñî ñòðîêàìè ///////////////////////////////////////////////////////////////////

	// Âîçâðàùàåò ñëó÷àéíûé ïàðîëü íåîáõîäèìîé äëèíû
	function generatePassword($length) {
		$min = $length;   // ìèíèìàëüíàÿ äëèíà ïàðîëÿ
		$max = $length;   // ìàêñèìàëüíàÿ äëèíÿ ïàðîëÿ
		$pwd = ''; 		  // ïàðîëü
		
		for ($i = 0; $i < rand($min, $max); $i++) {
			 $num = rand(48, 122);
			 if (($num > 97 && $num < 122)) {
				 $pwd.= chr($num);
			 } else if (($num > 65 && $num < 90)) {
				 $pwd.= chr($num);
			 } else if (($num > 48 && $num < 57)) {
				 $pwd.= chr($num);
			 } else if ($num == 95) {
				 $pwd.= chr($num);
			 } else {
			 	$i--;
			 }
		}
		
		return $pwd;
	}

	// Ïåðåâîäèò ñòðîêó â âåðõíèé ðåãèñòð
	function strUpper($str) {
		if (function_exists('mb_strtoupper')) {
			$str = mb_strtoupper($str, "UTF-8");
		} else {
		   	$str = strtoupper($str);
	    }
		
		return $str;
 	}

	// Ïåðåâîäèò ñòðîêó â íèæíèé ðåãèñòð
	function strLower($str) {
		if (function_exists('mb_strtolower')) {
			$str = mb_strtolower($str, "UTF-8");
		} else {
		   	$str = strtolower($str);
	    }
		
		return $str;
    }

	// Âûðåçàåò èç ñòðîêè HTML òýãè, îáðåçàåò äî óêàçàííîé äëèíû, ïåðåâîäèò ñïåöèàëüíûå ñèìâîëû â èõ HTML ýêâèâàëåíòû, ñëýøèðóåò êàâû÷êè
	// $tags - âûðåçàòü html òýãè
	// $special - ïðåîáðàçîâûâàòü ñïåöèàëüíûå ñèìâîëû html
	// $slashes - âñòàâëÿòü \ ïåðåä êàâû÷êàìè
	// $crop - îáðåçàòü ñòðîêó íà óêàçàííîå êîëè÷åñòâî ñèìâîëîâ
	function safy_text(&$val, $tags, $crop, $special, $slashes) {
		if ($tags) $val = strip_tags($val);
		if ($crop > 0) $val = substr($val, 0, $crop);
		if ($special) $val = htmlspecialchars($val);
		if ($slashes) $val = addslashes($val);
		
		return $val;
	}
	
	// Âîçâðàùàåò ñòðîêó èëè ìàññèâ ñòðîê îáðàáîòàííûõ ôóíêöèåé safy_text
	function makeSafeText($object, $tags = true, $special = true, $slashes = false, $crop = 0) {
		if (is_array($object)) {
			foreach ($object as $key => $value) {
    			if (is_array($value)) {
					foreach ($value as $key2 => $value2) {
							safy_text($value[$key2], $tags, $crop, $special, $slashes);
					}
				} else {
					safy_text($object[$key], $tags, $crop, $special, $slashes);
				}
			}
		} else {
			safy_text($object, $tags, $crop, $special, $slashes);
		}
		
		return $object;
	}
	
	// Óáèðàåò èç ñòðîêè âñå ñïåöñèìâîëû
	function safe_string($text, $from_charset = 'UTF-8', $to_charset = 'CP1251') {
		$text = iconv($from_charset, $to_charset, $text);
		ereg("([0-9a-zA-Zà-ÿÀ-ß ]*)", $text, $regs);
		$text = iconv($to_charset, $from_charset, $regs[0]);
		return $text;
	}
	
	// Âîçâðàùàåò ôðàãìåíò ñòðîêè óêàçàííîé äëèíû, ñëåâà
	function strLeft($str, $length) {
		$str = mb_substr($str, 0, $length, "UTF-8");
		return $str;
	}
	
	// Âîçâðàùàåò ôðàãìåíò ñòðîêè óêàçàííîé äëèíû, ñïðàâà
	function strRight($str, $length) {
		$str = mb_substr($str, strlen($str) - $length, $length, "UTF-8");
		return $str;
	}
	
	// Âîçâðàùàåò URL èç èìåþùèõñÿ ïàðàìåòðîâ àäðåñíîé ñòðîêè è äîáàâî÷íûõ
	function getUrl($queryString, $args = '') {
		$urlArray = parse_url($queryString);
		$url = $urlArray['query'];
		if (!empty($args)) $url.= "&".$args;
		
		return $url;
	}
	
	// UTF-8 substr()
	function usubstr($str, $start_pos, $lenght, $ver = PHP_VER) {
		if ($ver == 4) {
			///$str = iconv("UTF-8", "UTF-8//IGNORE", $str);
			
			//$str = iconv("UTF-8", "WINDOWS-1251", $str);
			//$str = substr($str, $start_pos, $lenght);
			//$str = iconv("WINDOWS-1251", "UTF-8", $str);
			
			$str = mb_substr($str, $start_pos, $lenght, "UTF-8");
		} else {
			$str = @iconv_substr($str, $start_pos, $lenght, "UTF-8");
		}
		
		return $str;
	}
	
	// Îòëàäî÷íûå ôóíêöèè //////////////////////////////////////////////////////////////////////////////
	
	// Âûâîäèò îäíî èëè ïåðå÷åíü çíà÷åíèé
	function trace() {
		global $_SERVER;
		
		$split = '<hr size="1" noshade color="#0071BC">';
		$template = '<table width="99%" cellpadding="0" cellspacing="1" border="0" bgcolor="#0071BC" align="center" style="margin-top: 4px; margin-bottom: 8px;">
					 <tr><td height="20" bgcolor="#C5E0EB" style="color: #0067AC; padding: 2px 2px 2px 2px;"><b>{CAPTION}</b></td></tr>
					 <tr><td bgcolor="#F4F4F4" style="padding: 2px 2px 2px 2px;">{REPORT}</td></tr>
					 </table>';
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$report = '';
		$i = 0;
		
		if (CONFIG_DEVELOPER_IP == $ip || CONFIG_DEVELOPER_IP == 0) {
			if (func_num_args() > 0) {
				$arg_array = func_get_args();
				foreach($arg_array as $value) {
					$i++;
					$type = gettype($value);
					switch ($type) {
						case 'array': $type = 'array'; break;
						case 'string':
							if (is_numeric($value)) $type = 'integer'; else $type = 'string';
							break;
						case 'boolean':	
							$value = $value ? "true" : "false";
							$type = 'boolean';	break;
						case 'object'; $type = 'object'; break;
					}
					
					if (is_array($value)) {
						$out = print_r($value, true);
						$from = array("Array", "[", "]", "=>", "(", ")");
						$to = array("<font color=\"#177B2F\"><b>Array</b></font>", "<br><font color=\"#464646\"><b>[</b></font>", "<font color=\"#464646\"><b>]</b></font>", "<font color=\"#464646\"><b>=></b></font>", "<font color=\"#464646\"><b>(</b></font>", "<font color=\"#464646\"><b>)</b></font>");
						$out = str_replace($from, $to, $out);
						$report.= $out;
					} else {
			 			$report.= $value.' <small style="color: #0071BC">('.$type.')</small>';
					}
					
					if ($i < func_num_args()) $report.= $split;
				}
				
				$caption = 'Trace report ['.date("h:i d.m.y").']';
				$report = str_replace(array("{CAPTION}", "{REPORT}"), array($caption, $report), $template);
				echo $report;
			} else {
				echo 'This is trace message<br>';
			}
		}
	}

	// Îáðàáîò÷èê îøèáîê
	function debug_error_handler($errno, $errmsg, $filename, $linenum, $vars) {
	    // timestamp for the error entry
	    $dt = date("Y-m-d H:i:s (T)");
		
	    // define an assoc array of error string
	    // in reality the only entries we should
	    // consider are E_WARNING, E_NOTICE, E_USER_ERROR,
	    // E_USER_WARNING and E_USER_NOTICE
	    $errortype = array (
	                E_ERROR           => "Error",
	                E_WARNING         => "Warning",
	                E_PARSE           => "Parsing Error",
	                E_NOTICE          => "Notice",
	                E_CORE_ERROR      => "Core Error",
	                E_CORE_WARNING    => "Core Warning",
	                E_COMPILE_ERROR   => "Compile Error",
	                E_COMPILE_WARNING => "Compile Warning",
	                E_USER_ERROR      => "User Error",
	                E_USER_WARNING    => "User Warning",
	                E_USER_NOTICE     => "User Notice");
	                //E_STRICT          => "Runtime Notice"
		
	    // set of errors for which a var trace will be saved
	  	$user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
	    
	    $err = "<errorentry>\n";
	    $err .= "\t<datetime>" . $dt . "</datetime>\n";
	    $err .= "\t<errornum>" . $errno . "</errornum>\n";
	    $err .= "\t<errortype>" . $errortype[$errno] . "</errortype>\n";
	    $err .= "\t<errormsg>" . $errmsg . "</errormsg>\n";
	    $err .= "\t<scriptname>" . $filename . "</scriptname>\n";
	    $err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum>\n";
		
	    if (in_array($errno, $user_errors))
	        $err .= "\t<vartrace>" . wddx_serialize_value($vars, "Variables") . "</vartrace>\n";
	    $err .= "</errorentry>\n\n";
	    
	    // for testing
	    // echo $err;
		trace($err);
		
	    // save to the error log, and e-mail me if there is a critical user error
	    //error_log($err, 3, "./error.log");
		//trace($err);
	    if ($errno == E_USER_ERROR) {
	        //mail("phpdev@example.com", "Critical User Error", $err);
	    }
	}

	// Ïðîâåðÿåì ñóùåñòâóåò ëè äîêóìåíò íà ñåðâåðå
	function documentExists($query, $timeout = 30) {
		$url = parse_url($query);
		$host = $url["host"];
		$path = $url["path"];
		if (isset($url["query"])) $path.= "?".$url["query"];
		
		$fp = @fsockopen ($host, 80, $errno, $errstr, $timeout);
		
		if ($fp) {
			$out = "GET {$path} HTTP/1.1\r\n";
		    $out.= "Host: {$host}\r\n";
		    $out.= "Connection: Close\r\n\r\n";
		    
		    fwrite($fp, $out);
			$ret = fgets($fp, 128);
		    fclose($fp);
			if (trim($ret) == "HTTP/1.1 200 OK") return true;
		}
		
		return false;
	}

	// Ïîëó÷àåì äîêóìåíò
	function getDocument($query, $use_socket = true) {
		$content = '';
		
		if ($use_socket) {
			$url = parse_url($query);
			$host = $url["host"];
			$path = $url["path"];
			if (isset($url["query"])) $path.= "?".$url["query"];
			
			$fp = fsockopen($url["host"], 80, $errno, $errstr, 30);
			if ($fp) {
				$is_data = false;
				
				$out = "GET {$path} HTTP/1.1\r\n";
			    $out.= "Host: {$host}\r\n";
			    $out.= "Connection: Close\r\n\r\n";
				
			    fwrite($fp, $out);
			   	while (!feof($fp)) {
		   	    	$line = fgets($fp, 1024);
					if ($is_data) $content.= $line;
					if (ord($line) == 13) $is_data = true;
			    }
		    	fclose($fp);
			}
		} else {
			$handle = @fopen($query, "rb");
			if ($handle) {
				while (!feof($handle)) {
				  $content.= @fread($handle, 1024);
				}
				fclose($handle);
			}
		}
		
		return $content;
	}

	// Îòïðàâëÿåì ïèñüìî
	function sendMail($mail, $subject, $body, $sender_name = "", $sender_mail = "") {
		$headers = "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/html; charset=windows-1251\n";
		// $headers.= "To: ".$address." <".$address.">\r\n";
		if ($sender_mail && $sender_name) $headers.= "From: ".$sender_name." <".$sender_mail.">\r\n";
		
		$subject = mb_convert_encoding($subject, "WINDOWS-1251", "UTF-8");
		$body = mb_convert_encoding($body, "WINDOWS-1251", "UTF-8");
		$headers = mb_convert_encoding($headers, "WINDOWS-1251", "UTF-8");
		
		$result = mail($mail, $subject, stripslashes($body), $headers);
		
		return $result;
	}
	
	// Îòïðàâëÿåì ïèñüìî ñ âëîæåíèåì
	function sendAttachMail($mail, $subject, $body, $sender_name = "", $sender_mail = "", $filename = "") {
		$subject = mb_convert_encoding($subject, "WINDOWS-1251", "UTF-8");
		$body = mb_convert_encoding($body, "WINDOWS-1251", "UTF-8");
		
		$f         = fopen($filename, "rb"); 
		$un        = strtoupper(uniqid(time())); 
		$head      = "From: ".$subject." <".$sender_mail.">\r\n"; 
		$head     .= "To: ".$mail." <".$mail.">\r\n"; 
		$head     .= "Subject: ".$subject."\r\n"; 
		$head     .= "X-Mailer: PHPMail Tool\r\n"; 
		$head     .= "Reply-To: ".$sender_name."\r\n"; 
		$head     .= "Mime-Version: 1.0\r\n"; 
		$head     .= "Content-Type:multipart/mixed;"; 
		$head     .= "boundary=\"----------".$un."\"\n\n"; 
		$zag       = "------------".$un."\nContent-Type:text/html;\n"; 
		$zag      .= "Content-Transfer-Encoding: 8bit\n\n".$body."\n\n"; 
		$zag      .= "------------".$un."\n"; 
		$zag      .= "Content-Type: application/octet-stream;"; 
		$zag      .= "name=\"".basename($filename)."\"\n"; 
		$zag      .= "Content-Transfer-Encoding:base64\n"; 
		$zag      .= "Content-Disposition:attachment;"; 
		$zag      .= "filename=\"".basename($filename)."\"\n\n"; 
		$zag      .= chunk_split(base64_encode(fread($f, filesize($filename))))."\n";
		
		$result = mail($mail, $subject, $zag, $head);
		return $result; 
	}
	
	function resize_image($width, $height, $quality, $source, $destination, $ext) {
		$img_size = getimagesize($source);
	  	$d = max($img_size[0] / $width, $img_size[1] / $height);
		$result[] = round($img_size[0] / $d);
	  	$result[] = round($img_size[1] / $d);

		if ($ext == "JPG") $src = imagecreatefromjpeg($source); 
		if ($ext == "GIF") $src = imagecreatefromgif($source); 
		if ($ext == "PNG") $src = imagecreatefrompng($source); 
		
		if ($ext == "jpg") $src = imagecreatefromjpeg($source); 
		if ($ext == "gif") $src = imagecreatefromgif($source); 
		if ($ext == "png") $src = imagecreatefrompng($source); 
		
      	$img = imagecreatetruecolor($result[0], $result[1]);
		
		imagealphablending($img, false);
		imagesavealpha($img, true);
		
      	imagecopyresampled($img, $src, 0, 0, 0, 0, $result[0], $result[1], imagesx($src), imagesy($src)); 
	  	 
		if ($ext == "JPG") imagejpeg($img, $destination, $quality); 
		if ($ext == "GIF") imagegif($img, $destination);
		if ($ext == "PNG") imagepng($img, $destination);
		
		if ($ext == "jpg") imagejpeg($img, $destination, $quality); 
		if ($ext == "gif") imagegif($img, $destination);
		if ($ext == "png") imagepng($img, $destination);
	}
	
	function getKurs($page_id) {
		$kurs = db_get_data("SELECT kurs FROM pages WHERE id = ".$page_id, "kurs");
		
		return $kurs;
	}
	
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
	
	function check_smartphone() {  
		$phone_array = array('iphone', 'android', 'pocket', 'palm', 'windows ce', 'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp', 'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung', 'motorola', 'smartphone', 'blackberry', 'playstation portable', 'tablet browser');
		$agent = strtolower( $_SERVER['HTTP_USER_AGENT'] );
	 
		foreach ($phone_array as $value) {
			if (strpos($agent, $value) !== false) return true;
		}
	 
		return false;
	}

	function getPages($page_id) {
		global $page_array;
		
		$result = db_query("SELECT id FROM pages WHERE parent_id = ".$page_id." AND lang_id = ".LANG_ID." AND visible = 1");
		if (db_num_rows($result) > 0) {
			while ($row = db_fetch_array($result)) {
				$page_array[] .= $row['id'];
				
				getPages($row['id']);
			}
		}
	}

	function cleanStr($str) {
		$str = strip_tags($str);
		$str = htmlspecialchars($str);
		$str = mysql_escape_string($str);
	}
?>
