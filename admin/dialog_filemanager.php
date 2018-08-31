<?php
	# DEFINES ############################################################################
	
	ob_start("ob_gzhandler", 9);
	
	require_once("./includes/auth.php");
	require_once("./includes/common.php");
	require_once("./includes/db_init.php");
	require_once("../class.Pages.php");
	require_once(FASTTEMPLATES_PATH . "template.php");
	
	$tpl = new FastTemplate(TEMPLATES_PATH);
	
	$tpl->define(array(
			"page" => "page.tpl",
			"dialog_filemanager" => "dialog_filemanager.tpl",
			"main_menu"     => "main_menu.tpl",
			"lang_select"   => "lang_select.tpl",
		));
		
	# DEFINES ################################################################################
	
	require_once("./control_menu.php");
	
	# MAIN ##################################################################################

	$dir  = UPLOAD_PATH;
	$files_out = '';
	if (is_dir($dir)) {
	    if ($dh = opendir($dir)) {
	        while ($file = readdir($dh)) {
	        	if ($file != "." && $file != "..") {
	        		$files_out .= '<div class="dv2">
	        					   		<div class="dv3">'.$file.'</div>
	        					   		<div class="dv4"><a href="javascript:void(0);" onclick="deleteFile(\''.$file.'\')" class="ln1">удалить</a></div>
	        					   </div>';
	        	}
	        }
	        closedir($dh);
	    }
	}
	
	// Генерация страницы
	$tpl->assign(array(
			"MAX_FILE_SIZE" => CONFIG_UPLOAD_FILESIZE,
			"TIMESTAMP" => time(),
			"SALT" => md5('unique_salt'.time()),
			"MENU_ID" => $_GET['menu_id'],
			"FILES" => $files_out
		));
	
	$tpl->parse("PAGE_CONTENT", "dialog_filemanager");
	$tpl->parse("FINAL", "page");
	$tpl->FastPrint();
?>