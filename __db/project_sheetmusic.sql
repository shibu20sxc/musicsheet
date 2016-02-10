-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2016 at 11:28 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_sheetmusic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `forget_password_otp` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `image`, `forget_password_otp`, `status`, `is_deleted`) VALUES
(1, 'Admin Shibu qqq', 'admin@sheetmusic.com', '21232f297a57a5a743894a0e4a801fc3', '1440396601_images-photo.jpg', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advetisements_type` varchar(1) DEFAULT NULL COMMENT '1=''small'',2=''Large'',3=''body'',4=''Video Link''',
  `details` text,
  `advertisements` text,
  `status` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `advetisements_type`, `details`, `advertisements`, `status`, `is_deleted`) VALUES
(1, '1', '', 'advertisment1.jpg', 1, 1),
(2, '2', 'Shibu Image', 'advertisment2.jpg', 1, 1),
(3, '4', '''Main Hoon Hero Tera'' VIDEO Song - Salman Khan | Hero | ', 'http://www.youtube.com/embed/HcgJRQWxKnw?autoplay=1', 1, 1),
(4, '3', 'details', 'big_ad.jpg', 1, 1),
(5, '1', '', '1442927248_adver_300.jpg', 1, 1),
(6, '3', 'Music add banner', '1449315415_music-background-meaning-singing-instruments-notes-imusic-i-nstruments-42078378.jpg', 1, 1),
(7, '1', 'Image is loading Blue-Angel-Dance-Club-Music-Entertainment-Cincinnati-OH', '1449748763_$_35.JPG', 1, 1),
(8, '1', 'Turn Me On #3: Wild Feathers, King Washington, Dawes', '1449748800_turn-me-on-to-new-music-banner-300x164.jpg', 1, 1),
(9, '4', 'Coke 2012 Commercial: "Catch" starring NE_Bear', 'https://www.youtube.com/embed/S2nBBMbjS8w?autoplay=1', 1, 1),
(10, '4', 'U2-So cruel (Lyrics) ', 'https://www.youtube.com/embed/Ar2OTYKXnww?autoplay=1', 1, 0),
(11, '4', 'Video Advetisment', 'https://www.youtube.com/embed/wuz2ILq4UeA?autoplay=1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comments` text NOT NULL,
  `logged_user_id` int(11) NOT NULL,
  `songs_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comments`, `logged_user_id`, `songs_id`, `status`, `is_deleted`) VALUES
