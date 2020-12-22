-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: db
-- Χρόνος δημιουργίας: 19 Δεκ 2020 στις 15:24:06
-- Έκδοση διακομιστή: 8.0.22
-- Έκδοση PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `stefanos`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `Cinemas`
--

CREATE TABLE `Cinemas` (
  `ID` int NOT NULL,
  `OWNER` varchar(200) NOT NULL,
  `NAME` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `Cinemas`
--

INSERT INTO `Cinemas` (`ID`, `OWNER`, `NAME`) VALUES
(2, '8595b3bb-cbe2-4ef3-9b91-79499596df8d', 'Ellinis'),
(3, 'c8dcba65-9653-481b-996f-68ea239201e8', 'Panteliss'),
(4, 'caa15d16-ac75-4707-80ad-0ca15155103c', 'Ellinis2'),
(5, 'e3d5321d-7c3a-4f92-95ee-f636b2a8520a', 'Village Gazi'),
(7, '984c9e72-2de6-409f-8e62-df2a3454bb66', 'Pantelis2');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `Favorites`
--

CREATE TABLE `Favorites` (
  `ID` int NOT NULL,
  `USERID` varchar(200) NOT NULL,
  `MOVIEID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `Favorites`
--

INSERT INTO `Favorites` (`ID`, `USERID`, `MOVIEID`) VALUES
(26, 'c8dcba65-9653-481b-996f-68ea239201e8', 1),
(27, 'c8dcba65-9653-481b-996f-68ea239201e8', 8),
(29, 'admin', 1),
(30, 'admin', 8),
(31, 'admin', 19);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `Movies`
--

CREATE TABLE `Movies` (
  `ID` int NOT NULL,
  `TITLE` varchar(200) NOT NULL,
  `STARTDATE` date NOT NULL,
  `ENDDATE` date NOT NULL,
  `CINENAME` varchar(200) NOT NULL,
  `CATEGORY` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `Movies`
--

INSERT INTO `Movies` (`ID`, `TITLE`, `STARTDATE`, `ENDDATE`, `CINENAME`, `CATEGORY`) VALUES
(1, 'Lucifer', '2020-01-01', '2021-01-01', 'Ellinis', 'Comedy'),
(3, 'ROGUE CITY', '2020-11-13', '2021-02-28', 'Village', 'Action'),
(4, 'Wanted', '2020-11-16', '2021-04-01', 'Panteliss', 'Action'),
(8, 'Nemo3', '2020-11-01', '2021-03-11', 'Panteliss', 'Comedy'),
(12, 'Riverdale', '2020-10-22', '2021-07-22', 'Village Gazi', 'Action'),
(13, 'Dark', '2020-11-01', '2021-04-26', 'Village Gazi', 'Action'),
(15, 'Wanted2', '2020-12-17', '2020-12-31', 'Panteliss', 'Action'),
(19, 'wanted3', '2020-12-16', '2020-12-31', 'Panteliss', 'Action'),
(26, 'wanted4', '2020-12-17', '2021-03-27', 'Panteliss', 'Action'),
(27, 'xmas', '2020-12-16', '2021-01-08', 'Pantelis2', 'Comedy');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `Users`
--

CREATE TABLE `Users` (
  `ID` int NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `SURNAME` varchar(200) NOT NULL,
  `USERNAME` varchar(200) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `ROLE` enum('ADMIN','CINEMAOWNER','USER') NOT NULL,
  `CONFIRMED` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `Users`
--

INSERT INTO `Users` (`ID`, `NAME`, `SURNAME`, `USERNAME`, `PASSWORD`, `EMAIL`, `ROLE`, `CONFIRMED`) VALUES
(1, 'admin', 'admin', 'admin', '1234', 'admin@admin.com', 'ADMIN', 1),
(2, 'dfhdfh', 'djdfgjdfgjj', 'jdfgjddfgjjgjg', '12345', 'dfhhdfdfhdfh', 'USER', 1),
(3, 'manolis', 'fshfhsj', 'manpan', '12345', 'dfhjfwwfjhjc,@gmail.com', 'USER', 1),
(4, 'pantelis', 'pantelis', 'pantelis', '1234', 'pantelis@pantelis.com', 'CINEMAOWNER', 1),
(5, 'stefanos', 'panagioulakis', 'stefanpanas', 'stefan511998', 'stefanpanas2@gmail.com', 'USER', 1),
(6, 'stefan', 'pan', 'username', 'password', 'emahil', 'USER', 1),
(8, 'Ellinis', 'Jkdh', 'Ellinis2', '1234', 'fdsdgsdgsdg', 'CINEMAOWNER', 1),
(10, 'dfhhfdfh', 'dfhdfhdfh', 'dfhdfhdfhdfh', '1234', 'rhddfhdfhhdf', 'USER', 1),
(11, 'Village', 'Gazi', 'VillageGazi', '12345', 'sdfhsgdhjdgksh', 'CINEMAOWNER', 1);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `Cinemas`
--
ALTER TABLE `Cinemas`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `NAME` (`NAME`);

--
-- Ευρετήρια για πίνακα `Favorites`
--
ALTER TABLE `Favorites`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Ευρετήρια για πίνακα `Movies`
--
ALTER TABLE `Movies`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`,`TITLE`);

--
-- Ευρετήρια για πίνακα `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`,`USERNAME`,`EMAIL`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `Cinemas`
--
ALTER TABLE `Cinemas`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT για πίνακα `Favorites`
--
ALTER TABLE `Favorites`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT για πίνακα `Movies`
--
ALTER TABLE `Movies`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT για πίνακα `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
