<?php
# ������ 
# 1 - ��������� 
# 2 - �������� ��������� �������
# 3 - �������� ���� �� �������� ����� ������������� ��������
# 4 - true - ������������ �����������
# 5 - id ����������� 
# 6 - true - ��������� ���� � ��������� (���������������� ������)

	$fields = array (
			"date" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => true,
					"Field type" => "datetime",
					"Title" => array (1=> "Дата", "Date", "Дата"),
				),
			
			"icon_id" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "image_preview",
					"Title" => array (1=> "Изображение", "Image", "Изображение"),
				),
		);
		
		$galleryImport = true;
?>