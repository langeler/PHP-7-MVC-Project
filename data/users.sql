CREATE TABLE `password_reset` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(512) NOT NULL,
  `role` varchar(16) NOT NULL,
  `access_code` text,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `phone` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `forename` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL DEFAULT '',
  `adress` varchar(32) DEFAULT '',
  `city` varchar(32) DEFAULT '',
  `state` varchar(32) DEFAULT '',
  `country` varchar(32) DEFAULT '',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='admin and customer users';