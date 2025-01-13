-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-05-28 09:54:08
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `account`
--

-- --------------------------------------------------------

--
-- 資料表結構 `post`
--

CREATE TABLE `post` (
  `date` date NOT NULL,
  `partment` varchar(20) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `post`
--

INSERT INTO `post` (`date`, `partment`, `content`) VALUES
('2024-03-01', 'student association', '\nCongratulations on the departure of President Zhuo Zhixun from the 114th Departmental Student Association!'),
('2024-03-13', 'student association', '\nThe departmental card event will be held on May 10th. Everyone is welcome to join!'),
('2024-05-30', 'departmental office', '\nThe deadline for submitting written materials for the third-year project stage exhibition is April 30th.'),
('2024-05-14', 'student', '\nPlease help locate student Wen Yancheng, who has been missing for a long time. Remind him to contact his group members as soon as possible!'),
('2024-03-04', 'school', '\nPlease be polite and refrain from maliciously attacking other students on this website. Otherwise, you will be suspended for one month.'),
('2024-01-16', 'departmental office', 'On February 28th (Wednesday), there will be a day off due to the 228 Incident Memorial Day.'),
('2024-03-20', 'student association', 'The classroom has found a jacket'),
('2024-05-23', 'departmental office', 'Remember to pay the tuition fee!'),
('2024-04-09', '\nstudent', 'The final exam grades for linear algebra have been released.'),
('2024-04-29', 'departmental office', 'here will be a speech on May 10th. Students are encouraged to participate enthusiastically.'),
('2024-03-18', 'administrato', 'Please adhere to the rules of the website.'),
('2024-05-28', 'departmental office', 'Don\'t stay in the school classroom for too long.');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`date`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
