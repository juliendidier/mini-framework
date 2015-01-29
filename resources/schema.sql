CREATE TABLE `article_xmascard` (
  `id` INTEGER(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `format` VARCHAR(20) NOT NULL,
  `paperType` VARCHAR(20) NOT NULL,
  `isVarnished` TINYINT(1) NOT NULL DEFAULT 0,
  `price` FLOAT NOT NULL,
  `isEditable` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


insert into article_xmascard (name, format, paperType, isVarnished, price, isEditable)
values
  ('x200', '15x15', 'Chromomat 300g', 0, 0.90, 1),
  ('x250', '30x15', 'Chromomat 300g', 0, 1.50, 1)
;
