<?php
	$moduleName = "article_simple";
	$prefix = "./modules/".$moduleName."/";
	
	$tpl->define(array(
			$moduleName => $prefix . $moduleName.".tpl",
			$moduleName . "article" => $prefix . "article.tpl",
			$moduleName . "title" => $prefix . "title.tpl",
			$moduleName . "date" => $prefix . "date.tpl",
	));

	# SETTINGS ##############################################################################

	$_showTitle = true;								// Отображать заголовок статьи
	$_showDate = false;								// Отображать дату
	$_showPrintLink = true;							// Отображать ссылку на версию для печати
	
	$_order = getPageSort(PAGE_ID);					// Порядок сортировки
	$article_id = initVar('article_id', 'int');
	
	$print_page_id = db_get_data("SELECT id FROM pages WHERE lang_id = ".LANG_ID." AND template = 'print.tpl'", "id");

	# MAIN ##################################################################################

	if ($article_id > 0) {
		$sql = "SELECT id, date, title, content FROM module_article WHERE id = ".$article_id." LIMIT 1";
	} else {
		$sql = "SELECT id, date, title, content FROM module_article WHERE page_id = ".PAGE_ID." AND archive = 0".$_order;
	}
	
	$result = db_query($sql);
	if (db_num_rows($result) > 0) {
		while ($row = db_fetch_array($result)) {
			$tpl->clear("ARTICLE");
			
			if (!empty($row['title']) && $_showTitle) {
				
				$tpl->assign("ARTICLE_TITLE", $row['title']);
				$tpl->parse("ARTICLE_ROWS", ".".$moduleName."title");
			}
			
			$tpl->assign("ARTICLE_ID", $row['id']);
			$tpl->assign("ARTICLE_CONTENT", $row['content']);
			$tpl->parse("ARTICLE_ROWS", ".".$moduleName."article");
			
			if ($_showDate) {
				$tpl->assign("ARTICLE_DATE", date("d.m.y h:m", strtotime($row['date'])));
				$tpl->parse("ARTICLE_ROWS", ".".$moduleName."date");
			}
			
			if ($_showPrintLink && $print_page_id > 0) {
				$tpl->assign("PRINT_LINK", '<div class="article_print"><img src="modules/article_simple/print.gif" border="0">&nbsp;<a href="?page_id='.$print_page_id.'&lang_id='.LANG_ID.'&article_id='.$row['id'].'" class="article_print">{STR_PRINT_LINK}</a></div>');
			} else {
				$tpl->assign("PRINT_LINK", "");
			}
		}
		
		$tpl->parse(strtoupper($moduleName), $moduleName);
	} else {
		$tpl->assign(strtoupper($moduleName), "");
	}
?>