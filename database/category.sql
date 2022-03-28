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

--
-- Dumping data for table `category`
--

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
