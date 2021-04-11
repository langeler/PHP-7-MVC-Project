CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(512) NOT NULL,
  `role` varchar(16) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `forename` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `adress` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` varchar(32) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `country` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='admin and customer users';