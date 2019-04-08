-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2019 at 08:26 PM
-- Server version: 5.6.35
-- PHP Version: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cmsapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cars`
--

CREATE TABLE `Cars` (
  `id` bigint(20) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year_built` varchar(50) NOT NULL,
  `fuel` varchar(50) NOT NULL,
  `price` bigint(20) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `engine_type` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` varchar(50) NOT NULL,
  `updated_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Cars`
--

INSERT INTO `Cars` (`id`, `brand_id`, `model`, `year_built`, `fuel`, `price`, `transmission`, `engine_type`, `image`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(9, 1, 'Civic Turbo V6', '2015', '4.3L', 25000000, 'Automatic', 'VTEC', '/2019-04-07065338.png', '2019-04-07 06:53:38', '2019-04-07 06:53:38', ' ', ' '),
(10, 1, 'Civic Turbo V8', '1999', 'fanta', 50000, '6 speed Manual', 'VTEC', '/2019-04-07065539.png', '2019-04-07 06:55:39', '2019-04-07 06:55:39', ' ', ' '),
(11, 3, 'Impreza', '2000', 'Gasoline', 600000, 'manual', 'DOHC BOXER', '/2019-04-07065816.jpg', '2019-04-07 06:58:16', '2019-04-07 06:58:16', ' ', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `car_brands`
--

CREATE TABLE `car_brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_brands`
--

INSERT INTO `car_brands` (`id`, `brand_name`, `created_at`, `updated_at`) VALUES
(1, 'honda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Suzuki', '2019-04-06 00:59:33', '2019-04-06 01:06:29'),
(3, 'Subaru', '2019-04-06 03:18:03', '2019-04-06 03:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `car_id` bigint(20) NOT NULL,
  `generic_id` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `comment` text NOT NULL,
  `upvote` int(11) NOT NULL,
  `downvote` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `car_id`, `generic_id`, `username`, `comment`, `upvote`, `downvote`, `created_at`, `updated_at`) VALUES
(2, 9, 'hDA4M', '', 'qweqweqwe', 0, 1, '2019-04-07 15:50:54', '2019-04-07 18:12:28'),
(3, 10, 'hDAA4', '', 'wewe', 0, 0, '2019-04-07 15:56:48', '2019-04-07 15:56:48'),
(4, 9, 'hDABX', '', 'qweqwe', 0, 0, '2019-04-07 15:58:19', '2019-04-07 15:58:19'),
(5, 10, 'hDAF4', '', 'qweqwe', 0, 0, '2019-04-07 16:01:58', '2019-04-07 16:01:58'),
(6, 10, 'hDAqM', '', 'testing commentar', 0, 0, '2019-04-07 16:40:30', '2019-04-07 16:40:30'),
(7, 10, 'hDArO', '', 'qweqwe', 0, 0, '2019-04-07 16:41:34', '2019-04-07 16:41:34'),
(8, 9, '', 'felix', 'adasdasd', 0, 0, '2019-04-07 16:51:52', '2019-04-07 16:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `reply` text NOT NULL,
  `generic_id` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `vote_counter` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(6, 'Administrator', '2019-04-06 01:52:04', '2019-04-06 01:52:04'),
(7, 'Viewer', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `roles_id`, `first_name`, `last_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'benny', 'benny', 6, 'benny', 'fajarai', 'inactive', '0000-00-00 00:00:00', '2019-04-06 02:34:41'),
(5, 'felix', '$2y$10$tISGi/.LRgEnaKLnB.uLW.mHHvNZVecPhR0o09K9C3duRVEzVC5Ey', 7, 'felix', 'felix', 'active', '2019-04-06 02:22:47', '2019-04-06 02:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_downvote_comments`
--

CREATE TABLE `user_downvote_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_downvote_comments`
--

INSERT INTO `user_downvote_comments` (`id`, `user_id`, `comment_id`, `created_at`, `updated_at`) VALUES
(4, 5, 2, '2019-04-07 18:12:28', '2019-04-07 18:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_downvote_comment_replies`
--

CREATE TABLE `user_downvote_comment_replies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_reply_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_upvote_comments`
--

CREATE TABLE `user_upvote_comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_upvote_comment_replies`
--

CREATE TABLE `user_upvote_comment_replies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_reply_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cars`
--
ALTER TABLE `Cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_id` (`roles_id`);

--
-- Indexes for table `user_downvote_comments`
--
ALTER TABLE `user_downvote_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `user_downvote_comment_replies`
--
ALTER TABLE `user_downvote_comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_reply_id` (`comment_reply_id`);

--
-- Indexes for table `user_upvote_comments`
--
ALTER TABLE `user_upvote_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `user_upvote_comment_replies`
--
ALTER TABLE `user_upvote_comment_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_reply_id` (`comment_reply_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cars`
--
ALTER TABLE `Cars`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_downvote_comments`
--
ALTER TABLE `user_downvote_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_downvote_comment_replies`
--
ALTER TABLE `user_downvote_comment_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_upvote_comments`
--
ALTER TABLE `user_upvote_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_upvote_comment_replies`
--
ALTER TABLE `user_upvote_comment_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cars`
--
ALTER TABLE `Cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `car_brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `Cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD CONSTRAINT `comment_replies_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_downvote_comments`
--
ALTER TABLE `user_downvote_comments`
  ADD CONSTRAINT `user_downvote_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_downvote_comments_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_downvote_comment_replies`
--
ALTER TABLE `user_downvote_comment_replies`
  ADD CONSTRAINT `user_downvote_comment_replies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_downvote_comment_replies_ibfk_2` FOREIGN KEY (`comment_reply_id`) REFERENCES `comment_replies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_upvote_comments`
--
ALTER TABLE `user_upvote_comments`
  ADD CONSTRAINT `user_upvote_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_upvote_comments_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_upvote_comment_replies`
--
ALTER TABLE `user_upvote_comment_replies`
  ADD CONSTRAINT `user_upvote_comment_replies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_upvote_comment_replies_ibfk_2` FOREIGN KEY (`comment_reply_id`) REFERENCES `comment_replies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
