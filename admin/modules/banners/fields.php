<?php
$fields = array (
			"id" => array(
					"Display in grid" => true,
					"Display in form" => false,
					"Read only" => true,
					"Field type" => "textbox",
					"Sortfield" => true,
					"Title" => array (1=> "Номер", "ID", "Номер"),
				),

			"date" => array(
					"Display in grid" => false,
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
					"Field type" => "textbox",
					"Title" => array (1=> "Заголовок", "Title", "Заголовок"),
				),

			"description" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Описание", "Description", "Описание"),
				),

			"link" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Ссылка", "Link", "Ссылка"),
				),

			"icon" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "image_preview",
					"Title" => array (1=> "Номер изображения", "Icon", "Номер изображения"),
				),

			"display" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "checkbox",
					"Title" => array (1=> "Отображать", "Display", "Отображать"),
				),

			"content" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "html",
					"Title" => array (1=> "Код баннера", "HTML code", "Код баннера"),
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
?>