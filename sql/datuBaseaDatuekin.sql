-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 09:12:34
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `3wag2e1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ekipamendua`
--

CREATE TABLE `ekipamendua` (
  `id` int(11) NOT NULL,
  `izena` varchar(50) NOT NULL,
  `deskribapena` varchar(200) NOT NULL,
  `marka` varchar(20) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `idKategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ekipamendua`
--

INSERT INTO `ekipamendua` (`id`, `izena`, `deskribapena`, `marka`, `modelo`, `stock`, `idKategoria`) VALUES
(1, 'ASUS TUF Gaming F15', 'Intel Core i5-11400H/16GB/512GB SSD/RTX 3050/15.6', 'ASUS', 'FX506HC-HN004', 4, 4),
(2, 'HP Victus 5L', 'Intel® Core™ i5-12400F, 16GB RAM, 512GB SSD, RTX™ 3060, W11 H, Plata', 'HP', 'TG02-0087ns', 2, 1),
(3, 'HP Victus 15L', 'Intel® Core™ i5-12400F, 16GB RAM, 512GB SSD, GTX 1650, W11 Home, Plata Mica', 'HP', 'TG02-0045ns', 3, 1),
(4, 'HP Victus', 'Intel® Core™ i5-12400F, 16GB RAM, 512GB SSD, RTX™ 3050, Windows 11 Home, Plata', 'HP', 'TG02-0145ns', 1, 1),
(5, 'Samsung Monitor Essential', '24\", Full-HD, IPS, 5 ms, 75Hz, Negro', 'Samsung', 'LS24C310EAUXEN', 2, 2),
(6, 'Xiaomi Mi Desktop', '27\" EU, Full HD, IPS, 6 ms, 75 Hz, 300 cd/m², Negro', 'Xiaomi', 'OB02608', 1, 2),
(7, 'Samsung The Freestyle', 'Full-HD, Smart TV hasta 100\", Diseño 360º, Calibración Automática, Blanco', 'Samsung', 'SP-LFF3CLAXXXE', 1, 3),
(8, 'Picasso PRIXTON', '1920 x 1080, 50000 h / -, Full-HD, Blanco\r\n', 'PRIXTON', 'Picasso', 1, 3),
(9, 'Acer Chromebook Plus 514', '14\" WUXGA, AMD Ryzen™ 5 7520C, 8GB RAM, 256GB SSD, Radeon™ 610M, Google ChromeOS', 'Acer', 'CB514-3H-R88J', 1, 4),
(10, 'Mini-PC - B7POWER BMAX', 'Intel® Core™ i7-11390H con una frecuencia base de 3,4 GHz y una frecuencia de ráfaga de 5,0 GHz, 4 núcleos 8 hilos., 16 GB, 1 TB, Iris® Xe, Negro', 'BMAX', 'B7 Power', 1, 5),
(11, 'APPLE Mac Studio', 'Chip M1 Max, 512 GB, CPU 10 núcleos, GPU de 24 núcleos y Neural Engine de 16 núcleos, Gris', 'Apple', 'MJMV3Y', 1, 5),
(12, 'Router WiFi - TP-Link TL-MR6400', '4G LTE, 300 Mbps, 2 antenas, Ethernet, Control Parental, Negro', 'TP-Link', 'TL-MR6400', 1, 6),
(13, 'Google Nest WiFi Pro', '4.2 gbit/s, MU-MIMO, Blanco, 0.45 kg', 'Google', 'GA03030-EU', 2, 6),
(14, 'Pack Teclado + Ratón - Logitech MK540 Advanced', 'Inalámbrico, Bluetooth, USB, Negro', 'Logitech', 'MK540 Advanced', 30, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `erabiltzailea`
--

CREATE TABLE `erabiltzailea` (
  `nan` varchar(9) NOT NULL,
  `izena` varchar(20) NOT NULL,
  `abizena` varchar(50) NOT NULL,
  `erabiltzailea` varchar(20) NOT NULL,
  `pasahitza` varchar(20) NOT NULL,
  `rola` char(1) NOT NULL,
  `irudia` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `erabiltzailea`
--

INSERT INTO `erabiltzailea` (`nan`, `izena`, `abizena`, `erabiltzailea`, `pasahitza`, `rola`, `irudia`) VALUES
('20977261L', 'Jon', 'Caballero', 'jcaballero', '12345678', '0', '../img/avatar/20977261l.jpg'),
('22756064W', 'Natalia', 'Lamego', 'nlamego', '12345678', '1', '../img/avatar/22756064w.jpg'),
('45750866W', 'Asier', 'Fernandez', 'afernandez', '12345678', '1', '../img/avatar/45750866w.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gela`
--

CREATE TABLE `gela` (
  `id` int(11) NOT NULL,
  `izena` varchar(4) NOT NULL,
  `taldea` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gela`
--

INSERT INTO `gela` (`id`, `izena`, `taldea`) VALUES
(1, 'A208', '3WAG2'),
(2, 'A207', '3WAG1'),
(3, 'A206', '3PAG1'),
(4, 'A205', '2MSS2'),
(5, 'A204', '2MSS1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inbentarioa`
--

CREATE TABLE `inbentarioa` (
  `etiketa` varchar(10) NOT NULL,
  `idEkipamendu` int(11) NOT NULL,
  `erosketaData` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inbentarioa`
--

INSERT INTO `inbentarioa` (`etiketa`, `idEkipamendu`, `erosketaData`) VALUES
('0PI0JCYZPM', 1, '2023-11-10'),
('4GCRJLDOD4', 1, '2023-11-10'),
('ABC1234', 1, '2023-11-03'),
('ABC1235', 1, '2023-11-03'),
('ABC1236', 2, '2023-11-01'),
('ABC1237', 3, '2023-10-04'),
('ABC1238', 3, '2023-09-06'),
('ABC1239', 4, '2023-10-16'),
('ABC1240', 5, '2023-10-17'),
('ABC1241', 5, '2023-10-15'),
('ABC1242', 6, '2023-10-07'),
('ABC1243', 7, '2022-11-02'),
('ABC1244', 8, '2023-10-15'),
('ABC1245', 9, '2023-11-01'),
('ABC1246', 10, '2023-10-24'),
('ABC1247', 11, '2021-11-06'),
('ABC1248', 12, '2023-09-10'),
('ABC1249', 13, '2023-08-05'),
('ABC1250', 13, '2023-09-02'),
('GZECGBI7HY', 2, '2023-11-10'),
('HJA4L1H5C4', 3, '2023-11-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(11) NOT NULL,
  `izena` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `kategoria`
--

INSERT INTO `kategoria` (`id`, `izena`) VALUES
(1, 'Ordenagailu'),
(2, 'Pantaila'),
(3, 'Proiektore'),
(4, 'Portatil'),
(5, 'Mini-PC'),
(6, 'Router'),
(7, 'Periferiko');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kokalekua`
--

CREATE TABLE `kokalekua` (
  `etiketa` varchar(10) NOT NULL,
  `idGela` int(11) NOT NULL,
  `hasieraData` date NOT NULL,
  `amaieraData` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `kokalekua`
--

INSERT INTO `kokalekua` (`etiketa`, `idGela`, `hasieraData`, `amaieraData`) VALUES
('0PI0JCYZPM', 1, '2023-11-10', '2023-11-12'),
('ABC1234', 5, '2023-10-01', NULL),
('ABC1235', 1, '2023-11-03', '2023-11-10'),
('ABC1236', 2, '2023-10-01', '2023-11-03'),
('ABC1236', 3, '2023-11-03', NULL),
('ABC1237', 3, '2023-09-01', '2023-11-01'),
('ABC1238', 4, '2023-10-01', NULL),
('ABC1239', 5, '2023-11-05', NULL),
('ABC1240', 1, '2023-06-01', NULL),
('ABC1241', 1, '2023-09-03', '2023-11-01'),
('ABC1241', 2, '2023-11-03', NULL),
('ABC1242', 2, '2023-09-07', NULL),
('ABC1243', 3, '2023-08-12', NULL),
('ABC1244', 3, '2021-11-12', NULL),
('ABC1245', 4, '2023-08-09', NULL),
('ABC1246', 5, '2023-11-01', '2023-11-03'),
('ABC1247', 1, '2023-10-07', '2023-11-15'),
('ABC1248', 3, '2023-07-13', NULL),
('ABC1249', 4, '2023-09-02', NULL),
('ABC1250', 5, '2023-10-10', '2023-11-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ekipamendua`
--
ALTER TABLE `ekipamendua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategoria` (`idKategoria`);

--
-- Indices de la tabla `erabiltzailea`
--
ALTER TABLE `erabiltzailea`
  ADD PRIMARY KEY (`nan`);

--
-- Indices de la tabla `gela`
--
ALTER TABLE `gela`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inbentarioa`
--
ALTER TABLE `inbentarioa`
  ADD PRIMARY KEY (`etiketa`),
  ADD KEY `fk_ekipamendua` (`idEkipamendu`);

--
-- Indices de la tabla `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `kokalekua`
--
ALTER TABLE `kokalekua`
  ADD PRIMARY KEY (`etiketa`,`hasieraData`),
  ADD KEY `fk_gela` (`idGela`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ekipamendua`
--
ALTER TABLE `ekipamendua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `gela`
--
ALTER TABLE `gela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ekipamendua`
--
ALTER TABLE `ekipamendua`
  ADD CONSTRAINT `fk_kategoria` FOREIGN KEY (`idKategoria`) REFERENCES `kategoria` (`id`);

--
-- Filtros para la tabla `inbentarioa`
--
ALTER TABLE `inbentarioa`
  ADD CONSTRAINT `fk_ekipamendua` FOREIGN KEY (`idEkipamendu`) REFERENCES `ekipamendua` (`id`);

--
-- Filtros para la tabla `kokalekua`
--
ALTER TABLE `kokalekua`
  ADD CONSTRAINT `fk_gela` FOREIGN KEY (`idGela`) REFERENCES `gela` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inbentarioa` FOREIGN KEY (`etiketa`) REFERENCES `inbentarioa` (`etiketa`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
