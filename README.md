# Crud

- Definir conexión de base de datos
  
  ejecutar en la base de datos
  
CREATE TABLE `cantantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` char(1) NOT NULL,
  `biografia` text NOT NULL,
  `foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `cantantes` ADD PRIMARY KEY (`id`);
ALTER TABLE `cantantes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  
  
- composer install
