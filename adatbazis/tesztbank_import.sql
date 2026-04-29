-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Ápr 29. 20:52
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tesztbank`
--
CREATE DATABASE IF NOT EXISTS `tesztbank` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `tesztbank`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `nev` varchar(64) NOT NULL,
  `szerep` enum('t','d') NOT NULL,
  `email` varchar(32) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `csop` varchar(5) NOT NULL,
  `proba` int(11) NOT NULL DEFAULT 0,
  `aktiv` tinyint(1) NOT NULL DEFAULT 1,
  `lastLog` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `nev`, `szerep`, `email`, `jelszo`, `csop`, `proba`, `aktiv`, `lastLog`) VALUES
(1, 'Demo Dani', 'd', 'demo.dani', 'fe01ce2a7fbac8fafaed7c982a04e229', 'TAN', 0, 1, '2026-04-29 14:03:39'),
(11, 'Gödöny Péter', 't', 'godony.peter', 'ad2d8ee7d788dcf41f399818f639cb64', 'TAN', 1, 1, '2026-04-29 16:18:38'),
(12, 'Simon Viktória', 't', 'simon.viktoria', 'd38212a0c0e98f678feaaa5a8b9167f5', 'TAN', 0, 1, '2026-04-28 16:36:28'),
(101, 'Teszt Elek', 'd', 'teszt.elek', '83f56f37a245ccaf8c885814074777f6', '11.C', 1, 1, '2026-04-29 14:44:42'),
(102, 'Békés Csaba', 'd', 'bekes.csaba', 'ca2aeffb142c14a59b5ac7a26fe21843', '11.C', 0, 1, '2026-04-28 19:01:48'),
(103, 'Vakaró Zoltán', 'd', 'vakaro.zoltan', 'a708480c0400bea0b2d3ca752db5c3b1', '11.A', 0, 1, '2026-04-25 15:47:01'),
(105, 'Nagy Sándor', 'd', 'nagy.sandor', 'd41e98d1eafa6d6011d3a70f1a5b92f0', '9.C', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kerdesek`
--

