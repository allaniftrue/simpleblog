-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2013 at 12:21 AM
-- Server version: 5.5.28-0ubuntu0.12.04.3
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sph`
--

-- --------------------------------------------------------

--
-- Table structure for table `pre_comments`
--

CREATE TABLE IF NOT EXISTS `pre_comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `post_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pre_comments`
--

INSERT INTO `pre_comments` (`id`, `post_id`, `name`, `comment`, `comment_date`) VALUES
(1, 1, 'John Smith', 'Parturient placerat aliquam ultrices tempor tempor, dignissim magna, est lacus aliquet nec, urna, hac! In augue dictumst adipiscing? Ultricies phasellus, augue elementum', '2013-01-20 21:23:44'),
(2, 2, 'John Smith', 'Et turpis penatibus proin, lundium magna porttitor, eu vel augue cum, cursus parturient! Eros! Et? Dolor sagittis sociis pulvinar? Aliquet ultricies platea vel! Mid.', '2013-01-21 00:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `pre_posts`
--

CREATE TABLE IF NOT EXISTS `pre_posts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `post` text NOT NULL,
  `author` int(255) NOT NULL,
  `entry_date` datetime NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pre_posts`
--

INSERT INTO `pre_posts` (`id`, `title`, `post`, `author`, `entry_date`, `url`) VALUES
(1, 'integer a tempor', '&lt;p style=&quot;margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-size: 13px; vertical-align: baseline; background-color: transparent; font-family: arial; text-align: justify;&quot;&gt;&lt;span style=&quot;font-size: medium; font-family: ''times new roman'', times;&quot;&gt;Mattis sagittis ridiculus, augue pid habitasse diam in? Dapibus purus pulvinar nunc nascetur ut mid elementum, elementum, eu tincidunt ut? Elementum eros? Ac. Turpis turpis scelerisque porttitor dolor tincidunt elementum amet porttitor? Nec eros magnis ultricies, duis tristique, aliquet nec, urna velit? Lorem cum. Et sit nisi tincidunt, duis mus velit, et duis enim, porta etiam porta lectus et quis phasellus lectus magna lectus penatibus eu duis adipiscing porta augue pulvinar. Platea turpis duis in arcu. Integer a tempor massa. Nec! Nec purus scelerisque. Cursus nunc in magnis rhoncus cras, porttitor, eros, elit dignissim amet sit! Natoque facilisis turpis non integer sed non. Risus, cras penatibus? A est? Pulvinar ut a porta, cras proin vel lacus nisi? Dis enim dolor.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-size: 13px; vertical-align: baseline; background-color: transparent; font-family: arial; text-align: justify;&quot;&gt;&lt;span style=&quot;font-size: medium; font-family: ''times new roman'', times;&quot;&gt;Ac purus adipiscing ut nec ut in aenean scelerisque magnis turpis turpis sed nisi duis. Adipiscing ac. Tincidunt, magna tincidunt enim, penatibus lacus. Auctor, turpis aenean. Tristique sociis augue turpis nunc! Scelerisque ridiculus. Augue ac, cum sit vel mattis. Mus platea in cursus? Est egestas mid et! Egestas velit, mus, et! Integer rhoncus, augue, porttitor, nisi mid rhoncus enim vut ut platea sit parturient! Aliquam sit et. Vel! Penatibus augue auctor! Scelerisque et ac turpis, et tincidunt dolor etiam montes sagittis aliquet rhoncus ultrices placerat porta sit mus turpis, est lacus ultrices nisi aenean ridiculus, duis hac natoque. Enim tempor! Ac aenean dictumst? Vel, adipiscing integer turpis, adipiscing sociis elementum scelerisque sed ultrices, ac adipiscing lundium platea, ut augue.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-size: 13px; vertical-align: baseline; background-color: transparent; font-family: arial; text-align: justify;&quot;&gt;&lt;span style=&quot;font-size: medium; font-family: ''times new roman'', times;&quot;&gt;Aliquam pulvinar nascetur, integer nascetur, eros dolor eros ac platea vel. Placerat natoque aliquam diam, et nec arcu tristique diam cras parturient montes pellentesque, mid facilisis, ac! Facilisis pellentesque pulvinar ultrices, pellentesque amet nisi! Tincidunt eros duis urna dignissim lectus aliquet arcu porta hac, sit enim ut. Natoque ut a placerat! Urna magna tempor magna, placerat purus ultricies mid, tortor pulvinar! Dapibus arcu mattis tincidunt mid montes lectus tristique mattis sed, odio cum! Odio. Sagittis hac sed! Habitasse aliquam pid dis penatibus elementum, montes tempor non mus sed tempor! Aenean lorem sed, sagittis magnis velit ac tempor sed! Pellentesque. Porta elit facilisis turpis amet odio sit sagittis non mattis est lundium! Dapibus parturient urna lorem et integer aliquam dictumst.&lt;/span&gt;&lt;/p&gt;', 1, '2013-01-20 21:22:50', 'integer-a-tempor'),
(2, 'magnis', '&lt;p style=&quot;margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-size: 13px; vertical-align: baseline; background-color: transparent; font-family: arial; text-align: justify;&quot;&gt;&lt;span style=&quot;font-family: ''times new roman'', times;&quot;&gt;&lt;img style=&quot;float: left; margin: 10px;&quot; src=&quot;http://i45.tinypic.com/5piw7m.jpg&quot; alt=&quot;&quot; width=&quot;430&quot; height=&quot;323&quot; /&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-size: 13px; vertical-align: baseline; background-color: transparent; font-family: arial; text-align: justify;&quot;&gt;&lt;span style=&quot;font-family: ''times new roman'', times; font-size: medium;&quot;&gt;Integer adipiscing lorem tristique ultricies cras in elit lundium, ac hac purus massa dis. Auctor vut et proin augue dictumst integer amet, integer penatibus sit ut enim phasellus, parturient diam lectus porttitor adipiscing nec dignissim proin? Et, montes non nisi, est massa penatibus amet pid nunc purus phasellus, sed aliquet. Turpis, nec! Integer tortor, platea aliquam, penatibus hac, nisi mauris ultricies elit? Augue turpis vel, a, arcu facilisis, magna nec aenean sed, magna lundium non? Nec a, placerat dictumst in, ac? Montes augue cum! Quis adipiscing hac ut porta in. Et! Adipiscing! Mattis enim magna nisi ridiculus diam et mattis? Amet aenean integer odio adipiscing sed cras c tincidunt vel scelerisque tristique! Lectus integer ac habitasse nisi, ridiculus amet, augue.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-size: 13px; vertical-align: baseline; background-color: transparent; font-family: arial; text-align: justify;&quot;&gt;&lt;span style=&quot;font-family: ''times new roman'', times; font-size: medium;&quot;&gt;Mid rhoncus egestas dignissim tortor, scelerisque, eu, ut diam magna mid aenean pellentesque, et in? Sagittis et ridiculus cursus sed lectus pulvinar diam magna quis egestas purus et, magna, hac egestas aenean hac mauris? Proin tortor porta, augue dapibus? Facilisis mid rhoncus turpis sed a rhoncus aliquam. Sed tortor pulvinar? Urna augue adipiscing, diam duis, natoque natoque velit adipiscing sed mattis turpis, dapibus! Ac etiam, parturient, dis, nec, placerat! Habitasse urna? Facilisis? Et cum elit, est aliquet augue massa, mattis tortor cras! Magna enim ac integer rhoncus magnis purus! Eu in elementum turpis nec, velit porta tristique duis, cursus porta mattis diam auctor dictumst auctor phasellus placerat, turpis et? Diam ac, sed rhoncus integer rhoncus egestas dis, non enim.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=&quot;margin: 0px 0px 10px; padding: 0px; border: 0px; outline: 0px; font-size: 13px; vertical-align: baseline; background-color: transparent; font-family: arial; text-align: justify;&quot;&gt;&lt;span style=&quot;font-family: ''times new roman'', times; font-size: medium;&quot;&gt;Placerat, integer hac velit, integer turpis amet ac rhoncus in cras, lacus ultrices cras, ac pulvinar sociis amet proin elementum nunc est duis mauris. Enim? Penatibus tincidunt? Odio dictumst elit lundium, augue ac augue egestas! Sed in ut eros. Hac aliquet nascetur! Facilisis tortor, proin ut sit! Rhoncus cum ac sed, sed ut duis vel pulvinar adipiscing turpis tincidunt, duis, augue adipiscing mauris augue etiam odio pulvinar, tristique urna nascetur augue, sit dolor scelerisque augue rhoncus odio etiam egestas, a scelerisque, in aliquet enim purus etiam sagittis elementum in, risus sed, adipiscing porta lorem, lorem! Turpis duis vut, aliquet porta pid turpis a pulvinar elit nec mattis est pellentesque lectus a penatibus tristique phasellus integer, odio. Sed scelerisque auctor.&amp;nbsp;&lt;/span&gt;&lt;/p&gt;', 1, '2013-01-21 00:12:33', 'magnis');

-- --------------------------------------------------------

--
-- Table structure for table `pre_users`
--

CREATE TABLE IF NOT EXISTS `pre_users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `usertype` enum('regular','admin') NOT NULL DEFAULT 'regular',
  `date` date NOT NULL,
  `confirmation` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-not confirmed, 1-confirmed',
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `pre_users`
--

INSERT INTO `pre_users` (`id`, `username`, `password`, `salt`, `usertype`, `date`, `confirmation`, `lastname`, `firstname`, `middlename`, `email`, `contact`, `address`) VALUES
(1, 'admin', '8wO6sC29GzjN0ssTJImM9pg9pPTqpIMRQcp7WPlgZCtZMnRdSoMRSINK7FtPoLD2M0a3ZM1f+Zsw3Xik7x+Urw==', 's3bjYE+oj+7+ZkuJDTQ9vKp8iNQkjMsyu6vJyP3PEvWUZXq5d6eghA0Agi1XfJrtPUlTSsrfU07S1OlgrhJkcQ==', 'admin', '2012-11-04', '1', 'Smith', 'John', 'Doe', 'johnsmith@gmail.com', '84527030', '183B Rivervale Crescent');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
