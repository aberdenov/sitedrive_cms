<?php
	$fields = array (
			"date" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "datetime",
					"Sortfield" => true,
					"Title" => array (1=> "Дата и время", "Date and time", "Дата и время"),
				),
			
			"name" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Имя", "Name", "Имя"),
				),

			"email" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "E-mail", "E-mail", "E-mail"),
				),

			"phone" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Телефон", "Phone", "Телефон"),
				),
			
			"message" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textarea",
					"Title" => array (1=> "Сообщение", "Message", "Сообщение"),
				),

			"not_free" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "checkbox",
					"Title" => array (1=> "Занято", "Not free", "Занято"),
				),
		);
?>