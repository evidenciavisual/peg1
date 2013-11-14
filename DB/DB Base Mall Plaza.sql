-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2012 at 07:06 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `totemMallPlazaPal`;
USE `totemMallPlazaPal`;
--
-- Database: `totemmallplaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `cambiadorpiso`
--

CREATE TABLE IF NOT EXISTS `cambiadorPiso` (
  `idcambiadorPiso` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `sube` tinyint(1) DEFAULT NULL,
  `baja` tinyint(1) DEFAULT NULL,
  `idnodoSubida` int(11) DEFAULT NULL,
  `idnodoBajada` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcambiadorPiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `detallemarca`
--

CREATE TABLE IF NOT EXISTS `detallemarca` (
  `iddetalleMarca` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `idtienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleMarca`),
  KEY `fk_dm_idproducto` (`idproducto`),
  KEY `fk_dm_idmarca` (`idmarca`),
  KEY `idtienda` (`idtienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `detalleoferta`
--

CREATE TABLE IF NOT EXISTS `detalleOferta` (
  `iddetalleOferta` int(11) NOT NULL AUTO_INCREMENT,
  `idoferta` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleOferta`),
  KEY `fk_do_idoferta` (`idoferta`),
  KEY `fk_do_idproducto` (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `detallepromocion`
--

CREATE TABLE IF NOT EXISTS `detallePromocion` (
  `iddetallePromocion` int(11) NOT NULL AUTO_INCREMENT,
  `idpromocion` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetallePromocion`),
  KEY `fk_dt_idpromocion` (`idpromocion`),
  KEY `fk_dt_idproducto` (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `detalleRubro` (
  `iddetalleRubro` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idrubro` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleRubro`),
  KEY `fk_dr_idtienda` (`idtienda`),
  KEY `fk_dr_idrubro` (`idrubro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `detalletienda`
--

CREATE TABLE IF NOT EXISTS `detalleTienda` (
  `iddetalleTienda` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleTienda`),
  KEY `fk_idtienda` (`idtienda`),
  KEY `fk_idproducto` (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `estacionamiento`
--

CREATE TABLE IF NOT EXISTS `estacionamiento` (
  `idestacionamiento` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idestacionamiento`),
  KEY `fk_estacionamiento_1` (`idnodo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `idlogin` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `idlogs` int(11) NOT NULL AUTO_INCREMENT,
  `logscol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlogs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `idMensaje` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(100) DEFAULT NULL,
  `mailUsuario` varchar(100) DEFAULT NULL,
  `fonoContacto` varchar(100) DEFAULT NULL,
  `mensaje` text,
  `idSubMotivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMensaje`),
  KEY `fk_mensaje_subMotivo` (`idSubMotivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `motivo`
--

CREATE TABLE IF NOT EXISTS `motivo` (
  `idMotivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMotivo` varchar(100) DEFAULT NULL,
  `idSubCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMotivo`),
  KEY `fk_motivo_subCategoria` (`idSubCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `nodos`
--

CREATE TABLE IF NOT EXISTS `nodos` (
  `idnodo` int(11) NOT NULL AUTO_INCREMENT,
  `idcambiadorPiso` int(11) DEFAULT NULL,
  `ubicacionx` varchar(45) NOT NULL,
  `ubicaciony` varchar(45) NOT NULL,
  `piso` varchar(45) NOT NULL,
  `vecino1` int(11) DEFAULT NULL,
  `vecino2` int(11) DEFAULT NULL,
  `vecino3` int(11) DEFAULT NULL,
  `vecino4` int(11) DEFAULT NULL,
  `coordenadaReal` varchar(45) NOT NULL,
  PRIMARY KEY (`idnodo`),
  KEY `fk_nodos_1` (`idcambiadorPiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `oferta`
--

CREATE TABLE IF NOT EXISTS `oferta` (
  `idoferta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `oferta` text,
  `stock` int(11) DEFAULT NULL,
  `idtienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`idoferta`),
  KEY `fk_of_idtienda` (`idtienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `perfilusuario`
--

CREATE TABLE IF NOT EXISTS `perfilUsuario` (
  `idPerfilUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador',
  `id_usuario` int(11) NOT NULL COMMENT 'id del usuario para vincular registro',
  `modulo` varchar(30) NOT NULL COMMENT 'nombre de funcionalidad o modulo',
  `credencial` tinyint(4) NOT NULL COMMENT 'estado, denegado o autorizado',
  PRIMARY KEY (`idPerfilUsuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`,`modulo`),
  KEY `fk_perfilUsuario_usuario1` (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `genero` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `promocion`
--

CREATE TABLE IF NOT EXISTS `promocion` (
  `idpromocion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `detalle` text,
  `fechaInicio` timestamp NULL DEFAULT NULL,
  `fechaTermino` timestamp NULL DEFAULT NULL,
  `idtienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpromocion`),
  KEY `idtienda` (`idtienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `propiedadestienda`
--

CREATE TABLE IF NOT EXISTS `propiedadesTienda` (
  `idpropiedadesTienda` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idnodo` int(11) DEFAULT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpropiedadesTienda`),
  KEY `fk_propiedadesTienda_1` (`idtienda`),
  KEY `fk_propiedadesTienda_2` (`idnodo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `reclamos`
--

CREATE TABLE IF NOT EXISTS `reclamos` (
  `idreclamos` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidoPaterno` varchar(45) DEFAULT NULL,
  `apellidoMaterno` varchar(45) DEFAULT NULL,
  `empresa` varchar(45) DEFAULT NULL,
  `motivo` varchar(45) DEFAULT NULL,
  `detalle` text,
  PRIMARY KEY (`idreclamos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rubro`
--

CREATE TABLE IF NOT EXISTS `rubro` (
  `idrubro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrubro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rubro`
--

INSERT INTO `rubro` (`idrubro`, `nombre`, `logo`) VALUES
(1, 'Auto Plaza', 'autoplaza.jpg'),
(2, 'Computación y Electrónica', 'computacion.jpg'),
(3, 'Deporte', 'deporte.jpg'),
(4, 'Entretención y Cultura', 'entretencion.jpg'),
(5, 'Hogar y Regalos', 'hogar.jpg'),
(6, 'Hombre', 'hombre.jpg'),
(7, 'Joyería y Relojerías', 'joyeria.jpg'),
(8, 'Jugueterías', 'jugueteria.jpg'),
(9, 'Las Terrazas', 'terrazas.jpg'),
(10, 'Mujer', 'mujer.jpg'),
(11, 'Música, Fotografía y Librerías', 'musica.jpg'),
(12, 'Niños', 'ninos.jpg'),
(13, 'Ópticas, Perfumerías y Farmacias', 'optica.jpg'),
(14, 'Peluquería y Belleza', 'peluqueria.jpg'),
(15, 'Restauranes, Cafeterías y Heladerías', 'restauranes.jpg'),
(16, 'Servicios', 'servicios.jpg'),
(17, 'Tiendas Departamentales', 'departamentales.jpg'),
(18, 'Bancos', 'bancos.jpg'),
(19, 'Bancos y Casas de Cambio', 'bancos.jpg'),
(20, 'Pago de Cuentas', 'pago.jpg'),
(21, 'Servicios Públicos', 'serviciospublicos.jpg'),
(22, 'Servicios para el Hogar', 'servicioshogar.jpg'),
(23, 'Salud y Belleza', 'saludybelleza.jpg'),
(24, 'Pasajes, Giros y Encomiendas', 'pasajes.jpg'),
(25, 'Educación', 'educacion.jpg'),
(26, 'Patio de Comidas', 'food.jpg'),
(27, 'Tiendas Menores', 'tiendasmenores.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subcategoria`
--

CREATE TABLE IF NOT EXISTS `subCategoria` (
  `idSubCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSubCategoria` varchar(100) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubCategoria`),
  KEY `fk_subCategoria_categoria` (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `submotivo`
--

CREATE TABLE IF NOT EXISTS `subMotivo` (
  `idSubMotivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSubMotivo` varchar(100) DEFAULT NULL,
  `idMotivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubMotivo`),
  KEY `fk_subMotivo_motivo` (`idMotivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tienda`
--

CREATE TABLE IF NOT EXISTS `tienda` (
  `idtienda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `totem`
--

CREATE TABLE IF NOT EXISTS `totem` (
  `idtotem` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `orientacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtotem`),
  KEY `fk_totem_1` (`idnodo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomComUsuario` varchar(45) DEFAULT NULL,
  `nomUsuario` varchar(30) DEFAULT NULL,
  `mailUsuario` varchar(60) DEFAULT NULL,
  `passUsuario` varchar(100) DEFAULT NULL,
  `privilegioUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidoPaterno` varchar(45) DEFAULT NULL,
  `apellidoMaterno` varchar(45) DEFAULT NULL,
  `jerarquia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detallemarca`
--
ALTER TABLE `detallemarca`
  ADD CONSTRAINT `detallemarca_ibfk_1` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dm_idmarca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dm_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Constraints for table `detalleoferta`
--
ALTER TABLE `detalleOferta`
  ADD CONSTRAINT `fk_do_idoferta` FOREIGN KEY (`idoferta`) REFERENCES `oferta` (`idoferta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_do_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detallepromocion`
--
ALTER TABLE `detallePromocion`
  ADD CONSTRAINT `fk_dt_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dt_idpromocion` FOREIGN KEY (`idpromocion`) REFERENCES `promocion` (`idpromocion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detallerubro`
--
ALTER TABLE `detalleRubro`
  ADD CONSTRAINT `fk_dr_idrubro` FOREIGN KEY (`idrubro`) REFERENCES `rubro` (`idrubro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dr_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalletienda`
--
ALTER TABLE `detalleTienda`
  ADD CONSTRAINT `fk_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `estacionamiento`
--
ALTER TABLE `estacionamiento`
  ADD CONSTRAINT `fk_estacionamiento_1` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_mensaje_subMotivo` FOREIGN KEY (`idSubMotivo`) REFERENCES `subMotivo` (`idSubMotivo`);

--
-- Constraints for table `motivo`
--
ALTER TABLE `motivo`
  ADD CONSTRAINT `fk_motivo_subCategoria` FOREIGN KEY (`idSubCategoria`) REFERENCES `subCategoria` (`idSubCategoria`);

--
-- Constraints for table `nodos`
--
ALTER TABLE `nodos`
  ADD CONSTRAINT `fk_nodos_1` FOREIGN KEY (`idcambiadorPiso`) REFERENCES `cambiadorPiso` (`idcambiadorPiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `fk_of_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `propiedadestienda`
--
ALTER TABLE `propiedadesTienda`
  ADD CONSTRAINT `fk_propiedadesTienda_1` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_propiedadesTienda_2` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subcategoria`
--
ALTER TABLE `subCategoria`
  ADD CONSTRAINT `fk_subCategoria_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Constraints for table `submotivo`
--
ALTER TABLE `subMotivo`
  ADD CONSTRAINT `fk_subMotivo_motivo` FOREIGN KEY (`idMotivo`) REFERENCES `motivo` (`idMotivo`);

--
-- Constraints for table `totem`
--
ALTER TABLE `totem`
  ADD CONSTRAINT `fk_totem_1` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
