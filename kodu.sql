-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2015 at 05:20 PM
-- Server version: 5.6.23
-- PHP Version: 5.6.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kodu`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(12) NOT NULL,
  `date` varchar(255) COLLATE latin7_estonian_cs NOT NULL,
  `sdescription` varchar(255) COLLATE latin7_estonian_cs NOT NULL,
  `description` varchar(255) COLLATE latin7_estonian_cs NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin7 COLLATE=latin7_estonian_cs;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `date`, `sdescription`, `description`) VALUES
(3, '28.04.2015', 'data', 'data'),
(4, '28.04.2015', 'tere', 'terer ?!?!? d oh'),
(5, '28.04.2015', 'postitus', 'postitus');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `saltedhash` varchar(255) NOT NULL,
  `id` int(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `saltedhash`, `id`) VALUES
('superman', 'super@super.ee', '$2y$10$yEg4M2oQ0Nx.fsBjipFWgeh/fGET1KuT.j.7WJ61HIdJTEOaVAo1G', 1),
('superman2', 'super@super.ee', '$2y$10$FL8CXrw/bclT3qcO8AoYN.e1Av7c/.lv97bZK2iMcTLnaYGiOHOZm', 4),
('superman3', 'super@super.ee', '$2y$10$Vi.zH4HHmzLgeO.Kjun8yu3CeHvm4.faRX3UnhwTuanWKlyXPPWMm', 6),
('superman5', 'superman5@hot.ee', '$2y$10$Wyi8MRaVJ4hLuo1vxql9u.UmGShNYaLPGSKH14Ytl3dw5G9hXjmN2', 7),
('ivo', 'ivo@ivo.ee', '$2y$10$Gm8iE4YiodUaPP.Hpg6avuUxHFNUzD6XAgvzGXTHUKr4tAu4Aea4G', 8),
('ivo2', 'ivo@hot.ee', '$2y$10$7HvSMII80WrHiZpb1FQ7neoN3tenu9diPkxToeYPU6EAgE/ANJvlO', 23),
('ivo3', 'ivo@hot.ee', '$2y$10$kgG1xysMAmkFFdlx34pCvufhedD6Ke0k3YxUO18/uSS6.yTxS2w1e', 25),
('ivo4', 'ivo@hot.ee', '$2y$10$Pv.IbkRd4snTuaOtoUttauCdXtn1k9M5/gsrbo688/jiSJFPeu3r2', 28),
('ivo4f', 'ivo@ivo.ee', '$2y$10$LKp7YlyLZc6xSnRcy1VEE.1rIkc4JWQw13ZDrVpaGbVN4kt1MeeeW', 31),
('ivo4545', 'icoscx@gmail.com', '$2y$10$Cv1/ye.eK4yPJZCsm31yiugnu7iEaU5MQDqGm7QMP3NYnm7pAIMc6', 35),
('ivo2f', 'icoscx@gmail.com', '$2y$10$RxPHSQx5p0QijjOMX/PxYugTeXIPKBcuDCX2ogjU6XeVutRR1PNpu', 37),
('ivorrrrrrrr', 'icoscx@gmail.com', '$2y$10$AsmV9jB4bNTT0k4HVaBLAuKu0hxVeD1PiihHgYQeq6gKdmaWO4OfS', 39);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
