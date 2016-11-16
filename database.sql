-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generatie Tijd: 14 Oct 2010 om 09:31
-- Server versie: 5.0.51
-- PHP Versie: 5.2.5

--
-- Database: `palet_cms`
--

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_bib`
--

CREATE TABLE `cms_mod_bib` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `items` varchar(30) NOT NULL,
  `url` varchar(300) NOT NULL,
  `link` varchar(300) NOT NULL,
  `row` int(20) NOT NULL,
  `active` int(10) NOT NULL,
  `activestart` datetime NOT NULL,
  `activestop` datetime NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_bib`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_bib_items`
--

CREATE TABLE `cms_mod_bib_items` (
  `id` int(30) NOT NULL auto_increment,
  `bibid` int(30) NOT NULL default '0',
  `name` text NOT NULL,
  `type` varchar(30) NOT NULL default '0',
  `data` text NOT NULL,
  `target` varchar(200) NOT NULL default '',
  `position` int(30) NOT NULL default '0',
  `active` int(10) NOT NULL default '0',
  `activestart` datetime NOT NULL,
  `activestop` datetime NOT NULL,
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_bib_items`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_contact`
--

CREATE TABLE `cms_mod_contact` (
  `id` int(30) NOT NULL auto_increment,
  `webpage` int(10) NOT NULL default '0',
  `introtext` text NOT NULL,
  `name` varchar(200) NOT NULL default '',
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  `naam` varchar(200) NOT NULL default '',
  `adres` varchar(200) NOT NULL default '',
  `woonplaats` varchar(200) NOT NULL default '',
  `mailadres` varchar(200) NOT NULL default '',
  `telefoon` varchar(200) NOT NULL default '',
  `website` varchar(200) NOT NULL default '',
  `postcode` varchar(10) NOT NULL default '',
  `contactpersoon` varchar(200) NOT NULL default '',
  `mobiel` varchar(200) NOT NULL default '',
  `fax` varchar(200) NOT NULL default '',
  `kvknr` varchar(200) NOT NULL,
  `btwnr` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_contact`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_content`
--

CREATE TABLE `cms_mod_content` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `content` text NOT NULL,
  `active` int(10) NOT NULL default '0',
  `activestart` datetime NOT NULL,
  `activestop` datetime NOT NULL,
  `create_date` date NOT NULL default '0000-00-00',
  `webpage` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_content`
--

INSERT INTO `cms_mod_webpages` VALUES(1, 'Manage-IT', 'Manage-IT', 'Manage-IT', 'Manage-IT', 'Manage-IT', 'template', 1, 1, '0000-00-00', 'cms_content');

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_events`
--

CREATE TABLE `cms_mod_events` (
  `id` int(30) NOT NULL auto_increment,
  `webpage` int(30) NOT NULL default '0',
  `name` varchar(200) NOT NULL default '',
  `active` int(2) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  `introtext` text NOT NULL,
  `items` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_events`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_events_items`
--

CREATE TABLE `cms_mod_events_items` (
  `id` int(30) NOT NULL auto_increment,
  `eventid` int(30) NOT NULL default '0',
  `active` int(10) NOT NULL default '0',
  `activestart` datetime NOT NULL,
  `activestop` datetime NOT NULL,
  `create_date` date NOT NULL default '0000-00-00',
  `name` text NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `price` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `time` varchar(100) NOT NULL,
  `position` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_events_items`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_formulier`
--

CREATE TABLE `cms_mod_formulier` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `webpage` int(30) NOT NULL default '0',
  `active` int(10) NOT NULL default '0',
  `introtext` text NOT NULL,
  `sendtext` text NOT NULL,
  `create_date` date NOT NULL default '0000-00-00',
  `sendto` varchar(200) NOT NULL default '',
  `sendfrom` varchar(200) NOT NULL default '',
  `sendfromname` varchar(200) NOT NULL default '',
  `sendtitle` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_formulier`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_formulier_items`
--

CREATE TABLE `cms_mod_formulier_items` (
  `id` int(30) NOT NULL auto_increment,
  `formulierid` int(30) NOT NULL default '0',
  `name` text NOT NULL,
  `type` int(10) NOT NULL default '0',
  `req` int(10) NOT NULL default '0',
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_formulier_items`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_forum`
--

CREATE TABLE `cms_mod_forum` (
  `id` int(30) NOT NULL auto_increment,
  `webpage` int(30) NOT NULL default '0',
  `name` varchar(200) NOT NULL default '',
  `active` int(2) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  `introtext` text NOT NULL,
  `items` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_forum`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_forum_items`
--

CREATE TABLE `cms_mod_forum_items` (
  `id` int(30) NOT NULL auto_increment,
  `forumid` int(30) NOT NULL default '0',
  `active` int(10) NOT NULL default '0',
  `create_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `name` text NOT NULL,
  `text` text NOT NULL,
  `author` varchar(200) NOT NULL,
  `date` varchar(100) NOT NULL,
  `position` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_forum_items`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_galery`
