-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2023 at 01:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pixel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Film and Animation'),
(2, 'Education'),
(3, 'sports'),
(4, 'travel'),
(5, 'gaming');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postedBy` varchar(50) NOT NULL,
  `videoId` int(11) NOT NULL,
  `responseTo` int(11) NOT NULL,
  `body` text NOT NULL,
  `datePosted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postedBy`, `videoId`, `responseTo`, `body`, `datePosted`) VALUES
(1, 'newuser', 1, 0, 'nice video', '0000-00-00 00:00:00'),
(2, 'olduser', 3, 0, 'amazing play\n', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `commentId`, `videoId`) VALUES
(1, 'devm49', 0, 1),
(2, 'newuser', 0, 1),
(3, 'newuser', 0, 3),
(4, 'newuser', 0, 6),
(5, 'newuser', 0, 7),
(6, 'devm', 0, 5),
(7, 'devm', 0, 4),
(8, 'devm', 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `userTo` varchar(50) NOT NULL,
  `userFrom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `userTo`, `userFrom`) VALUES
(2, 'devm49', 'newuser'),
(3, 'olduser', 'newuser'),
(4, 'newuser', 'devm'),
(5, 'olduser', 'devm');

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `selected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `videoId`, `filePath`, `selected`) VALUES
(1, 1, 'uploads/videos/thumbnails/1-63d64a68ca826.jpg', 1),
(2, 1, 'uploads/videos/thumbnails/1-63d64a69be281.jpg', 0),
(3, 1, 'uploads/videos/thumbnails/1-63d64a6adb9fb.jpg', 0),
(4, 2, 'uploads/videos/thumbnails/2-63d6606aab8d8.jpg', 1),
(5, 2, 'uploads/videos/thumbnails/2-63d6606b755d2.jpg', 0),
(6, 2, 'uploads/videos/thumbnails/2-63d6606cacb8e.jpg', 0),
(7, 3, 'uploads/videos/thumbnails/3-63d6613084027.jpg', 1),
(8, 3, 'uploads/videos/thumbnails/3-63d661312e549.jpg', 0),
(9, 3, 'uploads/videos/thumbnails/3-63d6613252724.jpg', 0),
(10, 4, 'uploads/videos/thumbnails/4-63d6617137d67.jpg', 1),
(11, 4, 'uploads/videos/thumbnails/4-63d66172057c7.jpg', 0),
(12, 4, 'uploads/videos/thumbnails/4-63d6617340920.jpg', 0),
(13, 5, 'uploads/videos/thumbnails/5-63d661e90d70f.jpg', 0),
(14, 5, 'uploads/videos/thumbnails/5-63d661e9cb8e3.jpg', 0),
(15, 5, 'uploads/videos/thumbnails/5-63d661eb2ead2.jpg', 1),
(16, 6, 'uploads/videos/thumbnails/6-63d663d064c7a.jpg', 1),
(17, 6, 'uploads/videos/thumbnails/6-63d663d14bfe3.jpg', 0),
(18, 6, 'uploads/videos/thumbnails/6-63d663d2dec6c.jpg', 0),
(19, 7, 'uploads/videos/thumbnails/7-63d663f6eb416.jpg', 1),
(20, 7, 'uploads/videos/thumbnails/7-63d663f8b88d6.jpg', 0),
(21, 7, 'uploads/videos/thumbnails/7-63d663fc219df.jpg', 0),
(22, 8, 'uploads/videos/thumbnails/8-63d66472e560b.jpg', 1),
(23, 8, 'uploads/videos/thumbnails/8-63d66473a36e7.jpg', 0),
(24, 8, 'uploads/videos/thumbnails/8-63d66474ed2da.jpg', 0),
(25, 9, 'uploads/videos/thumbnails/9-63d664f7e968d.jpg', 1),
(26, 9, 'uploads/videos/thumbnails/9-63d664fa0c5c1.jpg', 0),
(27, 9, 'uploads/videos/thumbnails/9-63d664fe19da2.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profilePic` varchar(255) NOT NULL,
  `signUpDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `profilePic`, `signUpDate`, `password`) VALUES
(1, 'Dev', 'Manwani', 'devm49', 'devrmanwani@gmail.com', 'assets/images/profilePictures/default.png', '0000-00-00 00:00:00', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86'),
(2, 'New', 'User', 'newuser', 'newuser@gmail.com', 'assets/images/profilePictures/default.png', '0000-00-00 00:00:00', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86'),
(3, 'Old', 'User', 'olduser', 'olduser@gmail.com', 'assets/images/profilePictures/default.png', '2023-01-29 12:04:24', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86'),
(4, 'Dev', 'Manwani', 'devm', 'devm@gmail.com', 'assets/images/profilePictures/default.png', '2023-01-29 12:19:12', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `uploadedBy` varchar(50) NOT NULL,
  `title` varchar(70) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `privacy` int(11) NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `uploadDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `views` int(11) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `categories` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `uploadedBy`, `title`, `description`, `privacy`, `filePath`, `uploadDate`, `views`, `duration`, `categories`) VALUES
(3, 'olduser', 'Raze Main', 'playing Raze on icebox', 1, 'uploads/videos/63d661305d298demo.mp4', '2023-01-29 12:27:09', 7, '00:23', 5),
(4, 'olduser', 'Whiffed the Operator', 'Playing Jett on Heaven', 1, 'uploads/videos/63d661710b5602022-02-16_19-01-15_Trim.mp4', '2023-01-29 12:25:59', 3, '00:26', 5),
(5, 'newuser', 'Dog video', 'Random dog video', 0, 'uploads/videos/63d661e8e761d6178700273c581_Minute_Video_-_Doggie.mp4', '2023-01-29 12:19:15', 3, '01:00', 1),
(6, 'newuser', 'blockchain', 'How the blockchain works in short', 1, 'uploads/videos/63d663d0485746178711635fdeHow_Blockchain_Works_-_in_2_Minutes.mp4', '2023-01-29 12:26:21', 3, '02:07', 2),
(7, 'newuser', 'python', 'create a clock using python', 1, 'uploads/videos/63d663f6cec1861786f5c47ba8Make_a_Clock_using_Python___Python_Project.mp4', '2023-01-29 12:18:12', 1, '04:31', 2),
(8, 'devm', 'travel', 'Travel video in 1 minute', 1, 'uploads/videos/63d66472c6281617872a1de41c1_MINUTE_OF_ITALY___TRAVEL_VIDEO.mp4', '2023-01-29 12:20:11', 1, '00:59', 4),
(9, 'devm', 'javascript functions', 'Learn javascript functions in under 5 minutes', 1, 'uploads/videos/63d664f7d0c0461786ed1e1eb4JavaScript_Functions.mp4', '2023-01-29 12:26:30', 1, '05:37', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
