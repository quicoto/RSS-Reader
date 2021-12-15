| :warning: Please notice          |
|:---------------------------|
| This repository is Archived. I could never make it work reliably, I would get random posts fetched. Thus I spent time cleaning out old items rather than reading new ones.      |

# RSS Reader

![Screenshot](https://cldup.com/H43vRNLgta.png)

## Requirements

- PHP
- MySQL

## Setup

1. Set up a MySQL tables:

```sql
CREATE TABLE IF NOT EXISTS `items` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`title` text,
	`url` text,
	`feed_id` bigint(20) NOT NULL,
	`is_read` tinyint(1) DEFAULT NULL,
	`is_starred` tinyint(1) DEFAULT NULL,
	`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
<?php

$host = 'localhost:3306';
$user = 'root';
$password = 'password';
$database = 'feedreader';
```

3. Run `php api/fetch-feeds.php` to fetch new feed items. Ideally you should add a cronjob to automatically pull items.
4. You can also set up a cronjob to delete items  `php api/delete-old-items.php` items.
