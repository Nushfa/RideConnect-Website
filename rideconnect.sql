-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 04:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carmaxx`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `discription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `img`, `Title`, `discription`) VALUES
(1, 'images/one.jpg', 'FIND YOUR VEHICLE', 'Step into confidence.'),
(2, 'images/three.jpg', 'FIND YOUR VEHICLE', 'Step into confidence.'),
(3, 'images/two.jpg', 'FIND YOUR VEHICLE', 'Step into confidence.'),
(5, 'images/31.jpg', 'FIND YOUR VEHICLE', 'Step into confidence.');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `name`, `email`, `message`) VALUES
(1, 'akib', 'akib@gmail.com', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `footericon`
--

CREATE TABLE `footericon` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footericon`
--

INSERT INTO `footericon` (`id`, `name`, `class`, `link`) VALUES
(1, 'Facebook', 'fab fa-facebook-f', 'https://www.facebook.com/'),
(2, 'Twitter', 'fab fa-twitter', 'https://twitter.com/i/flow/login?input_flow_data=%7B%22requested_variant%22%3A%22eyJsYW5nIjoiZW4ifQ%3D%3D%22%7D'),
(3, 'Instagram', 'fab fa-instagram', 'https://www.instagram.com/accounts/login/'),
(4, 'Linkedin', 'fab fa-linkedin-in', 'https://www.linkedin.com/login');

-- --------------------------------------------------------

--
-- Table structure for table `footermenus`
--

CREATE TABLE `footermenus` (
  `id` int(11) NOT NULL,
  `QuickLinks` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `year` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `footermenus`
--

INSERT INTO `footermenus` (`id`, `QuickLinks`, `ref`, `year`) VALUES
(1, 'Post', 'Privatepage.php', 2021),
(2, 'About Us', 'aboutUsPage.php', NULL),
(3, 'Own', 'TeamPage.php', NULL),
(4, 'Contact Us', 'contactUs.php', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hometopicon`
--

CREATE TABLE `hometopicon` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `discription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hometopicon`
--

INSERT INTO `hometopicon` (`id`, `icon`, `title`, `discription`) VALUES
(1, 'fas fa-home', '6+ branches', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia, architecto! Vitae, harum illum eligendi beatae odio architecto, asperiores ullam repudiandae explicabo optio modi voluptates!'),
(2, 'fas fa-users', '320+ happy clients', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia, architecto! Vitae, harum illum eligendi beatae odio architecto, asperiores ullam repudiandae explicabo optio modi voluptates!'),
(3, 'fas fa-car', '1500+ news cars', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia, architecto! Vitae, harum illum eligendi beatae odio architecto, asperiores ullam repudiandae explicabo optio modi voluptates!');

UPDATE `hometopicon` SET `discription` = 'Our branches across the country are dedicated to providing a seamless buying and selling experience for all types of vehicles. Each location offers a diverse selection, including cars, trucks, SUVs, motorcycles, and recreational vehicles, to meet the unique needs of our customers. Whether you are searching for a fuel-efficient commuter vehicle, a family-friendly SUV, a powerful truck, or a recreational vehicle for your adventures, our knowledgeable and friendly staff are ready to assist you. With a commitment to quality and customer satisfaction, we strive to make your vehicle buying journey enjoyable and stress-free. Visit any of our branches to discover a wide range of vehicles and exceptional service.\r\n' WHERE `hometopicon`.`id` = 1; UPDATE `hometopicon` SET `discription` = 'At our branches nationwide, we are dedicated to ensuring every client leaves with a smile. Our extensive inventory includes a wide variety of vehicles such as cars, trucks, SUVs, motorcycles, and recreational vehicles, catering to every need and preference. Our knowledgeable and friendly staff are committed to providing personalized service, guiding you through every step of the buying and selling process with ease and transparency. We take pride in delivering high-quality vehicles and exceptional customer service, ensuring a smooth and satisfying experience. Visit any of our branches to find your perfect vehicle and join our community of happy clients.' WHERE `hometopicon`.`id` = 2; UPDATE `hometopicon` SET `title` = '1500+ new Vehicles', `discription` = 'At our branches nationwide, we are dedicated to providing a premier selection of new vehicles to meet every clients needs. Our extensive inventory includes the latest models of cars, trucks, SUVs, motorcycles, and recreational vehicles, ensuring you have access to cutting-edge technology, safety features, and stylish designs. Our knowledgeable and friendly staff are committed to offering personalized service, guiding you through the process with ease and transparency. We pride ourselves on delivering high-quality new vehicles and exceptional customer service, ensuring a smooth and satisfying experience. Visit any of our branches to explore our wide range of new vehicles and drive away with confidence.' WHERE `hometopicon`.`id` = 3;
-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `email`, `phone`, `password`) VALUES
(6, 'ar56', 'a@gmail.com', '014444555', '4124bc0a9335c27f086f24ba207a4912'),
(7, 'a', 'mmahinm10@gmail.com', 'a', '4124bc0a9335c27f086f24ba207a4912'),
(8, 'a', 'a1@gmail.com', '41515', '4124bc0a9335c27f086f24ba207a4912');

-- --------------------------------------------------------

--
-- Table structure for table `nav`
--

CREATE TABLE `nav` (
  `id` int(11) NOT NULL,
  `link` varchar(300) NOT NULL,
  `title` varchar(200) NOT NULL,
  `db` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nav`
--

INSERT INTO `nav` (`id`, `link`, `title`, `db`) VALUES
(1, 'index.php', 'Home', 'RideConnect'),
(2, 'Cart.php', 'Vehicles', NULL),
(3, 'Privatepage.php', 'Post', NULL),
(4, 'contactUs.php', 'Contact', NULL),
(5, 'TeamPage.php', 'Own', NULL),
(6, 'aboutUsPage.php', 'About Us', NULL),
(7, 'profile.php', 'Profile', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_cars`
--

CREATE TABLE `order_vehicles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `vehicle_price` float NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------


CREATE TABLE `servicesection` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `discription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servicesection`
--

INSERT INTO `servicesection` (`id`, `icon`, `title`, `discription`) VALUES
(1, 'fas fa-car', 'car selling', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia, architecto! Vitae, harum illum eligendi beatae odio architecto, asperiores ullam repudiandae explicabo optio modi voluptates!'),
(2, 'fas fa-car-crash', 'car insurance', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia, architecto! Vitae, harum illum eligendi beatae odio architecto, asperiores ullam repudiandae explicabo optio modi voluptates!'),
(3, 'fas fa-headset', '24/7 support', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia, architecto! Vitae, harum illum eligendi beatae odio architecto, asperiores ullam repudiandae explicabo optio modi voluptates!');

UPDATE `servicesection` SET `discription` = 'Our vehicle buying and selling website offers a comprehensive range of services to streamline the process for users. Sellers can easily list their vehicles with detailed descriptions and images, while buyers can utilize advanced search filters to find their perfect match based on make, model, price and more. Our platform ensures secure transactions through trusted payment processing and escrow services, along with access to vehicle history reports for informed decision-making. We also provide financing options, trade-in services, and vehicle inspection facilities for added convenience. With options for shipping and delivery and responsive customer support, our website aims to make buying and selling vehicles online a seamless experience for all users.' WHERE `servicesection`.`id` = 1; UPDATE `servicesection` SET `discription` = 'Our all in one vehicle buying and selling website extends its services to include insurance solutions, catering to the holistic needs of our users. Through strategic partnerships with trusted insurance providers, we offer seamless access to comprehensive insurance coverage for vehicles bought or sold on our platform. Users can conveniently explore and compare insurance options tailored to their specific needs, ensuring peace of mind and protection for their valuable assets. With a commitment to providing a full spectrum of services, including insurance, we strive to enhance the overall experience of buying and selling vehicles online.' WHERE `servicesection`.`id` = 2; UPDATE `servicesection` SET `discription` = 'In addition to our extensive range of services, our vehicle buying and selling website is proud to offer 24/7 customer support. We understand that questions or concerns may arise at any time, which is why our dedicated support team is always available to assist users. Whether you need help with listing your vehicle, navigating the platform, resolving a transaction issue, or anything else, our knowledgeable support staff is here to provide prompt and personalized assistance. With our commitment to ensuring a smooth and hassle free experience, you can trust that help is just a click or call away, day or night.' WHERE `servicesection`.`id` = 3;
-- --------------------------------------------------------

--
-- Table structure for table `teammembers`
--

CREATE TABLE `own` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `images` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `link1` varchar(100) NOT NULL,
  `link2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teammembers`
--

INSERT INTO `own` (`id`, `name`, `images`, `title`, `email`, `link1`, `link2`) VALUES
(1, 'Ms. Fathima Nushfa', 'images/th.jpg', 'ADMIN', 'fathimanusfa125@gmail.com', 'https://www.facebook.com/', 'https://www.linkedin.com/in/fathima-nushfa-93272926a/');
(2, 'Mr. Sabick Ahmed', 'images/unnamed.png', 'OWNER', 'sabickzid25@gmail.com', 'https://www.facebook.com/', 'https://www.linkedin.com/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footericon`
--
ALTER TABLE `footericon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footermenus`
--
ALTER TABLE `footermenus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hometopicon`
--
ALTER TABLE `hometopicon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nav`
--
ALTER TABLE `nav`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_cars`
--
ALTER TABLE `order_vehicles`
  ADD PRIMARY KEY (`id`);


--
-- Indexes for table `servicesection`
--
ALTER TABLE `servicesection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teammembers`
--
ALTER TABLE `own`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footermenus`
--
ALTER TABLE `footermenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hometopicon`
--
ALTER TABLE `hometopicon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nav`
--
ALTER TABLE `nav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_cars`
--
ALTER TABLE `order_vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;


--
-- AUTO_INCREMENT for table `servicesection`
--
ALTER TABLE `servicesection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teammembers`
--
ALTER TABLE `own`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Table for storing vehicle ads
CREATE TABLE IF NOT EXISTS `post_ads` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `vehicle_type` VARCHAR(255) NOT NULL,
    `condition` VARCHAR(50) NOT NULL,
    `brand` VARCHAR(255) NOT NULL,
    `model` VARCHAR(255) NOT NULL,
    `manufactured_year` INT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `leasing` TINYINT(1) DEFAULT 0,
    `fuel_type` VARCHAR(50) NOT NULL,
    `engine_capacity` VARCHAR(50),
    `mileage` INT,
    `ac` TINYINT(1) DEFAULT 0,
    `power_steering` TINYINT(1) DEFAULT 0,
    `power_mirror` TINYINT(1) DEFAULT 0,
    `power_window` TINYINT(1) DEFAULT 0,
    `specific_info` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table for storing images associated with vehicle ads
CREATE TABLE IF NOT EXISTS `postads_img` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `adId` INT,
    `image_path` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`adId`) REFERENCES `post_ads`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;
