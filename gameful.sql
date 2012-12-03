-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2012 at 11:03 AM
-- Server version: 5.0.95
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` varchar(255) collate utf8_unicode_ci NOT NULL,
  `variable` varchar(255) collate utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `variable`) VALUES
('site', 'My First Gameful Class'),
('registration', 'zebras'),
('theme', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL auto_increment,
  `filename` varchar(255) collate utf8_unicode_ci NOT NULL,
  `qid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `notes` text collate utf8_unicode_ci NOT NULL,
  `uploaded` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `grading`
--

CREATE TABLE IF NOT EXISTS `grading` (
  `id` int(11) NOT NULL auto_increment,
  `amount` int(11) NOT NULL,
  `label` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(20) collate utf8_unicode_ci NOT NULL,
  `description` varchar(100) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) collate utf8_unicode_ci NOT NULL,
  `time` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE IF NOT EXISTS `meta` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned default NULL,
  `first_name` varchar(50) collate utf8_unicode_ci default NULL,
  `last_name` varchar(50) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `user_id`, `first_name`, `last_name`) VALUES
(1, 1, 'Admin', 'istrator');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(100) NOT NULL auto_increment,
  `headline` varchar(255) collate utf8_unicode_ci NOT NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `created` int(10) NOT NULL,
  `frontpage` tinyint(4) NOT NULL,
  `menu` tinyint(4) NOT NULL,
  `position` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questCompletion`
--

CREATE TABLE IF NOT EXISTS `questCompletion` (
  `qid` int(10) NOT NULL,
  `uid` int(100) NOT NULL,
  `completed` int(10) NOT NULL,
  `note` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questCompletionSkills`
--

CREATE TABLE IF NOT EXISTS `questCompletionSkills` (
  `qid` int(10) NOT NULL,
  `uid` int(100) NOT NULL,
  `skid` int(5) NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questLock`
--

CREATE TABLE IF NOT EXISTS `questLock` (
  `qid` int(10) NOT NULL,
  `skid` int(5) NOT NULL,
  `requirement` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quests`
--

CREATE TABLE IF NOT EXISTS `quests` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `instructions` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `type` int(5) NOT NULL,
  `requirements` tinyint(4) NOT NULL,
  `hidden` tinyint(4) NOT NULL,
  `file` varchar(255) default NULL,
  `position` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questSkills`
--

CREATE TABLE IF NOT EXISTS `questSkills` (
  `qid` int(10) NOT NULL,
  `skid` int(5) NOT NULL,
  `label` varchar(255) collate utf8_unicode_ci NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questTypes`
--

CREATE TABLE IF NOT EXISTS `questTypes` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questTypes`
--

INSERT INTO `questTypes` (`id`, `name`) VALUES
(1, 'In Class'),
(2, 'Written Submission'),
(3, 'File Submission'),
(4, 'Response');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(100) NOT NULL auto_increment,
  `sid` int(100) NOT NULL,
  `uid` int(100) NOT NULL,
  `response` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `created` int(10) NOT NULL,
  `flag` int(1) NOT NULL,
  `qid` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `id` int(100) NOT NULL auto_increment,
  `uid` int(100) NOT NULL,
  `qid` int(100) NOT NULL,
  `submission` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `submitted` int(10) NOT NULL,
  `visible` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `group_id` mediumint(8) unsigned NOT NULL,
  `ip_address` char(16) collate utf8_unicode_ci NOT NULL,
  `username` varchar(15) collate utf8_unicode_ci NOT NULL,
  `password` varchar(40) collate utf8_unicode_ci NOT NULL,
  `salt` varchar(40) collate utf8_unicode_ci default NULL,
  `email` varchar(254) collate utf8_unicode_ci NOT NULL,
  `activation_code` varchar(40) collate utf8_unicode_ci default NULL,
  `forgotten_password_code` varchar(40) collate utf8_unicode_ci default NULL,
  `remember_code` varchar(40) collate utf8_unicode_ci default NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `remember_code`, `created_on`, `last_login`, `active`) VALUES
(1, 1, '127.0.0.1', 'administrator', '321113b0ad8c81f90e2b7d832a029364ba3bf5e1', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, 1268889823, 1345052111, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
