-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2024 at 09:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `about` longtext NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `firstname`, `lastname`, `email`, `username`, `password`) VALUES
(1, 'joshua', 'gatehi', 'joshuandungu2001@gmail.com', 'ndungu', '654r636xw');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `uploader` varchar(100) NOT NULL,
  `blog_title` varchar(100) NOT NULL,
  `cat_title` varchar(100) NOT NULL,
  `details` longtext NOT NULL,
  `blog_image` varchar(100) NOT NULL,
  `status` int(100) NOT NULL,
  `uploaded_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `uploader`, `blog_title`, `cat_title`, `details`, `blog_image`, `status`, `uploaded_date`) VALUES
(1, 'joshuandungu2001@gmail.com', 'Politics In Kenya', 'Select category', 'politics is a dirty game in kenya', 'pexels-nick-wehrli-5282269.jpg', 1, '2024-07-23 01:55:42'),
(3, 'joshuandungu2001@gmail.com', 'University Studies', 'Select category', 'University studies is a proactive mode of studies that boost students thinking and solving problem tecchniques', 'book.jpg', 1, '2024-07-23 06:31:52'),
(5, 'joshuandungu2001@gmail.com', 'FISTULA', 'health', 'Fistula is a gynocological health condition that affects women where they are not able to hold their urinary products in the bladder for a long time.\r\n<h1><ul>SIGNS AND SYSMPTOMS</ul></h1>\r\nFrequent short calls from time to time\r\nUnable to hold the urinary products for a certain period of time\r\nReleasing of urine unknowingly\r\n', 't4.jpg', 1, '2024-07-23 06:47:49'),
(6, 'HANNAH@GMAIL.COM', 'GEN Z DEMOS', 'politics', 'Recently there has been an upcoming demonstrations allegedly planned by the young generation between the age of 20 -35 years of age in Kenya.\r\nThe demos initial trigger was the passing of the proposed Finance bill 2024 which suggested the increase of tax in various commodities like bread, cocking oil, fuel, rubber, sanitary pads,vehicle importation tax, land owned and leased titles and many more.\r\nDue to this pressure on poor kenyans. Th Gen Z purpotted to do an uprising within the social media platforms like X (formally named Twitter) and used a trending hashtag (#Ruto Must Go).\r\nUntil now demonstrations are still continuing where many are left injured with bullet scars and several left dead as some are missing whereabout as police abduction continues ', '02.jpg', 1, '2024-07-23 07:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `blog_cat`
--

CREATE TABLE `blog_cat` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_cat`
--

INSERT INTO `blog_cat` (`cat_id`, `cat_title`) VALUES
(66788, 'health'),
(55548, 'politics'),
(85407, 'sports'),
(83506, 'news'),
(97600, 'economy');

-- --------------------------------------------------------

--
-- Table structure for table `media_links`
--

CREATE TABLE `media_links` (
  `id` int(11) NOT NULL,
  `media_name` varchar(100) NOT NULL,
  `media_link` varchar(100) NOT NULL,
  `media_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media_links`
--

INSERT INTO `media_links` (`id`, `media_name`, `media_link`, `media_image`) VALUES
(1, 'YouTube', 'https://www.youtube.com/kenya/en', 'c1.jpg'),
(2, 'FaceBook', 'https://www.facebook.com/kenya/en', 'c2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firstname`, `lastname`, `email`, `username`, `password`, `profile_image`) VALUES
(8861859, 'HANNAH', 'WANJIRU', 'HANNAH@GMAIL.COM', 'HANNAH 254', '66650fdc67ae490deb50af235b7e45214a34ec72', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `media_links`
--
ALTER TABLE `media_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `media_links`
--
ALTER TABLE `media_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
