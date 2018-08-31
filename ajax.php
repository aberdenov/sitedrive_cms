<?php
	define("IN_SITEDRIVE", 1);
	
	# INCLUDES ##############################################################################
	
	require_once('./common.php');							// SiteDrive API and initialize
	require_once('./admin/includes/config.php');			// Настройки SiteDrive
	require_once('./admin/includes/values.php');			// Работа с константами
	
	# MAIN ##################################################################################
	
	db_connect(DB_HOST, DB_LOGIN, DB_PASSWORD);
	db_select_db(DB_NAME);

	if ($_POST['lang_id'] == 1) $lang_index = 'ru';
		else $lang_index = 'en';
	
	if (isset($_POST['type'])) {
		if ($_POST['type'] == "html-request") {
			if ($_POST['action'] == 1) {
				
			}
		}
	}	
?>
