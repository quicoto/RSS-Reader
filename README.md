# RSS Reader

## To DO

- Add timestamps to RSS table
- Create delete feeds for purging the database
- Route for deleting feeds
- Filter items (read, unread, starred)

## Requirements

- PHP
- MySQL

## Setup

1. Set up a MySQL tables:

```sql
CREATE TABLE IF NOT EXISTS `rss` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`title` text,
	`url` text,
	`site` text,
	`is_read` tinyint(1) DEFAULT NULL,
	`is_starred` tinyint(1) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2686 ;
```

```sql
CREATE TABLE IF NOT EXISTS `feeds` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`title` text,
	`url` text,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2686 ;
```

2. Create a `config.php` file to use your mysql username and password.

```php
$host = 'localhost:3306';
$user = 'root';
$password = 'password';
$database = 'feedreader';
```

1. Run `php rss.php` to fetch new feed items.

## Screenshots