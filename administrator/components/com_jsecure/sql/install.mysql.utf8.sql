CREATE TABLE IF NOT EXISTS `#__spamip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spamip` varchar(25) NOT NULL,
  `spamtype` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

CREATE TABLE IF NOT EXISTS `#__apikeys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Value` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

CREATE TABLE IF NOT EXISTS `#__jsecurelog` (
	`id` int(11) NOT NULL auto_increment,
	`date` datetime NOT NULL,
	`ip` varchar(16) NOT NULL,
	`userid` int(11) NOT NULL default '0',
	`code` varchar(255) NOT NULL,
	`change_variable` text NOT NULL,
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__jsecurepassword` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `com_id` int(20) NOT NULL,
  `status` int(11) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT 'jSecure',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__jsecure_hits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correct_hits` int(11) NOT NULL,
  `incorrect_hits` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `#__jsecure_keys`;

CREATE TABLE IF NOT EXISTS `#__jsecure_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `start_date` double(10,0) NOT NULL,
  `end_date` double(10,0) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `#__jsecure_keys`
ADD CONSTRAINT `#__jsecure_keys_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `#__users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
