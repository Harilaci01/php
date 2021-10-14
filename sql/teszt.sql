-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Okt 14. 13:11
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `teszt`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adminok`
--

CREATE TABLE `adminok` (
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `adminok`
--

INSERT INTO `adminok` (`id`) VALUES
(17);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hianyzok`
--

CREATE TABLE `hianyzok` (
  `id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `hianyzok`
--

INSERT INTO `hianyzok` (`id`) VALUES
(NULL),
(7);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ulesrend`
--

CREATE TABLE `ulesrend` (
  `id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `sor` tinyint(3) UNSIGNED NOT NULL,
  `oszlop` tinyint(3) UNSIGNED NOT NULL,
  `jelszo` varchar(32) CHARACTER SET latin1 NOT NULL,
  `felhasznalo` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `ulesrend`
--

INSERT INTO `ulesrend` (`id`, `nev`, `sor`, `oszlop`, `jelszo`, `felhasznalo`) VALUES
(1, 'Kulhanek László', 1, 1, '', ''),
(2, 'Molnár Gergő', 2, 1, '', ''),
(3, 'Bakcsányi Dominik', 2, 2, '', ''),
(4, 'Füstős Lóránt', 2, 3, '', ''),
(5, 'Orosz Zsolt', 2, 4, '', ''),
(6, 'Harsányi László', 2, 5, 'efc847fa5a386a38fcc9d0573bb87272', 'harilaci'),
(7, '', 2, 6, '', ''),
(8, 'Kereszturi Kevin', 3, 1, '', ''),
(9, 'Juhász Levente', 3, 2, '', ''),
(10, 'Szabó László', 3, 3, '', ''),
(11, 'Sütő Dániel', 3, 4, '', ''),
(12, 'Détári Klaudia', 3, 5, '', ''),
(13, '', 3, 6, '', ''),
(14, 'Fazekas Miklós', 4, 1, '', ''),
(15, '', 4, 2, '', ''),
(16, 'Gombos János', 4, 3, '', ''),
(17, 'Bicsák József', 4, 4, 'd47b837e163f20c78e38a99467b90ccc', 'tanar');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `adminok`
--
ALTER TABLE `adminok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `hianyzok`
--
ALTER TABLE `hianyzok`
  ADD KEY `ibfk_tanulo_id` (`id`);

--
-- A tábla indexei `ulesrend`
--
ALTER TABLE `ulesrend`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `adminok`
--
ALTER TABLE `adminok`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `ulesrend`
--
ALTER TABLE `ulesrend`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `adminok`
--
ALTER TABLE `adminok`
  ADD CONSTRAINT `ibfk_admin_id` FOREIGN KEY (`id`) REFERENCES `ulesrend` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `hianyzok`
--
ALTER TABLE `hianyzok`
  ADD CONSTRAINT `ibfk_tanulo_id` FOREIGN KEY (`id`) REFERENCES `ulesrend` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
