<?php
# ������ 
# 1 - ��������� 
# 2 - �������� ��������� �������
# 3 - �������� ���� �� �������� ����� ������������� ��������
# 4 - true - ������������ �����������
# 5 - id ����������� 
# 6 - true - ��������� ���� � ��������� (���������������� ������)

$fields = array (
			"id" => array(
					"Display in grid" => true,
					"Display in form" => false,
					"Read only" => true,
					"Field type" => "textbox",
					"Title" => array (1=> "Номер", "ID", "Номер"),
				),

			"name" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Имя переменной", "Value name", "Имя переменной"),
				),

			"value" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Значение", "Value", "Значение"),
				),

			"description" => array(
					"Display in grid" => true,
					"Display in form" => true,
					"Read only" => false,
					"Field type" => "textbox",
					"Title" => array (1=> "Описание", "Description", "Описание"),
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