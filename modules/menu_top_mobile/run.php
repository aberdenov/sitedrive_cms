<?php
	$moduleName = "menu_top_mobile";
	$prefix = "./modules/" . $moduleName . "/";
	
	$tpl->define(array(
			$moduleName => $prefix . $moduleName . ".tpl",
			$moduleName . "menu_row" => $prefix . "menu_row.tpl",
			$moduleName . "menu_row_event" => $prefix . "menu_row_event.tpl",
		));
	
	# SETTINGS ######################################################################
	
	$menu_id1 = getPageID("{MENU_TOP}", LANG_ID);
	$menu_id2 = getPageID("{MENU_EX}", LANG_ID);
	$i = 0;
		
	# MAIN ##########################################################################
	
	$result = db_query("SELECT * FROM pages WHERE parent_id = ".$menu_id1." OR parent_id = ".$menu_id2." AND visible = 1 AND deleted = 0 ORDER BY parent_id, sortfield");
	if (db_num_rows($result) > 0) {
		$tpl->CLEAR("MENU_MOB_ROWS");
		while ($row = db_fetch_array($result)) {
			if ($row['external_link'] != '') {
				$url = $row['external_link'];
			} else {
				if ($mod_rewrite == true) $url = 'http://'.$_SERVER['SERVER_NAME'].'/'.LANG_INDEX.'/'.$row['mod_rewrite']."/";
					else $url = SITE_URL."?page_id=".$row['id']."&lang=".$row['lang_id'];
			}

			if ($row['id'] == PAGE_ID) $active = 'class="active"';
				else $active = '';

			if ($row['type'] == 'page') $tmp = 'menu_row_event';
				else $tmp = 'menu_row';

			$tpl->assign("ACTIVE", $active);
			$tpl->assign("URL", $url);
			$tpl->assign("TITLE", $row['title']);
			$tpl->parse("MENU_MOB_ROWS", ".".$moduleName . $tmp);	
		}
	}
	
	$tpl->parse(strtoupper($moduleName), $moduleName);
?>