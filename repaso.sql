-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-09-2011 a las 18:24:34
-- Versión del servidor: 5.1.53
-- Versión de PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `repaso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `nickName` varchar(30) NOT NULL,
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comment`),
  KEY `nickName` (`nickName`),
  KEY `nickName_3` (`nickName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `comments`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
  `upload_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(30) NOT NULL,
  `file_size` int(6) unsigned NOT NULL,
  `file_type` varchar(30) NOT NULL,
  `nickName` varchar(30) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `date_entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`upload_id`),
  KEY `file_name` (`file_name`),
  KEY `date_entered` (`date_entered`),
  KEY `nickName` (`nickName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `uploads`
--

INSERT INTO `uploads` (`upload_id`, `file_name`, `file_size`, `file_type`, `nickName`, `description`, `date_entered`) VALUES
(1, 'Estoy aquÃ­ enfermo con mi alm', 12437, 'application/vnd.openxmlformats', 'test', 'word', '2011-09-20 17:17:01'),
(4, '225988_121716304574495_1217161', 125426, 'image/jpeg', 'test', 'foto de patty', '2011-09-20 18:35:37'),
(5, '225988_121716304574495_1217161', 125426, 'image/jpeg', 'test', 'foto de patty', '2011-09-20 18:36:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urls`
--

CREATE TABLE IF NOT EXISTS `urls` (
  `url_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` tinytext NOT NULL,
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Volcar la base de datos para la tabla `urls`
--

INSERT INTO `urls` (`url_id`, `url`, `title`, `description`) VALUES
(1, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(2, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(3, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(4, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(5, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(6, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(7, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(8, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(9, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(10, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(11, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(12, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(13, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(14, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(15, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(16, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(17, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(18, 'google.com', 'php files', 'kiwwwwwwwwwwwwwwwwwto'),
(19, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(20, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(21, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(22, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(23, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(24, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(25, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(26, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(27, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(28, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(29, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(30, 'google.com', 'google', 'kiweeeeeeeeeeetp'),
(31, 'google.com', 'google', 'kiweeeeeeeeeeetp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `url_associations`
--

CREATE TABLE IF NOT EXISTS `url_associations` (
  `ua_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `url_id` smallint(4) unsigned NOT NULL,
  `url_category_id` tinyint(3) unsigned NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approved` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ua_id`),
  KEY `url_category_id` (`url_category_id`),
  KEY `url_id` (`url_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `url_associations`
--

INSERT INTO `url_associations` (`ua_id`, `url_id`, `url_category_id`, `date_submitted`, `approved`) VALUES
(1, 31, 1, '2011-09-13 22:24:59', 'Y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `url_categories`
--

CREATE TABLE IF NOT EXISTS `url_categories` (
  `url_category_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  PRIMARY KEY (`url_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `url_categories`
--

INSERT INTO `url_categories` (`url_category_id`, `category`) VALUES
(1, 'php files'),
(2, 'kieeeto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `age` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nickName` varchar(30) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `dateRegistration` datetime NOT NULL,
  PRIMARY KEY (`nickName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`firstName`, `lastName`, `gender`, `age`, `email`, `nickName`, `pass`, `dateRegistration`) VALUES
('test', 'test', 'f', '0-29', 'test@hotmail.com', 'test', '098f6bcd4621d373cade4e832627b4f6', '2011-09-19 00:00:00');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`nickName`) REFERENCES `usuarios` (`nickName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`nickName`) REFERENCES `usuarios` (`nickName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `url_associations`
--
ALTER TABLE `url_associations`
  ADD CONSTRAINT `url_associations_ibfk_1` FOREIGN KEY (`url_id`) REFERENCES `urls` (`url_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `url_associations_ibfk_2` FOREIGN KEY (`url_category_id`) REFERENCES `url_categories` (`url_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
