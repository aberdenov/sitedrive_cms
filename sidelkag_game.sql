/*
 Navicat Premium Data Transfer

 Source Server         : game.trainspotting.kz
 Source Server Type    : MySQL
 Source Server Version : 50552
 Source Host           : srv-pleskdb17.ps.kz
 Source Database       : sidelkag_game

 Target Server Type    : MySQL
 Target Server Version : 50552
 File Encoding         : utf-8

 Date: 09/04/2017 13:30:24 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `cache`
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lang_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `compressed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `image_groups`
-- ----------------------------
DROP TABLE IF EXISTS `image_groups`;
CREATE TABLE `image_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `image_groups`
-- ----------------------------
BEGIN;
INSERT INTO `image_groups` VALUES ('1', 'Main');
COMMIT;

-- ----------------------------
--  Table structure for `images`
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `page_id` int(10) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  `width` int(10) unsigned NOT NULL DEFAULT '0',
  `height` int(10) unsigned NOT NULL DEFAULT '0',
  `thumb_width` int(10) unsigned NOT NULL DEFAULT '0',
  `thumb_height` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `languages`
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL DEFAULT '',
  `file` varchar(30) NOT NULL DEFAULT '',
  `encoding` varchar(30) NOT NULL DEFAULT '',
  `main` int(1) NOT NULL DEFAULT '0',
  `blocked` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `languages`
-- ----------------------------
BEGIN;
INSERT INTO `languages` VALUES ('1', 'Russian', 'russian_utf-8.php', 'utf-8', '1', '0');
COMMIT;

-- ----------------------------
--  Table structure for `module_article`
-- ----------------------------
DROP TABLE IF EXISTS `module_article`;
CREATE TABLE `module_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lang_id` int(10) unsigned NOT NULL DEFAULT '0',
  `archive` tinyint(3) unsigned DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mod_rewrite` varchar(255) NOT NULL,
  `theme` varchar(50) NOT NULL DEFAULT '',
  `title` text NOT NULL,
  `icon` int(10) unsigned NOT NULL DEFAULT '0',
  `external_resource` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `content` mediumtext NOT NULL,
  `sortfield` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `module_values`
-- ----------------------------
DROP TABLE IF EXISTS `module_values`;
CREATE TABLE `module_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `lang_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `value` text,
  `sortfield` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `module_values`
-- ----------------------------
BEGIN;
INSERT INTO `module_values` VALUES ('1', '2', '1', '0', 'SITE_WINDOW_TITLE', 'Заголовок окна', '', '0'), ('2', '2', '1', '0', 'META_TAGS', 'Ключевые слова для поисковых систем', '', '0'), ('3', '2', '1', '0', 'META_DESCRIPTION', 'Описание сайта в поисковой системе', '', '0'), ('4', '2', '1', '0', 'COPYRIGHT_INFO', 'Копирайты', '', '0'), ('5', '2', '1', '0', 'ADMIN_EMAIL', 'Почтовый адрес администратора', '', '0'), ('6', '2', '1', '0', 'SITE_EMAIL_SUBJECT', 'Тема письма с сайта', '', '0'), ('7', '2', '1', '0', 'SITE_EMAIL_SIGNATURE', 'Подпись письма с сайта', '', '0');
COMMIT;

-- ----------------------------
--  Table structure for `page_groups`
-- ----------------------------
DROP TABLE IF EXISTS `page_groups`;
CREATE TABLE `page_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lang_id` int(4) unsigned NOT NULL DEFAULT '0',
  `type` varchar(15) NOT NULL DEFAULT '',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `mod_rewrite` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `kurs` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `template` varchar(30) NOT NULL DEFAULT '',
  `icon` int(10) unsigned NOT NULL DEFAULT '0',
  `external_link` varchar(255) NOT NULL DEFAULT '',
  `sortfield` int(10) unsigned NOT NULL DEFAULT '0',
  `visible` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `deleted` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `startpage` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `sort_by` varchar(50) NOT NULL DEFAULT '',
  `sort_order` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `auth` tinyint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lang` (`lang_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `pages`
-- ----------------------------
BEGIN;
INSERT INTO `pages` VALUES ('1', '0', '1', 'settings', '0', '', 'Настройки', '@settings_folder', '', '', '', '0', '', '10000', '1', '0', '0', '', '0', '0'), ('2', '1', '1', 'values', '0', '', 'Общие', '@settings_global', '', '', '', '0', '', '10001', '1', '0', '0', '', '0', '0'), ('3', '1', '1', 'values', '0', '', 'Оформление', '@settings_labels', '', '', '', '0', '', '10002', '1', '0', '0', '', '0', '0'), ('4', '0', '1', 'folder', '0', '', 'Модули', '', '', '', 'default.tpl', '0', '', '4', '1', '0', '0', '', '0', '0'), ('5', '0', '1', 'folder', '0', '', 'Основное меню', '', '', '{MENU_TOP}', 'default.tpl', '0', '', '5', '1', '0', '0', '', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `poll_variants`
-- ----------------------------
DROP TABLE IF EXISTS `poll_variants`;
CREATE TABLE `poll_variants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `result` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `polls`
-- ----------------------------
DROP TABLE IF EXISTS `polls`;
CREATE TABLE `polls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lang_id` int(10) unsigned NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `stat_config`
-- ----------------------------
DROP TABLE IF EXISTS `stat_config`;
CREATE TABLE `stat_config` (
  `allow_stat` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allow_keywords` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_referers` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
--  Records of `stat_config`
-- ----------------------------
BEGIN;
INSERT INTO `stat_config` VALUES ('0', '0', '0', '0000-00-00', '0');
COMMIT;

-- ----------------------------
--  Table structure for `stat_counter`
-- ----------------------------
DROP TABLE IF EXISTS `stat_counter`;
CREATE TABLE `stat_counter` (
  `total_hosts` int(10) unsigned NOT NULL DEFAULT '0',
  `total_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `day_hosts` int(10) unsigned NOT NULL DEFAULT '0',
  `day_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `day_stamp` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
--  Records of `stat_counter`
-- ----------------------------
BEGIN;
INSERT INTO `stat_counter` VALUES ('0', '0', '0', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `stat_exclude`
-- ----------------------------
DROP TABLE IF EXISTS `stat_exclude`;
CREATE TABLE `stat_exclude` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
--  Table structure for `stat_keywords`
-- ----------------------------
DROP TABLE IF EXISTS `stat_keywords`;
CREATE TABLE `stat_keywords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `stat_log`
-- ----------------------------
DROP TABLE IF EXISTS `stat_log`;
CREATE TABLE `stat_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_ip` int(11) NOT NULL DEFAULT '0',
  `proxy_ip` int(11) NOT NULL DEFAULT '0',
  `date` int(10) unsigned DEFAULT '0',
  `page_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `country` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `uniq` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
--  Table structure for `stat_referers`
-- ----------------------------
DROP TABLE IF EXISTS `stat_referers`;
CREATE TABLE `stat_referers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(10) unsigned NOT NULL DEFAULT '0',
  `referer` varchar(255) NOT NULL DEFAULT '',
  `count` int(10) unsigned DEFAULT NULL,
  `self` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `login` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `full_name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `ip` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_write` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_create` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', '1', '2016-02-21 14:13:27', 'admin', 'f279337511b3b4ada0e11db3099f253a', '1', '', '', '0', '1', '1', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `users_actions_log`
-- ----------------------------
DROP TABLE IF EXISTS `users_actions_log`;
CREATE TABLE `users_actions_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lang_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_login` varchar(15) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `chapter_name` tinytext NOT NULL,
  `action` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL DEFAULT '',
  `allow_read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_write` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_create` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `users_groups`
-- ----------------------------
BEGIN;
INSERT INTO `users_groups` VALUES ('1', 'Administrators', '1', '1', '1'), ('2', 'Power User', '1', '0', '0'), ('3', 'Users', '0', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `users_modules`
-- ----------------------------
DROP TABLE IF EXISTS `users_modules`;
CREATE TABLE `users_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL DEFAULT '0',
  `caption` varchar(255) NOT NULL DEFAULT '',
  `action` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `image_over` varchar(255) NOT NULL DEFAULT '',
  `dialog_name` varchar(255) NOT NULL DEFAULT '',
  `win_name` varchar(100) NOT NULL DEFAULT '',
  `win_height` int(10) unsigned NOT NULL DEFAULT '0',
  `win_width` int(10) unsigned NOT NULL DEFAULT '0',
  `scrollable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `resizable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hint` varchar(100) NOT NULL DEFAULT '',
  `priv` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sortfield` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `users_modules`
-- ----------------------------
BEGIN;
INSERT INTO `users_modules` VALUES ('1', '1', '', '', 'menu_control.gif', '', 'control.php', 'main', '600', '700', '0', '1', 'LANG_USERS', '2', '1', '0'), ('2', '1', '', '', 'menu_images.gif', '', 'dialog_images.php', 'images', '600', '770', '1', '0', 'LANG_IMAGES', '1', '1', '0'), ('3', '1', '', '', 'menu_lang.gif', '', 'dialog_languages.php', 'languages', '600', '770', '1', '0', 'LANG_LANGUAGE', '1', '1', '0'), ('23', '1', '', '', 'menu_download.gif', '', 'dialog_filemanager.php', 'files', '600', '770', '1', '0', 'LANG_FILEMANAGER', '1', '1', '0');
COMMIT;

-- ----------------------------
--  Table structure for `users_modules_priv`
-- ----------------------------
DROP TABLE IF EXISTS `users_modules_priv`;
CREATE TABLE `users_modules_priv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` int(10) NOT NULL DEFAULT '0',
  `user_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- ----------------------------
--  Records of `users_modules_priv`
-- ----------------------------
BEGIN;
INSERT INTO `users_modules_priv` VALUES ('1', '2', '1'), ('2', '6', '1'), ('3', '3', '1'), ('4', '23', '1');
COMMIT;

-- ----------------------------
--  Table structure for `users_pages_priv`
-- ----------------------------
DROP TABLE IF EXISTS `users_pages_priv`;
CREATE TABLE `users_pages_priv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `page_id` int(10) unsigned NOT NULL DEFAULT '0',
  `allow_read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_write` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allow_create` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