CREATE TABLE `kerdesek` (
  `id` int(11) NOT NULL,
  `kerdSzoveg` varchar(512) NOT NULL,
  `temaID` int(11) NOT NULL,
  `rogzitoID` int(11) NOT NULL,
  `ellenorID` int(11) DEFAULT NULL,
  `forras` varchar(2083) DEFAULT NULL,
  `megjegyzes` varchar(2048) DEFAULT NULL,
  `torolt` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kerdesek`
--

INSERT INTO `kerdesek` (`id`, `kerdSzoveg`, `temaID`, `rogzitoID`, `ellenorID`, `forras`, `megjegyzes`, `torolt`) VALUES
(1, 'Melyik együttes nevéhez fűződik a Bohemian rhapsody?', 1, 12, 11, 'saját', NULL, 0),
(2, 'Az alábbiak közül melyik banda ausztrál?', 1, 12, 11, 'saját', NULL, 0),
(3, 'Melyik zenekar dala hallható?', 1, 12, 11, 'saját', NULL, 0),
(4, 'Kik láthatóak a képen?', 1, 12, 11, 'saját', 'Led Zeppelin in 1971<br>A képen balról jobbra: John Paul Jones, Jimmy Page, John Bonham and Robert Plant<hr>A kép forrása: <a href=\"https://en.wikipedia.org/wiki/Led_Zeppelin\" target=\"_blank\">https://en.wikipedia.org/wiki/Led_Zeppelin</a>', 0),
(5, 'Ki látható a képen?', 1, 12, 11, 'saját', NULL, 0),
(6, 'Melyik híres magyar zenekarban játszott Benkő László?', 1, 12, 11, 'saját', 'Benkő László számos együttesben játszott: Omega, Benkó Dixieland Band, B-Project, Próféta és Megapolis.<br>Forrás: <a href=\"https://hu.wikipedia.org/wiki/Benk%C5%91_L%C3%A1szl%C3%B3_(zen%C3%A9sz)\" target=\"_blank\">https://hu.wikipedia.org/wiki/Benkő_László_(zenész)</a>', 0),
(7, 'Melyik zenekar videójából származik az alábbi jelenet?', 1, 12, 11, 'saját', NULL, 0),
(8, 'Ki rendezte az Avatar című filmet?', 2, 12, 11, 'saját', NULL, 0),
(9, 'Melyik filmből látható a részlet?', 2, 12, 11, 'saját', NULL, 0),
(10, 'Hol láthattuk ezt a jelenetet?', 2, 12, 11, 'saját', NULL, 0),
(11, 'Melyik alkotásban volt látható Kate Winslet és Leonardo DiCaprio kettőse?', 2, 12, 11, 'saját', NULL, 0),
(12, 'Hol hallhattuk az alábbi dalt?', 2, 12, 11, 'saját', NULL, 0),
(13, 'Melyik filmből látható az alábbi kép?', 2, 12, 11, 'saját', NULL, 0),
(14, 'Melyik filmből való a részlet?', 2, 12, 11, 'saját', NULL, 0),
(15, 'Ki rendezte a Jurassic Park filmet?', 2, 12, 11, 'saját', NULL, 0),
(16, 'Melyik filmből hallható a híres dalrészlet?', 2, 12, 11, 'saját', NULL, 0),
(17, 'Melyik film főszereplője Sylvester Stallone?', 2, 12, 11, 'saját', NULL, 0),
(18, 'Melyik filmben volt látható az alábbi karakter?', 2, 12, 11, 'saját', NULL, 0),
(19, 'Melyik magyar film kapott Oscar díjat?', 2, 11, 12, 'saját', '<p>Magyar Oscar díjas filmek:</p><ul><li>Mindenki / Sing (2016)</li><li>Saul fia / Son of Saul (2015)</li><li>Mephisto (1982)</li><li>A légy / The Fly (1981)</li></ul>Forrás: <a href=\"https://bphirek.hu/kult/magyar-oscar-dijas-filmek\" target=\"_blank\">https://bphirek.hu/kult/magyar-oscar-dijas-filmek</a>', 0),
(20, 'Melyik filmstúdió intrója kezdődik így?', 2, 11, 12, 'saját', NULL, 0),
(21, 'A Titanic című filmnek mi a műfaji besorolása?', 2, 11, 12, 'saját', 'A Titanic (1997) elsősorban romantikus filmdráma és katasztrófafilm, amelyet James Cameron írt és rendezett. A műfaji besorolást a történelmi alapú katasztrófa (az RMS Titanic elsüllyedése) és a kitalált szerelmi szál (Jack és Rose története) keveredése adja, epikus és látványos stílusban.', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kerdesvalasz`
--

CREATE TABLE `kerdesvalasz` (
  `id` int(11) NOT NULL,
  `kerdesID` int(11) NOT NULL,
  `valaszID` int(11) NOT NULL,
  `pont` int(11) NOT NULL,
  `torolt` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kerdesvalasz`
--

INSERT INTO `kerdesvalasz` (`id`, `kerdesID`, `valaszID`, `pont`, `torolt`) VALUES
(2, 1, 2, 0, 1),
(3, 1, 3, 0, 1),
(4, 1, 4, 0, 1),
(5, 1, 5, 0, 1),
(7, 1, 7, 0, 1),
(8, 2, 8, 1, 1),
(9, 2, 9, 0, 1),
(10, 2, 10, 0, 1),
(11, 2, 11, 0, 1),
(12, 3, 12, 1, 1),
(13, 3, 13, 1, 1),
(14, 3, 14, 1, 1),
(15, 3, 15, 1, 1),
(16, 3, 16, 0, 1),
(17, 3, 17, 0, 1),
(18, 3, 18, 0, 1),
(19, 3, 19, 0, 1),
(20, 3, 20, 0, 1),
(21, 3, 21, 0, 1),
(22, 4, 22, 0, 1),
(23, 4, 23, 0, 1),
(24, 4, 24, 1, 1),
(25, 4, 25, 0, 1),
(26, 5, 26, 1, 1),
(27, 5, 27, 0, 1),
(28, 5, 28, 0, 1),
(29, 5, 29, 0, 1),
(30, 5, 30, 1, 1),
(31, 6, 31, 1, 1),
(32, 6, 32, 0, 1),
(33, 6, 33, 0, 1),
(34, 6, 34, 0, 1),
(35, 7, 35, 1, 1),
(36, 7, 36, 1, 1),
(37, 7, 37, 1, 1),
(38, 7, 38, 0, 1),
(39, 7, 39, 0, 1),
(40, 7, 40, 0, 1),
(41, 7, 41, 0, 1),
(42, 7, 42, 0, 1),
(43, 8, 43, 1, 1),
(44, 8, 44, 1, 1),
(45, 8, 45, 0, 1),
(46, 8, 46, 0, 1),
(47, 8, 47, 0, 1),
(48, 8, 48, 0, 1),
(49, 9, 49, 1, 1),
(50, 9, 50, 0, 1),
(51, 9, 51, 0, 1),
(52, 9, 52, 0, 1),
(53, 9, 53, 0, 1),
(54, 9, 54, 1, 1),
(55, 10, 50, 0, 1),
(56, 10, 55, 1, 1),
(57, 10, 51, 0, 1),
(58, 10, 56, 0, 1),
(59, 10, 57, 0, 1),
(60, 10, 58, 1, 1),
(61, 10, 59, 1, 1),
(62, 11, 60, 0, 1),
(63, 11, 61, 0, 1),
(64, 11, 62, 0, 1),
(65, 11, 63, 1, 1),
(66, 11, 64, 1, 1),
(67, 12, 65, 1, 1),
(68, 12, 66, 0, 1),
(69, 12, 67, 0, 1),
(70, 12, 68, 0, 1),
(71, 12, 69, 0, 1),
(92, 1, 1, 1, 1),
(93, 1, 6, 1, 1),
(97, 13, 172, 1, 1),
(99, 4, 174, 1, 1),
(100, 4, 175, 0, 1),
(101, 4, 176, 1, 1),
(102, 4, 177, 0, 1),
(103, 1, 178, 1, 0),
(104, 1, 179, 0, 0),
(105, 1, 180, 0, 0),
(106, 1, 181, 0, 0),
(107, 1, 182, 0, 0),
(108, 1, 183, 0, 0),
(109, 2, 184, 1, 0),
(110, 2, 185, 0, 0),
(111, 2, 186, 0, 0),
(112, 2, 187, 0, 0),
(113, 2, 188, 0, 0),
(114, 2, 189, 0, 0),
(115, 2, 190, 1, 0),
(116, 2, 191, 1, 0),
(117, 2, 182, 0, 0),
(118, 3, 193, 1, 0),
(119, 3, 194, 0, 0),
(120, 3, 195, 0, 0),
(121, 3, 196, 0, 0),
(122, 3, 197, 0, 0),
(123, 3, 198, 0, 0),
(124, 3, 199, 0, 0),
(125, 4, 178, 0, 0),
(126, 4, 201, 0, 0),
(127, 4, 202, 0, 0),
(128, 4, 203, 0, 0),
(129, 4, 204, 0, 0),
(130, 4, 205, 0, 0),
(131, 4, 179, 1, 0),
(132, 5, 207, 0, 0),
(133, 5, 208, 0, 0),
(134, 5, 209, 0, 0),
(135, 5, 210, 0, 0),
(136, 5, 211, 0, 0),
(137, 5, 199, 0, 0),
(138, 5, 213, 1, 0),
(139, 6, 197, 0, 0),
(140, 6, 215, 0, 0),
(141, 6, 195, 0, 0),
(142, 6, 196, 0, 0),
(143, 6, 218, 0, 0),
(144, 6, 193, 1, 0),
(145, 7, 195, 1, 0),
(146, 7, 194, 0, 0),
(147, 7, 188, 0, 0),
(148, 7, 223, 0, 0),
(149, 7, 224, 0, 0),
(150, 7, 193, 0, 0),
(151, 8, 226, 0, 0),
(152, 8, 227, 0, 0),
(153, 8, 228, 1, 0),
(154, 8, 229, 0, 0),
(155, 8, 230, 0, 0),
(156, 8, 231, 0, 0),
(158, 2, 203, 0, 0),
(159, 9, 234, 1, 0),
(160, 9, 235, 0, 0),
(161, 9, 236, 0, 0),
(162, 9, 237, 0, 0),
(163, 9, 238, 0, 0),
(164, 9, 239, 0, 0),
(165, 10, 240, 0, 0),
(166, 10, 241, 0, 0),
(167, 10, 236, 1, 0),
(168, 10, 242, 0, 0),
(169, 10, 243, 0, 0),
(170, 10, 244, 0, 0),
(171, 10, 245, 0, 0),
(172, 10, 246, 0, 0),
(173, 11, 242, 1, 0),
(174, 11, 247, 1, 0),
(175, 11, 248, 0, 0),
(176, 11, 249, 0, 0),
(177, 11, 250, 0, 0),
(178, 11, 251, 0, 0),
(179, 11, 252, 0, 0),
(180, 12, 253, 1, 0),
(181, 12, 254, 0, 0),
(182, 12, 255, 0, 0),
(183, 12, 256, 0, 0),
(184, 12, 257, 0, 0),
(185, 12, 258, 0, 0),
(186, 12, 259, 0, 0),
(187, 13, 251, 1, 0),
(188, 13, 260, 0, 0),
(189, 13, 261, 0, 0),
(190, 13, 262, 0, 0),
(191, 13, 241, 0, 0),
(192, 13, 263, 0, 0),
(193, 13, 258, 0, 0),
(194, 13, 243, 0, 0),
(195, 14, 256, 1, 0),
(196, 14, 264, 0, 0),
(197, 14, 265, 0, 0),
(198, 14, 266, 0, 0),
(199, 14, 267, 0, 0),
(200, 14, 268, 0, 0),
(201, 14, 269, 0, 0),
(202, 15, 226, 1, 0),
(203, 15, 227, 0, 0),
(204, 15, 228, 0, 0),
(205, 15, 231, 0, 0),
(206, 15, 270, 0, 0),
(207, 15, 271, 0, 0),
(208, 16, 236, 0, 0),
(209, 16, 241, 0, 0),
(210, 16, 251, 0, 0),
(211, 16, 237, 1, 0),
(212, 16, 255, 0, 0),
(213, 16, 250, 0, 0),
(214, 16, 268, 0, 0),
(215, 17, 260, 0, 0),
(216, 17, 272, 0, 0),
(217, 17, 248, 0, 0),
(218, 17, 244, 0, 0),
(219, 17, 264, 0, 0),
(220, 17, 266, 0, 0),
(221, 17, 263, 1, 0),
(222, 17, 273, 1, 0),
(223, 17, 274, 1, 0),
(224, 17, 275, 1, 0),
(225, 17, 276, 0, 0),
(226, 17, 277, 0, 0),
(227, 17, 278, 0, 0),
(228, 18, 264, 1, 0),
(229, 18, 252, 0, 0),
(230, 18, 267, 0, 0),
(231, 18, 241, 0, 0),
(232, 18, 266, 0, 0),
(233, 18, 236, 0, 0),
(234, 18, 279, 0, 0),
(235, 2, 280, 0, 0),
(236, 19, 281, 1, 0),
(237, 19, 282, 1, 0),
(238, 19, 283, 1, 0),
(239, 19, 284, 1, 0),
(240, 19, 285, 0, 0),
(241, 19, 286, 0, 0),
(242, 19, 287, 0, 0),
(243, 19, 288, 0, 0),
(244, 19, 289, 0, 0),
(245, 19, 290, 0, 0),
(246, 19, 291, 0, 0),
(247, 19, 292, 0, 0),
(248, 19, 293, 0, 0),
(249, 19, 294, 0, 0),
(250, 20, 295, 1, 0),
(251, 20, 296, 0, 0),
(252, 20, 297, 0, 0),
(253, 20, 298, 0, 0),
(254, 20, 299, 0, 0),
(255, 20, 300, 0, 0),
(256, 20, 301, 0, 0),
(257, 20, 302, 0, 0),
(258, 20, 303, 0, 0),
(259, 20, 304, 0, 0),
(260, 20, 305, 0, 0),
(261, 20, 306, 0, 0),
(262, 21, 307, 1, 0),
(263, 21, 308, 1, 0),
(264, 21, 309, 0, 0),
(265, 21, 310, 0, 0),
(266, 21, 311, 0, 0),
(267, 21, 312, 0, 0),
(268, 21, 313, 0, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kitoltesek`
--

CREATE TABLE `kitoltesek` (
  `id` int(11) NOT NULL,
  `felhID` int(11) NOT NULL,
  `kerdID` int(11) NOT NULL,
  `v1ID` int(11) NOT NULL,
  `v2ID` int(11) NOT NULL,
  `v3ID` int(11) NOT NULL,
  `v4ID` int(11) NOT NULL,
  `vuID` int(11) NOT NULL,
  `idobelyeg` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `kitoltesek`
--

INSERT INTO `kitoltesek` (`id`, `felhID`, `kerdID`, `v1ID`, `v2ID`, `v3ID`, `v4ID`, `vuID`, `idobelyeg`) VALUES
(1, 1, 4, 203, 179, 205, 201, 179, '2026-04-27 12:54:29'),
(2, 1, 4, 205, 203, 179, 201, 179, '2026-04-27 12:54:47'),
(3, 1, 4, 205, 203, 179, 201, 179, '2026-04-27 12:56:40'),
(4, 1, 4, 205, 203, 179, 201, 179, '2026-04-27 12:57:07'),
(5, 1, 4, 205, 203, 179, 201, 179, '2026-04-27 12:57:18'),
(6, 1, 4, 205, 203, 179, 201, 179, '2026-04-27 12:57:27'),
(7, 1, 4, 205, 203, 179, 201, 179, '2026-04-27 12:57:30'),
(8, 1, 4, 205, 203, 179, 201, 179, '2026-04-27 12:58:10'),
(9, 1, 4, 205, 203, 179, 201, 179, '2026-04-27 12:58:22'),
(10, 1, 4, 205, 203, 179, 201, 179, '2026-04-27 12:58:44'),
(11, 1, 4, 204, 179, 203, 202, 202, '2026-04-27 13:16:25'),
(12, 1, 6, 197, 218, 193, 195, 195, '2026-04-27 13:16:39'),
(13, 1, 6, 195, 193, 197, 218, 218, '2026-04-27 13:16:54'),
(14, 1, 3, 193, 197, 195, 199, 195, '2026-04-27 13:18:57'),
(15, 11, 6, 215, 197, 193, 218, 193, '2026-04-27 13:25:52'),
(16, 11, 4, 202, 179, 205, 178, 179, '2026-04-27 13:26:32'),
(17, 11, 13, 251, 261, 263, 260, 251, '2026-04-27 13:27:13'),
(18, 11, 6, 193, 196, 215, 195, 193, '2026-04-27 13:31:12'),
(19, 11, 9, 234, 235, 237, 238, 238, '2026-04-27 13:31:22'),
(20, 11, 4, 202, 179, 203, 204, 179, '2026-04-27 13:32:21'),
(21, 11, 5, 213, 211, 209, 208, 213, '2026-04-27 13:33:24'),
(22, 11, 18, 279, 236, 264, 267, 279, '2026-04-27 13:33:40'),
(23, 11, 10, 240, 241, 236, 245, 236, '2026-04-27 13:34:15'),
(24, 11, 3, 197, 193, 198, 194, 194, '2026-04-27 13:35:23'),
(25, 11, 3, 199, 194, 197, 193, 199, '2026-04-27 13:36:10'),
(26, 11, 11, 249, 252, 251, 247, 247, '2026-04-27 13:37:43'),
(27, 11, 18, 236, 266, 264, 252, 264, '2026-04-27 13:44:59'),
(28, 11, 9, 239, 236, 235, 234, 234, '2026-04-27 13:51:05'),
(29, 11, 10, 236, 240, 244, 243, 244, '2026-04-27 13:51:16'),
(30, 11, 15, 227, 231, 228, 226, 228, '2026-04-27 13:53:16'),
(31, 11, 3, 197, 199, 193, 196, 193, '2026-04-27 13:53:39'),
(32, 11, 18, 266, 264, 236, 252, 264, '2026-04-27 13:55:26'),
(33, 11, 11, 249, 247, 250, 251, 247, '2026-04-27 13:57:47'),
(34, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 13:57:56'),
(35, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:06:31'),
(36, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:07:56'),
(37, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:08:15'),
(38, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:08:22'),
(39, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:08:39'),
(40, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:19:49'),
(41, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:20:14'),
(42, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:20:23'),
(43, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:20:48'),
(44, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:22:12'),
(45, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:23:37'),
(46, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:23:40'),
(47, 11, 8, 231, 230, 226, 228, 230, '2026-04-27 14:24:02'),
(48, 11, 18, 279, 264, 252, 266, 264, '2026-04-27 14:25:00'),
(49, 11, 18, 279, 264, 252, 266, 264, '2026-04-27 14:25:50'),
(50, 11, 7, 194, 195, 223, 188, 194, '2026-04-27 14:25:58'),
(51, 11, 7, 194, 195, 223, 188, 194, '2026-04-27 14:27:40'),
(52, 11, 7, 195, 193, 224, 223, 195, '2026-04-27 14:27:48'),
(53, 11, 16, 268, 237, 236, 250, 250, '2026-04-27 14:27:56'),
(54, 11, 7, 188, 195, 224, 194, 188, '2026-04-27 14:28:26'),
(55, 11, 18, 267, 279, 264, 241, 264, '2026-04-27 14:29:28'),
(56, 11, 18, 264, 241, 252, 279, 241, '2026-04-27 14:29:35'),
(57, 11, 12, 256, 254, 253, 259, 256, '2026-04-27 14:30:30'),
(58, 1, 4, 205, 178, 204, 179, 205, '2026-04-27 14:31:40'),
(59, 1, 5, 207, 213, 209, 210, 213, '2026-04-27 14:31:50'),
(60, 1, 6, 197, 218, 196, 193, 197, '2026-04-27 14:32:16'),
(61, 1, 4, 203, 179, 201, 178, 179, '2026-04-27 14:32:47'),
(62, 1, 4, 203, 179, 201, 178, 179, '2026-04-27 14:33:38'),
(63, 1, 3, 194, 196, 193, 197, 193, '2026-04-27 14:34:29'),
(64, 1, 5, 199, 213, 208, 210, 213, '2026-04-27 14:35:36'),
(65, 1, 5, 199, 213, 208, 210, 213, '2026-04-27 14:36:49'),
(66, 1, 4, 202, 203, 178, 179, 179, '2026-04-27 14:38:30'),
(67, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:40:20'),
(68, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:40:31'),
(69, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:11'),
(70, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:12'),
(71, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:13'),
(72, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:13'),
(73, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:13'),
(74, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:14'),
(75, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:14'),
(76, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:14'),
(77, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:14'),
(78, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:15'),
(79, 1, 4, 202, 178, 179, 201, 179, '2026-04-27 14:42:15'),
(80, 1, 6, 215, 195, 193, 218, 218, '2026-04-27 14:42:33'),
(81, 1, 6, 196, 197, 218, 193, 196, '2026-04-27 14:48:49'),
(82, 1, 6, 196, 197, 218, 193, 196, '2026-04-27 14:51:06'),
(83, 1, 6, 196, 197, 218, 193, 196, '2026-04-27 14:51:24'),
(84, 1, 6, 193, 195, 196, 197, 197, '2026-04-27 14:51:29'),
(85, 1, 6, 193, 215, 196, 218, 218, '2026-04-27 14:52:34'),
(86, 1, 4, 179, 201, 203, 204, 204, '2026-04-27 14:53:00'),
(87, 1, 4, 205, 203, 178, 179, 205, '2026-04-27 14:59:00'),
(88, 11, 5, 213, 207, 199, 210, 207, '2026-04-27 15:44:15'),
(89, 11, 14, 267, 266, 269, 256, 269, '2026-04-27 15:44:32'),
(90, 11, 4, 204, 179, 201, 205, 205, '2026-04-27 16:07:35'),
(91, 11, 4, 179, 205, 201, 178, 179, '2026-04-27 16:19:17'),
(92, 11, 4, 179, 178, 203, 204, 178, '2026-04-27 16:22:08'),
(93, 11, 4, 179, 178, 203, 204, 178, '2026-04-27 16:25:20'),
(94, 11, 4, 179, 178, 203, 204, 178, '2026-04-27 16:26:15'),
(95, 11, 4, 203, 179, 201, 204, 204, '2026-04-27 19:03:36'),
(96, 101, 9, 241, 237, 236, 251, 237, '2026-04-28 15:06:53'),
(97, 101, 14, 264, 266, 256, 267, 256, '2026-04-28 15:08:18'),
(98, 101, 12, 253, 255, 259, 257, 253, '2026-04-28 15:08:30'),
(99, 101, 6, 218, 215, 196, 193, 218, '2026-04-28 15:08:35'),
(100, 101, 17, 260, 278, 274, 266, 274, '2026-04-28 15:08:50'),
(101, 101, 8, 227, 230, 228, 226, 228, '2026-04-28 15:08:57'),
(102, 101, 10, 236, 240, 242, 245, 236, '2026-04-28 15:09:03'),
(103, 101, 12, 257, 255, 256, 253, 255, '2026-04-28 15:09:33'),
(104, 1, 3, 199, 193, 195, 196, 199, '2026-04-29 14:06:06'),
(105, 1, 3, 196, 197, 193, 198, 197, '2026-04-29 14:15:32'),
(106, 1, 6, 193, 215, 196, 197, 197, '2026-04-29 14:22:26'),
(107, 101, 15, 227, 231, 270, 226, 226, '2026-04-29 14:59:05'),
(108, 101, 1, 182, 180, 178, 181, 178, '2026-04-29 14:59:44'),
(109, 101, 9, 239, 238, 236, 234, 234, '2026-04-29 14:59:59'),
(110, 101, 5, 199, 208, 213, 207, 207, '2026-04-29 15:00:11'),
(111, 101, 14, 264, 266, 268, 256, 256, '2026-04-29 15:00:33'),
(112, 101, 19, 281, 288, 289, 291, 281, '2026-04-29 15:01:19'),
(113, 101, 20, 302, 305, 298, 295, 295, '2026-04-29 15:02:16'),
(114, 101, 4, 205, 202, 204, 179, 179, '2026-04-29 15:02:36'),
(115, 101, 16, 237, 255, 236, 251, 237, '2026-04-29 15:02:57'),
(116, 101, 3, 195, 198, 196, 193, 193, '2026-04-29 15:03:28'),
(117, 101, 18, 267, 279, 264, 241, 264, '2026-04-29 15:03:39'),
(118, 101, 21, 310, 313, 311, 307, 307, '2026-04-29 15:03:56'),
(119, 101, 2, 186, 190, 189, 182, 189, '2026-04-29 15:04:15'),
(120, 101, 15, 228, 231, 227, 226, 228, '2026-04-29 15:04:28');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `temakorok`
--

CREATE TABLE `temakorok` (
  `id` int(11) NOT NULL,
  `temaNev` varchar(32) NOT NULL,
  `temaLeiras` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `temakorok`
--

INSERT INTO `temakorok` (`id`, `temaNev`, `temaLeiras`) VALUES
(1, 'Zene', 'Zenei előadók, szerzők, zenei számok'),
(2, 'Film', 'Filmek, jelenetek, színészekk és alkotók');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `valaszok`
--

CREATE TABLE `valaszok` (
  `id` int(11) NOT NULL,
  `valaszSzoveg` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `valaszok`
--

INSERT INTO `valaszok` (`id`, `valaszSzoveg`) VALUES
(1, '... a feszültségtől és az ellenállástól függ'),
(2, '... állandó'),
(6, '... az ellenállástól és a feszültségtol függ'),
(5, '... csak a feszültségtol függ'),
(4, '... csak az ellenállástól függ'),
(7, '... folyamatosan csökken'),
(3, '... folyamatosan emelkedik'),
(20, '.7z'),
(16, '.avi'),
(14, '.bat'),
(15, '.com'),
(19, '.dat'),
(12, '.exe'),
(13, '.msi'),
(21, '.rar'),
(17, '.txt'),
(18, '.zip'),
(281, 'A légy'),
(63, 'A lerakódott por túlmelegedést okozhat'),
(64, 'A lerakódott por zárlatot okozhat'),
(61, 'A mai PC-k teljesen zártak, nem szükséges portalanítani'),
(276, 'A méhész'),
(277, 'A melós'),
(275, 'A pusztító'),
(274, 'A specialista'),
(247, 'A szabadság útjai'),
(278, 'A szállító'),
(292, 'A tizedes meg a többiek'),
(203, 'Abba'),
(65, 'adatbeágyazás'),
(191, 'Airbourne'),
(59, 'alaplap'),
(202, 'Alice Cooper'),
(239, 'Alien'),
(227, 'Andrew Vajna'),
(32, 'Android'),
(27, 'Asztali számítógép'),
(264, 'Avatar'),
(268, 'Batman'),
(183, 'Beatles'),
(211, 'Benkő László'),
(218, 'Bergendy'),
(51, 'billentyűzet'),
(180, 'Black Sabbath'),
(306, 'Blue Sky Studios'),
(205, 'Bon Jovi'),
(41, 'Böngészési elozmények kezelése'),
(23, 'Böngészo'),
(177, 'Böngésző'),
(243, 'Casino'),
(295, 'Columbia Pictures'),
(62, 'Csak akkor kell portalanítani PC-t, ha működési hibát tapasztalunk'),
(313, 'családi film'),
(229, 'David Lynch'),
(181, 'Deep Purple'),
(66, 'dekódolás'),
(213, 'Demjén Ferenc'),
(310, 'dokumentumfilm'),
(299, 'DreamWorks'),
(261, 'Dumb és Dumber'),
(262, 'Dupla dinamit'),
(235, 'E.T.'),
(280, 'Edda'),
(56, 'egér'),
(290, 'Eldorádó'),
(254, 'Elfújta a szél'),
(49, 'érintőképernyő'),
(36, 'Fájlkezelés'),
(37, 'Felhasználókezelés'),
(11, 'Forrás'),
(40, 'Fotók mentése'),
(244, 'Fűrész'),
(270, 'George Lucas'),
(265, 'Gyűrűk Ura'),
(60, 'Ha poros a belső felület, az elsősorban esztétikai probléma'),
(251, 'Hair'),
(57, 'hálózati kártya'),
(53, 'hangszóró'),
(296, 'Hanna-Barbera Studio'),
(294, 'Hannibál tanár úr'),
(224, 'Hobo Blues Band'),
(246, 'Hulk'),
(279, 'Hupikék törpikék'),
(22, 'Ikon'),
(194, 'Illés'),
(174, 'Indító ikon'),
(184, 'INXS'),
(33, 'iOS'),
(204, 'Iron Maiden'),
(176, 'Izé'),
(228, 'James Cameron'),
(42, 'Játékok frissítése'),
(269, 'Jumanji'),
(256, 'Jurassic Park'),
(50, 'kamera'),
(308, 'katasztrófalilm'),
(272, 'Katonák voltunk'),
(173, 'kedves szerint változik'),
(255, 'Kelly hősei'),
(250, 'Keresztapa'),
(44, 'kernel'),
(208, 'Kóbor János'),
(69, 'kódolás'),
(293, 'Kontroll'),
(291, 'Körhinta'),
(25, 'Kurzor'),
(29, 'Laptop'),
(179, 'Led Zeppelin'),
(195, 'LGT'),
(34, 'MacOS'),
(258, 'Macskajaj'),
(257, 'Magyar vándor'),
(238, 'Majmok bolygója'),
(236, 'Mask'),
(266, 'Mátrix'),
(286, 'Megáll az idő'),
(10, 'Meghajtó'),
(35, 'Memóriakezelés'),
(175, 'Menüsor'),
(282, 'Mephisto'),
(188, 'Metallica'),
(198, 'Metro'),
(304, 'MGM'),
(31, 'Microsoft Windows'),
(54, 'mikrofon'),
(284, 'Mindenki'),
(215, 'Mini'),
(26, 'Mobiltelefon'),
(207, 'Nagy Feró'),
(201, 'Nazareth'),
(303, 'New Line Cinema'),
(187, 'Nightwish'),
(234, 'Nincs kettő négy nélkül'),
(230, 'Oliver Stone'),
(193, 'Omega'),
(298, 'Paramount Pictures'),
(24, 'Parancsikon'),
(48, 'parancssor'),
(38, 'Particionálás'),
(190, 'Pendulum'),
(182, 'Pink Floyd'),
(297, 'Pixar'),
(210, 'Presszer Gábor'),
(260, 'Pretty Woman'),
(58, 'processzor'),
(8, 'Prompt'),
(311, 'pszichothriller'),
(178, 'Queen'),
(273, 'Rambo'),
(186, 'Ramstein'),
(46, 'rendszerburok'),
(45, 'rendszerhéj'),
(43, 'rendszermag'),
(248, 'Reszkessetek betörők'),
(231, 'Ridley Scott'),
(263, 'Rocky'),
(307, 'romantikus filmdráma'),
(288, 'Sátántangó'),
(283, 'Saul fia'),
(185, 'Scoprions'),
(271, 'Sergio Leone'),
(47, 'shell'),
(223, 'Skoripó'),
(172, 'Sokk'),
(237, 'Star Wars'),
(9, 'Startpont'),
(226, 'Steven Spielberg'),
(189, 'Sweet'),
(285, 'Szegénylegények'),
(67, 'szekvencia'),
(249, 'Szerelmünk lapjai'),
(28, 'Szerver számítógép'),
(287, 'Szinbád'),
(267, 'Szörnyecskék'),
(30, 'Tablet'),
(252, 'Támad a Mars'),
(197, 'Tátrai Band'),
(209, 'Tátrai Tibor'),
(241, 'Terminátor'),
(242, 'Titanic'),
(39, 'Tömörítés'),
(68, 'töredezettség'),
(305, 'TriStar Pictures'),
(52, 'újlenyomat-olvasó'),
(300, 'Universal Pictures'),
(196, 'V-Motorock'),
(289, 'Valahol Európában'),
(55, 'videókártya'),
(309, 'vígjáték'),
(253, 'Volt egyszer egy vadnyugat'),
(302, 'Walt Disney Pictures'),
(301, 'Warner Bros. Pictures'),
(312, 'westernfilm'),
(259, 'Wild Wild West - Vadiúj vadnyugat'),
(240, 'X-akták'),
(199, 'Zorán'),
(245, 'Zöld lámpás');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kerdesek`
--
ALTER TABLE `kerdesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temaID` (`temaID`),
  ADD KEY `rogzitoID` (`rogzitoID`),
  ADD KEY `ellID` (`ellenorID`);

--
-- A tábla indexei `kerdesvalasz`
--
ALTER TABLE `kerdesvalasz`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kerdesID` (`kerdesID`,`valaszID`),
  ADD KEY `kerdID` (`kerdesID`),
  ADD KEY `valId` (`valaszID`);

--
-- A tábla indexei `kitoltesek`
--
ALTER TABLE `kitoltesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhID` (`felhID`),
  ADD KEY `kerdID` (`kerdID`),
  ADD KEY `v1ID` (`v1ID`),
  ADD KEY `v2ID` (`v2ID`),
  ADD KEY `v3ID` (`v3ID`),
  ADD KEY `v4ID` (`v4ID`),
  ADD KEY `vuID` (`vuID`);

--
-- A tábla indexei `temakorok`
--
ALTER TABLE `temakorok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `valaszok`
--
ALTER TABLE `valaszok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `valaszSzoveg` (`valaszSzoveg`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT a táblához `kerdesek`
--
ALTER TABLE `kerdesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT a táblához `kerdesvalasz`
--
ALTER TABLE `kerdesvalasz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT a táblához `kitoltesek`
--
ALTER TABLE `kitoltesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT a táblához `valaszok`
--
ALTER TABLE `valaszok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `kerdesek`
--
ALTER TABLE `kerdesek`
  ADD CONSTRAINT `kerdesek_ibfk_1` FOREIGN KEY (`temaID`) REFERENCES `temakorok` (`id`),
  ADD CONSTRAINT `kerdesek_ibfk_2` FOREIGN KEY (`rogzitoID`) REFERENCES `felhasznalok` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kerdesek_ibfk_3` FOREIGN KEY (`ellenorID`) REFERENCES `felhasznalok` (`id`) ON UPDATE CASCADE;

--
-- Megkötések a táblához `kerdesvalasz`
--
ALTER TABLE `kerdesvalasz`
  ADD CONSTRAINT `kerdesvalasz_ibfk_1` FOREIGN KEY (`kerdesID`) REFERENCES `kerdesek` (`id`),
  ADD CONSTRAINT `kerdesvalasz_ibfk_2` FOREIGN KEY (`valaszID`) REFERENCES `valaszok` (`id`);

--
-- Megkötések a táblához `kitoltesek`
--
ALTER TABLE `kitoltesek`
  ADD CONSTRAINT `kitoltesek_ibfk_1` FOREIGN KEY (`felhID`) REFERENCES `felhasznalok` (`id`),
  ADD CONSTRAINT `kitoltesek_ibfk_2` FOREIGN KEY (`kerdID`) REFERENCES `kerdesek` (`id`),
  ADD CONSTRAINT `kitoltesek_ibfk_3` FOREIGN KEY (`v1ID`) REFERENCES `valaszok` (`id`),
  ADD CONSTRAINT `kitoltesek_ibfk_4` FOREIGN KEY (`v2ID`) REFERENCES `valaszok` (`id`),
  ADD CONSTRAINT `kitoltesek_ibfk_5` FOREIGN KEY (`v3ID`) REFERENCES `valaszok` (`id`),
  ADD CONSTRAINT `kitoltesek_ibfk_6` FOREIGN KEY (`v4ID`) REFERENCES `valaszok` (`id`),
  ADD CONSTRAINT `kitoltesek_ibfk_7` FOREIGN KEY (`vuID`) REFERENCES `valaszok` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
