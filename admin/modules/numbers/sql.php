CREATE TABLE `module_numbers` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `page_id` int(10) unsigned NOT NULL default '0',
  `lang_id` int(10) unsigned NOT NULL default '0',
  `p_number` text NOT NULL,
  `q_number` text NOT NULL,
  `content` mediumtext NOT NULL,
  `sortfield` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8