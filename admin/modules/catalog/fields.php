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
				
			"title" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textarea",
					"Title" => array (1=> "Вопрос", "Question", "Вопрос"),
				),

			"description" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textarea",
					"Title" => array (1=> "Описание ответа", "Question description", "Описание ответа"),
				),
				
			"answers" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "linkfield",
					"External table" => array("module_answers", "answers"),
					"Title" => array (1=> "Ответы", "Ответы", "Ответы"),
				),

			"display" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "checkbox",
					"Title" => array (1=> "Отображать", "Display", "Отображать"),
				),
				
			"sortfield" => array(
					"Display in grid" => false,
					"Display in form" => false,
					"Read only" => false,
					"Field type" => "textbox",
					"Sortfield" => true,
					"Title" => array (1=> "Индекс сортировки", "Sortfield", "Индекс сортировки"),
				),
		);
		
		$galleryImport = true;
?>