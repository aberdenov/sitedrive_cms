CREATE TABLE module_time (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
page_id INT UNSIGNED NOT NULL,
lang_id INT UNSIGNED NOT NULL,
name VARCHAR( 255 ) NOT NULL ,
sortfield int(10) unsigned NOT NULL default '0' ,
PRIMARY KEY ( id ) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8