CREATE TABLE IF NOT EXISTS `fb_login_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fb_user_id` varchar(120) NOT NULL,
  `login` varchar(30) NULL,
  `password` varchar(120) NULL,
  `email` varchar(120) NULL,
  `first_name` varchar(60) NULL,
  `last_name` varchar(60) NULL,
  `created` datetime NULL,
  `last_connect` datetime NULL,
  `privilege` tinyint(4) NULL,
  `active` tinyint(4) NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;