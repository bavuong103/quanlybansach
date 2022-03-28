CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` date ,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` date ,
  `modified_by` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `ordering` int(11) DEFAULT '10',
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `group_id`) VALUES
(1, 'huy', 'dqhuy@gmail.com', 'Dương Quang Huy', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 0, 10, 1),
(2, 'hai', 'hai@gmail.com', 'Dương Quang Hai', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 0, 10, 2),
(3, 'admin', 'admin@gmail.com', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '2021-06-22', 11, 1, 10, 1),
(4, 'long19', 'admin3@gmail.com', '', '0ce43d1b646cc002ec8e4736ca5e10b6', '2021-06-21', 1, '2021-06-22', 11, 1, 2, 4);