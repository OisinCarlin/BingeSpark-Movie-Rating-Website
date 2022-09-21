-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 08, 2022 at 03:08 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocarlin04`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie_director`
--

CREATE TABLE `movie_director` (
  `movie_director_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `director_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie_director`
--

INSERT INTO `movie_director` (`movie_director_id`, `movie_id`, `director_id`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 4, 4),
(4, 5, 5),
(5, 6, 6),
(6, 7, 7),
(7, 8, 8),
(8, 11, 9),
(9, 12, 10),
(10, 14, 11),
(11, 15, 12),
(12, 16, 13),
(13, 17, 14),
(14, 18, 15),
(15, 19, 16),
(16, 22, 17),
(17, 24, 18),
(18, 25, 19),
(19, 26, 20),
(20, 27, 21),
(21, 28, 22),
(22, 29, 23),
(23, 30, 24),
(24, 31, 25),
(25, 32, 26),
(26, 33, 27),
(27, 34, 28),
(28, 37, 29),
(29, 38, 30),
(30, 40, 31),
(31, 41, 32),
(32, 42, 33),
(33, 43, 34),
(34, 44, 35),
(35, 45, 36),
(36, 46, 37),
(37, 47, 38),
(38, 49, 39),
(39, 51, 40),
(40, 52, 41),
(41, 53, 42),
(42, 54, 43),
(43, 55, 44),
(44, 56, 45),
(45, 57, 44),
(46, 58, 46),
(47, 59, 47),
(48, 60, 48),
(49, 61, 49),
(50, 62, 50),
(51, 63, 51),
(52, 64, 52),
(53, 65, 53),
(54, 66, 53),
(55, 67, 46),
(56, 68, 54),
(57, 69, 55),
(58, 70, 56),
(59, 71, 57),
(60, 72, 58),
(61, 73, 48),
(62, 74, 59),
(63, 75, 59),
(64, 76, 60),
(65, 77, 33),
(66, 78, 61),
(67, 82, 62),
(68, 83, 63),
(69, 84, 63),
(70, 85, 63),
(71, 86, 63),
(72, 87, 64),
(73, 88, 65),
(74, 89, 60),
(75, 90, 60),
(76, 91, 4),
(77, 92, 49),
(78, 95, 59),
(79, 96, 36),
(80, 97, 66),
(81, 98, 67),
(82, 99, 68),
(83, 100, 35),
(84, 101, 69),
(85, 102, 70),
(86, 103, 71),
(87, 104, 72),
(88, 105, 73),
(89, 106, 74),
(90, 107, 75),
(91, 108, 43),
(92, 109, 8),
(93, 110, 76),
(94, 111, 77),
(95, 112, 77),
(96, 113, 78),
(97, 114, 79),
(98, 115, 80),
(99, 116, 37),
(100, 117, 81),
(101, 119, 82),
(102, 120, 83),
(103, 121, 84),
(104, 122, 81),
(105, 123, 85),
(106, 124, 86),
(107, 125, 85),
(108, 126, 87),
(109, 128, 83),
(110, 129, 4),
(111, 130, 88),
(112, 131, 89),
(113, 132, 90),
(114, 133, 91),
(115, 134, 92),
(116, 135, 43),
(117, 136, 93),
(118, 137, 94),
(119, 138, 68),
(120, 139, 95),
(121, 140, 96),
(122, 141, 52),
(123, 142, 11),
(124, 143, 97),
(125, 144, 98),
(126, 145, 99),
(127, 146, 100),
(128, 147, 101),
(129, 149, 102),
(130, 150, 103),
(131, 151, 104),
(132, 152, 7),
(133, 153, 105),
(134, 154, 68),
(135, 155, 106),
(136, 156, 107),
(137, 157, 108),
(138, 159, 109),
(139, 160, 110),
(140, 161, 28),
(141, 162, 15),
(142, 163, 90),
(143, 164, 111),
(144, 165, 112),
(145, 166, 113),
(146, 167, 96),
(147, 169, 114),
(148, 170, 32),
(149, 172, 30),
(150, 173, 115),
(151, 174, 116),
(152, 175, 117),
(153, 176, 28),
(154, 177, 28),
(155, 178, 118),
(156, 179, 13),
(157, 180, 119),
(158, 181, 120),
(159, 182, 121),
(160, 183, 122),
(161, 184, 123),
(162, 185, 51),
(163, 186, 124),
(164, 187, 125),
(165, 188, 40),
(166, 189, 126),
(167, 190, 90),
(168, 191, 127),
(169, 192, 128),
(170, 193, 123),
(171, 194, 129),
(172, 195, 130),
(173, 197, 42),
(174, 198, 67),
(175, 199, 124),
(176, 200, 131),
(177, 202, 132),
(178, 203, 133),
(179, 204, 134),
(180, 205, 52),
(181, 206, 126),
(182, 208, 135),
(183, 209, 136),
(184, 210, 137),
(185, 211, 138),
(186, 212, 139),
(187, 214, 140),
(188, 215, 88),
(189, 216, 141),
(190, 217, 92),
(191, 218, 142),
(192, 219, 143),
(193, 220, 144),
(194, 221, 145),
(195, 223, 53),
(196, 225, 146),
(197, 228, 147),
(198, 229, 145),
(199, 230, 148),
(200, 231, 149),
(201, 232, 150),
(202, 233, 52),
(203, 234, 15),
(204, 235, 151),
(205, 236, 152),
(206, 237, 153),
(207, 238, 154),
(208, 239, 155),
(209, 240, 156),
(210, 241, 157),
(211, 242, 158),
(212, 243, 18),
(213, 246, 18),
(214, 247, 69),
(215, 248, 114),
(216, 250, 159),
(217, 252, 4),
(218, 253, 27),
(219, 254, 160),
(220, 259, 161),
(221, 260, 162),
(222, 261, 163),
(223, 262, 15),
(224, 263, 37),
(225, 264, 164),
(226, 266, 165),
(227, 268, 166),
(228, 269, 167),
(229, 270, 168),
(230, 271, 77),
(231, 272, 169),
(232, 273, 170),
(233, 274, 171),
(234, 275, 172),
(235, 276, 173),
(236, 277, 174),
(237, 278, 175),
(238, 279, 176),
(239, 280, 177),
(240, 281, 178),
(241, 282, 179),
(242, 283, 180),
(243, 284, 176),
(244, 285, 181),
(245, 286, 182),
(246, 288, 183),
(247, 289, 172),
(248, 290, 184),
(249, 291, 56),
(250, 292, 21),
(251, 293, 185),
(252, 294, 145),
(253, 295, 186),
(254, 296, 187),
(255, 297, 188),
(256, 298, 83),
(257, 299, 15),
(258, 300, 189),
(259, 301, 190),
(260, 302, 191),
(261, 303, 91),
(262, 304, 192),
(263, 305, 193),
(264, 306, 194),
(265, 307, 195),
(266, 308, 196),
(267, 309, 10),
(268, 310, 197),
(269, 311, 27),
(270, 312, 198),
(271, 313, 199),
(272, 314, 200),
(273, 315, 72),
(274, 316, 201),
(275, 317, 202),
(276, 318, 203),
(277, 319, 204),
(278, 320, 188),
(279, 321, 205),
(280, 322, 124),
(281, 323, 206),
(282, 324, 137),
(283, 325, 207),
(284, 327, 208),
(285, 329, 209),
(286, 330, 210),
(287, 331, 211),
(288, 333, 212),
(289, 334, 128),
(290, 336, 213),
(291, 337, 211),
(292, 338, 214),
(293, 339, 215),
(294, 340, 216),
(295, 342, 217),
(296, 343, 218),
(297, 344, 219),
(298, 345, 220),
(299, 346, 70),
(300, 347, 15),
(301, 348, 221),
(302, 349, 210),
(303, 350, 222),
(304, 351, 223),
(305, 352, 224),
(306, 354, 225),
(307, 357, 76),
(308, 358, 2),
(309, 359, 226),
(310, 360, 227),
(311, 361, 228),
(312, 363, 229),
(313, 364, 230),
(314, 365, 53),
(315, 366, 137),
(316, 368, 231),
(317, 369, 232),
(318, 370, 233),
(319, 371, 234),
(320, 372, 235),
(321, 373, 236),
(322, 374, 237),
(323, 375, 238),
(324, 377, 159),
(325, 378, 239),
(326, 379, 157),
(327, 380, 240),
(328, 381, 241),
(329, 382, 242),
(330, 383, 243),
(331, 384, 50),
(332, 385, 244),
(333, 387, 245),
(334, 388, 246),
(335, 389, 247),
(336, 390, 155),
(337, 392, 242),
(338, 393, 248),
(339, 394, 81),
(340, 395, 223),
(341, 396, 249),
(342, 397, 250),
(343, 398, 228),
(344, 399, 247),
(345, 400, 251),
(346, 402, 252),
(347, 403, 253),
(348, 404, 228),
(349, 405, 241),
(350, 406, 254),
(351, 407, 255),
(352, 408, 256),
(353, 409, 257),
(354, 410, 250),
(355, 411, 224),
(356, 412, 258),
(357, 413, 246),
(358, 414, 83),
(359, 415, 142),
(360, 416, 259),
(361, 417, 260),
(362, 418, 261),
(363, 420, 106),
(364, 421, 243),
(365, 423, 262),
(366, 424, 263),
(367, 425, 209),
(368, 426, 264),
(369, 427, 265),
(370, 428, 226),
(371, 429, 266),
(372, 430, 267),
(373, 431, 268),
(374, 432, 269),
(375, 433, 270),
(376, 434, 196),
(377, 435, 209),
(378, 436, 110),
(379, 437, 271),
(380, 438, 95),
(381, 439, 272),
(382, 440, 273),
(383, 441, 274),
(384, 442, 209),
(385, 444, 275),
(386, 445, 276),
(387, 446, 30),
(388, 447, 277),
(389, 449, 199),
(390, 450, 278),
(391, 451, 279),
(392, 452, 155),
(393, 453, 280),
(394, 454, 15),
(395, 455, 145),
(396, 456, 111),
(397, 457, 281),
(398, 458, 196),
(399, 459, 282),
(400, 460, 283),
(401, 462, 284),
(402, 463, 71),
(403, 464, 156),
(404, 465, 285),
(405, 467, 286),
(406, 468, 287),
(407, 469, 23),
(408, 471, 32),
(409, 472, 288),
(410, 473, 57),
(411, 474, 289),
(412, 475, 290),
(413, 476, 244),
(414, 477, 209),
(415, 478, 291),
(416, 479, 292),
(417, 481, 293),
(418, 482, 27),
(419, 483, 43),
(420, 485, 294),
(421, 486, 295),
(422, 487, 157),
(423, 488, 296),
(424, 489, 13),
(425, 490, 297),
(426, 491, 298),
(427, 492, 271),
(428, 493, 299),
(429, 494, 125),
(430, 495, 300),
(431, 496, 301),
(432, 497, 302),
(433, 498, 219),
(434, 499, 201),
(435, 500, 114),
(436, 501, 163),
(437, 502, 303),
(438, 503, 95),
(439, 504, 304),
(440, 505, 305),
(441, 506, 306),
(442, 507, 307),
(443, 508, 52),
(444, 509, 51),
(445, 510, 308),
(446, 511, 309),
(447, 512, 310),
(448, 513, 311),
(449, 514, 312),
(450, 515, 313),
(451, 517, 314),
(452, 518, 281),
(453, 520, 315),
(454, 521, 316),
(455, 522, 190),
(456, 523, 317),
(457, 524, 66),
(458, 525, 318),
(459, 526, 319),
(460, 527, 320),
(461, 528, 281),
(462, 529, 321),
(463, 530, 322),
(464, 531, 323),
(465, 532, 323),
(466, 533, 324),
(467, 534, 262),
(468, 535, 16),
(469, 536, 325),
(470, 537, 67),
(471, 538, 68),
(472, 539, 65),
(473, 540, 233),
(474, 541, 165),
(475, 542, 326),
(476, 543, 327),
(477, 544, 328),
(478, 545, 329),
(479, 546, 330),
(480, 547, 331),
(481, 548, 154),
(482, 549, 153),
(483, 551, 332),
(484, 552, 72),
(485, 553, 76),
(486, 554, 333),
(487, 555, 334),
(488, 556, 335),
(489, 557, 336),
(490, 558, 337),
(491, 559, 338),
(492, 560, 195),
(493, 561, 164),
(494, 562, 339),
(495, 564, 340),
(496, 566, 97),
(497, 567, 341),
(498, 568, 342),
(499, 569, 343),
(500, 570, 125),
(501, 571, 344),
(502, 572, 343),
(503, 573, 345),
(504, 574, 25),
(505, 575, 346),
(506, 576, 347),
(507, 577, 119),
(508, 579, 348),
(509, 580, 349),
(510, 581, 288),
(511, 582, 350),
(512, 583, 351),
(513, 584, 244),
(514, 585, 71),
(515, 586, 24),
(516, 587, 352),
(517, 588, 353),
(518, 590, 354),
(519, 591, 306),
(520, 592, 355),
(521, 593, 163),
(522, 594, 59),
(523, 595, 95),
(524, 596, 145),
(525, 597, 8),
(526, 598, 356),
(527, 599, 357),
(528, 600, 73),
(529, 601, 358),
(530, 603, 154),
(531, 604, 359),
(532, 605, 348),
(533, 606, 360),
(534, 607, 361),
(535, 608, 362),
(536, 609, 363),
(537, 610, 364),
(538, 611, 365),
(539, 612, 366),
(540, 613, 367),
(541, 614, 368),
(542, 615, 369),
(543, 616, 370),
(544, 617, 120),
(545, 618, 131),
(546, 619, 371),
(547, 620, 372),
(548, 621, 373),
(549, 622, 374),
(550, 623, 375),
(551, 624, 376),
(552, 625, 362),
(553, 626, 72),
(554, 627, 377),
(555, 629, 105),
(556, 630, 378),
(557, 632, 379),
(558, 634, 212),
(559, 635, 380),
(560, 637, 381),
(561, 638, 382),
(562, 639, 383),
(563, 640, 112),
(564, 641, 384),
(565, 642, 362),
(566, 643, 68),
(567, 644, 135),
(568, 645, 385),
(569, 646, 8),
(570, 647, 386),
(571, 648, 387),
(572, 649, 291),
(573, 650, 113),
(574, 651, 99),
(575, 652, 28),
(576, 653, 388),
(577, 654, 39),
(578, 655, 389),
(579, 656, 390),
(580, 657, 391),
(581, 658, 392),
(582, 659, 89),
(583, 660, 329),
(584, 661, 34),
(585, 662, 90),
(586, 663, 49),
(587, 664, 393),
(588, 665, 59),
(589, 666, 41),
(590, 668, 394),
(591, 668, 395),
(592, 669, 396),
(593, 670, 39),
(594, 671, 106),
(595, 673, 125),
(596, 674, 397),
(597, 675, 27),
(598, 676, 398),
(599, 677, 383),
(600, 678, 399),
(601, 679, 400),
(602, 680, 401),
(603, 680, 402),
(604, 682, 403),
(605, 683, 404),
(606, 684, 27),
(607, 685, 405),
(608, 686, 406),
(609, 687, 53),
(610, 690, 407),
(611, 691, 408),
(612, 692, 409),
(613, 695, 410),
(614, 695, 411),
(615, 696, 155),
(616, 696, 412),
(617, 697, 413),
(618, 698, 414),
(619, 699, 212),
(620, 700, 295),
(621, 701, 230),
(622, 702, 415),
(623, 703, 416),
(624, 704, 417),
(625, 705, 76),
(626, 706, 418),
(627, 707, 419),
(628, 708, 420),
(629, 709, 421),
(630, 710, 422),
(631, 712, 423),
(632, 713, 424),
(633, 714, 425),
(634, 715, 426),
(635, 717, 225),
(636, 718, 87),
(637, 719, 87),
(638, 720, 53),
(639, 721, 427),
(640, 722, 428),
(641, 725, 407),
(642, 726, 332),
(643, 727, 429),
(644, 728, 430),
(645, 729, 253),
(646, 730, 431),
(647, 731, 432),
(648, 732, 2),
(649, 733, 433),
(650, 734, 434),
(651, 734, 435),
(652, 735, 436),
(653, 735, 437),
(654, 736, 438),
(655, 737, 193),
(656, 738, 164),
(657, 739, 439),
(658, 740, 328),
(659, 741, 145),
(660, 742, 440),
(661, 744, 441),
(662, 745, 27),
(663, 746, 442),
(664, 747, 443),
(665, 748, 444),
(666, 749, 190),
(667, 750, 295),
(668, 751, 295),
(669, 752, 445),
(670, 754, 446),
(671, 755, 447),
(672, 756, 201),
(673, 757, 356),
(674, 758, 448),
(675, 759, 449),
(676, 760, 62),
(677, 761, 450),
(678, 762, 451),
(679, 763, 452),
(680, 764, 453),
(681, 765, 339),
(682, 766, 187),
(683, 768, 292),
(684, 769, 373),
(685, 770, 454),
(686, 771, 455),
(687, 772, 456),
(688, 773, 205),
(689, 774, 457),
(690, 775, 458),
(691, 776, 202),
(692, 777, 139),
(693, 778, 231),
(694, 779, 328),
(695, 780, 459),
(696, 781, 460),
(697, 782, 233),
(698, 783, 461),
(699, 784, 72),
(700, 785, 462),
(701, 786, 449),
(702, 787, 72),
(703, 788, 280),
(704, 789, 280),
(705, 790, 385),
(706, 791, 463),
(707, 792, 464),
(708, 793, 68),
(709, 794, 465),
(710, 795, 466),
(711, 796, 467),
(712, 797, 468),
(713, 798, 469),
(714, 799, 470),
(715, 800, 471),
(716, 801, 472),
(717, 802, 473),
(718, 804, 474),
(719, 805, 307),
(720, 805, 475),
(721, 806, 343),
(722, 807, 121),
(723, 808, 345),
(724, 809, 4),
(725, 810, 476),
(726, 811, 477),
(727, 812, 478),
(728, 815, 479),
(729, 816, 145),
(730, 817, 480),
(731, 817, 481),
(732, 818, 8),
(733, 819, 482),
(734, 820, 483),
(735, 822, 209);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie_director`
--
ALTER TABLE `movie_director`
  ADD PRIMARY KEY (`movie_director_id`),
  ADD KEY `FK_from_movie_director_director_director_id` (`director_id`),
  ADD KEY `FK_from_movie_director_movie_movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie_director`
--
ALTER TABLE `movie_director`
  MODIFY `movie_director_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=753;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_director`
--
ALTER TABLE `movie_director`
  ADD CONSTRAINT `FK_from_movie_director_director_director_id` FOREIGN KEY (`director_id`) REFERENCES `director` (`director_id`),
  ADD CONSTRAINT `FK_from_movie_director_movie_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;