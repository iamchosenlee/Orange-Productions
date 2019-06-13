-- MySQL dump 10.15  Distrib 10.0.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db2015140525
-- ------------------------------------------------------
-- Server version	10.0.38-MariaDB-0ubuntu0.16.04.1

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
-- Table structure for table `battles`
--

DROP TABLE IF EXISTS `battles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `battles` (
  `b_name` varchar(20) NOT NULL DEFAULT '',
  `year` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`b_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `battles`
--

LOCK TABLES `battles` WRITE;
/*!40000 ALTER TABLE `battles` DISABLE KEYS */;
INSERT INTO `battles` VALUES ('강화해전','2017'),('군산해전','1945'),('김포해전','2000'),('노량해전','1990'),('연평해전','1995'),('영광해전','2014'),('인천해전','2015');
/*!40000 ALTER TABLE `battles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `guest_id` varchar(10) NOT NULL,
  `hotel_id` varchar(10) NOT NULL,
  `room_id` varchar(10) NOT NULL,
  `date_from` varchar(8) NOT NULL,
  `date_to` varchar(8) NOT NULL,
  PRIMARY KEY (`hotel_id`,`guest_id`,`room_id`,`date_from`,`date_to`),
  KEY `guest_id` (`guest_id`),
  KEY `hotel_id` (`hotel_id`,`room_id`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`guest_id`),
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`hotel_id`, `room_id`) REFERENCES `room` (`hotel_id`, `room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES ('c0101','h001','R01','19970730','19970731'),('c0101','h001','R02','20070730','20070731'),('c0103','h001','R01','18880808','18880818'),('c0102','h003','R01','20171003','20171006'),('c0104','h004','R44','18870413','18870420'),('c0106','h004','R77','20081111','20081122'),('c0104','h005','B01','19000203','19000205'),('c0105','h005','B02','19970101','19970104');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `class` varchar(20) NOT NULL DEFAULT '',
  `type` varchar(2) DEFAULT NULL,
  `numGuns` int(10) DEFAULT NULL,
  `displacement` int(10) DEFAULT NULL,
  PRIMARY KEY (`class`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES ('광개토대왕함급','BB',400,6000),('나가사끼함급','FF',100,2000),('세종대왕함급','DD',200,3000),('을지문덕함급','CC',300,4000),('이순신함급','BB',500,10000);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `dept_id` int(10) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(40) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'전산처'),(2,'마케팅'),(3,'영화제작본부'),(4,'음악콘텐츠'),(5,'프리랜서');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `emp_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(40) DEFAULT NULL,
  `dept_id` int(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `work` text NOT NULL,
  PRIMARY KEY (`emp_id`),
  KEY `dept_id` (`dept_id`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'이수민',1,'orange@orange.com','데이터베이스 관리'),(2,'도담',2,'dodam@orange.com','액션영화 전문'),(3,'소은',3,'showeun@orange.com','로맨틱 코미디'),(4,'나은',4,'better@orange.com','인디밴드 전문'),(5,'Conan',3,'coco@orange.com','시나리오 전문');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guest`
--

DROP TABLE IF EXISTS `guest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest` (
  `guest_id` varchar(10) NOT NULL,
  `guest_name` varchar(20) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `guest_city` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`guest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guest`
--

LOCK TABLES `guest` WRITE;
/*!40000 ALTER TABLE `guest` DISABLE KEYS */;
INSERT INTO `guest` VALUES ('c0101','Dumbledore',180,'London'),('c0102','Agota',23,'Budapest'),('c0103','홍길동',30,'Seoul'),('c0104','JackSparrow',55,'LA'),('c0105','moominpapa',61,'Helsinki'),('c0106','Zhuo',55,'Beijing'),('c0110','Elmo',177,'NewYork');
/*!40000 ALTER TABLE `guest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel` (
  `hotel_id` varchar(10) NOT NULL,
  `hotel_name` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel`
--

LOCK TABLES `hotel` WRITE;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` VALUES ('h001','MerlinsBeard','London'),('h002','Kittos','Helsinki'),('h003','Paprika','Budapest'),('h004','ChillDude','LA'),('h005','한국호텔','Seoul');
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notice` (
  `notice_no` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `emp_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`notice_no`),
  KEY `emp_id` (`emp_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  CONSTRAINT `notice_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notice`
--

LOCK TABLES `notice` WRITE;
/*!40000 ALTER TABLE `notice` DISABLE KEYS */;
INSERT INTO `notice` VALUES (1,'MBOT 환경영화제 초청작 선정','제 2019년 환경영화제에 <나의 달콤씁쓸한 라임오렌지나무>가 심야상영작으로 선정되었습니다. 환경영화제 티켓 문의는 담당 PD에게 이메일 주세요.',2,2,'2019-05-19 19:42:23'),(11,'오늘','이 새벽까지 수고하십니다',1,31,'2019-05-19 00:00:00'),(13,'모션캡쳐전문가 모집','타타타 애니메이션에서 급하게 모션캡쳐전문가를 모집합니다. 자세한 사항은 better@orange.com으로 연락주세요.',4,8,'2019-05-19 23:59:21'),(14,'델몬트 PPL 회의 공지','알립니다! 델몬트에서 오렌지 주스 PPL 회의가 이번주 금요일 오후 4시에 자몽 룸에서 있습니다. ',3,6,'2019-05-19 22:19:07'),(16,'어제','1111111111111111',1,31,'2019-05-20 22:43:18');
/*!40000 ALTER TABLE `notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outcomes`
--

DROP TABLE IF EXISTS `outcomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outcomes` (
  `s_name` varchar(20) NOT NULL DEFAULT '',
  `b_name` varchar(20) NOT NULL DEFAULT '',
  `result` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`s_name`,`b_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outcomes`
--

LOCK TABLES `outcomes` WRITE;
/*!40000 ALTER TABLE `outcomes` DISABLE KEYS */;
INSERT INTO `outcomes` VALUES ('chung함','노량해전','침몰'),('hwaung함','노량해전','OK'),('hwaung함','영광해전','손상'),('강함','노량해전','OK'),('강함','영광해전','손상'),('강함','인천해전','OK'),('나가사끼함','군산해전','OK'),('나가사끼함','노량해전','손상'),('나가사끼함','연평해전','침몰'),('도쿄함','노량해전','침몰'),('독도함','강화해전','손상'),('독도함','김포해전','OK'),('독도함','연평해전','손상'),('독도함','영광해전','OK'),('독도함','인천해전','OK'),('서울함','영광해전','OK');
/*!40000 ALTER TABLE `outcomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `project_id` int(10) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(40) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `year` year(4) NOT NULL,
  `director` varchar(30) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `synopsis` text NOT NULL,
  `stage_no` int(4) NOT NULL,
  PRIMARY KEY (`project_id`),
  KEY `emp_id` (`emp_id`),
  KEY `stage_no` (`stage_no`),
  CONSTRAINT `project_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employee` (`emp_id`),
  CONSTRAINT `project_ibfk_2` FOREIGN KEY (`stage_no`) REFERENCES `stage` (`stage_no`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Counter-Clockwork Orange','Crime',2022,'Stanli Cubric',1,'40 years later, the prequel to Clockwork Orange has been finally made',1),(2,'My Bittersweet Orange Tree','Drama',2018,'zeze',2,'My Sweet Orange Tree was bitter after all',5),(5,'어쩔거야','Comedy',2007,'외계인',2,'오늘은 그만 자야해ㅠ',5),(6,'If Life Gives You Lemon','Mocumentary',2023,'찰리 브라운',3,'If Life Gives you Lemon, first ask for a refund, then ask for an exchange for an orange, because you can always make orange juice!',3),(8,'타타타','Animation',2020,'Ddozza',4,'귤껍데기의 모험',2),(31,'생일 축하합니다','Comedy',2019,'이수민',1,'오늘 생일이지만 열심히 과제를 한다.',4),(32,'The Ghost of Godfather','Noir',2020,'Ford Francisca Coppola',2,'오렌지를 물고 죽은 대부가 더 강력해져서 돌아왔다.\r\n이른바 오렌지 몬스터의 전설.',4),(33,'Irish Blood','Documentary',2019,'Ron Weasley',5,'Tracing the Irish Blood for the source of majestic orange hair.\r\nRon Weasley is our King!',5);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `hotel_id` varchar(10) NOT NULL,
  `room_id` varchar(10) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  PRIMARY KEY (`hotel_id`,`room_id`),
  CONSTRAINT `room_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES ('h001','R01','premium_room',80000),('h001','R02','double_room',65000),('h002','R10','double_room',70000),('h002','R12','double_room',65000),('h003','R01','single_room',30000),('h004','R44','single_room',35000),('h004','R77','premium_room',90000),('h005','B01','double_room',50000),('h005','B02','single_room',47000);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ships`
--

DROP TABLE IF EXISTS `ships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ships` (
  `s_name` varchar(20) NOT NULL DEFAULT '',
  `class` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `launched` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`s_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ships`
--

LOCK TABLES `ships` WRITE;
/*!40000 ALTER TABLE `ships` DISABLE KEYS */;
INSERT INTO `ships` VALUES ('Chung함','나가사끼함급','중국','1959'),('hwaung함','세종대왕함급','중국','1995'),('강함','광개토대왕함급','대한민국','1990'),('나가사끼함','나가사끼함급','일본','1945'),('도쿄함','세종대왕함급','일본','1988'),('독도함','이순신함급','대한민국','1995'),('서울함','을지문덕함급','대한민국','1989'),('제주함','세종대왕함급','대한민국','2018');
/*!40000 ALTER TABLE `ships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage`
--

DROP TABLE IF EXISTS `stage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stage` (
  `stage_no` int(10) NOT NULL AUTO_INCREMENT,
  `stage_name` varchar(40) NOT NULL,
  PRIMARY KEY (`stage_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage`
--

LOCK TABLES `stage` WRITE;
/*!40000 ALTER TABLE `stage` DISABLE KEYS */;
INSERT INTO `stage` VALUES (1,'Development'),(2,'Pre-production'),(3,'Production'),(4,'Post-production'),(5,'Released');
/*!40000 ALTER TABLE `stage` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-13 14:25:18
