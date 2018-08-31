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

			"name" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Имя", "Name", "Имя"),
				),

			"mail" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "E-Mail", "E-Mail", "E-Mail"),
				),

			"message" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textarea",
					"Title" => array (1=> "Сообщение", "Message", "Сообщение"),
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
					"Title" => array (1=> "Индекс сортировки", "Sortfield", "Индекс сортировки"),
				),
		);
?>