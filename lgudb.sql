-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 11:59 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lgudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_token`
--

CREATE TABLE `access_token` (
  `access_token_id` int(11) NOT NULL,
  `token` text DEFAULT NULL,
  `secret_key` text DEFAULT NULL,
  `hashed_key` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_token`
--

INSERT INTO `access_token` (`access_token_id`, `token`, `secret_key`, `hashed_key`) VALUES
(2, '881c45-85d223-f136', 'bUhlR25wZ3FSbktIUGpvNTJuMjA3UmZaL2VGTGpWT2ZPdWc5T2srdS9IVT0=', '$2y$10$RWDmy8EqORLIaPuzdP6He.z5b4GJcsouek58N5zd.cUvTmDbAbWe2');

-- --------------------------------------------------------

--
-- Table structure for table `card_type`
--

CREATE TABLE `card_type` (
  `card_type_id` int(11) NOT NULL,
  `card_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_type`
--

INSERT INTO `card_type` (`card_type_id`, `card_name`) VALUES
(1, 'Passport'),
(2, 'Voters ID'),
(4, 'Drivers License'),
(5, 'SSS ID'),
(6, 'PRC License'),
(7, 'School ID'),
(8, 'Postal ID'),
(9, 'GSIS UMID'),
(10, 'ax Identification Number (TIN) ID'),
(11, 'Senior Citizen Card'),
(12, 'NSO Authenticated Birth Certificate'),
(13, 'Alien Certificate of Registration'),
(14, 'Copy of Previous NBI Clearance');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `children_id` int(11) NOT NULL,
  `lgu_constituent_id` bigint(20) NOT NULL,
  `name` text DEFAULT NULL,
  `birthplace` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`children_id`, `lgu_constituent_id`, `name`, `birthplace`) VALUES
