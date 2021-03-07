-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2021 at 10:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(20) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_surname` varchar(255) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `cus_tel` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail_order_food`
--

CREATE TABLE `detail_order_food` (
  `detail_order_food_id` int(50) NOT NULL,
  `order_food_id` int(50) NOT NULL,
  `food_id` int(50) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_order_food`
--

INSERT INTO `detail_order_food` (`detail_order_food_id`, `order_food_id`, `food_id`, `price`, `quantity`) VALUES
(1, 1, 2, 77, 2),
(2, 2, 1, 75, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_order_m`
--

CREATE TABLE `detail_order_m` (
  `detail_id` int(11) NOT NULL,
  `order_m_id` int(11) NOT NULL,
  `gene_id` int(20) NOT NULL,
  `gene` varchar(225) NOT NULL,
  `weight` float NOT NULL,
  `sex` varchar(255) NOT NULL,
  `buy_price` float NOT NULL,
  `sup_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_order_m`
--

INSERT INTO `detail_order_m` (`detail_id`, `order_m_id`, `gene_id`, `gene`, `weight`, `sex`, `buy_price`, `sup_id`) VALUES
(1, 1, 2, 'รุ่นพ่อพันธุ์', 50, 'ผู้', 78, 3),
(2, 2, 2, 'รุ่นแม่พันธุ์', 55, 'ผู้', 75, 2),
(3, 3, 2, 'รุ่นพ่อพันธุ์', 120, 'ผู้', 78, 2),
(4, 4, 1, 'รุ่นพ่อพันธุ์', 20, 'ผู้', 78, 3);

-- --------------------------------------------------------

--
-- Table structure for table `detail_order_material`
--

CREATE TABLE `detail_order_material` (
  `detail_order_material_id` int(50) NOT NULL,
  `order_material_id` int(50) NOT NULL,
  `material_id` int(50) NOT NULL,
  `price` int(50) NOT NULL,
  `quantity` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_order_material`
--

INSERT INTO `detail_order_material` (`detail_order_material_id`, `order_material_id`, `material_id`, `price`, `quantity`) VALUES
(1, 1, 1, 20, 10),
(2, 2, 1, 20, 1),
(3, 2, 2, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_order_pill`
--

CREATE TABLE `detail_order_pill` (
  `detail_order_pill_id` int(50) NOT NULL,
  `order_pill_id` int(20) NOT NULL,
  `pill_id` int(20) NOT NULL,
  `price` int(30) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_order_pill`
--

INSERT INTO `detail_order_pill` (`detail_order_pill_id`, `order_pill_id`, `pill_id`, `price`, `quantity`) VALUES
(1, 1, 1, 20, 2),
(2, 2, 2, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_use_pill`
--

CREATE TABLE `detail_use_pill` (
  `use_pill_id` int(50) NOT NULL,
  `treat_id` int(20) NOT NULL,
  `pill_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_use_pill`
--

INSERT INTO `detail_use_pill` (`use_pill_id`, `treat_id`, `pill_id`, `quantity`) VALUES
(1, 1, 2, 2),
(2, 2, 2, 2),
(3, 3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `em_id` int(20) NOT NULL,
  `em_name` varchar(100) NOT NULL,
  `em_surname` varchar(100) NOT NULL,
  `em_address` varchar(200) NOT NULL,
  `em_tel` varchar(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(50) NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `amount` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `price`, `amount`) VALUES
(1, 'อาหารสุกรพ่อพันธุ์', 75, 8),
(2, 'อาหารสุกรแม่พันธุ์', 77, 10);

-- --------------------------------------------------------

--
-- Table structure for table `gene`
--

CREATE TABLE `gene` (
  `gene_id` int(11) NOT NULL,
  `gene_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gene`
--

INSERT INTO `gene` (`gene_id`, `gene_name`) VALUES
(1, 'ขี้พร้า'),
(2, '3 สายเลือด');

-- --------------------------------------------------------

--
-- Table structure for table `hybridize`
--

CREATE TABLE `hybridize` (
  `hybridize_id` int(50) NOT NULL,
  `user_id` int(20) NOT NULL,
  `hybridize_f` varchar(50) NOT NULL,
  `hybridize_m` varchar(50) NOT NULL,
  `hybridize_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hybridize`
--

INSERT INTO `hybridize` (`hybridize_id`, `user_id`, `hybridize_f`, `hybridize_m`, `hybridize_date`) VALUES
(1, 4, '122KL', '121KL', '2021-02-10 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE `installment` (
  `installment_id` int(20) NOT NULL,
  `sale_id` int(20) NOT NULL,
  `date_install` date NOT NULL,
  `amount` float NOT NULL,
  `payfirst` double NOT NULL,
  `down` float NOT NULL,
  `month` int(20) NOT NULL,
  `status_pay` tinyint(4) NOT NULL COMMENT '1=ค้างชำระ, 2=จ่ายหมดเเล้ว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `installment`
--

INSERT INTO `installment` (`installment_id`, `sale_id`, `date_install`, `amount`, `payfirst`, `down`, `month`, `status_pay`) VALUES
(1, 2, '2021-02-22', 5850, 0, 3000, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `install_pay`
--

CREATE TABLE `install_pay` (
  `install_pay_id` int(20) NOT NULL,
  `installment_id` int(20) NOT NULL,
  `month_pay` int(20) NOT NULL,
  `amount_pay` float NOT NULL,
  `install_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(50) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `price` int(50) NOT NULL,
  `amount` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `material_name`, `price`, `amount`) VALUES
(1, 'ไซริงค์ฉีดยา', 20, 18),
(2, 'คีมตัดเบอร์หู', 15, 10);

-- --------------------------------------------------------

--
-- Table structure for table `moo`
--

CREATE TABLE `moo` (
  `moo_id` int(20) NOT NULL,
  `gene` varchar(255) NOT NULL,
  `stall_id` int(50) NOT NULL,
  `statusmoo_id` int(11) NOT NULL,
  `weight` float NOT NULL,
  `sex` varchar(255) NOT NULL,
  `buy_price` int(30) NOT NULL,
  `price_sale` float NOT NULL,
  `moo_number` varchar(255) NOT NULL,
  `ma_number` varchar(20) NOT NULL,
  `fa_number` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status_mo` tinyint(20) NOT NULL,
  `order_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `moo`
--

INSERT INTO `moo` (`moo_id`, `gene`, `stall_id`, `statusmoo_id`, `weight`, `sex`, `buy_price`, `price_sale`, `moo_number`, `ma_number`, `fa_number`, `image`, `status_mo`, `order_id`) VALUES
(1, 'รุ่นพ่อพันธุ์', 1, 1, 50, 'ผู้', 78, 5850, '121KL', '111KL', '111KL', 'S__10756139 (1).jpg', 3, 1),
(2, 'รุ่นแม่พันธุ์', 2, 2, 55, 'ผู้', 75, 6075, '122KL', '111KL', '111KL', 'S__10756139.jpg', 3, 2),
(3, 'รุ่นพ่อพันธุ์', 2, 2, 120, 'ผู้', 78, 11310, '123KL', '111KL', '111KL', 'w644.jfif', 2, 3),
(4, 'รุ่นพ่อพันธุ์', 1, 1, 22, 'ผู้', 78, 3666, '124KL', '123KL', '123KL', 'w644.jfif', 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_food`
--

CREATE TABLE `order_food` (
  `order_food_id` int(50) NOT NULL,
  `date_order_food` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` tinyint(50) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_food`
--

INSERT INTO `order_food` (`order_food_id`, `date_order_food`, `order_status`, `user_id`) VALUES
(1, '2021-02-22 20:56:26', 2, 5),
(2, '2021-02-22 20:56:48', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_material`
--

CREATE TABLE `order_material` (
  `order_material_id` int(50) NOT NULL,
  `date_order_material` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` tinyint(50) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_material`
--

INSERT INTO `order_material` (`order_material_id`, `date_order_material`, `order_status`, `user_id`) VALUES
(1, '2021-02-22 14:57:40', 2, 5),
(2, '2021-02-22 21:21:23', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_moo`
--

CREATE TABLE `order_moo` (
  `order_m_id` int(20) NOT NULL,
  `date_order_m` date NOT NULL,
  `status_m` tinyint(100) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_moo`
--

INSERT INTO `order_moo` (`order_m_id`, `date_order_m`, `status_m`, `user_id`) VALUES
(1, '2021-02-22', 2, 5),
(2, '2021-02-22', 2, 5),
(3, '2021-02-23', 2, 5),
(4, '2021-02-23', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_pill`
--

CREATE TABLE `order_pill` (
  `order_pill_id` int(50) NOT NULL,
  `date_order_pill` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` tinyint(50) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_pill`
--

INSERT INTO `order_pill` (`order_pill_id`, `date_order_pill`, `order_status`, `user_id`) VALUES
(1, '2021-02-22 20:54:27', 2, 5),
(2, '2021-02-22 20:55:12', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `pay_id` int(20) NOT NULL,
  `sale_id` int(20) NOT NULL,
  `pay_date` date NOT NULL,
  `amount_pay` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`pay_id`, `sale_id`, `pay_date`, `amount_pay`) VALUES
(1, 1, '2021-02-22', 6075);

-- --------------------------------------------------------

--
-- Table structure for table `pill`
--

CREATE TABLE `pill` (
  `pill_id` int(50) NOT NULL,
  `pill_name` varchar(255) NOT NULL,
  `price` int(50) NOT NULL,
  `amount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pill`
--

INSERT INTO `pill` (`pill_id`, `pill_name`, `price`, `amount`) VALUES
(1, 'แอมม๊อกซี่ซิลิน', 20, 12),
(2, 'แก้ท้องเสีย', 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(20) NOT NULL,
  `salary_date` date NOT NULL,
  `user_id` int(20) NOT NULL,
  `salary` float NOT NULL,
  `total_work` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`salary_id`, `salary_date`, `user_id`, `salary`, `total_work`) VALUES
(1, '2021-02-22', 3, 400, 6),
(2, '2021-02-22', 4, 400, 5);

-- --------------------------------------------------------

--
-- Table structure for table `salling`
--

CREATE TABLE `salling` (
  `sale_id` int(20) NOT NULL,
  `moo_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `date_sale` datetime NOT NULL DEFAULT current_timestamp(),
  `type_pay` int(11) NOT NULL COMMENT '1=จ่ายสด , 2=ผ่อน',
  `status_send` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salling`
--

INSERT INTO `salling` (`sale_id`, `moo_id`, `user_id`, `date_sale`, `type_pay`, `status_send`) VALUES
(1, 2, 166, '2021-02-23 04:17:23', 1, 2),
(2, 1, 167, '2021-02-23 04:21:37', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `send`
--

CREATE TABLE `send` (
  `send_id` int(200) NOT NULL,
  `sale_id` int(50) NOT NULL,
  `user_id` int(20) NOT NULL,
  `status_send` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `send`
--

INSERT INTO `send` (`send_id`, `sale_id`, `user_id`, `status_send`) VALUES
(1, 1, 166, 2),
(2, 2, 167, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stall`
--

CREATE TABLE `stall` (
  `stall_id` int(20) NOT NULL,
  `stall_name` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stall`
--

INSERT INTO `stall` (`stall_id`, `stall_name`, `amount`) VALUES
(1, 'คอกสุกรพ่อพันธุ์', 0),
(2, 'คอกสุกรแม่พันธุ์', 0),
(3, 'คอกสุกรขุ่น', 0);

-- --------------------------------------------------------

--
-- Table structure for table `statusmoo`
--

CREATE TABLE `statusmoo` (
  `statusmoo_id` int(20) NOT NULL,
  `statusmoo_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statusmoo`
--

INSERT INTO `statusmoo` (`statusmoo_id`, `statusmoo_name`) VALUES
(1, 'สุกรรุ่นพ่อ'),
(2, 'สุกรรุ่นแม่'),
(3, 'สุกรรุ่นขุ่น'),
(4, 'สุกรรุ่นเล็ก');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `sup_id` int(10) NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `sup_tel` varchar(10) NOT NULL,
  `sup_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`sup_id`, `sup_name`, `sup_tel`, `sup_address`) VALUES
(1, 'บริษัท เบทาโกร จำกัด', '0863385546', '145/1 หมู่ 1 ต.ยายชา อำเภอสามพราน นครปฐม 73110'),
(2, 'เอสเจเอฟ ฟาร์ม ', '0909465420', 'หมู่ที่ 8 113 ลำพยา ตำบล หนองดินแดง อำเภอเมืองนครปฐม นครปฐม 73000'),
(3, 'บริษัท สามพรานฟาร์ม จำกัด', '0854247855', '145/1 หมู่ 1 ต.ยายชา อำเภอสามพราน นครปฐม 73110');

-- --------------------------------------------------------

--
-- Table structure for table `treat`
--

CREATE TABLE `treat` (
  `treat_id` int(50) NOT NULL,
  `moo_id` int(20) NOT NULL,
  `detail_treat` varchar(255) NOT NULL,
  `status_treat` tinyint(150) NOT NULL,
  `treat_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treat`
--

INSERT INTO `treat` (`treat_id`, `moo_id`, `detail_treat`, `status_treat`, `treat_date`) VALUES
(1, 2, 'โรคท้องเสีย', 7, '2021-02-22'),
(2, 3, 'โรคท้องเสีย', 7, '2021-02-21'),
(3, 4, 'โรคท้องเสีย', 7, '2021-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `usefood`
--

CREATE TABLE `usefood` (
  `usefood_id` int(50) NOT NULL,
  `date_use` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `em_id` int(50) NOT NULL,
  `food_id` int(50) NOT NULL,
  `stall_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `use_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usefood`
--

INSERT INTO `usefood` (`usefood_id`, `date_use`, `em_id`, `food_id`, `stall_id`, `user_id`, `quantity`, `use_date`) VALUES
(1, '2021-02-22 21:14:32', 0, 1, 1, 4, 2, '2021-02-22 21:14:32'),
(2, '2021-02-23 03:19:02', 0, 2, 2, 4, 2, '2021-02-23 03:19:02'),
(3, '2021-02-23 04:35:53', 0, 1, 1, 4, 2, '2021-02-23 04:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `usematerial`
--

CREATE TABLE `usematerial` (
  `usematerial_id` int(50) NOT NULL,
  `material_id` int(50) NOT NULL,
  `date_use` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `em_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `quantity` int(20) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usematerial`
--

INSERT INTO `usematerial` (`usematerial_id`, `material_id`, `date_use`, `em_id`, `user_id`, `quantity`, `status`) VALUES
(1, 2, '2021-02-22 20:58:29', 0, 5, 2, 'ยกเลิกการเบิก'),
(2, 1, '2021-02-23 03:02:36', 0, 5, 2, 'เบิกอุปกรณ์แล้ว'),
(3, 2, '2021-02-23 04:36:28', 0, 5, 2, 'ยกเลิกการเบิก');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(10) NOT NULL COMMENT '1=admin,2=พนง,3=ลูกค้า',
  `status` int(11) NOT NULL COMMENT '1=อนุญาต 2=บล็อก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `surname`, `email`, `tel`, `address`, `username`, `password`, `level`, `status`) VALUES
(1, 'อะรีน่า', 'หลีหนุด', 'aleena@gmail.com', '0878945612', '109/3 ต.หาดใหญ่ อ.หาดใหญ่ จ.สงขลา', 'aleena', '123', 3, 1),
(2, 'ศราวุธ', 'สุวรรณมณี', 'Kong@gmail.com', '08674523', '78 ต.ปะการอ อ.เมือง จ.ปัตตานี', 'kong', '123', 3, 1),
(3, 'กุลฐธิดา', 'เล็กกุล', 'pan@gmailcom', '0935908603', '8 ต.ตุยง อ.เมือง จ.ปัตตานี', 'pan', '123', 2, 1),
(4, 'ซูอัยลา', 'ยูโซ๊ะ', 'Sula@gmail.com', '0878965235', '2 ต.บานา อ.เมือง จ.ปัตตานี', 'sula', '1234', 2, 1),
(5, 'พรทิพย์', 'สมบัติทอง', 'Porntip@gmail.com', '0935908603', 'ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120', 'admin', '123', 1, 1),
(166, 'มาเรียม', 'มะแก๊ะ', '0', '0', '0', '0', '0', 3, 1),
(167, 'รัตนากร', 'รอดสุด', '0', '0', '0', '0', '0', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `detail_order_food`
--
ALTER TABLE `detail_order_food`
  ADD PRIMARY KEY (`detail_order_food_id`);

--
-- Indexes for table `detail_order_m`
--
ALTER TABLE `detail_order_m`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `detail_order_material`
--
ALTER TABLE `detail_order_material`
  ADD PRIMARY KEY (`detail_order_material_id`);

--
-- Indexes for table `detail_order_pill`
--
ALTER TABLE `detail_order_pill`
  ADD PRIMARY KEY (`detail_order_pill_id`);

--
-- Indexes for table `detail_use_pill`
--
ALTER TABLE `detail_use_pill`
  ADD PRIMARY KEY (`use_pill_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`em_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `gene`
--
ALTER TABLE `gene`
  ADD PRIMARY KEY (`gene_id`);

--
-- Indexes for table `hybridize`
--
ALTER TABLE `hybridize`
  ADD PRIMARY KEY (`hybridize_id`);

--
-- Indexes for table `installment`
--
ALTER TABLE `installment`
  ADD PRIMARY KEY (`installment_id`);

--
-- Indexes for table `install_pay`
--
ALTER TABLE `install_pay`
  ADD PRIMARY KEY (`install_pay_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `moo`
--
ALTER TABLE `moo`
  ADD PRIMARY KEY (`moo_id`);

--
-- Indexes for table `order_food`
--
ALTER TABLE `order_food`
  ADD PRIMARY KEY (`order_food_id`);

--
-- Indexes for table `order_material`
--
ALTER TABLE `order_material`
  ADD PRIMARY KEY (`order_material_id`);

--
-- Indexes for table `order_moo`
--
ALTER TABLE `order_moo`
  ADD PRIMARY KEY (`order_m_id`);

--
-- Indexes for table `order_pill`
--
ALTER TABLE `order_pill`
  ADD PRIMARY KEY (`order_pill_id`);

--
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `pill`
--
ALTER TABLE `pill`
  ADD PRIMARY KEY (`pill_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `salling`
--
ALTER TABLE `salling`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `send`
--
ALTER TABLE `send`
  ADD PRIMARY KEY (`send_id`);

--
-- Indexes for table `stall`
--
ALTER TABLE `stall`
  ADD PRIMARY KEY (`stall_id`);

--
-- Indexes for table `statusmoo`
--
ALTER TABLE `statusmoo`
  ADD PRIMARY KEY (`statusmoo_id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `treat`
--
ALTER TABLE `treat`
  ADD PRIMARY KEY (`treat_id`);

--
-- Indexes for table `usefood`
--
ALTER TABLE `usefood`
  ADD PRIMARY KEY (`usefood_id`);

--
-- Indexes for table `usematerial`
--
ALTER TABLE `usematerial`
  ADD PRIMARY KEY (`usematerial_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_order_food`
--
ALTER TABLE `detail_order_food`
  MODIFY `detail_order_food_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_order_m`
--
ALTER TABLE `detail_order_m`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detail_order_material`
--
ALTER TABLE `detail_order_material`
  MODIFY `detail_order_material_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_order_pill`
--
ALTER TABLE `detail_order_pill`
  MODIFY `detail_order_pill_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_use_pill`
--
ALTER TABLE `detail_use_pill`
  MODIFY `use_pill_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `em_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gene`
--
ALTER TABLE `gene`
  MODIFY `gene_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hybridize`
--
ALTER TABLE `hybridize`
  MODIFY `hybridize_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `installment`
--
ALTER TABLE `installment`
  MODIFY `installment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `install_pay`
--
ALTER TABLE `install_pay`
  MODIFY `install_pay_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `moo`
--
ALTER TABLE `moo`
  MODIFY `moo_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_food`
--
ALTER TABLE `order_food`
  MODIFY `order_food_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_material`
--
ALTER TABLE `order_material`
  MODIFY `order_material_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_moo`
--
ALTER TABLE `order_moo`
  MODIFY `order_m_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_pill`
--
ALTER TABLE `order_pill`
  MODIFY `order_pill_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `pay_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pill`
--
ALTER TABLE `pill`
  MODIFY `pill_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salling`
--
ALTER TABLE `salling`
  MODIFY `sale_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `send`
--
ALTER TABLE `send`
  MODIFY `send_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stall`
--
ALTER TABLE `stall`
  MODIFY `stall_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statusmoo`
--
ALTER TABLE `statusmoo`
  MODIFY `statusmoo_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `sup_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `treat`
--
ALTER TABLE `treat`
  MODIFY `treat_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usefood`
--
ALTER TABLE `usefood`
  MODIFY `usefood_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usematerial`
--
ALTER TABLE `usematerial`
  MODIFY `usematerial_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
