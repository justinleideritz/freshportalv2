-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 sep 2024 om 18:43
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freshportal`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `employee`
--

CREATE TABLE `employee` (
  `EMP_ID` int(11) NOT NULL,
  `EMP_Firstname` varchar(60) NOT NULL,
  `EMP_Lastname` varchar(60) NOT NULL,
  `EMP_Email` varchar(60) NOT NULL,
  `EMP_Address` varchar(60) NOT NULL,
  `EMP_Birthdate` date NOT NULL,
  `EMP_DateAdded` date DEFAULT curdate(),
  `EMP_Phone` varchar(10) NOT NULL,
  `EMP_Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `employee`
--

INSERT INTO `employee` (`EMP_ID`, `EMP_Firstname`, `EMP_Lastname`, `EMP_Email`, `EMP_Address`, `EMP_Birthdate`, `EMP_DateAdded`, `EMP_Phone`, `EMP_Description`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123 Main St', '1990-01-01', '2024-05-13', '1234567890', 'Software Engineer'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '456 Elm St', '1992-05-15', '2024-05-13', '2345678901', 'Marketing Manager'),
(3, 'Michael', 'Johnson', 'michael.johnson@example.com', '789 Oak St', '1985-09-20', '2024-05-13', '3456789012', 'Sales Associate'),
(4, 'Emily', 'Williams', 'emily.williams@example.com', '101 Pine St', '1988-12-10', '2024-05-13', '4567890123', 'HR Specialist'),
(5, 'David', 'Brown', 'david.brown@example.com', '222 Maple St', '1993-04-05', '2024-05-13', '5678901234', 'Financial Analyst'),
(6, 'Sarah', 'Jones', 'sarah.jones@example.com', '333 Cedar St', '1987-07-22', '2024-05-13', '6789012345', 'Graphic Designer'),
(7, 'Christopher', 'Garcia', 'christopher.garcia@example.com', '444 Walnut St', '1991-03-18', '2024-05-13', '7890123456', 'Project Manager'),
(8, 'Jessica', 'Martinez', 'jessica.martinez@example.com', '555 Birch St', '1983-11-25', '2024-05-13', '8901234567', 'Quality Assurance Specialist'),
(9, 'Daniel', 'Hernandez', 'daniel.hernandez@example.com', '666 Oak St', '1995-08-30', '2024-05-13', '9012345678', 'Systems Administrator'),
(10, 'Jennifer', 'Lopez', 'jennifer.lopez@example.com', '777 Pine St', '1984-06-12', '2024-05-13', '0123456789', 'Customer Service Representative'),
(11, 'Matthew', 'Young', 'matthew.young@example.com', '888 Maple St', '1989-09-08', '2024-05-13', '1234567890', 'Data Analyst'),
(12, 'Amanda', 'Scott', 'amanda.scott@example.com', '999 Cedar St', '1994-02-14', '2024-05-13', '2345678901', 'UX/UI Designer'),
(13, 'James', 'Green', 'james.green@example.com', '111 Elm St', '1986-10-03', '2024-05-13', '3456789012', 'Operations Manager'),
(14, 'Lauren', 'Adams', 'lauren.adams@example.com', '222 Pine St', '1990-07-27', '2024-05-13', '4567890123', 'Software Developer'),
(15, 'Ryan', 'Baker', 'ryan.baker@example.com', '333 Walnut St', '1982-05-19', '2024-05-13', '5678901234', 'Marketing Coordinator'),
(16, 'Michelle', 'Nelson', 'michelle.nelson@example.com', '444 Birch St', '1981-12-07', '2024-05-13', '6789012345', 'Business Analyst'),
(17, 'Kevin', 'Carter', 'kevin.carter@example.com', '555 Oak St', '1996-04-02', '2024-05-13', '7890123456', 'Web Developer'),
(18, 'Stephanie', 'Perez', 'stephanie.perez@example.com', '666 Pine St', '1980-08-16', '2024-05-13', '8901234567', 'Accountant'),
(19, 'Brian', 'Rivera', 'brian.rivera@example.com', '777 Cedar St', '1997-01-25', '2024-05-13', '9012345678', 'Network Engineer'),
(20, 'Ashley', 'Torres', 'ashley.torres@example.com', '888 Maple St', '1988-11-09', '2024-05-13', '0123456789', 'UX/UI Designer'),
(21, 'Andrew', 'Nguyen', 'andrew.nguyen@example.com', '999 Walnut St', '1984-03-22', '2024-05-13', '1234567890', 'Software Engineer'),
(22, 'Melissa', 'Lee', 'melissa.lee@example.com', '101 Birch St', '1991-07-14', '2024-05-13', '2345678901', 'Marketing Manager'),
(23, 'Robert', 'Gonzalez', 'robert.gonzalez@example.com', '222 Oak St', '1987-09-05', '2024-05-13', '3456789012', 'Sales Associate'),
(24, 'Christina', 'Wang', 'christina.wang@example.com', '333 Pine St', '1993-11-30', '2024-05-13', '4567890123', 'HR Specialist'),
(25, 'Patrick', 'Khan', 'patrick.khan@example.com', '444 Cedar St', '1986-05-18', '2024-05-13', '5678901234', 'Financial Analyst'),
(26, 'Amy', 'Chen', 'amy.chen@example.com', '555 Walnut St', '1989-12-22', '2024-05-13', '6789012345', 'Graphic Designer'),
(27, 'Justin', 'Liu', 'justin.liu@example.com', '666 Elm St', '1982-08-10', '2024-05-13', '7890123456', 'Project Manager'),
(28, 'Nicole', 'Zhang', 'nicole.zhang@example.com', '777 Maple St', '1994-02-03', '2024-05-13', '8901234567', 'Quality Assurance Specialist'),
(29, 'Brandon', 'Wong', 'brandon.wong@example.com', '888 Oak St', '1980-10-17', '2024-05-13', '9012345678', 'Systems Administrator'),
(30, 'Vanessa', 'Tran', 'vanessa.tran@example.com', '999 Pine St', '1996-06-28', '2024-05-13', '0123456789', 'Customer Service Representative'),
(31, 'Hannah', 'Kim', 'hannah.kim@example.com', '111 Birch St', '1983-04-11', '2024-05-13', '1234567890', 'Data Analyst'),
(32, 'Jason', 'Chang', 'jason.chang@example.com', '222 Elm St', '1985-08-26', '2024-05-13', '2345678901', 'UX/UI Designer'),
(33, 'Samantha', 'Ng', 'samantha.ng@example.com', '333 Cedar St', '1992-10-05', '2024-05-13', '3456789012', 'Operations Manager'),
(34, 'William', 'Chen', 'william.chen@example.com', '444 Pine St', '1988-12-14', '2024-05-13', '4567890123', 'Software Developer'),
(35, 'Rachel', 'Wong', 'rachel.wong@example.com', '555 Walnut St', '1981-06-27', '2024-05-13', '5678901234', 'Marketing Coordinator'),
(36, 'Tyler', 'Le', 'tyler.le@example.com', '666 Maple St', '1990-01-09', '2024-05-13', '6789012345', 'Business Analyst'),
(37, 'Emma', 'Wu', 'emma.wu@example.com', '777 Oak St', '1987-03-18', '2024-05-13', '7890123456', 'Web Developer'),
(38, 'Steven', 'Chow', 'steven.chow@example.com', '888 Cedar St', '1995-05-23', '2024-05-13', '8901234567', 'Accountant'),
(39, 'Kimberly', 'Huang', 'kimberly.huang@example.com', '999 Elm St', '1984-09-01', '2024-05-13', '9012345678', 'Network Engineer'),
(40, 'Justin', 'Chen', 'justin.chen@example.com', '111 Pine St', '1991-11-13', '2024-05-13', '0123456789', 'UX/UI Designer'),
(41, 'Lauren', 'Lam', 'lauren.lam@example.com', '222 Walnut St', '1986-07-26', '2024-05-13', '1234567890', 'Software Engineer'),
(42, 'Ethan', 'Wu', 'ethan.wu@example.com', '333 Cedar St', '1989-02-19', '2024-05-13', '2345678901', 'Marketing Manager'),
(43, 'Catherine', 'Chang', 'catherine.chang@example.com', '444 Birch St', '1982-04-04', '2024-05-13', '3456789012', 'Sales Associate'),
(44, 'Jonathan', 'Liu', 'jonathan.liu@example.com', '555 Oak St', '1993-09-16', '2024-05-13', '4567890123', 'HR Specialist'),
(45, 'Grace', 'Yang', 'grace.yang@example.com', '666 Maple St', '1980-12-28', '2024-05-13', '5678901234', 'Financial Analyst'),
(46, 'Austin', 'Chen', 'austin.chen@example.com', '777 Cedar St', '1997-02-08', '2024-05-13', '6789012345', 'Graphic Designer'),
(47, 'Victoria', 'Cheng', 'victoria.cheng@example.com', '888 Elm St', '1983-05-21', '2024-05-13', '7890123456', 'Project Manager'),
(48, 'Joseph', 'Wong', 'joseph.wong@example.com', '999 Pine St', '1985-08-03', '2024-05-13', '8901234567', 'Quality Assurance Specialist'),
(49, 'Madison', 'Kwong', 'madison.kwong@example.com', '111 Birch St', '1990-10-15', '2024-05-13', '9012345678', 'Systems Administrator'),
(50, 'Eric', 'Chang', 'eric.chang@example.com', '222 Oak St', '1987-12-27', '2024-05-13', '0123456789', 'Customer Service Representative'),
(51, 'Evelyn', 'Chan', 'evelyn.chan@example.com', '333 Pine St', '1991-04-09', '2024-05-13', '1234567890', 'Data Analyst'),
(52, 'Kyle', 'Wu', 'kyle.wu@example.com', '444 Cedar St', '1984-06-22', '2024-05-13', '2345678901', 'UX/UI Designer'),
(53, 'Bella', 'Lam', 'bella.lam@example.com', '555 Elm St', '1995-01-03', '2024-05-13', '3456789012', 'Operations Manager'),
(54, 'Vincent', 'Ho', 'vincent.ho@example.com', '666 Maple St', '1981-03-15', '2024-05-13', '4567890123', 'Software Developer'),
(55, 'Kaitlyn', 'Leung', 'kaitlyn.leung@example.com', '777 Walnut St', '1989-11-27', '2024-05-13', '5678901234', 'Marketing Coordinator'),
(56, 'Aaron', 'Tam', 'aaron.tam@example.com', '888 Oak St', '1992-07-09', '2024-05-13', '6789012345', 'Business Analyst'),
(57, 'Claire', 'Lau', 'claire.lau@example.com', '999 Cedar St', '1986-09-21', '2024-05-13', '7890123456', 'Web Developer'),
(58, 'Adrian', 'Ng', 'adrian.ng@example.com', '111 Elm St', '1983-01-02', '2024-05-13', '8901234567', 'Accountant'),
(59, 'Isabella', 'Chu', 'isabella.chu@example.com', '222 Pine St', '1997-04-14', '2024-05-13', '9012345678', 'Network Engineer'),
(60, 'Marcus', 'Cheng', 'marcus.cheng@example.com', '333 Birch St', '1980-10-26', '2024-05-13', '0123456789', 'UX/UI Designer'),
(61, 'Haley', 'Chow', 'haley.chow@example.com', '444 Cedar St', '1994-12-08', '2024-05-13', '1234567890', 'Software Engineer'),
(62, 'Owen', 'Yip', 'owen.yip@example.com', '555 Maple St', '1982-02-20', '2024-05-13', '2345678901', 'Marketing Manager'),
(63, 'Natalie', 'Fung', 'natalie.fung@example.com', '666 Oak St', '1989-06-04', '2024-05-13', '3456789012', 'Sales Associate'),
(64, 'Timothy', 'Wu', 'timothy.wu@example.com', '777 Pine St', '1991-09-16', '2024-05-13', '4567890123', 'HR Specialist'),
(65, 'Audrey', 'Ma', 'audrey.ma@example.com', '888 Walnut St', '1985-07-29', '2024-05-13', '5678901234', 'Financial Analyst'),
(66, 'Gabriel', 'Chan', 'gabriel.chan@example.com', '999 Cedar St', '1996-03-12', '2024-05-13', '6789012345', 'Graphic Designer'),
(67, 'Jasmine', 'Li', 'jasmine.li@example.com', '111 Elm St', '1981-05-24', '2024-05-13', '7890123456', 'Project Manager'),
(68, 'Oliver', 'Wong', 'oliver.wong@example.com', '222 Pine St', '1993-11-06', '2024-05-13', '8901234567', 'Quality Assurance Specialist'),
(69, 'Anna', 'Chiu', 'anna.chiu@example.com', '333 Birch St', '1987-02-18', '2024-05-13', '9012345678', 'Systems Administrator'),
(70, 'Max', 'Chen', 'max.chen@example.com', '444 Cedar St', '1990-10-31', '2024-05-13', '0123456789', 'Customer Service Representative'),
(71, 'Sofia', 'Tse', 'sofia.tse@example.com', '555 Pine St', '1983-09-13', '2024-05-13', '1234567890', 'Data Analyst'),
(72, 'Tristan', 'Lo', 'tristan.lo@example.com', '666 Maple St', '1994-04-25', '2024-05-13', '2345678901', 'UX/UI Designer'),
(73, 'Maya', 'Wong', 'maya.wong@example.com', '777 Elm St', '1981-07-07', '2024-05-13', '3456789012', 'Operations Manager'),
(74, 'Lucas', 'Tang', 'lucas.tang@example.com', '888 Walnut St', '1989-02-19', '2024-05-13', '4567890123', 'Software Developer'),
(75, 'Mia', 'Kwok', 'mia.kwok@example.com', '999 Birch St', '1992-05-01', '2024-05-13', '5678901234', 'Marketing Coordinator'),
(76, 'Caleb', 'Leung', 'caleb.leung@example.com', '111 Oak St', '1980-08-14', '2024-05-13', '6789012345', 'Business Analyst'),
(77, 'Lily', 'Ma', 'lily.ma@example.com', '222 Cedar St', '1997-01-26', '2024-05-13', '7890123456', 'Web Developer'),
(78, 'Aaron', 'Tse', 'aaron.tse@example.com', '333 Pine St', '1984-11-08', '2024-05-13', '8901234567', 'Accountant'),
(79, 'Amelia', 'Tam', 'amelia.tam@example.com', '444 Maple St', '1986-12-20', '2024-05-13', '9012345678', 'Network Engineer'),
(81, 'Jack', 'Okyere', 'jackieokyere820@gmail.com', 'straat 2', '2024-05-16', '2024-05-21', '0987651234', 'test'),
(82, 'Dummy', 'test', 'jackieokyere820@gmail.com	', '123123', '2024-05-21', '2024-05-21', '1231231231', 'knefkdj'),
(83, 'test', 'kjo', 'jkhwejdhjwke', 'kjefkje', '2024-05-09', '2024-05-21', '1234567890', 'mnewfjwn'),
(84, 'justin', 'justin', 'justinleideritz98@hotmail.com', 'straat 1 ', '2024-05-24', '2024-05-22', '0622887055', 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `USE_ID` int(11) NOT NULL,
  `USE_Username` varchar(50) DEFAULT NULL,
  `USE_Firstname` varchar(50) NOT NULL,
  `USE_Lastname` varchar(50) NOT NULL,
  `USE_Password` varchar(255) DEFAULT NULL,
  `USE_Email` varchar(60) NOT NULL,
  `USE_ResetToken` varchar(255) NOT NULL,
  `USE_DateAdded` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`USE_ID`, `USE_Username`, `USE_Firstname`, `USE_Lastname`, `USE_Password`, `USE_Email`, `USE_ResetToken`, `USE_DateAdded`) VALUES
(1, 'justinleideritz', 'Justin', 'Leideritz', '$2y$10$OnE4ON1lW/J3fmcOGDR7Oe4G2qxIPkM23wuD/2.cUuNz1rykiICpO', 'justinleideritz98@hotmail.com', '', '2024-05-13');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMP_ID`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USE_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `employee`
--
ALTER TABLE `employee`
  MODIFY `EMP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `USE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
