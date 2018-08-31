CREATE TABLE module_guestbook (
  id int(10) unsigned NOT NULL auto_increment,
  page_id int(10) unsigned NOT NULL,
  lang_id int(10) unsigned NOT NULL,
  date datetime NOT NULL default '0000-00-00 00:00:00',
  name varchar(100) NOT NULL,
  mail varchar(40) NOT NULL,
  message text NOT NULL,
  display tinyint(1) NOT NULL default '0',
  sortfield int(10) unsigned NOT NULL default '0' ,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8