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