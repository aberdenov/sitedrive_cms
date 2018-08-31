<?php
# Массив 
# 1 - Заголовок 
# 2 - Название связанной таблицы
# 3 - Название поля из которого будут подставляться значения
# 4 - true - использовать подстановку
# 5 - id справочника 
# 6 - true - отбражать поле в редакторе (административном модуле)

	$fields = array (
			"date" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => true,
					"Field type" => "datetime",
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
					"Field type" => "html",
					"Title" => array (1=> "Описание", "Description", "Описание"),
				),
			
			"file" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "file",
					"Title" => array (1=> "Файл", "File", "Файл"),
				),
			
			"html_code" => array(
					"Display in grid" => false,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "html",
					"Title" => array (1=> "HTML код", "HTML code", "HTML код"),
				),
		);
?>