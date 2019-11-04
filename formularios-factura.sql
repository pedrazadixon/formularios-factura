-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 04, 2019 at 02:38 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formularios-factura`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `nit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `razon_social`, `nit`) VALUES
(1, 'SSEND.CO', '999999999'),
(2, 'DAYAX.ML', '888888888');

-- --------------------------------------------------------

--
-- Table structure for table `clientes_datos`
--

CREATE TABLE `clientes_datos` (
  `id` int(11) NOT NULL,
  `tipo` enum('EMAIL','TELEFONO','DIRECCION') NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `dato` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clientes_datos`
--

INSERT INTO `clientes_datos` (`id`, `tipo`, `cliente_id`, `dato`) VALUES
(2, 'DIRECCION', 1, 'cra 2 2 2'),
(3, 'TELEFONO', 1, '6666666'),
(4, 'EMAIL', 1, 'info@ssend.co'),
(5, 'DIRECCION', 1, 'cra 0 0 0');

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` (`id_factura`, `cliente_id`, `fecha`) VALUES
(1000, 1, '2019-11-02 17:10:36'),
(1001, 2, '2019-11-03 20:13:47'),
(1002, 2, '2019-11-03 20:16:33'),
(1003, 1, '2019-11-04 02:18:26'),
(1004, 1, '2019-11-04 02:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `facturas_productos`
--

CREATE TABLE `facturas_productos` (
  `id_facturas_productos` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_factura` int(11) NOT NULL,
  `precio_factura` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facturas_productos`
--

INSERT INTO `facturas_productos` (`id_facturas_productos`, `factura_id`, `producto_id`, `cantidad_factura`, `precio_factura`) VALUES
(1, 1000, 1, 5, 5000),
(2, 1001, 1, 5, 5000),
(3, 1001, 2, 3, 8000),
(4, 1002, 1, 5, 5000),
(5, 1002, 2, 3, 8000),
(6, 1003, 1, 5, 5000),
(7, 1003, 2, 3, 8000),
(8, 1003, 3, 2, 5000),
(9, 1004, 1, 5, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `descripcion`, `precio`, `cantidad`) VALUES
(1, 'ESCOBA', 5000, 5),
(2, 'TRAPERO', 8000, 3),
(3, 'VALDE', 5000, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `clientes_datos`
--
ALTER TABLE `clientes_datos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indexes for table `facturas_productos`
--
ALTER TABLE `facturas_productos`
  ADD PRIMARY KEY (`id_facturas_productos`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clientes_datos`
--
ALTER TABLE `clientes_datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `facturas_productos`
--
ALTER TABLE `facturas_productos`
  MODIFY `id_facturas_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
