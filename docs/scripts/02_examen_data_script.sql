CREATE TABLE `examen`.`plugins` (
  `jamh_codigo` BIGINT(13) NOT NULL AUTO_INCREMENT,
  `jamh_plugin` VARCHAR(128) NULL,
  `jamh_estado` CHAR(3) NULL,
  `jamh_urlhomepage` VARCHAR(128) NULL,
  `jamh_urlcdn` VARCHAR(128) NULL,
  PRIMARY KEY (`jamh_codigo`));
