-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2017 at 12:09 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `postprimary`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesspin_cost`
--

CREATE TABLE `accesspin_cost` (
  `sn` int(10) NOT NULL,
  `Qty` varchar(20) NOT NULL,
  `Cost` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesspin_cost`
--

INSERT INTO `accesspin_cost` (`sn`, `Qty`, `Cost`, `status`) VALUES
(1, '100', '50000', 'on'),
(2, '500', '240000', 'on'),
(3, '1000', '530000', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `access_pin`
--

CREATE TABLE `access_pin` (
  `sn` int(20) NOT NULL,
  `batch_no` text NOT NULL,
  `cdate` varchar(15) NOT NULL,
  `pinSN` varchar(20) NOT NULL,
  `pin` text NOT NULL,
  `activate_for_use_status` varchar(5) NOT NULL,
  `leasing_period` int(2) NOT NULL,
  `no_of_login` int(1) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `card_status` varchar(5) NOT NULL,
  `first_login_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_pin`
--

INSERT INTO `access_pin` (`sn`, `batch_no`, `cdate`, `pinSN`, `pin`, `activate_for_use_status`, `leasing_period`, `no_of_login`, `student_id`, `session`, `term`, `card_status`, `first_login_date`) VALUES
(1, '0013AKCACB', '3/10/2016', '', '000000', 'on', 10, 10, '12016002', 'jss 1', 'First term', 'used', '0000-00-00'),
(2, '0023AKCACB', '28/09/2016', '', '000001', 'on', 10, 6, '12016002', 'jss 1', 'First term', 'used', '18/03/2017'),
(214, '0033BACACB', '04/10/2016', '0010033BACACB', '168G-315G-168G', 'on', 3, 1, '2017001', '-', '-', 'used', '19/04/2017'),
(215, '0033BACACB', '04/10/2016', '0020033BACACB', '421K-416K-292H', 'on', 10, 2, '12016002', 'jss 1', 'Third term', 'used', '19/04/2017'),
(216, '0033BACACB', '04/10/2016', '0030033BACACB', '172K-825G-291G', '', 3, 0, '', '', '', '', '0000-00-00'),
(217, '0033BACACB', '04/10/2016', '0040033BACACB', '171H-717G-720K', '', 3, 0, '', '', '', '', '0000-00-00'),
(218, '0033BACACB', '04/10/2016', '0050033BACACB', '166H-181H-718H', '', 3, 0, '', '', '', '', '0000-00-00'),
(219, '0033BACACB', '04/10/2016', '0060033BACACB', '109K-152K-419K', '', 3, 0, '', '', '', '', '0000-00-00'),
(220, '0033BACACB', '04/10/2016', '0070033BACACB', '102G-781H-161K', '', 3, 0, '', '', '', '', '0000-00-00'),
(221, '0033BACACB', '04/10/2016', '0080033BACACB', '278H-194H-125H', '', 3, 0, '', '', '', '', '0000-00-00'),
(222, '0033BACACB', '04/10/2016', '0090033BACACB', '510G-142K-891H', '', 3, 0, '', '', '', '', '0000-00-00'),
(223, '0033BACACB', '04/10/2016', '0100033BACACB', '818G-203K-268G', '', 3, 0, '', '', '', '', '0000-00-00'),
(224, '0033BACACB', '04/10/2016', '0110033BACACB', '152K-522G-212H', '', 3, 0, '', '', '', '', '0000-00-00'),
(225, '0033BACACB', '04/10/2016', '0120033BACACB', '430H-221G-059G', '', 3, 0, '', '', '', '', '0000-00-00'),
(226, '0033BACACB', '04/10/2016', '0130033BACACB', '123G-242K-182H', '', 3, 0, '', '', '', '', '0000-00-00'),
(227, '0033BACACB', '04/10/2016', '0140033BACACB', '112H-829G-526G', '', 3, 0, '', '', '', '', '0000-00-00'),
(228, '0033BACACB', '04/10/2016', '0150033BACACB', '187K-151G-042G', '', 3, 0, '', '', '', '', '0000-00-00'),
(229, '0033BACACB', '04/10/2016', '0160033BACACB', '271H-220G-191K', '', 3, 0, '', '', '', '', '0000-00-00'),
(230, '0033BACACB', '04/10/2016', '0170033BACACB', '192G-325G-231H', '', 3, 0, '', '', '', '', '0000-00-00'),
(231, '0033BACACB', '04/10/2016', '0180033BACACB', '193K-018G-122G', '', 3, 0, '', '', '', '', '0000-00-00'),
(232, '0033BACACB', '04/10/2016', '0190033BACACB', '242G-821H-861H', '', 3, 0, '', '', '', '', '0000-00-00'),
(233, '0033BACACB', '04/10/2016', '0200033BACACB', '121K-226G-191K', '', 3, 0, '', '', '', '', '0000-00-00'),
(234, '0033BACACB', '04/10/2016', '0210033BACACB', '122K-231H-616G', '', 3, 0, '', '', '', '', '0000-00-00'),
(235, '0033BACACB', '04/10/2016', '0220033BACACB', '102G-022G-826G', '', 3, 0, '', '', '', '', '0000-00-00'),
(236, '0033BACACB', '04/10/2016', '0230033BACACB', '134G-572K-542G', '', 3, 0, '', '', '', '', '0000-00-00'),
(237, '0033BACACB', '04/10/2016', '0240033BACACB', '176H-251K-324H', '', 3, 0, '', '', '', '', '0000-00-00'),
(238, '0033BACACB', '04/10/2016', '0250033BACACB', '138K-171H-421G', '', 3, 0, '', '', '', '', '0000-00-00'),
(239, '0033BACACB', '04/10/2016', '0260033BACACB', '172H-122H-016H', '', 3, 0, '', '', '', '', '0000-00-00'),
(240, '0033BACACB', '04/10/2016', '0270033BACACB', '251H-121G-114G', '', 3, 0, '', '', '', '', '0000-00-00'),
(241, '0033BACACB', '04/10/2016', '0280033BACACB', '261K-914K-251K', '', 3, 0, '', '', '', '', '0000-00-00'),
(242, '0033BACACB', '04/10/2016', '0290033BACACB', '727G-232H-116K', '', 3, 0, '', '', '', '', '0000-00-00'),
(243, '0033BACACB', '04/10/2016', '0300033BACACB', '226G-242G-422H', '', 3, 0, '', '', '', '', '0000-00-00'),
(244, '0033BACACB', '04/10/2016', '0310033BACACB', '261H-251G-752G', '', 3, 0, '', '', '', '', '0000-00-00'),
(245, '0033BACACB', '04/10/2016', '0320033BACACB', '282K-313G-519K', '', 3, 0, '', '', '', '', '0000-00-00'),
(246, '0033BACACB', '04/10/2016', '0330033BACACB', '182G-192G-211G', '', 3, 0, '', '', '', '', '0000-00-00'),
(247, '0033BACACB', '04/10/2016', '0340033BACACB', '797H-251H-421H', '', 3, 0, '', '', '', '', '0000-00-00'),
(248, '0033BACACB', '04/10/2016', '0350033BACACB', '261H-512H-712G', '', 3, 0, '', '', '', '', '0000-00-00'),
(249, '0033BACACB', '04/10/2016', '0360033BACACB', '816K-192G-171G', '', 3, 0, '', '', '', '', '0000-00-00'),
(250, '0033BACACB', '04/10/2016', '0370033BACACB', '326G-691H-630K', '', 3, 0, '', '', '', '', '0000-00-00'),
(251, '0033BACACB', '04/10/2016', '0380033BACACB', '120G-255H-330G', '', 3, 0, '', '', '', '', '0000-00-00'),
(252, '0033BACACB', '04/10/2016', '0390033BACACB', '292K-418H-203G', '', 3, 0, '', '', '', '', '0000-00-00'),
(253, '0033BACACB', '04/10/2016', '0400033BACACB', '515G-694G-818G', '', 3, 0, '', '', '', '', '0000-00-00'),
(254, '0033BACACB', '04/10/2016', '0410033BACACB', '712K-291H-913H', '', 3, 0, '', '', '', '', '0000-00-00'),
(255, '0033BACACB', '04/10/2016', '0420033BACACB', '916G-112G-119G', '', 3, 0, '', '', '', '', '0000-00-00'),
(256, '0033BACACB', '04/10/2016', '0430033BACACB', '251G-322G-192H', '', 3, 0, '', '', '', '', '0000-00-00'),
(257, '0033BACACB', '04/10/2016', '0440033BACACB', '243K-122G-128H', '', 3, 0, '', '', '', '', '0000-00-00'),
(258, '0033BACACB', '04/10/2016', '0450033BACACB', '147H-262H-302H', '', 3, 0, '', '', '', '', '0000-00-00'),
(259, '0033BACACB', '04/10/2016', '0460033BACACB', '201G-522H-630G', '', 3, 0, '', '', '', '', '0000-00-00'),
(260, '0033BACACB', '04/10/2016', '0470033BACACB', '526G-211G-723G', '', 3, 0, '', '', '', '', '0000-00-00'),
(261, '0033BACACB', '04/10/2016', '0480033BACACB', '282H-912G-620K', '', 3, 0, '', '', '', '', '0000-00-00'),
(262, '0033BACACB', '04/10/2016', '0490033BACACB', '101G-726G-291G', '', 3, 0, '', '', '', '', '0000-00-00'),
(263, '0033BACACB', '04/10/2016', '0500033BACACB', '172H-428K-742K', '', 3, 0, '', '', '', '', '0000-00-00'),
(264, '0033BACACB', '04/10/2016', '0510033BACACB', '245G-811H-123H', '', 3, 0, '', '', '', '', '0000-00-00'),
(265, '0033BACACB', '04/10/2016', '0520033BACACB', '211G-916K-233H', '', 3, 0, '', '', '', '', '0000-00-00'),
(266, '0033BACACB', '04/10/2016', '0530033BACACB', '253K-205K-112H', '', 3, 0, '', '', '', '', '0000-00-00'),
(267, '0033BACACB', '04/10/2016', '0540033BACACB', '272H-761G-410H', '', 3, 0, '', '', '', '', '0000-00-00'),
(268, '0033BACACB', '04/10/2016', '0550033BACACB', '111G-257G-281G', '', 3, 0, '', '', '', '', '0000-00-00'),
(269, '0033BACACB', '04/10/2016', '0560033BACACB', '928H-312G-191K', '', 3, 0, '', '', '', '', '0000-00-00'),
(270, '0033BACACB', '04/10/2016', '0570033BACACB', '154G-142H-813K', '', 3, 0, '', '', '', '', '0000-00-00'),
(271, '0033BACACB', '04/10/2016', '0580033BACACB', '172G-921K-291G', '', 3, 0, '', '', '', '', '0000-00-00'),
(272, '0033BACACB', '04/10/2016', '0590033BACACB', '194H-131G-137H', '', 3, 0, '', '', '', '', '0000-00-00'),
(273, '0033BACACB', '04/10/2016', '0600033BACACB', '132K-619H-141K', '', 3, 0, '', '', '', '', '0000-00-00'),
(274, '0033BACACB', '04/10/2016', '0610033BACACB', '362K-421G-329K', '', 3, 0, '', '', '', '', '0000-00-00'),
(275, '0033BACACB', '04/10/2016', '0620033BACACB', '981G-823G-172G', '', 3, 0, '', '', '', '', '0000-00-00'),
(276, '0033BACACB', '04/10/2016', '0630033BACACB', '201H-131G-320H', '', 3, 0, '', '', '', '', '0000-00-00'),
(277, '0033BACACB', '04/10/2016', '0640033BACACB', '142G-751H-423G', '', 3, 0, '', '', '', '', '0000-00-00'),
(278, '0033BACACB', '04/10/2016', '0650033BACACB', '191G-871G-830G', '', 3, 0, '', '', '', '', '0000-00-00'),
(279, '0033BACACB', '04/10/2016', '0660033BACACB', '235K-434K-262K', '', 3, 0, '', '', '', '', '0000-00-00'),
(280, '0033BACACB', '04/10/2016', '0670033BACACB', '271H-428H-221K', '', 3, 0, '', '', '', '', '0000-00-00'),
(281, '0033BACACB', '04/10/2016', '0680033BACACB', '112G-413H-144K', '', 3, 0, '', '', '', '', '0000-00-00'),
(282, '0033BACACB', '04/10/2016', '0690033BACACB', '271G-212H-102K', '', 3, 0, '', '', '', '', '0000-00-00'),
(283, '0033BACACB', '04/10/2016', '0700033BACACB', '262G-414H-320G', '', 3, 0, '', '', '', '', '0000-00-00'),
(284, '0033BACACB', '04/10/2016', '0710033BACACB', '827H-212K-991H', '', 3, 0, '', '', '', '', '0000-00-00'),
(285, '0033BACACB', '04/10/2016', '0720033BACACB', '181G-813H-142G', '', 3, 0, '', '', '', '', '0000-00-00'),
(286, '0033BACACB', '04/10/2016', '0730033BACACB', '141K-613K-251K', '', 3, 0, '', '', '', '', '0000-00-00'),
(287, '0033BACACB', '04/10/2016', '0740033BACACB', '291G-516H-186G', '', 3, 0, '', '', '', '', '0000-00-00'),
(288, '0033BACACB', '04/10/2016', '0750033BACACB', '471G-122H-226G', '', 3, 0, '', '', '', '', '0000-00-00'),
(289, '0033BACACB', '04/10/2016', '0760033BACACB', '282H-592G-042G', '', 3, 0, '', '', '', '', '0000-00-00'),
(290, '0033BACACB', '04/10/2016', '0770033BACACB', '262G-130G-184H', '', 3, 0, '', '', '', '', '0000-00-00'),
(291, '0033BACACB', '04/10/2016', '0780033BACACB', '231G-523H-812G', '', 3, 0, '', '', '', '', '0000-00-00'),
(292, '0033BACACB', '04/10/2016', '0790033BACACB', '242H-029G-291G', '', 3, 0, '', '', '', '', '0000-00-00'),
(293, '0033BACACB', '04/10/2016', '0800033BACACB', '211H-882G-542K', '', 3, 0, '', '', '', '', '0000-00-00'),
(294, '0033BACACB', '04/10/2016', '0810033BACACB', '222G-930G-109H', '', 3, 0, '', '', '', '', '0000-00-00'),
(295, '0033BACACB', '04/10/2016', '0820033BACACB', '281H-612G-313G', '', 3, 0, '', '', '', '', '0000-00-00'),
(296, '0033BACACB', '04/10/2016', '0830033BACACB', '301K-013H-153H', '', 3, 0, '', '', '', '', '0000-00-00'),
(297, '0033BACACB', '04/10/2016', '0840033BACACB', '181K-271K-223K', '', 3, 0, '', '', '', '', '0000-00-00'),
(298, '0033BACACB', '04/10/2016', '0850033BACACB', '918G-212G-121G', '', 3, 0, '', '', '', '', '0000-00-00'),
(299, '0033BACACB', '04/10/2016', '0860033BACACB', '761G-524G-212G', '', 3, 0, '', '', '', '', '0000-00-00'),
(300, '0033BACACB', '04/10/2016', '0870033BACACB', '511K-302K-862G', '', 3, 0, '', '', '', '', '0000-00-00'),
(301, '0033BACACB', '04/10/2016', '0880033BACACB', '941H-681H-881G', '', 3, 0, '', '', '', '', '0000-00-00'),
(302, '0033BACACB', '04/10/2016', '0890033BACACB', '221H-611G-027G', '', 3, 0, '', '', '', '', '0000-00-00'),
(303, '0033BACACB', '04/10/2016', '0900033BACACB', '215G-172G-619H', '', 3, 0, '', '', '', '', '0000-00-00'),
(304, '0033BACACB', '04/10/2016', '0910033BACACB', '101K-524G-114G', '', 3, 0, '', '', '', '', '0000-00-00'),
(305, '0033BACACB', '04/10/2016', '0920033BACACB', '112H-129G-151K', '', 3, 0, '', '', '', '', '0000-00-00'),
(306, '0033BACACB', '04/10/2016', '0930033BACACB', '914G-131H-678G', '', 3, 0, '', '', '', '', '0000-00-00'),
(307, '0033BACACB', '04/10/2016', '0940033BACACB', '112G-723G-302G', '', 3, 0, '', '', '', '', '0000-00-00'),
(308, '0033BACACB', '04/10/2016', '0950033BACACB', '141H-318G-866G', '', 3, 0, '', '', '', '', '0000-00-00'),
(309, '0033BACACB', '04/10/2016', '0960033BACACB', '622H-022K-122G', '', 3, 0, '', '', '', '', '0000-00-00'),
(310, '0033BACACB', '04/10/2016', '0970033BACACB', '281G-426K-131K', '', 3, 0, '', '', '', '', '0000-00-00'),
(311, '0033BACACB', '04/10/2016', '0980033BACACB', '112G-118H-224G', '', 3, 0, '', '', '', '', '0000-00-00'),
(312, '0033BACACB', '04/10/2016', '0990033BACACB', '291G-110H-232K', '', 3, 0, '', '', '', '', '0000-00-00'),
(313, '0033BACACB', '04/10/2016', '0990033BACACB', '330G-830K-188H', '', 3, 0, '', '', '', '', '0000-00-00'),
(414, '0043ACCACC', '11/02/2017', '0010043ACCACC', '693I-014G-224H', '', 5, 0, '', '', '', '', ''),
(415, '0043ACCACC', '11/02/2017', '0020043ACCACC', '121G-225G-191H', '', 5, 0, '', '', '', '', ''),
(416, '0043ACCACC', '11/02/2017', '0030043ACCACC', '342I-110H-234H', '', 5, 0, '', '', '', '', ''),
(417, '0043ACCACC', '11/02/2017', '0040043ACCACC', '252H-130H-252I', '', 5, 0, '', '', '', '', ''),
(418, '0043ACCACC', '11/02/2017', '0050043ACCACC', '222G-122H-825H', '', 5, 0, '', '', '', '', ''),
(419, '0043ACCACC', '11/02/2017', '0060043ACCACC', '252I-318H-119H', '', 5, 0, '', '', '', '', ''),
(420, '0043ACCACC', '11/02/2017', '0070043ACCACC', '281I-724H-279H', '', 5, 0, '', '', '', '', ''),
(421, '0043ACCACC', '11/02/2017', '0080043ACCACC', '259H-222H-421I', '', 5, 0, '', '', '', '', ''),
(422, '0043ACCACC', '11/02/2017', '0090043ACCACC', '224G-303H-013G', '', 5, 0, '', '', '', '', ''),
(423, '0043ACCACC', '11/02/2017', '0100043ACCACC', '213H-771H-721I', '', 5, 0, '', '', '', '', ''),
(424, '0043ACCACC', '11/02/2017', '0110043ACCACC', '101I-209H-168G', '', 5, 0, '', '', '', '', ''),
(425, '0043ACCACC', '11/02/2017', '0120043ACCACC', '184G-102H-412I', '', 5, 0, '', '', '', '', ''),
(426, '0043ACCACC', '11/02/2017', '0130043ACCACC', '132H-220H-511G', '', 5, 0, '', '', '', '', ''),
(427, '0043ACCACC', '11/02/2017', '0140043ACCACC', '922I-012H-221I', '', 5, 0, '', '', '', '', ''),
(428, '0043ACCACC', '11/02/2017', '0150043ACCACC', '201G-224H-272I', '', 5, 0, '', '', '', '', ''),
(429, '0043ACCACC', '11/02/2017', '0160043ACCACC', '203G-182H-611H', '', 5, 0, '', '', '', '', ''),
(430, '0043ACCACC', '11/02/2017', '0170043ACCACC', '231H-951G-125H', '', 5, 0, '', '', '', '', ''),
(431, '0043ACCACC', '11/02/2017', '0180043ACCACC', '102H-112H-052H', '', 5, 0, '', '', '', '', ''),
(432, '0043ACCACC', '11/02/2017', '0190043ACCACC', '619I-262H-481H', '', 5, 0, '', '', '', '', ''),
(433, '0043ACCACC', '11/02/2017', '0200043ACCACC', '212I-524I-231I', '', 5, 0, '', '', '', '', ''),
(434, '0043ACCACC', '11/02/2017', '0210043ACCACC', '322H-298H-231G', '', 5, 0, '', '', '', '', ''),
(435, '0043ACCACC', '11/02/2017', '0220043ACCACC', '171H-710H-189G', '', 5, 0, '', '', '', '', ''),
(436, '0043ACCACC', '11/02/2017', '0230043ACCACC', '201H-123I-241H', '', 5, 0, '', '', '', '', ''),
(437, '0043ACCACC', '11/02/2017', '0240043ACCACC', '213G-015H-122I', '', 5, 0, '', '', '', '', ''),
(438, '0043ACCACC', '11/02/2017', '0250043ACCACC', '159H-131H-212G', '', 5, 0, '', '', '', '', ''),
(439, '0043ACCACC', '11/02/2017', '0260043ACCACC', '224I-615G-712H', '', 5, 0, '', '', '', '', ''),
(440, '0043ACCACC', '11/02/2017', '0270043ACCACC', '182H-472I-111I', '', 5, 0, '', '', '', '', ''),
(441, '0043ACCACC', '11/02/2017', '0280043ACCACC', '481G-751H-319H', '', 5, 0, '', '', '', '', ''),
(442, '0043ACCACC', '11/02/2017', '0290043ACCACC', '725H-723H-279H', '', 5, 0, '', '', '', '', ''),
(443, '0043ACCACC', '11/02/2017', '0300043ACCACC', '113I-011H-121H', '', 5, 0, '', '', '', '', ''),
(444, '0043ACCACC', '11/02/2017', '0310043ACCACC', '724H-561I-492I', '', 5, 0, '', '', '', '', ''),
(445, '0043ACCACC', '11/02/2017', '0320043ACCACC', '152H-657H-982H', '', 5, 0, '', '', '', '', ''),
(446, '0043ACCACC', '11/02/2017', '0330043ACCACC', '242G-388G-311I', '', 5, 0, '', '', '', '', ''),
(447, '0043ACCACC', '11/02/2017', '0340043ACCACC', '725I-132G-429H', '', 5, 0, '', '', '', '', ''),
(448, '0043ACCACC', '11/02/2017', '0350043ACCACC', '162H-831G-921H', '', 5, 0, '', '', '', '', ''),
(449, '0043ACCACC', '11/02/2017', '0360043ACCACC', '112H-328G-301I', '', 5, 0, '', '', '', '', ''),
(450, '0043ACCACC', '11/02/2017', '0370043ACCACC', '226H-231G-328I', '', 5, 0, '', '', '', '', ''),
(451, '0043ACCACC', '11/02/2017', '0380043ACCACC', '235H-251H-114I', '', 5, 0, '', '', '', '', ''),
(452, '0043ACCACC', '11/02/2017', '0390043ACCACC', '256H-171I-712G', '', 5, 0, '', '', '', '', ''),
(453, '0043ACCACC', '11/02/2017', '0400043ACCACC', '183I-021H-181G', '', 5, 0, '', '', '', '', ''),
(454, '0043ACCACC', '11/02/2017', '0410043ACCACC', '151I-541I-328H', '', 5, 0, '', '', '', '', ''),
(455, '0043ACCACC', '11/02/2017', '0420043ACCACC', '241I-812G-101G', '', 5, 0, '', '', '', '', ''),
(456, '0043ACCACC', '11/02/2017', '0430043ACCACC', '271H-827I-242I', '', 5, 0, '', '', '', '', ''),
(457, '0043ACCACC', '11/02/2017', '0440043ACCACC', '414G-252H-542H', '', 5, 0, '', '', '', '', ''),
(458, '0043ACCACC', '11/02/2017', '0450043ACCACC', '168H-152H-041H', '', 5, 0, '', '', '', '', ''),
(459, '0043ACCACC', '11/02/2017', '0460043ACCACC', '320H-119H-132H', '', 5, 0, '', '', '', '', ''),
(460, '0043ACCACC', '11/02/2017', '0470043ACCACC', '271G-681G-322H', '', 5, 0, '', '', '', '', ''),
(461, '0043ACCACC', '11/02/2017', '0480043ACCACC', '418G-199G-221G', '', 5, 0, '', '', '', '', ''),
(462, '0043ACCACC', '11/02/2017', '0490043ACCACC', '925I-221G-225I', '', 5, 0, '', '', '', '', ''),
(463, '0043ACCACC', '11/02/2017', '0500043ACCACC', '241H-115H-327H', '', 5, 0, '', '', '', '', ''),
(464, '0043ACCACC', '11/02/2017', '0510043ACCACC', '162H-512G-323I', '', 5, 0, '', '', '', '', ''),
(465, '0043ACCACC', '11/02/2017', '0520043ACCACC', '112H-695H-132I', '', 5, 0, '', '', '', '', ''),
(466, '0043ACCACC', '11/02/2017', '0530043ACCACC', '723H-231I-320H', '', 5, 0, '', '', '', '', ''),
(467, '0043ACCACC', '11/02/2017', '0540043ACCACC', '282H-621I-121G', '', 5, 0, '', '', '', '', ''),
(468, '0043ACCACC', '11/02/2017', '0550043ACCACC', '232H-120H-192G', '', 5, 0, '', '', '', '', ''),
(469, '0043ACCACC', '11/02/2017', '0560043ACCACC', '252G-326H-623H', '', 5, 0, '', '', '', '', ''),
(470, '0043ACCACC', '11/02/2017', '0570043ACCACC', '292I-525G-191H', '', 5, 0, '', '', '', '', ''),
(471, '0043ACCACC', '11/02/2017', '0580043ACCACC', '191I-282H-628H', '', 5, 0, '', '', '', '', ''),
(472, '0043ACCACC', '11/02/2017', '0590043ACCACC', '193H-132H-418G', '', 5, 0, '', '', '', '', ''),
(473, '0043ACCACC', '11/02/2017', '0600043ACCACC', '112I-719H-201H', '', 5, 0, '', '', '', '', ''),
(474, '0043ACCACC', '11/02/2017', '0610043ACCACC', '251G-841H-843I', '', 5, 0, '', '', '', '', ''),
(475, '0043ACCACC', '11/02/2017', '0620043ACCACC', '118H-166H-279I', '', 5, 0, '', '', '', '', ''),
(476, '0043ACCACC', '11/02/2017', '0630043ACCACC', '272H-515I-141I', '', 5, 0, '', '', '', '', ''),
(477, '0043ACCACC', '11/02/2017', '0640043ACCACC', '542H-627G-162H', '', 5, 0, '', '', '', '', ''),
(478, '0043ACCACC', '11/02/2017', '0650043ACCACC', '222G-319H-793G', '', 5, 0, '', '', '', '', ''),
(479, '0043ACCACC', '11/02/2017', '0660043ACCACC', '127H-918H-920H', '', 5, 0, '', '', '', '', ''),
(480, '0043ACCACC', '11/02/2017', '0670043ACCACC', '122I-675H-830I', '', 5, 0, '', '', '', '', ''),
(481, '0043ACCACC', '11/02/2017', '0680043ACCACC', '479G-186I-512I', '', 5, 0, '', '', '', '', ''),
(482, '0043ACCACC', '11/02/2017', '0690043ACCACC', '621H-610I-231H', '', 5, 0, '', '', '', '', ''),
(483, '0043ACCACC', '11/02/2017', '0700043ACCACC', '291I-172G-415H', '', 5, 0, '', '', '', '', ''),
(484, '0043ACCACC', '11/02/2017', '0710043ACCACC', '122H-172H-228H', '', 5, 0, '', '', '', '', ''),
(485, '0043ACCACC', '11/02/2017', '0720043ACCACC', '594G-619H-141G', '', 5, 0, '', '', '', '', ''),
(486, '0043ACCACC', '11/02/2017', '0730043ACCACC', '227I-237H-197G', '', 5, 0, '', '', '', '', ''),
(487, '0043ACCACC', '11/02/2017', '0740043ACCACC', '144G-301H-023G', '', 5, 0, '', '', '', '', ''),
(488, '0043ACCACC', '11/02/2017', '0750043ACCACC', '632I-179I-261I', '', 5, 0, '', '', '', '', ''),
(489, '0043ACCACC', '11/02/2017', '0760043ACCACC', '972G-815H-212I', '', 5, 0, '', '', '', '', ''),
(490, '0043ACCACC', '11/02/2017', '0770043ACCACC', '122H-616H-131H', '', 5, 0, '', '', '', '', ''),
(491, '0043ACCACC', '11/02/2017', '0780043ACCACC', '219I-222H-121H', '', 5, 0, '', '', '', '', ''),
(492, '0043ACCACC', '11/02/2017', '0790043ACCACC', '891G-028H-916I', '', 5, 0, '', '', '', '', ''),
(493, '0043ACCACC', '11/02/2017', '0800043ACCACC', '117I-372G-310G', '', 5, 0, '', '', '', '', ''),
(494, '0043ACCACC', '11/02/2017', '0810043ACCACC', '827G-137H-216H', '', 5, 0, '', '', '', '', ''),
(495, '0043ACCACC', '11/02/2017', '0820043ACCACC', '106I-129G-682I', '', 5, 0, '', '', '', '', ''),
(496, '0043ACCACC', '11/02/2017', '0830043ACCACC', '233G-010I-192G', '', 5, 0, '', '', '', '', ''),
(497, '0043ACCACC', '11/02/2017', '0840043ACCACC', '159I-242H-514G', '', 5, 0, '', '', '', '', ''),
(498, '0043ACCACC', '11/02/2017', '0850043ACCACC', '111H-922I-292H', '', 5, 0, '', '', '', '', ''),
(499, '0043ACCACC', '11/02/2017', '0860043ACCACC', '520G-292H-061G', '', 5, 0, '', '', '', '', ''),
(500, '0043ACCACC', '11/02/2017', '0870043ACCACC', '131H-625H-310G', '', 5, 0, '', '', '', '', ''),
(501, '0043ACCACC', '11/02/2017', '0880043ACCACC', '151H-213H-303G', '', 5, 0, '', '', '', '', ''),
(502, '0043ACCACC', '11/02/2017', '0890043ACCACC', '292G-313I-552H', '', 5, 0, '', '', '', '', ''),
(503, '0043ACCACC', '11/02/2017', '0900043ACCACC', '232H-292G-729H', '', 5, 0, '', '', '', '', ''),
(504, '0043ACCACC', '11/02/2017', '0910043ACCACC', '133H-014H-922I', '', 5, 0, '', '', '', '', ''),
(505, '0043ACCACC', '11/02/2017', '0920043ACCACC', '243I-101G-616H', '', 5, 0, '', '', '', '', ''),
(506, '0043ACCACC', '11/02/2017', '0930043ACCACC', '209I-196G-252I', '', 5, 0, '', '', '', '', ''),
(507, '0043ACCACC', '11/02/2017', '0940043ACCACC', '131I-013G-132I', '', 5, 0, '', '', '', '', ''),
(508, '0043ACCACC', '11/02/2017', '0950043ACCACC', '126H-712H-262I', '', 5, 0, '', '', '', '', ''),
(509, '0043ACCACC', '11/02/2017', '0960043ACCACC', '128H-121G-942G', '', 5, 0, '', '', '', '', ''),
(510, '0043ACCACC', '11/02/2017', '0970043ACCACC', '726G-241H-311H', '', 5, 0, '', '', '', '', ''),
(511, '0043ACCACC', '11/02/2017', '0980043ACCACC', '262I-112I-211G', '', 5, 0, '', '', '', '', ''),
(512, '0043ACCACC', '11/02/2017', '0990043ACCACC', '282H-416H-247H', '', 5, 0, '', '', '', '', ''),
(513, '0043ACCACC', '11/02/2017', '0990043ACCACC', '292G-638G-917G', '', 5, 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `advert`
--

CREATE TABLE `advert` (
  `sn` int(20) NOT NULL,
  `ads_title` text NOT NULL,
  `ads_id` varchar(20) NOT NULL,
  `install_date` varchar(10) NOT NULL,
  `availability_period` varchar(5) NOT NULL,
  `start_date` varchar(10) NOT NULL,
  `ads_dimension` varchar(4) NOT NULL,
  `path` text NOT NULL,
  `publish_status` varchar(4) NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `user_enabled` varchar(10) NOT NULL,
  `orderID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advert`
--

INSERT INTO `advert` (`sn`, `ads_title`, `ads_id`, `install_date`, `availability_period`, `start_date`, `ads_dimension`, `path`, `publish_status`, `schlid`, `user_enabled`, `orderID`) VALUES
(1, 'Site cbt', '1', '2/1/2017', '60', '2/1/2017', '2x5', '', 'on', '', '', '76'),
(2, 'site new yr wishes', '2', '2/1/2017', '90', '2/1/2017', '2x5', 'ads/ads2.png', '', '1', 'on', '321'),
(3, 'Alvana Admission', '3', '7/1/2017', '30', '9/1/2017', '2x5', 'ads/3.png', 'on', '1', 'on', '234'),
(4, 'book lunch', '', '13/01/2017', '60', '', '2x5', 'ads/AO1701130759.jpg', '', '1', 'on', 'AO1701130759'),
(5, 'Inter house sport IV', '', '13/01/2017', '60', '', '2x5', 'ads/AO1701130802.jpg', '', '1', 'on', 'AO1701130802'),
(6, 'Another', '', '13/01/2017', '30', '', '4x2', '', '', '1', '', 'AO1701130808'),
(7, 'wow', '', '13/01/2017', '120', '', '2x5', '', '', '1', '', 'AO1701130810'),
(11, 'Quiz Compitition IV', '', '16/01/2017', '90', '', '2x5', 'ads/AO1701161540.jpg', '', '1', 'on', 'AO1701161540'),
(12, 'Quiz IV 2', '', '16/01/2017', '90', '1/10/2016', '2x5', 'ads/AO1701161551.jpg', '', '1', 'on', 'AO1701161551'),
(13, 'wash competition', '', '16/01/2017', '90', '19/01/2017', '2x5', 'ads/AO1701162035.jpg', '', '1', 'on', 'AO1701162035'),
(14, 'customized schl item', '', '17/01/2017', '60', '19/01/2017', '2x5', 'ads/AO1701170506.jpg', 'on', '1', 'on', 'AO1701170506'),
(15, 'termly admission', 'AO1701170557', '17/01/2017', '30', '', '2x5', 'ads/AO1701170557.jpg', '', '1', 'on', 'AO1701170557'),
(16, 'Office accessory sal', 'AO1702250727', '25/02/2017', '30', '', '5x2', '', '', '1', '', 'AO1702250727');

-- --------------------------------------------------------

--
-- Table structure for table `advert_cost`
--

CREATE TABLE `advert_cost` (
  `sn` int(10) NOT NULL,
  `Days` varchar(20) NOT NULL,
  `Cost` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advert_cost`
--

INSERT INTO `advert_cost` (`sn`, `Days`, `Cost`, `status`) VALUES
(1, '30', '10000', 'on'),
(2, '60', '19500', 'on'),
(3, '90', '29000', 'on'),
(4, '120', '29000', 'on'),
(5, '150', '38500', 'on'),
(6, '180', '48000', 'on'),
(7, '210', '57500', 'on'),
(8, '240', '67000', 'on'),
(9, '270', '76500', 'on'),
(10, '300', '86000', 'on'),
(11, '330', '95500', 'on'),
(12, '360', '105000', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `sn` int(20) NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `classid` varchar(20) NOT NULL,
  `subClass` varchar(2) NOT NULL,
  `no_of_student` varchar(5) NOT NULL,
  `adminID` varchar(10) NOT NULL,
  `promotion_policy` varchar(5) NOT NULL,
  `admission_year` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`sn`, `schlid`, `classid`, `subClass`, `no_of_student`, `adminID`, `promotion_policy`, `admission_year`) VALUES
(1, '1', '2016', 'A', '', '23', '', '2016'),
(2, '1', '2015', 'A', '', '23', '', '2015'),
(5, '1', '2017', 'A', '', '23', '', '2017'),
(6, '1', '2017', 'B', '', '23', '', '2017'),
(7, '1', '2016', 'B', '', '23', '', '2016');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_access_pin`
--

CREATE TABLE `ordered_access_pin` (
  `SN` int(100) NOT NULL,
  `adminEmail` varchar(20) NOT NULL,
  `schoolID` varchar(20) NOT NULL,
  `orderID` varchar(20) NOT NULL,
  `Qty` varchar(20) NOT NULL,
  `Qty_cost` varchar(20) NOT NULL,
  `Shippment_method` varchar(30) NOT NULL,
  `Shippment_cost` varchar(20) NOT NULL,
  `Total_cost` varchar(20) NOT NULL,
  `order_date` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `user_enabled` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_access_pin`
--

INSERT INTO `ordered_access_pin` (`SN`, `adminEmail`, `schoolID`, `orderID`, `Qty`, `Qty_cost`, `Shippment_method`, `Shippment_cost`, `Total_cost`, `order_date`, `status`, `user_enabled`) VALUES
(1, 'Joyce2013@gmail.com', '1', 'AP1608210929', '500', '24000', 'Send pins in finished form', '1000', '25000', '21-08-2016', 'done', 'on'),
(4, 'Joyce2013@gmail.com', '1', 'AP1611130644', '100', '50000', 'Send pins in finished form', '1000', '51000', '13-11-2016', '', 'on'),
(5, 'Joyce2013@gmail.com', '1', 'AP1701210756', '1000', '636000', 'Send pins in finished form', '1000', '637000', '21-01-2017', '', 'on'),
(6, 'Joyce2013@gmail.com', '1', 'AP1701210834', '100', '60000', 'Send pins in finished form', '1000', '61000', '21-01-2017', '', 'on'),
(7, 'Joyce2013@gmail.com', '1', 'AP1701210859', '100', '60000', 'Send pins in finished form', '1000', '61000', '21-01-2017', '', 'on'),
(8, 'Joyce2013@gmail.com', '1', 'AP1702250425', '500', '288000', 'Send pins in finished form', '1000', '289000', '25-02-2017', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_premuim_cbt`
--

CREATE TABLE `ordered_premuim_cbt` (
  `SN` int(100) NOT NULL,
  `adminEmail` varchar(20) NOT NULL,
  `schoolID` varchar(20) NOT NULL,
  `orderID` varchar(20) NOT NULL,
  `Total_cost` varchar(20) NOT NULL,
  `order_date` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `user_enabled` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_premuim_cbt`
--

INSERT INTO `ordered_premuim_cbt` (`SN`, `adminEmail`, `schoolID`, `orderID`, `Total_cost`, `order_date`, `status`, `user_enabled`) VALUES
(2, 'Joyce2013@gmail.com', '1', 'CBT1703141755', '5000', '14/03/2017', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `premuim_cbt_access_code`
--

CREATE TABLE `premuim_cbt_access_code` (
  `sn` int(255) NOT NULL,
  `access_code` varchar(20) NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `activation_date` varchar(15) NOT NULL,
  `expiration_date` varchar(15) NOT NULL,
  `generated_date` varchar(15) NOT NULL,
  `premuim_cbt_request_id` varchar(20) NOT NULL,
  `active_status` varchar(5) NOT NULL,
  `access_usage` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `premuim_cbt_access_code`
--

INSERT INTO `premuim_cbt_access_code` (`sn`, `access_code`, `schlid`, `activation_date`, `expiration_date`, `generated_date`, `premuim_cbt_request_id`, `active_status`, `access_usage`) VALUES
(1, '4321', '1', '22/01/2017', '30/03/2017', '20/01/2017', '1234', '', '10:106:'),
(2, '4312', '1', '1/03/2017', '31/03/2017', '20/01/2017', 'CBT1703141053', '', '021:035:034'),
(3, '4313', '', '', '', '20/01/2017', '', '', ''),
(4, '4314', '', '', '', '20/01/2017', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `prospectlist`
--

CREATE TABLE `prospectlist` (
  `SN` int(100) NOT NULL,
  `name` varchar(40) NOT NULL,
  `curyear` varchar(15) NOT NULL,
  `id` varchar(20) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `schlid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospectlist`
--

INSERT INTO `prospectlist` (`SN`, `name`, `curyear`, `id`, `dob`, `schlid`) VALUES
(1, 'Kalu Njideka', '2017', '2017001', '2/10/2017', '1');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `sn` int(20) NOT NULL,
  `subject_name` varchar(20) NOT NULL,
  `term` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `tscore` int(2) NOT NULL,
  `practscore` varchar(2) NOT NULL,
  `examscore` int(2) NOT NULL,
  `classave` int(2) NOT NULL,
  `classhighest` int(2) NOT NULL,
  `studID` varchar(20) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `schlid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`sn`, `subject_name`, `term`, `session`, `tscore`, `practscore`, `examscore`, `classave`, `classhighest`, `studID`, `class_id`, `schlid`) VALUES
(1, 'English', 'First term', 'jss 1', 15, '', 45, 56, 80, '2345', '2015', '1'),
(10, 'English', 'First term', 'jss 1', 13, '', 35, 0, 0, '1343', '2015', '1'),
(11, 'English', 'First term', 'jss 1', 10, '', 30, 0, 0, '12015346', '2015', '1'),
(12, 'English', 'First term', 'jss 1', 14, '', 40, 0, 0, '12015347', '2015', '1'),
(13, 'English', 'First term', 'jss 1', 16, '', 40, 0, 0, '12015348', '2015', '1'),
(14, 'English', 'First term', 'jss 1', 13, '', 39, 0, 0, '12015349', '2015', '1'),
(15, 'English', 'First term', 'jss 1', 14, '', 40, 0, 0, '12015350', '2015', '1'),
(16, 'English', 'First term', 'jss 1', 12, '', 38, 0, 0, '12015351', '2015', '1'),
(17, 'English', 'First term', 'jss 1', 14, '', 39, 0, 0, '12015352', '2015', '1'),
(18, 'English', 'First term', 'jss 1', 14, '', 34, 0, 0, '12016001', '2016', '1'),
(19, 'English', 'First term', 'jss 1', 12, '', 43, 0, 0, '12016002', '2016', '1'),
(20, 'Physics', 'First term', 'jss 1', 15, '', 35, 0, 0, '12016001', '2016', '1'),
(21, 'Physics', 'First term', 'jss 1', 0, '', 0, 0, 0, '12016002', '2016', '1'),
(22, 'English', 'First term', 'JSS 1', 8, '', 34, 0, 0, '12016003', '2016', '1'),
(23, 'English', 'First term', 'JSS 1', 10, '', 30, 0, 0, '12016004', '2016', '1'),
(24, 'Fine Art', 'First term', 'JSS 1', 8, '15', 34, 0, 0, '12016001', '2016', '1'),
(25, 'Fine Art', 'First term', 'JSS 1', 6, '11', 35, 0, 0, '12016002', '2016', '1'),
(26, 'Fine Art', 'First term', 'JSS 1', 7, '14', 38, 0, 0, '12016003', '2016', '1'),
(27, 'Fine Art', 'First term', 'JSS 1', 7, '15', 35, 0, 0, '12016004', '2016', '1');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `sn` int(20) NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `admin` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `location` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `govt_approved_status` varchar(5) NOT NULL,
  `description` text NOT NULL,
  `schlName` text NOT NULL,
  `schlProg` text NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `grading_profile` varchar(20) NOT NULL,
  `promotion_policy` varchar(20) NOT NULL,
  `published` varchar(5) NOT NULL,
  `schlLogo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`sn`, `schlid`, `admin`, `address`, `location`, `State`, `govt_approved_status`, `description`, `schlName`, `schlProg`, `email`, `phone`, `grading_profile`, `promotion_policy`, `published`, `schlLogo`) VALUES
(1, '1', '23', 'owerri-onisha road owerri imo state', 'owerri', 'Imo', 'on', 'Founded in 2005 by alvan ikookwu college of education owerri, an affiliate of university of Nigeria Nsukka, for the purpose of academic development of their students', 'Alvana secondary school', '10/11/2016:24/02/2017:20/11/2016', 'alvanaowerri@yahoo.co.uk:facebook/alvanaOwerri:alvanowerri@tweeter:alvanaowerri@gmail.com:07026765446:www.alvana.com', '', 'schoolGrading', 'Select Promotion Pol', 'on', 'school/1.png'),
(2, '2', '34', 'New Haven Phase two enugu', 'New-haven', 'Enugu', '', '', 'Kings High school', '', '', '', '', '', '', ''),
(3, '042010001', '34', 'Oppsite Army Barracks Abakpa Junction Enugu', 'Abakpa', 'Enugu', '', '', 'National Grammar School Nike Enugu', '', '', '', '', '', '', ''),
(4, '1234', '1234', 'No 2. Ginika str. New haven layout phase two', '', '', 'on', 'Pine crest international secondary school is a first class secondary school instituted to uphold the standard of education in Nigeria, since 1995, by Sir and lady C. S. Njoku.\r\nSince it inception, it has contributed to the development of our youths education in so many ramifications such as sports, science and technology, and art.\r\nIn arts for instance, pine crest international secondary school ....', 'pine crest intl. secondary school', '10/06/2017:24/02/2017:30/06/2017', 'PineCrestIntlsecondaryschoolEnugu@gmail.com:PineCrestIntlsecondaryschoolEnugu:PineCrestIntlsecondaryschoolEnugu:PineCrestIntlsecondaryschoolEnugu@gmail.com:08026765446', '', 'schoolGrading', 'Select Promotion Pol', 'on', ''),
(16, '042010002', '042010002/Ig4I4', 'no 1 uwani road obiagu enugu', 'Abakpa', 'Enugu', 'on', 'University secondary school is a secondary school instituted to assist the staff and management of university of Nigeria Enugu campus in the training of their children and the children of families in the environs.', 'UNEC secondary school', '10/06/2017:12/03/2017:30/06/2017', '::::', '', 'waecGrading', 'Select Promotion Pol', 'on', ''),
(21, '042010003', '042010003/2hgh2', '', 'Abakpa', 'Enugu', '', '', 'manifold high school owerri', '', '', '', '', '', '', ''),
(22, '042010004', '042010004/hnILIg', '', 'Abakpa', 'Enugu', '', '', 'High Flyers high school Enugu', '', '', '', '', '', '', ''),
(23, '042010005', '042010005/h12I4', '', 'Abakpa', 'Enugu', '', '', 'A1 intl hogh school lagos', '', '', '', '', '', '', ''),
(24, '042010006', '042010006/II4IO', '', 'Abakpa', 'Enugu', '', '', 'Emmanuel High school', '', '', '', '', '', '', ''),
(25, '042010007', '042010007/4IO3Ih', '', 'Abakpa', 'Enugu', '', '', 'Prime Secondary school', '', '', '', '', '', '', ''),
(26, '083002001', '083002001/h3Lhn', '', 'Okigwe', 'Imo', '', '', 'Lotus Collage', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `school_admin`
--

CREATE TABLE `school_admin` (
  `sn` int(20) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(25) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `schoolName` text NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `adminID` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `activation_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_admin`
--

INSERT INTO `school_admin` (`sn`, `name`, `email`, `gender`, `schoolName`, `schlid`, `adminID`, `phone`, `password`, `activation_status`) VALUES
(1, 'Nnamdi onwuzebe', 'Onwuzebe2009@gmail.com', 'Male', 'Alvana secondary school', '5', '', '08034723000', '', ''),
(3, 'Eze Chinwe', 'EzeChinwe07@yahoo.com', 'Female', 'Alvana secondary school', '4', '', '08023565648', '', 'on'),
(4, 'Onwubiko Livinia', 'OnwubikoLivinia@ymail.com', 'Female', 'Alvana secondary school', '3', '', '08034256340', '', ''),
(5, 'Aja Nwachukwu', 'Nwachukwuaja@yahoo.com', 'Male', 'Alvana secondary school', '2', '', '09075444243', '', ''),
(6, 'Ejiogu Joy Chika', 'Joyce2013@gmail.com', 'Female', 'Alvana secondary school', '1', '23', '09065477820', 'ILJIOh4', 'on'),
(7, 'Amaka Mmaduka', 'Amy217@gmail.com', 'Female', 'UNEC secondary school', '042010002', '042010002/Ig4I4', '08057639254', 'h23h1Ign', 'on'),
(8, 'Michael Chigemezi', 'Mike123@gmail.com', 'Male', 'Redemptionist Seconday school', '', '', '08034031606', '', 'on'),
(9, 'Edeh Chinonye', 'CyrilEde@yahoo.com', 'Male', 'Rock Family secondary school', '', '', '09053678760', '', 'on'),
(10, 'emmanuel Chidubem', 'Chidubem24@gmail.com', 'Male', 'pine crest intl. secondary school', '1234', '1234', '08105669983', '1234', 'on'),
(11, 'Amanada Jones', 'Amanda23@gmail.com', 'Female', 'High Flyers high school Enugu', '042010004', '042010004/hnILI', '08105669068', 'h23OIOII', 'on'),
(12, 'achike udenwa', 'achikeUde@gmail.com', 'Male', 'manifold high school owerri', '042010003', '042010003/2hgh2', '08105669012', 'IgI4Lh23', 'on'),
(13, 'Lohan evans', 'Loha23@hotmail.com', 'Male', 'A1 intl hogh school lagos', '042010005', '042010005/h12I4', '08107069065', 'hJh44h23', 'on'),
(22, 'Manuel okeafor', 'OkeafoM@gmail.com', 'Male', 'Emmanuel High school', '042010006', '042010006/II4IO', '08105669605', '1h11hgh23', 'on'),
(25, 'hassan Balogun', 'hassanBal3@gmail.co', 'Male', 'Prime Secondary school', '042010007', '042010007/4IO3Ih', '08109889065', 'hgIOI4hL', 'on'),
(26, 'Clement Okogwu', 'clementOkogwu@yahoo.com', 'Male', 'Lotus Collage', '083002001', '083002001/h3Lhn', '08107869065', 'hOI1IL23', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `shippment_cost`
--

CREATE TABLE `shippment_cost` (
  `sn` int(100) NOT NULL,
  `location` varchar(20) NOT NULL,
  `locationID` varchar(3) NOT NULL DEFAULT '000',
  `state` varchar(20) NOT NULL,
  `stateID` varchar(3) NOT NULL DEFAULT '000',
  `region` varchar(20) NOT NULL,
  `Cost` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shippment_cost`
--

INSERT INTO `shippment_cost` (`sn`, `location`, `locationID`, `state`, `stateID`, `region`, `Cost`) VALUES
(1, 'Abakpa', '010', 'Enugu', '042', 'South-East', '1000'),
(2, 'Emene', '009', 'Enugu', '042', 'South-East', '1200'),
(3, 'Uwani', '008', 'Enugu', '042', 'South-East', '1000'),
(4, 'Nite-Mile', '007', 'Enugu', '042', 'South-East', '1000'),
(5, 'Ogui', '006', 'Enugu', '042', 'South-East', '1000'),
(6, 'New-Haven', '001', 'Enugu', '042', 'South-East', '1200'),
(7, 'Trans-Ekulu', '002', 'Enugu', '042', 'South-East', '1000'),
(8, 'Amaechi', '004', 'Enugu', '042', 'South-East', '1000'),
(9, 'Nsukka', '003', 'Enugu', '042', 'South-East', '1500'),
(10, 'Oji-river', '005', 'Enugu', '042', 'South-East', '1500'),
(11, 'owerri', '001', 'Imo', '083', 'South-East', '1000'),
(12, 'Okigwe', '002', 'Imo', '083', 'South-East', '1000'),
(13, 'Orlu', '003', 'Imo', '083', 'South-East', '1000'),
(14, 'Oguta', '005', 'Imo', '083', 'South-East', '1000'),
(15, 'Umuahia', '001', 'Abia', '084', 'South-East', '1000'),
(16, 'Aba', '002', 'Abia', '084', 'South-East', '1200'),
(17, 'Awka', '001', 'Anambra', '043', 'South-East', '1500'),
(18, 'Mbaise', '004', 'Imo', '083', 'South-East', '1000'),
(19, 'Onitsha', '002', 'Anambra', '043', 'South-East', '1000'),
(20, 'Nnewi', '003', 'Anambra', '043', 'South-East', '1200'),
(21, 'Asaba', '001', 'Delta', '044', 'South-South', '2000'),
(22, 'PortHarcot', '001', 'Rivers', '085', 'South-South', '2000'),
(23, 'Eleme', '002', 'Rivers', '085', 'South-South', '2200');

-- --------------------------------------------------------

--
-- Table structure for table `site_admin`
--

CREATE TABLE `site_admin` (
  `sn` int(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `access_level` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_admin`
--

INSERT INTO `site_admin` (`sn`, `name`, `password`, `access_level`) VALUES
(1, 'ensy2006@yahoo.com', 'goodluck', '1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sn` int(20) NOT NULL,
  `name` text NOT NULL,
  `dob` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `passport` text NOT NULL,
  `parentName` text NOT NULL,
  `parentAddress` text NOT NULL,
  `parentPhone` varchar(15) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `session_1` int(1) NOT NULL DEFAULT '0',
  `session_2` int(1) NOT NULL DEFAULT '0',
  `session_3` int(1) NOT NULL DEFAULT '0',
  `session_4` int(1) NOT NULL DEFAULT '0',
  `session_5` int(1) NOT NULL DEFAULT '0',
  `session_6` int(1) DEFAULT '0',
  `studID` varchar(20) NOT NULL,
  `subClass` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sn`, `name`, `dob`, `gender`, `address`, `passport`, `parentName`, `parentAddress`, `parentPhone`, `class_id`, `schlid`, `session_1`, `session_2`, `session_3`, `session_4`, `session_5`, `session_6`, `studID`, `subClass`) VALUES
(1, 'Eke Chibueze', '13-04-2004', 'Male', 'line C Egbeada housing estate, owerri imo state', '', 'T. C. Eke', 'line C Egbeada housing estate, owerri imo state', '08036765446', '2015', '1', 1, 1, 0, 0, 0, 0, '2345', 'A'),
(4, 'Amadi Chidi', '13-09-2003', 'Male', 'line G Egbeada housing estate, owerri imo state', '', 'Amadi Osita', 'line G Egbeada housing estate, owerri imo state', '08036766546', '2014', '1', 1, 1, 1, 0, 0, 0, '12014344', 'A'),
(5, 'Mkpadi Chinedu', '13-09-2002', 'Male', 'line F Egbeada housing estate, owerri imo state', 'passport/1347.jpg', 'Amadi Mkpadi', 'line F Egbeada housing estate, owerri imo state', '08036766543', '2014', '1', 1, 1, 1, 0, 0, 0, '12014347', 'A'),
(7, 'Adinmadu Chinyere', '13-04-2004', 'Female', 'line T Egbeada housing estate, owerri imo state', 'passport/1343.jpg', 'T. C. Adinmadu', 'line T Egbeada housing estate, owerri imo state', '08036765446', '2015', '1', 1, 1, 0, 0, 0, 0, '1343', 'A'),
(12, 'Nwaoha Obinna', '10-03-1992', 'Male', 'No 10 old nekede road owerri Imo state', 'passport/12014348.jpg', 'Nwaoha C. E.', 'No 10 old nekede road owerri Imo state', '08076556965', '2014', '1', 1, 1, 1, 0, 0, 0, '12014348', 'A'),
(13, 'Akwarandu John', '10-03-1992', 'Male', 'Amakaohia owerri Imo state', 'passport/12015346.jpg', 'Akwarandu J E.', 'Amakaohia owerri Imo state', '08076556965', '2015', '1', 1, 1, 0, 0, 0, 0, '12015346', 'A'),
(14, 'Eustuce Chibugo', '21-01-2000', 'Male', 'Amadi str. amakaohia', 'passport/12015347.jpg', 'Njoku E. C.', 'Amadi str. amakaohia', '08034567230', '2015', '1', 1, 1, 0, 0, 0, 0, '12015347', 'A'),
(15, 'Nwaoha ulumma', '10-03-1992', 'Female', 'No 10 bus stop owerri', 'passport/12016001.jpg', 'Nwaoha C. E.', 'No 10 bus stop owerri', '08076556965', '2016', '1', 1, 0, 0, 0, 0, 0, '12016001', 'A'),
(18, 'Eze Okeke', '10-03-1982', 'Male', '131 Douglas road owerri  Imo state.', 'passport/12016002.jpg', 'Okeke U. C.', '131 Douglas road owerri  Imo state.', '08076556963', '2016', '1', 1, 0, 0, 0, 0, 0, '12016002', 'A'),
(19, 'Amara Amadi', '10-03-1996', 'Female', '12 owerri road owerri Imo state.', 'passport/12015348.jpg', 'Amadi C. E.', '12 owerri road owerri Imo state.', '08076556943', '2015', '1', 1, 1, 0, 0, 0, 0, '12015348', 'A'),
(20, 'chinyere Amadi', '10-03-1996', 'Female', '12 owerri road owerri Imo state.', 'passport/12015349.jpg', 'Amadi C. E.', '12 owerri road owerri Imo state.', '08076556943', '2015', '1', 1, 1, 0, 0, 0, 0, '12015349', 'A'),
(21, 'chinnye Amadi', '10-03-1996', 'Female', '12 owerri road owerri Imo state.', 'passport/12015350.jpg', 'Amadi C. E.', '12 owerri road owerri Imo state.', '08076556943', '2015', '1', 1, 1, 0, 0, 0, 0, '12015350', 'A'),
(22, 'chinnye Agu', '10-03-1996', 'Female', '13 owerri road owerri Imo state.', 'passport/12015351.jpg', 'Amadi C. E.', '13 owerri road owerri Imo state.', '08076556943', '2015', '1', 1, 1, 0, 0, 0, 0, '12015351', 'A'),
(23, 'Amanze Chikaodili', '10-03-1982', 'Female', '23 fox road  aba abia state', 'passport/12015352.jpg', 'Amanze E. C.', '23 fox road  aba abia state', '08076556908', '2015', '1', 1, 1, 0, 0, 0, 0, '12015352', 'A'),
(24, 'Chiemezie Aguocha', '13-12-1995', 'Male', '23 vain road owerri imo state', 'passport/12016003.jpg', 'Aguocha C E', '23 vain road owerri imo state', '08076766965', '2016', '1', 1, 0, 0, 0, 0, 0, '12016003', 'A'),
(25, 'Eronini Ngozi', '11-01-1996', 'Female', '7 Ajali street emene Enugu', 'passport/12016004.jpg', 'Eronini S. A.', '7 Ajali street emene Enugu', '08076711965', '2016', '1', 1, 0, 0, 0, 0, 0, '12016004', 'A'),
(26, 'Emmanuel Aneke', '10-03-1996', 'Male', '59 okigwe road owerri', 'passport/12017001.jpg', 'Aneke J. C.', '59 okigwe road owerri', '08076556965', '2017', '1', 1, 0, 0, 0, 0, 0, '12017001', 'A'),
(27, 'Eustuce Amadi', '21-06-2000', 'Male', '2 oparaugo str. owerri', 'passport/12017002.jpg', 'Amadi E. C.', '2 oparaugo str. owerri', '08034523067', '2017', '1', 1, 0, 0, 0, 0, 0, '12017002', 'A'),
(28, 'Ernest Bright', '10-03-1998', 'Male', '92 owerri road onitsha anambra state', 'passport/12017003.jpg', 'Nwaoha C. E.', '92 owerri road onitsha anambra state', '08076711965', '2017', '1', 1, 0, 0, 0, 0, 0, '12017003', 'A'),
(29, 'padi obinna', '10-03-1998', 'Male', '23 loxlo str. washington', 'passport/12017004.jpg', 'obinna p.a.', '23 loxlo str. washington', '08076556933', '2017', '1', 1, 0, 0, 0, 0, 0, '12017004', 'A'),
(30, 'alfred White', '13-12-1995', 'Male', '32 tennary road westburg', 'passport/12017005.jpg', 'joel J. C.', '32 tennary road westburg', '08076556943', '2017', '1', 1, 0, 0, 0, 0, 0, '12017005', 'A'),
(31, 'Amanze Chikwe', '11-01-1996', 'Female', '2 njamanze str. owerri', 'passport/12017006.jpg', 'Amanze E. C.', '2 njamanze str. owerri', '08076556908', '2017', '1', 1, 0, 0, 0, 0, 0, '12017006', 'B'),
(32, 'lai Ladi', '10-03-1998', 'Female', '3 okpara road okigwe imo state', 'passport/12017007.jpg', 'lai M. K', '3 okpara road okigwe imo state', '08076766965', '2017', '1', 1, 0, 0, 0, 0, 0, '12017007', 'B'),
(33, 'Amodu Tim', '10-03-1998', 'Male', '43 lai road wuse zone II', 'passport/12017008.jpg', 'Amodu N.', '43 lai road wuse zone II', '08076556965', '2017', '1', 1, 0, 0, 0, 0, 0, '12017008', 'B'),
(34, 'Agbaranze chiamaka', '10-03-1996', 'Female', '43 wetheral road owerri Imo state.', 'passport/12016005.jpg', 'Agbaranze J.c.', '43 wetheral road owerri Imo state.', '08076766965', '2016', '1', 1, 0, 0, 0, 0, 0, '12016005', 'B'),
(35, 'Godson Excelsimo', '21-06-2000', 'Male', '6 uratta str owerri Imo state', 'passport/12016006.jpg', 'Amadi E. C.', '6 uratta str owerri Imo state', '08034567230', '2016', '1', 1, 0, 0, 0, 0, 0, '12016006', 'B'),
(36, 'Amarachi Ndife', '10-08-1998', 'Female', '12c Luxiburg S.A', 'passport/12017009.jpg', 'Ndife U. C.', '12c Luxiburg S.A', '08034539522', '2017', '1', 1, 0, 0, 0, 0, 0, '12017009', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sn` int(20) NOT NULL,
  `subject_name` varchar(25) NOT NULL,
  `practical_oriented` varchar(5) NOT NULL,
  `selective` varchar(5) NOT NULL,
  `group_id` varchar(10) NOT NULL,
  `schlid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sn`, `subject_name`, `practical_oriented`, `selective`, `group_id`, `schlid`) VALUES
(1, 'English', 'no', 'no', 'default', 'default'),
(2, 'Mathematics', 'no', 'no', 'default', 'default'),
(3, 'Igbo', 'no', 'yes', 'default', 'default'),
(4, 'Physics', 'yes', 'yes', 'default', 'default'),
(5, 'Chemistry', 'yes', 'yes', 'default', 'default'),
(6, 'Biology', 'yes', 'yes', 'default', 'default'),
(7, 'Agricultural Science', 'yes', 'yes', 'default', 'default'),
(8, 'Geography', 'yes', 'yes', 'default', 'default'),
(9, 'Economics', 'no', 'yes', 'default', 'default'),
(10, 'Commerce', 'no', 'yes', 'default', 'default'),
(15, 'Chemistry', 'yes', 'yes', '011', '1'),
(17, 'Further Maths', 'no', 'yes', '011', '1'),
(20, 'English', 'no', 'no', '012', '1'),
(21, 'Introduction to Book keep', 'yes', 'yes', '012', '1'),
(24, 'English', 'no', 'no', '011', '1'),
(37, 'Physics', 'yes', 'yes', '011', '1'),
(38, 'English', 'no', 'no', '013', '1'),
(39, 'Mathematics', 'no', 'no', '013', '1'),
(40, 'integrated science', 'yes', 'no', '013', '1'),
(41, 'Social studies', 'no', 'no', '013', '1'),
(42, 'Physical Education', 'no', 'no', '013', '1'),
(43, 'Business studies', 'no', 'no', '013', '1'),
(44, 'Introductory technology', 'yes', 'no', '013', '1'),
(45, 'Home economics', 'yes', 'no', '013', '1'),
(46, 'Fine Art', 'yes', 'no', '013', '1'),
(48, 'Government', 'no', 'no', '014', '1'),
(49, 'Commerce', 'no', 'no', '014', '1'),
(50, 'Accounts', 'no', 'no', '014', '1'),
(51, 'English', 'no', 'no', '014', '1');

-- --------------------------------------------------------

--
-- Table structure for table `subject_groups`
--

CREATE TABLE `subject_groups` (
  `sn` int(11) NOT NULL,
  `subject_group_name` varchar(50) NOT NULL,
  `subject_group_id` varchar(20) NOT NULL,
  `schlid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_groups`
--

INSERT INTO `subject_groups` (`sn`, `subject_group_name`, `subject_group_id`, `schlid`) VALUES
(1, 'special sciences', '011', '1'),
(2, 'commercial art', '012', '1'),
(4, 'Jss 1 subjects', '013', '1'),
(7, 'JSS 2', '014', '1'),
(8, 'JSS 3', '015', '1'),
(9, 'SS 1', '016', '1'),
(12, 'SS 2', '017', '1'),
(14, 'SS 3', '019', '1'),
(21, 'Test 2', '021', '1'),
(3, 'Default', 'default', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `subject_group_allocation`
--

CREATE TABLE `subject_group_allocation` (
  `sn` int(255) NOT NULL,
  `session` varchar(10) NOT NULL,
  `term` varchar(20) NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `subject_group_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_group_allocation`
--

INSERT INTO `subject_group_allocation` (`sn`, `session`, `term`, `schlid`, `subject_group_id`) VALUES
(104, 'JSS 1', 'First', '1', '013'),
(105, 'JSS 1', 'Second', '1', '013'),
(106, 'JSS 1', 'Third', '1', '013'),
(107, 'JSS 2', 'First', '1', '014'),
(108, 'JSS 2', 'Second', '1', '014'),
(109, 'JSS 2', 'Third', '1', '014'),
(110, 'JSS 3', 'First', '1', '015'),
(111, 'JSS 3', 'Second', '1', '015'),
(112, 'JSS 3', 'Third', '1', '015'),
(113, 'SS 1', 'First', '1', '016'),
(114, 'SS 1', 'Second', '1', '016'),
(115, 'SS 1', 'Third', '1', '016'),
(116, 'SS 2', 'First', '1', '017'),
(117, 'SS 2', 'Second', '1', '017'),
(118, 'SS 2', 'Third', '1', '017'),
(119, 'SS 3', 'First', '1', '019'),
(120, 'SS 3', 'Second', '1', '019'),
(121, 'SS 3', 'Third', '1', '019');

-- --------------------------------------------------------

--
-- Table structure for table `testdb`
--

CREATE TABLE `testdb` (
  `sn` int(20) NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `test_title_id` varchar(20) NOT NULL,
  `type_of_question` varchar(50) NOT NULL,
  `question` text NOT NULL,
  `options` text NOT NULL,
  `answer` varchar(10) NOT NULL,
  `image_Question` text NOT NULL,
  `image_option` text NOT NULL,
  `explanation` text NOT NULL,
  `Qid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testdb`
--

INSERT INTO `testdb` (`sn`, `schlid`, `test_title_id`, `type_of_question`, `question`, `options`, `answer`, `image_Question`, `image_option`, `explanation`, `Qid`) VALUES
(1, '1', '10', 'Non-illustration based question', 'Which hold the largest quantity of water?', 'A.well;B.Bottle;C.Bucket;D.Amber Bottle', 'A', '', '', 'brings water while the rest can only hold water, while amber bottle store mercury.', '1-10-1'),
(20, '1', '10', 'Illustration based question', 'which of this diagram best represent fit in to this', '', 'E', 'cbt/question/1-10-20.jpg', 'cbt/question/1-10-20-0.jpg:cbt/question/1-10-20-1.jpg:cbt/question/1-10-20-2.jpg:cbt/question/1-10-20-3.jpg:cbt/question/1-10-20-4.png', 'Diagram E best fit into the diagram', '1-10-20'),
(21, '1', '10', 'Illustration based question', 'The closest match to this, is?', '', 'D;E', 'cbt/question/1-10-21.jpg', 'cbt/question/1-10-21-0.jpg:cbt/question/1-10-21-1.jpg:cbt/question/1-10-21-2.jpg:cbt/question/1-10-21-3.jpg:cbt/question/1-10-21-4.jpg', 'turning the question in an anti-clockwise direction give image D', '1-10-21'),
(22, '1', '10', 'Non-illustration based question', 'A+C=12,A+3=15, determine the value of C', 'A.-1;B.0;C.12;D.18', 'B', '', '', 'using subject of the formular determine the value of 8, which when substituted in the first equation,will give u 0, which is found on B.', '1-10-22'),
(25, '1', '10', 'Illustration based question', 'Which of the following represents a complete water cycle?', '', 'C', 'cbt/question/1-10-25.jpg', 'cbt/question/1-10-25-0.png:cbt/question/1-10-25-1.jpg:cbt/question/1-10-25-2.jpg:cbt/question/1-10-25-3.jpg:cbt/question/1-10-25-4.jpg', 'A contains all the things in the environment that uses water, and how water transforms from one point to another.', '1-10-25'),
(30, '1', '10', 'Illustration based question', 'identify the fault in the formula below?', '', 'C', 'cbt/question/1-10-30.JPG', 'cbt/question/1-10-30-0.jpg:cbt/question/1-10-30-1.jpg:cbt/question/1-10-30-2.jpg:cbt/question/1-10-30-3.jpg:cbt/question/1-10-30-4.jpg', 'the denominator c is absent in the orignal almighty formula, so c is the correct answer', '1-10-30'),
(31, '1', '10', 'Non-illustration based question', 'The picture below represents various height in a map, which indicates the highest point?', 'A. Point A;B. Point D;C.Point C;D.Point B', 'B', 'cbt/question/1-10-31.jpg', '', 'According to the map legend, point D is the highest', '1-10-31'),
(33, '1', '106', 'Non-illustration based question', 'which of this represents an equation?', 'A. X+Y;B. XY+1;C. XY-1=Y;D.Y-2=X', 'C;D', '', '', 'the rest are maths expression except C and D', '1-106-33'),
(34, '1', '012', 'Non-illustration based question', 'How many vowel sound are there in english language?', 'A. 4;B.6;C.12;D.24', 'C', '', '', 'the, vowel  sounds are a,e,o,u', '1-012-34'),
(35, '1', '012', 'Non-illustration based question', 'How many consonant sound are there in english language?', 'A.24;B.6;C.12;D.4', 'A', '', '', 'Removing the twelve vowel sounds in English alphabet, the rest are consonant sound.', '1-012-35');

-- --------------------------------------------------------

--
-- Table structure for table `testproperty`
--

CREATE TABLE `testproperty` (
  `sn` int(20) NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `test_title` text NOT NULL,
  `test_title_id` varchar(20) NOT NULL,
  `no_of_question_per_test` varchar(3) NOT NULL,
  `test_duration` varchar(4) NOT NULL,
  `publish_status` varchar(10) NOT NULL,
  `designated_class` varchar(20) NOT NULL,
  `instruction` text NOT NULL,
  `practice_test` varchar(20) NOT NULL,
  `premum_status` varchar(20) NOT NULL,
  `testPercent` varchar(5) NOT NULL,
  `testReshuf` varchar(5) NOT NULL,
  `rdate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testproperty`
--

INSERT INTO `testproperty` (`sn`, `schlid`, `test_title`, `test_title_id`, `no_of_question_per_test`, `test_duration`, `publish_status`, `designated_class`, `instruction`, `practice_test`, `premum_status`, `testPercent`, `testReshuf`, `rdate`) VALUES
(1, '1', 'English test', '10', '20', '10', 'on', '2016', 'read carefully and answer  the question that follows                                                                                                                                                                                                                                                                                                                                                                                                ', 'Live test', '4321', '80', 'on', '19/04/2017'),
(5, '1', 'English test for JS3', '102', '20', '10', '', '2014', 'Read and answer the question correctly                        ', 'Live test', '4321', '100', 'on', '05/02/2017'),
(12, '1', 'Inter. sci. for js1', '106', '10', '10', 'on', 'Prospects', 'testing                        ', 'Live test', '4321', '100', 'on', '16/03/2017'),
(13, '1', 'Entrance Examination', '012', '10', '10', 'on', '2016', 'Answer the questions that follows                                                                                                                        ', 'Live test', '', '100', 'on', '18/03/2017');

-- --------------------------------------------------------

--
-- Table structure for table `teststudent`
--

CREATE TABLE `teststudent` (
  `sn` int(20) NOT NULL,
  `schlid` varchar(20) NOT NULL,
  `stud_id` varchar(20) NOT NULL,
  `tdate` varchar(10) NOT NULL,
  `testid` varchar(10) NOT NULL,
  `test_score` int(3) NOT NULL,
  `no_of_trial` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teststudent`
--

INSERT INTO `teststudent` (`sn`, `schlid`, `stud_id`, `tdate`, `testid`, `test_score`, `no_of_trial`) VALUES
(1, '1', '2017001', '18/03/2017', '106', 100, '1'),
(3, '1', '12016002', '20/04/2017', '10', 50, '1'),
(4, '1', '12016002', '20/04/2017', '012', 100, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesspin_cost`
--
ALTER TABLE `accesspin_cost`
  ADD PRIMARY KEY (`sn`),
  ADD KEY `sn` (`sn`),
  ADD KEY `sn_2` (`sn`);

--
-- Indexes for table `access_pin`
--
ALTER TABLE `access_pin`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `advert_cost`
--
ALTER TABLE `advert_cost`
  ADD PRIMARY KEY (`sn`),
  ADD KEY `sn` (`sn`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `ordered_access_pin`
--
ALTER TABLE `ordered_access_pin`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `ordered_premuim_cbt`
--
ALTER TABLE `ordered_premuim_cbt`
  ADD PRIMARY KEY (`SN`);

--
-- Indexes for table `premuim_cbt_access_code`
--
ALTER TABLE `premuim_cbt_access_code`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `access_code` (`access_code`);

--
-- Indexes for table `prospectlist`
--
ALTER TABLE `prospectlist`
  ADD KEY `SN` (`SN`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `school_admin`
--
ALTER TABLE `school_admin`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `shippment_cost`
--
ALTER TABLE `shippment_cost`
  ADD UNIQUE KEY `sn_2` (`sn`),
  ADD KEY `sn` (`sn`);

--
-- Indexes for table `site_admin`
--
ALTER TABLE `site_admin`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `subject_groups`
--
ALTER TABLE `subject_groups`
  ADD PRIMARY KEY (`subject_group_id`,`schlid`),
  ADD KEY `sn` (`sn`);

--
-- Indexes for table `subject_group_allocation`
--
ALTER TABLE `subject_group_allocation`
  ADD PRIMARY KEY (`session`,`term`,`schlid`),
  ADD KEY `sn` (`sn`);

--
-- Indexes for table `testdb`
--
ALTER TABLE `testdb`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `testproperty`
--
ALTER TABLE `testproperty`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `teststudent`
--
ALTER TABLE `teststudent`
  ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesspin_cost`
--
ALTER TABLE `accesspin_cost`
  MODIFY `sn` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `access_pin`
--
ALTER TABLE `access_pin`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=514;
--
-- AUTO_INCREMENT for table `advert`
--
ALTER TABLE `advert`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `advert_cost`
--
ALTER TABLE `advert_cost`
  MODIFY `sn` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ordered_access_pin`
--
ALTER TABLE `ordered_access_pin`
  MODIFY `SN` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ordered_premuim_cbt`
--
ALTER TABLE `ordered_premuim_cbt`
  MODIFY `SN` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `premuim_cbt_access_code`
--
ALTER TABLE `premuim_cbt_access_code`
  MODIFY `sn` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `prospectlist`
--
ALTER TABLE `prospectlist`
  MODIFY `SN` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `school_admin`
--
ALTER TABLE `school_admin`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `shippment_cost`
--
ALTER TABLE `shippment_cost`
  MODIFY `sn` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `site_admin`
--
ALTER TABLE `site_admin`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `subject_groups`
--
ALTER TABLE `subject_groups`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `subject_group_allocation`
--
ALTER TABLE `subject_group_allocation`
  MODIFY `sn` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `testdb`
--
ALTER TABLE `testdb`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `testproperty`
--
ALTER TABLE `testproperty`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `teststudent`
--
ALTER TABLE `teststudent`
  MODIFY `sn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
