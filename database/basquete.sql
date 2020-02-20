SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `basquete`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accountid` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `pass` varchar(40) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(5, 'U13'),
(94, 'U14'),
(2, 'U15'),
(4, 'U17'),
(1, 'U19');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `gameid` int(11) NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `home_score` int(11) DEFAULT '0',
  `away_score` int(11) DEFAULT '0',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`gameid`, `home_team_id`, `away_team_id`, `home_score`, `away_score`, `date`) VALUES
(5, 1, 2, 100, 101, '2019-01-31'),
(6, 1, 2, 101, 99, '2019-01-31'),
(7, 2, 1, 100, 101, '2019-12-31'),
(8, 1, 2, 101, 99, '2019-02-02'),
(9, 2, 1, 100, 99, '2018-01-01'),
(10, 1, 2, 100, 101, '2019-01-01'),
(11, 2, 1, 100, 98, '2019-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `playerid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `height` varchar(4) NOT NULL,
  `team_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `sex_id` int(11) NOT NULL,
  `image_name` varchar(25) DEFAULT NULL,
  `image_size` varchar(25) DEFAULT NULL,
  `image_type` varchar(25) DEFAULT NULL,
  `image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`playerid`, `name`, `height`, `team_id`, `number`, `position_id`, `category_id`, `year`, `sex_id`, `image_name`, `image_size`, `image_type`, `image`) VALUES
(1, 'Julia Pereira', '1,70', 2, 23, 2, 2, 2004, 2, NULL, NULL, NULL, NULL),
(2, 'Bruno Brasolin', '1,75', 2, 9, 1, 1, 2001, 1, NULL, NULL, NULL, NULL),
(3, 'Mongaguá 1', '', 1, 1, 1, 1, 2001, 1, NULL, NULL, NULL, NULL),
(4, 'Mongaguá 2', '', 1, 2, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),
(5, 'Mongaguá 3', '', 1, 3, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),
(6, 'Mongaguá 4', '', 1, 4, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),
(7, 'Mongaguá 5', '', 1, 5, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),
(8, 'Mongaguá 6', '', 1, 6, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),
(9, 'Mongaguá 7', '', 1, 7, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),
(10, 'Mongaguá 8', '', 1, 8, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),
(12, 'Mongaguá 10', '', 1, 10, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),
(13, 'Mongaguá 11', '', 1, 11, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),
(14, 'Mongaguá 12', '', 1, 12, 2, 1, 2001, 1, NULL, NULL, NULL, NULL),

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `position` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `position`) VALUES
(5, 'Center'),
(1, 'Point Guard'),
(4, 'Power Forward'),
(2, 'Shooting Guard'),
(3, 'Small Forward');

-- --------------------------------------------------------

--
-- Table structure for table `sex`
--

CREATE TABLE `sex` (
  `id` int(11) NOT NULL,
  `sex` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sex`
--

INSERT INTO `sex` (`id`, `sex`) VALUES
(2, 'Female'),
(1, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `statsid` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `team_against_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `2pm` int(11) NOT NULL DEFAULT '0',
  `2pa` int(11) NOT NULL DEFAULT '0',
  `3pm` int(11) NOT NULL DEFAULT '0',
  `3pa` int(11) NOT NULL DEFAULT '0',
  `ftm` int(11) NOT NULL DEFAULT '0',
  `fta` int(11) NOT NULL DEFAULT '0',
  `assists` int(11) NOT NULL DEFAULT '0',
  `drebounds` int(11) NOT NULL DEFAULT '0',
  `orebounds` int(11) NOT NULL DEFAULT '0',
  `steals` int(11) NOT NULL DEFAULT '0',
  `blocks` int(11) NOT NULL DEFAULT '0',
  `fouls` int(11) NOT NULL DEFAULT '0',
  `turnovers` int(11) NOT NULL DEFAULT '0',
  `min` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`statsid`, `player_id`, `team_against_id`, `game_id`, `2pm`, `2pa`, `3pm`, `3pa`, `ftm`, `fta`, `assists`, `drebounds`, `orebounds`, `steals`, `blocks`, `fouls`, `turnovers`, `min`) VALUES
(2, 3, 2, 7, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 3, 10, 40);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `team` varchar(64) NOT NULL,
  `coach` varchar(100) NOT NULL,
  `arena` varchar(100) NOT NULL,
  `wins` varchar(3) DEFAULT '0',
  `losses` varchar(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `team`, `coach`, `arena`, `wins`, `losses`) VALUES
(1, 'Mongaguá', 'Coach 1', 'Arena 1', '3', '5'),
(2, 'Praia Grande', 'Coach 2', 'Arena 2', '5', '4'),
(3, 'Ajax', 'JQuery', 'PC', '0', '0'),
(5, 'teste', 'teste', 'teste', '1', '0'),
(6, 'a', 'a', 'a', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountid`),
  ADD UNIQUE KEY `user` (`user`)

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gameid`),
  ADD KEY `home_team_id` (`home_team_id`),
  ADD KEY `away_team_id` (`away_team_id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`playerid`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `sex_id` (`sex_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `position` (`position`);

--
-- Indexes for table `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sex` (`sex`);

--
-- Indexes for table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`statsid`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `team_against_id` (`team_against_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team` (`team`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `accountid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `gameid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `playerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `stats`
--
ALTER TABLE `stats`
  MODIFY `statsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`home_team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`away_team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `player_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `player_ibfk_3` FOREIGN KEY (`sex_id`) REFERENCES `sex` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `player_ibfk_4` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stats`
--
ALTER TABLE `stats`
  ADD CONSTRAINT `stats_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `player` (`playerid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stats_ibfk_2` FOREIGN KEY (`team_against_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stats_ibfk_3` FOREIGN KEY (`game_id`) REFERENCES `game` (`gameid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
