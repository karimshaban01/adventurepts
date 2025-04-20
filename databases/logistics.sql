/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.11-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: logistics
-- ------------------------------------------------------
-- Server version	10.11.11-MariaDB-0+deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `percels`
--

DROP TABLE IF EXISTS `percels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `percels` (
  `track_id` varchar(20) DEFAULT NULL,
  `ship_type` varchar(20) DEFAULT NULL,
  `service_level` varchar(20) DEFAULT NULL,
  `pickup_date` varchar(10) DEFAULT NULL,
  `expected_delivery_date` varchar(10) DEFAULT NULL,
  `sender_name` varchar(100) DEFAULT NULL,
  `sender_email` varchar(64) DEFAULT NULL,
  `sender_phone_number` varchar(20) DEFAULT NULL,
  `pickup_address` varchar(100) DEFAULT NULL,
  `receiver_name` varchar(100) DEFAULT NULL,
  `receiver_email` varchar(64) DEFAULT NULL,
  `receiver_phone_number` varchar(20) DEFAULT NULL,
  `delivery_address` varchar(100) DEFAULT NULL,
  `package_type` varchar(20) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `length` varchar(20) DEFAULT NULL,
  `width` varchar(20) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `value` varchar(20) DEFAULT NULL,
  `instructions` varchar(200) DEFAULT NULL,
  `ship_status` varchar(20) DEFAULT NULL,
  `delivery_status` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `processed_by` varchar(100) DEFAULT NULL,
  `transport_cost` varchar(100) DEFAULT NULL,
  `vehicle` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `percels`
--

LOCK TABLES `percels` WRITE;
/*!40000 ALTER TABLE `percels` DISABLE KEYS */;
INSERT INTO `percels` VALUES
('7572','standard','regular','2037-04-02','2037-04-25','KARIM SHABAN HARUNA','karimxhaban@gmail.com','0785817222','ARUSHA','JOYCE LAURENT KIPARA','jkipara@gmail.com','0628370174','DODOMA','box','10','30','30','30','CONFIDENTIAL','40000','Handle with care','not shipped','not delivered',NULL,NULL,'20000','T','2037:04:24:03:23:08','admin'),
('9048','standard','regular','2025-04-16','2025-04-23','KARIM SHABAN HARUNA','karimxhaban@gmail.com','09302930','ARUSHA','OMARY MAJALIWA YAHAYA','','','MWANZA','box','100','10','10','10','spare parts','100000','Handle with care','not shipped','not delivered',NULL,NULL,NULL,NULL,NULL,NULL),
('90341','standard','regular','2025-04-16','2025-04-23','KARIM SHABAN HARUNA','karimxhaban@gmail.com','09302930','ARUSHA','OMARY MAJALIWA YAHAYA','','','MWANZA','box','100','10','10','10','spare parts','100000','Handle with care','not shipped','not delivered',NULL,NULL,NULL,NULL,NULL,NULL),
('57105','express','priority','2025-04-17','2025-04-26','IGNASS MAJALIWA YAHAYA','igg@gmail.com','09302930','DODOMA','OMARY MAJALIWA YAHAYA','omary@gmail.com','89284923','MWANZA','custom','1000','200','200','30','Engine','10000000','Handle with care','not shipped','not delivered',NULL,NULL,NULL,NULL,NULL,NULL),
('27074','extreme','urgent','2025-04-16','2025-04-23','REHEMA HASSAN','rehema@gmail.com','0987654345','ARUSHA','KARIM SHABAN HARUNA','karim@gmail.com','0765432178','KIGOMA','tube','10','10000','5','1','PIPE','90000','none','not shipped','not delivered',NULL,NULL,NULL,NULL,NULL,NULL),
('20250416210924','adventure','priority','2025-04-17','2025-04-18','KARIM SHABAN HARUNA','karimxhaban@gmail.com','09302930','ARUSHA','OMARY MAJALIWA YAHAYA','omary@gmail.com','0765432178','MWANZA','box','10','5','5','5','nails','30000','none','not shipped','not delivered',NULL,NULL,NULL,NULL,NULL,NULL),
('ADV-20250417102842','express','priority','2025-04-17','2025-04-26','MWANAIDI MASOUD ATHUMAN','mwanaidi@gmail.com','0627538386','KASULU ','KARIM SHABAN HARUNA','karimxhaban@gmail.com','0785817222','ARUSHA','envelope','0.1','28','11','1','Letter','40000','Fragile','not shipped','not delivered',NULL,NULL,NULL,NULL,NULL,NULL),
('ADV-20370424025325','adventure','urgent','2037-04-24','2037-04-25','KARIM SHABAN HARUNA','karimxhaban@gmail.com','0785817222','ARUSHA','JOYCE LAURENT KIPARA','jkipara@gmail.com','0628370174','DODOMA','box','100','2','3','5','CONFIDENTIAL','10000','FRAGILE ','IN PROGRESS','not delivered','2037:04:24:02:53:25','admin','10000','T','2037-04-25 00:40:50','admin'),
('ADV-20250418040501','express','urgent','2025-04-18','2025-04-25','HARUNA SHABAN HARUNA','officialkareem01@gmail.com','0785817222','ARUSHA','JOYCE LAURENT KIPARA','karimxhaban@gmail.com','0628370174','DODOMA','box','10','10','10','10','CONFIDENTIAL','10000','FRAGILE','IN PROGRESS','not delivered','2025/04/18 04:05:01','admin','8000','T','2025/04/18 04:05:01','admin'),
('ADV-20250418040619','express','urgent','2025-04-18','2025-04-25','HARUNA SHABAN HARUNA','officialkareem01@gmail.com','0785817222','ARUSHA','JOYCE LAURENT KIPARA','karimxhaban@gmail.com','0628370174','DODOMA','box','10','10','10','10','CONFIDENTIAL','10000','FRAGILE','IN PROGRESS','not delivered','2025/04/18 04:06:19','admin','8000','T','2025/04/18 04:06:19','admin'),
('ADV-20250418040627','express','urgent','2025-04-18','2025-04-25','HARUNA SHABAN HARUNA','officialkareem01@gmail.com','0785817222','ARUSHA','JOYCE LAURENT KIPARA','karimxhaban@gmail.com','0628370174','DODOMA','box','10','10','10','10','CONFIDENTIAL','10000','FRAGILE','IN PROGRESS','not delivered','2025/04/18 04:06:27','admin','8000','T','2025/04/18 04:06:27','admin'),
('ADV-20250418040810','extreme','urgent','2025-04-18','2025-04-25','HARUNA SHABAN HARUNA','officialkareem01@gmail.com','0785817222','ARUSHA','JOYCE LAURENT KIPARA','karimxhaban@gmail.com','0628370174','DODOMA','box','10','10','10','10','CONFIDENTIAL','10000','FRAGILE','IN PROGRESS','not delivered','2025/04/18 04:08:10','admin','10000','T','2025/04/18 04:08:10','admin'),
('ADV-20250418041123','','','','','','','','','','','','','','','','','','','','','','not delivered','2025/04/18 04:11:23','admin','','','2025/04/18 04:11:23','admin'),
('ADV-20250418042748','standard','regular','2025-04-18','2025-04-25','KARIM SHABAN HARUNA','officialkareem01@gmail.com','0785817333','ARUSHA','JOYCE LAURENT KIPARA','karimxhaban@gmail.com','0628370174','DODOMA','envelope','12','12','12','12','CONFIDENTIAL','12345','none','IN PROGRESS','not delivered','2025/04/18 04:27:48','admin','11234','T','2025/04/18 04:27:48','admin'),
('ADV-20250418043617','standard','regular','2025-04-18','2025-04-25','KARIM SHABAN HARUNA','officialkareem01@gmail.com','0785817333','ARUSHA','JOYCE LAURENT KIPARA','karimxhaban@gmail.com','0628370174','DODOMA','envelope','12','12','12','12','CONFIDENTIAL','12345','none','IN PROGRESS','not delivered','2025/04/18 04:36:17','admin','11234','T','2025/04/18 04:36:17','admin'),
('ADV-20250418045403','express','priority','2025-04-18','2025-04-25','KARIM SHABAN HARUNA','karimxhaban@gmail.com','0785817222','ARUSHA','JOYCE LAURENT KIPARA','karimxhaban@gmail.com','0628370174','DODOMA','box','12','12','13','12','document','10000','none','IN PROGRESS','not delivered','2025/04/18 04:54:03','admin','10000','T','2025/04/18 04:54:03','admin'),
('ADV-20250418045858','adventure','urgent','2025-04-19','2025-04-26','IGNASS MAJALIWA YAHAYA','officialkareem01@gmail.com','0785817222','MBEYA','MACRICE MAJALIWA YAHAYA','karimxhaban@gmail.com','0628370174','MPANDA','envelope','12','12','12','12','12','12000','HANDLE WITH CARE','IN PROGRESS','not delivered','2025/04/18 04:58:58','admin','10000','T','2025-04-18 05:29:10','admin'),
('ADV-20250418070535','adventure','urgent','2025-04-18','2025-04-19','KARIM SHABAN HARUNA','officialkareem01@gmail.com','255785817222','MBEYA','MR FRANK','karimxhaban@gmail.com','255715477070','ARUSHA','box','1','12','12','12','CONFIDENTIAL','2000','Handle with care','On transit','not delivered','2025/04/18 07:05:35','admin','1000','T','2025/04/18 07:05:35','admin'),
('ADV-20250418070622','adventure','urgent','2025-04-18','2025-04-19','KARIM SHABAN HARUNA','officialkareem01@gmail.com','255785817222','MBEYA','MR FRANK','karimxhaban@gmail.com','255715477070','ARUSHA','box','1','12','12','12','CONFIDENTIAL','2000','Handle with care','On transit','not delivered','2025/04/18 07:06:22','admin','1000','T','2025/04/18 07:06:22','admin'),
('ADV-20250418070948','adventure','urgent','2025-04-18','2025-04-19','KARIM SHABAN HARUNA','officialkareem01@gmail.com','255785817222','MBEYA','MR FRANK','karimxhaban@gmail.com','255715477070','ARUSHA','box','1','12','12','12','CONFIDENTIAL','2000','Handle with care','On transit','not delivered','2025/04/18 07:09:48','admin','1000','T','2025/04/18 07:09:48','admin'),
('ADV-20250418071200','adventure','urgent','2025-04-18','2025-04-19','KARIM SHABAN HARUNA','officialkareem01@gmail.com','255785817222','MBEYA','MR FRANK','karimxhaban@gmail.com','255715477070','ARUSHA','box','1','12','12','12','CONFIDENTIAL','2000','Handle with care','On transit','not delivered','2025/04/18 07:12:00','admin','1000','T','2025/04/18 07:12:00','admin'),
('ADV-20250418071333','adventure','urgent','2025-04-18','2025-04-19','KARIM SHABAN HARUNA','officialkareem01@gmail.com','255785817222','MBEYA','MR FRANK','karimxhaban@gmail.com','255715477070','ARUSHA','box','1','12','12','12','CONFIDENTIAL','2000','Handle with care','On transit','not delivered','2025/04/18 07:13:33','admin','1000','T','2025/04/18 07:13:33','admin'),
('ADV-20250418071402','adventure','urgent','2025-04-18','2025-04-19','KARIM SHABAN HARUNA','officialkareem01@gmail.com','255785817222','MBEYA','MR FRANK','karimxhaban@gmail.com','255715477070','ARUSHA','box','1','12','12','12','CONFIDENTIAL','2000','Handle with care','On transit','not delivered','2025/04/18 07:14:02','admin','1000','T','2025/04/18 07:14:02','admin'),
('ADV-20250418073812','adventure','urgent','2025-04-18','2025-04-19','KARIM SHABAN HARUNA','officialkareem01@gmail.com','255785817222','MBEYA','MR FRANK','karimxhaban@gmail.com','255715477070','ARUSHA','box','1','12','12','12','CONFIDENTIAL','2000','Handle with care','On transit','not delivered','2025/04/18 07:38:12','admin','1000','T','2025/04/18 07:38:12','admin'),
('ADV-20250418073934','standard','priority','2025-04-20','2025-04-21','FELISTER BILEGA','bilega@gmail.com','0785817333','KASULU','OMARY MAJALIWA YAHAYA','omary@gmail.com','0785817222','MWANZA','box','10','12','12','12','FISH','30000','HANDLE WITH CARE','','not delivered','2025/04/18 07:39:34','admin','10000','T','2025-04-20 05:40:42','admin'),
('ADV-20250418073953','adventure','urgent','2025-04-18','2025-04-19','KARIM SHABAN HARUNA','officialkareem01@gmail.com','255785817222','MBEYA','MR FRANK','karimxhaban@gmail.com','255715477070','ARUSHA','box','1','12','12','12','CONFIDENTIAL','2000','Handle with care','On transit','not delivered','2025/04/18 07:39:53','admin','1000','T','2025/04/18 07:39:53','admin');
/*!40000 ALTER TABLE `percels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `id` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `roles` varchar(50) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `terms` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES
('STAFF20250420043039','2025-04-20 043039','admin','KARIM','HARUNA','karimxhaban@gmail.com','0785817222','personal','e807f1fcf82d132f9bb018ca6738a19f','ARUSHA','karimxhaban@gmail.com'),
('STAFF-20250420043432','2025-04-20 04:34:32','admin','OMARY','MAJALIWA','omary@gmail.com','0785817223','business','e807f1fcf82d132f9bb018ca6738a19f','MWANZA','on');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trucks`
--

DROP TABLE IF EXISTS `trucks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trucks` (
  `truck_id` varchar(10) DEFAULT NULL,
  `truck_type` varchar(50) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `driver_phone` varchar(20) DEFAULT NULL,
  `driver_address` varchar(100) DEFAULT NULL,
  `current_location` varchar(10) DEFAULT NULL,
  `driver_referee` varchar(100) DEFAULT NULL,
  `referee_phone` varchar(20) DEFAULT NULL,
  `referee_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trucks`
--

LOCK TABLES `trucks` WRITE;
/*!40000 ALTER TABLE `trucks` DISABLE KEYS */;
INSERT INTO `trucks` VALUES
('T 372 EEL','SCANIA','OMARY MAJALIWA','0628370174','MWANZA','MWANZA','KARIM HARUNA','0785817222','ARUSHA');
/*!40000 ALTER TABLE `trucks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `plate_number` varchar(10) DEFAULT NULL,
  `vehicle_name` varchar(100) DEFAULT NULL,
  `vehicle_type` varchar(100) DEFAULT NULL,
  `make` varchar(100) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `capacity` int(10) DEFAULT NULL,
  `max_volume` int(10) DEFAULT NULL,
  `dimensions` varchar(50) DEFAULT NULL,
  `$fuel_type` varchar(50) DEFAULT NULL,
  `tank_capacity` int(10) DEFAULT NULL,
  `features` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES
