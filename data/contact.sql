CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `state` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `zip` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;