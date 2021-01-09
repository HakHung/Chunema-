-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2021 at 10:47 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `movielist`
--

CREATE TABLE `movielist` (
  `movieid` int(11) NOT NULL,
  `moviename` varchar(30) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `director` varchar(30) NOT NULL,
  `producer` varchar(100) NOT NULL,
  `starring` varchar(300) NOT NULL,
  `genres` varchar(100) NOT NULL,
  `releasedate` date NOT NULL,
  `runningtime` varchar(10) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movielist`
--

INSERT INTO `movielist` (`movieid`, `moviename`, `description`, `director`, `producer`, `starring`, `genres`, `releasedate`, `runningtime`, `rating`, `keyword`, `url`, `path`) VALUES
(1, 'Wonder Woman', 'Wonder Woman is a 2017 American superhero film based on the DC Comics character of the same name, produced by DC Films in association with RatPac Entertainment and Chinese company Tencent Pictures, and distributed by Warner Bros. Pictures. It is the fourth installment in the DC Extended Universe (DCEU). Directed by Patty Jenkins from a screenplay by Allan Heinberg and a story by Heinberg, Zack Snyder, and Jason Fuchs, Wonder Woman stars Gal Gadot in the title role, alongside Chris Pine, Robin Wright, Danny Huston, David Thewlis, Connie Nielsen, Elena Anaya, and Said Taghmaoui. It is the second live action theatrical film featuring Wonder Woman following her debut in 2016\'s Batman v Superman: Dawn of Justice. In Wonder Woman, the Amazon princess Diana sets out to stop World War I, believing the conflict was started by the longtime enemy of the Amazons, Ares, after American pilot and spy Steve Trevor crash-lands on their island Themyscira and informs her about it.', 'Patty Jenkins', 'Charles Roven, Deborah Snyder, Zack Snyder, Richard Suckle', 'Gal Gadot, Chris Pine, Robin Wright, Danny Huston, David Thewlis, Connie Nielsen, Elena Anaya,	Lucy Davis', 'Action, War, Superhero, Mystery, Adventure', '2017-06-02', '141 minute', 'PG-13', 'Superhero, DC universe, Comic, Battle', '\"https://www.youtube.com/embed/1Q8fG0TtVAY\"', '\"images/uploads/slider1.jpg\"'),
(2, 'Oblivion', 'Oblivion takes place in 2077, on an Earth devastated by war with extraterrestrials that has caused humanity to relocate itself to Titan. The film follows the story of Jack Harper, a technician who has been sent back to Earth to service drones used in the fight against remaining extraterrestrials (scavengers). After witnessing a spacecraft crash, from which he is able to rescue a survivor, Harper is captured by scavengers and fights against a new and evolving alien threat.', 'Joseph Kosinski', 'Peter Chernin, Dylan Clark, Duncan Henderson, Joseph Kosinski, Barry Levine\r\n', 'Tom Cruise, Morgan Freeman, Olga Kurylenko, Andrea Riseborough, Nikolaj Coster, Melissa Leo ', 'Action, Adventure, Scientific, Mystery', '2013-04-19', '124 minute', 'PG-13', 'Space, Human verses Alien, Year 2077, Post Apocalypse', '\"https://www.youtube.com/embed/w0qQkSuWOS8\"', '\"images/uploads/slider2.jpg\"'),
(3, 'Kong: Skull Island', 'Kong: Skull Island is a 2017 American monster film directed by Jordan Vogt-Roberts. It is a reboot of the King Kong franchise, and serves as the second film in Legendary\'s MonsterVerse. The film stars Tom Hiddleston, Samuel L. Jackson, John Goodman, Brie Larson, Jing Tian, Toby Kebbell, John Ortiz, Corey Hawkins, Jason Mitchell, Shea Whigham, Thomas Mann, Terry Notary, and John C. Reilly. In the film, set in 1973, a team of scientists and Vietnam War soldiers travel to the uncharted Skull Island and meet the mighty Kong, a gigantic ape who is the last of his species, closely followed by other terrifying creatures.', 'Jordan Vogt-Roberts', 'Thomas Tull, Mary Parent, Jon Jashni, Alex Garcia', 'Tom Hiddleston, Samuel L. Jackson, John Goodman, Brie Larson, Jing Tian, Toby Kebbell, John Ortiz, Corey Hawkins     ', 'Action, Adventure, Scientific, Mystery, Monster', '2017-03-10', '118 minute', 'PG-13', 'Giant Monster, Island, Survival, 1970s', '\"https://www.youtube.com/embed/44LdLqgOpjo\"', '\"images/uploads/slider3.jpg\"'),
(5, 'Beauty and the Beast', 'Beauty and the Beast is a 2017 American musical romantic fantasy film directed by Bill Condon from a screenplay by Stephen Chbosky and Evan Spiliotopoulos. Co-produced by Walt Disney Pictures and Mandeville Films, the film is a live-action adaptation of Disney\'s 1991 animated film of the same name, itself an adaptation of Jeanne-Marie Leprince de Beaumont\'s 1756 version of the fairy tale. It features an ensemble cast including Emma Watson and Dan Stevens as the eponymous characters, with Luke Evans, Kevin Kline, Josh Gad, Ewan McGregor, Stanley Tucci, Audra McDonald, Gugu Mbatha-Raw, Ian McKellen, and Emma Thompson in supporting roles. ', 'Bill Condon', 'David Hoberman, Todd Lieberman', 'Emma Watson, Dan Stevens, Luke Evans, Kevin Kline, Josh Gad, Ewan McGregor, Stanley Tucci, Audra McDonald, Gugu Mbatha, Ian McKellen, Emma Thompson ', 'Love, Kid, Mystery, Musical, Dramatic', '2017-03-17', '129 minute', 'PG-13', 'France, Castle, Beast, Disney', '\"https://www.youtube.com/embed/e3Nl_TCQXuw\"', '\"images/uploads/slider5.jpg\"'),
(6, 'Fast & Furious 8', 'The Fate of the Furious (alternatively known as F8 and Fast & Furious 8) is a 2017 American action film directed by F. Gary Gray and written by Chris Morgan. It is the sequel to Furious 7 (2015) and the eighth installment in the Fast & Furious franchise. The film stars Vin Diesel, Dwayne Johnson, Jason Statham, Michelle Rodriguez, Tyrese Gibson, Chris \"Ludacris\" Bridges, Scott Eastwood, Nathalie Emmanuel, Elsa Pataky, Kurt Russell, and Charlize Theron. The Fate of the Furious follows Dominic Toretto (Diesel), who has settled down with his wife Letty Ortiz (Rodriguez), until cyberterrorist Cipher (Theron) coerces him into working for her and turns him against his team, forcing them to find Dom and take down Cipher.', 'F. Gary Gray', 'Neal H. Moritz, Vin Diesel, Michael Fottrell, Chris Morgan\r\n', 'Vin Diesel, Dwayne Johnson, Jason Statham, Michelle Rodriguez, Tyrese Gibson, Chris \"Ludacris\" Bridges, Scott Eastwood, Nathalie Emmanuel, Elsa Pataky, Kurt Russell, Charlize Theron\r\n', 'Action, Crime, Horror', '2017-04-17', '136 minute', 'PG-13', 'Car, Betrayal, Motor Vehicle, Bald man', '\"https://www.youtube.com/embed/NxhEZG0k9_w\"', '\"images/uploads/slider6.jpg\"'),
(14, 'Logan', 'Logan is a 2017 American superhero film starring Hugh Jackman as the titular character. It is the tenth film in the X-Men film series and the third and final installment in the Wolverine trilogy following X-Men Origins: Wolverine (2009) and The Wolverine (2013). The film, which takes inspiration from \"Old Man Logan\" by Mark Millar and Steve McNiven, based in a bleak future, follows an aged Wolverine and an extremely ill Charles Xavier who defend a young mutant named Laura from the villainous Reavers led by Donald Pierce and Zander Rice. The film is produced by 20th Century Fox, Marvel Entertainment, TSG Entertainment and The Donners\' Company, and distributed by 20th Century Fox.[7][8] It is directed by James Mangold, who co-wrote the screenplay with Michael Green and Scott Frank, from a story by Mangold. In addition to Jackman, the film also stars Patrick Stewart, Richard E. Grant, Boyd Holbrook, Stephen Merchant, and Dafne Keen.\r\n', 'James Mangold', 'Hutch Parker, Simon Kinberg, Lauren Shuler Donner', 'Hugh Jackman, Patrick Stewart,Richard E. Grant, Boyd Holbrook, Stephen Merchant, Dafne Keen', 'Thriller', '2021-01-06', '122', 'PG-13', 'Superhero, Marvel universe, Comic, Battle', 'https://www.youtube.com/embed/gbug3zTm3Ws', '\"images/uploads/slider4.jpg\"');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(5) NOT NULL,
  `date` date NOT NULL,
  `price` float NOT NULL,
  `purchase` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `date`, `price`, `purchase`) VALUES
(29, 1, '2021-01-03', 17, 0),
(30, 1, '2021-01-03', 17, 0),
(31, 1, '2021-01-05', 17, 0),
(32, 4, '2021-01-07', 17, 0),
(33, 4, '2021-01-07', 8.5, 0),
(34, 5, '2021-01-07', 8.5, 0),
(35, 6, '2021-01-08', 8.5, 0),
(36, 6, '2021-01-08', 8.5, 0),
(37, 7, '2021-01-08', 8.5, 0),
(38, 7, '2021-01-08', 8.5, 0),
(39, 7, '2021-01-08', 25.5, 0),
(40, 8, '2021-01-08', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `screening`
--

CREATE TABLE `screening` (
  `screening_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `threatre_id` int(11) NOT NULL,
  `show_time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `screening`
--

INSERT INTO `screening` (`screening_id`, `movie_id`, `threatre_id`, `show_time`) VALUES
(1, 1, 2, '00:34'),
(2, 1, 1, '23:40'),
(3, 3, 1, '23:52'),
(4, 3, 2, '13:52'),
(5, 1, 1, '16:40'),
(11, 2, 2, '20:44'),
(13, 5, 1, '22:00'),
(14, 2, 1, '22:00'),
(15, 14, 1, '22:00');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `seat_id` int(10) NOT NULL,
  `seat_no` char(2) NOT NULL,
  `threatre_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seat_id`, `seat_no`, `threatre_id`) VALUES
(1, 'A1', 1),
(2, 'A2', 1),
(3, 'A3', 1),
(4, 'A4', 1),
(5, 'A5', 1),
(6, 'A1', 2),
(7, 'A2', 2),
(8, 'A3', 2),
(9, 'A4', 2),
(10, 'A5', 2);

-- --------------------------------------------------------

--
-- Table structure for table `seat_reserved`
--

CREATE TABLE `seat_reserved` (
  `reserve_id` int(10) NOT NULL,
  `seat_id` varchar(10) NOT NULL,
  `screening_id` int(10) NOT NULL,
  `screening_date` date NOT NULL,
  `payment_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat_reserved`
--

INSERT INTO `seat_reserved` (`reserve_id`, `seat_id`, `screening_id`, `screening_date`, `payment_id`) VALUES
(1, '1,2', 2, '2021-01-03', 29),
(2, '2,1', 5, '2021-01-03', 30),
(3, '7,8', 11, '2021-01-05', 31),
(4, '1,2', 2, '2021-01-07', 32),
(5, '8', 1, '2021-01-07', 33),
(6, '5', 2, '2021-01-07', 34),
(7, '6', 1, '2021-01-08', 35),
(8, '1', 13, '2021-01-08', 36),
(9, '1', 5, '2021-01-08', 37),
(10, '6', 1, '2021-01-08', 38),
(11, '1,2,3', 14, '2021-01-08', 39),
(12, '1,2', 2, '2021-01-08', 40);

-- --------------------------------------------------------

--
-- Table structure for table `threatre`
--

CREATE TABLE `threatre` (
  `threatre_id` int(10) NOT NULL,
  `name` char(15) NOT NULL,
  `seat_amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threatre`
--

INSERT INTO `threatre` (`threatre_id`, `name`, `seat_amount`) VALUES
(1, 'Chunema_1', 5),
(2, 'Chunema_2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pasword` varchar(100) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `username`, `email`, `pasword`, `gender`, `phone`) VALUES
(1, 'abc', 'khangyer@hotmail.com', '$2y$10$ghhTHYGewC4m5yPLIvfp/.g/O4.7Qgy35x2lMgFbtJPZxiqBEXoAO', 'male', '60172982731'),
(2, 'hakhung', 'ykehang@gmail.com', '$2y$10$EmsDKxkq3vFS.UNf53nJEOc/vxP9C0HdUuiuWGRh4eJYYz/2qAu5m', '', ''),
(3, 'suckerpunch1999', 'yeujie97@gmail.com', '$2y$10$hHSToc/Tt2SgwB6ecVSoruJwJWKYmdvnxN/pf4/ym0vBa/pIW2cV6', 'male', '60172982731'),
(4, 'Johnny', 'johnny@gmail.com', '$2y$10$w16zQg87NRCc3pYXfwGoSOKynB9EK77Qs7M.CLf4NMCE9229chhFC', 'male', '019812401234'),
(5, 'Jeremy', 'jeremy@gmail.com', '$2y$10$4bpCUtwdvG4FqxS3tlAWbOc8JUrhNGe7W2dw472VCBj7Ncs7KEAJO', 'male', '02345435234'),
(6, 'Jerome1', 'jerome@gmail.com', '$2y$10$/ePs1bh27XZI.Eydydd70..ftuOmq.0VmtAH2DhcyFN6/yuOwvND2', 'male', '0124322912'),
(7, 'Reddington1', 'reddington@gmail.com', '$2y$10$k6LnRb4X7FccYcyq/doH5uOBe01sC9GXDdIRrXAIO.KGwrfeETqzO', 'male', '0124322912'),
(8, 'Jonas1', 'jonas@gmail.com', '$2y$10$YFj.u1UpSNkcvjvlHF8HVupgNsgJEolMdifON84hFoYmtTziLJEea', 'male', '0124322912');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movielist`
--
ALTER TABLE `movielist`
  ADD PRIMARY KEY (`movieid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `screening`
--
ALTER TABLE `screening`
  ADD PRIMARY KEY (`screening_id`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`seat_id`);

--
-- Indexes for table `seat_reserved`
--
ALTER TABLE `seat_reserved`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `threatre`
--
ALTER TABLE `threatre`
  ADD PRIMARY KEY (`threatre_id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movielist`
--
ALTER TABLE `movielist`
  MODIFY `movieid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `screening`
--
ALTER TABLE `screening`
  MODIFY `screening_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `seat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `seat_reserved`
--
ALTER TABLE `seat_reserved`
  MODIFY `reserve_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `threatre`
--
ALTER TABLE `threatre`
  MODIFY `threatre_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
