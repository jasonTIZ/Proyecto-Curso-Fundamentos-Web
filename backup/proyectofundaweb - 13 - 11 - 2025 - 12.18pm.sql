-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2025 a las 19:18:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_negocios`
--

CREATE DATABASE IF NOT EXISTS sistema_negocios;
USE sistema_negocios;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_negocio`
--

CREATE TABLE `categoria_negocio` (
  `id_categoria_negocio` int(11) NOT NULL,
  `nombre_categoria` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_negocio`
--

INSERT INTO `categoria_negocio` (`id_categoria_negocio`, `nombre_categoria`, `descripcion`) VALUES
(1, 'Supermercado', 'Venta de alimentos y artículos básicos para el hogar'),
(2, 'Restaurante', 'Comida preparada y bebidas'),
(3, 'Panadería', 'Venta de pan, repostería y café'),
(4, 'Ferretería', 'Herramientas, materiales y artículos de mantenimiento'),
(5, 'Tienda de Ropa', 'Venta de prendas y accesorios de vestir'),
(6, 'Electrónica', 'Venta y reparación de artículos electrónicos'),
(7, 'Tienda de Mascotas', 'Comida y productos para animales'),
(8, 'Verdulería', 'Venta de frutas y verduras frescas'),
(9, 'Cafetería', 'Bebidas calientes, repostería y snacks'),
(10, 'Salón de Belleza', 'Cuidado capilar, uñas y estética');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`id_categoria`, `nombre_categoria`, `descripcion`) VALUES
(1, 'Bebidas', 'Refrescos, jugos, cervezas y otras bebidas embotelladas'),
(2, 'Panadería', 'Productos horneados como pan, pasteles y galletas'),
(3, 'Carnes', 'Cortes de carne, embutidos y productos cárnicos procesados'),
(4, 'Lácteos', 'Leche, queso, yogures y derivados'),
(5, 'Frutas y Verduras', 'Productos agrícolas frescos'),
(6, 'Electrónica', 'Artículos electrónicos y accesorios'),
(7, 'Ropa', 'Vestimenta para hombres, mujeres y niños'),
(8, 'Ferretería', 'Herramientas, materiales de construcción y pintura'),
(9, 'Mascotas', 'Comida y accesorios para animales domésticos'),
(10, 'Belleza', 'Cosméticos y productos de cuidado personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio`
--

CREATE TABLE `negocio` (
  `id_negocio` int(11) NOT NULL,
  `nombre_negocio` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `canton` varchar(100) DEFAULT NULL,
  `distrito` varchar(100) DEFAULT NULL,
  `barrio` varchar(100) DEFAULT NULL,
  `otras_senas` text DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `tiktok_url` varchar(255) DEFAULT NULL,
  `iframe_ubicacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `negocio`
--

INSERT INTO `negocio` (`id_negocio`, `nombre_negocio`, `descripcion`, `provincia`, `canton`, `distrito`, `barrio`, `otras_senas`, `telefono`, `email`, `facebook_url`, `instagram_url`, `tiktok_url`, `iframe_ubicacion`) VALUES
(1, 'Supermercado El Pueblo', 'Supermercado con productos locales y frescos.', 'San José', 'Central', 'Carmen', 'Centro', 'Frente al parque central', '2221-3344', 'contacto@elpueblo.cr', 'https://facebook.com/elpueblo', 'https://instagram.com/elpueblo', NULL, NULL),
(2, 'Restaurante La Casona', 'Comida típica costarricense con ambiente familiar.', 'Alajuela', 'Central', 'San José', 'La Agonía', 'Diagonal a la iglesia', '2431-2288', 'lacasona@gmail.com', 'https://facebook.com/lacasona', NULL, NULL, NULL),
(3, 'Panadería Delicia', 'Pan artesanal y repostería fina.', 'Cartago', 'Oriental', 'Agua Caliente', 'El Molino', '100 m norte de la escuela', '2552-6633', 'info@delicia.cr', 'https://facebook.com/delicia', 'https://instagram.com/panaderiadelicia', NULL, NULL),
(4, 'Ferretería El Tornillo', 'Todo en herramientas y materiales de construcción.', 'Heredia', 'Belén', 'La Ribera', 'Centro', 'Frente a la plaza', '2239-1155', 'ventas@eltornillo.cr', NULL, NULL, NULL, NULL),
(5, 'Moda Urbana', 'Ropa moderna y accesorios juveniles.', 'San José', 'Desamparados', 'San Rafael', 'Centro', 'Contiguo al parque', '2275-4499', 'modaurbana@outlook.com', 'https://facebook.com/modaurbana', 'https://instagram.com/modaurbana', NULL, NULL),
(6, 'ElectroTech', 'Venta de celulares, audífonos y accesorios tecnológicos.', 'Alajuela', 'Grecia', 'San Isidro', 'Centro', 'Costado este del parque', '2444-8899', 'soporte@electrotech.cr', 'https://facebook.com/electrotech', 'https://instagram.com/electrotech', NULL, NULL),
(7, 'PetWorld', 'Comida, juguetes y servicios para mascotas.', 'Cartago', 'La Unión', 'Tres Ríos', 'Centro', 'Frente al Mas x Menos', '2278-9055', 'contacto@petworld.cr', 'https://facebook.com/petworld', 'https://instagram.com/petworld', NULL, NULL),
(8, 'Verduras Frescas', 'Venta de frutas y verduras locales y orgánicas.', 'San José', 'Escazú', 'San Rafael', 'Centro', '50 m sur del BAC', '2289-7766', 'info@verdurasfrescas.cr', NULL, NULL, NULL, NULL),
(9, 'Café Aromas', 'Café 100% costarricense y repostería artesanal.', 'Heredia', 'Santo Domingo', 'Santo Tomás', 'Centro', 'Frente al gimnasio', '2235-4412', 'aromas@cafecr.com', 'https://facebook.com/cafearomas', NULL, NULL, NULL),
(10, 'Belleza Total', 'Salón de belleza y estética profesional.', 'Puntarenas', 'Central', 'Barranca', 'Centro', 'Junto a la farmacia La Luz', '2661-2280', 'bellezatotal@gmail.com', 'https://facebook.com/bellezatotal', 'https://instagram.com/bellezatotal', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio_categoria_rel`
--

CREATE TABLE `negocio_categoria_rel` (
  `id_rel` int(11) NOT NULL,
  `id_negocio` int(11) NOT NULL,
  `id_categoria_negocio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `negocio_categoria_rel`
--

INSERT INTO `negocio_categoria_rel` (`id_rel`, `id_negocio`, `id_categoria_negocio`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 9, 9),
(10, 10, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio_imagen`
--

CREATE TABLE `negocio_imagen` (
  `id_imagen_negocio` int(11) NOT NULL,
  `id_negocio` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `negocio_imagen`
--

INSERT INTO `negocio_imagen` (`id_imagen_negocio`, `id_negocio`, `url_imagen`) VALUES
(1, 1, 'https://picsum.photos/seed/elpueblo/800/450'),
(2, 2, 'https://picsum.photos/seed/lacasona/800/450'),
(3, 3, 'https://picsum.photos/seed/delicia/800/450'),
(4, 4, 'https://picsum.photos/seed/eltornillo/800/450'),
(5, 5, 'https://picsum.photos/seed/modaurbana/800/450'),
(6, 6, 'https://picsum.photos/seed/electrotech/800/450'),
(7, 7, 'https://picsum.photos/seed/petworld/800/450'),
(8, 8, 'https://picsum.photos/seed/verdurasfrescas/800/450'),
(9, 9, 'https://picsum.photos/seed/cafearomas/800/450'),
(10, 10, 'https://picsum.photos/seed/bellezatotal/800/450'),
(11, 1, 'https://picsum.photos/seed/elpueblo2/800/450'),
(12, 2, 'https://picsum.photos/seed/lacasona2/800/450'),
(13, 3, 'https://picsum.photos/seed/delicia2/800/450'),
(14, 4, 'https://picsum.photos/seed/eltornillo2/800/450'),
(15, 5, 'https://picsum.photos/seed/modaurbana2/800/450'),
(16, 6, 'https://picsum.photos/seed/electrotech2/800/450'),
(17, 7, 'https://picsum.photos/seed/petworld2/800/450'),
(18, 8, 'https://picsum.photos/seed/verdurasfrescas2/800/450'),
(19, 9, 'https://picsum.photos/seed/cafearomas2/800/450'),
(20, 10, 'https://picsum.photos/seed/bellezatotal2/800/450');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(150) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_negocio` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `id_categoria`, `id_negocio`, `precio`, `descripcion`) VALUES
(1, 'Coca-Cola 600ml', 1, 1, 950.00, 'Bebida gaseosa en botella plástica'),
(2, 'Pan Baguette', 2, 3, 1200.00, 'Pan artesanal horneado cada mañana'),
(3, 'Queso Turrialba', 4, 1, 2800.00, 'Queso blanco fresco costarricense'),
(4, 'Café Molido Aromas 500g', 1, 9, 4500.00, 'Café tostado y molido de altura media'),
(5, 'Camiseta Oversize', 7, 5, 7500.00, 'Camiseta unisex de algodón'),
(6, 'Martillo Stanley', 8, 4, 6500.00, 'Martillo de acero con mango ergonómico'),
(7, 'Collar para Perro Mediano', 9, 7, 3200.00, 'Collar ajustable para perro mediano'),
(8, 'Tomates Frescos 1kg', 5, 8, 1500.00, 'Tomates rojos orgánicos de la zona'),
(9, 'Audífonos Bluetooth', 6, 6, 18900.00, 'Audífonos inalámbricos con micrófono'),
(10, 'Shampoo de Keratina 500ml', 10, 10, 6800.00, 'Shampoo profesional para cabello dañado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagen`
--

CREATE TABLE `producto_imagen` (
  `id_imagen` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_imagen`
--

INSERT INTO `producto_imagen` (`id_imagen`, `id_producto`, `url_imagen`) VALUES
(1, 1, 'https://picsum.photos/seed/coca/400/400'),
(2, 2, 'https://picsum.photos/seed/baguette/400/400'),
(3, 3, 'https://picsum.photos/seed/queso/400/400'),
(4, 4, 'https://picsum.photos/seed/cafe/400/400'),
(5, 5, 'https://picsum.photos/seed/camiseta/400/400'),
(6, 6, 'https://picsum.photos/seed/martillo/400/400'),
(7, 7, 'https://picsum.photos/seed/collar/400/400'),
(8, 8, 'https://picsum.photos/seed/tomates/400/400'),
(9, 9, 'https://picsum.photos/seed/audifonos/400/400'),
(10, 10, 'https://picsum.photos/seed/shampoo/400/400');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_webmaster`
--

CREATE TABLE `usuario_webmaster` (
  `id_webmaster` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_webmaster`
--

INSERT INTO `usuario_webmaster` (`id_webmaster`, `nombre`, `apellido1`, `apellido2`, `email`, `telefono`, `contrasena`, `fecha_creacion`) VALUES
(1, 'jeycob', 'barrientos', 'garcia', 'jbr@gmail.com', '44556699', 'JBR17122**', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_negocio`
--
ALTER TABLE `categoria_negocio`
  ADD PRIMARY KEY (`id_categoria_negocio`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `negocio`
--
ALTER TABLE `negocio`
  ADD PRIMARY KEY (`id_negocio`);

--
-- Indices de la tabla `negocio_categoria_rel`
--
ALTER TABLE `negocio_categoria_rel`
  ADD PRIMARY KEY (`id_rel`),
  ADD KEY `id_negocio` (`id_negocio`),
  ADD KEY `id_categoria_negocio` (`id_categoria_negocio`);

--
-- Indices de la tabla `negocio_imagen`
--
ALTER TABLE `negocio_imagen`
  ADD PRIMARY KEY (`id_imagen_negocio`),
  ADD KEY `id_negocio` (`id_negocio`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_negocio` (`id_negocio`);

--
-- Indices de la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuario_webmaster`
--
ALTER TABLE `usuario_webmaster`
  ADD PRIMARY KEY (`id_webmaster`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_negocio`
--
ALTER TABLE `categoria_negocio`
  MODIFY `id_categoria_negocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `negocio`
--
ALTER TABLE `negocio`
  MODIFY `id_negocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `negocio_categoria_rel`
--
ALTER TABLE `negocio_categoria_rel`
  MODIFY `id_rel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `negocio_imagen`
--
ALTER TABLE `negocio_imagen`
  MODIFY `id_imagen_negocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario_webmaster`
--
ALTER TABLE `usuario_webmaster`
  MODIFY `id_webmaster` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `negocio_categoria_rel`
--
ALTER TABLE `negocio_categoria_rel`
  ADD CONSTRAINT `negocio_categoria_rel_ibfk_1` FOREIGN KEY (`id_negocio`) REFERENCES `negocio` (`id_negocio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `negocio_categoria_rel_ibfk_2` FOREIGN KEY (`id_categoria_negocio`) REFERENCES `categoria_negocio` (`id_categoria_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `negocio_imagen`
--
ALTER TABLE `negocio_imagen`
  ADD CONSTRAINT `negocio_imagen_ibfk_1` FOREIGN KEY (`id_negocio`) REFERENCES `negocio` (`id_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_producto` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_negocio`) REFERENCES `negocio` (`id_negocio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  ADD CONSTRAINT `producto_imagen_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
