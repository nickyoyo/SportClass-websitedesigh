-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 
-- 伺服器版本: 10.1.31-MariaDB
-- PHP 版本： 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `imtsystem`
--

-- --------------------------------------------------------

--
-- 資料表結構 `data`
--

CREATE TABLE `data` (
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nickname` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(15) NOT NULL,
  `age` int(3) NOT NULL,
  `address` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `connecter` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `extraphone` int(15) NOT NULL,
  `lineID` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `identity` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `classdeadline` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `classcount` int(3) NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `mailcount` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `data`
--

INSERT INTO `data` (`name`, `account`, `password`, `nickname`, `birthday`, `gender`, `phone`, `age`, `address`, `connecter`, `extraphone`, `lineID`, `identity`, `classdeadline`, `classcount`, `email`, `mailcount`) VALUES
('林小城', 'Smallcity0405', '337ee24e16b942c340076332012ed1c91c628c7d', '阿雨', '1998-04-05', 'M', 977123456, 22, '臺北市大同區中興南路52號2F之四', '林大辰', 989654874, 'zxczxcasd', '1', '2020-07-23', 14, 'nick0989310427@gmail.com', 0),
('蔡大頭', 'bighead1107', 'bccdcf4ff371bb560d8792147b51f73400dc3da3', 'YY', '1987-11-07', 'F', 985238521, 32, '測試市加油路努力號', '測試y爸', 952846852, 'yyy123123', '1', '2020-07-14', 0, 'nick0989310427@gmail.com', 0),
('陳大光', 'biglight0407', '30615a221f4a23849a342ebae71975f2e7d89a73', 'SS', '2000-04-07', 'M', 952874598, 20, '測試市加油路努力號', '測試s哥', 925963852, 'sss123123', '1', '2020-07-23', 10, 'nick0989310427@gmail.com', 0),
('王大明', 'bigmin0707', '77e28aab761551425ac8e9367bd8a34defb6204d', 'WW', '1990-07-07', 'X', 985234789, 29, '測試市加油路努力號', '測試W爸', 928564852, 'www123123', '1', '2020-07-14', 3, 'nick0989310427@gmail.com', 0),
('陳大壯', 'dagun0909', '18409fbca01aef5ccefb5e31c6c22b7e90e065da', '球球', '1997-09-09', 'M', 985236456, 22, '台北市某處', '0', 0, 'ttttt123123123', '2', '', 0, 'nick0989310427@gmail.com', 0),
('陳會提', 'hunti0088', 'c29640a3c768089f7fc332b1dd03fe9dce18ae72', '0', '0000-00-00', 'F', 989645852, 2020, '0', '0', 0, 'asdad8956', '3', '2020-07-14', 4, 'nick0989310427@gmail.com', 0),
('黃汨華', 'nbs0628', '40b0784c3cd002ba8e0c03a06a78c23765b161f1', '秘密', '1997-04-04', 'M', 988654852, 23, '密碼市密碼路密碼號', '密碼哥', 986321586, '956498wefwef', '1', '2020-07-14', 8, 'nick0989310427@gmail.com', 0),
('尤天真', 'skytrue0403', '23dfb4578fd88d9661215bb6e1b5063f60826868', 'XX', '2000-04-03', 'F', 912345852, 20, '測試市加油路努力號', '測試x姊', 925235213, 'xxx123123', '1', '2020-07-18', 5, 'nick0989310427@gmail.com', 0),
('許小名', 'smallname0403', 'aa886a0b6f72200ad1e43005f2e719662ee54d11', '二二', '2000-04-03', 'F', 912345852, 20, '測試市加油路努力號', '測試二姊', 925235213, 'zzz123123', '1', '2020-07-14', 1, 'nick0989310427@gmail.com', 0),
('曹木霖', 'woodlin0407', '4f6e149923963c22bfa634ab696f8f11e7049b45', 'DD', '1980-04-07', 'F', 952854789, 40, '測試市加油路努力號', '測試d哥', 958263852, 'ddd123123', '1', '2020-07-14', 3, 'nick0989310427@gmail.com', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `teachercheck`
--

CREATE TABLE `teachercheck` (
  `checkcode` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `teachercheck`
--

INSERT INTO `teachercheck` (`checkcode`) VALUES
('jido989rgrg'),
('eog5eopn8e6');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`account`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
