-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Ara 2020, 19:31:23
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `todo`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `developers`
--

CREATE TABLE `developers` (
  `id` int(255) NOT NULL,
  `developer_name` varchar(255) NOT NULL,
  `time` int(255) NOT NULL,
  `difficulty` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `developers`
--

INSERT INTO `developers` (`id`, `developer_name`, `time`, `difficulty`) VALUES
(1, 'Developer 1', 1, 1),
(2, 'Developer 2', 1, 2),
(3, 'Developer 3', 1, 3),
(4, 'Developer 4', 1, 4),
(5, 'Developer 5', 1, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `provider`
--

CREATE TABLE `provider` (
  `difficulty` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `provider_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `developers`
--
ALTER TABLE `developers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
