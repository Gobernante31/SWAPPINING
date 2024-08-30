-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2024 a las 22:41:30
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
-- Base de datos: `swappining`
--
CREATE DATABASE IF NOT EXISTS `swappining` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `swappining`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `idcalificaciones` int(11) NOT NULL,
  `comentarios` varchar(300) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chats`
--

CREATE TABLE `chats` (
  `idchats` int(11) NOT NULL,
  `fechaYhora` datetime(6) DEFAULT NULL,
  `mensajesEnviados` varchar(200) DEFAULT NULL,
  `mensajesRecibidos` varchar(200) DEFAULT NULL,
  `estados` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialintercambio`
--

CREATE TABLE `historialintercambio` (
  `idhistorialIntercambio` int(11) NOT NULL,
  `fechaHistorial` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `idlibros` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `nombreLibro` varchar(45) NOT NULL,
  `autorLibro` varchar(45) NOT NULL,
  `descripcionLibro` varchar(255) NOT NULL,
  `fechaLibro` date NOT NULL,
  `portadas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`idlibros`, `iduser`, `nombreLibro`, `autorLibro`, `descripcionLibro`, `fechaLibro`, `portadas`) VALUES
(40, 24, 'a', 'a', 'a', '2024-02-21', './images/librospublicados/24_02132024_193751.png'),
(41, 24, 'LibroPrueba', 'Eduardo', 'aaaaaaaaaaaaaaaaaaaaaaaaa', '2024-02-14', './images/librospublicados/24_02132024_203327.png'),
(42, 25, 'Ya basta', 'Tomas', 'Gustavo', '1223-03-12', './images/librospublicados/25_02132024_214418.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `PrivilegioID` int(11) NOT NULL,
  `Nombre_privilegio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`PrivilegioID`, `Nombre_privilegio`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `PrivilegioID` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `password` varchar(150) NOT NULL,
  `Activacion` int(11) DEFAULT 0,
  `Token` varchar(150) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `PrivilegioID`, `nombre`, `correo`, `fechaNacimiento`, `password`, `Activacion`, `Token`, `descripcion`) VALUES
(24, 2, 'Emmanuel', 'gobernante31@gmail.com', '2024-02-21', '$2y$10$eG9hVwKMOIFBVk556Twz5uNNYfW4vlQkf88KUXmDoW0l3aHxT7BZO', 1, '', 'Holaaa'),
(25, 2, 'Hola', 'tompres12@gmail.com', '1998-03-12', '$2y$10$0r15AL39tcOotnnu3shtrOps/rkIv/as9iSVGLgql1mO97RurkExe', 1, '', 'Soy tomas'),
(26, 1, 'Hola 1', 'yaporfavorplis.1@gmail.com', '1223-03-12', '$2y$10$dFF2sAY/WsYN3B08FISwju5RcXTgPBtmg36aZJQTyBNB45p3jNpUy', 1, '', NULL),
(27, 1, 'Hola 2', 'yaporfavorplis.2@gmail.com', '1232-03-12', '$2y$10$qvvYq4hxXMaEBWv.IwhpoOGirDZpNjabX4Y2kdKG8C9U.6aBwJoAO', 1, '', NULL),
(28, 1, 'hola 3', 'yaporfavorplis.3@gmail.com', '1223-03-12', '$2y$10$up5pKxvrtYVhP7XNPZUSEOEJzx1dhSivq1FCFnVxjVWJ.NJ2j8hXK', 1, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_has_chats`
--

CREATE TABLE `usuario_has_chats` (
  `usuario_idusuario` int(11) NOT NULL,
  `chats_idchats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_has_libros`
--

CREATE TABLE `usuario_has_libros` (
  `usuario_idusuario` int(11) NOT NULL,
  `libros_idlibros` int(11) NOT NULL,
  `historialIntercambio_idhistorialIntercambio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD PRIMARY KEY (`idcalificaciones`),
  ADD KEY `fk_calificaciones_usuario1_idx` (`usuario_idusuario`);

--
-- Indices de la tabla `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`idchats`);

--
-- Indices de la tabla `historialintercambio`
--
ALTER TABLE `historialintercambio`
  ADD PRIMARY KEY (`idhistorialIntercambio`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`idlibros`),
  ADD KEY `iduser` (`iduser`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`PrivilegioID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `PrivilegioID` (`PrivilegioID`);

--
-- Indices de la tabla `usuario_has_chats`
--
ALTER TABLE `usuario_has_chats`
  ADD PRIMARY KEY (`usuario_idusuario`,`chats_idchats`),
  ADD KEY `fk_usuario_has_chats_chats1_idx` (`chats_idchats`),
  ADD KEY `fk_usuario_has_chats_usuario1_idx` (`usuario_idusuario`);

--
-- Indices de la tabla `usuario_has_libros`
--
ALTER TABLE `usuario_has_libros`
  ADD PRIMARY KEY (`usuario_idusuario`,`libros_idlibros`),
  ADD KEY `fk_usuario_has_libros_libros1_idx` (`libros_idlibros`),
  ADD KEY `fk_usuario_has_libros_usuario_idx` (`usuario_idusuario`),
  ADD KEY `fk_usuario_has_libros_historialIntercambio1_idx` (`historialIntercambio_idhistorialIntercambio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  MODIFY `idcalificaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `chats`
--
ALTER TABLE `chats`
  MODIFY `idchats` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historialintercambio`
--
ALTER TABLE `historialintercambio`
  MODIFY `idhistorialIntercambio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `idlibros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `PrivilegioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `fk_calificaciones_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `iduser` FOREIGN KEY (`iduser`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `PrivilegioID` FOREIGN KEY (`PrivilegioID`) REFERENCES `privilegios` (`PrivilegioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_has_chats`
--
ALTER TABLE `usuario_has_chats`
  ADD CONSTRAINT `fk_usuario_has_chats_chats1` FOREIGN KEY (`chats_idchats`) REFERENCES `chats` (`idchats`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_chats_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_has_libros`
--
ALTER TABLE `usuario_has_libros`
  ADD CONSTRAINT `fk_usuario_has_libros_historialIntercambio1` FOREIGN KEY (`historialIntercambio_idhistorialIntercambio`) REFERENCES `historialintercambio` (`idhistorialIntercambio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_libros_libros1` FOREIGN KEY (`libros_idlibros`) REFERENCES `libros` (`idlibros`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_libros_usuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
