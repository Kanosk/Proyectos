-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria`
--
CREATE DATABASE libreria;
use libreria;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `cod` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`cod`, `nombre`) VALUES
(1, 'Ciencia Ficción'),
(2, 'Comedia'),
(3, 'Distopía'),
(4, 'Drama'),
(5, 'Histórica'),
(6, 'Terror');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `isbn` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `escritores` varchar(255) NOT NULL,
  `genero` int(11) NOT NULL,
  `numpaginas` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `precio` float(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`isbn`, `titulo`, `escritores`, `genero`, `numpaginas`, `imagen`, `precio`) VALUES
(1, 'Guía del Autoestopista Galático', 'Douglas Adams\r\n ', 2, 257, 'img/autoestopista.jpg', "19,99€"),
(2, 'Trilogía de la Fundación', 'Isaac Asimov', 1, 895, 'img/fundacion.jpg', "14,99€"),
(3, 'Las tinieblas y el alba', 'Ken Follet', 5, 1058, 'img/tinieblas.jpg', "34,23€"),
(4, 'El señor de las moscas', 'William Golding', 3, 290, 'img/moscas.jpg', "28,50€"),
(5, 'IT ', 'Stephen King', 6, 1215, 'img/it.jpg', "9,99€");

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `FK_Genero` (`genero`);

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `isbn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `FK_Genero` FOREIGN KEY (`genero`) REFERENCES `generos` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliotecas`
--
create TABLE bibliotecas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(255),
	  descripcion text,
    numerolibros int,
    estado varchar(20)
);

create TABLE compra_libros(
    id int AUTO_INCREMENT PRIMARY KEY,
    idbiblioteca int,
    idlibro INT
    );
    
create table biblioteca_libros(
	id int AUTO_INCREMENT PRIMARY KEY,
    idbiblioteca int,
    idlibro int
);

alter table biblioteca_libros add CONSTRAINT fk_idbiblioteca foreign KEY (idbiblioteca) REFERENCES bibliotecas (id) on delete CASCADE on UPDATE CASCADE;
alter table biblioteca_libros add CONSTRAINT fk_idlibro foreign KEY (idlibro) REFERENCES libros (isbn) on delete CASCADE on UPDATE CASCADE;

alter table compra_libros add CONSTRAINT fk_idlibro1 foreign KEY (idlibro) REFERENCES libros (isbn) on delete CASCADE on UPDATE CASCADE;

alter table compra_libros add CONSTRAINT fk_idbiblioteca1 foreign KEY (idbiblioteca) REFERENCES bibliotecas (id) on delete CASCADE on UPDATE CASCADE;
--
-- Volcado de datos para la tabla `bibliotecas`
--

INSERT INTO `bibliotecas` (`id`, `nombre`, `descripcion`, `numerolibros`, `estado`) VALUES
(1, 'Biblioteca de terror', 'Biblioteca de libros de terror', 0, 'Comprado'),
(2, 'Biblioteca de ciencia ficción', 'Biblioteca de libros de ciencia ficción', 0, 'Activo'),
(3, 'Libros de drama', 'Biblioteca de tematica  drámatica', 0, 'Inactivo');
