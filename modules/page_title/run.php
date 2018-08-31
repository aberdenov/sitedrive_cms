<?php
	$moduleName = "page_title";

	# SETTINGS ##############################################################################

	// Режим отображения заголовка
	// 1: заголовок страницы
	// 2: заголовок страницы со ссылкой на родительский раздел
	// 3: заголовок статьи с заголовком страницы
	// 4: заголовок ссылки-цепочки, все предыдущие разделы начиная с текущего
	
	$_titleMode = 1;
	
	//	CSS класс ссылок заголовка
	$_cssLinkClass = 'page_title';
	
	//	CSS класс заголовка статьи
	$_cssArticleClass = 'page_title_article';
	
	// Разделитель заголовков страниц
	$_pageSplitter = ' / ';

	# FUNCTIONS #############################################################################

	// Возвращает ссылку на заголовок раздела
	function getPageTitleLink($title, $page_id, $class) {
		$link = '<a href="?page_id='.$page_id.'&lang='.LANG_ID.'" class="'.$class.'">'.$title.'</a>';
		return $link;
	}

	# MAIN ##################################################################################

	$title = '';
	
	switch ($_titleMode) {
		case 1: { 
			$title = $_PAGE['title'];
			break;
		}
		case 2: {
			$title = getPageTitle($_PAGE['parent_id']);
			if ($title) {
				$title = getPageTitleLink($title, $_PAGE['parent_id'], $_cssLinkClass);
				$title.= $_pageSplitter.$_PAGE['title'];
			} else {
				$title = $_PAGE['title'];
			}
			break;
		}
		case 3: {
			if ($_PAGE['type'] == 'article' || $_PAGE['type'] == 'news') {
				$table = 'module_'.$_PAGE['type'];
				
				$_order = getPageSort($_PAGE);
				$result = db_get_data("SELECT title FROM ".$table." WHERE page_id = ".PAGE_ID.$_order." LIMIT 1", "title");
				
				$title = $_PAGE['title'];
				if ($result != false) $title.= $_pageSplitter.'<span class="'.$_cssArticleClass.'">'.$result.'</span>';
			} else {
				$title = $_PAGE['title'];
			}
			break;
		}
		case 4: {
			$title = getPagesChains(PAGE_ID, $_pageSplitter, $_cssLinkClass, '');
			break;
		}
	}
	
	$tpl->assign(strtoupper($moduleName), $title);
?>