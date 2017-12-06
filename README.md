# bottomfeeder
a simple rss reader in php and mysql for those self-hosting types

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

3. Add your feeds to [feeds.php](https://github.com/travisred/bottomfeeder/blob/master/feeds.php).

4. Run `php rss.php` to fetch new feed items.

Hints: Clicking on the ID of the item to the left of the title marks that item as read. Clicking on the title of the site marks all of the site's items as read. Clicking on the star saves it in the starred items collection.

![bottomfeeder](http://i.imgur.com/3IAr4mR.png)