('T 400 EBZ','KO','other','BENZ','ACTROS',2024,15,20,'12 x 12 x 12','diesel',400,''),
('T 400 EBY','CHARANGA','truck','BENZ','ACTROS',2000,15,20,'12 x 12 x 17','diesel',400,'AC'),
('T 400 EBW','CHARANGA2','suv','BENZ','ACTROSSE',1234,15,20,'12 x 12 x 12','diesel',400,''),
('T 400 EBW','CHARANGA2','suv','BENZ','ACTROSSE',1234,15,20,'12 x 12 x 12','diesel',400,''),
('T 888 ERP','MEGA','truck','ZHONGTONG','MEGA',2018,18,15,'20 x 10 x 12','diesel',800,'AC, WIFI, BITES'),
('T 888 ERP','MEGA','truck','ZHONGTONG','MEGA',2018,18,15,'20 x 10 x 12','diesel',800,'AC, WIFI, BITES');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `warehouses` (
  `warehouse_id` varchar(10) DEFAULT NULL,
  `warehouse_address` varchar(100) DEFAULT NULL,
  `warehouse_staff` varchar(100) DEFAULT NULL,
  `staff_phone` varchar(20) DEFAULT NULL,
  `warehouse_phone` varchar(20) DEFAULT NULL,
  `warehouse_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
INSERT INTO `warehouses` VALUES
('12','ARUSHA','KARIM HARUNA','0785817222','02483948348','GOOD'),
('14','MWANZA','OMARY MAJALIWA','0785817222','02483948348','GOOD'),
('14','ARUSHA','OMARY MAJALIWA','0785817222','02483948348','GOOD');
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-20 11:52:36
