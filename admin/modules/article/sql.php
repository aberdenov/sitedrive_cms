CREATE TABLE `module_article` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `page_id` int(10) unsigned NOT NULL default '0',
  `lang_id` int(10) unsigned NOT NULL default '0',
  `archive` tinyint(3) unsigned default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `theme` varchar(50) NOT NULL default '',
  `title` text NOT NULL,
  `icon` int(10) unsigned NOT NULL default '0',
  `external_resource` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `content` mediumtext NOT NULL,
  `sortfield` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8