(29, 36, 'Basti Artadi', 'Makati'),
(30, 36, 'Gab Alipe', 'USA'),
(49, 39, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `comp_shop`
--

CREATE TABLE `comp_shop` (
  `comp_shop_id` int(11) NOT NULL,
  `month` varchar(255) DEFAULT NULL,
  `date_applied` date DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `lgu_constituent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comp_shop`
--

INSERT INTO `comp_shop` (`comp_shop_id`, `month`, `date_applied`, `plan`, `signature`, `entry_date`, `amount`, `remarks`, `lgu_constituent_id`) VALUES
(1, NULL, '2020-06-24', NULL, NULL, '2020-06-23', '6500.00', 'TEST', NULL),
(2, NULL, '2020-06-24', NULL, NULL, '2020-06-23', '8500.00', 'TEST', NULL),
(3, NULL, '2020-06-30', NULL, NULL, '2020-06-23', '2500.00', 'TEST', NULL),
(4, NULL, '2020-05-20', NULL, NULL, '2020-06-23', '2500.00', 'TEST2', NULL),
(5, NULL, '2020-10-28', NULL, NULL, '2020-06-23', '15000.00', 'TEST', NULL),
(6, NULL, '2020-06-25', NULL, NULL, '2020-06-23', '15000.00', 'TEST', NULL),
(7, NULL, '2020-06-24', NULL, NULL, '2020-06-23', '15000.00', 'TEST', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `constituent_living_status`
--

CREATE TABLE `constituent_living_status` (
  `cons_living_status_id` int(11) NOT NULL,
  `lgu_constituent_id` bigint(20) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `constituent_living_status`
--

INSERT INTO `constituent_living_status` (`cons_living_status_id`, `lgu_constituent_id`, `status_id`, `id`) VALUES
(11, 39, 1, ''),
(12, 39, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `education_id` int(11) NOT NULL,
  `education_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`education_id`, `education_name`) VALUES
(1, 'Master/Doctorate Degree'),
(2, 'Bachelor Degree'),
(3, 'Vocational Degree'),
(4, 'Secondary');

-- --------------------------------------------------------

--
-- Table structure for table `government_card`
--

CREATE TABLE `government_card` (
  `government_card_id` int(11) NOT NULL,
  `lgu_constituent_id` bigint(20) NOT NULL,
  `id_name` text DEFAULT NULL COMMENT 'card_type_id in card_type table',
  `id_number` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `government_card`
--

INSERT INTO `government_card` (`government_card_id`, `lgu_constituent_id`, `id_name`, `id_number`) VALUES
(22, 36, '1', '000234'),
(23, 36, '5', '3551252551'),
(24, 36, '4', '005252'),
(25, 36, '2', '9288234'),
(53, 39, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lgu_constituent`
--

CREATE TABLE `lgu_constituent` (
  `lgu_constituent_id` bigint(20) NOT NULL,
  `social_status` text DEFAULT NULL COMMENT '1 = Person with disability, 2 = Senior Citizen, 3 = Solo Parent, 4 = 4Ps Benificiary ',
  `pwd_id` text DEFAULT NULL COMMENT 'if not null it means social_status is 1',
  `is_house_owner` tinyint(1) DEFAULT 0,
  `house_type` int(11) DEFAULT NULL COMMENT '1 = House, 2 = Dormitory, 3 = Apartment',
  `tel_no` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `first_name` text DEFAULT NULL,
  `last_name` text DEFAULT NULL,
  `middle_name` text DEFAULT NULL,
  `gender` tinytext DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `religion` text DEFAULT NULL COMMENT '1 = Catholic, 2 = Muslim, 3 = Others - Data in religion_desc field',
  `religion_desc` text DEFAULT NULL,
  `highest_educ_attmnt` tinyint(4) DEFAULT NULL COMMENT '1 = Master/Doctorate Degree, 2 = Bachelor Degree, 3 = Vocational Degree, 4 = Secondary',
  `occupation` text DEFAULT NULL,
  `ofc_address` text DEFAULT NULL,
  `ofc_contact` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `residential_address` text DEFAULT NULL,
  `citizenship` text DEFAULT NULL,
  `birthplace` text DEFAULT NULL,
  `civil_status` text DEFAULT NULL,
  `other_name` text DEFAULT NULL,
  `spouce_name` text DEFAULT NULL,
  `spouce_birth_place` text DEFAULT NULL,
  `fathers_name` text DEFAULT NULL,
  `fathers_birth_place` text DEFAULT NULL,
  `mothers_name` text DEFAULT NULL,
  `mothers_birth_place` text DEFAULT NULL,
  `height` text DEFAULT NULL,
  `weight` text DEFAULT NULL,
  `identifying_marks` text DEFAULT NULL,
  `member_type` tinyint(1) DEFAULT 0 COMMENT '0 = member, 1 = vendo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lgu_constituent`
--

INSERT INTO `lgu_constituent` (`lgu_constituent_id`, `social_status`, `pwd_id`, `is_house_owner`, `house_type`, `tel_no`, `mobile`, `first_name`, `last_name`, `middle_name`, `gender`, `age`, `dob`, `religion`, `religion_desc`, `highest_educ_attmnt`, `occupation`, `ofc_address`, `ofc_contact`, `email`, `user_id`, `transaction_date`, `is_deleted`, `residential_address`, `citizenship`, `birthplace`, `civil_status`, `other_name`, `spouce_name`, `spouce_birth_place`, `fathers_name`, `fathers_birth_place`, `mothers_name`, `mothers_birth_place`, `height`, `weight`, `identifying_marks`, `member_type`) VALUES
(35, '1|2|3', '00062424', 1, 1, '7899234', '09773656715', 'andolino', 'baisac', 'gallardo', 'MALE', 29, '1990-11-06', '3', 'Church of God', 2, 'Developer', 'Amorsolo Street', '09773394923', 'baisac.andolino@gmail.com', 1, '2020-06-23', 0, '127 Caimito St. Blk 5 West Rembos', 'filipino', 'makati', '', 'dondon', 'Queenie Jane Paniamogan Casera', 'Matinao Mainit Surigao Del Sur', 'Charleto Casera', 'Matinao', 'Jinkee Paniamogan Casera', 'Matinao 2', '172cm', '76lbs', '--', 1),
(36, NULL, NULL, 0, 1, '7424525', '09673232424', 'juan', 'dela cruz', 'g', 'MALE', 33, '1987-02-21', '1', NULL, 2, 'Musician', 'Quezon City', '9328392', 'juandelacruz@gmail.com', 1, '2020-03-26', 0, '299 Maibini St. San Roque Quezon City', 'filipino', 'Makati', 'Single', 'John', 'Erlinda Dela Tore', 'Makati', 'Ramon Magsaysay', 'Zambales', 'Imelda Popin', 'Quezon Province', '160cm', '69lbs', '--', 0),
(38, NULL, NULL, 1, 1, '7529923', '09282783742', 'Peter', 'Mora', 'Bilyones', 'MALE', 33, '1987-12-28', '1', NULL, 2, 'Developer', 'Mandaluyong Pasig City', '9288234', 'morap@gmail.com', 1, '2020-06-22', 0, '122 Blk 5 Tubo Gaming West Rembo Makati City', 'Filipino', 'Makati', '', 'Alien', 'Alliah Castillano', 'Cavite', 'Henry James Keenan Mora', 'Makati', 'Cleopatra Mora', 'Makati 2', '170cm', '72lbs', '--', 0),
(39, NULL, NULL, 1, 1, '823823', '0923888238', 'Julie Ann', 'San Jose', 'G', 'MALE', 23, '1994-11-06', '1', NULL, 2, 'developer', 'Makati Office', '9238239', 'juliedon@gmail.com', 1, '2020-03-30', 0, '127 Caimito St. Blk 5 West Rembo', 'Filipino', 'makati', '', 'donjulie', 'dondon pentavia', 'makati', 'alvin fructuso', 'manila', 'apple mae aranas', 'balioag', '171cm', '55', 'no tattoo', 0),
(40, NULL, NULL, 1, NULL, NULL, NULL, 'TEST2', 'TEST', 'TEST3', 'MALE', 25, '2020-06-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-06-23', 0, 'TEST @ ', 'TEST6', 'TEST5', '', 'TEST4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(41, NULL, NULL, 1, NULL, NULL, NULL, 'John Paul', 'Macalood', 'G', 'MALE', 25, '1995-06-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-06-23', 0, NULL, 'Filipino', 'Makati', 'Single', 'Jampong', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(42, NULL, NULL, 0, NULL, NULL, NULL, 'Jeriel', 'Gallofin', 'G', 'MALE', 25, '2020-06-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-06-23', 0, '127 Caimito St. Blk 5 West Rembo Makati City', 'Filipino', 'Makati', 'Single', 'Netoy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `living_status`
--

CREATE TABLE `living_status` (
  `living_status_id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `living_status`
--

INSERT INTO `living_status` (`living_status_id`, `name`) VALUES
(1, 'Person with disability'),
(2, 'Senior Citizen'),
(3, 'Solo Parent'),
(4, '4Ps Benificiary');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_bills`
--

CREATE TABLE `monthly_bills` (
  `monthly_bills_id` int(11) NOT NULL,
  `month` varchar(255) DEFAULT NULL,
  `date_applied` date DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `lgu_constituent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monthly_bills`
--

INSERT INTO `monthly_bills` (`monthly_bills_id`, `month`, `date_applied`, `plan`, `signature`, `entry_date`, `amount`, `remarks`, `lgu_constituent_id`) VALUES
(2, 'March', '2020-06-24', '1200', NULL, '2020-06-22', '1600.00', 'TEST', 35),
(3, 'January', '2020-04-24', '1200', NULL, '2020-06-22', '1200.00', '0.00', 36),
(4, 'June', '2020-05-24', '1200', NULL, '2020-06-22', '1500.00', '0.00', 35),
(5, 'January', '2020-01-23', '1200', NULL, '2020-06-23', '1200.00', 'TEST REMARKSSSSS', 38);

-- --------------------------------------------------------

--
-- Table structure for table `residential`
--

CREATE TABLE `residential` (
  `residential_id` int(11) NOT NULL,
  `residential_type` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `residential`
--

INSERT INTO `residential` (`residential_id`, `residential_type`) VALUES
(1, 'House'),
(2, 'Dormitory'),
(3, 'Apartment');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `uploads_id` int(11) NOT NULL,
  `lgu_constituent_id` bigint(20) NOT NULL,
  `image_name` text DEFAULT NULL,
  `image_path` text DEFAULT NULL,
  `file_name` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `transaction_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`uploads_id`, `lgu_constituent_id`, `image_name`, `image_path`, `file_name`, `file_path`, `transaction_date`) VALUES
(1, 35, 'tobi__the_masked_ninja_from_akatsuki_by_beu2v_dbtmcz6-fullview4.jpg', 'C:/xampp/htdocs/lgu/assets/image/uploads/', NULL, NULL, '2020-03-29'),
(3, 36, '89260743_2658694764411607_948672185790002051_n.jpg', 'C:/xampp/htdocs/lgu/assets/image/uploads/', NULL, NULL, '2020-03-28'),
(5, 38, 'tobi__the_masked_ninja_from_akatsuki_by_beu2v_dbtmcz6-fullview.jpg', 'C:/xampp/htdocs/lgu/assets/image/uploads/', NULL, NULL, '2020-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `screen_name` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `txt_password` text DEFAULT NULL,
  `trans_date` date DEFAULT NULL,
  `trans_desc` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `screen_name`, `username`, `password`, `txt_password`, `trans_date`, `trans_desc`, `is_deleted`) VALUES
(1, 'Admin', 'user1', '$2y$10$uPvqmqcvvej1HgnM1D6wOOCKKlV9Uwh6/ctrnpMEE9RjOCKV8yWBO', '123456', '2020-03-23', 'add', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendo`
--

CREATE TABLE `vendo` (
  `vendo_id` int(11) NOT NULL,
  `month` varchar(255) DEFAULT NULL,
  `date_applied` date DEFAULT NULL,
  `plan` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT 0.00,
  `remarks` varchar(255) DEFAULT NULL,
  `lgu_constituent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendo`
--

INSERT INTO `vendo` (`vendo_id`, `month`, `date_applied`, `plan`, `signature`, `entry_date`, `amount`, `remarks`, `lgu_constituent_id`) VALUES
(1, NULL, '2020-07-02', NULL, NULL, '2020-06-23', '15000.00', 'TEST REMARKS', 41),
(2, NULL, '2020-08-19', NULL, NULL, '2020-06-23', '58000.00', 'TEST REMARKS', 41),
(3, NULL, '2020-06-24', NULL, NULL, '2020-06-23', '20000.00', 'TEST REMARKS', 41),
(4, NULL, '2020-06-18', NULL, NULL, '2020-06-23', '27000.00', 'TEST REMARKS 2', 35),
(5, NULL, '2020-06-18', NULL, NULL, '2020-06-23', '15000.00', 'TEST REMARKS AGAIN', 42);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_vendo`
-- (See below for the actual view)
--
CREATE TABLE `v_vendo` (
`vendo_id` int(11)
,`month` varchar(255)
,`date_applied` date
,`plan` varchar(255)
,`signature` varchar(255)
,`entry_date` date
,`amount` decimal(12,2)
,`remarks` varchar(255)
,`lgu_constituent_id` int(11)
,`first_name` text
,`last_name` text
,`middle_name` text
);

-- --------------------------------------------------------

--
-- Structure for view `v_vendo`
--
DROP TABLE IF EXISTS `v_vendo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_vendo`  AS  select `v`.`vendo_id` AS `vendo_id`,`v`.`month` AS `month`,`v`.`date_applied` AS `date_applied`,`v`.`plan` AS `plan`,`v`.`signature` AS `signature`,`v`.`entry_date` AS `entry_date`,`v`.`amount` AS `amount`,`v`.`remarks` AS `remarks`,`v`.`lgu_constituent_id` AS `lgu_constituent_id`,`m`.`first_name` AS `first_name`,`m`.`last_name` AS `last_name`,`m`.`middle_name` AS `middle_name` from (`vendo` `v` left join `lgu_constituent` `m` on(`m`.`lgu_constituent_id` = `v`.`lgu_constituent_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_token`
--
ALTER TABLE `access_token`
  ADD PRIMARY KEY (`access_token_id`);

--
-- Indexes for table `card_type`
--
ALTER TABLE `card_type`
  ADD PRIMARY KEY (`card_type_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`children_id`),
  ADD KEY `lgu_constituent_id` (`lgu_constituent_id`);

--
-- Indexes for table `comp_shop`
--
ALTER TABLE `comp_shop`
  ADD PRIMARY KEY (`comp_shop_id`);

--
-- Indexes for table `constituent_living_status`
--
ALTER TABLE `constituent_living_status`
  ADD PRIMARY KEY (`cons_living_status_id`),
  ADD KEY `lgu_constituent_id` (`lgu_constituent_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`);

--
-- Indexes for table `government_card`
--
ALTER TABLE `government_card`
  ADD PRIMARY KEY (`government_card_id`),
  ADD KEY `lgu_constituent_id` (`lgu_constituent_id`);

--
-- Indexes for table `lgu_constituent`
--
ALTER TABLE `lgu_constituent`
  ADD PRIMARY KEY (`lgu_constituent_id`);

--
-- Indexes for table `living_status`
--
ALTER TABLE `living_status`
  ADD PRIMARY KEY (`living_status_id`);

--
-- Indexes for table `monthly_bills`
--
ALTER TABLE `monthly_bills`
  ADD PRIMARY KEY (`monthly_bills_id`);

--
-- Indexes for table `residential`
--
ALTER TABLE `residential`
  ADD PRIMARY KEY (`residential_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`uploads_id`),
  ADD KEY `lgu_constituent_id` (`lgu_constituent_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `vendo`
--
ALTER TABLE `vendo`
  ADD PRIMARY KEY (`vendo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_token`
--
ALTER TABLE `access_token`
  MODIFY `access_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `card_type`
--
ALTER TABLE `card_type`
  MODIFY `card_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `children_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `comp_shop`
--
ALTER TABLE `comp_shop`
  MODIFY `comp_shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `constituent_living_status`
--
ALTER TABLE `constituent_living_status`
  MODIFY `cons_living_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `government_card`
--
ALTER TABLE `government_card`
  MODIFY `government_card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `lgu_constituent`
--
ALTER TABLE `lgu_constituent`
  MODIFY `lgu_constituent_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `living_status`
--
ALTER TABLE `living_status`
  MODIFY `living_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `monthly_bills`
--
ALTER TABLE `monthly_bills`
  MODIFY `monthly_bills_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `residential`
--
ALTER TABLE `residential`
  MODIFY `residential_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `uploads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendo`
--
ALTER TABLE `vendo`
  MODIFY `vendo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_ibfk_1` FOREIGN KEY (`lgu_constituent_id`) REFERENCES `lgu_constituent` (`lgu_constituent_id`);

--
-- Constraints for table `constituent_living_status`
--
ALTER TABLE `constituent_living_status`
  ADD CONSTRAINT `constituent_living_status_ibfk_1` FOREIGN KEY (`lgu_constituent_id`) REFERENCES `lgu_constituent` (`lgu_constituent_id`);

--
-- Constraints for table `government_card`
--
ALTER TABLE `government_card`
  ADD CONSTRAINT `government_card_ibfk_1` FOREIGN KEY (`lgu_constituent_id`) REFERENCES `lgu_constituent` (`lgu_constituent_id`);

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`lgu_constituent_id`) REFERENCES `lgu_constituent` (`lgu_constituent_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
