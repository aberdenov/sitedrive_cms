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
					"Title" => array (1=> "Р”Р°С‚Р°", "Date", "Р”Р°С‚Р°"),
				),
			
			"icon_id" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "image_preview",
					"Title" => array (1=> "РР·РѕР±СЂР°Р¶РµРЅРёРµ", "Image", "РР·РѕР±СЂР°Р¶РµРЅРёРµ"),
				),
		);
		
		$galleryImport = true;
?>