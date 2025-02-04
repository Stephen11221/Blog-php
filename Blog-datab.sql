-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 04, 2025 at 01:02 PM
-- Server version: 10.11.8-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Blog-datab`
--

-- --------------------------------------------------------

--
-- Table structure for table `Blogstable`
--

CREATE TABLE `Blogstable` (
  `id` int(11) NOT NULL,
  `blogtitle` varchar(255) NOT NULL,
  `blogcategory` varchar(100) NOT NULL,
  `blog` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Blogstable`
--

INSERT INTO `Blogstable` (`id`, `blogtitle`, `blogcategory`, `blog`, `created_at`) VALUES
(1, 'New', 'Automotive', 'BMW is a brand known for its luxurious interiors and engaging driving experience, but the M performance line is where the German automaker truly struts its stuff. M, which stands for “Motorsport”, takes the driving experience to the next level with more powerful engines and aerodynamic designs. Interestingly, the M division saw the all-electric BMW i4 M50 continue to hold the title of top-selling model for a third year in a row.', '2025-01-28 03:13:50'),
(2, 'Food security', 'Food and Agri-business', 'Bold Street is Liverpool’s foodie destination. The street throngs with crowds on even the quietest of evenings. Sounds and smells pour from the array of different cafes, restaurants, bars and takeaways as you walk past – offering a passing hint of what awaits, should you venture inside. The problem with streets like this is ', '2025-01-28 10:37:06'),
(3, 'technology_advanced', 'Technology', 'A technology blog is a website that provides information and advice about technology. Some popular technology blogs include: \r\nCNET: A long-running blog that covers the latest consumer technology trends, including product reviews, how-tos, and advice\r\nTom\'s Guide: A top tech review site\r\nWired: A top tech review site\r\nWirecutter: A top tech review site\r\n', '2025-01-28 10:52:05'),
(4, 'Repairing and maintaining', 'Automotive', 'Automoblog. From concept cars that push limits to new tech that melts minds, Autoblog\'s stable of gearhead writers aren\'t afraid to rev things up. Whether ...\r\n', '2025-01-28 11:11:34'),
(5, 'technology_advanced', 'Technology', 'Digital Trends. Digital Trends was founded with an essential purpose. The blog was created to help filter out all the noise surrounding technology ...\r\n', '2025-01-28 11:19:18'),
(7, 'technology_advanced', 'Technology', 'Taking care of you car is good because it carries you from one place to another and you enjoy. Some time you are down and your make you feel eleven-ted ', '2025-01-28 22:21:00'),
(8, 'technology_advanced', 'Technology', 'stevsn', '2025-01-29 12:59:29'),
(9, 'car', 'Automotive', 'rewsaz<', '2025-01-29 19:30:37'),
(10, 'Heart break', 'Food and Agri-business', 'Good food', '2025-01-30 02:42:07'),
(11, 'NewCARS', 'Automotive', 'rewer', '2025-01-31 09:40:48'),
(12, 'technology_advanced', 'Food and Agri-business', 'Transformers fans know Soundwave as a Decepticon robot disguised as a micro cassette recorder, and some may even have at least one of his early 1980s toys, but what if I told you that it’s now possible to create a 3D-printed version at home?\r\n\r\n', '2025-02-02 12:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `emal` varchar(100) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `emal`, `message`) VALUES
(1, 'Stephen Muema', 'muema1476@gmail.com', 'We love blog and we understand them'),
(2, 'Stephen Muema', 'muema1476@gmail.com', 'KIM'),
(3, 'Stephen Muema', 'muema1476@gmail.com', 'KIM'),
(4, 'Stephen Muema Mutui', 'davidmwandikwa336@gmail.com', 'e4r'),
(5, 'Stephen Muema', 'muema1476@gmail.com', 'Blog are enjoyable and entertaining');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'stete', 'muema1476@gmail.com', '$2y$10$SxCH2M8A86SfMKvYPXHLJOztPgforAPdd7OqH5CF8sgw.DAXin6X2', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Blogstable`
--
ALTER TABLE `Blogstable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Blogstable`
--
ALTER TABLE `Blogstable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
