-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2022 at 09:54 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id_todo` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `deadline` date NOT NULL,
  `status` enum('belum','selesai','telat') NOT NULL,
  `id_goal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id_todo`, `title`, `deadline`, `status`, `id_goal`) VALUES
(36, 'Push Up 1010x', '2022-10-05', 'telat', 22),
(37, 'Belajar OOP di WPU', '2022-09-08', 'belum', 23),
(38, 'Lari 100 putaran', '2022-09-08', 'selesai', 23),
(39, 'aaaaa', '2022-09-08', 'telat', 23),
(40, 'Menambahkan Fitur Todo', '2022-09-30', 'belum', 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_profil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `username`, `email`, `password`, `foto_profil`) VALUES
(8, 'aku saya', 'aku1', 'aku1@mail.com', '$2y$10$.SsplKc1OiQsFQEThZkD0eUJvXWnyo8Yqq2yd.eWlYY66irqc6c9O', 'new_user.png'),
(10, 'user', 'user', 'user@mail.com', '$2y$10$rb7kS5Cf/BsHUlnDnHKwD.LexlwCEyVqUtbPf5KXkb89gDGwhCulu', '631f2bd33535d.png'),
(17, 'halo', 'halo', 'halo@mail.com', '$2y$10$biCzi/BMblQS66T0SPFnreDLZlJEVIvwxqD31zNYR1uBunWB8ZRpi', 'new_user.png'),
(18, 'aku dilen', 'aku', 'aku@mail.com', '$2y$10$B4oTpf36cckE8XIsOVjzl.bZCa992F4NAOS988W775224mvgNqKW6', 'new_user.png'),
(19, 'anjay mabar', 'anjay', 'halo@mail.com', '$2y$10$liBs9dlxsHXlBi1J7JVX.uEJ/7AKczVsv.KZVRTfwlE94O0xlgUsK', 'new_user.png');

-- --------------------------------------------------------

--
-- Table structure for table `workspace`
--

CREATE TABLE `workspace` (
  `id_goal` int(11) NOT NULL,
  `nm_goal` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workspace`
--

INSERT INTO `workspace` (`id_goal`, `nm_goal`, `deskripsi`, `id_user`) VALUES
(22, 'Push Rank Mythic', 'Push Rank Brutal', 8),
(23, 'Belajar OOP', 'OOP PHP', 10),
(25, 'Push Rank Mythic', 'gggg', 10),
(26, 'Push Rank ML', 'xxxxxx', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id_todo`),
  ADD KEY `id_goal` (`id_goal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `workspace`
--
ALTER TABLE `workspace`
  ADD PRIMARY KEY (`id_goal`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id_todo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `workspace`
--
ALTER TABLE `workspace`
  MODIFY `id_goal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `todo_ibfk_1` FOREIGN KEY (`id_goal`) REFERENCES `workspace` (`id_goal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workspace`
--
ALTER TABLE `workspace`
  ADD CONSTRAINT `workspace_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
