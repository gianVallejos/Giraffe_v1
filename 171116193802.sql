/*
MySQL Backup
Source Server Version: 5.5.5
Source Database: giraffe_bd
Date: 16/11/2017 19:38:02
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=363 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;

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
--  Procedure definition for `agregarCierreDeCaja3`
-- ----------------------------
DROP PROCEDURE IF EXISTS `agregarCierreDeCaja3`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarCierreDeCaja3`(IN X_M1 INT, IN X_M2 INT, IN X_M3 INT, IN X_M4 INT, IN X_M5 INT, IN X_M6 INT,
																		 IN X_M7 INT, IN X_M8 INT, IN X_M9 INT, IN X_M10 INT, IN X_M11 INT, 
																		 IN X_MONTOGENERAL DECIMAL, IN X_MONTOINICIAL DECIMAL, IN X_IDUSER INT)
BEGIN
	
	INSERT INTO cierrecaja(m1, m2, m3, m4, m5, m6, m7, m8, m9, m10, m11, monto_general, monto_inicio_dia, fechahora)
		VALUES(X_M1, X_M2, X_M3, X_M4, X_M5, X_M6, X_M7, X_M8, X_M9, X_M10, X_M11, X_MONTOGENERAL, X_MONTOINICIAL, NOW());

	UPDATE ventas SET ventas.idCierreCaja = (SELECT id FROM cierrecaja order by id DESC limit 1)
			WHERE idVendedor = '1' and idCierreCaja = '-1';

	SELECT ROW_COUNT() AS ESTADO;

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
--  Records 
-- ----------------------------
INSERT INTO `cierrecaja` VALUES ('1','0','0','0','0','0','0','0','0','5','0','0','250','0','2017-11-15 16:20:14'), ('2','0','0','0','0','5','0','0','4','0','3','0','390','150','2017-11-15 16:21:19'), ('3','0','0','0','5','0','10','0','0','0','0','0','55','140','2017-11-15 16:21:33'), ('4','0','0','0','0','0','0','5','0','0','2','0','250','150','2017-11-15 16:22:22'), ('5','0','0','10','0','0','5','0','7','0','10','0','1170','150','2017-11-15 16:53:21'), ('6','0','0','0','0','0','0','0','6','0','10','0','1120','0','2017-11-15 17:02:12'), ('7','0','0','0','0','0','0','0','6','0','10','0','1120','0','2017-11-15 17:02:30'), ('8','0','0','0','0','0','0','0','5','0','0','0','100','0','2017-11-15 17:02:45'), ('9','0','0','0','0','0','0','0','5','0','0','0','100','0','2017-11-15 17:04:13'), ('10','0','0','0','0','4','0','0','0','2','0','0','108','20','2017-11-15 17:04:43'), ('11','0','0','0','0','0','0','0','0','5','0','0','250','0','2017-11-15 17:05:05'), ('12','0','0','5','0','0','0','10','0','0','0','0','103','150','2017-11-15 17:13:29'), ('13','0','0','0','0','0','0','5','0','0','2','0','250','100','2017-11-16 09:52:07'), ('14','0','0','2','0','0','5','0','0','10','0','5','1526','80','2017-11-16 09:54:57'), ('15','0','0','0','0','10','0','0','0','0','0','0','20','25','2017-11-16 10:43:53'), ('16','0','0','0','0','10','0','0','0','0','0','0','20','25','2017-11-16 10:44:28'), ('17','0','0','0','0','0','0','5','0','0','0','0','50','0','2017-11-16 10:49:09'), ('18','0','0','0','0','0','0','0','0','0','0','0','0','50','2017-11-16 10:57:59'), ('19','0','0','0','0','0','0','0','0','0','0','0','0','50','2017-11-16 10:58:14'), ('20','0','0','0','0','0','0','0','0','0','0','0','0','50','2017-11-16 10:58:49'), ('21','0','0','0','0','0','0','0','0','0','0','0','0','50','2017-11-16 11:00:27'), ('22','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:00:33'), ('23','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:00:38'), ('24','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:03:18'), ('25','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:03:21'), ('26','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:03:32'), ('27','0','0','0','0','0','0','0','0','0','0','0','0','150','2017-11-16 11:03:35'), ('28','0','0','2','0','0','0','0','1','0','0','0','21','150','2017-11-16 11:05:37'), ('29','0','0','0','0','0','0','0','2','0','0','0','40','50','2017-11-16 11:06:50');
INSERT INTO `clientes` VALUES ('4','Gian Piere','Bardales','12345678','rgd.gp.vallejos@gmail.com','Av. Miguel Grau, 656','2017-12-31','Masculino','982780954','982780954','2017-11-15 22:12:47','2017-11-15 22:12:47');
INSERT INTO `detalleventas` VALUES ('1',NULL,'5','1'), ('2',NULL,'4','1'), ('3',NULL,'4','1'), ('4',NULL,'2','1'), ('5',NULL,'4','2'), ('6',NULL,'6','2'), ('7',NULL,'6','2'), ('8',NULL,'3','3'), ('9',NULL,'4','3'), ('10',NULL,'4','3'), ('11',NULL,'3','3'), ('12',NULL,'6','4'), ('13',NULL,'6','4'), ('14',NULL,'1','4'), ('15',NULL,'1','4'), ('16',NULL,'2','4'), ('17',NULL,'6','5'), ('18',NULL,'6','5'), ('19',NULL,'5','6'), ('20',NULL,'5','6'), ('21',NULL,'4','6'), ('22',NULL,'6','7'), ('23',NULL,'6','7'), ('24',NULL,'6','7'), ('25',NULL,'3','8'), ('26',NULL,'4','8'), ('27',NULL,'2','9'), ('28',NULL,'2','9'), ('29',NULL,'4','9'), ('30',NULL,'7','10'), ('31',NULL,'7','10'), ('32',NULL,'7','10'), ('33',NULL,'8','10'), ('34',NULL,'5','11'), ('35',NULL,'5','11'), ('36',NULL,'4','11'), ('37',NULL,'4','11'), ('38',NULL,'4','12'), ('39',NULL,'4','12'), ('40',NULL,'5','12'), ('41',NULL,'8','12'), ('42',NULL,'8','12'), ('43',NULL,'6','12'), ('44',NULL,'6','12'), ('45',NULL,'6','12'), ('46',NULL,'4','13'), ('47',NULL,'4','13'), ('48',NULL,'3','13'), ('49',NULL,'3','13'), ('50',NULL,'7','13'), ('51',NULL,'7','13'), ('52',NULL,'8','13'), ('53',NULL,'4','14'), ('54',NULL,'4','14'), ('55',NULL,'4','14'), ('56',NULL,'4','14'), ('57',NULL,'4','14'), ('58',NULL,'4','14'), ('59',NULL,'4','14'), ('60',NULL,'4','14'), ('61',NULL,'4','14'), ('62',NULL,'4','14'), ('63',NULL,'4','14'), ('64',NULL,'4','14'), ('65',NULL,'3','14'), ('66',NULL,'2','14'), ('67',NULL,'1','14'), ('68',NULL,'1','14'), ('69',NULL,'1','14'), ('70',NULL,'4','15'), ('71',NULL,'5','15'), ('72',NULL,'5','15'), ('73',NULL,'4','16'), ('74',NULL,'4','16'), ('75',NULL,'4','16'), ('76',NULL,'4','16'), ('77',NULL,'4','16'), ('78',NULL,'4','16'), ('79',NULL,'4','16'), ('80',NULL,'4','16'), ('81',NULL,'4','16'), ('82',NULL,'4','16'), ('83',NULL,'4','16'), ('84',NULL,'4','16'), ('85',NULL,'4','16'), ('86',NULL,'4','16'), ('87',NULL,'4','16'), ('88',NULL,'4','16'), ('89',NULL,'4','16'), ('90',NULL,'4','16'), ('91',NULL,'4','16'), ('92',NULL,'4','16'), ('93',NULL,'4','16'), ('94',NULL,'4','16'), ('95',NULL,'4','16'), ('96',NULL,'4','16'), ('97',NULL,'4','16'), ('98',NULL,'4','17'), ('99',NULL,'5','17'), ('100',NULL,'5','17');
INSERT INTO `detalleventas` VALUES ('101',NULL,'2','17'), ('102',NULL,'3','18'), ('103',NULL,'2','18'), ('104',NULL,'2','18'), ('105',NULL,'2','19'), ('106',NULL,'2','19'), ('107',NULL,'3','19'), ('108',NULL,'3','19'), ('109',NULL,'3','20'), ('110',NULL,'3','20'), ('111',NULL,'3','20'), ('112',NULL,'4','20'), ('113',NULL,'5','21'), ('114',NULL,'3','21'), ('115',NULL,'3','21'), ('116',NULL,'3','21'), ('117',NULL,'4','21'), ('118',NULL,'5','22'), ('119',NULL,'3','23'), ('120',NULL,'4','24'), ('121',NULL,'3','25'), ('122',NULL,'3','26'), ('123',NULL,'4','27'), ('124',NULL,'3','28'), ('125',NULL,'4','29'), ('126',NULL,'3','30'), ('127',NULL,'3','30'), ('128',NULL,'3','31'), ('129',NULL,'3','31'), ('130',NULL,'3','32'), ('131',NULL,'4','33'), ('132',NULL,'4','33'), ('133',NULL,'3','33'), ('134',NULL,'3','33'), ('135',NULL,'2','33'), ('136',NULL,'2','33'), ('137',NULL,'3','33'), ('138',NULL,'3','33'), ('139',NULL,'3','33'), ('140',NULL,'3','33'), ('141',NULL,'3','33'), ('142',NULL,'4','33'), ('143',NULL,'5','34'), ('144',NULL,'7','35'), ('145',NULL,'4','36'), ('146',NULL,'3','36'), ('147',NULL,'3','37'), ('148',NULL,'1','37'), ('149',NULL,'2','37'), ('150',NULL,'3','38'), ('151',NULL,'4','38'), ('152',NULL,'7','38'), ('153',NULL,'4','39'), ('154',NULL,'2','39'), ('155',NULL,'3','39'), ('156',NULL,'1','39'), ('157',NULL,'4','40'), ('158',NULL,'2','40'), ('159',NULL,'1','40'), ('160',NULL,'4','41'), ('161',NULL,'2','41'), ('162',NULL,'3','41'), ('163',NULL,'1','41'), ('164',NULL,'2','42'), ('165',NULL,'3','42'), ('166',NULL,'4','42'), ('167',NULL,'1','42'), ('168',NULL,'7','42'), ('169',NULL,'8','42'), ('170',NULL,'4','43'), ('171',NULL,'7','43'), ('172',NULL,'1','43'), ('173',NULL,'2','43'), ('174',NULL,'5','44'), ('175',NULL,'4','44'), ('176',NULL,'1','44'), ('177',NULL,'2','44'), ('178',NULL,'2','45'), ('179',NULL,'1','45'), ('180',NULL,'4','45'), ('181',NULL,'4','46'), ('182',NULL,'3','46'), ('183',NULL,'4','47'), ('184',NULL,'5','47'), ('185',NULL,'8','47'), ('186',NULL,'4','48'), ('187',NULL,'3','48'), ('188',NULL,'2','48'), ('189',NULL,'1','48'), ('190',NULL,'7','48'), ('191',NULL,'2','49'), ('192',NULL,'2','50'), ('193',NULL,'4','50'), ('194',NULL,'8','51'), ('195',NULL,'4','52'), ('196',NULL,'4','53'), ('197',NULL,'7','54'), ('198',NULL,'3','54'), ('199',NULL,'5','55'), ('200',NULL,'1','56');
INSERT INTO `detalleventas` VALUES ('201',NULL,'2','56'), ('202',NULL,'4','57'), ('203',NULL,'1','57'), ('204',NULL,'2','57'), ('205',NULL,'8','57'), ('206',NULL,'7','57'), ('207',NULL,'7','58'), ('208',NULL,'3','58'), ('209',NULL,'4','58'), ('210',NULL,'1','58'), ('211',NULL,'9','58'), ('212',NULL,'3','59'), ('213',NULL,'4','59'), ('214',NULL,'5','60'), ('215',NULL,'2','61'), ('216',NULL,'4','61'), ('217',NULL,'5','62'), ('218',NULL,'8','62'), ('219',NULL,'9','62'), ('220',NULL,'3','63'), ('221',NULL,'4','63'), ('222',NULL,'5','64'), ('223',NULL,'5','65'), ('224',NULL,'4','65'), ('225',NULL,'4','66'), ('226',NULL,'5','66'), ('227',NULL,'4','67'), ('228',NULL,'2','67'), ('229',NULL,'3','67'), ('230',NULL,'1','68'), ('231',NULL,'7','68'), ('232',NULL,'4','68'), ('233',NULL,'5','68'), ('234',NULL,'3','69'), ('235',NULL,'5','70'), ('236',NULL,'1','70'), ('237',NULL,'3','71'), ('238',NULL,'3','72'), ('239',NULL,'2','73'), ('240',NULL,'2','74'), ('241',NULL,'3','75'), ('242',NULL,'4','75'), ('243',NULL,'4','76'), ('244',NULL,'3','77'), ('245',NULL,'1','78'), ('246',NULL,'1','79'), ('247',NULL,'5','80'), ('248',NULL,'1','81'), ('249',NULL,'1','82'), ('250',NULL,'3','83'), ('251',NULL,'1','84'), ('252',NULL,'2','85'), ('253',NULL,'2','86'), ('254',NULL,'3','87'), ('255',NULL,'2','88'), ('256',NULL,'2','89'), ('257',NULL,'1','90'), ('258',NULL,'1','91'), ('259',NULL,'2','91'), ('260',NULL,'1','92'), ('261',NULL,'4','92'), ('262',NULL,'1','93'), ('263',NULL,'1','94'), ('264',NULL,'1','95'), ('265',NULL,'3','95'), ('266',NULL,'1','96'), ('267',NULL,'3','96'), ('268',NULL,'2','97'), ('269',NULL,'3','97'), ('270',NULL,'2','98'), ('271',NULL,'3','98'), ('272',NULL,'3','99'), ('273',NULL,'3','100'), ('274',NULL,'3','101'), ('275',NULL,'3','102'), ('276',NULL,'9','103'), ('277',NULL,'2','103'), ('278',NULL,'3','103'), ('279',NULL,'9','104'), ('280',NULL,'2','104'), ('281',NULL,'3','104'), ('282',NULL,'1','105'), ('283',NULL,'4','106'), ('284',NULL,'4','107'), ('285',NULL,'4','108'), ('286',NULL,'4','109'), ('287',NULL,'5','110'), ('288',NULL,'8','110'), ('289',NULL,'5','111'), ('290',NULL,'8','111'), ('291',NULL,'3','112'), ('292',NULL,'2','112'), ('293',NULL,'1','112'), ('294',NULL,'4','113'), ('295',NULL,'3','113'), ('296',NULL,'4','114'), ('297',NULL,'7','115'), ('298',NULL,'5','116'), ('299',NULL,'4','116'), ('300',NULL,'5','117');
INSERT INTO `detalleventas` VALUES ('301',NULL,'4','117'), ('302',NULL,'2','118'), ('303',NULL,'4','118'), ('304',NULL,'2','119'), ('305',NULL,'4','119'), ('306',NULL,'2','120'), ('307',NULL,'2','121'), ('308',NULL,'4','121'), ('309',NULL,'2','122'), ('310',NULL,'2','123'), ('311',NULL,'2','124'), ('312',NULL,'2','125'), ('313',NULL,'9','126'), ('314',NULL,'9','127'), ('315',NULL,'5','128'), ('316',NULL,'5','129'), ('317',NULL,'3','130'), ('318',NULL,'2','130'), ('319',NULL,'5','130'), ('320',NULL,'4','130'), ('321',NULL,'3','131'), ('322',NULL,'2','131'), ('323',NULL,'5','131'), ('324',NULL,'4','131'), ('325',NULL,'4','132'), ('326',NULL,'2','132'), ('327',NULL,'1','132'), ('328',NULL,'4','133'), ('329',NULL,'2','133'), ('330',NULL,'1','133'), ('331',NULL,'2','134'), ('332',NULL,'7','134'), ('333',NULL,'3','135'), ('334',NULL,'2','135'), ('335',NULL,'3','136'), ('336',NULL,'2','136'), ('337',NULL,'3','137'), ('338',NULL,'4','137'), ('339',NULL,'3','138'), ('340',NULL,'4','138'), ('341',NULL,'2','139'), ('342',NULL,'5','139'), ('343',NULL,'4','139'), ('344',NULL,'7','139'), ('345','5','3','140'), ('346','1','7','140'), ('347','5','5','141'), ('348','2','1','141'), ('349','5','5','142'), ('350','2','1','142'), ('351','2','5','143'), ('352','1','2','143'), ('353','2','9','143'), ('354','1','7','143'), ('355','1','3','144'), ('356','1','5','144'), ('357','2','2','145'), ('358','1','3','145'), ('359','2','4','146'), ('360','1','3','146'), ('361','2','2','147'), ('362','1','3','147');
INSERT INTO `productos` VALUES ('1','Helado','1 bola','4.50','2017-11-01 00:11:47','2017-10-31 23:03:01'), ('2','Helado','2 bolas','6.00','2017-10-31 23:03:14','2017-10-31 23:03:14'), ('3','Helado','3 bolas','9.00','2017-10-31 23:03:26','2017-10-31 23:03:26'), ('4','Helado','1 litro','18.50','2017-10-31 23:03:37','2017-10-31 23:03:37'), ('5','Empanada','Jamón y Queso','4.50','2017-11-01 00:13:11','2017-10-31 23:04:03'), ('7','Tamal',NULL,'3.00','2017-10-31 23:07:18','2017-10-31 23:07:18'), ('8','Humita',NULL,'3.00','2017-10-31 23:07:24','2017-10-31 23:07:24'), ('9','Torta de Chocolate',NULL,'7.00','2017-10-31 23:07:35','2017-10-31 23:07:35');
INSERT INTO `roles` VALUES ('1','Master'), ('2','Admin'), ('3','Cajero');
INSERT INTO `users` VALUES ('1','Gian Vallejos','gian.vallejos92@gmail.com','$2y$10$coYVaK.eIv6FDdNl62/zYuvEbXuzEMb14/R4VAhHMQxfIGgANM5TG','UINnhOwPt1zXzqtp5TcUOgzxlyH9EUy7GTChir2jqBNm4hCwY6ddq7szoF3B','2017-10-29 00:44:22','2017-10-29 00:44:22','1'), ('2','Gian Admin','admin@giraffe.pe','$2y$10$.VYSe0hN9avsAqgm7TfSauXhbNJ26rZpZptxSKOEVDiu77osWlf9K','AffuDNUYNHCsY31jcc6nY3AG21OpelO5Dg9vG3mVyVPgJ9DVgIfJYd3WlCIQ','2017-11-16 15:09:23','2017-11-16 15:09:23','3'), ('3','cajero','cajero@giraffe.pe','$2y$10$WsLiXh4kbsQ8O/SfOVjQluBWLwfl0W8x6A/GDpyUEXsdPQc0meJeG','VtasPoMZ156N0Of93NT6Euai5RiTYn5YptWlUcpKqerTN12gU0TmIIswirn2','2017-11-16 15:24:43','2017-11-16 15:24:43','3'), ('4','cajero','cajero2@giraffe.pe','$2y$10$mDmfgCUfq1N4F6XrwotqO..xQ1JV22CoCbVRttY86OPVfk2Qi8qaO','beJlAoJmCKHmUoYAsoEO1sV2CMgRfDAW5GVvnhXrHJgk2H3glydTxddTSotN','2017-11-16 15:25:21','2017-11-16 15:25:21','3'), ('5','cajero','cajero2@giraffe.pe','$2y$10$Rfian8HYAtRFmu1eRbgubO6cWTA0VcYIOsaekKN9457NIdM4v6tba','JZ6DfdFOUQRcE9DXyiaRPJCGzLcF69i6dz0TrKYixgOFEjgmzca5NKbhdwHT','2017-11-16 15:25:21','2017-11-16 15:25:21','3'), ('6','abc','abc@gmail.com','$2y$10$lDLI.h.Rb4XwvnOLkHnhY.42tP3jkNJa3C3GMqdogzHXadEdlhE7q','e6mo4THwsRfb4lx3YfYug7DN5Ze5Mdj6fXU3B48E2zz2SAHuJTZGKCjbKkTp','2017-11-16 15:27:15','2017-11-16 15:27:15','3'), ('7','def','def@gmail.com','$2y$10$iiLPOI4IGbF7umcMINC4ROuEDGzQLYzzyGo8zydpnnOLeO.O8EJba','DoJreBqtLkCC1JDStvh5odoBiuiYfAaJ3lwETzGGHayYoGlmnzzWUBavJ4mW','2017-11-16 15:27:55','2017-11-16 15:27:55','3'), ('8','poq','poq@giraffe.pe','$2y$10$L26/7oxBoKfRmZRRojw4M.U.0mKsdZPCdfJgUj8BWJ8WH20jXDaAK','KrLT2G5VPNjCyOnVG9FDvkoDwhBu0pOPj8Z3XkG8jigtWlhTZd6m5d4KVoya','2017-11-16 15:29:08','2017-11-16 15:29:08','1'), ('9','poqti','poqti@giraffe.pe','$2y$10$R/eFTcerqkd7CZ08jXetMOQCKviwe6.sb0TTmIyuhDMrqMCMvhd1K','OjrsZb6RCO8J7l55HsNZsaCJelqfzxjRWYdMS7ApOLsjKcHlVpvLgWvM1jza','2017-11-16 15:29:35','2017-11-16 15:29:35','2');
INSERT INTO `ventas` VALUES ('1','2017-10-31 18:10:02','1','1','5',NULL), ('2','2017-10-31 18:10:29','1','1','5',NULL), ('3','2017-10-31 18:10:44','1','1','5',NULL), ('4','2017-10-31 18:12:34','1','1','5',NULL), ('5','2017-10-31 18:14:10','1','1','5',NULL), ('6','2017-10-31 18:15:02','1','1','5',NULL), ('7','2017-10-31 18:15:25','1','1','5',NULL), ('8','2017-10-31 18:19:23','1','1','5',NULL), ('9','2017-10-31 18:20:57','1','1','5',NULL), ('10','2017-10-31 18:36:54','1','1','5',NULL), ('11','2017-10-31 18:37:37','1','1','5',NULL), ('12','2017-10-31 18:44:49','1','1','5',NULL), ('13','2017-10-31 18:45:27','1','1','5',NULL), ('14','2017-10-31 19:06:28','1','1','5',NULL), ('15','2017-10-31 19:07:45','1','1','5',NULL), ('16','2017-10-31 19:08:05','1','1','5',NULL), ('17','2017-10-31 19:13:29','1','1','5',NULL), ('18','2017-10-31 19:14:09','1','1','5',NULL), ('19','2017-10-31 19:20:47','1','1','5',NULL), ('20','2017-11-01 18:46:29','1','1','5',NULL), ('21','2017-11-02 15:47:06','1','1','5',NULL), ('22','2017-11-02 18:08:43','1','1','5',NULL), ('23','2017-11-02 18:09:20','1','1','5',NULL), ('24','2017-11-02 18:10:16','1','1','5',NULL), ('25','2017-11-02 18:10:28','1','1','5',NULL), ('26','2017-11-02 18:10:50','1','1','5',NULL), ('27','2017-11-02 18:11:23','1','1','5',NULL), ('28','2017-11-02 18:11:34','1','1','5',NULL), ('29','2017-11-02 18:11:44','1','1','5',NULL), ('30','2017-11-02 18:14:39','1','1','5',NULL), ('31','2017-11-02 18:15:10','1','1','5',NULL), ('32','2017-11-02 18:17:10','1','1','5',NULL), ('33','2017-11-03 12:01:18','1','1','5',NULL), ('34','2017-11-06 16:49:55','1','1','5',NULL), ('35','2017-11-07 17:13:32','1','1','5',NULL), ('36','2017-11-07 20:46:48','1','1','5',NULL), ('37','2017-11-07 21:08:10','1','1','5',NULL), ('38','2017-11-07 21:10:38','1','1','5',NULL), ('39','2017-11-07 21:12:57','1','1','5',NULL), ('40','2017-11-07 21:13:23','1','1','5',NULL), ('41','2017-11-07 21:14:01','1','1','5',NULL), ('42','2017-11-07 21:43:09','1','1','5',NULL), ('43','2017-11-07 23:00:53','1','1','5',NULL), ('44','2017-11-07 23:01:51','1','1','5',NULL), ('45','2017-11-07 23:03:07','1','1','5',NULL), ('46','2017-11-07 23:03:50','1','1','5',NULL), ('47','2017-11-07 23:35:56','1','1','5',NULL), ('48','2017-11-07 23:45:04','1','1','5',NULL), ('49','2017-11-08 09:26:52','1','1','5',NULL), ('50','2017-11-12 14:33:11','1','1','5',NULL), ('51','2017-11-12 14:44:57','1','1','5',NULL), ('52','2017-11-12 14:48:07','1','1','5',NULL), ('53','2017-11-12 14:48:44','1','1','5',NULL), ('54','2017-11-12 14:49:50','1','1','5',NULL), ('55','2017-11-12 14:51:00','1','1','5',NULL), ('56','2017-11-12 14:51:09','1','1','5',NULL), ('57','2017-11-12 14:51:37','1','1','5',NULL), ('58','2017-11-12 14:56:21','1','1','5',NULL), ('59','2017-11-12 14:57:16','1','1','5',NULL), ('60','2017-11-12 14:57:41','1','1','5',NULL), ('61','2017-11-12 15:59:31','1','1','5',NULL), ('62','2017-11-12 16:14:06','1','1','5',NULL), ('63','2017-11-12 23:14:23','1','1','5',NULL), ('64','2017-11-12 23:23:09','1','1','5',NULL), ('65','2017-11-12 23:27:15','1','1','5',NULL), ('66','2017-11-13 11:33:39','1','1','5',NULL), ('67','2017-11-13 22:26:44','1','1','5',NULL), ('68','2017-11-14 16:09:27','1','1','5',NULL), ('69','2017-11-14 16:55:48','1','1','5',NULL), ('70','2017-11-14 17:00:16','1','1','5',NULL), ('71','2017-11-14 19:50:14','1','1','5',NULL), ('72','2017-11-14 19:50:55','1','1','5',NULL), ('73','2017-11-14 19:51:32','1','1','5',NULL), ('74','2017-11-14 19:52:21','1','1','5',NULL), ('75','2017-11-14 20:00:56','1','1','5',NULL), ('76','2017-11-14 20:02:25','1','1','5',NULL), ('77','2017-11-14 20:03:53','1','1','5',NULL), ('78','2017-11-14 20:04:39','1','1','5',NULL), ('79','2017-11-14 20:06:25','1','1','5',NULL), ('80','2017-11-14 20:28:51','1','1','5',NULL), ('81','2017-11-14 20:30:39','1','1','5',NULL), ('82','2017-11-14 20:30:48','1','1','5',NULL), ('83','2017-11-14 20:31:02','1','1','5',NULL), ('84','2017-11-14 20:31:22','1','1','5',NULL), ('85','2017-11-14 20:34:18','1','1','5',NULL), ('86','2017-11-14 20:34:47','1','1','5',NULL), ('87','2017-11-14 20:36:51','1','1','5',NULL), ('88','2017-11-14 20:37:23','1','1','5',NULL), ('89','2017-11-14 20:38:46','1','1','5',NULL), ('90','2017-11-14 20:39:38','1','1','5',NULL), ('91','2017-11-14 20:40:08','1','1','5',NULL), ('92','2017-11-14 20:40:19','1','1','5',NULL), ('93','2017-11-14 20:41:12','1','1','5',NULL), ('94','2017-11-14 20:41:15','1','1','5',NULL), ('95','2017-11-14 20:41:24','1','1','5',NULL), ('96','2017-11-14 20:41:28','1','1','5',NULL), ('97','2017-11-14 20:41:57','1','1','5',NULL), ('98','2017-11-14 20:41:58','1','1','5',NULL), ('99','2017-11-14 20:42:12','1','1','5',NULL), ('100','2017-11-14 20:42:15','1','1','5',NULL);
INSERT INTO `ventas` VALUES ('101','2017-11-14 20:42:56','1','1','5',NULL), ('102','2017-11-14 20:43:01','1','1','5',NULL), ('103','2017-11-14 20:43:14','1','1','5',NULL), ('104','2017-11-14 20:43:21','1','1','5',NULL), ('105','2017-11-14 20:44:01','1','1','5',NULL), ('106','2017-11-14 20:44:36','1','1','5',NULL), ('107','2017-11-14 20:44:45','1','1','5',NULL), ('108','2017-11-14 20:46:27','1','1','5',NULL), ('109','2017-11-14 20:46:37','1','1','5',NULL), ('110','2017-11-14 20:46:47','1','1','5',NULL), ('111','2017-11-14 20:46:55','1','1','5',NULL), ('112','2017-11-14 20:55:55','1','1','5',NULL), ('113','2017-11-14 20:57:04','1','1','5',NULL), ('114','2017-11-14 20:57:33','1','1','5',NULL), ('115','2017-11-14 20:58:17','1','1','5',NULL), ('116','2017-11-14 20:58:53','1','1','5',NULL), ('117','2017-11-14 20:59:12','1','1','5',NULL), ('118','2017-11-14 20:59:22','1','1','5',NULL), ('119','2017-11-14 20:59:25','1','1','5',NULL), ('120','2017-11-14 21:01:06','1','1','5',NULL), ('121','2017-11-14 21:02:19','1','1','5',NULL), ('122','2017-11-14 21:02:59','1','1','5',NULL), ('123','2017-11-14 21:03:14','1','1','5',NULL), ('124','2017-11-14 21:03:23','1','1','5',NULL), ('125','2017-11-14 21:03:31','1','1','5',NULL), ('126','2017-11-14 21:04:13','1','1','5',NULL), ('127','2017-11-14 21:04:18','1','1','5',NULL), ('128','2017-11-14 21:10:10','1','1','5',NULL), ('129','2017-11-14 21:10:15','1','1','5',NULL), ('130','2017-11-14 21:10:45','1','1','5',NULL), ('131','2017-11-14 21:10:55','1','1','5',NULL), ('132','2017-11-15 00:22:41','1','1','5',NULL), ('133','2017-11-15 00:22:56','1','1','5',NULL), ('134','2017-11-15 17:04:24','1','1','10',NULL), ('135','2017-11-15 17:12:26','1','1','12',NULL), ('136','2017-11-15 17:12:31','1','1','12',NULL), ('137','2017-11-16 09:39:48','1','1','14',NULL), ('138','2017-11-16 09:41:09','1','1','14',NULL), ('139','2017-11-16 09:44:14','1','1','14',NULL), ('140','2017-11-16 09:49:58','1','1','14','50'), ('141','2017-11-16 09:50:45','1','1','14','40'), ('142','2017-11-16 09:51:15','1','1','14','50'), ('143','2017-11-16 10:43:06','1','9','29','40'), ('144','2017-11-16 10:43:41','1','2','28','15'), ('145','2017-11-16 12:49:44','1','9','-1','30'), ('146','2017-11-16 16:17:04','1','4','-1','50'), ('147','2017-11-16 19:10:07','1','1','-1','25');
