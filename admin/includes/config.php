<?php
	# ���������������� ���� SiteDrive #######################################################
	
	define('CONFIG_CACHE_ENABLED', false);				// ����� ����������� (���, ����)
	define('CONFIG_CACHE_COMPRESSION', true);			// ������������ GZip ���������� ��� �����������
	
	define('CONFIG_GZIP_ENABLED', true);				// ����� ���������� (���, ����) GZip ��� ����� �����
	
	define('CONFIG_DEVELOPER_IP', '212.13.136.2');		// ��������� trace() ��������� ������ ��� CONFIG_DEVELOPER_IP
	
	define('CONFIG_UPLOAD_FILESIZE', 52428800); 			// ����������� ���������� ������ ����� ��� ������� (5 ��)
	
	define("CONFIG_ALLOWED_IPMASK", "212.13.136");		// ����������� ����� IP ��� ����� � ���. �����

	define('CONFIG_SQL_LOGGING', true);
?>