--

CREATE TABLE `cms_mod_galery` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `items` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `active` int(10) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_galery`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_galery_images`
--

CREATE TABLE `cms_mod_galery_images` (
  `id` int(30) NOT NULL auto_increment,
  `galeryid` int(30) NOT NULL default '0',
  `name` text NOT NULL,
  `thumb` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL,
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_galery_images`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_galery_items`
--

CREATE TABLE `cms_mod_galery_items` (
  `id` int(30) NOT NULL auto_increment,
  `galeryid` int(30) NOT NULL default '0',
  `name` text NOT NULL,
  `location` varchar(300) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_galery_items`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_googlemaps`
--

CREATE TABLE `cms_mod_googlemaps` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  `modid` int(30) NOT NULL default '0',
  `maptype` varchar(200) NOT NULL default '',
  `width` varchar(200) NOT NULL default '',
  `height` varchar(200) NOT NULL default '',
  `kaartkeuze` int(2) NOT NULL default '0',
  `zoombalk` int(2) NOT NULL default '0',
  `zoomniveau` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_googlemaps`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_googlemaps_config`
--

CREATE TABLE `cms_mod_googlemaps_config` (
  `id` int(30) NOT NULL auto_increment,
  `API` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_googlemaps_config`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_html`
--

CREATE TABLE `cms_mod_html` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `active` int(30) NOT NULL default '0',
  `activestart` datetime NOT NULL,
  `activestop` datetime NOT NULL,
  `content` text NOT NULL,
  `create_date` date NOT NULL default '0000-00-00',
  `position` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_html`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_lang`
--

CREATE TABLE `cms_mod_lang` (
  `id` int(30) NOT NULL auto_increment,
  `ext` varchar(10) NOT NULL default '',
  `head` int(10) NOT NULL default '0',
  `active` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_lang`
--

INSERT INTO `cms_mod_lang` VALUES(16, 'NL', 1, 1);

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_login`
--

CREATE TABLE `cms_mod_login` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `username` varchar(200) NOT NULL default '',
  `password` varchar(200) NOT NULL default '',
  `group` int(10) NOT NULL default '0',
  `mail` varchar(200) NOT NULL default '',
  `create_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` int(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_login`
--

INSERT INTO `cms_mod_login` VALUES(1, 'LR Design Administrator', 'admin', '71ef5122c3729146b34dc9d2901d788b', 9, 'robert@lrdesign.info', '2010-03-26 09:29:47', 1);

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_menus`
--

CREATE TABLE `cms_mod_menus` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `position` varchar(200) NOT NULL default '',
  `menu_html` text NOT NULL,
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_menus`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_menus_items`
--

CREATE TABLE `cms_mod_menus_items` (
  `id` int(30) NOT NULL auto_increment,
  `menuid` int(30) NOT NULL default '0',
  `name` text NOT NULL,
  `type` varchar(30) NOT NULL default '0',
  `data` text NOT NULL,
  `target` varchar(200) NOT NULL default '',
  `subpage` int(10) NOT NULL default '0',
  `position` int(30) NOT NULL default '0',
  `active` int(10) NOT NULL default '0',
  `activestart` datetime NOT NULL,
  `activestop` datetime NOT NULL,
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_menus_items`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_news`
--

CREATE TABLE `cms_mod_news` (
  `id` int(30) NOT NULL auto_increment,
  `webpage` int(30) NOT NULL default '0',
  `name` varchar(200) NOT NULL default '',
  `active` int(2) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  `introtext` text NOT NULL,
  `items` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_news`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_news_items`
--

CREATE TABLE `cms_mod_news_items` (
  `id` int(30) NOT NULL auto_increment,
  `newsid` int(30) NOT NULL default '0',
  `active` int(10) NOT NULL default '0',
  `activestart` datetime NOT NULL,
  `activestop` datetime NOT NULL,
  `create_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `name` text NOT NULL,
  `text` text NOT NULL,
  `author` varchar(200) NOT NULL,
  `date` varchar(100) NOT NULL,
  `position` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_news_items`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_photobook`
--

CREATE TABLE `cms_mod_photobook` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(300) NOT NULL,
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_photobook`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_photobook_items`
--

CREATE TABLE `cms_mod_photobook_items` (
  `id` int(30) NOT NULL auto_increment,
  `photobookid` int(30) NOT NULL default '0',
  `thumb` varchar(200) NOT NULL,
  `normaal` varchar(200) NOT NULL,
  `height` varchar(200) NOT NULL,
  `width` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_photobook_items`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_pictureshow`
--

CREATE TABLE `cms_mod_pictureshow` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL default '',
  `pictureshow_html` text NOT NULL,
  `allow_pictures` varchar(200) NOT NULL default '',
  `position` varchar(200) NOT NULL default '',
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_pictureshow`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_pictureshow_items`
--

CREATE TABLE `cms_mod_pictureshow_items` (
  `id` int(30) NOT NULL auto_increment,
  `pictureshowid` int(30) NOT NULL default '0',
  `url` text NOT NULL,
  `alt` varchar(300) NOT NULL,
  `position` int(30) NOT NULL default '0',
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_pictureshow_items`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_projector`
--

CREATE TABLE `cms_mod_projector` (
  `id` int(30) NOT NULL auto_increment,
  `webpage` int(30) NOT NULL default '0',
  `name` varchar(200) NOT NULL default '',
  `active` int(2) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  `introtext` text NOT NULL,
  `projectorpp` int(30) NOT NULL default '0',
  `type` int(30) NOT NULL default '0',
  `projector_html` text NOT NULL,
  `product_html` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_projector`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_projector_products`
--

CREATE TABLE `cms_mod_projector_products` (
  `id` int(30) NOT NULL auto_increment,
  `projid` int(30) NOT NULL default '0',
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  `productname` text NOT NULL,
  `productext` text NOT NULL,
  `position` int(30) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_projector_products`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_stats`
--

CREATE TABLE `cms_mod_stats` (
  `id` int(30) NOT NULL auto_increment,
  `visiters` varchar(300) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_stats`
--

INSERT INTO `cms_mod_stats` VALUES(1, '0');

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_support`
--

CREATE TABLE `cms_mod_support` (
  `id` int(30) NOT NULL auto_increment,
  `sender` int(30) NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `question` text NOT NULL,
  `answer` int(30) NOT NULL default '0',
  `active` int(30) NOT NULL,
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_support`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_userpermissions`
--

CREATE TABLE `cms_mod_userpermissions` (
  `id` int(30) NOT NULL auto_increment,
  `groupname` varchar(200) NOT NULL default '',
  `permissions` text NOT NULL,
  `active` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_userpermissions`
--

INSERT INTO `cms_mod_userpermissions` VALUES(9, 'Super Administrator', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,24,25,26,27,28,29,30', 1, '2010-07-05');

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webpages`
--

CREATE TABLE `cms_mod_webpages` (
  `id` int(30) NOT NULL auto_increment,
  `name` text NOT NULL,
  `title` varchar(300) NOT NULL,
  `pagetitle` varchar(200) NOT NULL,
  `keywords` text NOT NULL,
  `description` varchar(300) NOT NULL,
  `template` text NOT NULL,
  `active` int(10) NOT NULL default '0',
  `frontpage` int(10) NOT NULL default '0',
  `create_date` date NOT NULL default '0000-00-00',
  `cms_module` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webpages`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webpages_config`
--

CREATE TABLE `cms_mod_webpages_config` (
  `id` int(30) NOT NULL auto_increment,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `generator` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webpages_config`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webshop`
--

CREATE TABLE `cms_mod_webshop` (
  `id` int(30) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `active` int(10) NOT NULL,
  `create_date` date NOT NULL,
  `webpage` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webshop`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webshop_artikels`
--

CREATE TABLE `cms_mod_webshop_artikels` (
  `id` int(30) NOT NULL auto_increment,
  `webshopid` int(10) NOT NULL,
  `artikelnr` varchar(100) NOT NULL,
  `name` varchar(300) NOT NULL,
  `brand` varchar(200) NOT NULL,
  `info` text NOT NULL,
  `price` varchar(200) NOT NULL,
  `actie` int(10) NOT NULL,
  `actieprijs` varchar(200) NOT NULL,
  `aanvraag` int(10) NOT NULL,
  `picture` varchar(300) NOT NULL,
  `cat` int(10) NOT NULL,
  `active` int(10) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webshop_artikels`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webshop_cats`
--

CREATE TABLE `cms_mod_webshop_cats` (
  `id` int(30) NOT NULL auto_increment,
  `webshopid` int(10) NOT NULL,
  `catname` varchar(200) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `picture` varchar(300) NOT NULL,
  `cat` int(10) NOT NULL,
  `subcat` int(10) NOT NULL,
  `active` int(10) NOT NULL,
  `position` int(10) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webshop_cats`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webshop_config`
--

CREATE TABLE `cms_mod_webshop_config` (
  `id` int(30) NOT NULL auto_increment,
  `webshopid` int(30) NOT NULL,
  `btw` varchar(10) NOT NULL,
  `vrachtkosten` varchar(10) NOT NULL,
  `title` varchar(300) NOT NULL,
  `information` text NOT NULL,
  `sendmail` varchar(200) NOT NULL,
  `sendfrom` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webshop_config`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webshop_cost`
--

CREATE TABLE `cms_mod_webshop_cost` (
  `id` int(30) NOT NULL auto_increment,
  `cost` varchar(200) NOT NULL,
  `from` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webshop_cost`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webshop_customers`
--

CREATE TABLE `cms_mod_webshop_customers` (
  `id` int(30) NOT NULL auto_increment,
  `webshopid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `zipcode` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `phonenumber` varchar(200) NOT NULL,
  `mailaddress` varchar(200) NOT NULL,
  `active` int(10) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webshop_customers`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webshop_orders`
--

CREATE TABLE `cms_mod_webshop_orders` (
  `id` int(30) NOT NULL auto_increment,
  `webshopid` int(30) NOT NULL,
  `customerid` int(30) NOT NULL,
  `active` int(10) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webshop_orders`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `cms_mod_webshop_orders_artikels`
--

CREATE TABLE `cms_mod_webshop_orders_artikels` (
  `id` int(30) NOT NULL auto_increment,
  `orderid` int(30) NOT NULL,
  `artikelid` int(30) NOT NULL,
  `total` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

--
-- Gegevens worden uitgevoerd voor tabel `cms_mod_webshop_orders_artikels`
--

