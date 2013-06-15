SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dagent`
--

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE IF NOT EXISTS `domains` (
  `dom_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Domain id',
  `dom_name` varchar(255) NOT NULL COMMENT 'Domain name',
  `dom_reg_id` int(11) NOT NULL COMMENT 'Registrar ID',
  `dom_reg_date` date NOT NULL COMMENT 'Date of registration',
  `dom_exp_date` date NOT NULL COMMENT 'Date of expiration',
  `dom_comment` text NOT NULL COMMENT 'Comment',
  `dom_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Last modified',
  `dom_status` int(11) NOT NULL,
  PRIMARY KEY (`dom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`dom_id`, `dom_name`, `dom_reg_id`, `dom_reg_date`, `dom_exp_date`, `dom_comment`, `dom_modified`, `dom_status`) VALUES
(1, 'google.com', 1, '2013-06-01', '2014-06-01', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2013-06-01 00:40:10', 0),
(2, 'yahoo.com', 2, '2013-06-01', '2013-06-01', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2013-06-01 00:40:31', 0),
(3, 'mashable.com', 3, '2012-07-01', '2013-07-01', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2013-06-01 00:41:04', 0),
(4, 'wordpress.com', 4, '2012-06-01', '2015-06-01', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2013-06-01 00:41:20', 0),
(5, 'lowendtalk.com', 5, '2012-06-01', '2016-06-01', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', '2013-06-01 00:41:44', 0),
(6, 'vpsboard.com', 6, '2010-10-04', '2012-10-10', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2013-06-01 00:41:56', 0),
(7, 'twitter.com', 1, '2010-03-01', '2014-03-01', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', '2013-06-01 00:42:51', 0),
(8, 'facebook.com', 2, '2012-05-01', '2013-06-11', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text.', '2013-06-01 00:43:08', 0),
(9, 'webhostingtalk.com', 3, '2013-06-01', '2014-06-01', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2013-06-01 00:43:25', 0),
(10, 'buyvm.com', 4, '2013-06-01', '2014-06-01', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2013-06-01 00:43:37', 0),
(11, 'ramnode.com', 5, '2013-06-01', '2014-06-01', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2013-06-01 00:43:46', 0),
(12, 'digitalocean.com', 6, '2013-06-01', '2015-06-01', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', '2013-06-01 00:44:10', 0),
(13, 'lowendbox.com', 1, '2013-06-01', '2014-06-01', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text.', '2013-06-01 00:44:37', 0),
(14, 'envato.com', 2, '2013-06-01', '2014-06-01', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2013-06-01 00:44:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registrars`
--

CREATE TABLE IF NOT EXISTS `registrars` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Registrar ID',
  `reg_name` varchar(255) NOT NULL COMMENT 'Registrar name',
  `reg_link` varchar(255) NOT NULL COMMENT 'Registrar link',
  `reg_comment` text NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `registrars`
--

INSERT INTO `registrars` (`reg_id`, `reg_name`, `reg_link`, `reg_comment`) VALUES
(1, 'NameCheap', 'namecheap.com', ''),
(2, 'InternetBS', 'internetbs.net', ''),
(3, 'MediaTemple', 'mediatemple.net', ''),
(4, 'CrazyDomainsAU', 'crazydomains.com.au', ''),
(5, 'GoDaddy', 'godaddy.com', ''),
(6, 'NameSilo', 'namesilo.com', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
