CREATE TABLE module_feedback (
  id int(10) unsigned NOT NULL auto_increment,
  page_id int(10) unsigned NOT NULL default '0',
  lang_id int(10) unsigned NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  not_free text NOT NULL,
  sortfield int(10) unsigned NOT NULL default '0' ,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8