-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 15, 2018 at 01:49 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `converterdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `rate` decimal(15,5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `rate`) VALUES
(1, 'USD', '1.23690'),
(2, 'JPY', '131.77000'),
(3, 'BGN', '1.95580'),
(4, 'CZK', '25.44700'),
(5, 'DKK', '7.44930'),
(6, 'GBP', '0.88630'),
(7, 'HUF', '311.63000'),
(8, 'PLN', '4.20230'),
(9, 'RON', '4.66250'),
(10, 'SEK', '10.12550'),
(11, 'CHF', '1.17040'),
(12, 'ISK', '123.10000'),
(13, 'NOK', '9.57280'),
(14, 'HRK', '7.44280'),
(15, 'RUB', '70.49350'),
(16, 'TRY', '4.79240'),
(17, 'AUD', '1.56440'),
(18, 'BRL', '4.02440'),
(19, 'CAD', '1.59930'),
(20, 'CNY', '7.80890'),
(21, 'HKD', '9.69780'),
(22, 'IDR', '16981.40000'),
(23, 'ILS', '4.24340'),
(24, 'INR', '80.19750'),
(25, 'KRW', '1313.97000'),
(26, 'MXN', '22.97850'),
(27, 'MYR', '4.82020'),
(28, 'NZD', '1.68530'),
(29, 'PHP', '64.33000'),
(30, 'SGD', '1.61930'),
(31, 'THB', '38.50500'),
(32, 'ZAR', '14.54940');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `operator` enum('CONVERT','REVERSE') DEFAULT NULL,
  `amount` decimal(25,5) DEFAULT NULL,
  `result` decimal(25,5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_id`, `currency_id`, `create_time`, `operator`, `amount`, `result`) VALUES
(3, 47, 1, '2018-03-15 04:33:18', 'CONVERT', '200.00000', '161.69456'),
(2, 47, 1, '2018-03-15 04:32:55', 'CONVERT', '200.00000', '161.69456'),
(4, 47, 1, '2018-03-15 04:33:21', 'CONVERT', '200.00000', '161.69456'),
(5, 47, 1, '2018-03-15 04:46:30', 'CONVERT', '200.00000', '161.69456'),
(19, 50, 1, '2018-03-15 14:43:47', 'CONVERT', '455.00000', '367.85512'),
(13, 2, 1, '2018-03-15 13:29:42', 'CONVERT', '200.00000', '161.69456'),
(15, 2, 1, '2018-03-15 13:29:43', 'CONVERT', '200.00000', '161.69456'),
(14, 2, 1, '2018-03-15 13:29:43', 'CONVERT', '200.00000', '161.69456'),
(18, 2, 2, '2018-03-15 14:40:52', 'CONVERT', '5000.00000', '37.94490');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'gentledivert@gmail.com', '673d4f049f0db3d188488f447477968a'),
(2, 'davidwolch02@gmail.com', '8fa14cdd754f91cc6554c9e71929cce7'),
(3, 'akongnwi02@gmail.com', 'f970e2767d0cfe75876ea857f92e319b'),
(4, 'd@c.com', 'f970e2767d0cfe75876ea857f92e319b'),
(5, 'd@c', 'bd1d7b0809e4b4ee9ca307aa5308ea6f'),
(6, 'akong@y.com', '673d4f049f0db3d188488f447477968a'),
(7, 'bao@bao.com', 'df3939f11965e7e75dbc046cd9af1c67'),
(8, 'sir@y.com', 'f970e2767d0cfe75876ea857f92e319b'),
(9, 'baj@b.net', '673d4f049f0db3d188488f447477968a'),
(10, 'der@dan.com', '4d236d9a2d102c5fe6ad1c50da4bec50'),
(11, 'emerang@net', '639bae9ac6b3e1a84cebb7b403297b79'),
(12, 'wahala@net', '4d236d9a2d102c5fe6ad1c50da4bec50'),
(13, 'Eme@di', '4d236d9a2d102c5fe6ad1c50da4bec50'),
(14, 'emera@bo', '1e8e42b87a65326b98ced7d3af717a72'),
(15, 'don@cam.net', '6f8f57715090da2632453988d9a1501b'),
(16, 'd@d.c', '6f8f57715090da2632453988d9a1501b'),
(17, 'how@you', '7b8b965ad4bca0e41ab51de7b31363a1'),
(18, 'dan@y', 'bd1d7b0809e4b4ee9ca307aa5308ea6f'),
(19, 'tel@y', '6f8f57715090da2632453988d9a1501b'),
(20, 'baby@baby.net', '673d4f049f0db3d188488f447477968a'),
(21, 'b@b', '92eb5ffee6ae2fec3ad71c777531578f'),
(22, 'c@c', '4a8a08f09d37b73795649038408b5f33'),
(23, 'mad@c', '6f8f57715090da2632453988d9a1501b'),
(24, 'don@bada', '6f8f57715090da2632453988d9a1501b'),
(25, 'see@me', '8277e0910d750195b448797616e091ad'),
(26, 'd@w', '8277e0910d750195b448797616e091ad'),
(27, 'bad@e', '8277e0910d750195b448797616e091ad'),
(28, 'c@w', 'f1290186a5d0b1ceab27f4e77c0c5d68'),
(29, 'M@L', '7fc56270e7a70fa81a5935b72eacbe29'),
(30, 'M@2', 'f09564c9ca56850d4cd6b3319e541aee'),
(31, 'c@1', '8fa14cdd754f91cc6554c9e71929cce7'),
(32, 'd@g.c', '8277e0910d750195b448797616e091ad'),
(33, 'd@134', '363b122c528f54df4a0446b6bab05515'),
(34, 'd@qqwer', '37693cfc748049e45d87b8c7d8b9aacd'),
(35, 'dfds@wq', '0cc175b9c0f1b6a831c399e269772661'),
(36, 'a@1', '7694f4a66316e53c8cdd9d9954bd611d'),
(37, 'di@di', 'c4ca4238a0b923820dcc509a6f75849b'),
(38, 'm@p', 'c4ca4238a0b923820dcc509a6f75849b'),
(39, 'd@ty', '8277e0910d750195b448797616e091ad'),
(40, 'df@w', 'f1290186a5d0b1ceab27f4e77c0c5d68'),
(41, 'as@qw', '7694f4a66316e53c8cdd9d9954bd611d'),
(42, 'p@p', '4a8a08f09d37b73795649038408b5f33'),
(43, 'dm@po', '0cc175b9c0f1b6a831c399e269772661'),
(44, 'E@12', 'f623e75af30e62bbd73d6df5b50bb7b5'),
(45, 'dany@blue', '0cc175b9c0f1b6a831c399e269772661'),
(46, 'BAO@DAN', '8038e2be8e8ce0155dc9d2b5bf9e95b2'),
(47, 'DADY@BAO', '8038e2be8e8ce0155dc9d2b5bf9e95b2'),
(48, 'big@big', '6f8f57715090da2632453988d9a1501b'),
(49, 'd@d', '0cc175b9c0f1b6a831c399e269772661'),
(50, 'fa@2', '89e6d2b383471fc370d828e552c19e65');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
