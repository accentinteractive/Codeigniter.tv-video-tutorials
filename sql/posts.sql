-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2012 at 02:20 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codeigniter_tv_tuts`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID for the post',
  `post_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Title for the post',
  `post_body` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Body for the post (html)',
  `post_pubdate` datetime NOT NULL COMMENT 'Publication date for the post',
  `post_author` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Author for the post',
  `post_slug` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Slug for the post',
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Blog posts' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` VALUES(1, 'This is my first post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius libero dapibus justo mattis sit amet pulvinar ipsum pharetra. Fusce tempor felis at quam laoreet fringilla. Vivamus eros nulla, tempor vitae tempus vel, bibendum eget ante. Nunc mattis, quam nec luctus fringilla, sem mauris tincidunt risus, id convallis enim lacus vulputate arcu. Praesent placerat facilisis dolor, eu congue ipsum viverra in. Suspendisse potenti. Vivamus sollicitudin, velit ut placerat fermentum, mi sem pretium nisl, sed fermentum sapien lectus a sem. Sed interdum arcu in felis aliquam ac mollis eros euismod. Praesent lorem odio, ultrices et venenatis eu, faucibus nec lorem.', '2011-10-17 16:57:48', 'Joost van Veen', 'first-post');
INSERT INTO `posts` VALUES(3, 'This is my third post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius libero dapibus justo mattis sit amet pulvinar ipsum pharetra. Fusce tempor felis at quam laoreet fringilla. Vivamus eros nulla, tempor vitae tempus vel, bibendum eget ante. Nunc mattis, quam nec luctus fringilla, sem mauris tincidunt risus, id convallis enim lacus vulputate arcu. Praesent placerat facilisis dolor, eu congue ipsum viverra in. Suspendisse potenti. Vivamus sollicitudin, velit ut placerat fermentum, mi sem pretium nisl, sed fermentum sapien lectus a sem. Sed interdum arcu in felis aliquam ac mollis eros euismod. Praesent lorem odio, ultrices et venenatis eu, faucibus nec lorem.', '2011-10-19 16:58:09', 'Some other author', 'third-post');
INSERT INTO `posts` VALUES(2, 'This is my second post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec varius libero dapibus justo mattis sit amet pulvinar ipsum pharetra. Fusce tempor felis at quam laoreet fringilla. Vivamus eros nulla, tempor vitae tempus vel, bibendum eget ante. Nunc mattis, quam nec luctus fringilla, sem mauris tincidunt risus, id convallis enim lacus vulputate arcu. Praesent placerat facilisis dolor, eu congue ipsum viverra in. Suspendisse potenti. Vivamus sollicitudin, velit ut placerat fermentum, mi sem pretium nisl, sed fermentum sapien lectus a sem. Sed interdum arcu in felis aliquam ac mollis eros euismod. Praesent lorem odio, ultrices et venenatis eu, faucibus nec lorem.', '2011-10-18 16:58:09', 'Some other author', 'second-post');
