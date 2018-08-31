<?php
	$moduleName = "menu_top";
	$prefix = "./modules/" . $moduleName . "/";
	
	$tpl->define(array(
			$moduleName => $prefix . $moduleName . ".tpl",
			$moduleName . "menu_row" => $prefix . "menu_row.tpl",
			$moduleName . "menu_row_event" => $prefix . "menu_row_event.tpl",
		));
	
	# SETTINGS ######################################################################
	
	$menu_id = getPageID("{".$moduleName."}", LANG_ID);
	$i = 0;
		
	# MAIN ##########################################################################
	
	if ($menu_id > 0) {
		$result = db_query("SELECT * FROM pages WHERE parent_id = ".$menu_id." AND visible = 1 AND deleted = 0 ORDER BY sortfield");
		if (db_num_rows($result) > 0) {
			$tpl->CLEAR("MENU_ROWS");
			while ($row = db_fetch_array($result)) {
				if ($row['external_link'] != '') {
					$url = $row['external_link'];
				} else {
					if ($mod_rewrite == true) $url = 'http://'.$_SERVER['SERVER_NAME'].'/'.LANG_INDEX.'/'.$row['mod_rewrite']."/";
						else $url = SITE_URL."?page_id=".$row['id']."&lang=".$row['lang_id'];
				}

				if ($row['type'] == 'page') $tmp = 'menu_row_event';
					else $tmp = 'menu_row';
		
				$tpl->assign("URL", $url);
				$tpl->assign("TITLE", $row['title']);
				$tpl->parse("MENU_ROWS", ".".$moduleName . $tmp);	
			}
		}
	}
	
	$tpl->parse(strtoupper($moduleName), $moduleName);
?>