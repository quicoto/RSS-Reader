# bottomfeeder
a simple rss reader in php and mysql

1. Set up a mysql table:


		CREATE TABLE IF NOT EXISTS `rss` (
		  `id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `title` text,
		  `url` text,
		  `site` text,
		  `is_read` tinyint(1) DEFAULT NULL,
		  `is_starred` tinyint(1) DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2686 ;


2. Change config.php to use your mysql username and password.

3. Add your feeds to feeds.php.