(1, 'Really great piece, although I would recommend changing a few things. The he first note, I think it should be on the d staff.', 3, 19, 1, 1),
(2, 'Hell Girl by Evanescene. This is Very bad....', 3, 19, 1, 1),
(3, 'test comment', 3, 19, 1, 1),
(4, 'Great Songs....', 1, 19, 1, 1),
(5, '', 1, 19, 1, 1),
(6, 'bad', 1, 19, 1, 1),
(7, '', 1, 19, 1, 1),
(8, 'good', 1, 19, 1, 1),
(9, 'Really great piece, although I would recommend changing a few things. The he first note, I think it should be on the d staff.', 1, 60, 1, 1),
(10, 'Really great piece, although I would recommend changing a few things. The he first note, I think it should be on the d staff.', 8, 62, 1, 1),
(11, 'Really great piece, although I would recommend changing a few things. The he first note, I think it should be on the d staff.', 1, 63, 1, 1),
(12, 'Really great piece, although I would recommend changing a few things. The he first note, I think it should be on the d staff.', 1, 66, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `family_sound`
--

CREATE TABLE IF NOT EXISTS `family_sound` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `family_sound`
--

INSERT INTO `family_sound` (`id`, `fid`, `name`, `details`, `status`, `is_deleted`) VALUES
(3, 4, 'Guitar', '', 1, 0),
(4, 4, 'Sitar', '', 1, 0),
(5, 5, 'Drums', '', 1, 0),
(6, 5, 'Bongo', '', 1, 0),
(7, 6, 'Trumpet', '', 1, 0),
(8, 4, 'Violin', '', 1, 1),
(9, 4, 'Guitar', '', 1, 1),
(10, 4, 'Cello', '', 1, 1),
(11, 4, 'Viola', '', 1, 1),
(12, 4, ' Violin', '', 1, 1),
(13, 4, ' Double Bass', '', 1, 1),
(14, 4, 'Harp', '', 1, 1),
(15, 4, 'Guitar', '', 1, 0),
(16, 4, 'Banjo', '', 1, 1),
(17, 4, 'Flute Piccolo', '', 1, 1),
(18, 4, 'Piccolo', '', 1, 0),
(19, 4, 'Clarinet', '', 1, 0),
(20, 7, 'Clarinet', '', 1, 1),
(21, 7, 'Oboe', '', 1, 1),
(22, 7, 'Bassoon', '', 1, 1),
(23, 7, 'Recorder', '', 1, 1),
(24, 7, 'Saxphone', '', 1, 1),
(25, 5, 'Kettledrum', '', 1, 1),
(26, 5, 'SteelDrum', '', 1, 1),
(27, 5, 'Glockenspiel', '', 1, 1),
(28, 5, 'Congas', '', 1, 1),
(29, 5, 'Xylophone', '', 1, 1),
(30, 5, 'Bass Drum', '', 1, 1),
(31, 5, 'Castanets', '', 1, 1),
(32, 5, 'Tambourine', '', 1, 1),
(33, 6, 'Trumpet', '', 1, 1),
(34, 6, 'Trombone', '', 1, 1),
(35, 6, 'Bariton Horn', '', 1, 1),
(36, 6, 'Euphonium', '', 1, 1),
(37, 6, 'Tuba', '', 1, 1),
(38, 6, 'Tenor Horn', '', 1, 1),
(39, 6, 'French Horn', '', 1, 1),
(40, 6, 'Flugel Horn', '', 1, 1),
(41, 6, 'Cornet', '', 1, 1),
(42, 6, 'Natural Trumpet', '', 1, 1),
(43, 6, 'Wagner Tuba', '', 1, 1),
(44, 6, 'Sousaphone', '', 1, 1),
(45, 9, 'FruityLoops', '', 1, 1),
(46, 9, 'GarageBand', '', 1, 1),
(47, 9, 'Ardour', '', 1, 1),
(48, 9, 'Reaper', '', 1, 1),
(49, 9, 'Sound Forge', '', 1, 1),
(50, 9, 'Rosegarden', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_info`
--

CREATE TABLE IF NOT EXISTS `log_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `log_date` varchar(255) NOT NULL,
  `log_time` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `log_info`
--

INSERT INTO `log_info` (`id`, `userid`, `log_date`, `log_time`, `details`, `is_deleted`, `status`) VALUES
(1, 0, '09/15/2015', '1442317316', 'New users signin', 1, 1),
(2, 1, '09/16/2015', '1442407820', 'New songs  by  Published by Suman', 1, 1),
(3, 1, '09/17/2015', '1442488658', 'New songs DJ Waley Babu by Badshah Published by Suman', 1, 1),
(4, 2, '09/17/2015', '1442488826', 'New songs Afghan Jalebi by Saif Ali Khan,Katrina Kaif Published by Suman', 1, 1),
(5, 3, '09/17/2015', '1442488958', 'New songs Dheere Dheere Se Meri Zindagi by Yo Yo Honey Singh Published by Suman', 1, 1),
(6, 1, '09/17/2015', '1442489144', 'New songs Mere Humsafar by Mithoon,Tulsi Kumar Published by Suman', 1, 1),
(7, 3, '09/17/2015', '1442489293', 'New songs Baaton Ko Teri by Arijit Singh Published by Suman', 1, 1),
(8, 0, '09/19/2015', '1442668022', 'New user register ', 1, 1),
(9, 1, '09/19/2015', '1442668705', 'New songs ghfhjgyjjhg by fghfhgf,fghfh Published by Suman', 1, 1),
(10, 3, '11/17/2015', '1447761212', 'New user register ', 1, 1),
(11, 1, '11/23/2015', '1448280728', 'New songs dsfds by fdsfdsf Published by Suman', 1, 1),
(12, 1, '11/23/2015', '1448283351', 'New songs Songs Name  by Artists Name Published by Suman', 1, 1),
(13, 1, '11/25/2015', '1448430483', 'New songs  by  Published by Suman', 1, 1),
(14, 0, '12/03/2015', '1449211697', 'New user register ', 1, 1),
(15, 0, '12/07/2015', '1449556688', 'New user register ', 1, 1),
(16, 0, '12/09/2015', '1449727992', 'New user register ', 1, 1),
(17, 0, '12/22/2015', '1450790848', 'New user register ', 1, 1),
(18, 3, '12/29/2015', '1451395431', 'New songs Kabhi Kabhi by Amitabh Published by shibu', 1, 1),
(19, 0, '01/04/2016', '1451906845', 'New user register ', 1, 1),
(20, 1, '01/06/2016', '1452078727', 'New songs ss by ss Published by Suman', 1, 1),
(21, 1, '01/07/2016', '1452160959', 'New songs asasasas by sssssssssss Published by Suman', 1, 1),
(22, 1, '01/13/2016', '1452688517', 'New songs sss by sss Published by Suman', 1, 1),
(23, 1, '01/13/2016', '1452689137', 'New songs Shibu Shibu by Shibu Published by Suman', 1, 1),
(24, 1, '01/13/2016', '1452689156', 'New songs Shibu Shibu by Shibu Published by Suman', 1, 1),
(25, 1, '01/13/2016', '1452689765', 'New songs Shibu Shibu by Shibu Published by Suman', 1, 1),
(26, 1, '01/13/2016', '1452689784', 'New songs Shibu Shibu by Shibu Published by Suman', 1, 1),
(27, 1, '01/13/2016', '1452690204', 'New songs Shibu Shibu by Shibu Published by Suman', 1, 1),
(28, 1, '01/13/2016', '1452690328', 'New songs Shibu SheetMusic || Upload Music by SheetMusic || Upload Music Published by Suman', 1, 1),
(29, 1, '01/13/2016', '1452690918', 'New songs Sssssssssssssssss by ssssssssssssss Published by Suman', 1, 1),
(30, 1, '01/13/2016', '1452691772', 'New songs gdfgdf by gdfgdf Published by Suman', 1, 1),
(31, 3, '01/16/2016', '1452958712', 'New songs Prasenjit Mukherjee by Prasenjit Mukherjee Published by shibu', 1, 1),
(32, 3, '01/16/2016', '1452958769', 'New songs Prasenjit Mukherjee by Prasenjit Mukherjee Published by shibu', 1, 1),
(33, 3, '01/16/2016', '1452959001', 'New songs Prasenjit Mukherjee123 by Prasenjit Mukherjee123 Published by shibu', 1, 1),
(34, 1, '01/18/2016', '1453098162', 'New songs ssssssssssss by ssssssssssssssssss Published by Suman', 1, 1),
(35, 1, '01/19/2016', '1453211281', 'New songs ss by ss Published by Suman', 1, 1),
(36, 1, '01/19/2016', '1453211324', 'New songs sdsad by fsd Published by Suman', 1, 1),
(37, 1, '01/19/2016', '1453212127', 'New songs dfcds by fdsf Published by Suman', 1, 1),
(38, 1, '02/04/2016', '1454592508', 'New songs Best Item Songs of Bollywood 2015 by T-Series  Published by Suman', 1, 1),
(39, 1, '02/04/2016', '1454592630', 'New songs Aa Ante Amalapuram by Maximum Video Song (official) Hazel Item Song  Published by Suman', 1, 1),
(40, 1, '02/09/2016', '1455015119', 'New songs Best Item Songs of Bollywood 2015 by T-Series  Published by Suman', 1, 1),
(41, 1, '02/09/2016', '1455017928', 'New songs aasfasd by sadasdasd Published by Suman', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `music_family`
--

CREATE TABLE IF NOT EXISTS `music_family` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `music_family`
--

INSERT INTO `music_family` (`id`, `name`, `details`, `status`, `is_deleted`) VALUES
(4, 'String', '', 1, 1),
(5, 'Percussion', '', 1, 1),
(6, 'Brass', '', 1, 1),
(7, 'Woodwind', '', 1, 1),
(8, 'Others', '', 1, 1),
(9, 'Digital Studio', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `music_sheets`
--

CREATE TABLE IF NOT EXISTS `music_sheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `songs_id` int(11) NOT NULL,
  `music_sheet_name` text NOT NULL,
  `position` varchar(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `music_sheets`
--

INSERT INTO `music_sheets` (`id`, `songs_id`, `music_sheet_name`, `position`, `status`, `is_deleted`) VALUES
(1, 32, 'option3.jpg', '0', 1, 1),
(2, 32, 'related_sheet.jpg', '1', 1, 1),
(3, 33, 'logo.png', '0', 1, 1),
(4, 34, 'music_sheet.jpg', '0', 1, 1),
(5, 35, 'down_arrow.png', '0', 1, 1),
(6, 36, 'logo.png', '0', 1, 1),
(7, 37, 'close_btn.png', '0', 1, 1),
(8, 38, 'close_btn.png', '0', 1, 1),
(9, 39, 'info_upload.png', '0', 1, 1),
(10, 40, '19310742_03.jpg', '0', 1, 1),
(11, 40, 'Christmas1004.gif', '1', 1, 1),
(12, 40, 'Christmas2006.gif', '2', 1, 1),
(13, 41, 'Christmas1004.gif', '0', 1, 1),
(14, 41, 'Christmas2006.gif', '1', 1, 1),
(15, 42, 'babylon_music sheet-page-001.jpg', '0', 1, 1),
(16, 42, 'babylon_music sheet-page-002.jpg', '1', 1, 1),
(17, 43, 'sinterklaasmedley-key-page-001.jpg', '0', 1, 1),
(18, 44, '0001.jpg', '0', 1, 1),
(19, 45, 'cantique-key-page-001.jpg', '0', 1, 1),
(20, 46, '0001.jpg', '0', 1, 1),
(21, 47, 'dona-key-page-001.jpg', '0', 1, 1),
(22, 48, 'dona-key-page-001.jpg', '0', 1, 1),
(23, 49, 'okomereens-bls5-page-001.jpg', '0', 1, 1),
(24, 50, 'Jingle Bells.jpg', '0', 1, 1),
(25, 51, 'away-key-page-001.jpg', '0', 1, 1),
(26, 52, 'JollyGood.jpg', '0', 1, 1),
(27, 53, 'away-key-page-001.jpg', '0', 1, 1),
(28, 54, 'away-key-page-001.jpg', '0', 1, 1),
(29, 55, 'trafalg_music sheet-page-001.jpg', '0', 1, 1),
(30, 56, 'polywoly_music sheet-page-001.jpg', '0', 1, 1),
(31, 56, 'polywoly_music sheet-page-002.jpg', '1', 1, 1),
(32, 56, 'polywoly_music sheet-page-003.jpg', '2', 1, 1),
(33, 57, 'house_music sheet-page-001.jpg', '0', 1, 1),
(34, 58, 'jollygood_music sheet-page-001.jpg', '0', 1, 1),
(35, 59, 'jinglebells-lead_music sheet-page-001.jpg', '0', 1, 1),
(36, 60, 'cotton_music sheet-page-001.jpg', '0', 1, 1),
(37, 61, 'allthrough-fl-page-001.jpg', '0', 1, 1),
(38, 62, 'blutenur-2fl-page-001.jpg', '0', 1, 1),
(39, 63, 'blutenur-2fl-page-001.jpg', '0', 1, 1),
(40, 64, 'dominedeus-fl-page-001.jpg', '0', 1, 1),
(41, 65, 'allthrough-fl-page-001.jpg', '0', 1, 1),
(42, 66, 'related_sheet.jpg', '0', 1, 1),
(43, 67, 'music_sheet.jpg', '0', 1, 1),
(44, 68, 'music_sheet.jpg', '0', 1, 1),
(45, 69, 'related_sheet.jpg', '0', 1, 1),
(46, 70, 'music_sheet.jpg', '0', 1, 1),
(47, 71, 'related_sheet.jpg', '0', 1, 1),
(48, 72, 'related_sheet.jpg', '0', 1, 1),
(49, 73, 'related_sheet.jpg', '0', 1, 1),
(50, 74, 'related_sheet.jpg', '0', 1, 1),
(51, 75, 'related_sheet.jpg', '0', 1, 1),
(52, 76, 'related_sheet.jpg', '0', 1, 1),
(53, 77, 'related_sheet.jpg', '0', 1, 1),
(54, 78, 'related_sheet.jpg', '0', 1, 1),
(55, 79, 'advertisment1.jpg', '0', 1, 1),
(56, 80, 'advertisment1.jpg', '0', 1, 1),
(57, 81, 'advertisment1.jpg', '0', 1, 1),
(59, 87, 'info_upload.png', '0', 1, 1),
(60, 87, 'logo.png', '1', 1, 1),
(61, 87, 'music_sheet.jpg', '2', 1, 1),
(62, 87, 'notify_ico.png', '3', 1, 1),
(63, 82, 'music_sheet.jpg', '0', 1, 1),
(64, 82, 'notify_ico.png', '1', 1, 1),
(65, 82, 'option1.jpg', '2', 1, 1),
(66, 82, 'option2.jpg', '3', 1, 1),
(67, 83, 'related_sheet.jpg', '0', 1, 1),
(69, 0, 'advertisment1.jpg', '0', 1, 1),
(70, 0, 'advertisment2.jpg', '1', 1, 1),
(71, 0, 'advertisment1.jpg', '0', 1, 1),
(72, 0, 'advertisment2.jpg', '1', 1, 1),
(73, 0, 'advertisment1.jpg', '0', 1, 1),
(74, 0, 'advertisment2.jpg', '1', 1, 1),
(76, 84, 'notify_ico.png', '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `song` text NOT NULL,
  `songs_duration` varchar(10) NOT NULL,
  `artist` text NOT NULL,
  `album` text NOT NULL,
  `contributor` text NOT NULL,
  `instrument` text NOT NULL,
  `instrument_family` text NOT NULL,
  `music` text NOT NULL,
  `video` text NOT NULL,
  `hits` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `user_id`, `song`, `songs_duration`, `artist`, `album`, `contributor`, `instrument`, `instrument_family`, `music`, `video`, `hits`, `published`, `is_deleted`, `status`) VALUES
(40, 4, 'Mahi Aaja Full Audio ', '03:01', 'Honey Singh', 'Singh Is Bliing ', 'Akshay Kumar & Amy Jackson', '10', '4', 'Mahi Aaja - Keerthi Sagathia(MyMp3Song.Com).mp3', 'https://www.youtube.com/embed/EBpXwRIVci4?autoplay=1', 5, 1, 1, 1),
(41, 4, 'Hogayi High', '03:02\n', 'Honey Sing', 'Dil Kare', 'Atif Aslam', '22', '7', 'Hogayi High - Biba Singh And DJ Shadow Dubai Ft. Rayven Justice(MyMp3Song.Com).mp3', 'https://www.youtube.com/embed/DbHpjvJnZ6o?autoplay=1', 2, 1, 1, 1),
(42, 4, 'Babylon', '', 'Boney M', 'The Harder They Come', 'Jan Wolters', '26', '5', 'BABYLON.MID', 'https://www.youtube.com/embed/aCf646Qbz6s?autoplay=1', 1, 1, 1, 1),
(43, 4, 'Sinterklaas Medley', '01:40\n', 'Trad.', 'iTunes', 'Jan Wolters', '9', '4', 'SINTERKLAASMEDLEY-KEY.mp3', 'http://www.youtube.com/embed/AbQrbzxFsCg?autoplay=1', 0, 1, 1, 1),
(44, 6, 'COTTON FILEDS', '', 'Creedence Clearwater Revival', 'Willy and the Poor Boys', 'J Wolters', '9', '4', 'COTTON.MID', 'http://www.youtube.com/embed/yvEr0fqYWs0?autoplay=1', 1, 1, 1, 1),
(45, 4, 'Cantique de Noël', '01:32\n', 'Adolph Adam', 'O Holy Night', 'Jan Wolters', '10', '4', 'CANTIQUE-KEY.mp3', 'https://www.youtube.com/watch?v=H1HNtEhLLzg', 0, 1, 1, 1),
(46, 6, 'The House of the Rising Sun', '', 'The Animals', 'The Animals', 'J Walkers', '9', '4', 'HOUSE.MID', 'http://www.youtube.com/watch?v=_Z_y3y5yqDQ', 1, 1, 1, 1),
(47, 4, 'Dona Nobis Pacem', '01:52\n', 'Sela', 'De tranen van de kleine mensen', 'Jan Wolters', '9', '4', 'DONA-KEY.mp3', 'http://www.youtube.com/watch?v=W5UhkuaEsTk', 1, 1, 1, 1),
(48, 4, 'Dona Nobis Pacem', '01:52\n', 'Robert Long', 'In die dagen', 'Jan Wolters', '12', '4', 'DONA-KEY.mp3', 'http://www.youtube.com/watch?v=W5UhkuaEsTk', 0, 1, 1, 1),
(49, 4, 'O, Kom Er Eens Kijken', '01:30\n', 'Katharina Leopold', 'Groningen', 'Jan Wolters', '33', '6', 'OKOMEREENS-BLS5.mp3', 'http://www.youtube.com/watch?v=xww4q8dep68', 0, 1, 1, 1),
(50, 6, 'JINGLE BELLS', '', 'Richard Clayderman', 'The Christmas Album', 'J Walkers', '29', '5', 'JINGLEBELLS-LEAD.MID', 'http://www.youtube.com/watch?v=NpiKY6zbTcY', 0, 1, 1, 1),
(51, 4, 'Away in a Manger', '01:45\n', 'Faith Hill', 'Joy to the World', 'Jan Wolters', '37', '6', 'AWAY-KEY(1).mp3', 'http://www.youtube.com/watch?v=KheGqdY6j1c', 7, 1, 1, 1),
(52, 6, 'Jolly Good', '', 'Frank Zappa', 'Traditional Children''s Song', 'B Vinton', '9', '4', 'JOLLYGOOD.MID', 'http://www.youtube.com/watch?v=VL0sD0Iyjzo', 0, 1, 1, 1),
(53, 4, 'Away in a Manger', '01:45\n', 'Casting Crowns', 'Peace on Earth', 'Jan Wolters', '34', '6', 'AWAY-KEY(1).mp3', 'http://www.youtube.com/watch?v=cQ6JZynsVYI', 20, 1, 1, 1),
(54, 4, 'Away in a Manger', '01:45\n', 'W.J.Kirkpatrick', 'Peace on Earth', 'Jan Wolters', '22', '7', 'AWAY-KEY(1).mp3', '', 2, 1, 1, 1),
(55, 4, 'Trafalgar Hornpipe', '01:15\n', 'Vi Wickam', 'Fiddle Tune a Day (Volume 1)', 'Trad', '16', '4', 'TRAFALG.mp3', '', 1, 1, 1, 1),
(56, 4, 'POLLY WOLLY DOODLE', '01:05\n', 'Shirley Temple', 'On the Track', 'Jan Wolters', '8', '4', 'POLYWOLY.mp3', 'http://www.youtube.com/watch?v=KheGqdY6j1c', 6, 1, 1, 1),
(57, 4, 'House of the Rising Sun', '01:13\n', 'The Animals', 'The Animals', 'Jan Wolters', '45', '9', 'HOUSE.mp3', '', 2, 1, 1, 1),
(58, 4, 'For he''s a jolly good fellow', '00:54', 'English Melody', 'Traditional English Melody', 'Jan Wolters', '14', '4', 'JOLLYGOOD.mp3', '', 5, 1, 1, 1),
(59, 7, 'Jingle Bells', '0:42', 'James Lord Pierpont', 'Merry Christmas', 'Allegretto', '17', '4', 'JINGLEBELLS-LEAD.mp3', 'https://www.youtube.com/embed/zSlhbBBBi3A?autoplay=1', 1, 1, 1, 1),
(60, 7, 'Cottonfields', '0:50', 'Rock tempo', 'Rock tempo', 'Jan Wolters', '9', '4', 'COTTON.mp3', 'https://www.youtube.com/embed/BS8UKDrohvY?autoplay=1', 4, 1, 1, 1),
(61, 7, 'All through the Night', '2:08', 'Cyndi Lauper', 'She''s So Unusual', 'Jan Wolters', '17', '4', 'ALLTHROUGH-FL.mp3', 'https://www.youtube.com/embed/ZONKoKIQ9RY?autoplay=1', 2, 1, 1, 1),
(62, 4, 'Blute nur, du Liebes Herz', '4:46', 'Collegium Vocale Gent', 'Matthäus-Passion', 'J.S. Bach', '17', '4', 'BLUTENUR-2FL.mp3', 'https://www.youtube.com/embed/sBdFjIMzRQQ?autoplay=1', 8, 1, 1, 1),
(63, 4, 'Blute nur, du Liebes Herz', '4:46', 'Collegium Vocale Gent', 'Matthäuspassion ', 'J.S. Bach', '16', '4', 'BLUTENUR-2FL.mp3', 'https://www.youtube.com/embed/WJwEKkv4PeI?autoplay=1', 2, 1, 1, 1),
(64, 7, 'Domine Deus', '3:58', 'A. Vivaldi', 'Domine Deus', 'Jan Wolters', '37', '6', 'DOMINEDEUS-FL.mp3', 'https://www.youtube.com/embed/lqWSzAiTuAA?autoplay=1', 9, 1, 1, 1),
(66, 3, 'Tere Sang', '3:09', 'Shaan', 'TereBin', 'Shibu', '9', '4', '2.mp3', 'https://www.youtube.com/embed/aCf646Qbz6s?autoplay=1', 7, 1, 1, 1),
(67, 3, 'Kabhi Kabhi', '3:09', 'Amitabh', 'My Album', 'shibu', '9', '4', '2.mp3', '', 15, 1, 1, 1),
(79, 3, 'Prasenjit Mukherjee', '4:05', 'Prasenjit Mukherjee', 'Prasenjit Mukherjee', 'Prasenjit Mukherjee', '8', '4', '2.mp3', '', 1, 1, 1, 1),
(80, 3, 'Prasenjit Mukherjee', '4:05', 'Prasenjit Mukherjee', 'Prasenjit Mukherjee', 'Prasenjit Mukherjee', '8', '4', '2.mp3', '', 0, 1, 1, 1),
(81, 3, 'Prasenjit Mukherjee123', '4:05', 'Prasenjit Mukherjee123', 'Prasenjit Mukherjee123', 'Prasenjit Mukherjee123', '8', '4', '2.mp3', '', 1, 1, 1, 1),
(82, 1, 'Best Item Songs of Bollywood 2015', '4:45', 'T-Series ', 'Latest HINDI ITEM', 'T-Series ', '26', '5', 'song1.mp3', 'https://www.youtube.com/embed/rIJffKDOpAE', 0, 1, 1, 1),
(83, 1, 'Aa Ante Amalapuram', '4:45', 'Maximum Video Song (official) Hazel Item Song ', 'Hazel Item Song ', 'Hazel Item Song ', '26', '5', 'song1.mp3', 'https://www.youtube.com/embed/GAhRuPmD4ps', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE IF NOT EXISTS `subscribes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_user_id` int(11) NOT NULL,
  `subscription_user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `login_user_id`, `subscription_user_id`, `status`, `is_deleted`) VALUES
(1, 1, 3, 1, 1),
(3, 1, 2, 1, 1),
(4, 1, 7, 1, 1),
(5, 8, 4, 1, 1),
(6, 1, 4, 1, 1),
(7, 10, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `forget_password_otp` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `forget_password_otp`, `status`, `is_deleted`) VALUES
(1, 'Suman', 'suman@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1449661392', 1, 1),
(2, 'banty', 'banty@sheetmusic.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 0, 0),
(3, 'shibu', 'shibu@gmail.com', '21232f297a57a5a743894a0e4a801fc3', NULL, 1, 1),
(4, 'Supratim', 'amits.nisbusiness@gmail.com', '5df3dcdf46e70329ca453acb2a3d1aed', '5802805508', 1, 1),
(5, 'shib Maji', 'sumanaaa@gmail.com', '743e857fe1b66ea9419c8085b608e321', NULL, 1, 1),
(6, 'Andreas Cramer', 'andreas.nisbusiness@gmail.com', '9515c05031766437b75b738e5fcb1e67', NULL, 1, 1),
(7, 'Supriya', 'supriyanisbusiness@gmail.com', 'e31343045b93e29dd78650f3be9dd3cb', NULL, 1, 1),
(8, 'King', 'amitsarkar1412@rediffmail.com', '5df3dcdf46e70329ca453acb2a3d1aed', NULL, 1, 1),
(9, 'Sarkar', 'amit@nisbusiness.com', 'e31343045b93e29dd78650f3be9dd3cb', NULL, 1, 1),
(10, 'shibu', 'shibua@gmail.com', 'a5c00c9b87cc68f2c7fe4e12ad446ec5', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_saved_songs`
--

CREATE TABLE IF NOT EXISTS `user_saved_songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `songs_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_saved_songs`
--

INSERT INTO `user_saved_songs` (`id`, `user_id`, `songs_id`, `is_deleted`) VALUES
(1, 1, 83, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
