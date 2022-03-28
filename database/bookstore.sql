--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) DEFAULT '0',
  `created` date,
  `created_by` varchar(45) DEFAULT NULL,
  `modified` date,
  `modified_by` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `ordering` int(11) DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(1, 'Admin', 1, '2013-11-11', NULL, '2013-11-12', 10, 1, 15),
(2, 'Manager', 1, '2013-11-07', NULL, '2013-11-12', 10, 0, 1),
(3, 'Founder', 0, '2013-11-12', 1, '2013-11-12', 10, 1, 99),
(4, 'Member', 0, '2013-11-12', 1, '2013-11-12', 10, 1, 1);




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



CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `picture` text,
  `created` date,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `ordering` int(11) DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(1, 'Văn Học - Tiểu Thuyết', 'hinh4.jpg', '2013-12-09', 'admin', '2021-06-29', 'admin', 1, 10),
(2, 'Kinh Tế', 'hinh7.jpg', '2013-12-09', 'admin', '2021-06-29', 'admin', 0, 4),
(3, 'Tin học', 'hinh8.jpg', '2013-12-09', 'admin', '2021-06-29', 'admin', 1, 10),
(4, ' Kỹ Năng Sống', 'hinh1.jpg', '2013-12-09', 'admin', '2021-06-29', 'admin', 1, 1),
(5, 'Thiếu Nhi', 'hinh4.jpg', '2013-12-09', 'admin', '2021-06-29', 'admin', 1, 10),
(6, ' Thường Thức - Đời Sống', 'hinh2.jpg', '2013-12-09', 'admin', '2021-06-29', 'admin', 1, 2),
(7, 'Ngoại Ngữ - Từ Điển', 'hinh6.jpg', '2013-12-09', 'admin', '2021-06-29', 'admin', 1, 5),
(8, 'Truyện Tranh', 'hinh8.jpg', '2013-12-09', 'admin', '2021-06-29', 'admin', 1, 10),
(9, ' Văn Hoá - Nghệ Thuật - Du Lịch', 'hinh1.jpg', '2013-12-06', 'admin', '2021-06-29', 'admin', 1, 3);


--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,0) NOT NULL,
  `special` tinyint(1) DEFAULT '0',
  `sale_off` int(3) DEFAULT '0',
  `picture` text,
  `created` date,
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date,
  `modified_by` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `ordering` int(11) DEFAULT '10',
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


INSERT INTO `book` (`id`, `name`, `description`, `price`, `special`, `sale_off`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`) VALUES
(1, 'Sách C++', 'Dạy lập trình C++', '25000', 0, 0, 'hinh12.jpg', '2021-07-03', 'admin', NULL, NULL, 1, 2, 3),
(2, 'Sách PHP', 'Dạy lập trình PHP', '260000', 1, 1, 'hinh1.jpg', '2021-07-03', 'admin', '2021-07-03', 'admin', 1, 6, 2),
(3, 'Sách NodeJs', 'Dạy lập trình Nodejs', '33000', 1, 0, 'hinh5.jpg', '2021-07-03', 'admin', '2021-07-03', 'admin', 1, 3, 3),
(4, 'Sách C#', 'Dạy lập trình C#', '440000', 0, 1, 'hinh3.jpg', '2021-07-03', 'admin', '2021-07-04', 'admin', 1, 3, 8),
(5, 'Sách Java', 'Dạy lập trình Java', '430000', 0, 0, 'hinh8.jpg', '2021-07-03', 'admin', '2021-07-03', 'admin', 1, 2, 4),
(6, 'Sách Python', 'Dạy lập trình Python', '430000', 0, 0, 'hinh4.jpg', '2021-07-03', 'admin', '2021-07-03', 'admin', 1, 1, 1),
(7, 'Sách Laravel', 'Dạy lập trình Laravel', '100000', 1, 2, 'hinh6.jpg', '2021-07-03', 'admin', NULL, NULL, 1, 3, 3),
(8, 'doremon', 'hihihaha', '25000', 0, 0, 'hinh11.jpg', '2021-07-03', 'admin', '2021-07-04', 'admin', 1, 3, 8),
(9, 'connan', 'Sach thieu nhi', '50000', 0, 0, 'hinh10.jpg', '2021-07-04', 'admin', '2021-07-04', 'admin', 1, 4, 8);


--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `books` text NOT NULL,
  `prices` text NOT NULL,
  `quantities` text NOT NULL,
  `names` text NOT NULL,
  `pictures` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




