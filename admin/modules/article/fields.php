<?php
	$fields = array (
			"date" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => true,
					"Field type" => "datetime",
					"Sortfield" => true,
					"Title" => array (1=> "Дата", "Date", "Дата"),
				),
			
			"mod_rewrite" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "ЧПУ", "ЧПУ", "ЧПУ"),
				),

			"theme" => array(
					"Display in grid" => false,
					"Display in form" => false,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Тема", "Theme", "Тема"),
				),

			"title" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Заголовок", "Title", "Заголовок"),
				),
				
			"icon" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "image_preview",
//					"Field type" => "array",
//					"Values" => array(0=>'no', 1=>'yes'),
//					"Field type" => "external_table",
//					"External table" => array("module_article", 'id', 'title', '', 'title'),
					"Title" => array (1=> "Иконка", "Icon", "Иконка"),
				),
				
			"external_resource" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Внешний ресурс", "External resource", "Внешний ресурс"),
				),

			"description" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "html",
					"Title" => array (1=> "Описание", "Description", "Описание"),
				),

			"content" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "html",
					"Title" => array (1=> "Содержимое", "Content", "Содержимое"),
				),

			"sortfield" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Sortfield" => true,
					"Title" => array (1=> "Индекс сортировки", "Sortfield", "Индекс сортировки"),
				),
		);
		
		$archiveField = "archive";
?>
