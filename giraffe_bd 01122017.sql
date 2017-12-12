/*
MySQL Backup
Source Server Version: 5.5.5
Source Database: giraffe_bd
Date: 01/12/2017 11:04:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `cierrecaja`
-- ----------------------------
DROP TABLE IF EXISTS `cierrecaja`;
CREATE TABLE `cierrecaja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `m1` int(11) DEFAULT NULL,
  `m2` int(11) DEFAULT NULL,
  `m3` int(11) DEFAULT NULL,
  `m4` int(11) DEFAULT NULL,
  `m5` int(11) DEFAULT NULL,
  `m6` int(11) DEFAULT NULL,
  `m7` int(11) DEFAULT NULL,
  `m8` int(11) DEFAULT NULL,
  `m9` int(11) DEFAULT NULL,
  `m10` int(11) DEFAULT NULL,
  `m11` int(11) DEFAULT NULL,
  `monto_general` decimal(10,0) DEFAULT NULL,
  `monto_inicio_dia` decimal(10,0) DEFAULT NULL,
  `fechahora` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `clientes`
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(90) DEFAULT NULL,
  `apellidos` varchar(90) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `direccion` varchar(90) DEFAULT NULL,
  `fechanacimiento` varchar(25) DEFAULT NULL,
  `genero` varchar(25) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `detalleventas`
-- ----------------------------
DROP TABLE IF EXISTS `detalleventas`;
CREATE TABLE `detalleventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `idVenta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=378 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `insumos`
-- ----------------------------
DROP TABLE IF EXISTS `insumos`;
CREATE TABLE `insumos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` decimal(6,2) NOT NULL,
  `stock` int(11) DEFAULT '0',
  `medida` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `kardexes`
-- ----------------------------
DROP TABLE IF EXISTS `kardexes`;
CREATE TABLE `kardexes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idInsumo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `concepto` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `factura` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounitario` decimal(6,2) NOT NULL,
  `cantidadexistencia` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `personals`
-- ----------------------------
DROP TABLE IF EXISTS `personals`;
CREATE TABLE `personals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(120) DEFAULT NULL,
  `apellidos` varchar(120) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `genero` varchar(25) DEFAULT NULL,
  `direccion` varchar(90) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `productos`
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(180) NOT NULL,
  `descripcion` varchar(180) DEFAULT NULL,
  `precio` decimal(6,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol_usuario` int(11) DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `ventas`
-- ----------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechahora` datetime NOT NULL,
  `tipo` int(11) DEFAULT '1',
  `idVendedor` int(11) DEFAULT NULL,
  `idCierreCaja` int(11) DEFAULT '-1',
  `montoCliente` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Procedure definition for `agregarCierreDeCaja`
-- ----------------------------
DROP PROCEDURE IF EXISTS `agregarCierreDeCaja`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarCierreDeCaja`(IN X_M1 INT, IN X_M2 INT, IN X_M3 INT, IN X_M4 INT, IN X_M5 INT, IN X_M6 INT,
																		 IN X_M7 INT, IN X_M8 INT, IN X_M9 INT, IN X_M10 INT, IN X_M11 INT, 
																		 IN X_MONTOGENERAL DECIMAL, IN X_MONTOINICIAL DECIMAL, IN X_IDUSER INT)
BEGIN
	IF EXISTS( SELECT * FROM ventas WHERE idVendedor = X_IDUSER AND idCierreCaja = -1 ) THEN
		INSERT INTO cierrecaja(m1, m2, m3, m4, m5, m6, m7, m8, m9, m10, m11, monto_general, monto_inicio_dia, fechahora)
			VALUES(X_M1, X_M2, X_M3, X_M4, X_M5, X_M6, X_M7, X_M8, X_M9, X_M10, X_M11, X_MONTOGENERAL, X_MONTOINICIAL, NOW());

		UPDATE ventas SET ventas.idCierreCaja = (SELECT id FROM cierrecaja order by id DESC limit 1)
				WHERE idVendedor = X_IDUSER and idCierreCaja = '-1';

		SELECT ROW_COUNT() AS ESTADO;
	ELSE
		SELECT 0 AS ESTADO;
	END IF;

END
;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `agregarVentaDetalle`
-- ----------------------------
DROP PROCEDURE IF EXISTS `agregarVentaDetalle`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarVentaDetalle`(IN X_CANTIDAD INT, IN ID_PRODUCTO INT, IN ID_VENTA INT)
BEGIN
		INSERT INTO detalleVentas(cantidad, idProducto, idVenta) VALUES (X_CANTIDAD, ID_PRODUCTO, ID_VENTA);
END
;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `agregarVentaGeneral`
-- ----------------------------
DROP PROCEDURE IF EXISTS `agregarVentaGeneral`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarVentaGeneral`(IN ID_TIPO INT, IN ID_VENDEDOR INT, IN X_MONTOCLIENTE DECIMAL)
BEGIN		
	INSERT INTO ventas(fechahora, tipo, idVendedor, montoCliente) VALUES (NOW(), ID_TIPO, ID_VENDEDOR, X_MONTOCLIENTE);
END
;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getAllVentas`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getAllVentas`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllVentas`()
BEGIN
			SELECT ventas.id, ventas.fechahora as fecha, users.name as cajero, sum(productos.precio * detalleventas.cantidad) as monto, 
					 montoCliente as pago, users.id as user_id, idCierreCaja as cc FROM ventas
			INNER JOIN detalleventas on detalleventas.idVenta = ventas.id
			INNER JOIN users on users.id = ventas.idVendedor	
			INNER JOIN productos on productos.id = detalleventas.idProducto 
				GROUP BY(ventas.id);
END
;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getAllVentasByDates`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getAllVentasByDates`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllVentasByDates`(IN XDATE_INI datetime, IN XDATE_FIN datetime)
BEGIN
		
		SELECT ventas.id, ventas.fechahora as fecha, users.name as cajero, sum(productos.precio * detalleventas.cantidad) as monto, 
					 montoCliente as pago, users.id as user_id, idCierreCaja as cc FROM ventas
			INNER JOIN detalleventas on detalleventas.idVenta = ventas.id
			INNER JOIN users on users.id = ventas.idVendedor	
			INNER JOIN productos on productos.id = detalleventas.idProducto 
			WHERE date(ventas.fechahora) >= XDATE_INI AND date(ventas.fechahora) <= XDATE_FIN GROUP BY(ventas.id);

END
;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getAllVentasByUserId`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getAllVentasByUserId`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllVentasByUserId`(IN XID_USER INT)
BEGIN
			SELECT ventas.id, ventas.fechahora as fecha, users.name as cajero, sum(productos.precio * detalleventas.cantidad) as monto, 
					 montoCliente as pago, users.id as user_id, idCierreCaja as cc FROM ventas
			INNER JOIN detalleventas on detalleventas.idVenta = ventas.id
			INNER JOIN users on users.id = ventas.idVendedor	
			INNER JOIN productos on productos.id = detalleventas.idProducto 
				WHERE users.id = XID_USER GROUP BY(ventas.id);
END
;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getAllVentasNoCerradasByIdVendedor`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getAllVentasNoCerradasByIdVendedor`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllVentasNoCerradasByIdVendedor`(IN XID_VENDEDOR INT)
BEGIN
			SELECT ventas.id, ventas.fechahora as fecha, users.name as cajero, sum(productos.precio * detalleventas.cantidad) as monto, 
					 montoCliente as pago, users.id as user_id, idCierreCaja as cc FROM ventas
			INNER JOIN detalleventas on detalleventas.idVenta = ventas.id
			INNER JOIN users on users.id = ventas.idVendedor	
			INNER JOIN productos on productos.id = detalleventas.idProducto 
			WHERE ventas.idVendedor = XID_VENDEDOR AND idCierreCaja = -1 GROUP BY(ventas.id);
END
;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getDetalleVentasByIdVenta`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getDetalleVentasByIdVenta`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetalleVentasByIdVenta`(IN XID_VENTA INT)
BEGIN
		SELECT dv.id, dv.cantidad, pd.nombre, pd.descripcion, pd.precio  FROM detalleventas as dv
			INNER JOIN productos as pd on pd.id = dv.idProducto
		WHERE dv.idVenta = XID_VENTA;
	END
;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getLastVenta`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getLastVenta`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getLastVenta`()
BEGIN
	SELECT id AS NRO_PRESUPUESTO FROM ventas ORDER BY id DESC LIMIT 1;
END
;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getVentaByIdVenta`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getVentaByIdVenta`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getVentaByIdVenta`(IN XID_VENTA INT)
BEGIN

		SELECT ventas.id as idVenta, fechahora as fecha, users.name as cajero, SUM(pd.precio * dv.cantidad) as monto, montoCliente as pago FROM ventas
			INNER JOIN users on users.id = ventas.idVendedor
			INNER JOIN detalleventas as dv on dv.idVenta = ventas.id
			INNER JOIN productos as pd on pd.id = dv.idProducto
		WHERE ventas.id = XID_VENTA;

END
;;
DELIMITER ;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `cierrecaja` VALUES ('1','0','0','0','0','0','0','0','0','5','0','0','250','0','2017-11-15 16:20:14'), ('2','0','0','0','0','5','0','0','4','0','3','0','390','150','2017-11-15 16:21:19'), ('3','0','0','0','5','0','10','0','0','0','0','0','55','140','2017-11-15 16:21:33'), ('4','0','0','0','0','0','0','5','0','0','2','0','250','150','2017-11-15 16:22:22'), ('5','0','0','10','0','0','5','0','7','0','10','0','1170','150','2017-11-15 16:53:21'), ('6','0','0','0','0','0','0','0','6','0','10','0','1120','0','2017-11-15 17:02:12'), ('7','0','0','0','0','0','0','0','6','0','10','0','1120','0','2017-11-15 17:02:30'), ('8','0','0','0','0','0','0','0','5','0','0','0','100','0','2017-11-15 17:02:45'), ('9','0','0','0','0','0','0','0','5','0','0','0','100','0','2017-11-15 17:04:13'), ('10','0','0','0','0','4','0','0','0','2','0','0','108','20','2017-11-15 17:04:43'), ('11','0','0','0','0','0','0','0','0','5','0','0','250','0','2017-11-15 17:05:05'), ('12','0','0','5','0','0','0','10','0','0','0','0','103','150','2017-11-15 17:13:29'), ('13','0','0','0','0','0','0','5','0','0','2','0','250','100','2017-11-16 09:52:07'), ('14','0','0','2','0','0','5','0','0','10','0','5','1526','80','2017-11-16 09:54:57'), ('15','0','0','0','0','10','0','0','0','0','0','0','20','25','2017-11-16 10:43:53'), ('16','0','0','0','0','10','0','0','0','0','0','0','20','25','2017-11-16 10:44:28'), ('17','0','0','0','0','0','0','5','0','0','0','0','50','0','2017-11-16 10:49:09'), ('18','0','0','0','0','0','0','0','0','0','0','0','0','50','2017-11-16 10:57:59'), ('19','0','0','0','0','0','0','0','0','0','0','0','0','50','2017-11-16 10:58:14'), ('20','0','0','0','0','0','0','0','0','0','0','0','0','50','2017-11-16 10:58:49'), ('21','0','0','0','0','0','0','0','0','0','0','0','0','50','2017-11-16 11:00:27'), ('22','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:00:33'), ('23','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:00:38'), ('24','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:03:18'), ('25','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:03:21'), ('26','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:03:32'), ('27','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:03:35'), ('28','0','0','2','0','0','0','0','1','0','0','0','21','150','2017-11-16 11:05:37'), ('29','0','0','0','0','0','0','0','2','0','0','0','40','50','2017-11-16 11:06:50'), ('30','3','1','0','2','0','0','0','2','1','0','0','93','0','2017-11-20 16:26:38'), ('31','0','0','0','1','0','0','0','1','0','0','0','21','0','2017-11-21 10:57:05'), ('32','0','0','0','0','0','2','5','0','0','0','0','60','0','2017-11-21 10:57:45'), ('33','0','0','0','0','0','0','4','2','0','0','0','80','0','2017-11-22 09:23:17');
INSERT INTO `clientes` VALUES ('4','Gian Piere','Bardales','12345678','rgd.gp.vallejos@gmail.com','Av. Miguel Grau, 656','2017-12-31','Masculino','982780954','982780954','2017-11-15 22:12:47','2017-11-15 22:12:47');
INSERT INTO `detalleventas` VALUES ('1','1','5','1'), ('2','1','4','1'), ('3','1','4','1'), ('4','1','2','1'), ('5','1','4','2'), ('6','1','6','2'), ('7','1','6','2'), ('8','1','3','3'), ('9','1','4','3'), ('10','1','4','3'), ('11','1','3','3'), ('12','1','6','4'), ('13','1','6','4'), ('14','1','1','4'), ('15','1','1','4'), ('16','1','2','4'), ('17','1','6','5'), ('18','1','6','5'), ('19','1','5','6'), ('20','1','5','6'), ('21','1','4','6'), ('22','1','6','7'), ('23','1','6','7'), ('24','1','6','7'), ('25','1','3','8'), ('26','1','4','8'), ('27','1','2','9'), ('28','1','2','9'), ('29','1','4','9'), ('30','1','7','10'), ('31','1','7','10'), ('32','1','7','10'), ('33','1','8','10'), ('34','1','5','11'), ('35','1','5','11'), ('36','1','4','11'), ('37','1','4','11'), ('38','1','4','12'), ('39','1','4','12'), ('40','1','5','12'), ('41','1','8','12'), ('42','1','8','12'), ('43','1','6','12'), ('44','1','6','12'), ('45','1','6','12'), ('46','1','4','13'), ('47','1','4','13'), ('48','1','3','13'), ('49','1','3','13'), ('50','1','7','13'), ('51','1','7','13'), ('52','1','8','13'), ('53','1','4','14'), ('54','1','4','14'), ('55','1','4','14'), ('56','1','4','14'), ('57','1','4','14'), ('58','1','4','14'), ('59','1','4','14'), ('60','1','4','14'), ('61','1','4','14'), ('62','1','4','14'), ('63','1','4','14'), ('64','1','4','14'), ('65','1','3','14'), ('66','1','2','14'), ('67','1','1','14'), ('68','1','1','14'), ('69','1','1','14'), ('70','1','4','15'), ('71','1','5','15'), ('72','1','5','15'), ('73','1','4','16'), ('74','1','4','16'), ('75','1','4','16'), ('76','1','4','16'), ('77','1','4','16'), ('78','1','4','16'), ('79','1','4','16'), ('80','1','4','16'), ('81','1','4','16'), ('82','1','4','16'), ('83','1','4','16'), ('84','1','4','16'), ('85','1','4','16'), ('86','1','4','16'), ('87','1','4','16'), ('88','1','4','16'), ('89','1','4','16'), ('90','1','4','16'), ('91','1','4','16'), ('92','1','4','16'), ('93','1','4','16'), ('94','1','4','16'), ('95','1','4','16'), ('96','1','4','16'), ('97','1','4','16'), ('98','1','4','17'), ('99','1','5','17'), ('100','1','5','17');
INSERT INTO `detalleventas` VALUES ('101','1','2','17'), ('102','1','3','18'), ('103','1','2','18'), ('104','1','2','18'), ('105','1','2','19'), ('106','1','2','19'), ('107','1','3','19'), ('108','1','3','19'), ('109','1','3','20'), ('110','1','3','20'), ('111','1','3','20'), ('112','1','4','20'), ('113','1','5','21'), ('114','1','3','21'), ('115','1','3','21'), ('116','1','3','21'), ('117','1','4','21'), ('118','1','5','22'), ('119','1','3','23'), ('120','1','4','24'), ('121','1','3','25'), ('122','1','3','26'), ('123','1','4','27'), ('124','1','3','28'), ('125','1','4','29'), ('126','1','3','30'), ('127','1','3','30'), ('128','1','3','31'), ('129','1','3','31'), ('130','1','3','32'), ('131','1','4','33'), ('132','1','4','33'), ('133','1','3','33'), ('134','1','3','33'), ('135','1','2','33'), ('136','1','2','33'), ('137','1','3','33'), ('138','1','3','33'), ('139','1','3','33'), ('140','1','3','33'), ('141','1','3','33'), ('142','1','4','33'), ('143','1','5','34'), ('144','1','7','35'), ('145','1','4','36'), ('146','1','3','36'), ('147','1','3','37'), ('148','1','1','37'), ('149','1','2','37'), ('150','1','3','38'), ('151','1','4','38'), ('152','1','7','38'), ('153','1','4','39'), ('154','1','2','39'), ('155','1','3','39'), ('156','1','1','39'), ('157','1','4','40'), ('158','1','2','40'), ('159','1','1','40'), ('160','1','4','41'), ('161','1','2','41'), ('162','1','3','41'), ('163','1','1','41'), ('164','1','2','42'), ('165','1','3','42'), ('166','1','4','42'), ('167','1','1','42'), ('168','1','7','42'), ('169','1','8','42'), ('170','1','4','43'), ('171','1','7','43'), ('172','1','1','43'), ('173','1','2','43'), ('174','1','5','44'), ('175','1','4','44'), ('176','1','1','44'), ('177','1','2','44'), ('178','1','2','45'), ('179','1','1','45'), ('180','1','4','45'), ('181','1','4','46'), ('182','1','3','46'), ('183','1','4','47'), ('184','1','5','47'), ('185','1','8','47'), ('186','1','4','48'), ('187','1','3','48'), ('188','1','2','48'), ('189','1','1','48'), ('190','1','7','48'), ('191','1','2','49'), ('192','1','2','50'), ('193','1','4','50'), ('194','1','8','51'), ('195','1','4','52'), ('196','1','4','53'), ('197','1','7','54'), ('198','1','3','54'), ('199','1','5','55'), ('200','1','1','56');
INSERT INTO `detalleventas` VALUES ('201','1','2','56'), ('202','1','4','57'), ('203','1','1','57'), ('204','1','2','57'), ('205','1','8','57'), ('206','1','7','57'), ('207','1','7','58'), ('208','1','3','58'), ('209','1','4','58'), ('210','1','1','58'), ('211','1','9','58'), ('212','1','3','59'), ('213','1','4','59'), ('214','1','5','60'), ('215','1','2','61'), ('216','1','4','61'), ('217','1','5','62'), ('218','1','8','62'), ('219','1','9','62'), ('220','1','3','63'), ('221','1','4','63'), ('222','1','5','64'), ('223','1','5','65'), ('224','1','4','65'), ('225','1','4','66'), ('226','1','5','66'), ('227','1','4','67'), ('228','1','2','67'), ('229','1','3','67'), ('230','1','1','68'), ('231','1','7','68'), ('232','1','4','68'), ('233','1','5','68'), ('234','1','3','69'), ('235','1','5','70'), ('236','1','1','70'), ('237','1','3','71'), ('238','1','3','72'), ('239','1','2','73'), ('240','1','2','74'), ('241','1','3','75'), ('242','1','4','75'), ('243','1','4','76'), ('244','1','3','77'), ('245','1','1','78'), ('246','1','1','79'), ('247','1','5','80'), ('248','1','1','81'), ('249','1','1','82'), ('250','1','3','83'), ('251','1','1','84'), ('252','1','2','85'), ('253','1','2','86'), ('254','1','3','87'), ('255','1','2','88'), ('256','1','2','89'), ('257','1','1','90'), ('258','1','1','91'), ('259','1','2','91'), ('260','1','1','92'), ('261','1','4','92'), ('262','1','1','93'), ('263','1','1','94'), ('264','1','1','95'), ('265','1','3','95'), ('266','1','1','96'), ('267','1','3','96'), ('268','1','2','97'), ('269','1','3','97'), ('270','1','2','98'), ('271','1','3','98'), ('272','1','3','99'), ('273','1','3','100'), ('274','1','3','101'), ('275','1','3','102'), ('276','1','9','103'), ('277','1','2','103'), ('278','1','3','103'), ('279','1','9','104'), ('280','1','2','104'), ('281','1','3','104'), ('282','1','1','105'), ('283','1','4','106'), ('284','1','4','107'), ('285','1','4','108'), ('286','1','4','109'), ('287','1','5','110'), ('288','1','8','110'), ('289','1','5','111'), ('290','1','8','111'), ('291','1','3','112'), ('292','1','2','112'), ('293','1','1','112'), ('294','1','4','113'), ('295','1','3','113'), ('296','1','4','114'), ('297','1','7','115'), ('298','1','5','116'), ('299','1','4','116'), ('300','1','5','117');
INSERT INTO `detalleventas` VALUES ('301','1','4','117'), ('302','1','2','118'), ('303','1','4','118'), ('304','1','2','119'), ('305','1','4','119'), ('306','1','2','120'), ('307','1','2','121'), ('308','1','4','121'), ('309','1','2','122'), ('310','1','2','123'), ('311','1','2','124'), ('312','1','2','125'), ('313','1','9','126'), ('314','1','9','127'), ('315','1','5','128'), ('316','1','5','129'), ('317','1','3','130'), ('318','1','2','130'), ('319','1','5','130'), ('320','1','4','130'), ('321','1','3','131'), ('322','1','2','131'), ('323','1','5','131'), ('324','1','4','131'), ('325','1','4','132'), ('326','1','2','132'), ('327','1','1','132'), ('328','1','4','133'), ('329','1','2','133'), ('330','1','1','133'), ('331','1','2','134'), ('332','1','7','134'), ('333','1','3','135'), ('334','1','2','135'), ('335','1','3','136'), ('336','1','2','136'), ('337','1','3','137'), ('338','1','4','137'), ('339','1','3','138'), ('340','1','4','138'), ('341','1','2','139'), ('342','1','5','139'), ('343','1','4','139'), ('344','1','7','139'), ('345','5','3','140'), ('346','1','7','140'), ('347','5','5','141'), ('348','2','1','141'), ('349','5','5','142'), ('350','2','1','142'), ('351','2','5','143'), ('352','1','2','143'), ('353','2','9','143'), ('354','1','7','143'), ('355','1','3','144'), ('356','1','5','144'), ('357','2','2','145'), ('358','1','3','145'), ('359','2','4','146'), ('360','1','3','146'), ('361','2','2','147'), ('362','1','3','147'), ('363','3','2','148'), ('364','1','4','148'), ('365','1','5','148'), ('366','1','4','149'), ('367','3','7','149'), ('368','1','8','149'), ('369','2','2','150'), ('370','1','3','150'), ('371','2','4','151'), ('372','1','3','151'), ('373','2','8','151'), ('374','1','9','151'), ('375','4','3','152'), ('376','1','4','152'), ('377','1','5','152');
INSERT INTO `insumos` VALUES ('1','Vasos','Vasos de 1/4','20.00','100',NULL,'2017-11-24 11:04:07','2017-11-21 01:23:45'), ('2','Café','El café es la bebida que se obtiene a partir de los granos tostados y molidos de los frutos de la planta del café.','5.20','-5','Kilogramos (Kg)','2017-11-24 11:26:45','2017-11-22 07:10:42'), ('3','Helado',NULL,'30.00','10','Litros (l)','2017-11-22 16:27:22','2017-11-22 19:15:05');
INSERT INTO `kardexes` VALUES ('1','1','2017-11-20 00:00:00','Entrada','001','20','20.00','20','2017-11-21 22:16:11','2017-11-21 02:27:01'), ('2','1','2017-11-21 00:00:00','Entrada','002','157','2.00','177','2017-11-22 03:11:10','2017-11-22 03:11:10'), ('3','1','2017-11-21 00:00:00','Salida','003','77','2.50','100','2017-11-21 22:27:40','2017-11-22 03:26:09'), ('4','1','2017-11-21 00:00:00','Entrada','004','28','2.30','128','2017-11-22 03:34:33','2017-11-22 03:34:33'), ('5','1','2017-11-21 20:09:45','Salida','005','27','1.70','101','2017-11-22 01:09:45','2017-11-22 01:09:45'), ('6','3','2017-11-22 11:23:11','Entrada','006','20','30.00','20','2017-11-22 16:23:12','2017-11-22 14:22:03'), ('7','3','2017-11-22 11:27:22','Salida',NULL,'10','30.00','10','2017-11-22 16:27:22','2017-11-22 16:23:46'), ('8','1','2017-11-24 11:00:14','Entrada','LF-123456','5','10.50','106','2017-11-24 11:00:14','2017-11-24 11:00:14'), ('9','1','2017-11-24 11:04:07','Salida',NULL,'1','10.50','100','2017-11-24 11:04:07','2017-11-24 11:02:19'), ('10','2','2017-11-24 11:26:45','Salida',NULL,'5','10.50','-5','2017-11-24 11:26:45','2017-11-24 11:26:45');
INSERT INTO `productos` VALUES ('1','Helado','1 bola','4.50','2017-11-01 00:11:47','2017-10-31 23:03:01'), ('2','Helado','2 bolas','6.00','2017-10-31 23:03:14','2017-10-31 23:03:14'), ('3','Helado','3 bolas','9.00','2017-10-31 23:03:26','2017-10-31 23:03:26'), ('4','Helado','1 litro','18.50','2017-10-31 23:03:37','2017-10-31 23:03:37'), ('5','Empanada','Jamón y Queso','4.50','2017-11-01 00:13:11','2017-10-31 23:04:03'), ('7','Tamal',NULL,'3.00','2017-10-31 23:07:18','2017-10-31 23:07:18'), ('8','Humita',NULL,'3.00','2017-10-31 23:07:24','2017-10-31 23:07:24'), ('9','Torta de Chocolate',NULL,'7.00','2017-10-31 23:07:35','2017-10-31 23:07:35');
INSERT INTO `roles` VALUES ('1','Master'), ('2','Admin'), ('3','Cajero');
INSERT INTO `users` VALUES ('1','Gian Vallejos','gian.vallejos92@gmail.com','$2y$10$coYVaK.eIv6FDdNl62/zYuvEbXuzEMb14/R4VAhHMQxfIGgANM5TG','PLi0nWzVO6G1lHhtcUjLpIndomLCGds376vkSvXdld3lVwas0FUqnlbSeZnw','2017-10-29 00:44:22','2017-10-29 00:44:22','1'), ('2','Gian Admin','admin@giraffe.pe','$2y$10$.VYSe0hN9avsAqgm7TfSauXhbNJ26rZpZptxSKOEVDiu77osWlf9K','AffuDNUYNHCsY31jcc6nY3AG21OpelO5Dg9vG3mVyVPgJ9DVgIfJYd3WlCIQ','2017-11-16 15:09:23','2017-11-16 15:09:23','3'), ('3','cajero','cajero@giraffe.pe','$2y$10$WsLiXh4kbsQ8O/SfOVjQluBWLwfl0W8x6A/GDpyUEXsdPQc0meJeG','VtasPoMZ156N0Of93NT6Euai5RiTYn5YptWlUcpKqerTN12gU0TmIIswirn2','2017-11-16 15:24:43','2017-11-16 15:24:43','3'), ('4','cajero','cajero2@giraffe.pe','$2y$10$mDmfgCUfq1N4F6XrwotqO..xQ1JV22CoCbVRttY86OPVfk2Qi8qaO','UAKcmf5gxp5s2pmw3PyWFd6FhYw0OoDiusu2YKsq4iEvIJ3NcRL9EwHfs30q','2017-11-16 15:25:21','2017-11-16 15:25:21','3'), ('5','cajero','cajero2@giraffe.pe','$2y$10$Rfian8HYAtRFmu1eRbgubO6cWTA0VcYIOsaekKN9457NIdM4v6tba','JZ6DfdFOUQRcE9DXyiaRPJCGzLcF69i6dz0TrKYixgOFEjgmzca5NKbhdwHT','2017-11-16 15:25:21','2017-11-16 15:25:21','3'), ('6','abc','abc@gmail.com','$2y$10$lDLI.h.Rb4XwvnOLkHnhY.42tP3jkNJa3C3GMqdogzHXadEdlhE7q','e6mo4THwsRfb4lx3YfYug7DN5Ze5Mdj6fXU3B48E2zz2SAHuJTZGKCjbKkTp','2017-11-16 15:27:15','2017-11-16 15:27:15','3'), ('7','def','def@gmail.com','$2y$10$iiLPOI4IGbF7umcMINC4ROuEDGzQLYzzyGo8zydpnnOLeO.O8EJba','DoJreBqtLkCC1JDStvh5odoBiuiYfAaJ3lwETzGGHayYoGlmnzzWUBavJ4mW','2017-11-16 15:27:55','2017-11-16 15:27:55','3'), ('8','poq','poq@giraffe.pe','$2y$10$L26/7oxBoKfRmZRRojw4M.U.0mKsdZPCdfJgUj8BWJ8WH20jXDaAK','KrLT2G5VPNjCyOnVG9FDvkoDwhBu0pOPj8Z3XkG8jigtWlhTZd6m5d4KVoya','2017-11-16 15:29:08','2017-11-16 15:29:08','1'), ('9','poqti','poqti@giraffe.pe','$2y$10$R/eFTcerqkd7CZ08jXetMOQCKviwe6.sb0TTmIyuhDMrqMCMvhd1K','dRPy3MxviCKieaPJrOZ5HGp49HfsaF4Bi2FXZLxFUlId3d5oFNtxAqEpLqVz','2017-11-16 15:29:35','2017-11-16 15:29:35','2');
INSERT INTO `ventas` VALUES ('1','2017-10-31 18:10:02','1','1','5',NULL), ('2','2017-10-31 18:10:29','1','1','5',NULL), ('3','2017-10-31 18:10:44','1','1','5',NULL), ('4','2017-10-31 18:12:34','1','1','5',NULL), ('5','2017-10-31 18:14:10','1','1','5',NULL), ('6','2017-10-31 18:15:02','1','1','5',NULL), ('7','2017-10-31 18:15:25','1','1','5',NULL), ('8','2017-10-31 18:19:23','1','1','5',NULL), ('9','2017-10-31 18:20:57','1','1','5',NULL), ('10','2017-10-31 18:36:54','1','1','5',NULL), ('11','2017-10-31 18:37:37','1','1','5',NULL), ('12','2017-10-31 18:44:49','1','1','5',NULL), ('13','2017-10-31 18:45:27','1','1','5',NULL), ('14','2017-10-31 19:06:28','1','1','5',NULL), ('15','2017-10-31 19:07:45','1','1','5',NULL), ('16','2017-10-31 19:08:05','1','1','5',NULL), ('17','2017-10-31 19:13:29','1','1','5',NULL), ('18','2017-10-31 19:14:09','1','1','5',NULL), ('19','2017-10-31 19:20:47','1','1','5',NULL), ('20','2017-11-01 18:46:29','1','1','5',NULL), ('21','2017-11-02 15:47:06','1','1','5',NULL), ('22','2017-11-02 18:08:43','1','1','5',NULL), ('23','2017-11-02 18:09:20','1','1','5',NULL), ('24','2017-11-02 18:10:16','1','1','5',NULL), ('25','2017-11-02 18:10:28','1','1','5',NULL), ('26','2017-11-02 18:10:50','1','1','5',NULL), ('27','2017-11-02 18:11:23','1','1','5',NULL), ('28','2017-11-02 18:11:34','1','1','5',NULL), ('29','2017-11-02 18:11:44','1','1','5',NULL), ('30','2017-11-02 18:14:39','1','1','5',NULL), ('31','2017-11-02 18:15:10','1','1','5',NULL), ('32','2017-11-02 18:17:10','1','1','5',NULL), ('33','2017-11-03 12:01:18','1','1','5',NULL), ('34','2017-11-06 16:49:55','1','1','5',NULL), ('35','2017-11-07 17:13:32','1','1','5',NULL), ('36','2017-11-07 20:46:48','1','1','5',NULL), ('37','2017-11-07 21:08:10','1','1','5',NULL), ('38','2017-11-07 21:10:38','1','1','5',NULL), ('39','2017-11-07 21:12:57','1','1','5',NULL), ('40','2017-11-07 21:13:23','1','1','5',NULL), ('41','2017-11-07 21:14:01','1','1','5',NULL), ('42','2017-11-07 21:43:09','1','1','5',NULL), ('43','2017-11-07 23:00:53','1','1','5',NULL), ('44','2017-11-07 23:01:51','1','1','5',NULL), ('45','2017-11-07 23:03:07','1','1','5',NULL), ('46','2017-11-07 23:03:50','1','1','5',NULL), ('47','2017-11-07 23:35:56','1','1','5',NULL), ('48','2017-11-07 23:45:04','1','1','5',NULL), ('49','2017-11-08 09:26:52','1','1','5',NULL), ('50','2017-11-12 14:33:11','1','1','5',NULL), ('51','2017-11-12 14:44:57','1','1','5',NULL), ('52','2017-11-12 14:48:07','1','1','5',NULL), ('53','2017-11-12 14:48:44','1','1','5',NULL), ('54','2017-11-12 14:49:50','1','1','5',NULL), ('55','2017-11-12 14:51:00','1','1','5',NULL), ('56','2017-11-12 14:51:09','1','1','5',NULL), ('57','2017-11-12 14:51:37','1','1','5',NULL), ('58','2017-11-12 14:56:21','1','1','5',NULL), ('59','2017-11-12 14:57:16','1','1','5',NULL), ('60','2017-11-12 14:57:41','1','1','5',NULL), ('61','2017-11-12 15:59:31','1','1','5',NULL), ('62','2017-11-12 16:14:06','1','1','5',NULL), ('63','2017-11-12 23:14:23','1','1','5',NULL), ('64','2017-11-12 23:23:09','1','1','5',NULL), ('65','2017-11-12 23:27:15','1','1','5',NULL), ('66','2017-11-13 11:33:39','1','1','5',NULL), ('67','2017-11-13 22:26:44','1','1','5',NULL), ('68','2017-11-14 16:09:27','1','1','5',NULL), ('69','2017-11-14 16:55:48','1','1','5',NULL), ('70','2017-11-14 17:00:16','1','1','5',NULL), ('71','2017-11-14 19:50:14','1','1','5',NULL), ('72','2017-11-14 19:50:55','1','1','5',NULL), ('73','2017-11-14 19:51:32','1','1','5',NULL), ('74','2017-11-14 19:52:21','1','1','5',NULL), ('75','2017-11-14 20:00:56','1','1','5',NULL), ('76','2017-11-14 20:02:25','1','1','5',NULL), ('77','2017-11-14 20:03:53','1','1','5',NULL), ('78','2017-11-14 20:04:39','1','1','5',NULL), ('79','2017-11-14 20:06:25','1','1','5',NULL), ('80','2017-11-14 20:28:51','1','1','5',NULL), ('81','2017-11-14 20:30:39','1','1','5',NULL), ('82','2017-11-14 20:30:48','1','1','5',NULL), ('83','2017-11-14 20:31:02','1','1','5',NULL), ('84','2017-11-14 20:31:22','1','1','5',NULL), ('85','2017-11-14 20:34:18','1','1','5',NULL), ('86','2017-11-14 20:34:47','1','1','5',NULL), ('87','2017-11-14 20:36:51','1','1','5',NULL), ('88','2017-11-14 20:37:23','1','1','5',NULL), ('89','2017-11-14 20:38:46','1','1','5',NULL), ('90','2017-11-14 20:39:38','1','1','5',NULL), ('91','2017-11-14 20:40:08','1','1','5',NULL), ('92','2017-11-14 20:40:19','1','1','5',NULL), ('93','2017-11-14 20:41:12','1','1','5',NULL), ('94','2017-11-14 20:41:15','1','1','5',NULL), ('95','2017-11-14 20:41:24','1','1','5',NULL), ('96','2017-11-14 20:41:28','1','1','5',NULL), ('97','2017-11-14 20:41:57','1','1','5',NULL), ('98','2017-11-14 20:41:58','1','1','5',NULL), ('99','2017-11-14 20:42:12','1','1','5',NULL), ('100','2017-11-14 20:42:15','1','1','5',NULL);
INSERT INTO `ventas` VALUES ('101','2017-11-14 20:42:56','1','1','5',NULL), ('102','2017-11-14 20:43:01','1','1','5',NULL), ('103','2017-11-14 20:43:14','1','1','5',NULL), ('104','2017-11-14 20:43:21','1','1','5',NULL), ('105','2017-11-14 20:44:01','1','1','5',NULL), ('106','2017-11-14 20:44:36','1','1','5',NULL), ('107','2017-11-14 20:44:45','1','1','5',NULL), ('108','2017-11-14 20:46:27','1','1','5',NULL), ('109','2017-11-14 20:46:37','1','1','5',NULL), ('110','2017-11-14 20:46:47','1','1','5',NULL), ('111','2017-11-14 20:46:55','1','1','5',NULL), ('112','2017-11-14 20:55:55','1','1','5',NULL), ('113','2017-11-14 20:57:04','1','1','5',NULL), ('114','2017-11-14 20:57:33','1','1','5',NULL), ('115','2017-11-14 20:58:17','1','1','5',NULL), ('116','2017-11-14 20:58:53','1','1','5',NULL), ('117','2017-11-14 20:59:12','1','1','5',NULL), ('118','2017-11-14 20:59:22','1','1','5',NULL), ('119','2017-11-14 20:59:25','1','1','5',NULL), ('120','2017-11-14 21:01:06','1','1','5',NULL), ('121','2017-11-14 21:02:19','1','1','5',NULL), ('122','2017-11-14 21:02:59','1','1','5',NULL), ('123','2017-11-14 21:03:14','1','1','5',NULL), ('124','2017-11-14 21:03:23','1','1','5',NULL), ('125','2017-11-14 21:03:31','1','1','5',NULL), ('126','2017-11-14 21:04:13','1','1','5',NULL), ('127','2017-11-14 21:04:18','1','1','5',NULL), ('128','2017-11-14 21:10:10','1','1','5',NULL), ('129','2017-11-14 21:10:15','1','1','5',NULL), ('130','2017-11-14 21:10:45','1','1','5',NULL), ('131','2017-11-14 21:10:55','1','1','5',NULL), ('132','2017-11-15 00:22:41','1','1','5',NULL), ('133','2017-11-15 00:22:56','1','1','5',NULL), ('134','2017-11-15 17:04:24','1','1','10',NULL), ('135','2017-11-15 17:12:26','1','1','12',NULL), ('136','2017-11-15 17:12:31','1','1','12',NULL), ('137','2017-11-16 09:39:48','1','1','14',NULL), ('138','2017-11-16 09:41:09','1','1','14',NULL), ('139','2017-11-16 09:44:14','1','1','14',NULL), ('140','2017-11-16 09:49:58','1','1','14','50'), ('141','2017-11-16 09:50:45','1','1','14','40'), ('142','2017-11-16 09:51:15','1','1','14','50'), ('143','2017-11-16 10:43:06','1','9','29','40'), ('144','2017-11-16 10:43:41','1','2','28','15'), ('145','2017-11-16 12:49:44','1','9','31','30'), ('146','2017-11-16 16:17:04','1','4','-1','50'), ('147','2017-11-16 19:10:07','1','1','30','25'), ('148','2017-11-16 19:38:30','1','1','30','50'), ('149','2017-11-16 23:16:31','1','1','30','35'), ('150','2017-11-20 16:27:17','1','1','33','21'), ('151','2017-11-21 10:57:26','1','9','32','60'), ('152','2017-11-22 09:22:56','1','1','33','60');
