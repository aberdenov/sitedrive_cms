<?php
	$fields = array (
			"date" => array(
					"Display in grid" => false,
					"Display in form" => false,
					"Read only" => false,
					"Field type" => "datetime",
					"Sortfield" => true,
					"Title" => array (1=> "Дата и время", "Date and time", "Дата и время"),
				),
			
			"not_free" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Занятая дата (формат: месяц/день/год)", "Занятая дата (формат: месяц/день/год)", "Занятая дата (формат: месяц/день/год)"),
				),
		);
?>