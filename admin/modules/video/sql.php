CREATE TABLE module_video (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
page_id INT UNSIGNED NOT NULL,
lang_id INT UNSIGNED NOT NULL,
date DATETIME NOT NULL ,
title VARCHAR( 255 ) NOT NULL ,
description text NOT NULL,
file text NOT NULL,
html_code text NOT NULL,
sortfield int(10) unsigned NOT NULL default '0' ,
PRIMARY KEY ( id ) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8