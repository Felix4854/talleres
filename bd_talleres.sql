/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.4.22-MariaDB : Database - bd_talleres
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bd_talleres` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `bd_talleres`;

/*Table structure for table `alumno` */

DROP TABLE IF EXISTS `alumno`;

CREATE TABLE `alumno` (
  `Idalumno` int(11) NOT NULL,
  `Iddetalle` int(11) DEFAULT NULL,
  `Non_alumno` varchar(50) DEFAULT NULL,
  `Ape_alumno` varchar(50) DEFAULT NULL,
  `Fec_na` date DEFAULT NULL,
  `Dni` varchar(10) DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `Tel_alum` varchar(15) DEFAULT NULL,
  `Dir_alum` varchar(100) DEFAULT NULL,
  `horario` time DEFAULT NULL,
  PRIMARY KEY (`Idalumno`),
  KEY `Iddetalle` (`Iddetalle`),
  CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`Iddetalle`) REFERENCES `detalles` (`Iddetalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `alumno` */

insert  into `alumno`(`Idalumno`,`Iddetalle`,`Non_alumno`,`Ape_alumno`,`Fec_na`,`Dni`,`Sexo`,`Tel_alum`,`Dir_alum`,`horario`) values (1,1,'Carlos','Parker','2002-01-01','05884523','M','123456789','Dirección 1','08:00:00'),(2,2,'Marcos','Alvarez','2002-01-02','08456213','F','987654321','Dirección 2','09:00:00'),(3,3,'Juaquin ','Capetilla','2002-01-02','05845623','F','987654321','Dirección 4','09:00:00'),(4,4,'Max','Montero','2002-01-02','71845623','F','987654321','Dirección 5','09:00:00'),(5,5,'Emiliano','Salinas','2002-01-02','78456200','F','987654321','Dirección 7','09:00:00'),(6,6,'Matias','Ross','2002-01-02','17845623','F','987654321','Dirección 8','09:00:00');

/*Table structure for table `detalles` */

DROP TABLE IF EXISTS `detalles`;

CREATE TABLE `detalles` (
  `Iddetalle` int(11) NOT NULL,
  `Idtaller` int(11) DEFAULT NULL,
  `Idprofe` int(11) DEFAULT NULL,
  `Horario` time DEFAULT NULL,
  PRIMARY KEY (`Iddetalle`),
  KEY `Idtaller` (`Idtaller`),
  KEY `Idprofe` (`Idprofe`),
  CONSTRAINT `detalles_ibfk_1` FOREIGN KEY (`Idtaller`) REFERENCES `taller` (`Idtaller`),
  CONSTRAINT `detalles_ibfk_2` FOREIGN KEY (`Idprofe`) REFERENCES `profesores` (`Idprofe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `detalles` */

insert  into `detalles`(`Iddetalle`,`Idtaller`,`Idprofe`,`Horario`) values (1,1,1,'08:00:00'),(2,2,2,'09:00:00'),(3,3,3,'10:00:00'),(4,4,4,'11:00:00'),(5,5,5,'12:00:00'),(6,6,6,'13:00:00'),(7,1,7,'14:00:00'),(8,7,8,'10:00:00');

/*Table structure for table `profesores` */

DROP TABLE IF EXISTS `profesores`;

CREATE TABLE `profesores` (
  `Idprofe` int(11) NOT NULL,
  `Nom_profe` varchar(50) DEFAULT NULL,
  `Ape_profe` varchar(50) DEFAULT NULL,
  `Dni` varchar(10) DEFAULT NULL,
  `Fec_nac` date DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `Tel_profe` varchar(15) DEFAULT NULL,
  `Dir_profe` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Idprofe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `profesores` */

insert  into `profesores`(`Idprofe`,`Nom_profe`,`Ape_profe`,`Dni`,`Fec_nac`,`Sexo`,`Tel_profe`,`Dir_profe`) values (1,'Ricardo','salas','45345690','2000-01-01','M','999456789','Dirección 1'),(2,'Dennis ','Mendoza','73028502','2000-02-11','F','987655521','Dirección 2'),(3,'Gonzalo ','Malaga','63028111','2000-03-08','F','981154321','Dirección 3'),(4,'Alonso ','Martinez','83022700','2000-06-05','F','900654321','Dirección 4'),(5,'David ','Parker','030285000','2000-11-12','F','987652221','Dirección 5'),(6,'Renato','Rosales','13020902','2000-12-22','F','987654366','Dirección 6'),(7,'Matias ','Ross','53028345','2000-04-17','M','999456700','Dirección 7'),(8,'Juan ','Ramirez','59028905','1990-04-17','M','990435799','Dirección 8');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) DEFAULT NULL,
  `rol` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

insert  into `roles`(`id`,`rol`) values (1,'Administrador'),(2,'Tecnico'),(3,'profesor');

/*Table structure for table `taller` */

DROP TABLE IF EXISTS `taller`;

CREATE TABLE `taller` (
  `Idtaller` int(11) NOT NULL,
  `Non_taller` varchar(50) DEFAULT NULL,
  `Cat_taller` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Idtaller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `taller` */

insert  into `taller`(`Idtaller`,`Non_taller`,`Cat_taller`) values (1,'futbol','DEPORTES'),(2,'Basquet','DEPORTE'),(3,'Tennis','DEPORTE'),(4,'Danza','BAILE'),(5,'Pintura','ARTE'),(6,'Voley','DEPORTE'),(7,'Surf','DEPORTE');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`nombre`,`correo`,`password`,`fecha`,`rol`) values (12,'Tecnico','usuario@gmail.com','12345','2024-02-02 18:36:51',2),(2,'Administrador','admin@medical-pc.com','123456','2024-02-02 18:37:05',1),(14,'Profesor','medico@xxx.com','12345','2024-02-02 18:36:57',3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
