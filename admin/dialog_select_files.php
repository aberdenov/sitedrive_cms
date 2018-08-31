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
			"dialog_select_files" => "dialog_select_files.tpl",
		)); 
	
	# MAIN ##################################################################################
	
	$tpl->parse("FINAL", "dialog_select_files");
	$tpl->FastPrint();
?>