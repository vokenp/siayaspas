-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: localhost    Database: siayaspas
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `TestTbl`
--

DROP TABLE IF EXISTS `TestTbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TestTbl` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` datetime DEFAULT NULL,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TestTbl`
--

LOCK TABLES `TestTbl` WRITE;
/*!40000 ALTER TABLE `TestTbl` DISABLE KEYS */;
/*!40000 ALTER TABLE `TestTbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adodb_logsql`
--

DROP TABLE IF EXISTS `adodb_logsql`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adodb_logsql` (
  `created` datetime NOT NULL,
  `sql0` varchar(250) NOT NULL,
  `sql1` text NOT NULL,
  `params` text NOT NULL,
  `tracer` text NOT NULL,
  `timer` decimal(16,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adodb_logsql`
--

LOCK TABLES `adodb_logsql` WRITE;
/*!40000 ALTER TABLE `adodb_logsql` DISABLE KEYS */;
INSERT INTO `adodb_logsql` VALUES ('2019-05-16 07:41:39','183.3137146373','INSERT INTO dh_applications ( CREATEDBY, DATECREATED, APPLICATIONNAME, ICONREF, DISPLAYORDER, APPCODE ) VALUES ( \'admin\', \'2019-05-16 07:41:39\', \'Police\', \'fa fa-users\', 5, \'Police\' )','','<br>localhost/myspzadmin/admin/bin/ManageRecords.php',0.093266),('2019-05-16 07:46:34','181.903442449','INSERT INTO dh_applications ( CREATEDBY, DATECREATED, APPLICATIONNAME, ICONREF, DISPLAYORDER, APPCODE ) VALUES ( \'admin\', \'2019-05-16 07:46:34\', \'sfdasdf\', \'fsasfd\', 22, \'sfdasdf\' )','','<br>localhost/myspzadmin/admin/bin/ManageRecords.php',0.074231),('2019-05-16 07:48:10','33.2187596038','SELECT * FROM audit_trail LIMIT 1','','<br>localhost/myspzadmin/admin/bin/ManageRecords.php',0.078794);
/*!40000 ALTER TABLE `adodb_logsql` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appconfigs`
--

DROP TABLE IF EXISTS `appconfigs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appconfigs` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `confName` varchar(255) DEFAULT NULL,
  `confValue` varchar(255) DEFAULT NULL,
  `confType` varchar(255) DEFAULT NULL,
  `AttribLabel` varchar(255) DEFAULT NULL,
  `AttribType` varchar(255) DEFAULT NULL,
  `AttribRequired` varchar(255) DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appconfigs`
--

LOCK TABLES `appconfigs` WRITE;
/*!40000 ALTER TABLE `appconfigs` DISABLE KEYS */;
INSERT INTO `appconfigs` VALUES (1,'admin','2018-02-16 10:16:24','admin','2020-07-29 11:55:03','AccessToken','cKoGFaAeOoVPaFGQg3ZAun2fMJOv','MpesaAPI','YearRange','number','true'),(2,'admin','2016-02-18 03:25:52','admin','2020-07-29 11:55:03','AccessTokenQuarto','6W30jWQ1sVtfDD3UC8M7cTqhQLyI','MpesaAPI','AccessTokenQuarto','text','True'),(3,'admin','2016-02-18 03:26:30','admin','2021-06-17 12:56:06','ApiKey','e876d62b8da1ceb4f270272631b2dd33784686d88053741a064407cfb27243d1','SMSAPI','ApiKey','text','True'),(4,'admin','2016-02-18 03:44:15','','1900-01-01 00:00:00','AssetPath','/var/www/html/siayaspas/assets/StoragePool/','AssetPath','Asset Storage Path','text','True'),(5,'admin','2016-02-18 04:09:55','admin','2021-07-08 22:24:20','smtpauth','true','Mail','SMTP Authutication','text','True'),(6,'admin','2016-02-18 04:10:14','admin','2021-07-08 22:24:20','smtpuser','vphptest@gmail.com','Mail','SMTP UserName','text','True'),(7,'admin','2016-02-18 04:10:36','admin','2021-07-08 22:24:20','smtppass','mainguru@home','Mail','SMTP Password','password','True'),(8,'admin','2016-02-18 04:10:52','admin','2021-07-08 22:24:20','smtphost','smtp.gmail.com','Mail','SMTP Host','text','True'),(9,'admin','2016-02-18 04:11:10','admin','2021-07-08 22:24:20','smtpsecure','ssl','Mail','SMTP Security','text','True'),(10,'admin','2016-02-18 04:11:37','admin','2021-07-08 22:24:20','smtpport','465','Mail','SMTP Port','number','True'),(11,'admin','2017-11-01 07:26:41','admin','2021-07-08 22:25:05','CompanyName','County Assembly of Siaya','CompanyInfo','Company Name','text','True'),(12,'admin','2017-11-01 07:29:00','admin','2021-07-08 22:25:05','CompanyAddress','P.O.BOX 7 -40600','CompanyInfo','Company Address','text','True'),(13,'admin','2017-11-01 07:29:00','admin','2021-07-08 22:25:05','CompanyTel','025','CompanyInfo','Company Telephone','text','True'),(14,'admin','2017-11-01 07:29:00','admin','2021-07-08 22:25:05','CompanyEmail','info@siayaassembly.go.ke','CompanyInfo','Company Email','text','True'),(17,'admin','2017-11-01 07:29:00','admin','2021-07-08 22:25:05','CompanyLogo','http://logo.png','CompanyInfo','CompanyLogo','text','False'),(19,'admin','2018-02-16 10:24:14','admin','2020-07-29 11:55:03','AccessTokenC2B','BKJgZbxVvlY3WuMXzSTo1qTeOblv','MpesaAPI','Querylimit','number','true'),(20,'admin','2018-03-22 06:22:03','admin','2021-07-08 22:25:16','DefaultPassword','siaya041','UserSetting','Default Password','text','True'),(21,'admin','2018-03-28 12:03:48','admin','2021-07-08 22:24:20','SendName','Siaya Assembly Staff Portal','Mail','Sending Name','text','True'),(22,'admin','2021-06-17 09:33:41','admin','2021-06-17 12:56:06','ApiUserName','intellihub','SMSAPI','API UserName','text','True'),(23,'admin','2021-06-17 09:34:15','admin','2021-06-17 12:56:06','ApiFrom','INTELLIHUB','SMSAPI','API From','text','True');
/*!40000 ALTER TABLE `appconfigs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_trail`
--

DROP TABLE IF EXISTS `audit_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_trail` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `OpUser` varchar(255) DEFAULT NULL,
  `OpDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OpAction` varchar(255) DEFAULT NULL,
  `OpTable` varchar(255) DEFAULT NULL,
  `OpItemID` int DEFAULT NULL,
  `OpHost` varchar(255) DEFAULT NULL,
  `OpData` longtext,
  `ModCode` int DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_trail`
--

LOCK TABLES `audit_trail` WRITE;
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
INSERT INTO `audit_trail` VALUES (1,'admin','2021-06-28 08:54:07','Delete','dh_userprofiles',9,'::1','{\"S_ROWID\":\"9\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-27 14:46:49\",\"ModifiedBy\":null,\"DateModified\":null,\"ProfileName\":\"Deacons\",\"ProfileDescription\":\"Deacons\"}',5),(2,'admin','2021-06-28 08:54:17','Delete','dh_userprofiles',8,'::1','{\"S_ROWID\":\"8\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-09-03 15:00:37\",\"ModifiedBy\":null,\"DateModified\":null,\"ProfileName\":\"Supplier\",\"ProfileDescription\":\"Supplier\"}',5),(3,'admin','2021-06-28 08:54:17','Delete','dh_userprofiles',9,'::1','{\"S_ROWID\":\"\",\"CreatedBy\":\"\",\"DateCreated\":\"\",\"ModifiedBy\":\"\",\"DateModified\":\"\",\"ProfileName\":\"\",\"ProfileDescription\":\"\"}',5),(4,'admin','2021-06-28 08:55:58','Delete','dh_modules',59,'::1','{\"S_ROWID\":\"59\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-23 16:16:52\",\"ModifiedBy\":\"admin\",\"DateModified\":\"2021-03-23 16:52:20\",\"ModuleName\":\"Contribution Per District\",\"ModuleCode\":\"ContributionPerDistrict_59\",\"TableName\":\"vw_contrib_rpt\",\"AppName\":\"Reports\",\"ACL\":null,\"DisplayOrder\":\"1\",\"IconRef\":\"fa fa-chess-knight\",\"DeleteItems\":\"N\",\"CheckExist\":null,\"EnableCreation\":\"N\",\"DisplayButton\":null,\"ModuleType\":\"ReportView\",\"ModuleListView\":\"Custom\",\"ExcludePermsList\":\"N\",\"ParentTable\":null,\"ExemptRole\":\"N\",\"ButtonType\":\"OpenLink\",\"ButtonAttributes\":null,\"EnablePreview\":\"N\",\"Helpcontext\":null,\"ListingType\":\"InApplication\",\"CreateBtnType\":\"OpenPage\"}',0),(5,'admin','2021-06-28 08:56:14','Delete','dh_modules',52,'::1','{\"S_ROWID\":\"52\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-09-03 15:14:07\",\"ModifiedBy\":\"admin\",\"DateModified\":\"2020-09-03 15:17:33\",\"ModuleName\":\"My Invoices\",\"ModuleCode\":\"MyInvoices_52\",\"TableName\":\"tbl_invoices\",\"AppName\":\"General\",\"ACL\":\"Supplier\",\"DisplayOrder\":\"1\",\"IconRef\":\"fa fa-code\",\"DeleteItems\":\"N\",\"CheckExist\":null,\"EnableCreation\":\"Y\",\"DisplayButton\":null,\"ModuleType\":\"CRUD\",\"ModuleListView\":\"Custom\",\"ExcludePermsList\":\"N\",\"ParentTable\":null,\"ExemptRole\":\"N\",\"ButtonType\":\"OpenLink\",\"ButtonAttributes\":null,\"EnablePreview\":\"Y\",\"Helpcontext\":null,\"ListingType\":\"InApplication\",\"CreateBtnType\":\"OpenPage\"}',0),(6,'admin','2021-06-28 08:56:18','Delete','dh_modules',56,'::1','{\"S_ROWID\":\"56\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-09 16:20:02\",\"ModifiedBy\":null,\"DateModified\":null,\"ModuleName\":\"Members\",\"ModuleCode\":\"Members_56\",\"TableName\":\"vw_members\",\"AppName\":\"General\",\"ACL\":null,\"DisplayOrder\":\"1\",\"IconRef\":\"fa fa-users\",\"DeleteItems\":\"Y\",\"CheckExist\":null,\"EnableCreation\":\"Y\",\"DisplayButton\":null,\"ModuleType\":\"CRUD\",\"ModuleListView\":\"Default\",\"ExcludePermsList\":\"N\",\"ParentTable\":\"tbl_members\",\"ExemptRole\":\"N\",\"ButtonType\":\"OpenLink\",\"ButtonAttributes\":null,\"EnablePreview\":\"Y\",\"Helpcontext\":null,\"ListingType\":\"InApplication\",\"CreateBtnType\":\"OpenPage\"}',0),(7,'admin','2021-06-28 08:56:29','Delete','dh_modules',58,'::1','{\"S_ROWID\":\"58\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-10 15:13:04\",\"ModifiedBy\":null,\"DateModified\":null,\"ModuleName\":\"Manage Contributions\",\"ModuleCode\":\"ManageContributions_58\",\"TableName\":\"vw_contribution\",\"AppName\":\"General\",\"ACL\":null,\"DisplayOrder\":\"1\",\"IconRef\":\"fa fa-dollar-sign\",\"DeleteItems\":\"Y\",\"CheckExist\":null,\"EnableCreation\":\"Y\",\"DisplayButton\":null,\"ModuleType\":\"CRUD\",\"ModuleListView\":\"Default\",\"ExcludePermsList\":\"N\",\"ParentTable\":\"tbl_contributions\",\"ExemptRole\":\"N\",\"ButtonType\":\"OpenLink\",\"ButtonAttributes\":null,\"EnablePreview\":\"Y\",\"Helpcontext\":null,\"ListingType\":\"InApplication\",\"CreateBtnType\":\"OpenPage\"}',0),(8,'admin','2021-06-28 08:56:37','Delete','dh_modules',57,'::1','{\"S_ROWID\":\"57\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-10 12:35:43\",\"ModifiedBy\":null,\"DateModified\":null,\"ModuleName\":\"Church Districts\",\"ModuleCode\":\"ChurchDistricts_57\",\"TableName\":\"vw_churchdistricts\",\"AppName\":\"General\",\"ACL\":null,\"DisplayOrder\":\"2\",\"IconRef\":\"fa fa-certificate\",\"DeleteItems\":\"Y\",\"CheckExist\":null,\"EnableCreation\":\"Y\",\"DisplayButton\":null,\"ModuleType\":\"CRUD\",\"ModuleListView\":\"Default\",\"ExcludePermsList\":\"N\",\"ParentTable\":\"tbl_districts\",\"ExemptRole\":\"N\",\"ButtonType\":\"OpenLink\",\"ButtonAttributes\":null,\"EnablePreview\":\"Y\",\"Helpcontext\":null,\"ListingType\":\"InApplication\",\"CreateBtnType\":\"OpenPage\"}',0),(9,'admin','2021-06-28 08:57:17','Delete','listitems',1554,'::1','{\"S_ROWID\":\"1554\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-09-08 15:01:28\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Non-LPO\",\"ItemDescription\":\"Non-LPO\",\"ItemType\":\"InvoiceType\",\"ParentID\":null}',29),(10,'admin','2021-06-28 08:57:20','Delete','listitems',1553,'::1','{\"S_ROWID\":\"1553\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-09-08 15:01:02\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"LPO\",\"ItemDescription\":\"LPO\",\"ItemType\":\"InvoiceType\",\"ParentID\":null}',29),(11,'admin','2021-06-28 08:57:29','Delete','listitems',1559,'::1','{\"S_ROWID\":\"1559\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-09-12 17:01:17\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Treasurer\",\"ItemDescription\":\"Treasurer\",\"ItemType\":\"MemberType\",\"ParentID\":null}',29),(12,'admin','2021-06-28 08:57:32','Delete','listitems',1558,'::1','{\"S_ROWID\":\"1558\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-09-12 17:00:53\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Secretary\",\"ItemDescription\":\"Secretary\",\"ItemType\":\"MemberType\",\"ParentID\":null}',29),(13,'admin','2021-06-28 08:57:34','Delete','listitems',1557,'::1','{\"S_ROWID\":\"1557\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-09-12 17:00:30\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"OrganizingSecretary\",\"ItemDescription\":\"Organizing Secretary\",\"ItemType\":\"MemberType\",\"ParentID\":null}',29),(14,'admin','2021-06-28 08:57:36','Delete','listitems',1556,'::1','{\"S_ROWID\":\"1556\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-09-12 17:00:09\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"ChairPerson\",\"ItemDescription\":\"ChairPerson\",\"ItemType\":\"MemberType\",\"ParentID\":null}',29),(15,'admin','2021-06-28 08:57:38','Delete','listitems',1555,'::1','{\"S_ROWID\":\"1555\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-09-12 16:59:49\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Member\",\"ItemDescription\":\"Member\",\"ItemType\":\"MemberType\",\"ParentID\":null}',29),(16,'admin','2021-06-28 08:57:45','Delete','listitems',1571,'::1','{\"S_ROWID\":\"1571\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-10 15:44:40\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Cheque\",\"ItemDescription\":\"Cheque\",\"ItemType\":\"ModeofPayment\",\"ParentID\":null}',29),(17,'admin','2021-06-28 08:57:48','Delete','listitems',1564,'::1','{\"S_ROWID\":\"1564\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-10-17 14:26:09\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"M-Pesa\",\"ItemDescription\":\"M-Pesa\",\"ItemType\":\"ModeofPayment\",\"ParentID\":null}',29),(18,'admin','2021-06-28 08:57:51','Delete','listitems',1563,'::1','{\"S_ROWID\":\"1563\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2020-10-17 14:25:02\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Cash\",\"ItemDescription\":\"Cash\",\"ItemType\":\"ModeofPayment\",\"ParentID\":null}',29),(19,'admin','2021-06-28 08:57:56','Delete','listitems',1569,'::1','{\"S_ROWID\":\"1569\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-10 12:37:27\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Elder\",\"ItemDescription\":\"Elder\",\"ItemType\":\"ChurchRole\",\"ParentID\":null}',29),(20,'admin','2021-06-28 08:57:59','Delete','listitems',1568,'::1','{\"S_ROWID\":\"1568\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-10 12:37:21\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Deacon\",\"ItemDescription\":\"Deacon\",\"ItemType\":\"ChurchRole\",\"ParentID\":null}',29),(21,'admin','2021-06-28 08:58:01','Delete','listitems',1567,'::1','{\"S_ROWID\":\"1567\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-10 12:37:00\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Member\",\"ItemDescription\":\"Member\",\"ItemType\":\"ChurchRole\",\"ParentID\":null}',29),(22,'admin','2021-06-28 08:58:08','Delete','listitems',1574,'::1','{\"S_ROWID\":\"1574\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-10 15:46:27\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"First Fruit\",\"ItemDescription\":\"First Fruit\",\"ItemType\":\"ContributionType\",\"ParentID\":null}',29),(23,'admin','2021-06-28 08:58:11','Delete','listitems',1572,'::1','{\"S_ROWID\":\"1572\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-10 15:45:57\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Offering\",\"ItemDescription\":\"Offering\",\"ItemType\":\"ContributionType\",\"ParentID\":null}',29),(24,'admin','2021-06-28 08:58:13','Delete','listitems',1573,'::1','{\"S_ROWID\":\"1573\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-10 15:46:09\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Tithe\",\"ItemDescription\":\"Tithe\",\"ItemType\":\"ContributionType\",\"ParentID\":null}',29),(25,'admin','2021-06-28 08:58:19','Delete','listitems',1578,'::1','{\"S_ROWID\":\"1578\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-23 14:54:42\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Mens Committee\",\"ItemDescription\":\"Mens Committee\",\"ItemType\":\"ChurchGroups\",\"ParentID\":null}',29),(26,'admin','2021-06-28 08:58:22','Delete','listitems',1577,'::1','{\"S_ROWID\":\"1577\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-23 13:49:47\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Women Guild\",\"ItemDescription\":\"Women Guild\",\"ItemType\":\"ChurchGroups\",\"ParentID\":null}',29),(27,'admin','2021-06-28 08:58:24','Delete','listitems',1576,'::1','{\"S_ROWID\":\"1576\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-23 13:46:48\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Choir\",\"ItemDescription\":\"Choir\",\"ItemType\":\"ChurchGroups\",\"ParentID\":null}',29),(28,'admin','2021-06-28 08:58:46','Delete','listitems',1624,'::1','{\"S_ROWID\":\"1624\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-06-17 17:58:23\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"5\",\"ItemDescription\":\"\",\"ItemType\":\"ChurchGroupMember\",\"ParentID\":null}',29),(29,'admin','2021-06-28 08:58:48','Delete','listitems',1623,'::1','{\"S_ROWID\":\"1623\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-06-17 17:10:26\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"6\",\"ItemDescription\":\"Mens Committee\",\"ItemType\":\"ChurchGroupMember\",\"ParentID\":null}',29),(30,'admin','2021-06-28 08:58:51','Delete','listitems',1622,'::1','{\"S_ROWID\":\"1622\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-06-17 17:10:26\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"6\",\"ItemDescription\":\"Women Guild\",\"ItemType\":\"ChurchGroupMember\",\"ParentID\":null}',29),(31,'admin','2021-06-28 08:58:53','Delete','listitems',1621,'::1','{\"S_ROWID\":\"1621\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-06-17 17:10:25\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"6\",\"ItemDescription\":\"Choir\",\"ItemType\":\"ChurchGroupMember\",\"ParentID\":null}',29),(32,'admin','2021-06-28 08:58:55','Delete','listitems',1601,'::1','{\"S_ROWID\":\"1601\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-27 14:45:15\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"1\",\"ItemDescription\":\"\",\"ItemType\":\"ChurchGroupMember\",\"ParentID\":null}',29),(33,'admin','2021-06-28 08:58:57','Delete','listitems',1597,'::1','{\"S_ROWID\":\"1597\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-23 15:22:03\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"3\",\"ItemDescription\":\"Mens Committee\",\"ItemType\":\"ChurchGroupMember\",\"ParentID\":null}',29),(34,'admin','2021-06-28 08:59:00','Delete','listitems',1596,'::1','{\"S_ROWID\":\"1596\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-23 15:21:49\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"7\",\"ItemDescription\":\"Choir\",\"ItemType\":\"ChurchGroupMember\",\"ParentID\":null}',29),(35,'admin','2021-06-28 09:00:17','INSERT','dh_columns',250,'::1','{\"TblName\":\"goodtable\",\"DisplayName\":\"First Name\",\"FieldName\":\"fname\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(36,'admin','2021-06-28 09:51:30','INSERT','dh_columns',251,'::1','{\"TblName\":\"badtable\",\"DisplayName\":\"ChurchGroups\",\"FieldName\":\"ChurchGroups\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(37,'admin','2021-06-28 09:54:22','INSERT','dh_columns',252,'::1','{\"TblName\":\"badtable\",\"DisplayName\":\"First Name\",\"FieldName\":\"fname\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(38,'admin','2021-07-08 07:25:27','INSERT','dh_columns',253,'10.0.0.2','{\"TblName\":\"tbl_sections\",\"DisplayName\":\"SectionName\",\"FieldName\":\"SectionName\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(39,'admin','2021-07-08 10:58:12','INSERT','dh_columns',254,'10.0.0.2','{\"TblName\":\"tbl_section1\",\"DisplayName\":\"Staff Name \",\"FieldName\":\"StaffName \",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(40,'admin','2021-07-08 10:58:27','INSERT','dh_columns',255,'10.0.0.2','{\"TblName\":\"tbl_section1\",\"DisplayName\":\"PFNo\",\"FieldName\":\"PFNO\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(41,'admin','2021-07-08 10:58:40','INSERT','dh_columns',256,'10.0.0.2','{\"TblName\":\"tbl_section1\",\"DisplayName\":\"Department\",\"FieldName\":\"Department\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(42,'admin','2021-07-08 10:58:56','INSERT','dh_columns',257,'10.0.0.2','{\"TblName\":\"tbl_section1\",\"DisplayName\":\"Section\",\"FieldName\":\"Section\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(43,'admin','2021-07-08 11:26:23','INSERT','dh_columns',258,'10.0.0.2','{\"TblName\":\"tbl_section1\",\"DisplayName\":\"Designation\",\"FieldName\":\"Designation\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(44,'admin','2021-07-08 11:26:37','INSERT','dh_columns',259,'10.0.0.2','{\"TblName\":\"tbl_section1\",\"DisplayName\":\"Term of Service \",\"FieldName\":\"TermofService \",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(45,'admin','2021-07-08 11:26:51','INSERT','dh_columns',260,'10.0.0.2','{\"TblName\":\"tbl_section1\",\"DisplayName\":\"Scale\",\"FieldName\":\"Scale\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(46,'admin','2021-07-08 11:27:05','INSERT','dh_columns',261,'10.0.0.2','{\"TblName\":\"tbl_section1\",\"DisplayName\":\"With Effect Date \",\"FieldName\":\"WithEffectDate \",\"DataType\":\"D\",\"CreatedBy\":\"admin\"}',999),(47,'admin','2021-07-08 19:08:36','INSERT','dh_userprofiles',10,'10.0.0.2','{\"ProfileName\":\"HeadofSections\",\"ProfileDescription\":\"HeadofSections\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-07-08 12:08:36\"}',5),(48,'admin','2021-07-08 19:08:54','INSERT','dh_userprofiles',11,'10.0.0.2','{\"ProfileName\":\"HeadofDepartments\",\"ProfileDescription\":\"HeadofDepartments\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-07-08 12:08:54\"}',5),(49,'admin','2021-07-08 19:13:32','INSERT','dh_userprofiles',12,'10.0.0.2','{\"ProfileName\":\"Directorate\",\"ProfileDescription\":\"Directorate\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-07-08 22:13:32\"}',5),(50,'admin','2021-07-08 19:13:52','INSERT','dh_userprofiles',13,'10.0.0.2','{\"ProfileName\":\"Appraisee\",\"ProfileDescription\":\"Appraisee\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-07-08 22:13:52\"}',5),(51,'admin','2021-07-08 19:15:03','INSERT','dh_applications',22,'10.0.0.2','{\"AppCode\":\"Administration\",\"ApplicationName\":\"Administration\",\"IconRef\":\"fa fa-users\",\"DisplayOrder\":\"1\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-07-08 22:15:03\"}',0),(52,'admin','2021-07-08 19:16:06','INSERT','dh_columns',262,'10.0.0.2','{\"TblName\":\"tbl_directorates\",\"DisplayName\":\"Directorate Code \",\"FieldName\":\"DirectorateCode \",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(53,'admin','2021-07-08 19:16:20','INSERT','dh_columns',263,'10.0.0.2','{\"TblName\":\"tbl_directorates\",\"DisplayName\":\"DirectorateName \",\"FieldName\":\"DirectorateName \",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(54,'admin','2021-07-08 19:16:34','INSERT','dh_columns',264,'10.0.0.2','{\"TblName\":\"tbl_directorates\",\"DisplayName\":\"HeadedBy \",\"FieldName\":\"HeadedBy \",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(55,'admin','2021-07-08 19:17:26','INSERT','dh_modules',60,'10.0.0.2','{\"ModuleCode\":\"ManageDirectorates_60\",\"ModuleName\":\"Manage Directorates\",\"AppName\":\"Administration\",\"TableName\":\"tbl_directorates\",\"IconRef\":\"fa fa-anchor\",\"DisplayOrder\":\"1\",\"CreatedBy\":\"admin\"}',999),(56,'admin','2021-07-08 19:21:22','INSERT','tbl_directorates',2,'10.0.0.2','{\"CreatedBy\":\"admin\",\"ModifiedBy\":\"dd\",\"DateCreated\":\"2021-07-08 22:21:22\"}',60),(57,'admin','2021-07-08 19:25:51','UPDATE','dh_users',1,'10.0.0.2','[{\"Field\":\"PhoneExt\",\"Ovalue\":\"433\",\"Nvalue\":\"433jj\"}]',2),(58,'admin','2021-07-08 19:26:00','UPDATE','dh_users',1,'10.0.0.2','[{\"Field\":\"Fullname\",\"Ovalue\":\"System Admini\",\"Nvalue\":\"System Bazu\"}]',2),(59,'admin','2021-07-09 06:40:11','INSERT','dh_usergroups',11,'127.0.0.1','{\"GroupCode\":\"HeadofSections\",\"GroupName\":\"HeadofSections\",\"GroupDescription\":\"HeadofSections\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-07-09 09:40:10\"}',6),(60,'admin','2021-07-15 07:58:43','INSERT','dh_columns',265,'10.0.0.2','{\"TblName\":\"tbl_departments\",\"DisplayName\":\"Department Code\",\"FieldName\":\"DepartmentCode\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(61,'admin','2021-07-15 07:58:55','INSERT','dh_columns',266,'10.0.0.2','{\"TblName\":\"tbl_departments\",\"DisplayName\":\"Department Name \",\"FieldName\":\"DepartmentName \",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(62,'admin','2021-07-15 07:59:09','INSERT','dh_columns',267,'10.0.0.2','{\"TblName\":\"tbl_departments\",\"DisplayName\":\"DirectorateID\",\"FieldName\":\"DirectorateID\",\"DataType\":\"I\",\"CreatedBy\":\"admin\"}',999),(63,'admin','2021-07-15 07:59:58','INSERT','dh_columns',268,'10.0.0.2','{\"TblName\":\"tbl_sections\",\"DisplayName\":\"SectionCode\",\"FieldName\":\"SectionCode\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(64,'admin','2021-07-15 08:00:09','INSERT','dh_columns',269,'10.0.0.2','{\"TblName\":\"tbl_sections\",\"DisplayName\":\"HeadofSection\",\"FieldName\":\"HeadofSection\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(65,'admin','2021-07-15 08:00:21','INSERT','dh_columns',270,'10.0.0.2','{\"TblName\":\"tbl_sections\",\"DisplayName\":\"DepartmentID\",\"FieldName\":\"DepartmentID\",\"DataType\":\"I\",\"CreatedBy\":\"admin\"}',999),(66,'admin','2021-07-15 08:02:48','INSERT','dh_modules',61,'10.0.0.2','{\"ModuleCode\":\"ManageDepartments_61\",\"ModuleName\":\"Manage Departments\",\"AppName\":\"Administration\",\"TableName\":\"vw_departments\",\"IconRef\":\"fa fa-angle-double-right\",\"DisplayOrder\":\"2\",\"CreatedBy\":\"admin\"}',999),(67,'admin','2021-07-15 08:04:00','INSERT','dh_modules',62,'10.0.0.2','{\"ModuleCode\":\"ManageSections_61\",\"ModuleName\":\"Manage Sections\",\"AppName\":\"Administration\",\"TableName\":\"vw_sections\",\"IconRef\":\"fa fa-angle-down\",\"DisplayOrder\":\"3\",\"CreatedBy\":\"admin\"}',999),(68,'admin','2021-08-13 09:53:16','UPDATE','dh_modules',6,'127.0.0.1','[{\"Field\":\"DeleteItems\",\"Ovalue\":\"N\",\"Nvalue\":\"Y\"}]',0),(69,'admin','2021-08-13 09:54:45','UPDATE','dh_modules',6,'127.0.0.1','[{\"Field\":\"DeleteItems\",\"Ovalue\":\"Y\",\"Nvalue\":\"N\"}]',0),(70,'admin','2021-08-13 09:55:17','INSERT','dh_usergroups',12,'127.0.0.1','{\"GroupCode\":\"HeadofDepartments\",\"GroupName\":\"HeadofDepartments\",\"GroupDescription\":\"HeadofDepartments\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-08-13 12:55:16\"}',6),(71,'admin','2021-08-13 09:55:41','INSERT','dh_usergroups',13,'127.0.0.1','{\"GroupCode\":\"Directorate\",\"GroupName\":\"Directorate\",\"GroupDescription\":\"Directorate\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-08-13 12:55:40\"}',6),(72,'admin','2021-08-13 09:56:45','INSERT','dh_usergroups',14,'127.0.0.1','{\"GroupCode\":\"SectionTeamPlayer\",\"GroupName\":\"SectionTeamPlayer\",\"GroupDescription\":\"Section Team Player\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-08-13 12:56:45\"}',6),(73,'admin','2021-08-13 09:57:12','INSERT','dh_userprofiles',14,'127.0.0.1','{\"ProfileName\":\"SectionTeamPlayer\",\"ProfileDescription\":\"Section Team Player\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-08-13 12:57:12\"}',5),(74,'admin','2021-08-13 09:58:53','Delete','listitems',1600,'127.0.0.1','{\"S_ROWID\":\"1600\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-03-27 12:23:15\",\"ModifiedBy\":null,\"DateModified\":null,\"ItemCode\":\"Deacon\",\"ItemDescription\":\"Deacon\",\"ItemType\":\"usertype\",\"ParentID\":null}',29),(75,'admin','2021-08-13 09:59:19','INSERT','listitems',1636,'127.0.0.1','{\"ItemType\":\"usertype\",\"ItemCode\":\"SectionTeamPlayer\",\"ItemDescription\":\"SectionTeamPlayer\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-08-13 12:59:19\"}',0),(76,'admin','2021-08-13 09:59:31','INSERT','listitems',1637,'127.0.0.1','{\"ItemType\":\"usertype\",\"ItemCode\":\"HeadofSections\",\"ItemDescription\":\"HeadofSections\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-08-13 12:59:31\"}',0),(77,'admin','2021-08-13 09:59:41','INSERT','listitems',1638,'127.0.0.1','{\"ItemType\":\"usertype\",\"ItemCode\":\"HeadofDepartments\",\"ItemDescription\":\"HeadofDepartments\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-08-13 12:59:41\"}',0),(78,'admin','2021-08-13 09:59:54','INSERT','listitems',1639,'127.0.0.1','{\"ItemType\":\"usertype\",\"ItemCode\":\"Directorate\",\"ItemDescription\":\"Directorate\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-08-13 12:59:54\"}',0),(79,'admin','2021-09-09 08:42:22','Delete','listitems',1149,'::1','{\"S_ROWID\":\"1149\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2019-05-15 07:58:04\",\"ModifiedBy\":\"\",\"DateModified\":null,\"ItemCode\":\"dh_users\",\"ItemDescription\":\"dh_users\",\"ItemType\":\"SystemTables\",\"ParentID\":\"0\"}',29),(80,'admin','2021-09-09 08:53:06','INSERT','dh_columns',271,'::1','{\"TblName\":\"dh_users\",\"DisplayName\":\"Job Group\",\"FieldName\":\"JobGroup\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(81,'admin','2021-09-09 08:53:38','INSERT','dh_columns',272,'::1','{\"TblName\":\"dh_users\",\"DisplayName\":\"Terms of Service\",\"FieldName\":\"TermsofService\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(82,'admin','2021-09-09 08:54:29','INSERT','dh_columns',273,'::1','{\"TblName\":\"dh_users\",\"DisplayName\":\"Effect Date\",\"FieldName\":\"EffectDate\",\"DataType\":\"D\",\"CreatedBy\":\"admin\"}',999),(83,'admin','2021-09-09 09:05:42','INSERT','listitems',1640,'::1','{\"ItemType\":\"TermsofService\",\"ItemCode\":\"Permanent\",\"ItemDescription\":\"Permanent\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-09-09 12:05:42\"}',0),(84,'admin','2021-09-09 09:05:52','INSERT','listitems',1641,'::1','{\"ItemType\":\"TermsofService\",\"ItemCode\":\"Contract\",\"ItemDescription\":\"Contract\",\"CreatedBy\":\"admin\",\"DateCreated\":\"2021-09-09 12:05:52\"}',0),(85,'admin','2021-09-09 09:15:39','UPDATE','dh_users',239,'::1','[{\"Field\":\"Phone\",\"Ovalue\":null,\"Nvalue\":\"254-712-346-528\"},{\"Field\":\"Email\",\"Ovalue\":null,\"Nvalue\":\"20180086088@siayaassembly.co.ke\"},{\"Field\":\"PhoneExt\",\"Ovalue\":null,\"Nvalue\":\"111\"},{\"Field\":\"Department\",\"Ovalue\":null,\"Nvalue\":\"2\"},{\"Field\":\"EffectDate\",\"Ovalue\":null,\"Nvalue\":\"2018-09-23\"}]',2),(86,'admin','2021-09-09 09:19:23','UPDATE','dh_users',239,'::1','[{\"Field\":\"Department\",\"Ovalue\":\"2\",\"Nvalue\":\"\"},{\"Field\":\"EffectDate\",\"Ovalue\":\"2018-09-23\",\"Nvalue\":\"1994-02-23\"}]',2),(87,'admin','2021-09-09 09:21:01','UPDATE','dh_users',239,'::1','[{\"Field\":\"Department\",\"Ovalue\":\"0\",\"Nvalue\":\"\"},{\"Field\":\"EffectDate\",\"Ovalue\":\"1994-02-23\",\"Nvalue\":\"2018-02-23\"}]',2),(88,'admin','2021-09-09 09:27:20','UPDATE','dh_users',230,'::1','[{\"Field\":\"Phone\",\"Ovalue\":null,\"Nvalue\":\"254-700-000-000\"},{\"Field\":\"PhoneExt\",\"Ovalue\":null,\"Nvalue\":\"111\"},{\"Field\":\"user_type\",\"Ovalue\":\"Normal\",\"Nvalue\":\"HeadofDepartments\"}]',2),(89,'admin','2021-09-09 09:28:01','UPDATE','dh_users',242,'::1','[{\"Field\":\"Phone\",\"Ovalue\":null,\"Nvalue\":\"254-700-000-000\"},{\"Field\":\"PhoneExt\",\"Ovalue\":null,\"Nvalue\":\"111\"},{\"Field\":\"Department\",\"Ovalue\":null,\"Nvalue\":\"3\"}]',2),(90,'admin','2021-09-09 09:28:05','UPDATE','dh_users',242,'::1','[{\"Field\":\"Department\",\"Ovalue\":\"3\",\"Nvalue\":\"4\"}]',2),(91,'admin','2021-09-09 09:29:44','UPDATE','dh_users',242,'::1','[{\"Field\":\"Department\",\"Ovalue\":\"4\",\"Nvalue\":\"8\"}]',2),(92,'admin','2021-09-09 09:30:20','UPDATE','dh_users',244,'::1','[{\"Field\":\"Phone\",\"Ovalue\":null,\"Nvalue\":\"254-700-000-000\"},{\"Field\":\"PhoneExt\",\"Ovalue\":null,\"Nvalue\":\"111\"}]',2),(93,'admin','2021-09-09 09:30:24','UPDATE','dh_users',244,'::1','[{\"Field\":\"user_type\",\"Ovalue\":\"Normal\",\"Nvalue\":\"Directorate\"}]',2),(94,'admin','2021-09-09 09:30:28','UPDATE','dh_users',244,'::1','[{\"Field\":\"user_type\",\"Ovalue\":\"Directorate\",\"Nvalue\":\"SectionTeamPlayer\"}]',2),(95,'admin','2021-09-09 09:30:33','UPDATE','dh_users',244,'::1','[{\"Field\":\"Department\",\"Ovalue\":null,\"Nvalue\":\"4\"}]',2),(96,'admin','2021-09-09 09:40:05','UPDATE','dh_users',244,'::1','[{\"Field\":\"Department\",\"Ovalue\":\"4\",\"Nvalue\":\"6\"}]',2),(97,'admin','2021-09-09 11:54:14','UPDATE','dh_users',239,'::1','[{\"Field\":\"Department\",\"Ovalue\":\"0\",\"Nvalue\":\"9\"},{\"Field\":\"Section\",\"Ovalue\":null,\"Nvalue\":\"7\"}]',2),(98,'admin','2021-09-09 11:54:24','UPDATE','dh_users',239,'::1','[{\"Field\":\"Section\",\"Ovalue\":\"7\",\"Nvalue\":\"9\"}]',2),(99,'admin','2021-09-09 11:54:31','UPDATE','dh_users',239,'::1','[{\"Field\":\"Department\",\"Ovalue\":\"9\",\"Nvalue\":\"5\"}]',2),(100,'admin','2021-09-09 11:56:02','UPDATE','dh_users',244,'::1','[{\"Field\":\"Department\",\"Ovalue\":\"6\",\"Nvalue\":\"7\"},{\"Field\":\"Section\",\"Ovalue\":null,\"Nvalue\":\"6\"}]',2),(101,'admin','2021-09-09 12:00:12','UPDATE','dh_users',244,'::1','[{\"Field\":\"Department\",\"Ovalue\":\"7\",\"Nvalue\":\"6\"},{\"Field\":\"Section\",\"Ovalue\":\"6\",\"Nvalue\":\"2\"}]',2),(102,'admin','2021-09-09 12:01:06','UPDATE','dh_users',244,'::1','[{\"Field\":\"Section\",\"Ovalue\":\"2\",\"Nvalue\":\"3\"}]',2),(103,'admin','2021-09-09 12:21:39','UPDATE','dh_users',205,'::1','[{\"Field\":\"Phone\",\"Ovalue\":null,\"Nvalue\":\"254-700-000-000\"},{\"Field\":\"PhoneExt\",\"Ovalue\":null,\"Nvalue\":\"111\"},{\"Field\":\"user_type\",\"Ovalue\":\"Normal\",\"Nvalue\":\"Directorate\"},{\"Field\":\"Department\",\"Ovalue\":null,\"Nvalue\":\"6\"},{\"Field\":\"Section\",\"Ovalue\":null,\"Nvalue\":\"3\"}]',2),(104,'admin','2021-09-09 12:21:52','UPDATE','tbl_directorates',4,'::1','[{\"Field\":\"HeadedBy\",\"Ovalue\":null,\"Nvalue\":\"20140082131\"}]',60),(105,'admin','2021-09-09 12:22:24','UPDATE','dh_users',231,'::1','[{\"Field\":\"Phone\",\"Ovalue\":null,\"Nvalue\":\"254-700-000-000\"},{\"Field\":\"PhoneExt\",\"Ovalue\":null,\"Nvalue\":\"111\"},{\"Field\":\"user_type\",\"Ovalue\":\"Normal\",\"Nvalue\":\"Directorate\"},{\"Field\":\"Department\",\"Ovalue\":null,\"Nvalue\":\"8\"}]',2),(106,'admin','2021-09-09 12:22:32','UPDATE','tbl_directorates',4,'::1','[{\"Field\":\"HeadedBy\",\"Ovalue\":\"20140082131\",\"Nvalue\":\"20160025552\"}]',60),(107,'admin','2021-09-09 12:26:28','INSERT','dh_columns',274,'::1','{\"TblName\":\"tbl_departments\",\"DisplayName\":\"HeadedBy\",\"FieldName\":\"HeadedBy\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(108,'admin','2021-09-09 12:26:56','INSERT','dh_columns',275,'::1','{\"TblName\":\"tbl_sections\",\"DisplayName\":\"HeadedBy\",\"FieldName\":\"HeadedBy\",\"DataType\":\"C\",\"CreatedBy\":\"admin\"}',999),(109,'admin','2021-09-09 12:32:09','UPDATE','dh_users',234,'::1','[{\"Field\":\"Phone\",\"Ovalue\":null,\"Nvalue\":\"254-700-000-000\"},{\"Field\":\"PhoneExt\",\"Ovalue\":null,\"Nvalue\":\"111\"},{\"Field\":\"user_type\",\"Ovalue\":\"Normal\",\"Nvalue\":\"HeadofSections\"},{\"Field\":\"Department\",\"Ovalue\":null,\"Nvalue\":\"5\"}]',2),(110,'admin','2021-09-09 12:40:37','UPDATE','tbl_departments',10,'::1','[{\"Field\":\"HeadedBy\",\"Ovalue\":null,\"Nvalue\":\"20160025543\"}]',61),(111,'admin','2021-09-09 12:40:47','UPDATE','tbl_departments',6,'::1','[{\"Field\":\"HeadedBy\",\"Ovalue\":null,\"Nvalue\":\"20160025543\"}]',61),(112,'admin','2021-09-09 12:41:40','UPDATE','tbl_sections',5,'::1','[{\"Field\":\"HeadedBy\",\"Ovalue\":null,\"Nvalue\":\"20170026712\"}]',62);
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dbbackup`
--

DROP TABLE IF EXISTS `dbbackup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dbbackup` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `FileSize` varchar(255) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `ActualFileSize` varchar(255) DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dbbackup`
--

LOCK TABLES `dbbackup` WRITE;
/*!40000 ALTER TABLE `dbbackup` DISABLE KEYS */;
/*!40000 ALTER TABLE `dbbackup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_applications`
--

DROP TABLE IF EXISTS `dh_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_applications` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `ApplicationName` varchar(255) DEFAULT NULL,
  `ACL` varchar(255) DEFAULT NULL,
  `IconRef` varchar(255) DEFAULT NULL,
  `AppType` varchar(255) DEFAULT 'Normal',
  `DisplayOrder` int DEFAULT NULL,
  `AppCode` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_applications`
--

LOCK TABLES `dh_applications` WRITE;
/*!40000 ALTER TABLE `dh_applications` DISABLE KEYS */;
INSERT INTO `dh_applications` VALUES (1,'admin','2019-05-21 12:08:25',NULL,NULL,'UserProfile',NULL,'fa fa-users','Normal',999,'UserProfile'),(2,'admin','2019-05-21 12:09:09',NULL,NULL,'SystemApps',NULL,'fa -fa-wrech','Normal',998,'SystemApps'),(10,'admin','2019-08-14 02:31:21','admin','2021-03-23 16:49:40','Reports',NULL,'fa fa-bar-chart','Normal',5,'Reports'),(12,'admin','2019-11-07 08:06:05',NULL,NULL,'Communication',NULL,'fa fa-comment','Normal',6,'Communication'),(14,'admin','2020-04-25 13:36:26',NULL,NULL,'Settings',NULL,'fas fa-gear','Normal',4,'Settings'),(22,'admin','2021-07-08 19:15:03',NULL,NULL,'Administration',NULL,'fa fa-users','Normal',1,'Administration');
/*!40000 ALTER TABLE `dh_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_columns`
--

DROP TABLE IF EXISTS `dh_columns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_columns` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `TblName` varchar(255) DEFAULT NULL,
  `FieldName` varchar(255) DEFAULT NULL,
  `DisplayName` varchar(255) DEFAULT NULL,
  `DataType` varchar(255) DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_columns`
--

LOCK TABLES `dh_columns` WRITE;
/*!40000 ALTER TABLE `dh_columns` DISABLE KEYS */;
INSERT INTO `dh_columns` VALUES (29,'admin','2019-05-21 10:12:28',NULL,NULL,'listitems','ParentID','ParentID','I'),(36,'admin','2019-05-29 16:37:49',NULL,NULL,'dh_listview','searchable','searchable','C'),(37,'admin','2019-05-30 13:12:40',NULL,NULL,'dh_modules','EnablePreview','EnablePreview','C'),(121,'admin','2019-12-05 11:12:08',NULL,NULL,'dh_emailtemplates','TempDescription','TempDescription','C'),(193,'admin','2020-09-03 11:47:18',NULL,NULL,'tbl_vendors','VendorID','VendorID','C'),(194,'admin','2020-09-03 11:47:42',NULL,NULL,'tbl_vendors','SupplierName','Supplier Name','C'),(195,'admin','2020-09-03 11:47:57',NULL,NULL,'tbl_vendors','SupplierPhone','Supplier Phone','C'),(196,'admin','2020-09-03 11:48:11',NULL,NULL,'tbl_vendors','SupplierEmail','SupplierEmail','C'),(197,'admin','2020-09-03 12:03:11',NULL,NULL,'tbl_invoices','VendorID','VendorID','C'),(198,'admin','2020-09-03 12:03:26',NULL,NULL,'tbl_invoices','InvoiceNo','InvoiceNo','C'),(199,'admin','2020-09-03 12:03:38',NULL,NULL,'tbl_invoices','InvoiceDate','InvoiceDate','D'),(200,'admin','2020-09-03 12:03:55',NULL,NULL,'tbl_invoices','InvoiceAmount','InvoiceAmount','N'),(201,'admin','2020-09-03 12:11:54',NULL,NULL,'tbl_invoices','InvoiceDescription','InvoiceDescription','C'),(202,'admin','2020-09-03 12:18:12',NULL,NULL,'tbl_invoices','HasPO','Has PO/PR','C'),(203,'admin','2020-09-03 12:18:22',NULL,NULL,'tbl_invoices','PONo','PONo','C'),(204,'admin','2020-09-03 12:57:18',NULL,NULL,'tbl_invoices','DocID','DocID','I'),(205,'admin','2020-09-08 12:09:18',NULL,NULL,'tbl_invoices','InvoiceType','InvoiceType','C'),(206,'admin','2020-09-08 13:07:09',NULL,NULL,'tbl_invoices','InvoiceStatus','InvoiceeStatus','C'),(207,'admin','2020-09-12 14:01:54',NULL,NULL,'tbl_members','IDNo','IDNo','C'),(208,'admin','2020-09-12 14:02:05',NULL,NULL,'tbl_members','FullName','FullName','C'),(209,'admin','2020-09-12 14:02:17',NULL,NULL,'tbl_members','PhoneNo','PhoneNo','C'),(210,'admin','2020-09-12 14:02:27',NULL,NULL,'tbl_members','Email','Email','C'),(211,'admin','2020-09-12 14:02:51',NULL,NULL,'tbl_members','MemberType','MemberType','C'),(212,'admin','2020-09-12 14:03:30',NULL,NULL,'tbl_members','DateofJoining','Date of Joining','D'),(213,'admin','2020-09-12 14:06:59',NULL,NULL,'tbl_contributiontypes','ContributionName','Contribution Name','C'),(214,'admin','2020-09-12 14:07:20',NULL,NULL,'tbl_contributiontypes','ContributionAmount','ContributionAmount','N'),(215,'admin','2020-09-12 14:08:12',NULL,NULL,'tbl_contributiontypes','IsMandatory','IsMandatory','C'),(216,'admin','2020-09-12 14:40:13',NULL,NULL,'tbl_members','ProfileImg','ProfileImg','C'),(217,'admin','2020-10-17 04:46:27',NULL,NULL,'tbl_contributions','MeetingID','MeetingID','I'),(218,'admin','2020-10-17 04:46:48',NULL,NULL,'tbl_contributions','MemberID','MemberID','I'),(219,'admin','2020-10-17 04:47:14',NULL,NULL,'tbl_contributions','ContributionType','ContributionType','C'),(220,'admin','2020-10-17 04:48:00',NULL,NULL,'tbl_contributions','AmountContributed','AmountContributed','N'),(221,'admin','2020-10-17 05:20:02',NULL,NULL,'tbl_meetings','MeetingDate','MeetingDate','D'),(222,'admin','2020-10-17 05:20:21',NULL,NULL,'tbl_meetings','MeetingVenue','Meeting Venue','C'),(223,'admin','2020-10-17 05:21:08',NULL,NULL,'tbl_meetings','MeetingDescription','Meeting Description','C'),(224,'admin','2020-10-17 11:24:19',NULL,NULL,'tbl_contributions','ModeofPayment','Mode of Payment','C'),(225,'admin','2020-11-10 12:22:43',NULL,NULL,'tbl_contributions','Remarks','Remarks','C'),(226,'admin','2021-03-09 13:12:09',NULL,NULL,'tbl_members','MemberNo','MemberNo','C'),(227,'admin','2021-03-09 13:12:24',NULL,NULL,'tbl_members','MemberName','Member Name','C'),(228,'admin','2021-03-09 13:12:37',NULL,NULL,'tbl_members','Gender','Gender','C'),(229,'admin','2021-03-09 13:12:50',NULL,NULL,'tbl_members','MobileNo','MobileNo','C'),(230,'admin','2021-03-09 13:13:07',NULL,NULL,'tbl_members','Email','Email','C'),(231,'admin','2021-03-09 13:13:20',NULL,NULL,'tbl_members','DOB','Date of Birth','D'),(232,'admin','2021-03-09 13:13:44',NULL,NULL,'tbl_members','MartialStatus','Martial Status','C'),(233,'admin','2021-03-09 13:13:58',NULL,NULL,'tbl_members','SpouseName','Spouse Name','C'),(234,'admin','2021-03-09 13:14:16',NULL,NULL,'tbl_members','District','District','C'),(235,'admin','2021-03-09 13:14:33',NULL,NULL,'tbl_members','ChurchRole','Church Role','C'),(236,'admin','2021-03-09 13:14:53',NULL,NULL,'tbl_members','DateofBaptism','Date of Baptism','D'),(237,'admin','2021-03-09 13:15:18',NULL,NULL,'tbl_members','DateofConfirmation','Date of Confirmation','D'),(238,'admin','2021-03-09 13:15:46',NULL,NULL,'tbl_members','HolyComNo','Holy Communion No','C'),(239,'admin','2021-03-09 13:16:03',NULL,NULL,'tbl_members','Profession','Profession','C'),(240,'admin','2021-03-09 13:18:30',NULL,NULL,'tbl_contributions','MemberNo','MemberNo','C'),(241,'admin','2021-03-10 09:30:13',NULL,NULL,'tbl_districts','DistrictCode','District Code','C'),(242,'admin','2021-03-10 09:30:29',NULL,NULL,'tbl_districts','DistrictName','District Name','C'),(243,'admin','2021-03-10 09:31:07',NULL,NULL,'tbl_districts','DistrictLeader','District Leader','C'),(244,'admin','2021-03-10 09:33:31',NULL,NULL,'tbl_districts','DeaCon1','Deacon1','C'),(245,'admin','2021-03-10 09:34:36',NULL,NULL,'tbl_districts','Deacon2','Deacon2','C'),(246,'admin','2021-03-10 09:46:29',NULL,NULL,'tbl_districts','Deacon1','Deacon1','C'),(247,'admin','2021-03-10 10:11:12',NULL,NULL,'tbl_members','MaritalStatus','Marital Status','C'),(248,'admin','2021-03-10 12:15:55',NULL,NULL,'tbl_contributions','ContributionDate','Contribution Date','D'),(249,'admin','2021-03-23 11:13:02',NULL,NULL,'tbl_members','ChurchGroups','Church Groups','X'),(250,'admin','2021-06-28 09:00:17',NULL,NULL,'goodtable','fname','First Name','C'),(251,'admin','2021-06-28 09:51:30',NULL,NULL,'badtable','ChurchGroups','ChurchGroups','C'),(252,'admin','2021-06-28 09:54:22',NULL,NULL,'badtable','fname','First Name','C'),(253,'admin','2021-07-08 07:25:27',NULL,NULL,'tbl_sections','SectionName','SectionName','C'),(254,'admin','2021-07-08 10:58:12',NULL,NULL,'tbl_section1','StaffName ','Staff Name ','C'),(255,'admin','2021-07-08 10:58:27',NULL,NULL,'tbl_section1','PFNO','PFNo','C'),(256,'admin','2021-07-08 10:58:40',NULL,NULL,'tbl_section1','Department','Department','C'),(257,'admin','2021-07-08 10:58:56',NULL,NULL,'tbl_section1','Section','Section','C'),(258,'admin','2021-07-08 11:26:23',NULL,NULL,'tbl_section1','Designation','Designation','C'),(259,'admin','2021-07-08 11:26:37',NULL,NULL,'tbl_section1','TermofService ','Term of Service ','C'),(260,'admin','2021-07-08 11:26:51',NULL,NULL,'tbl_section1','Scale','Scale','C'),(261,'admin','2021-07-08 11:27:05',NULL,NULL,'tbl_section1','WithEffectDate ','With Effect Date ','D'),(262,'admin','2021-07-08 19:16:06',NULL,NULL,'tbl_directorates','DirectorateCode ','Directorate Code ','C'),(263,'admin','2021-07-08 19:16:20',NULL,NULL,'tbl_directorates','DirectorateName ','DirectorateName ','C'),(264,'admin','2021-07-08 19:16:34',NULL,NULL,'tbl_directorates','HeadedBy ','HeadedBy ','C'),(265,'admin','2021-07-15 07:58:43',NULL,NULL,'tbl_departments','DepartmentCode','Department Code','C'),(266,'admin','2021-07-15 07:58:55',NULL,NULL,'tbl_departments','DepartmentName ','Department Name ','C'),(267,'admin','2021-07-15 07:59:09',NULL,NULL,'tbl_departments','DirectorateID','DirectorateID','I'),(268,'admin','2021-07-15 07:59:58',NULL,NULL,'tbl_sections','SectionCode','SectionCode','C'),(269,'admin','2021-07-15 08:00:09',NULL,NULL,'tbl_sections','HeadofSection','HeadofSection','C'),(270,'admin','2021-07-15 08:00:21',NULL,NULL,'tbl_sections','DepartmentID','DepartmentID','I'),(271,'admin','2021-09-09 08:53:05',NULL,NULL,'dh_users','JobGroup','Job Group','C'),(272,'admin','2021-09-09 08:53:38',NULL,NULL,'dh_users','TermsofService','Terms of Service','C'),(273,'admin','2021-09-09 08:54:29',NULL,NULL,'dh_users','EffectDate','Effect Date','D'),(274,'admin','2021-09-09 12:26:28',NULL,NULL,'tbl_departments','HeadedBy','HeadedBy','C'),(275,'admin','2021-09-09 12:26:56',NULL,NULL,'tbl_sections','HeadedBy','HeadedBy','C');
/*!40000 ALTER TABLE `dh_columns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_emailtemplates`
--

DROP TABLE IF EXISTS `dh_emailtemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_emailtemplates` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `TempName` varchar(255) DEFAULT NULL,
  `TempSubject` varchar(255) DEFAULT NULL,
  `TempDescription` varchar(255) DEFAULT NULL,
  `TempBody` text,
  `TempCss` text,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_emailtemplates`
--

LOCK TABLES `dh_emailtemplates` WRITE;
/*!40000 ALTER TABLE `dh_emailtemplates` DISABLE KEYS */;
/*!40000 ALTER TABLE `dh_emailtemplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_listquery`
--

DROP TABLE IF EXISTS `dh_listquery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_listquery` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `FieldName` varchar(255) DEFAULT NULL,
  `FilterCondition` varchar(255) DEFAULT NULL,
  `FilterValue` varchar(255) DEFAULT NULL,
  `TableName` varchar(255) DEFAULT NULL,
  `ModuleCode` varchar(255) DEFAULT NULL,
  `ListType` varchar(255) DEFAULT 'Main',
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_listquery`
--

LOCK TABLES `dh_listquery` WRITE;
/*!40000 ALTER TABLE `dh_listquery` DISABLE KEYS */;
INSERT INTO `dh_listquery` VALUES (11,'admin','2019-05-20 17:23:45',NULL,NULL,'CreatedBy','EQUAL','admin','OrderForm','SMSModule_11','Main'),(12,'admin','2019-05-20 17:23:45',NULL,NULL,'DateModified','EQUAL','{TimeStamp}','OrderForm','SMSModule_11','Main'),(13,'admin','2019-05-20 17:23:45',NULL,NULL,'OrderID','EQUAL','343','OrderForm','SMSModule_11','Main'),(14,'admin','2019-05-20 17:23:45',NULL,NULL,'SupplierID','EQUAL','343343','OrderForm','SMSModule_11','Main'),(15,'admin','2019-05-29 18:29:37',NULL,NULL,'loginid','EQUAL','admin','vw_userslist','ManageUsers','Main');
/*!40000 ALTER TABLE `dh_listquery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_listview`
--

DROP TABLE IF EXISTS `dh_listview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_listview` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `FieldName` varchar(255) DEFAULT NULL,
  `DisplayName` varchar(255) DEFAULT NULL,
  `DisplayOrder` int DEFAULT NULL,
  `TableName` varchar(255) DEFAULT NULL,
  `ModuleCode` varchar(255) DEFAULT NULL,
  `ListType` varchar(255) DEFAULT 'Main',
  `searchable` varchar(255) NOT NULL DEFAULT 'N',
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=751 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_listview`
--

LOCK TABLES `dh_listview` WRITE;
/*!40000 ALTER TABLE `dh_listview` DISABLE KEYS */;
INSERT INTO `dh_listview` VALUES (1,'admin','2019-05-21 12:58:13',NULL,NULL,'DocID','DocID',0,'vw_fileaccesslog','DocumentsAccessLog','Main','N'),(2,'admin','2019-05-21 12:58:13',NULL,NULL,'StoragePool','StoragePool',0,'vw_fileaccesslog','DocumentsAccessLog','Main','N'),(3,'admin','2019-05-21 12:58:13',NULL,NULL,'DocDescription','DocDescription',0,'vw_fileaccesslog','DocumentsAccessLog','Main','N'),(4,'admin','2019-05-21 13:19:25',NULL,NULL,'CreatedBy','CreatedBy',3,'dh_userprofiles','ManageUserProfiles','Main','N'),(5,'admin','2019-05-21 13:19:25',NULL,NULL,'DateCreated','DateCreated',4,'dh_userprofiles','ManageUserProfiles','Main','N'),(6,'admin','2019-05-21 13:19:25',NULL,NULL,'ProfileName','ProfileName',1,'dh_userprofiles','ManageUserProfiles','Main','N'),(7,'admin','2019-05-21 13:19:25',NULL,NULL,'ProfileDescription','ProfileDescription',2,'dh_userprofiles','ManageUserProfiles','Main','N'),(177,'admin','2019-06-19 13:49:07',NULL,NULL,'loginid','loginid',1,'vw_userslist','ManageUsers','Main','Y'),(178,'admin','2019-06-19 13:49:07',NULL,NULL,'Fullname','Fullname',2,'vw_userslist','ManageUsers','Main','Y'),(179,'admin','2019-06-19 13:49:08',NULL,NULL,'Phone','Phone',3,'vw_userslist','ManageUsers','Main','N'),(180,'admin','2019-06-19 13:49:08',NULL,NULL,'Email','Email',4,'vw_userslist','ManageUsers','Main','N'),(181,'admin','2019-06-19 13:49:08',NULL,NULL,'Position','Position',6,'vw_userslist','ManageUsers','Main','N'),(182,'admin','2019-06-19 13:49:08',NULL,NULL,'user_type','User Type',6,'vw_userslist','ManageUsers','Main','N'),(183,'admin','2019-06-19 13:49:08',NULL,NULL,'userstatus','User Status',3,'vw_userslist','ManageUsers','Main','N'),(188,'admin','2019-06-19 13:53:22',NULL,NULL,'CreatedBy','CreatedBy',4,'vw_dhrolegroups','ManageUserGroups','Main','N'),(189,'admin','2019-06-19 13:53:22',NULL,NULL,'DateCreated','DateCreated',5,'vw_dhrolegroups','ManageUserGroups','Main','N'),(190,'admin','2019-06-19 13:53:22',NULL,NULL,'GroupName','GroupName',1,'vw_dhrolegroups','ManageUserGroups','Main','Y'),(191,'admin','2019-06-19 13:53:22',NULL,NULL,'GroupDescription','GroupDescription',2,'vw_dhrolegroups','ManageUserGroups','Main','Y'),(192,'admin','2019-06-19 13:53:22',NULL,NULL,'UsersCount','UsersCount',3,'vw_dhrolegroups','ManageUserGroups','Main','N'),(240,'admin','2019-06-23 21:18:37',NULL,NULL,'logged_user','Logged User',1,'syslogin','UserLoginHistory','Main','Y'),(241,'admin','2019-06-23 21:18:37',NULL,NULL,'login_time','Login Time',2,'syslogin','UserLoginHistory','Main','N'),(242,'admin','2019-06-23 21:18:37',NULL,NULL,'logout_time','Logout Time',3,'syslogin','UserLoginHistory','Main','N'),(243,'admin','2019-06-23 21:18:37',NULL,NULL,'host','Host IP',4,'syslogin','UserLoginHistory','Main','Y'),(318,'admin','2019-07-08 07:13:41',NULL,NULL,'CreatedBy','CreatedBy',4,'vw_assemblycommittees','Committees_9','Main','N'),(319,'admin','2019-07-08 07:13:41',NULL,NULL,'DateCreated','DateCreated',5,'vw_assemblycommittees','Committees_9','Main','N'),(320,'admin','2019-07-08 07:13:41',NULL,NULL,'CommitteeName','CommitteeName',1,'vw_assemblycommittees','Committees_9','Main','Y'),(321,'admin','2019-07-08 07:13:41',NULL,NULL,'ClerkName','Clerk Responsible',3,'vw_assemblycommittees','Committees_9','Main','Y'),(322,'admin','2019-07-08 07:13:41',NULL,NULL,'MembersCounts','MembersCounts',2,'vw_assemblycommittees','Committees_9','Main','Y'),(395,'admin','2019-11-07 08:09:23',NULL,NULL,'CreatedBy','CreatedBy',3,'tbl_smstemplates','SMSTemplates_34','Main','N'),(396,'admin','2019-11-07 08:09:23',NULL,NULL,'DateCreated','DateCreated',4,'tbl_smstemplates','SMSTemplates_34','Main','N'),(397,'admin','2019-11-07 08:09:23',NULL,NULL,'TemplateName','TemplateName',1,'tbl_smstemplates','SMSTemplates_34','Main','Y'),(398,'admin','2019-11-07 08:09:24',NULL,NULL,'TemplateBody','TemplateBody',2,'tbl_smstemplates','SMSTemplates_34','Main','Y'),(399,'admin','2019-11-07 09:22:54',NULL,NULL,'CreatedBy','CreatedBy',6,'vw_messageout','ComposeSMS_35','Main','N'),(400,'admin','2019-11-07 09:22:54',NULL,NULL,'DateCreated','DateCreated',7,'vw_messageout','ComposeSMS_35','Main','N'),(401,'admin','2019-11-07 09:22:54',NULL,NULL,'SendChannel','SendChannel',1,'vw_messageout','ComposeSMS_35','Main','Y'),(402,'admin','2019-11-07 09:22:54',NULL,NULL,'MessageType','MessageType',2,'vw_messageout','ComposeSMS_35','Main','Y'),(403,'admin','2019-11-07 09:22:54',NULL,NULL,'MessageBody','MessageBody',3,'vw_messageout','ComposeSMS_35','Main','Y'),(404,'admin','2019-11-07 09:22:54',NULL,NULL,'SendFrequency','SendFrequency',4,'vw_messageout','ComposeSMS_35','Main','N'),(405,'admin','2019-11-07 09:22:54',NULL,NULL,'RecptCount','Receiptients',5,'vw_messageout','ComposeSMS_35','Main','N'),(415,'admin','2019-12-05 11:02:14',NULL,NULL,'CreatedBy','CreatedBy',3,'dh_emailtemplates','EmailTemplates_36','Main','Y'),(416,'admin','2019-12-05 11:02:14',NULL,NULL,'DateCreated','DateCreated',4,'dh_emailtemplates','EmailTemplates_36','Main','Y'),(417,'admin','2019-12-05 11:02:14',NULL,NULL,'TempName','Temp Name',1,'dh_emailtemplates','EmailTemplates_36','Main','Y'),(418,'admin','2019-12-05 11:02:14',NULL,NULL,'TempSubject','Temp Subject',2,'dh_emailtemplates','EmailTemplates_36','Main','Y'),(438,'admin','2020-04-25 13:42:56',NULL,NULL,'UserStatus','UserStatus',1,'vw_saccouserrole','ManageRoles_40','Main','Y'),(439,'admin','2020-04-25 13:42:56',NULL,NULL,'UserRole','UserRole',1,'vw_saccouserrole','ManageRoles_40','Main','Y'),(514,'admin','2020-07-29 14:31:41',NULL,NULL,'DateCreated','TravelDate',6,'vw_passmanifest','PassangerManifest_48','Main','N'),(515,'admin','2020-07-29 14:31:42',NULL,NULL,'SeatNo','SeatNo',7,'vw_passmanifest','PassangerManifest_48','Main','Y'),(516,'admin','2020-07-29 14:31:42',NULL,NULL,'TransRefNo','TransRefNo',3,'vw_passmanifest','PassangerManifest_48','Main','Y'),(517,'admin','2020-07-29 14:31:42',NULL,NULL,'AmountPaid','AmountPaid',3,'vw_passmanifest','PassangerManifest_48','Main','N'),(518,'admin','2020-07-29 14:31:42',NULL,NULL,'FullName','Passanger',2,'vw_passmanifest','PassangerManifest_48','Main','Y'),(519,'admin','2020-07-29 14:31:42',NULL,NULL,'PhoneNo','PhoneNo',1,'vw_passmanifest','PassangerManifest_48','Main','Y'),(520,'admin','2020-07-29 14:31:42',NULL,NULL,'DalaAccountNo','DalaAccNo',8,'vw_passmanifest','PassangerManifest_48','Main','Y'),(521,'admin','2020-07-29 14:31:42',NULL,NULL,'RouteName','RouteName',4,'vw_passmanifest','PassangerManifest_48','Main','Y'),(522,'admin','2020-07-29 14:31:42',NULL,NULL,'VehicleInfo','VehicleInfo',5,'vw_passmanifest','PassangerManifest_48','Main','Y'),(523,'admin','2020-07-29 14:31:42',NULL,NULL,'OpFullName','OpFullName',9,'vw_passmanifest','PassangerManifest_48','Main','Y'),(524,'admin','2020-07-29 14:31:43',NULL,NULL,'OpPhoneNo','OpPhoneNo',10,'vw_passmanifest','PassangerManifest_48','Main','Y'),(727,'admin','2021-07-08 19:17:51',NULL,NULL,'CreatedBy','CreatedBy',1,'tbl_directorates','ManageDirectorates_60','Main','Y'),(728,'admin','2021-07-08 19:17:51',NULL,NULL,'DateCreated','DateCreated',2,'tbl_directorates','ManageDirectorates_60','Main','N'),(729,'admin','2021-07-08 19:17:51',NULL,NULL,'DirectorateCode','DirectorateCode',1,'tbl_directorates','ManageDirectorates_60','Main','Y'),(730,'admin','2021-07-08 19:17:51',NULL,NULL,'DirectorateName','DirectorateName',2,'tbl_directorates','ManageDirectorates_60','Main','Y'),(731,'admin','2021-07-08 19:17:51',NULL,NULL,'HeadedBy','HeadedBy',3,'tbl_directorates','ManageDirectorates_60','Main','Y'),(738,'admin','2021-07-15 08:03:31',NULL,NULL,'CreatedBy','CreatedBy',5,'vw_departments','ManageDepartments_61','Main','Y'),(739,'admin','2021-07-15 08:03:31',NULL,NULL,'DateCreated','DateCreated',6,'vw_departments','ManageDepartments_61','Main','N'),(740,'admin','2021-07-15 08:03:31',NULL,NULL,'DepartmentCode','DepartmentCode',1,'vw_departments','ManageDepartments_61','Main','Y'),(741,'admin','2021-07-15 08:03:31',NULL,NULL,'DepartmentName','DepartmentName',2,'vw_departments','ManageDepartments_61','Main','Y'),(742,'admin','2021-07-15 08:03:31',NULL,NULL,'DirectorateName','DirectorateName',3,'vw_departments','ManageDepartments_61','Main','N'),(743,'admin','2021-07-15 08:03:31',NULL,NULL,'HeadedBy','HeadedBy',4,'vw_departments','ManageDepartments_61','Main','Y'),(744,'admin','2021-07-15 08:04:46',NULL,NULL,'CreatedBy','CreatedBy',6,'vw_sections','ManageSections_61','Main','Y'),(745,'admin','2021-07-15 08:04:46',NULL,NULL,'DateCreated','DateCreated',7,'vw_sections','ManageSections_61','Main','N'),(746,'admin','2021-07-15 08:04:46',NULL,NULL,'SectionName','Section Name',2,'vw_sections','ManageSections_61','Main','Y'),(747,'admin','2021-07-15 08:04:46',NULL,NULL,'SectionCode','Section Code',1,'vw_sections','ManageSections_61','Main','Y'),(748,'admin','2021-07-15 08:04:46',NULL,NULL,'HeadofSection','Head of Section',5,'vw_sections','ManageSections_61','Main','Y'),(749,'admin','2021-07-15 08:04:46',NULL,NULL,'DepartmentName','Department Name',3,'vw_sections','ManageSections_61','Main','Y'),(750,'admin','2021-07-15 08:04:46',NULL,NULL,'DirectorateName','Directorate Name',4,'vw_sections','ManageSections_61','Main','Y');
/*!40000 ALTER TABLE `dh_listview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_modules`
--

DROP TABLE IF EXISTS `dh_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_modules` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `ModuleName` varchar(255) DEFAULT NULL,
  `ModuleCode` varchar(255) DEFAULT NULL,
  `TableName` varchar(255) DEFAULT NULL,
  `AppName` varchar(255) DEFAULT NULL,
  `ACL` varchar(255) DEFAULT NULL,
  `DisplayOrder` int DEFAULT NULL,
  `IconRef` varchar(255) DEFAULT NULL,
  `DeleteItems` varchar(255) DEFAULT 'Y',
  `CheckExist` varchar(255) DEFAULT NULL,
  `EnableCreation` varchar(255) DEFAULT 'Y',
  `DisplayButton` varchar(255) DEFAULT NULL,
  `ModuleType` varchar(255) DEFAULT 'CRUD',
  `ModuleListView` varchar(255) DEFAULT 'Default',
  `ExcludePermsList` varchar(255) DEFAULT 'N',
  `ParentTable` varchar(255) DEFAULT NULL,
  `ExemptRole` varchar(255) DEFAULT 'N',
  `ButtonType` varchar(255) DEFAULT 'OpenLink',
  `ButtonAttributes` varchar(1024) DEFAULT NULL,
  `EnablePreview` varchar(255) NOT NULL DEFAULT 'Y',
  `Helpcontext` longtext,
  `ListingType` varchar(255) DEFAULT 'InApplication',
  `CreateBtnType` varchar(255) DEFAULT (_utf8mb4'OpenPage'),
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_modules`
--

LOCK TABLES `dh_modules` WRITE;
/*!40000 ALTER TABLE `dh_modules` DISABLE KEYS */;
INSERT INTO `dh_modules` VALUES (1,'admin','2019-05-21 12:11:08','admin','2019-11-08 11:03:50','UserProfile','UserProfile','TestTbl','UserProfile','Null',1,'fa fa-adjust','N',NULL,'N',NULL,'CRUD','Default','Y',NULL,'Y','OpenLink',NULL,'N',NULL,'InApplication','OpenPage'),(2,'admin','2019-05-21 12:55:22','admin','2019-05-22 07:17:46','Manage Users','ManageUsers','vw_userslist','SystemApps',NULL,1,'fa fa-users','Y',NULL,'Y',NULL,'CRUD','Default','Y','dh_users','Y','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(3,'admin','2019-05-21 12:57:30','admin','2019-06-19 16:51:13','Documents AccessLog','DocumentsAccessLog','vw_fileaccesslog','SystemApps',NULL,6,'fa fa-bus','N',NULL,'N',NULL,'CRUD','Default','Y','fileaccesslog','N','OpenLink',NULL,'N',NULL,'InApplication','OpenPage'),(5,'admin','2019-05-21 13:01:29','admin','2019-06-19 16:50:55','Manage User Profiles','ManageUserProfiles','dh_userprofiles','SystemApps',NULL,4,'fa fa-cart-plus','Y',NULL,'Y',NULL,'CRUD','Default','N',NULL,'Y','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(6,'admin','2019-05-21 13:03:18','admin','2021-08-13 12:54:45','Manage User Groups','ManageUserGroups','vw_dhrolegroups','SystemApps',NULL,2,'fa fa-arrow-up','N',NULL,'Y',NULL,'CRUD','Default','N','dh_usergroups','N','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(7,'admin','2019-05-21 13:05:10','admin','2019-07-02 12:21:52','User Login History','UserLoginHistory','syslogin','SystemApps',NULL,5,'fa fa-wrench','N',NULL,'N',NULL,'CRUD','Default','N',NULL,'Y','OpenLink',NULL,'N',NULL,'InApplication','OpenPage'),(23,'admin','2019-07-04 15:31:49','gmwangi@kiambuassembly.go.ke','2019-07-08 13:56:21','General Settings','GeneralSettings','TestTbl','SystemApps',NULL,6,'fa fa-wrench','Y',NULL,'Y',NULL,'CRUD','Custom','N',NULL,'N','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(29,'admin','2019-09-05 11:05:29','admin','2019-09-05 14:43:14','List Items','listitems','listitems','SystemApps',NULL,5,'fa fa-compress','N',NULL,'N',NULL,'ReportView','Custom','N',NULL,'N','OpenLink',NULL,'N',NULL,'InApplication','OpenPage'),(34,'admin','2019-11-07 08:08:38','admin','2020-04-25 16:35:26','SMS Templates','SMSTemplates_34','tbl_smstemplates','Communication',NULL,1,'fa fa-angle-double-down','Y',NULL,'Y',NULL,'CRUD','Default','N',NULL,'N','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(35,'admin','2019-11-07 09:21:34','admin','2020-04-25 16:35:09','Compose SMS','ComposeSMS_35','vw_messageout','Communication',NULL,2,'fa fa-ambulance','Y',NULL,'Y',NULL,'ReportView','Custom','N','messageout','N','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(36,'admin','2019-12-05 11:01:46',NULL,NULL,'Email Templates','EmailTemplates_36','dh_emailtemplates','SystemApps',NULL,6,'fa fa-envelope','Y',NULL,'Y',NULL,'CRUD','Default','N',NULL,'N','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(37,'admin','2020-01-23 11:49:10','admin','2020-01-23 14:49:33','Calender','Calender_37','TestTbl','UserProfile',NULL,2,'fa fa-calendar','N',NULL,'N',NULL,'ReportView','Custom','Y',NULL,'Y','OpenLink',NULL,'N',NULL,'InApplication','OpenPage'),(40,'admin','2020-04-25 13:41:33','admin','2020-04-25 16:41:44','Manage Roles','ManageRoles_40','vw_saccouserrole','Settings',NULL,2,'fa fa-align-center','Y',NULL,'Y',NULL,'CRUD','Default','N',NULL,'N','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(60,'admin','2021-07-08 19:17:26',NULL,NULL,'Manage Directorates','ManageDirectorates_60','tbl_directorates','Administration',NULL,1,'fa fa-anchor','Y',NULL,'Y',NULL,'CRUD','Default','N',NULL,'N','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(61,'admin','2021-07-15 08:02:48',NULL,NULL,'Manage Departments','ManageDepartments_61','vw_departments','Administration',NULL,2,'fa fa-angle-double-right','Y',NULL,'Y',NULL,'CRUD','Default','N','tbl_departments','N','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage'),(62,'admin','2021-07-15 08:04:00',NULL,NULL,'Manage Sections','ManageSections_61','vw_sections','Administration',NULL,3,'fa fa-angle-down','Y',NULL,'Y',NULL,'CRUD','Default','N','tbl_sections','N','OpenLink',NULL,'Y',NULL,'InApplication','OpenPage');
/*!40000 ALTER TABLE `dh_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_processinstances`
--

DROP TABLE IF EXISTS `dh_processinstances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_processinstances` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `WorkFlowID` int DEFAULT NULL,
  `WorkFlowStepID` int DEFAULT NULL,
  `ModuleID` int DEFAULT NULL,
  `WFitemID` int DEFAULT NULL,
  `WFAction` int DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_processinstances`
--

LOCK TABLES `dh_processinstances` WRITE;
/*!40000 ALTER TABLE `dh_processinstances` DISABLE KEYS */;
/*!40000 ALTER TABLE `dh_processinstances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_profilepermissions`
--

DROP TABLE IF EXISTS `dh_profilepermissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_profilepermissions` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `ProfileID` int DEFAULT NULL,
  `ModCode` int DEFAULT NULL,
  `ModOperation` varchar(255) DEFAULT NULL,
  `IsAllowed` varchar(255) DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=857 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_profilepermissions`
--

LOCK TABLES `dh_profilepermissions` WRITE;
/*!40000 ALTER TABLE `dh_profilepermissions` DISABLE KEYS */;
INSERT INTO `dh_profilepermissions` VALUES (673,'admin','2020-08-14 14:21:31',NULL,NULL,6,35,'View','1'),(674,'admin','2020-08-14 14:21:31',NULL,NULL,6,34,'View','1'),(687,'admin','2020-08-14 14:21:32',NULL,NULL,6,40,'View','0'),(688,'admin','2020-08-14 14:21:33',NULL,NULL,6,5,'View','0'),(689,'admin','2020-08-14 14:21:33',NULL,NULL,6,6,'View','0'),(690,'admin','2020-08-14 14:21:33',NULL,NULL,6,7,'View','0'),(691,'admin','2020-08-14 14:21:33',NULL,NULL,6,23,'View','0'),(692,'admin','2020-08-14 14:21:33',NULL,NULL,6,29,'View','0'),(693,'admin','2020-08-14 14:21:33',NULL,NULL,6,36,'View','0'),(694,'admin','2020-08-14 14:21:46',NULL,NULL,7,35,'View','1'),(695,'admin','2020-08-14 14:21:47',NULL,NULL,7,34,'View','1'),(708,'admin','2020-08-14 14:21:48',NULL,NULL,7,40,'View','0'),(709,'admin','2020-08-14 14:21:48',NULL,NULL,7,5,'View','0'),(710,'admin','2020-08-14 14:21:48',NULL,NULL,7,6,'View','0'),(711,'admin','2020-08-14 14:21:48',NULL,NULL,7,7,'View','0'),(712,'admin','2020-08-14 14:21:48',NULL,NULL,7,23,'View','0'),(713,'admin','2020-08-14 14:21:48',NULL,NULL,7,29,'View','0'),(714,'admin','2020-08-14 14:21:48',NULL,NULL,7,36,'View','0'),(743,'admin','2020-09-03 12:15:41',NULL,NULL,8,35,'View','0'),(744,'admin','2020-09-03 12:15:41',NULL,NULL,8,34,'View','0'),(745,'admin','2020-09-03 12:15:41',NULL,NULL,8,52,'View','1'),(746,'admin','2020-09-03 12:15:41',NULL,NULL,8,40,'View','0'),(747,'admin','2020-09-03 12:15:41',NULL,NULL,8,36,'View','0'),(748,'admin','2020-09-03 12:15:42',NULL,NULL,8,29,'View','0'),(749,'admin','2020-09-03 12:15:42',NULL,NULL,8,23,'View','0'),(750,'admin','2020-09-03 12:15:42',NULL,NULL,8,7,'View','0'),(751,'admin','2020-09-03 12:15:42',NULL,NULL,8,6,'View','0'),(752,'admin','2020-09-03 12:15:42',NULL,NULL,8,5,'View','0'),(822,'admin','2021-03-27 11:47:12',NULL,NULL,9,35,'View','0'),(823,'admin','2021-03-27 11:47:12',NULL,NULL,9,34,'View','0'),(824,'admin','2021-03-27 11:47:13',NULL,NULL,9,58,'View','1'),(825,'admin','2021-03-27 11:47:13',NULL,NULL,9,57,'View','0'),(826,'admin','2021-03-27 11:47:13',NULL,NULL,9,56,'View','1'),(827,'admin','2021-03-27 11:47:13',NULL,NULL,9,59,'View','1'),(828,'admin','2021-03-27 11:47:13',NULL,NULL,9,40,'View','0'),(829,'admin','2021-03-27 11:47:13',NULL,NULL,9,36,'View','0'),(830,'admin','2021-03-27 11:47:14',NULL,NULL,9,29,'View','0'),(831,'admin','2021-03-27 11:47:14',NULL,NULL,9,23,'View','0'),(832,'admin','2021-03-27 11:47:14',NULL,NULL,9,7,'View','0'),(833,'admin','2021-03-27 11:47:14',NULL,NULL,9,6,'View','0'),(834,'admin','2021-03-27 11:47:14',NULL,NULL,9,5,'View','0'),(845,'admin','2021-07-15 08:05:13',NULL,NULL,1,62,'View','1'),(846,'admin','2021-07-15 08:05:13',NULL,NULL,1,61,'View','1'),(847,'admin','2021-07-15 08:05:13',NULL,NULL,1,60,'View','1'),(848,'admin','2021-07-15 08:05:13',NULL,NULL,1,35,'View','1'),(849,'admin','2021-07-15 08:05:13',NULL,NULL,1,34,'View','1'),(850,'admin','2021-07-15 08:05:13',NULL,NULL,1,40,'View','0'),(851,'admin','2021-07-15 08:05:13',NULL,NULL,1,36,'View','1'),(852,'admin','2021-07-15 08:05:13',NULL,NULL,1,29,'View','1'),(853,'admin','2021-07-15 08:05:13',NULL,NULL,1,23,'View','1'),(854,'admin','2021-07-15 08:05:13',NULL,NULL,1,7,'View','1'),(855,'admin','2021-07-15 08:05:13',NULL,NULL,1,6,'View','1'),(856,'admin','2021-07-15 08:05:13',NULL,NULL,1,5,'View','1');
/*!40000 ALTER TABLE `dh_profilepermissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_templateprefix`
--

DROP TABLE IF EXISTS `dh_templateprefix`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_templateprefix` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `TableName` varchar(255) DEFAULT NULL,
  `Prefix` varchar(255) DEFAULT NULL,
  `PaddingSize` int DEFAULT NULL,
  `TblColumn` varchar(255) DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_templateprefix`
--

LOCK TABLES `dh_templateprefix` WRITE;
/*!40000 ALTER TABLE `dh_templateprefix` DISABLE KEYS */;
/*!40000 ALTER TABLE `dh_templateprefix` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_tmpfiles`
--

DROP TABLE IF EXISTS `dh_tmpfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_tmpfiles` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `DocID` int DEFAULT NULL,
  `tmpFile` varchar(255) DEFAULT NULL,
  `tmpindex` int DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_tmpfiles`
--

LOCK TABLES `dh_tmpfiles` WRITE;
/*!40000 ALTER TABLE `dh_tmpfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `dh_tmpfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_usergroups`
--

DROP TABLE IF EXISTS `dh_usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_usergroups` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `GroupName` varchar(255) DEFAULT NULL,
  `GroupCode` varchar(255) DEFAULT NULL,
  `GroupDescription` varchar(255) DEFAULT NULL,
  `GroupUsers` longtext,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_usergroups`
--

LOCK TABLES `dh_usergroups` WRITE;
/*!40000 ALTER TABLE `dh_usergroups` DISABLE KEYS */;
INSERT INTO `dh_usergroups` VALUES (4,'admin','2019-07-08 10:47:07',NULL,NULL,'SysManager','SysManager','System Admnistrators',NULL),(11,'admin','2021-07-09 06:40:10',NULL,NULL,'HeadofSections','HeadofSections','HeadofSections',NULL),(12,'admin','2021-08-13 09:55:16',NULL,NULL,'HeadofDepartments','HeadofDepartments','HeadofDepartments',NULL),(13,'admin','2021-08-13 09:55:40',NULL,NULL,'Directorate','Directorate','Directorate',NULL),(14,'admin','2021-08-13 09:56:45',NULL,NULL,'SectionTeamPlayer','SectionTeamPlayer','Section Team Player',NULL);
/*!40000 ALTER TABLE `dh_usergroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_userprofiles`
--

DROP TABLE IF EXISTS `dh_userprofiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_userprofiles` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `ProfileName` varchar(255) DEFAULT NULL,
  `ProfileDescription` varchar(255) DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_userprofiles`
--

LOCK TABLES `dh_userprofiles` WRITE;
/*!40000 ALTER TABLE `dh_userprofiles` DISABLE KEYS */;
INSERT INTO `dh_userprofiles` VALUES (1,'admin','2019-06-19 16:20:21',NULL,NULL,'Sysadmin','Systems Admin'),(10,'admin','2021-07-08 19:08:36',NULL,NULL,'HeadofSections','HeadofSections'),(11,'admin','2021-07-08 19:08:54',NULL,NULL,'HeadofDepartments','HeadofDepartments'),(12,'admin','2021-07-08 19:13:32',NULL,NULL,'Directorate','Directorate'),(13,'admin','2021-07-08 19:13:52',NULL,NULL,'Appraisee','Appraisee'),(14,'admin','2021-08-13 09:57:12',NULL,NULL,'SectionTeamPlayer','Section Team Player');
/*!40000 ALTER TABLE `dh_userprofiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_users`
--

DROP TABLE IF EXISTS `dh_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_users` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `loginid` varchar(80) NOT NULL,
  `Fullname` varchar(80) DEFAULT NULL,
  `Phone` varchar(80) DEFAULT NULL,
  `Email` varchar(80) DEFAULT NULL,
  `Position` varchar(80) DEFAULT NULL,
  `JobGroup` varchar(255) DEFAULT NULL,
  `PhoneExt` varchar(80) DEFAULT NULL,
  `pswd` varchar(150) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'Normal',
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shift` varchar(255) DEFAULT 'Day',
  `Department` int DEFAULT NULL,
  `Section` int DEFAULT NULL,
  `ProfileImage` varchar(255) DEFAULT NULL,
  `UserStatus` varchar(255) DEFAULT 'Active',
  `DeActivatedBy` varchar(255) DEFAULT NULL,
  `DateDeActivated` datetime DEFAULT NULL,
  `DeActivateReason` varchar(255) DEFAULT NULL,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `TermsofService` varchar(255) DEFAULT NULL,
  `EffectDate` date DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_users`
--

LOCK TABLES `dh_users` WRITE;
/*!40000 ALTER TABLE `dh_users` DISABLE KEYS */;
INSERT INTO `dh_users` VALUES (1,'admin','System Bazu','254-725-471-236','admin@siayaassembly.go.ke','System Manager','JobGroup','433jj','1cf82e4057fb4354957dacb4174ce958','Admin',NULL,'2018-05-06 18:07:54','Day',NULL,NULL,'panel/profilepics/NQZJZibAWgzfCJZHSHZNhws1QjAYJ4tbWr3ZkkZqXjc.png','Active',NULL,NULL,NULL,'admin','2021-07-08 22:26:00','Permanent',NULL),(157,'1989109166','Miss Murrende Susan Atieno',NULL,'1989109166@siayaassembly.go.ke','Assistant Director - Supply Chain Management Services','JobGroup-P',NULL,'9a00e9c8ca22b2f420870f77a5f2d471','Normal','admin','2021-08-13 09:51:08','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','1989-01-01'),(158,'2006029167','Mr Olewe Mark Opondo',NULL,'2006029167@siayaassembly.go.ke','Assistant Director  Security Services','JobGroup-P',NULL,'13c817be9c8cd7abb2c77dfc9af310dc','Normal','admin','2021-08-13 09:51:08','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2006-01-01'),(159,'2006070396','Mr Amolo Charles Otieno',NULL,'2006070396@siayaassembly.go.ke','Principal Sergeant at Arm','JobGroup-N',NULL,'257d1563180344a46dcae3d7c13f583a','Normal','admin','2021-08-13 09:51:08','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2006-01-01'),(160,'2013006110','Mr Erick Omondi Owiti',NULL,'2013006110@siayaassembly.go.ke','Sergeant at Arm [1]','JobGroup-K',NULL,'189b02e965018404f719538d1eeb3102','Normal','admin','2021-08-13 09:51:08','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2013-01-01'),(161,'19860003354','Mr Odondi Charles Ochola',NULL,'19860003354@siayaassembly.go.ke','Senior Principal Finance Officer','JobGroup-P',NULL,'237b70855f501d6beef85aa448125029','Normal','admin','2021-08-13 09:51:08','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','1986-01-01'),(162,'19970015895','Mr Owenje Tobias Odhiambo',NULL,'19970015895@siayaassembly.go.ke','Assistant Director  Hansard Reporting','JobGroup-P',NULL,'13469b485bf732fdbf1f2d80ddc9cdaa','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','1997-01-01'),(163,'19980005543','Mr Olwero Isaac Felix',NULL,'19980005543@siayaassembly.go.ke','Clerk - County Assembly','JobGroup-S',NULL,'1fabf0ab7ffdf936a04c0541bd4dce9f','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','1998-01-01'),(164,'20000001285','Mr Okuthe Christopher Danish',NULL,'20000001285@siayaassembly.go.ke','Deputy Chief Finance Officer','JobGroup-Q',NULL,'df6999483310466ef21949a6bee108d4','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2000-01-01'),(165,'20000002853','Mr Nyamwaka Dismas Omwoyo',NULL,'20000002853@siayaassembly.go.ke','Principal HRM &amp; Development','JobGroup-N',NULL,'50290ff797def29c3737404442a239c0','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2000-01-01'),(166,'20010008474','Mr Misoloh Elijah Abonyo',NULL,'20010008474@siayaassembly.go.ke','Senior Clerk Assistant[2]','JobGroup-N',NULL,'f588f3b57ce099352005551d44bed1e8','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2001-01-01'),(167,'20020000113','Mr Okwaro Julius Oduor',NULL,'20020000113@siayaassembly.go.ke','Senior Office Assistant','JobGroup-K',NULL,'bbe652ff05175ab50ee268f832f6c3c2','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2002-01-01'),(168,'20020003534','Mr Okeyo Silas George',NULL,'20020003534@siayaassembly.go.ke','Principal Supply Chain Management Officer','JobGroup-N',NULL,'969a31408cc01fe4189e7d78f73788f0','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2002-01-01'),(169,'20050001226','Mr Onyango Charles Ochieng',NULL,'20050001226@siayaassembly.go.ke','Senior Clerk Assistant[2]','JobGroup-N',NULL,'f814c2e89894451acf0a00d1d3b2652f','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2005-01-01'),(170,'20060000437','Miss Bakhoya Jackline Sanghuli',NULL,'20060000437@siayaassembly.go.ke','Senior Administrative Officer','JobGroup-M',NULL,'ed3b4032fb30855d9d1a822e1ce6bbfb','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2006-01-01'),(171,'20070000878','Mr Otieno Daniel Omondi',NULL,'20070000878@siayaassembly.go.ke','Superintendent (Building)','JobGroup-K',NULL,'54e0c51254d926ab4168749b1d42180b','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2007-01-01'),(172,'20070001106','Mr Oyango Charles Ojwang',NULL,'20070001106@siayaassembly.go.ke','Senior Office Assistant','JobGroup-K',NULL,'ed4a8fef4737db35ece3540fe20cdebc','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2007-01-01'),(173,'20070001866','Mr Oluk Sylvester Odhiambo',NULL,'20070001866@siayaassembly.go.ke','Assistant Director  Fiscal Analyst','JobGroup-P',NULL,'65621b8c692b125823789860d71c921f','Normal','admin','2021-08-13 09:51:09','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2007-01-01'),(174,'20080002008','Mrs Ondiek Millicent Auma',NULL,'20080002008@siayaassembly.go.ke','Chief Supply Chain Management Officer','JobGroup-M',NULL,'003e4fe3a86d790cece52728e6169602','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2008-01-01'),(175,'20080002071','Mrs Onyango Winnie Awino',NULL,'20080002071@siayaassembly.go.ke','Chief  ICT Officer','JobGroup-M',NULL,'bf255c7d546dd20775fdafd6f4605d37','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2008-01-01'),(176,'20080003461','Mrs Asol Millicent Caren',NULL,'20080003461@siayaassembly.go.ke','Sergeant at Arm [1]','JobGroup-K',NULL,'6200c48079036ebbdc802d5c5b828964','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2008-01-01'),(177,'20080003505','Mr Omondi Kennedy Opiyo',NULL,'20080003505@siayaassembly.go.ke','Sergeant at Arm [1]','JobGroup-K',NULL,'d889dc921b3d27452e7fe8a6fddaa60a','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2008-01-01'),(178,'20080003612','Mr Otieno David Omondi',NULL,'20080003612@siayaassembly.go.ke','Chief  ICT Officer','JobGroup-M',NULL,'05e4f5c6cc62b77e39889236d2bccc5d','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2008-01-01'),(179,'20090002145','Mrs Odera Harriet Vike',NULL,'20090002145@siayaassembly.go.ke','Senior Records Management Officer','JobGroup-L',NULL,'a55b1b4729733737bac59518ad4a1ab3','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2009-01-01'),(180,'20090002378','Mr Owuor Daniel Omondi',NULL,'20090002378@siayaassembly.go.ke','Accountant[1]','JobGroup-K',NULL,'156a43a746883a8743a2373bb59cd351','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2009-01-01'),(181,'20100000593','Mrs Ogutu Jael Awino',NULL,'20100000593@siayaassembly.go.ke','Administrative Officer [1]','JobGroup-L',NULL,'6fa16ee34d13adcb76fc306ebe3ae904','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2010-01-01'),(182,'20100000717','Mr Ochieng Brian Mwaura',NULL,'20100000717@siayaassembly.go.ke','Hansard Reporter[1]','JobGroup-K',NULL,'7415f504ee2ccf0bc5a36aa9513f0ca2','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2010-01-01'),(183,'20100000726','Miss Lolwe Maureen Akinyi',NULL,'20100000726@siayaassembly.go.ke','Supply Chain Management Officer[1]','JobGroup-K',NULL,'d5ed202139053fa763eabbafd5d45aec','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2010-01-01'),(184,'20100000744','Miss Achola Lydia Auma',NULL,'20100000744@siayaassembly.go.ke','Supply Chain Management Officer[1]','JobGroup-K',NULL,'2abbfa25f76032bf39203d01bd67dd4f','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2010-01-01'),(185,'20100000753','Mr Omwombo William Odhiambo',NULL,'20100000753@siayaassembly.go.ke','Sergeant at Arm [1]','JobGroup-K',NULL,'2b96a881d0c89853ff4adfc6c996fbdf','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2010-01-01'),(186,'20100001572','Mr Wire Samuel Otieno',NULL,'20100001572@siayaassembly.go.ke','Senior Driver','JobGroup-K',NULL,'f90d3ec899085454b4c4b0987fa2e9f8','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2010-01-01'),(187,'20100001723','Mr Odongo Stephen Otieno',NULL,'20100001723@siayaassembly.go.ke','Superintending Engineer  Mechanical','JobGroup-M',NULL,'f30e6e7f0a93d682096e1a881b0ede2c','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2010-01-01'),(188,'20100003307','Mrs Ahenda Stellah Awuor',NULL,'20100003307@siayaassembly.go.ke','Administrative Officer [1]','JobGroup-L',NULL,'153f861eaa00cedebc41d1d18708cc1f','Normal','admin','2021-08-13 09:51:10','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2010-01-01'),(189,'20110000103','Miss Awuor Devotta Georginah',NULL,'20110000103@siayaassembly.go.ke','Accountant[1]','JobGroup-K',NULL,'d0aa05059a98accb9eafd3d0cbe011cc','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2011-01-01'),(190,'20110000603','Mr Owino David Onyango',NULL,'20110000603@siayaassembly.go.ke','Senior Driver','JobGroup-K',NULL,'692d747c5ebe7ed5790e53c0c83a3468','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2011-01-01'),(191,'20110001422','Mrs Okello Esther Achieng',NULL,'20110001422@siayaassembly.go.ke','Senior HRM &amp; Development Officer','JobGroup-L',NULL,'f50b9572726c1240f82e35f49306d2ec','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2011-01-01'),(192,'20120001069','Miss Odera Lydia Achieng&apos;',NULL,'20120001069@siayaassembly.go.ke','Senior HRM &amp; Development Officer','JobGroup-L',NULL,'f92ce08e2275fd58a13d4ddaf1e1f338','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2012-01-01'),(193,'20140081974','Mrs Odinga Grace Akoth',NULL,'20140081974@siayaassembly.go.ke','Chief Librarian','JobGroup-M',NULL,'66c50dd007873178b015a35ebce654cc','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(194,'20140081983','Mr Okello Ezra Owuor',NULL,'20140081983@siayaassembly.go.ke','Deputy Director HRM &amp; Development','JobGroup-Q',NULL,'7289124a4c075b0d88bbdb349cfff689','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(195,'20140081992','Miss Miganda Gloria Amondi',NULL,'20140081992@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'a75c5fcfd385e2d5ef7b0983494f9943','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(196,'20140082006','Miss Sijenyi Salome Alice',NULL,'20140082006@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'7b44c3f9198b2747db877254144ff2f3','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(197,'20140082015','Mr Omollo Antony Odiwuor',NULL,'20140082015@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'af659d44b4ddcdfd3666c6e471505d6c','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(198,'20140082024','Mr Agola Silvester Douglas',NULL,'20140082024@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'42a7a25e7d9a021b24f8d185e329cf93','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(199,'20140082033','Mrs Awino Regina Akoth',NULL,'20140082033@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'2c80d483bfedfe29cb3d8df8259eb149','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(200,'20140082042','Mrs Omwoha Jacquline ',NULL,'20140082042@siayaassembly.go.ke','Principal Clerk Assistant','JobGroup-Q',NULL,'cfadb3350360def95123ac481236db38','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(201,'20140082079','Mrs Sadia Mary Anyango',NULL,'20140082079@siayaassembly.go.ke','Principal Public Communications Officer','JobGroup-N',NULL,'157f23b4b84ca57f91fcb1fab990d809','Normal','admin','2021-08-13 09:51:11','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(202,'20140082097','Mr Sumba Martin Kissinger',NULL,'20140082097@siayaassembly.go.ke','Senior Clerk Assistant[2]','JobGroup-N',NULL,'019f9a96f05567974c1d8a3bc73f411e','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(203,'20140082113','Mr Otonde Jumbe Wickly',NULL,'20140082113@siayaassembly.go.ke','Senior Legal Clerk','JobGroup-L',NULL,'c05934014f5eaf57cc7cdb3b9b3bf26b','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(204,'20140082122','Mrs Ambunya Jenifer Judith',NULL,'20140082122@siayaassembly.go.ke','Senior Hansard Reporter','JobGroup-L',NULL,'dc4fd63ab42551db423b5b13ecb0a4e7','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(205,'20140082131','Mr Ogenga Eric Odhiambo','254-700-000-000','20140082131@siayaassembly.go.ke','Deputy Clerk','JobGroup-R','111','b2e71d1a8563688438b306193837601f','Directorate','admin','2021-08-13 09:51:12','Day',6,3,NULL,'Active',NULL,NULL,NULL,'admin','2021-09-09 15:21:39','Permanent','2014-01-01'),(206,'20140098291','Mr Oduor Tom Brian',NULL,'20140098291@siayaassembly.go.ke','Senior Public Communications Officer','JobGroup-L',NULL,'7b1698d565651035cce0f37aed2019ac','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2014-01-01'),(207,'20150026798','Mr Stephen Gerrald Ayuma',NULL,'20150026798@siayaassembly.go.ke','Office Attendant','JobGroup-H',NULL,'0fdf97f0603ed51e361b9f7495e20c61','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2015-01-01'),(208,'20150062570','Mr Odunga Henry Ochieng',NULL,'20150062570@siayaassembly.go.ke','Senior Driver','JobGroup-K',NULL,'5a59e10629d93d23a7e69b6fd4a76942','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2015-01-01'),(209,'20150075764','Ms Barasa Roselinda Achieng',NULL,'20150075764@siayaassembly.go.ke','Director Human Resource Management and Development','JobGroup-R',NULL,'a48e299a8b08785963da6c80127259bb','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2015-01-01'),(210,'20150125563','Miss Omondi Dorothy Akinyi',NULL,'20150125563@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'e7eb3d397870e1c6fa4495f9039bb9e9','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2015-01-01'),(211,'20150125572','Miss Ooga Margaret Mercy Achieng',NULL,'20150125572@siayaassembly.go.ke','Assistant Director  Legal Services','JobGroup-P',NULL,'5219b8da3b7f1130cbd7af0a51a4cac1','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2015-01-01'),(212,'20150154117','Miss Omedo Rose Awuor',NULL,'20150154117@siayaassembly.go.ke','Deputy Director - Supply Chain Management Services','JobGroup-Q',NULL,'7c4519c2648741514af05b457779827a','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2015-01-01'),(213,'20160000859','Mrs Olemo Lilian Adhiambo',NULL,'20160000859@siayaassembly.go.ke','Administrative Officer [1]','JobGroup-L',NULL,'0635b2d8889505cdb011ca9716d42887','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(214,'20160025356','Ms Madialo Brenda Akinyi',NULL,'20160025356@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'828283655a102a6aeaa86d0b04b77002','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(215,'20160025365','Mr Okewa George Sakwa',NULL,'20160025365@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'6fef091708b59b421ae1f68b03568149','Normal','admin','2021-08-13 09:51:12','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(216,'20160025374','Mr Masawa Kevin Onyango',NULL,'20160025374@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'b8d703424370d2a73549fd8cca3defcc','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(217,'20160025383','Ms Otieno Alexandra Adhiambo',NULL,'20160025383@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'167757c7d564608212c094ec583bed21','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(218,'20160025409','Mr Audi Moses Ochieng',NULL,'20160025409@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'564a20627198d772de69518101f3793c','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(219,'20160025418','Mr Omore Christopher Omore',NULL,'20160025418@siayaassembly.go.ke','First Clerk Assistant','JobGroup-M',NULL,'ba820f6a02610ff384eebbac6bba2dfd','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(220,'20160025427','Mrs Maranga Elizabeth Kerubo',NULL,'20160025427@siayaassembly.go.ke','Administrative Officer [1]','JobGroup-L',NULL,'44a042029db27cec25667ba1d83e9b6b','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(221,'20160025436','Ms Esatia Caroline Khamasi',NULL,'20160025436@siayaassembly.go.ke','Administrative Officer [1]','JobGroup-L',NULL,'bc517ef44e4a533a23e76d952aa20523','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(222,'20160025445','Ms Otieno Asenath Akoth',NULL,'20160025445@siayaassembly.go.ke','Principal Research Officer','JobGroup-N',NULL,'306a3d08a79bc7b0355dbb0ae4871b2c','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(223,'20160025454','Mr Otieno David Okeyo',NULL,'20160025454@siayaassembly.go.ke','Chief Accountant','JobGroup-M',NULL,'24ad6760a9bbb364dcd8e8c2674c7b12','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(224,'20160025463','Mr Gare Stephen Otieno',NULL,'20160025463@siayaassembly.go.ke','Chief Accountant','JobGroup-M',NULL,'271fd52d09b1e904ef5b4c1979893752','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(225,'20160025472','Mr Omollo Erick Muga',NULL,'20160025472@siayaassembly.go.ke','Chief Fiscal Analyst','JobGroup-M',NULL,'3442bc6a6d02472b3d74669a5c4db7de','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(226,'20160025481','Mrs Buyuka Catherine Okisa',NULL,'20160025481@siayaassembly.go.ke','Senior Accountant','JobGroup-L',NULL,'4236b242525d2b5ea4fcba528457e905','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(227,'20160025490','Mr Okumu David Ouma',NULL,'20160025490@siayaassembly.go.ke','Director  Accounting Services','JobGroup-R',NULL,'1a73222ceef1685bcf51ccb3aca97f0f','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(228,'20160025525','Mr Nyadwa Fredrick Owino',NULL,'20160025525@siayaassembly.go.ke','Senior Sergeant at Arm','JobGroup-L',NULL,'ceacaba835338672a8dbae87dc282bde','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(229,'20160025534','Mr Chiawo Edwin Christopher Oti',NULL,'20160025534@siayaassembly.go.ke','Chief Driver','JobGroup-H',NULL,'6bc7d72fcba421475038db956dd2bbc1','Normal','admin','2021-08-13 09:51:13','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(230,'20160025543','Ms Odinga Linda ','254-700-000-000','20160025543@siayaassembly.go.ke','Chief Hansard Reporter','JobGroup-M','111','bfdfceb7baa42a6f751ef4fed91c8661','HeadofDepartments','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,'admin','2021-09-09 12:27:20','Permanent','2016-01-01'),(231,'20160025552','Mr Otieno Austine Onyango','254-700-000-000','20160025552@siayaassembly.go.ke','Chief Hansard Reporter','JobGroup-M','111','a2238e56f52f29652ca5c786b8fdccd9','Directorate','admin','2021-08-13 09:51:14','Day',8,NULL,NULL,'Active',NULL,NULL,NULL,'admin','2021-09-09 15:22:23','Permanent','2016-01-01'),(232,'20160031292','Mr Oketch Felix Otieno',NULL,'20160031292@siayaassembly.go.ke','Assistant Director  Legal Services','JobGroup-P',NULL,'97c7a1d817df557fa6bb786c8be4f127','Normal','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(233,'20160031845','Mr Olang&apos;o Moses Otieno Abor',NULL,'20160031845@siayaassembly.go.ke','Chief Driver','JobGroup-H',NULL,'1519e5c9ddcea3df81fda587c4950c54','Normal','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2016-01-01'),(234,'20170026712','Mr Otaya Francis Onyango','254-700-000-000','20170026712@siayaassembly.go.ke','Chief Driver','JobGroup-H','111','979112338e29edbf5a3ed3d5ec664dbf','HeadofSections','admin','2021-08-13 09:51:14','Day',5,NULL,NULL,'Active',NULL,NULL,NULL,'admin','2021-09-09 15:32:08','Permanent','2017-01-01'),(235,'20170078921','Miss Obare Akinyi Yvonne',NULL,'20170078921@siayaassembly.go.ke','Senior Hansard Reporter','JobGroup-L',NULL,'169b64da3d61cc526bfe29403b59472e','Normal','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2017-01-01'),(236,'20170147029','Mrs Mukabi Eunice Atieno',NULL,'20170147029@siayaassembly.go.ke','Administrative Officer [1]','JobGroup-L',NULL,'68922c594e1ed936ba6d5474a4df03ca','Normal','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2017-01-01'),(237,'20170147038','Mr Ogola John Olang',NULL,'20170147038@siayaassembly.go.ke','Chief Driver','JobGroup-H',NULL,'49bfe0b01dcac7cbf29156b7f7a8d718','Normal','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2017-01-01'),(238,'20170147047','Mrs Okundi Marther Akinyi',NULL,'20170147047@siayaassembly.go.ke','Personal Assistant (County)','JobGroup-M',NULL,'2fdf3753351f73e525b3d0ad8730c118','Normal','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2017-01-01'),(239,'20180086088','Mr Nyangidi Doughlas Owiti','254-712-346-528','20180086088@siayaassembly.go.ke','Assistant Director  Internal Audit Services','JobGroup-P','111','e2d173914275f5f541ab727728a468ca','Normal','admin','2021-08-13 09:51:14','Day',5,9,NULL,'Active',NULL,NULL,NULL,'admin','2021-09-09 14:54:31','Permanent','2018-01-01'),(240,'20180086097','Mr Okello Roy Paul Onyango',NULL,'20180086097@siayaassembly.go.ke','Senior Film Officer','JobGroup-L',NULL,'46b815b70d4bb6d0776e2a4ddc46c4ff','Normal','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2018-01-01'),(241,'20200022012','Mr. Ochieng Vincent Achieng',NULL,'20200022012@siayaassembly.go.ke','Public Communications Officer[1]','JobGroup-K',NULL,'78ef0b7d1a96bd53a6720a041fd322cd','Normal','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2020-01-01'),(242,'20200024894','Ms. Awuor Vernah Benardette','254-700-000-000','20200024894@siayaassembly.go.ke','Supply Chain Management Assistant [1]','JobGroup-K','111','ccb9ec5e1893fb1692c17c83f638de7c','Normal','admin','2021-08-13 09:51:14','Day',8,NULL,NULL,'Active',NULL,NULL,NULL,'admin','2021-09-09 12:29:44','Permanent','2020-01-01'),(243,'20200024909','Mr. Otieno Ted Johnson Ang&apos;olo',NULL,'20200024909@siayaassembly.go.ke','Senior Superintendent (Building)','JobGroup-L',NULL,'db496bc3a72dd65f10c93e6075cd2447','Normal','admin','2021-08-13 09:51:14','Day',NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL,NULL,'Permanent','2020-01-01'),(244,'20200024917','Mr. Magige Kevin Ochieng','254-700-000-000','20200024917@siayaassembly.go.ke','Film Officer[1]','JobGroup-K','111','ae23e9073eff888c9f11bc03274591d2','SectionTeamPlayer','admin','2021-08-13 09:51:15','Day',6,3,NULL,'Active',NULL,NULL,NULL,'admin','2021-09-09 15:01:06','Permanent','2020-01-01');
/*!40000 ALTER TABLE `dh_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_workflowactions`
--

DROP TABLE IF EXISTS `dh_workflowactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_workflowactions` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `ActionName` varchar(255) DEFAULT NULL,
  `ActionCode` varchar(255) DEFAULT NULL,
  `ACL` varchar(255) DEFAULT NULL,
  `DisplayOrder` int DEFAULT NULL,
  `IconRef` varchar(255) DEFAULT NULL,
  `RouteTo` varchar(255) DEFAULT NULL,
  `WorkFlowStepID` int DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_workflowactions`
--

LOCK TABLES `dh_workflowactions` WRITE;
/*!40000 ALTER TABLE `dh_workflowactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `dh_workflowactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dh_workflows`
--

DROP TABLE IF EXISTS `dh_workflows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dh_workflows` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `workFlowName` varchar(255) DEFAULT NULL,
  `workFlowCode` varchar(255) DEFAULT NULL,
  `ACL` varchar(255) DEFAULT NULL,
  `ModuleName` varchar(255) DEFAULT NULL,
  `IconRef` varchar(255) DEFAULT NULL,
  `DisplayOrder` int DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dh_workflows`
--

LOCK TABLES `dh_workflows` WRITE;
/*!40000 ALTER TABLE `dh_workflows` DISABLE KEYS */;
/*!40000 ALTER TABLE `dh_workflows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dhalerts`
--

DROP TABLE IF EXISTS `dhalerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dhalerts` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `MsgSubject` varchar(255) DEFAULT NULL,
  `MsgBody` longtext,
  `MsgRecipient` longtext,
  `MsgRecipientCC` longtext,
  `MsgType` varchar(255) DEFAULT NULL,
  `MsgStatus` varchar(255) DEFAULT 'Pending',
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dhalerts`
--

LOCK TABLES `dhalerts` WRITE;
/*!40000 ALTER TABLE `dhalerts` DISABLE KEYS */;
/*!40000 ALTER TABLE `dhalerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dhcomments`
--

DROP TABLE IF EXISTS `dhcomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dhcomments` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `AssetID` varchar(255) DEFAULT NULL,
  `ElementType` varchar(255) DEFAULT NULL,
  `TopicName` varchar(255) DEFAULT NULL,
  `ACL` varchar(255) DEFAULT NULL,
  `CommentBody` varchar(255) DEFAULT NULL,
  `ParentID` int DEFAULT NULL,
  `TableName` varchar(255) DEFAULT NULL,
  `ViewGroups` longtext,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dhcomments`
--

LOCK TABLES `dhcomments` WRITE;
/*!40000 ALTER TABLE `dhcomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `dhcomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elementstorage`
--

DROP TABLE IF EXISTS `elementstorage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elementstorage` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `FileStage` varchar(255) DEFAULT 'Free',
  `FileSize` int DEFAULT NULL,
  `Orginal_FileName` varchar(255) DEFAULT NULL,
  `New_FileName` varchar(255) DEFAULT NULL,
  `StoragePool` varchar(255) DEFAULT NULL,
  `FileDescription` varchar(255) DEFAULT NULL,
  `FileExt` varchar(255) DEFAULT NULL,
  `LockedBy` varchar(255) DEFAULT NULL,
  `DateLocked` datetime DEFAULT NULL,
  `Version` int DEFAULT '1',
  `PageCount` int DEFAULT NULL,
  `UUID` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`S_ROWID`),
  UNIQUE KEY `S_ROWID` (`S_ROWID`),
  KEY `idx_UUID` (`UUID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elementstorage`
--

LOCK TABLES `elementstorage` WRITE;
/*!40000 ALTER TABLE `elementstorage` DISABLE KEYS */;
/*!40000 ALTER TABLE `elementstorage` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `genuuid` BEFORE INSERT ON `elementstorage` FOR EACH ROW BEGIN
  SET NEW.UUID = md5(CONCAT(NEW.S_ROWID, NEW.DateCreated));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `fileaccesslog`
--

DROP TABLE IF EXISTS `fileaccesslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fileaccesslog` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `SessionID` varchar(255) DEFAULT NULL,
  `DocID` int DEFAULT NULL,
  `AccessIP` varchar(255) DEFAULT NULL,
  `AccessAgent` varchar(255) DEFAULT NULL,
  `LogAction` varchar(255) DEFAULT 'Access',
  `Reason` varchar(255) DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fileaccesslog`
--

LOCK TABLES `fileaccesslog` WRITE;
/*!40000 ALTER TABLE `fileaccesslog` DISABLE KEYS */;
/*!40000 ALTER TABLE `fileaccesslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filetypes`
--

DROP TABLE IF EXISTS `filetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filetypes` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `TYPE_ID` varchar(10) NOT NULL DEFAULT '',
  `TYPE_TYPE` varchar(3) DEFAULT NULL,
  `TYPE_MIMECONTENT` varchar(50) DEFAULT NULL,
  `TYPE_MIMESUBCONTENT` varchar(50) DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filetypes`
--

LOCK TABLES `filetypes` WRITE;
/*!40000 ALTER TABLE `filetypes` DISABLE KEYS */;
INSERT INTO `filetypes` VALUES (1,'3fr','img','image','3fr'),(2,'3gp','vid','video','3gpp'),(3,'aff','aud','',''),(4,'aft','aud','',''),(5,'ai','img','application','photoshop'),(6,'aif','aud','audio','x-aiff'),(7,'aifc','aud','audio','x-aiff'),(8,'aiff','aud','audio','x-aiff'),(9,'ari','img','image','ari'),(10,'arw','img','image','arw'),(11,'au','aud','audio','basic'),(12,'avi','vid','video','avi'),(13,'bay','img','image','bay'),(14,'bmp','img','image','bmp'),(15,'cal','img','',''),(16,'cap','img','image','cap'),(17,'ciff','img','image','ciff'),(18,'cr2','img','image','cr2'),(19,'crw','img','image','crw'),(20,'cs1','img','image','cs1'),(21,'dcm','img','',''),(22,'dcr','img','image','dcr'),(23,'dng','img','image','dng'),(24,'doc','doc','application','vnd.ms-word'),(25,'docx','doc','application','vnd.ms-word'),(26,'drf','img','image','drf'),(27,'eip','img','image','eip'),(28,'eps','img','application','eps'),(29,'erf','img','image','erf'),(30,'f4v','vid','application','x-shockwave-flash'),(31,'fff','img','image','fff'),(32,'flac','aud','audio','flac'),(33,'flv','vid','application','x-shockwave-flash'),(34,'fpx','img','image','vnd.fpx'),(35,'gif','img','image','gif'),(36,'iiq','img','image','iiq'),(37,'jpeg','img','image','jpeg'),(38,'jpg','img','image','jpg'),(39,'k25','img','image','k25'),(40,'kdc','img','image','kdc'),(41,'m2t','vid','video','m2t'),(42,'m2ts','vid','video','m2ts'),(43,'m3u','aud','audio','x-mpegurl'),(44,'m4a','aud','audio','x-m4a'),(45,'m4v','vid','video','quicktime'),(46,'mef','img','image','mef'),(47,'mid','aud','audio','mid'),(48,'mos','img','image','mos'),(49,'mov','vid','video','quicktime'),(50,'mp3','aud','audio','mpeg'),(51,'mp4','vid','video','mp4v-es'),(52,'mpg','vid','video','mpeg'),(53,'mrw','img','image','mrw'),(54,'mts','vid','video','mts'),(55,'mxf','vid','video','mxf'),(56,'nef','img','image','nef'),(57,'nrw','img','image','nrw'),(58,'ogg','aud','audio','ogg'),(59,'ogv','vid','video','ogv'),(60,'orf','img','image','orf'),(61,'pbm','img','image','pbm'),(62,'pct','img','',''),(63,'pcx','img','image','pcx'),(64,'pdf','doc','application','pdf'),(65,'pef','img','image','pef'),(66,'pgm','img','image','x-portable-graymap'),(67,'png','img','image','png'),(68,'pnm','img','image','x-portable-anymap'),(69,'ppm','img','image','x-portable-pixmap'),(70,'ppt','doc','application','vnd.ms-powerpoint'),(71,'pptx','doc','application','vnd.ms-powerpoint'),(72,'psb','img','application','photoshop'),(73,'psd','img','application','photoshop'),(74,'ptx','img','image','ptx'),(75,'r3d','img','image','r3d'),(76,'ra','aud','audio','x-pn-realaudio'),(77,'raf','img','image','raf'),(78,'ram','aud','audio','x-pn-realaudio'),(79,'ras','img','image','ras'),(80,'raw','img','image','raw'),(81,'rm','vid','application','vnd.rn-realmedia'),(82,'rmi','aud','audio','mid'),(83,'rpx','img','',''),(84,'rw2','img','image','rw2'),(85,'rwl','img','image','rwl'),(86,'rwz','img','image','rwz'),(87,'snd','aud','audio','basic'),(88,'sr2','img','image','sr2'),(89,'srf','img','image','srf'),(90,'srw','img','image','srw'),(91,'swf','vid','application','x-shockwave-flash'),(92,'tga','img','image','tga'),(93,'tif','img','image','tif'),(94,'tiff','img','image','tiff'),(95,'txt','doc','application','txt'),(96,'vob','vid','video','mpeg'),(97,'wav','aud','audio','x-wav'),(98,'wbmp','img','image','vnd.wap.wbmp'),(99,'webm','vid','video','webm'),(100,'wmv','vid','video','x-ms-wmv'),(101,'x3f','img','image','x3f'),(102,'xls','doc','application','vnd.ms-excel'),(103,'xlsx','doc','application','vnd.ms-excel');
/*!40000 ALTER TABLE `filetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listitems`
--

DROP TABLE IF EXISTS `listitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `listitems` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `ItemCode` varchar(255) DEFAULT NULL,
  `ItemDescription` varchar(255) DEFAULT NULL,
  `ItemType` varchar(255) DEFAULT NULL,
  `ParentID` int DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=1642 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listitems`
--

LOCK TABLES `listitems` WRITE;
/*!40000 ALTER TABLE `listitems` DISABLE KEYS */;
INSERT INTO `listitems` VALUES (1,'admin','2018-05-06 11:24:57','',NULL,'fa fa-calendar-minus','fa fa-calendar-minus','FontAwesome',0),(2,'kevin','2018-05-06 11:24:57','',NULL,'AFG','Afghanistan','Country',0),(3,'kevin','2018-05-06 11:24:58','',NULL,'AGO','Angola','Country',0),(4,'kevin','2018-05-06 11:24:58','',NULL,'AIA','Anguilla','Country',0),(6,'kevin','2018-05-06 11:24:58','',NULL,'AND','Andorra','Country',0),(7,'kevin','2018-05-06 11:24:58','',NULL,'ANT','Netherlands Antilles','Country',0),(8,'kevin','2018-05-06 11:24:58','',NULL,'ARE','United Arab Emirates','Country',0),(9,'kevin','2018-05-06 11:24:58','',NULL,'ARG','Argentina','Country',0),(10,'kevin','2018-05-06 11:24:58','',NULL,'ASM','American Samoa','Country',0),(11,'kevin','2018-05-06 11:24:58','',NULL,'ATA','Antarctica','Country',0),(12,'kevin','2018-05-06 11:24:58','',NULL,'ATF','French Southern territories','Country',0),(14,'kevin','2018-05-06 11:24:58','',NULL,'AUS','Australia','Country',0),(15,'kevin','2018-05-06 11:24:58','',NULL,'AUT','Austria','Country',0),(16,'kevin','2018-05-06 11:24:58','',NULL,'AZE','Azerbaijan','Country',0),(17,'kevin','2018-05-06 11:24:58','',NULL,'BDI','Burundi','Country',0),(48,'kevin','2018-05-06 11:25:00','',NULL,'COM','Comoros','Country',0),(50,'kevin','2018-05-06 11:25:00','',NULL,'CRI','Costa Rica','Country',0),(51,'kevin','2018-05-06 11:25:00','',NULL,'CUB','Cuba','Country',0),(52,'kevin','2018-05-06 11:25:00','',NULL,'CXR','Christmas Island','Country',0),(53,'kevin','2018-05-06 11:25:00','',NULL,'CYM','Cayman Islands','Country',0),(54,'kevin','2018-05-06 11:25:00','',NULL,'CYP','Cyprus','Country',0),(55,'kevin','2018-05-06 11:25:00','',NULL,'CZE','Czech Republic','Country',0),(56,'kevin','2018-05-06 11:25:00','',NULL,'DEU','Germany','Country',0),(57,'kevin','2018-05-06 11:25:01','',NULL,'DJI','Djibouti','Country',0),(58,'kevin','2018-05-06 11:25:01','',NULL,'DMA','Dominica','Country',0),(59,'kevin','2018-05-06 11:25:01','',NULL,'DNK','Denmark','Country',0),(60,'kevin','2018-05-06 11:25:01','',NULL,'DOM','Dominican Republic','Country',0),(61,'kevin','2018-05-06 11:25:01','',NULL,'DZA','Algeria','Country',0),(62,'kevin','2018-05-06 11:25:01','',NULL,'ECU','Ecuador','Country',0),(63,'kevin','2018-05-06 11:25:01','',NULL,'EGY','Egypt','Country',0),(64,'kevin','2018-05-06 11:25:01','',NULL,'ERI','Eritrea','Country',0),(65,'kevin','2018-05-06 11:25:01','',NULL,'ESH','Western Sahara','Country',0),(66,'kevin','2018-05-06 11:25:01','',NULL,'ESP','Spain','Country',0),(67,'kevin','2018-05-06 11:25:01','',NULL,'EST','Estonia','Country',0),(68,'kevin','2018-05-06 11:25:01','',NULL,'ETH','Ethiopia','Country',0),(69,'kevin','2018-05-06 11:25:01','',NULL,'FIN','Finland','Country',0),(70,'kevin','2018-05-06 11:25:01','',NULL,'FJI','Fiji Islands','Country',0),(71,'kevin','2018-05-06 11:25:01','',NULL,'FLK','Falkland Islands','Country',0),(72,'kevin','2018-05-06 11:25:01','',NULL,'FRA','France','Country',0),(73,'kevin','2018-05-06 11:25:01','',NULL,'FRO','Faroe Islands','Country',0),(74,'kevin','2018-05-06 11:25:01','',NULL,'FSM','Micronesia, Federated States of','Country',0),(75,'kevin','2018-05-06 11:25:01','',NULL,'GAB','Gabon','Country',0),(76,'kevin','2018-05-06 11:25:02','',NULL,'GBR','United Kingdom','Country',0),(77,'kevin','2018-05-06 11:25:02','',NULL,'GEO','Georgia','Country',0),(78,'kevin','2018-05-06 11:25:02','',NULL,'GHA','Ghana','Country',0),(79,'kevin','2018-05-06 11:25:02','',NULL,'GIB','Gibraltar','Country',0),(80,'kevin','2018-05-06 11:25:02','',NULL,'GIN','Guinea','Country',0),(81,'kevin','2018-05-06 11:25:02','',NULL,'GLP','Guadeloupe','Country',0),(82,'kevin','2018-05-06 11:25:02','',NULL,'GMB','Gambia','Country',0),(83,'kevin','2018-05-06 11:25:02','',NULL,'GNB','Guinea-Bissau','Country',0),(84,'kevin','2018-05-06 11:25:02','',NULL,'GNQ','Equatorial Guinea','Country',0),(85,'kevin','2018-05-06 11:25:02','',NULL,'GRC','Greece','Country',0),(86,'kevin','2018-05-06 11:25:02','',NULL,'GRD','Grenada','Country',0),(87,'kevin','2018-05-06 11:25:02','',NULL,'GRL','Greenland','Country',0),(88,'kevin','2018-05-06 11:25:02','',NULL,'GTM','Guatemala','Country',0),(89,'kevin','2018-05-06 11:25:02','',NULL,'GUF','French Guiana','Country',0),(90,'kevin','2018-05-06 11:25:03','',NULL,'GUM','Guam','Country',0),(91,'kevin','2018-05-06 11:25:03','',NULL,'GUY','Guyana','Country',0),(92,'kevin','2018-05-06 11:25:03','',NULL,'HKG','Hong Kong','Country',0),(93,'kevin','2018-05-06 11:25:03','',NULL,'HMD','Heard Island and McDonald Islands','Country',0),(94,'kevin','2018-05-06 11:25:03','',NULL,'HND','Honduras','Country',0),(95,'kevin','2018-05-06 11:25:03','',NULL,'HRV','Croatia','Country',0),(96,'kevin','2018-05-06 11:25:03','',NULL,'HTI','Haiti','Country',0),(97,'kevin','2018-05-06 11:25:03','',NULL,'HUN','Hungary','Country',0),(98,'kevin','2018-05-06 11:25:03','',NULL,'IDN','Indonesia','Country',0),(99,'kevin','2018-05-06 11:25:03','',NULL,'IND','India','Country',0),(100,'kevin','2018-05-06 11:25:03','',NULL,'IOT','British Indian Ocean Territory','Country',0),(101,'kevin','2018-05-06 11:25:03','',NULL,'IRL','Ireland','Country',0),(102,'kevin','2018-05-06 11:25:03','',NULL,'IRN','Iran','Country',0),(103,'kevin','2018-05-06 11:25:03','',NULL,'IRQ','Iraq','Country',0),(104,'kevin','2018-05-06 11:25:03','',NULL,'ISL','Iceland','Country',0),(105,'kevin','2018-05-06 11:25:03','',NULL,'ISR','Israel','Country',0),(106,'kevin','2018-05-06 11:25:03','',NULL,'ITA','Italy','Country',0),(107,'kevin','2018-05-06 11:25:03','',NULL,'JAM','Jamaica','Country',0),(108,'kevin','2018-05-06 11:25:03','',NULL,'JOR','Jordan','Country',0),(109,'kevin','2018-05-06 11:25:04','',NULL,'JPN','Japan','Country',0),(110,'kevin','2018-05-06 11:25:04','',NULL,'KAZ','Kazakstan','Country',0),(111,'kevin','2018-05-06 11:25:04','',NULL,'KEN','Kenya','Country',0),(112,'kevin','2018-05-06 11:25:04','',NULL,'KGZ','Kyrgyzstan','Country',0),(113,'kevin','2018-05-06 11:25:04','',NULL,'KHM','Cambodia','Country',0),(114,'kevin','2018-05-06 11:25:04','',NULL,'KIR','Kiribati','Country',0),(115,'kevin','2018-05-06 11:25:04','',NULL,'KNA','Saint Kitts and Nevis','Country',0),(116,'kevin','2018-05-06 11:25:04','',NULL,'KOR','South Korea','Country',0),(117,'kevin','2018-05-06 11:25:04','',NULL,'KWT','Kuwait','Country',0),(118,'kevin','2018-05-06 11:25:04','',NULL,'LAO','Laos','Country',0),(119,'kevin','2018-05-06 11:25:04','',NULL,'LBN','Lebanon','Country',0),(120,'kevin','2018-05-06 11:25:04','',NULL,'LBR','Liberia','Country',0),(121,'kevin','2018-05-06 11:25:04','',NULL,'LBY','Libyan Arab Jamahiriya','Country',0),(122,'kevin','2018-05-06 11:25:04','',NULL,'LCA','Saint Lucia','Country',0),(123,'kevin','2018-05-06 11:25:04','',NULL,'LIE','Liechtenstein','Country',0),(124,'kevin','2018-05-06 11:25:04','',NULL,'LKA','Sri Lanka','Country',0),(125,'kevin','2018-05-06 11:25:04','',NULL,'LSO','Lesotho','Country',0),(126,'kevin','2018-05-06 11:25:04','',NULL,'LTU','Lithuania','Country',0),(127,'kevin','2018-05-06 11:25:04','',NULL,'LUX','Luxembourg','Country',0),(128,'kevin','2018-05-06 11:25:04','',NULL,'LVA','Latvia','Country',0),(129,'kevin','2018-05-06 11:25:04','',NULL,'MAC','Macao','Country',0),(130,'kevin','2018-05-06 11:25:05','',NULL,'MAR','Morocco','Country',0),(131,'kevin','2018-05-06 11:25:05','',NULL,'MCO','Monaco','Country',0),(132,'kevin','2018-05-06 11:25:05','',NULL,'MDA','Moldova','Country',0),(133,'kevin','2018-05-06 11:25:05','',NULL,'MDG','Madagascar','Country',0),(134,'kevin','2018-05-06 11:25:05','',NULL,'MDV','Maldives','Country',0),(135,'kevin','2018-05-06 11:25:05','',NULL,'MEX','Mexico','Country',0),(136,'kevin','2018-05-06 11:25:05','',NULL,'MHL','Marshall Islands','Country',0),(137,'kevin','2018-05-06 11:25:05','',NULL,'MKD','Macedonia','Country',0),(138,'kevin','2018-05-06 11:25:05','',NULL,'MLI','Mali','Country',0),(139,'kevin','2018-05-06 11:25:05','',NULL,'MLT','Malta','Country',0),(140,'kevin','2018-05-06 11:25:05','',NULL,'MMR','Myanmar','Country',0),(141,'kevin','2018-05-06 11:25:05','',NULL,'MNG','Mongolia','Country',0),(142,'kevin','2018-05-06 11:25:05','',NULL,'MNP','Northern Mariana Islands','Country',0),(143,'kevin','2018-05-06 11:25:05','',NULL,'MOZ','Mozambique','Country',0),(144,'kevin','2018-05-06 11:25:05','',NULL,'MRT','Mauritania','Country',0),(145,'kevin','2018-05-06 11:25:05','',NULL,'MSR','Montserrat','Country',0),(146,'kevin','2018-05-06 11:25:05','',NULL,'MTQ','Martinique','Country',0),(147,'kevin','2018-05-06 11:25:05','',NULL,'MUS','Mauritius','Country',0),(148,'kevin','2018-05-06 11:25:05','',NULL,'MWI','Malawi','Country',0),(149,'kevin','2018-05-06 11:25:05','',NULL,'MYS','Malaysia','Country',0),(150,'kevin','2018-05-06 11:25:05','',NULL,'MYT','Mayotte','Country',0),(151,'kevin','2018-05-06 11:25:06','',NULL,'NAM','Namibia','Country',0),(152,'kevin','2018-05-06 11:25:06','',NULL,'NCL','New Caledonia','Country',0),(153,'kevin','2018-05-06 11:25:06','',NULL,'NER','Niger','Country',0),(154,'kevin','2018-05-06 11:25:06','',NULL,'NFK','Norfolk Island','Country',0),(155,'kevin','2018-05-06 11:25:06','',NULL,'NGA','Nigeria','Country',0),(156,'kevin','2018-05-06 11:25:06','',NULL,'NIC','Nicaragua','Country',0),(157,'kevin','2018-05-06 11:25:06','',NULL,'NIU','Niue','Country',0),(158,'kevin','2018-05-06 11:25:06','',NULL,'NLD','Netherlands','Country',0),(159,'kevin','2018-05-06 11:25:06','',NULL,'NOR','Norway','Country',0),(160,'kevin','2018-05-06 11:25:06','',NULL,'NPL','Nepal','Country',0),(161,'kevin','2018-05-06 11:25:06','',NULL,'NRU','Nauru','Country',0),(162,'kevin','2018-05-06 11:25:06','',NULL,'NZL','New Zealand','Country',0),(163,'kevin','2018-05-06 11:25:06','',NULL,'OMN','Oman','Country',0),(164,'kevin','2018-05-06 11:25:06','',NULL,'PAK','Pakistan','Country',0),(165,'kevin','2018-05-06 11:25:06','',NULL,'PAN','Panama','Country',0),(166,'kevin','2018-05-06 11:25:06','',NULL,'PCN','Pitcairn','Country',0),(167,'kevin','2018-05-06 11:25:06','',NULL,'PER','Peru','Country',0),(168,'kevin','2018-05-06 11:25:06','',NULL,'PHL','Philippines','Country',0),(169,'kevin','2018-05-06 11:25:06','',NULL,'PLW','Palau','Country',0),(170,'kevin','2018-05-06 11:25:06','',NULL,'PNG','Papua New Guinea','Country',0),(171,'kevin','2018-05-06 11:25:06','',NULL,'POL','Poland','Country',0),(172,'kevin','2018-05-06 11:25:06','',NULL,'PRI','Puerto Rico','Country',0),(173,'kevin','2018-05-06 11:25:07','',NULL,'PRK','North Korea','Country',0),(174,'kevin','2018-05-06 11:25:07','',NULL,'PRT','Portugal','Country',0),(175,'kevin','2018-05-06 11:25:07','',NULL,'PRY','Paraguay','Country',0),(176,'kevin','2018-05-06 11:25:07','',NULL,'PSE','Palestine','Country',0),(177,'kevin','2018-05-06 11:25:07','',NULL,'PYF','French Polynesia','Country',0),(178,'kevin','2018-05-06 11:25:07','',NULL,'QAT','Qatar','Country',0),(179,'kevin','2018-05-06 11:25:07','',NULL,'REU','RÃ©union','Country',0),(180,'kevin','2018-05-06 11:25:07','',NULL,'ROM','Romania','Country',0),(181,'kevin','2018-05-06 11:25:07','',NULL,'RUS','Russian Federation','Country',0),(182,'kevin','2018-05-06 11:25:07','',NULL,'RWA','Rwanda','Country',0),(183,'kevin','2018-05-06 11:25:07','',NULL,'SAU','Saudi Arabia','Country',0),(184,'kevin','2018-05-06 11:25:07','',NULL,'SDN','Sudan','Country',0),(185,'kevin','2018-05-06 11:25:07','',NULL,'SEN','Senegal','Country',0),(186,'kevin','2018-05-06 11:25:07','',NULL,'SGP','Singapore','Country',0),(187,'kevin','2018-05-06 11:25:07','',NULL,'SGS','South Georgia and the South Sandwich Islands','Country',0),(188,'kevin','2018-05-06 11:25:07','',NULL,'SHN','Saint Helena','Country',0),(189,'kevin','2018-05-06 11:25:07','',NULL,'SJM','Svalbard and Jan Mayen','Country',0),(190,'kevin','2018-05-06 11:25:07','',NULL,'SLB','Solomon Islands','Country',0),(191,'kevin','2018-05-06 11:25:07','',NULL,'SLE','Sierra Leone','Country',0),(192,'kevin','2018-05-06 11:25:07','',NULL,'SLV','El Salvador','Country',0),(193,'kevin','2018-05-06 11:25:07','',NULL,'SMR','San Marino','Country',0),(194,'kevin','2018-05-06 11:25:07','',NULL,'SOM','Somalia','Country',0),(195,'kevin','2018-05-06 11:25:07','',NULL,'SPM','Saint Pierre and Miquelon','Country',0),(196,'kevin','2018-05-06 11:25:07','',NULL,'STP','Sao Tome and Principe','Country',0),(197,'kevin','2018-05-06 11:25:07','',NULL,'SUR','Suriname','Country',0),(198,'kevin','2018-05-06 11:25:08','',NULL,'SVK','Slovakia','Country',0),(199,'kevin','2018-05-06 11:25:08','',NULL,'SVN','Slovenia','Country',0),(200,'kevin','2018-05-06 11:25:08','',NULL,'SWE','Sweden','Country',0),(201,'kevin','2018-05-06 11:25:08','',NULL,'SWZ','Swaziland','Country',0),(202,'kevin','2018-05-06 11:25:08','',NULL,'SYC','Seychelles','Country',0),(203,'kevin','2018-05-06 11:25:08','',NULL,'SYR','Syria','Country',0),(204,'kevin','2018-05-06 11:25:08','',NULL,'TCA','Turks and Caicos Islands','Country',0),(205,'kevin','2018-05-06 11:25:08','',NULL,'TCD','Chad','Country',0),(206,'kevin','2018-05-06 11:25:08','',NULL,'TGO','Togo','Country',0),(207,'kevin','2018-05-06 11:25:08','',NULL,'THA','Thailand','Country',0),(208,'kevin','2018-05-06 11:25:08','',NULL,'TJK','Tajikistan','Country',0),(209,'kevin','2018-05-06 11:25:08','',NULL,'TKL','Tokelau','Country',0),(210,'kevin','2018-05-06 11:25:08','',NULL,'TKM','Turkmenistan','Country',0),(211,'kevin','2018-05-06 11:25:08','',NULL,'TMP','East Timor','Country',0),(212,'kevin','2018-05-06 11:25:08','',NULL,'TON','Tonga','Country',0),(213,'kevin','2018-05-06 11:25:08','',NULL,'TTO','Trinidad and Tobago','Country',0),(214,'kevin','2018-05-06 11:25:08','',NULL,'TUN','Tunisia','Country',0),(215,'kevin','2018-05-06 11:25:08','',NULL,'TUR','Turkey','Country',0),(216,'kevin','2018-05-06 11:25:08','',NULL,'TUV','Tuvalu','Country',0),(217,'kevin','2018-05-06 11:25:08','',NULL,'TWN','Taiwan','Country',0),(218,'kevin','2018-05-06 11:25:08','',NULL,'TZA','Tanzania','Country',0),(219,'kevin','2018-05-06 11:25:08','',NULL,'UGA','Uganda','Country',0),(220,'kevin','2018-05-06 11:25:08','',NULL,'UKR','Ukraine','Country',0),(221,'kevin','2018-05-06 11:25:09','',NULL,'UMI','United States Minor Outlying Islands','Country',0),(222,'kevin','2018-05-06 11:25:09','',NULL,'URY','Uruguay','Country',0),(223,'kevin','2018-05-06 11:25:09','',NULL,'USA','United States','Country',0),(224,'kevin','2018-05-06 11:25:09','',NULL,'UZB','Uzbekistan','Country',0),(225,'kevin','2018-05-06 11:25:09','',NULL,'VAT','Holy See (Vatican City State)','Country',0),(226,'kevin','2018-05-06 11:25:09','',NULL,'VCT','Saint Vincent and the Grenadines','Country',0),(227,'kevin','2018-05-06 11:25:09','',NULL,'VEN','Venezuela','Country',0),(228,'kevin','2018-05-06 11:25:09','',NULL,'VGB','Virgin Islands, British','Country',0),(229,'kevin','2018-05-06 11:25:09','',NULL,'VIR','Virgin Islands, U.S.','Country',0),(230,'kevin','2018-05-06 11:25:09','',NULL,'VNM','Vietnam','Country',0),(231,'kevin','2018-05-06 11:25:09','',NULL,'VUT','Vanuatu','Country',0),(232,'kevin','2018-05-06 11:25:09','',NULL,'WLF','Wallis and Futuna','Country',0),(233,'kevin','2018-05-06 11:25:09','',NULL,'WSM','Samoa','Country',0),(234,'kevin','2018-05-06 11:25:09','',NULL,'YEM','Yemen','Country',0),(235,'kevin','2018-05-06 11:25:09','',NULL,'YUG','Yugoslavia','Country',0),(236,'kevin','2018-05-06 11:25:09','',NULL,'ZAF','South Africa','Country',0),(237,'kevin','2018-05-06 11:25:09','',NULL,'ZMB','Zambia','Country',0),(238,'kevin','2018-05-06 11:25:09','',NULL,'ZWE','Zimbabwe','Country',0),(239,'kevin','2018-05-06 11:25:09','',NULL,'Single','Single','MaritalStatus',0),(240,'kevin','2018-05-06 11:25:09','',NULL,'Married','Married','MaritalStatus',0),(241,'kevin','2018-05-06 11:25:09','',NULL,'Widowed','Widowed','MaritalStatus',0),(242,'kevin','2018-05-06 11:25:09','',NULL,'Divorced','Divorced','MaritalStatus',0),(243,'kevin','2018-05-06 11:25:09','',NULL,'NeverMarried','Never Married','MaritalStatus',0),(244,'kevin','2018-05-06 11:25:09','',NULL,'Male','Male','Gender',0),(245,'kevin','2018-05-06 11:25:10','',NULL,'Female','Female','Gender',0),(246,'admin','2018-05-06 11:25:10','',NULL,'Admin','Admin','usertype',0),(248,'','2018-05-06 11:25:10','',NULL,'Mombasa','Mombasa','Counties',0),(249,'','2018-05-06 11:25:10','',NULL,'Kwale','Kwale','Counties',0),(251,'','2018-05-06 11:25:10','',NULL,'TanaRiver','Tana River','Counties',0),(252,'','2018-05-06 11:25:10','',NULL,'Lamu','Lamu','Counties',0),(253,'','2018-05-06 11:25:10','',NULL,'TaitaTaveta','Taita Taveta','Counties',0),(254,'','2018-05-06 11:25:10','',NULL,'Garissa','Garissa','Counties',0),(255,'','2018-05-06 11:25:10','',NULL,'Wajir','Wajir','Counties',0),(256,'','2018-05-06 11:25:10','',NULL,'Mandera','Mandera','Counties',0),(257,'','2018-05-06 11:25:10','',NULL,'Marsabit','Marsabit','Counties',0),(258,'','2018-05-06 11:25:10','',NULL,'Isiolo','Isiolo','Counties',0),(259,'','2018-05-06 11:25:10','',NULL,'Meru','Meru','Counties',0),(260,'','2018-05-06 11:25:10','',NULL,'TharakaNithi','Tharaka Nithi','Counties',0),(261,'','2018-05-06 11:25:10','',NULL,'Embu','Embu','Counties',0),(263,'','2018-05-06 11:25:10','',NULL,'Machakos','Machakos','Counties',0),(264,'','2018-05-06 11:25:10','',NULL,'Makueni','Makueni','Counties',0),(265,'','2018-05-06 11:25:10','',NULL,'Nyandarua','Nyandarua','Counties',0),(266,'','2018-05-06 11:25:11','',NULL,'Nyeri','Nyeri','Counties',0),(267,'','2018-05-06 11:25:11','',NULL,'Kirinyaga','Kirinyaga','Counties',0),(268,'','2018-05-06 11:25:11','',NULL,'Muranga','Muranga','Counties',0),(269,'','2018-05-06 11:25:11','',NULL,'Kiambu','Kiambu','Counties',0),(270,'','2018-05-06 11:25:11','',NULL,'Turkana','Turkana','Counties',0),(271,'','2018-05-06 11:25:11','',NULL,'WestPokot','West Pokot','Counties',0),(272,'','2018-05-06 11:25:11','',NULL,'Samburu','Samburu','Counties',0),(273,'','2018-05-06 11:25:11','',NULL,'TransNzoia','Trans Nzoia','Counties',0),(274,'','2018-05-06 11:25:11','',NULL,'UasinGishu','Uasin Gishu','Counties',0),(275,'','2018-05-06 11:25:11','',NULL,'Elgeyo/Marakwet','Elgeyo/Marakwet','Counties',0),(276,'','2018-05-06 11:25:11','',NULL,'Nandi','Nandi','Counties',0),(277,'','2018-05-06 11:25:11','',NULL,'Baringo','Baringo','Counties',0),(278,'','2018-05-06 11:25:11','',NULL,'Laikipia','Laikipia','Counties',0),(279,'','2018-05-06 11:25:11','',NULL,'Nakuru','Nakuru','Counties',0),(280,'','2018-05-06 11:25:11','',NULL,'Narok','Narok','Counties',0),(281,'','2018-05-06 11:25:11','',NULL,'Kajiado','Kajiado','Counties',0),(282,'','2018-05-06 11:25:11','',NULL,'Kericho','Kericho','Counties',0),(283,'','2018-05-06 11:25:11','',NULL,'Bomet','Bomet','Counties',0),(284,'','2018-05-06 11:25:11','',NULL,'Kakamega','Kakamega','Counties',0),(285,'','2018-05-06 11:25:11','',NULL,'Vihiga','Vihiga','Counties',0),(286,'','2018-05-06 11:25:11','',NULL,'Bungoma','Bungoma','Counties',0),(287,'','2018-05-06 11:25:11','',NULL,'Busia','Busia','Counties',0),(288,'','2018-05-06 11:25:12','',NULL,'Siaya','Siaya','Counties',0),(290,'','2018-05-06 11:25:12','',NULL,'HomaBay','Homa Bay','Counties',0),(291,'','2018-05-06 11:25:12','',NULL,'Migori','Migori','Counties',0),(293,'','2018-05-06 11:25:12','',NULL,'Nyamira','Nyamira','Counties',0),(294,'','2018-05-06 11:25:12','',NULL,'Nairobi','Nairobi','Counties',0),(295,'admin','2018-05-06 11:25:12','',NULL,'Normal','Normal','AppType',0),(296,'admin','2018-05-06 11:25:12','',NULL,'WorkFlow','WorkFlow','AppType',0),(297,'admin','2018-05-06 11:25:12','',NULL,'CONTAINS','CONTAINS','filterConditions',0),(298,'admin','2018-05-06 11:25:12','',NULL,'DOES_NOT_CONTAIN','DOES NOT CONTAIN','filterConditions',0),(299,'admin','2018-05-06 11:25:12','',NULL,'EQUAL','EQUAL','filterConditions',0),(300,'admin','2018-05-06 11:25:12','',NULL,'NOT_EQUAL','NOT EQUAL','filterConditions',0),(301,'admin','2018-05-06 11:25:12','',NULL,'GREATER_THAN','GREATER THAN','filterConditions',0),(302,'admin','2018-05-06 11:25:12','',NULL,'LESS_THAN','LESS THAN','filterConditions',0),(303,'admin','2018-05-06 11:25:13','',NULL,'GREATER_THAN_OR_EQUAL','GREATER THAN OR EQUAL','filterConditions',0),(304,'admin','2018-05-06 11:25:13','',NULL,'LESS_THAN_OR_EQUAL','LESS THAN OR EQUAL','filterConditions',0),(305,'admin','2018-05-06 11:25:13','',NULL,'STARTS_WITH','STARTS WITH','filterConditions',0),(306,'admin','2018-05-06 11:25:13','',NULL,'ENDS_WITH','ENDS WITH','filterConditions',0),(307,'admin','2018-05-06 11:25:13','',NULL,'N','No','DeleteItems',0),(320,'admin','2018-05-06 11:25:14','',NULL,'Y','Yes','DeleteItems',0),(323,'admin','2018-05-06 11:25:14','',NULL,'#d2d6de','Bg-Gray','ColorPallete',0),(336,'admin','2018-05-06 11:25:14','',NULL,'#dd4b39','bg-red','ColorPallete',0),(338,'admin','2018-05-06 11:25:14','',NULL,'#f39c12','bg-yellow','ColorPallete',0),(339,'admin','2018-05-06 11:25:14','',NULL,'#00c0ef','bg-aqua','ColorPallete',0),(340,'admin','2018-05-06 11:25:14','',NULL,'#0073b7','bg-blue','ColorPallete',0),(341,'admin','2018-05-06 11:25:14','',NULL,'CRUD','CRUD','ModuleType',0),(342,'admin','2018-05-06 11:25:14','',NULL,'ReportView','ReportView','ModuleType',0),(343,'admin','2018-05-06 11:25:14','',NULL,'Default','Default','ModuleListView',0),(346,'admin','2018-05-06 11:25:15','',NULL,'FormButton','FormButton','MenuType',0),(348,'admin','2018-05-06 11:25:15','',NULL,'IconButton','IconButton','MenuType',0),(349,'admin','2018-05-06 11:25:15','',NULL,'ButtonDropDown','ButtonDropDown','MenuType',0),(351,'admin','2018-05-06 11:25:15','',NULL,'fa fa-percent','fa fa-percent','FontAwesome',0),(358,'admin','2018-05-06 11:25:15','',NULL,'Pop-Up','Pop-Up','MenuType',0),(364,'admin','2018-05-06 11:25:15','',NULL,'Custom','Custom','ModuleListView',0),(365,'admin','2018-05-06 11:25:15','',NULL,'#3c8dbc','bg-light-blue','ColorPallete',0),(366,'admin','2018-05-06 11:25:16','',NULL,'#00a65a','bg-green','ColorPallete',0),(367,'admin','2018-05-06 11:25:16','',NULL,'#001f3f','bg-navy','ColorPallete',0),(368,'admin','2018-05-06 11:25:16','',NULL,'#39cccc','bg-teal','ColorPallete',0),(369,'admin','2018-05-06 11:25:16','',NULL,'#3d9970','bg-olive','ColorPallete',0),(370,'admin','2018-05-06 11:25:16','',NULL,'#01ff70','bg-lime','ColorPallete',0),(371,'admin','2018-05-06 11:25:16','',NULL,'#ff851b','bg-orange','ColorPallete',0),(372,'admin','2018-05-06 11:25:16','',NULL,'#f012be','bg-fuchsia','ColorPallete',0),(373,'admin','2018-05-06 11:25:16','',NULL,'#605ca8','bg-purple','ColorPallete',0),(374,'admin','2018-05-06 11:25:16','',NULL,'#d81b60','bg--maroon','ColorPallete',0),(376,'admin','2018-05-06 11:25:16','',NULL,'fa fa-phone','fa fa-phone','FontAwesome',0),(377,'admin','2018-05-06 11:25:16','',NULL,'fa fa-phone-square','fa fa-phone-square','FontAwesome',0),(378,'admin','2018-05-06 11:25:16','',NULL,'fa fa-phone-volume','fa fa-phone-volume','FontAwesome',0),(379,'admin','2018-05-06 11:25:16','',NULL,'fa fa-pills','fa fa-pills','FontAwesome',0),(380,'admin','2018-05-06 11:25:16','',NULL,'fa fa-plane','fa fa-plane','FontAwesome',0),(381,'admin','2018-05-06 11:25:16','',NULL,'fa fa-play','fa fa-play','FontAwesome',0),(382,'admin','2018-05-06 11:25:16','',NULL,'fa fa-play-circle','fa fa-play-circle','FontAwesome',0),(383,'admin','2018-05-06 11:25:16','',NULL,'fa fa-plug','fa fa-plug','FontAwesome',0),(384,'admin','2018-05-06 11:25:16','',NULL,'fa fa-plus','fa fa-plus','FontAwesome',0),(385,'admin','2018-05-06 11:25:16','',NULL,'fa fa-plus-circle','fa fa-plus-circle','FontAwesome',0),(386,'admin','2018-05-06 11:25:16','',NULL,'fa fa-plus-square','fa fa-plus-square','FontAwesome',0),(387,'admin','2018-05-06 11:25:16','',NULL,'fa fa-podcast','fa fa-podcast','FontAwesome',0),(388,'admin','2018-05-06 11:25:16','',NULL,'fa fa-pound-sign','fa fa-pound-sign','FontAwesome',0),(389,'admin','2018-05-06 11:25:16','',NULL,'fa fa-power-off','fa fa-power-off','FontAwesome',0),(390,'admin','2018-05-06 11:25:17','',NULL,'fa fa-print','fa fa-print','FontAwesome',0),(391,'admin','2018-05-06 11:25:17','',NULL,'fa fa-puzzle-piece','fa fa-puzzle-piece','FontAwesome',0),(392,'admin','2018-05-06 11:25:17','',NULL,'fa fa-qrcode','fa fa-qrcode','FontAwesome',0),(393,'admin','2018-05-06 11:25:17','',NULL,'fa fa-question','fa fa-question','FontAwesome',0),(394,'admin','2018-05-06 11:25:17','',NULL,'fa fa-question-circle','fa fa-question-circle','FontAwesome',0),(395,'admin','2018-05-06 11:25:17','',NULL,'fa fa-quidditch','fa fa-quidditch','FontAwesome',0),(396,'admin','2018-05-06 11:25:17','',NULL,'fa fa-quote-left','fa fa-quote-left','FontAwesome',0),(397,'admin','2018-05-06 11:25:17','',NULL,'fa fa-quote-right','fa fa-quote-right','FontAwesome',0),(398,'admin','2018-05-06 11:25:17','',NULL,'fa fa-random','fa fa-random','FontAwesome',0),(399,'admin','2018-05-06 11:25:17','',NULL,'fa fa-recycle','fa fa-recycle','FontAwesome',0),(400,'admin','2018-05-06 11:25:17','',NULL,'fa fa-redo','fa fa-redo','FontAwesome',0),(401,'admin','2018-05-06 11:25:17','',NULL,'fa fa-redo-alt','fa fa-redo-alt','FontAwesome',0),(402,'admin','2018-05-06 11:25:17','',NULL,'fa fa-registered','fa fa-registered','FontAwesome',0),(403,'admin','2018-05-06 11:25:17','',NULL,'fa fa-reply','fa fa-reply','FontAwesome',0),(404,'admin','2018-05-06 11:25:17','',NULL,'fa fa-reply-all','fa fa-reply-all','FontAwesome',0),(405,'admin','2018-05-06 11:25:17','',NULL,'fa fa-retweet','fa fa-retweet','FontAwesome',0),(406,'admin','2018-05-06 11:25:17','',NULL,'fa fa-road','fa fa-road','FontAwesome',0),(407,'admin','2018-05-06 11:25:17','',NULL,'fa fa-rocket','fa fa-rocket','FontAwesome',0),(408,'admin','2018-05-06 11:25:17','',NULL,'fa fa-rss','fa fa-rss','FontAwesome',0),(409,'admin','2018-05-06 11:25:17','',NULL,'fa fa-rss-square','fa fa-rss-square','FontAwesome',0),(410,'admin','2018-05-06 11:25:17','',NULL,'fa fa-ruble-sign','fa fa-ruble-sign','FontAwesome',0),(411,'admin','2018-05-06 11:25:17','',NULL,'fa fa-rupee-sign','fa fa-rupee-sign','FontAwesome',0),(412,'admin','2018-05-06 11:25:17','',NULL,'fa fa-save','fa fa-save','FontAwesome',0),(413,'admin','2018-05-06 11:25:18','',NULL,'fa fa-search','fa fa-search','FontAwesome',0),(414,'admin','2018-05-06 11:25:18','',NULL,'fa fa-search-minus','fa fa-search-minus','FontAwesome',0),(415,'admin','2018-05-06 11:25:18','',NULL,'fa fa-search-plus','fa fa-search-plus','FontAwesome',0),(416,'admin','2018-05-06 11:25:18','',NULL,'fa fa-server','fa fa-server','FontAwesome',0),(417,'admin','2018-05-06 11:25:18','',NULL,'fa fa-share','fa fa-share','FontAwesome',0),(418,'admin','2018-05-06 11:25:18','',NULL,'fa fa-share-alt','fa fa-share-alt','FontAwesome',0),(419,'admin','2018-05-06 11:25:18','',NULL,'fa fa-share-alt-square','fa fa-share-alt-square','FontAwesome',0),(420,'admin','2018-05-06 11:25:18','',NULL,'fa fa-share-square','fa fa-share-square','FontAwesome',0),(421,'admin','2018-05-06 11:25:18','',NULL,'fa fa-shekel-sign','fa fa-shekel-sign','FontAwesome',0),(422,'admin','2018-05-06 11:25:18','',NULL,'fa fa-shield-alt','fa fa-shield-alt','FontAwesome',0),(423,'admin','2018-05-06 11:25:18','',NULL,'fa fa-ship','fa fa-ship','FontAwesome',0),(424,'admin','2018-05-06 11:25:18','',NULL,'fa fa-shipping-fast','fa fa-shipping-fast','FontAwesome',0),(425,'admin','2018-05-06 11:25:18','',NULL,'fa fa-shopping-bag','fa fa-shopping-bag','FontAwesome',0),(426,'admin','2018-05-06 11:25:18','',NULL,'fa fa-shopping-basket','fa fa-shopping-basket','FontAwesome',0),(427,'admin','2018-05-06 11:25:18','',NULL,'fa fa-shopping-cart','fa fa-shopping-cart','FontAwesome',0),(428,'admin','2018-05-06 11:25:18','',NULL,'fa fa-shower','fa fa-shower','FontAwesome',0),(429,'admin','2018-05-06 11:25:18','',NULL,'fa fa-sign-in-alt','fa fa-sign-in-alt','FontAwesome',0),(430,'admin','2018-05-06 11:25:18','',NULL,'fa fa-sign-language','fa fa-sign-language','FontAwesome',0),(431,'admin','2018-05-06 11:25:18','',NULL,'fa fa-sign-out-alt','fa fa-sign-out-alt','FontAwesome',0),(432,'admin','2018-05-06 11:25:18','',NULL,'fa fa-signal','fa fa-signal','FontAwesome',0),(433,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sitemap','fa fa-sitemap','FontAwesome',0),(434,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sliders-h','fa fa-sliders-h','FontAwesome',0),(435,'admin','2018-05-06 11:25:19','',NULL,'fa fa-smile','fa fa-smile','FontAwesome',0),(436,'admin','2018-05-06 11:25:19','',NULL,'fa fa-snowflake','fa fa-snowflake','FontAwesome',0),(437,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sort','fa fa-sort','FontAwesome',0),(438,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sort-alpha-down','fa fa-sort-alpha-down','FontAwesome',0),(439,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sort-alpha-up','fa fa-sort-alpha-up','FontAwesome',0),(440,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sort-amount-down','fa fa-sort-amount-down','FontAwesome',0),(441,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sort-amount-up','fa fa-sort-amount-up','FontAwesome',0),(442,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sort-down','fa fa-sort-down','FontAwesome',0),(443,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sort-numeric-down','fa fa-sort-numeric-down','FontAwesome',0),(444,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sort-numeric-up','fa fa-sort-numeric-up','FontAwesome',0),(445,'admin','2018-05-06 11:25:19','',NULL,'fa fa-sort-up','fa fa-sort-up','FontAwesome',0),(446,'admin','2018-05-06 11:25:19','',NULL,'fa fa-space-shuttle','fa fa-space-shuttle','FontAwesome',0),(447,'admin','2018-05-06 11:25:19','',NULL,'fa fa-spinner','fa fa-spinner','FontAwesome',0),(448,'admin','2018-05-06 11:25:19','',NULL,'fa fa-square','fa fa-square','FontAwesome',0),(449,'admin','2018-05-06 11:25:19','',NULL,'fa fa-square-full','fa fa-square-full','FontAwesome',0),(450,'admin','2018-05-06 11:25:19','',NULL,'fa fa-star','fa fa-star','FontAwesome',0),(451,'admin','2018-05-06 11:25:20','',NULL,'fa fa-star-half','fa fa-star-half','FontAwesome',0),(452,'admin','2018-05-06 11:25:20','',NULL,'fa fa-step-backward','fa fa-step-backward','FontAwesome',0),(453,'admin','2018-05-06 11:25:20','',NULL,'fa fa-step-forward','fa fa-step-forward','FontAwesome',0),(454,'admin','2018-05-06 11:25:20','',NULL,'fa fa-stethoscope','fa fa-stethoscope','FontAwesome',0),(455,'admin','2018-05-06 11:25:20','',NULL,'fa fa-sticky-note','fa fa-sticky-note','FontAwesome',0),(456,'admin','2018-05-06 11:25:20','',NULL,'fa fa-stop','fa fa-stop','FontAwesome',0),(457,'admin','2018-05-06 11:25:20','',NULL,'fa fa-stop-circle','fa fa-stop-circle','FontAwesome',0),(458,'admin','2018-05-06 11:25:20','',NULL,'fa fa-stopwatch','fa fa-stopwatch','FontAwesome',0),(459,'admin','2018-05-06 11:25:20','',NULL,'fa fa-calendar-plus','fa fa-calendar-plus','FontAwesome',0),(460,'admin','2018-05-06 11:25:20','',NULL,'fa fa-calendar-times','fa fa-calendar-times','FontAwesome',0),(461,'admin','2018-05-06 11:25:20','',NULL,'fa fa-camera','fa fa-camera','FontAwesome',0),(462,'admin','2018-05-06 11:25:20','',NULL,'fa fa-camera-retro','fa fa-camera-retro','FontAwesome',0),(463,'admin','2018-05-06 11:25:20','',NULL,'fa fa-car','fa fa-car','FontAwesome',0),(464,'admin','2018-05-06 11:25:20','',NULL,'fa fa-caret-down','fa fa-caret-down','FontAwesome',0),(465,'admin','2018-05-06 11:25:20','',NULL,'fa fa-caret-left','fa fa-caret-left','FontAwesome',0),(466,'admin','2018-05-06 11:25:20','',NULL,'fa fa-caret-right','fa fa-caret-right','FontAwesome',0),(467,'admin','2018-05-06 11:25:20','',NULL,'fa fa-caret-square-down','fa fa-caret-square-down','FontAwesome',0),(468,'admin','2018-05-06 11:25:20','',NULL,'fa fa-caret-square-left','fa fa-caret-square-left','FontAwesome',0),(469,'admin','2018-05-06 11:25:20','',NULL,'fa fa-caret-square-right','fa fa-caret-square-right','FontAwesome',0),(470,'admin','2018-05-06 11:25:21','',NULL,'fa fa-caret-square-up','fa fa-caret-square-up','FontAwesome',0),(471,'admin','2018-05-06 11:25:21','',NULL,'fa fa-caret-up','fa fa-caret-up','FontAwesome',0),(472,'admin','2018-05-06 11:25:21','',NULL,'fa fa-cart-arrow-down','fa fa-cart-arrow-down','FontAwesome',0),(473,'admin','2018-05-06 11:25:21','',NULL,'fa fa-cart-plus','fa fa-cart-plus','FontAwesome',0),(474,'admin','2018-05-06 11:25:21','',NULL,'fa fa-certificate','fa fa-certificate','FontAwesome',0),(475,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chart-area','fa fa-chart-area','FontAwesome',0),(476,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chart-bar','fa fa-chart-bar','FontAwesome',0),(477,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chart-line','fa fa-chart-line','FontAwesome',0),(478,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chart-pie','fa fa-chart-pie','FontAwesome',0),(479,'admin','2018-05-06 11:25:21','',NULL,'fa fa-check','fa fa-check','FontAwesome',0),(480,'admin','2018-05-06 11:25:21','',NULL,'fa fa-check-circle','fa fa-check-circle','FontAwesome',0),(481,'admin','2018-05-06 11:25:21','',NULL,'fa fa-check-square','fa fa-check-square','FontAwesome',0),(482,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chess','fa fa-chess','FontAwesome',0),(483,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chess-bishop','fa fa-chess-bishop','FontAwesome',0),(484,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chess-board','fa fa-chess-board','FontAwesome',0),(485,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chess-king','fa fa-chess-king','FontAwesome',0),(486,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chess-knight','fa fa-chess-knight','FontAwesome',0),(487,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chess-pawn','fa fa-chess-pawn','FontAwesome',0),(488,'admin','2018-05-06 11:25:21','',NULL,'fa fa-chess-queen','fa fa-chess-queen','FontAwesome',0),(489,'admin','2018-05-06 11:25:22','',NULL,'fa fa-chess-rook','fa fa-chess-rook','FontAwesome',0),(490,'admin','2018-05-06 11:25:22','',NULL,'fa fa-chevron-circle-down','fa fa-chevron-circle-down','FontAwesome',0),(491,'admin','2018-05-06 11:25:22','',NULL,'fa fa-chevron-circle-left','fa fa-chevron-circle-left','FontAwesome',0),(492,'admin','2018-05-06 11:25:22','',NULL,'fa fa-chevron-circle-right','fa fa-chevron-circle-right','FontAwesome',0),(493,'admin','2018-05-06 11:25:22','',NULL,'fa fa-chevron-circle-up','fa fa-chevron-circle-up','FontAwesome',0),(494,'admin','2018-05-06 11:25:22','',NULL,'fa fa-chevron-down','fa fa-chevron-down','FontAwesome',0),(495,'admin','2018-05-06 11:25:22','',NULL,'fa fa-chevron-left','fa fa-chevron-left','FontAwesome',0),(496,'admin','2018-05-06 11:25:22','',NULL,'fa fa-chevron-right','fa fa-chevron-right','FontAwesome',0),(497,'admin','2018-05-06 11:25:22','',NULL,'fa fa-chevron-up','fa fa-chevron-up','FontAwesome',0),(498,'admin','2018-05-06 11:25:22','',NULL,'fa fa-child','fa fa-child','FontAwesome',0),(499,'admin','2018-05-06 11:25:22','',NULL,'fa fa-circle','fa fa-circle','FontAwesome',0),(500,'admin','2018-05-06 11:25:22','',NULL,'fa fa-circle-notch','fa fa-circle-notch','FontAwesome',0),(501,'admin','2018-05-06 11:25:22','',NULL,'fa fa-clipboard','fa fa-clipboard','FontAwesome',0),(502,'admin','2018-05-06 11:25:22','',NULL,'fa fa-clipboard-check','fa fa-clipboard-check','FontAwesome',0),(503,'admin','2018-05-06 11:25:22','',NULL,'fa fa-clipboard-list','fa fa-clipboard-list','FontAwesome',0),(504,'admin','2018-05-06 11:25:22','',NULL,'fa fa-clock','fa fa-clock','FontAwesome',0),(505,'admin','2018-05-06 11:25:22','',NULL,'fa fa-clone','fa fa-clone','FontAwesome',0),(506,'admin','2018-05-06 11:25:22','',NULL,'fa fa-closed-captioning','fa fa-closed-captioning','FontAwesome',0),(507,'admin','2018-05-06 11:25:22','',NULL,'fa fa-cloud','fa fa-cloud','FontAwesome',0),(508,'admin','2018-05-06 11:25:23','',NULL,'fa fa-cloud-download-alt','fa fa-cloud-download-alt','FontAwesome',0),(509,'admin','2018-05-06 11:25:23','',NULL,'fa fa-cloud-upload-alt','fa fa-cloud-upload-alt','FontAwesome',0),(510,'admin','2018-05-06 11:25:23','',NULL,'fa fa-code','fa fa-code','FontAwesome',0),(511,'admin','2018-05-06 11:25:23','',NULL,'fa fa-code-branch','fa fa-code-branch','FontAwesome',0),(512,'admin','2018-05-06 11:25:23','',NULL,'fa fa-coffee','fa fa-coffee','FontAwesome',0),(513,'admin','2018-05-06 11:25:23','',NULL,'fa fa-cog','fa fa-cog','FontAwesome',0),(514,'admin','2018-05-06 11:25:23','',NULL,'fa fa-cogs','fa fa-cogs','FontAwesome',0),(515,'admin','2018-05-06 11:25:23','',NULL,'fa fa-columns','fa fa-columns','FontAwesome',0),(516,'admin','2018-05-06 11:25:23','',NULL,'fa fa-comment','fa fa-comment','FontAwesome',0),(517,'admin','2018-05-06 11:25:23','',NULL,'fa fa-comment-alt','fa fa-comment-alt','FontAwesome',0),(518,'admin','2018-05-06 11:25:23','',NULL,'fa fa-comments','fa fa-comments','FontAwesome',0),(519,'admin','2018-05-06 11:25:24','',NULL,'fa fa-compass','fa fa-compass','FontAwesome',0),(520,'admin','2018-05-06 11:25:24','',NULL,'fa fa-compress','fa fa-compress','FontAwesome',0),(521,'admin','2018-05-06 11:25:24','',NULL,'fa fa-copy','fa fa-copy','FontAwesome',0),(522,'admin','2018-05-06 11:25:24','',NULL,'fa fa-copyright','fa fa-copyright','FontAwesome',0),(523,'admin','2018-05-06 11:25:24','',NULL,'fa fa-credit-card','fa fa-credit-card','FontAwesome',0),(524,'admin','2018-05-06 11:25:24','',NULL,'fa fa-crop','fa fa-crop','FontAwesome',0),(525,'admin','2018-05-06 11:25:24','',NULL,'fa fa-crosshairs','fa fa-crosshairs','FontAwesome',0),(526,'admin','2018-05-06 11:25:24','',NULL,'fa fa-cube','fa fa-cube','FontAwesome',0),(527,'admin','2018-05-06 11:25:24','',NULL,'fa fa-cubes','fa fa-cubes','FontAwesome',0),(528,'admin','2018-05-06 11:25:24','',NULL,'fa fa-cut','fa fa-cut','FontAwesome',0),(529,'admin','2018-05-06 11:25:24','',NULL,'fa fa-database','fa fa-database','FontAwesome',0),(530,'admin','2018-05-06 11:25:24','',NULL,'fa fa-deaf','fa fa-deaf','FontAwesome',0),(531,'admin','2018-05-06 11:25:24','',NULL,'fa fa-desktop','fa fa-desktop','FontAwesome',0),(532,'admin','2018-05-06 11:25:24','',NULL,'fa fa-dna','fa fa-dna','FontAwesome',0),(533,'admin','2018-05-06 11:25:24','',NULL,'fa fa-dollar-sign','fa fa-dollar-sign','FontAwesome',0),(534,'admin','2018-05-06 11:25:24','',NULL,'fa fa-dolly','fa fa-dolly','FontAwesome',0),(535,'admin','2018-05-06 11:25:24','',NULL,'fa fa-dolly-flatbed','fa fa-dolly-flatbed','FontAwesome',0),(536,'admin','2018-05-06 11:25:24','',NULL,'fa fa-dot-circle','fa fa-dot-circle','FontAwesome',0),(537,'admin','2018-05-06 11:25:24','',NULL,'fa fa-download','fa fa-download','FontAwesome',0),(538,'admin','2018-05-06 11:25:25','',NULL,'fa fa-edit','fa fa-edit','FontAwesome',0),(539,'admin','2018-05-06 11:25:25','',NULL,'fa fa-eject','fa fa-eject','FontAwesome',0),(540,'admin','2018-05-06 11:25:25','',NULL,'fa fa-street-view','fa fa-street-view','FontAwesome',0),(541,'admin','2018-05-06 11:25:25','',NULL,'fa fa-strikethrough','fa fa-strikethrough','FontAwesome',0),(542,'admin','2018-05-06 11:25:25','',NULL,'fa fa-subscript','fa fa-subscript','FontAwesome',0),(543,'admin','2018-05-06 11:25:25','',NULL,'fa fa-subway','fa fa-subway','FontAwesome',0),(544,'admin','2018-05-06 11:25:25','',NULL,'fa fa-suitcase','fa fa-suitcase','FontAwesome',0),(545,'admin','2018-05-06 11:25:25','',NULL,'fa fa-sun','fa fa-sun','FontAwesome',0),(546,'admin','2018-05-06 11:25:25','',NULL,'fa fa-superscript','fa fa-superscript','FontAwesome',0),(547,'admin','2018-05-06 11:25:25','',NULL,'fa fa-sync','fa fa-sync','FontAwesome',0),(548,'admin','2018-05-06 11:25:25','',NULL,'fa fa-sync-alt','fa fa-sync-alt','FontAwesome',0),(549,'admin','2018-05-06 11:25:25','',NULL,'fa fa-syringe','fa fa-syringe','FontAwesome',0),(550,'admin','2018-05-06 11:25:25','',NULL,'fa fa-table','fa fa-table','FontAwesome',0),(551,'admin','2018-05-06 11:25:25','',NULL,'fa fa-table-tennis','fa fa-table-tennis','FontAwesome',0),(552,'admin','2018-05-06 11:25:25','',NULL,'fa fa-tablet','fa fa-tablet','FontAwesome',0),(553,'admin','2018-05-06 11:25:25','',NULL,'fa fa-tablet-alt','fa fa-tablet-alt','FontAwesome',0),(554,'admin','2018-05-06 11:25:25','',NULL,'fa fa-tachometer-alt','fa fa-tachometer-alt','FontAwesome',0),(555,'admin','2018-05-06 11:25:25','',NULL,'fa fa-tag','fa fa-tag','FontAwesome',0),(556,'admin','2018-05-06 11:25:25','',NULL,'fa fa-tags','fa fa-tags','FontAwesome',0),(557,'admin','2018-05-06 11:25:25','',NULL,'fa fa-tasks','fa fa-tasks','FontAwesome',0),(558,'admin','2018-05-06 11:25:26','',NULL,'fa fa-taxi','fa fa-taxi','FontAwesome',0),(559,'admin','2018-05-06 11:25:26','',NULL,'fa fa-terminal','fa fa-terminal','FontAwesome',0),(560,'admin','2018-05-06 11:25:26','',NULL,'fa fa-text-height','fa fa-text-height','FontAwesome',0),(561,'admin','2018-05-06 11:25:26','',NULL,'fa fa-text-width','fa fa-text-width','FontAwesome',0),(562,'admin','2018-05-06 11:25:26','',NULL,'fa fa-th','fa fa-th','FontAwesome',0),(563,'admin','2018-05-06 11:25:26','',NULL,'fa fa-th-large','fa fa-th-large','FontAwesome',0),(564,'admin','2018-05-06 11:25:26','',NULL,'fa fa-th-list','fa fa-th-list','FontAwesome',0),(565,'admin','2018-05-06 11:25:26','',NULL,'fa fa-thermometer','fa fa-thermometer','FontAwesome',0),(566,'admin','2018-05-06 11:25:26','',NULL,'fa fa-thermometer-empty','fa fa-thermometer-empty','FontAwesome',0),(567,'admin','2018-05-06 11:25:26','',NULL,'fa fa-thermometer-full','fa fa-thermometer-full','FontAwesome',0),(568,'admin','2018-05-06 11:25:26','',NULL,'fa fa-thermometer-half','fa fa-thermometer-half','FontAwesome',0),(569,'admin','2018-05-06 11:25:27','',NULL,'fa fa-thermometer-quarter','fa fa-thermometer-quarter','FontAwesome',0),(570,'admin','2018-05-06 11:25:27','',NULL,'fa fa-thermometer-three-quarters','fa fa-thermometer-three-quarters','FontAwesome',0),(571,'admin','2018-05-06 11:25:27','',NULL,'fa fa-thumbs-down','fa fa-thumbs-down','FontAwesome',0),(572,'admin','2018-05-06 11:25:27','',NULL,'fa fa-thumbs-up','fa fa-thumbs-up','FontAwesome',0),(573,'admin','2018-05-06 11:25:27','',NULL,'fa fa-thumbtack','fa fa-thumbtack','FontAwesome',0),(574,'admin','2018-05-06 11:25:27','',NULL,'fa fa-ticket-alt','fa fa-ticket-alt','FontAwesome',0),(575,'admin','2018-05-06 11:25:27','',NULL,'fa fa-times','fa fa-times','FontAwesome',0),(576,'admin','2018-05-06 11:25:27','',NULL,'fa fa-times-circle','fa fa-times-circle','FontAwesome',0),(577,'admin','2018-05-06 11:25:27','',NULL,'fa fa-tint','fa fa-tint','FontAwesome',0),(578,'admin','2018-05-06 11:25:27','',NULL,'fa fa-toggle-off','fa fa-toggle-off','FontAwesome',0),(579,'admin','2018-05-06 11:25:27','',NULL,'fa fa-toggle-on','fa fa-toggle-on','FontAwesome',0),(580,'admin','2018-05-06 11:25:27','',NULL,'fa fa-trademark','fa fa-trademark','FontAwesome',0),(581,'admin','2018-05-06 11:25:27','',NULL,'fa fa-train','fa fa-train','FontAwesome',0),(582,'admin','2018-05-06 11:25:27','',NULL,'fa fa-transgender','fa fa-transgender','FontAwesome',0),(583,'admin','2018-05-06 11:25:27','',NULL,'fa fa-transgender-alt','fa fa-transgender-alt','FontAwesome',0),(584,'admin','2018-05-06 11:25:27','',NULL,'fa fa-trash','fa fa-trash','FontAwesome',0),(585,'admin','2018-05-06 11:25:27','',NULL,'fa fa-trash-alt','fa fa-trash-alt','FontAwesome',0),(586,'admin','2018-05-06 11:25:27','',NULL,'fa fa-tree','fa fa-tree','FontAwesome',0),(587,'admin','2018-05-06 11:25:27','',NULL,'fa fa-trophy','fa fa-trophy','FontAwesome',0),(588,'admin','2018-05-06 11:25:27','',NULL,'fa fa-truck','fa fa-truck','FontAwesome',0),(589,'admin','2018-05-06 11:25:27','',NULL,'fa fa-tty','fa fa-tty','FontAwesome',0),(590,'admin','2018-05-06 11:25:28','',NULL,'fa fa-tv','fa fa-tv','FontAwesome',0),(591,'admin','2018-05-06 11:25:28','',NULL,'fa fa-umbrella','fa fa-umbrella','FontAwesome',0),(592,'admin','2018-05-06 11:25:28','',NULL,'fa fa-underline','fa fa-underline','FontAwesome',0),(593,'admin','2018-05-06 11:25:28','',NULL,'fa fa-undo','fa fa-undo','FontAwesome',0),(594,'admin','2018-05-06 11:25:28','',NULL,'fa fa-undo-alt','fa fa-undo-alt','FontAwesome',0),(595,'admin','2018-05-06 11:25:28','',NULL,'fa fa-universal-access','fa fa-universal-access','FontAwesome',0),(596,'admin','2018-05-06 11:25:28','',NULL,'fa fa-university','fa fa-university','FontAwesome',0),(597,'admin','2018-05-06 11:25:28','',NULL,'fa fa-unlink','fa fa-unlink','FontAwesome',0),(598,'admin','2018-05-06 11:25:28','',NULL,'fa fa-unlock','fa fa-unlock','FontAwesome',0),(599,'admin','2018-05-06 11:25:28','',NULL,'fa fa-unlock-alt','fa fa-unlock-alt','FontAwesome',0),(600,'admin','2018-05-06 11:25:28','',NULL,'fa fa-upload','fa fa-upload','FontAwesome',0),(601,'admin','2018-05-06 11:25:28','',NULL,'fa fa-user','fa fa-user','FontAwesome',0),(602,'admin','2018-05-06 11:25:28','',NULL,'fa fa-user-circle','fa fa-user-circle','FontAwesome',0),(603,'admin','2018-05-06 11:25:28','',NULL,'fa fa-user-md','fa fa-user-md','FontAwesome',0),(604,'admin','2018-05-06 11:25:28','',NULL,'fa fa-user-plus','fa fa-user-plus','FontAwesome',0),(605,'admin','2018-05-06 11:25:28','',NULL,'fa fa-user-secret','fa fa-user-secret','FontAwesome',0),(606,'admin','2018-05-06 11:25:28','',NULL,'fa fa-user-times','fa fa-user-times','FontAwesome',0),(607,'admin','2018-05-06 11:25:28','',NULL,'fa fa-users','fa fa-users','FontAwesome',0),(608,'admin','2018-05-06 11:25:28','',NULL,'fa fa-utensil-spoon','fa fa-utensil-spoon','FontAwesome',0),(609,'admin','2018-05-06 11:25:29','',NULL,'fa fa-utensils','fa fa-utensils','FontAwesome',0),(610,'admin','2018-05-06 11:25:29','',NULL,'fa fa-venus','fa fa-venus','FontAwesome',0),(611,'admin','2018-05-06 11:25:29','',NULL,'fa fa-venus-double','fa fa-venus-double','FontAwesome',0),(612,'admin','2018-05-06 11:25:29','',NULL,'fa fa-venus-mars','fa fa-venus-mars','FontAwesome',0),(613,'admin','2018-05-06 11:25:29','',NULL,'fa fa-video','fa fa-video','FontAwesome',0),(614,'admin','2018-05-06 11:25:29','',NULL,'fa fa-volleyball-ball','fa fa-volleyball-ball','FontAwesome',0),(615,'admin','2018-05-06 11:25:29','',NULL,'fa fa-volume-down','fa fa-volume-down','FontAwesome',0),(616,'admin','2018-05-06 11:25:29','',NULL,'fa fa-volume-off','fa fa-volume-off','FontAwesome',0),(617,'admin','2018-05-06 11:25:29','',NULL,'fa fa-volume-up','fa fa-volume-up','FontAwesome',0),(618,'admin','2018-05-06 11:25:29','',NULL,'fa fa-warehouse','fa fa-warehouse','FontAwesome',0),(619,'admin','2018-05-06 11:25:29','',NULL,'fa fa-weight','fa fa-weight','FontAwesome',0),(620,'admin','2018-05-06 11:25:29','',NULL,'fa fa-wheelchair','fa fa-wheelchair','FontAwesome',0),(621,'admin','2018-05-06 11:25:29','',NULL,'fa fa-wifi','fa fa-wifi','FontAwesome',0),(622,'admin','2018-05-06 11:25:29','',NULL,'fa fa-window-close','fa fa-window-close','FontAwesome',0),(662,'admin','2018-05-06 11:25:31','',NULL,'fa fa-ellipsis-h','fa fa-ellipsis-h','FontAwesome',0),(663,'admin','2018-05-06 11:25:31','',NULL,'fa fa-window-maximize','fa fa-window-maximize','FontAwesome',0),(664,'admin','2018-05-06 11:25:31','',NULL,'fa fa-window-minimize','fa fa-window-minimize','FontAwesome',0),(665,'admin','2018-05-06 11:25:32','',NULL,'fa fa-window-restore','fa fa-window-restore','FontAwesome',0),(666,'admin','2018-05-06 11:25:32','',NULL,'fa fa-won-sign','fa fa-won-sign','FontAwesome',0),(667,'admin','2018-05-06 11:25:32','',NULL,'fa fa-wrench','fa fa-wrench','FontAwesome',0),(668,'admin','2018-05-06 11:25:32','',NULL,'fa fa-yen-sign','fa fa-yen-sign','FontAwesome',0),(669,'admin','2018-05-06 11:25:32','',NULL,'fa fa-ellipsis-v','fa fa-ellipsis-v','FontAwesome',0),(670,'admin','2018-05-06 11:25:32','',NULL,'fa fa-envelope','fa fa-envelope','FontAwesome',0),(671,'admin','2018-05-06 11:25:32','',NULL,'fa fa-envelope-open','fa fa-envelope-open','FontAwesome',0),(672,'admin','2018-05-06 11:25:32','',NULL,'fa fa-envelope-square','fa fa-envelope-square','FontAwesome',0),(673,'admin','2018-05-06 11:25:32','',NULL,'fa fa-eraser','fa fa-eraser','FontAwesome',0),(674,'admin','2018-05-06 11:25:32','',NULL,'fa fa-euro-sign','fa fa-euro-sign','FontAwesome',0),(675,'admin','2018-05-06 11:25:32','',NULL,'fa fa-exchange-alt','fa fa-exchange-alt','FontAwesome',0),(676,'admin','2018-05-06 11:25:32','',NULL,'fa fa-exclamation','fa fa-exclamation','FontAwesome',0),(677,'admin','2018-05-06 11:25:32','',NULL,'fa fa-exclamation-circle','fa fa-exclamation-circle','FontAwesome',0),(678,'admin','2018-05-06 11:25:32','',NULL,'fa fa-exclamation-triangle','fa fa-exclamation-triangle','FontAwesome',0),(679,'admin','2018-05-06 11:25:32','',NULL,'fa fa-expand','fa fa-expand','FontAwesome',0),(680,'admin','2018-05-06 11:25:32','',NULL,'fa fa-expand-arrows-alt','fa fa-expand-arrows-alt','FontAwesome',0),(681,'admin','2018-05-06 11:25:32','',NULL,'fa fa-external-link-alt','fa fa-external-link-alt','FontAwesome',0),(682,'admin','2018-05-06 11:25:32','',NULL,'fa fa-external-link-square-alt','fa fa-external-link-square-alt','FontAwesome',0),(683,'admin','2018-05-06 11:25:32','',NULL,'fa fa-eye','fa fa-eye','FontAwesome',0),(684,'admin','2018-05-06 11:25:32','',NULL,'fa fa-eye-dropper','fa fa-eye-dropper','FontAwesome',0),(685,'admin','2018-05-06 11:25:32','',NULL,'fa fa-eye-slash','fa fa-eye-slash','FontAwesome',0),(686,'admin','2018-05-06 11:25:33','',NULL,'fa fa-fast-backward','fa fa-fast-backward','FontAwesome',0),(687,'admin','2018-05-06 11:25:33','',NULL,'fa fa-fast-forward','fa fa-fast-forward','FontAwesome',0),(688,'admin','2018-05-06 11:25:33','',NULL,'fa fa-fax','fa fa-fax','FontAwesome',0),(689,'admin','2018-05-06 11:25:33','',NULL,'fa fa-female','fa fa-female','FontAwesome',0),(690,'admin','2018-05-06 11:25:33','',NULL,'fa fa-fighter-jet','fa fa-fighter-jet','FontAwesome',0),(691,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file','fa fa-file','FontAwesome',0),(692,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-alt','fa fa-file-alt','FontAwesome',0),(693,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-archive','fa fa-file-archive','FontAwesome',0),(694,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-audio','fa fa-file-audio','FontAwesome',0),(695,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-code','fa fa-file-code','FontAwesome',0),(696,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-excel','fa fa-file-excel','FontAwesome',0),(697,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-image','fa fa-file-image','FontAwesome',0),(698,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-pdf','fa fa-file-pdf','FontAwesome',0),(699,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-powerpoint','fa fa-file-powerpoint','FontAwesome',0),(700,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-video','fa fa-file-video','FontAwesome',0),(701,'admin','2018-05-06 11:25:33','',NULL,'fa fa-file-word','fa fa-file-word','FontAwesome',0),(702,'admin','2018-05-06 11:25:33','',NULL,'fa fa-film','fa fa-film','FontAwesome',0),(703,'admin','2018-05-06 11:25:33','',NULL,'fa fa-filter','fa fa-filter','FontAwesome',0),(704,'admin','2018-05-06 11:25:33','',NULL,'fa fa-fire','fa fa-fire','FontAwesome',0),(705,'admin','2018-05-06 11:25:34','',NULL,'fa fa-fire-extinguisher','fa fa-fire-extinguisher','FontAwesome',0),(706,'admin','2018-05-06 11:25:34','',NULL,'fa fa-first-aid','fa fa-first-aid','FontAwesome',0),(707,'admin','2018-05-06 11:25:34','',NULL,'fa fa-flag','fa fa-flag','FontAwesome',0),(708,'admin','2018-05-06 11:25:34','',NULL,'fa fa-flag-checkered','fa fa-flag-checkered','FontAwesome',0),(709,'admin','2018-05-06 11:25:34','',NULL,'fa fa-flask','fa fa-flask','FontAwesome',0),(710,'admin','2018-05-06 11:25:34','',NULL,'fa fa-folder','fa fa-folder','FontAwesome',0),(711,'admin','2018-05-06 11:25:34','',NULL,'fa fa-folder-open','fa fa-folder-open','FontAwesome',0),(712,'admin','2018-05-06 11:25:34','',NULL,'fa fa-font','fa fa-font','FontAwesome',0),(713,'admin','2018-05-06 11:25:34','',NULL,'fa fa-football-ball','fa fa-football-ball','FontAwesome',0),(714,'admin','2018-05-06 11:25:34','',NULL,'fa fa-forward','fa fa-forward','FontAwesome',0),(715,'admin','2018-05-06 11:25:34','',NULL,'fa fa-frown','fa fa-frown','FontAwesome',0),(716,'admin','2018-05-06 11:25:35','',NULL,'fa fa-futbol','fa fa-futbol','FontAwesome',0),(717,'admin','2018-05-06 11:25:35','',NULL,'fa fa-gamepad','fa fa-gamepad','FontAwesome',0),(718,'admin','2018-05-06 11:25:35','',NULL,'fa fa-gavel','fa fa-gavel','FontAwesome',0),(719,'admin','2018-05-06 11:25:35','',NULL,'fa fa-gem','fa fa-gem','FontAwesome',0),(720,'admin','2018-05-06 11:25:35','',NULL,'fa fa-genderless','fa fa-genderless','FontAwesome',0),(721,'admin','2018-05-06 11:25:35','',NULL,'fa fa-gift','fa fa-gift','FontAwesome',0),(722,'admin','2018-05-06 11:25:35','',NULL,'fa fa-glass-martini','fa fa-glass-martini','FontAwesome',0),(723,'admin','2018-05-06 11:25:35','',NULL,'fa fa-globe','fa fa-globe','FontAwesome',0),(724,'admin','2018-05-06 11:25:35','',NULL,'fa fa-golf-ball','fa fa-golf-ball','FontAwesome',0),(725,'admin','2018-05-06 11:25:35','',NULL,'fa fa-graduation-cap','fa fa-graduation-cap','FontAwesome',0),(726,'admin','2018-05-06 11:25:35','',NULL,'fa fa-h-square','fa fa-h-square','FontAwesome',0),(727,'admin','2018-05-06 11:25:35','',NULL,'fa fa-hand-lizard','fa fa-hand-lizard','FontAwesome',0),(728,'admin','2018-05-06 11:25:35','',NULL,'fa fa-hand-paper','fa fa-hand-paper','FontAwesome',0),(729,'admin','2018-05-06 11:25:35','',NULL,'fa fa-hand-peace','fa fa-hand-peace','FontAwesome',0),(730,'admin','2018-05-06 11:25:35','',NULL,'fa fa-hand-point-down','fa fa-hand-point-down','FontAwesome',0),(731,'admin','2018-05-06 11:25:35','',NULL,'fa fa-hand-point-left','fa fa-hand-point-left','FontAwesome',0),(732,'admin','2018-05-06 11:25:35','',NULL,'fa fa-hand-point-right','fa fa-hand-point-right','FontAwesome',0),(733,'admin','2018-05-06 11:25:35','',NULL,'fa fa-hand-point-up','fa fa-hand-point-up','FontAwesome',0),(734,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hand-pointer','fa fa-hand-pointer','FontAwesome',0),(735,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hand-rock','fa fa-hand-rock','FontAwesome',0),(736,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hand-scissors','fa fa-hand-scissors','FontAwesome',0),(737,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hand-spock','fa fa-hand-spock','FontAwesome',0),(738,'admin','2018-05-06 11:25:36','',NULL,'fa fa-handshake','fa fa-handshake','FontAwesome',0),(739,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hashtag','fa fa-hashtag','FontAwesome',0),(740,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hdd','fa fa-hdd','FontAwesome',0),(741,'admin','2018-05-06 11:25:36','',NULL,'fa fa-heading','fa fa-heading','FontAwesome',0),(742,'admin','2018-05-06 11:25:36','',NULL,'fa fa-headphones','fa fa-headphones','FontAwesome',0),(743,'admin','2018-05-06 11:25:36','',NULL,'fa fa-heart','fa fa-heart','FontAwesome',0),(744,'admin','2018-05-06 11:25:36','',NULL,'fa fa-heartbeat','fa fa-heartbeat','FontAwesome',0),(745,'admin','2018-05-06 11:25:36','',NULL,'fa fa-history','fa fa-history','FontAwesome',0),(746,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hockey-puck','fa fa-hockey-puck','FontAwesome',0),(747,'admin','2018-05-06 11:25:36','',NULL,'fa fa-home','fa fa-home','FontAwesome',0),(748,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hospital','fa fa-hospital','FontAwesome',0),(749,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hospital-symbol','fa fa-hospital-symbol','FontAwesome',0),(752,'admin','2018-05-06 11:25:36','',NULL,'fa fa-hourglass','fa fa-hourglass','FontAwesome',0),(755,'admin','2018-05-06 11:25:36','',NULL,'fa fa-address-book','fa fa-address-book','FontAwesome',0),(756,'admin','2018-05-06 11:25:37','',NULL,'fa fa-address-card','fa fa-address-card','FontAwesome',0),(757,'admin','2018-05-06 11:25:37','',NULL,'fa fa-adjust','fa fa-adjust','FontAwesome',0),(758,'admin','2018-05-06 11:25:37','',NULL,'fa fa-align-center','fa fa-align-center','FontAwesome',0),(759,'admin','2018-05-06 11:25:37','',NULL,'fa fa-align-justify','fa fa-align-justify','FontAwesome',0),(760,'admin','2018-05-06 11:25:37','',NULL,'fa fa-align-left','fa fa-align-left','FontAwesome',0),(761,'admin','2018-05-06 11:25:37','',NULL,'fa fa-align-right','fa fa-align-right','FontAwesome',0),(762,'admin','2018-05-06 11:25:37','',NULL,'fa fa-ambulance','fa fa-ambulance','FontAwesome',0),(763,'admin','2018-05-06 11:25:37','',NULL,'fa fa-american-sign-language-interpreting','fa fa-american-sign-language-interpreting','FontAwesome',0),(764,'admin','2018-05-06 11:25:37','',NULL,'fa fa-anchor','fa fa-anchor','FontAwesome',0),(765,'admin','2018-05-06 11:25:37','',NULL,'fa fa-angle-double-down','fa fa-angle-double-down','FontAwesome',0),(766,'admin','2018-05-06 11:25:37','',NULL,'fa fa-angle-double-left','fa fa-angle-double-left','FontAwesome',0),(767,'admin','2018-05-06 11:25:37','',NULL,'fa fa-angle-double-right','fa fa-angle-double-right','FontAwesome',0),(768,'admin','2018-05-06 11:25:37','',NULL,'fa fa-angle-double-up','fa fa-angle-double-up','FontAwesome',0),(769,'admin','2018-05-06 11:25:37','',NULL,'fa fa-angle-down','fa fa-angle-down','FontAwesome',0),(770,'admin','2018-05-06 11:25:37','',NULL,'fa fa-angle-left','fa fa-angle-left','FontAwesome',0),(771,'admin','2018-05-06 11:25:37','',NULL,'fa fa-angle-right','fa fa-angle-right','FontAwesome',0),(772,'admin','2018-05-06 11:25:38','',NULL,'fa fa-angle-up','fa fa-angle-up','FontAwesome',0),(773,'admin','2018-05-06 11:25:38','',NULL,'fa fa-archive','fa fa-archive','FontAwesome',0),(774,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-alt-circle-down','fa fa-arrow-alt-circle-down','FontAwesome',0),(775,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-alt-circle-left','fa fa-arrow-alt-circle-left','FontAwesome',0),(776,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-alt-circle-right','fa fa-arrow-alt-circle-right','FontAwesome',0),(777,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-alt-circle-up','fa fa-arrow-alt-circle-up','FontAwesome',0),(778,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-circle-down','fa fa-arrow-circle-down','FontAwesome',0),(779,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-circle-left','fa fa-arrow-circle-left','FontAwesome',0),(780,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-circle-right','fa fa-arrow-circle-right','FontAwesome',0),(781,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-circle-up','fa fa-arrow-circle-up','FontAwesome',0),(782,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-down','fa fa-arrow-down','FontAwesome',0),(783,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-left','fa fa-arrow-left','FontAwesome',0),(784,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-right','fa fa-arrow-right','FontAwesome',0),(785,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrow-up','fa fa-arrow-up','FontAwesome',0),(786,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrows-alt','fa fa-arrows-alt','FontAwesome',0),(787,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrows-alt-h','fa fa-arrows-alt-h','FontAwesome',0),(788,'admin','2018-05-06 11:25:38','',NULL,'fa fa-arrows-alt-v','fa fa-arrows-alt-v','FontAwesome',0),(789,'admin','2018-05-06 11:25:38','',NULL,'fa fa-assistive-listening-systems','fa fa-assistive-listening-systems','FontAwesome',0),(790,'admin','2018-05-06 11:25:38','',NULL,'fa fa-asterisk','fa fa-asterisk','FontAwesome',0),(791,'admin','2018-05-06 11:25:38','',NULL,'fa fa-at','fa fa-at','FontAwesome',0),(792,'admin','2018-05-06 11:25:38','',NULL,'fa fa-audio-description','fa fa-audio-description','FontAwesome',0),(793,'admin','2018-05-06 11:25:38','',NULL,'fa fa-backward','fa fa-backward','FontAwesome',0),(794,'admin','2018-05-06 11:25:39','',NULL,'fa fa-balance-scale','fa fa-balance-scale','FontAwesome',0),(795,'admin','2018-05-06 11:25:39','',NULL,'fa fa-ban','fa fa-ban','FontAwesome',0),(796,'admin','2018-05-06 11:25:39','',NULL,'fa fa-band-aid','fa fa-band-aid','FontAwesome',0),(797,'admin','2018-05-06 11:25:39','',NULL,'fa fa-barcode','fa fa-barcode','FontAwesome',0),(798,'admin','2018-05-06 11:25:39','',NULL,'fa fa-bars','fa fa-bars','FontAwesome',0),(799,'admin','2018-05-06 11:25:39','',NULL,'fa fa-baseball-ball','fa fa-baseball-ball','FontAwesome',0),(800,'admin','2018-05-06 11:25:39','',NULL,'fa fa-basketball-ball','fa fa-basketball-ball','FontAwesome',0),(801,'admin','2018-05-06 11:25:39','',NULL,'fa fa-bath','fa fa-bath','FontAwesome',0),(802,'admin','2018-05-06 11:25:39','',NULL,'fa fa-battery-empty','fa fa-battery-empty','FontAwesome',0),(803,'admin','2018-05-06 11:25:39','',NULL,'fa fa-battery-full','fa fa-battery-full','FontAwesome',0),(804,'admin','2018-05-06 11:25:39','',NULL,'fa fa-battery-half','fa fa-battery-half','FontAwesome',0),(805,'admin','2018-05-06 11:25:39','',NULL,'fa fa-battery-quarter','fa fa-battery-quarter','FontAwesome',0),(806,'admin','2018-05-06 11:25:39','',NULL,'fa fa-battery-three-quarters','fa fa-battery-three-quarters','FontAwesome',0),(807,'admin','2018-05-06 11:25:39','',NULL,'fa fa-bed','fa fa-bed','FontAwesome',0),(808,'admin','2018-05-06 11:25:39','',NULL,'fa fa-beer','fa fa-beer','FontAwesome',0),(809,'admin','2018-05-06 11:25:39','',NULL,'fa fa-bell','fa fa-bell','FontAwesome',0),(810,'admin','2018-05-06 11:25:39','',NULL,'fa fa-bell-slash','fa fa-bell-slash','FontAwesome',0),(811,'admin','2018-05-06 11:25:39','',NULL,'fa fa-bicycle','fa fa-bicycle','FontAwesome',0),(812,'admin','2018-05-06 11:25:40','',NULL,'fa fa-binoculars','fa fa-binoculars','FontAwesome',0),(813,'admin','2018-05-06 11:25:40','',NULL,'fa fa-birthday-cake','fa fa-birthday-cake','FontAwesome',0),(814,'admin','2018-05-06 11:25:40','',NULL,'fa fa-blind','fa fa-blind','FontAwesome',0),(815,'admin','2018-05-06 11:25:40','',NULL,'fa fa-bold','fa fa-bold','FontAwesome',0),(816,'admin','2018-05-06 11:25:40','',NULL,'fa fa-bolt','fa fa-bolt','FontAwesome',0),(817,'admin','2018-05-06 11:25:40','',NULL,'fa fa-bomb','fa fa-bomb','FontAwesome',0),(818,'admin','2018-05-06 11:25:40','',NULL,'fa fa-book','fa fa-book','FontAwesome',0),(819,'admin','2018-05-06 11:25:40','',NULL,'fa fa-bookmark','fa fa-bookmark','FontAwesome',0),(820,'admin','2018-05-06 11:25:40','',NULL,'fa fa-bowling-ball','fa fa-bowling-ball','FontAwesome',0),(821,'admin','2018-05-06 11:25:40','',NULL,'fa fa-box','fa fa-box','FontAwesome',0),(822,'admin','2018-05-06 11:25:40','',NULL,'fa fa-boxes','fa fa-boxes','FontAwesome',0),(823,'admin','2018-05-06 11:25:40','',NULL,'fa fa-braille','fa fa-braille','FontAwesome',0),(824,'admin','2018-05-06 11:25:40','',NULL,'fa fa-briefcase','fa fa-briefcase','FontAwesome',0),(825,'admin','2018-05-06 11:25:40','',NULL,'fa fa-bug','fa fa-bug','FontAwesome',0),(826,'admin','2018-05-06 11:25:40','',NULL,'fa fa-building','fa fa-building','FontAwesome',0),(827,'admin','2018-05-06 11:25:40','',NULL,'fa fa-bullhorn','fa fa-bullhorn','FontAwesome',0),(828,'admin','2018-05-06 11:25:40','',NULL,'fa fa-bullseye','fa fa-bullseye','FontAwesome',0),(829,'admin','2018-05-06 11:25:40','',NULL,'fa fa-bus','fa fa-bus','FontAwesome',0),(830,'admin','2018-05-06 11:25:40','',NULL,'fa fa-calculator','fa fa-calculator','FontAwesome',0),(831,'admin','2018-05-06 11:25:41','',NULL,'fa fa-calendar','fa fa-calendar','FontAwesome',0),(832,'admin','2018-05-06 11:25:41','',NULL,'fa fa-calendar-alt','fa fa-calendar-alt','FontAwesome',0),(833,'admin','2018-05-06 11:25:41','',NULL,'fa fa-calendar-check','fa fa-calendar-check','FontAwesome',0),(834,'admin','2018-05-06 11:25:41','',NULL,'fa fa-hourglass-end','fa fa-hourglass-end','FontAwesome',0),(835,'admin','2018-05-06 11:25:41','',NULL,'fa fa-hourglass-half','fa fa-hourglass-half','FontAwesome',0),(836,'admin','2018-05-06 11:25:41','',NULL,'fa fa-hourglass-start','fa fa-hourglass-start','FontAwesome',0),(837,'admin','2018-05-06 11:25:41','',NULL,'fa fa-i-cursor','fa fa-i-cursor','FontAwesome',0),(838,'admin','2018-05-06 11:25:41','',NULL,'fa fa-id-badge','fa fa-id-badge','FontAwesome',0),(839,'admin','2018-05-06 11:25:41','',NULL,'fa fa-id-card','fa fa-id-card','FontAwesome',0),(840,'admin','2018-05-06 11:25:41','',NULL,'fa fa-image','fa fa-image','FontAwesome',0),(841,'admin','2018-05-06 11:25:41','',NULL,'fa fa-images','fa fa-images','FontAwesome',0),(842,'admin','2018-05-06 11:25:41','',NULL,'fa fa-inbox','fa fa-inbox','FontAwesome',0),(843,'admin','2018-05-06 11:25:41','',NULL,'fa fa-indent','fa fa-indent','FontAwesome',0),(844,'admin','2018-05-06 11:25:41','',NULL,'fa fa-industry','fa fa-industry','FontAwesome',0),(845,'admin','2018-05-06 11:25:41','',NULL,'fa fa-info','fa fa-info','FontAwesome',0),(846,'admin','2018-05-06 11:25:41','',NULL,'fa fa-info-circle','fa fa-info-circle','FontAwesome',0),(847,'admin','2018-05-06 11:25:41','',NULL,'fa fa-italic','fa fa-italic','FontAwesome',0),(848,'admin','2018-05-06 11:25:41','',NULL,'fa fa-key','fa fa-key','FontAwesome',0),(849,'admin','2018-05-06 11:25:42','',NULL,'fa fa-keyboard','fa fa-keyboard','FontAwesome',0),(850,'admin','2018-05-06 11:25:42','',NULL,'fa fa-language','fa fa-language','FontAwesome',0),(851,'admin','2018-05-06 11:25:42','',NULL,'fa fa-laptop','fa fa-laptop','FontAwesome',0),(852,'admin','2018-05-06 11:25:42','',NULL,'fa fa-leaf','fa fa-leaf','FontAwesome',0),(853,'admin','2018-05-06 11:25:42','',NULL,'fa fa-lemon','fa fa-lemon','FontAwesome',0),(854,'admin','2018-05-06 11:25:42','',NULL,'fa fa-level-down-alt','fa fa-level-down-alt','FontAwesome',0),(855,'admin','2018-05-06 11:25:42','',NULL,'fa fa-level-up-alt','fa fa-level-up-alt','FontAwesome',0),(856,'admin','2018-05-06 11:25:42','',NULL,'fa fa-life-ring','fa fa-life-ring','FontAwesome',0),(857,'admin','2018-05-06 11:25:42','',NULL,'fa fa-lightbulb','fa fa-lightbulb','FontAwesome',0),(858,'admin','2018-05-06 11:25:42','',NULL,'fa fa-link','fa fa-link','FontAwesome',0),(859,'admin','2018-05-06 11:25:42','',NULL,'fa fa-lira-sign','fa fa-lira-sign','FontAwesome',0),(860,'admin','2018-05-06 11:25:42','',NULL,'fa fa-list','fa fa-list','FontAwesome',0),(861,'admin','2018-05-06 11:25:42','',NULL,'fa fa-list-alt','fa fa-list-alt','FontAwesome',0),(862,'admin','2018-05-06 11:25:42','',NULL,'fa fa-list-ol','fa fa-list-ol','FontAwesome',0),(863,'admin','2018-05-06 11:25:42','',NULL,'fa fa-list-ul','fa fa-list-ul','FontAwesome',0),(864,'admin','2018-05-06 11:25:42','',NULL,'fa fa-location-arrow','fa fa-location-arrow','FontAwesome',0),(865,'admin','2018-05-06 11:25:42','',NULL,'fa fa-lock','fa fa-lock','FontAwesome',0),(866,'admin','2018-05-06 11:25:42','',NULL,'fa fa-lock-open','fa fa-lock-open','FontAwesome',0),(867,'admin','2018-05-06 11:25:43','',NULL,'fa fa-long-arrow-alt-down','fa fa-long-arrow-alt-down','FontAwesome',0),(868,'admin','2018-05-06 11:25:43','',NULL,'fa fa-long-arrow-alt-left','fa fa-long-arrow-alt-left','FontAwesome',0),(869,'admin','2018-05-06 11:25:43','',NULL,'fa fa-long-arrow-alt-right','fa fa-long-arrow-alt-right','FontAwesome',0),(870,'admin','2018-05-06 11:25:43','',NULL,'fa fa-long-arrow-alt-up','fa fa-long-arrow-alt-up','FontAwesome',0),(871,'admin','2018-05-06 11:25:43','',NULL,'fa fa-low-vision','fa fa-low-vision','FontAwesome',0),(872,'admin','2018-05-06 11:25:43','',NULL,'fa fa-magic','fa fa-magic','FontAwesome',0),(873,'admin','2018-05-06 11:25:43','',NULL,'fa fa-magnet','fa fa-magnet','FontAwesome',0),(874,'admin','2018-05-06 11:25:43','',NULL,'fa fa-male','fa fa-male','FontAwesome',0),(875,'admin','2018-05-06 11:25:43','',NULL,'fa fa-map','fa fa-map','FontAwesome',0),(876,'admin','2018-05-06 11:25:43','',NULL,'fa fa-map-marker','fa fa-map-marker','FontAwesome',0),(877,'admin','2018-05-06 11:25:43','',NULL,'fa fa-map-marker-alt','fa fa-map-marker-alt','FontAwesome',0),(878,'admin','2018-05-06 11:25:43','',NULL,'fa fa-map-pin','fa fa-map-pin','FontAwesome',0),(879,'admin','2018-05-06 11:25:43','',NULL,'fa fa-map-signs','fa fa-map-signs','FontAwesome',0),(880,'admin','2018-05-06 11:25:43','',NULL,'fa fa-mars','fa fa-mars','FontAwesome',0),(881,'admin','2018-05-06 11:25:43','',NULL,'fa fa-mars-double','fa fa-mars-double','FontAwesome',0),(882,'admin','2018-05-06 11:25:43','',NULL,'fa fa-mars-stroke','fa fa-mars-stroke','FontAwesome',0),(883,'admin','2018-05-06 11:25:43','',NULL,'fa fa-mars-stroke-h','fa fa-mars-stroke-h','FontAwesome',0),(884,'admin','2018-05-06 11:25:43','',NULL,'fa fa-mars-stroke-v','fa fa-mars-stroke-v','FontAwesome',0),(885,'admin','2018-05-06 11:25:43','',NULL,'fa fa-medkit','fa fa-medkit','FontAwesome',0),(886,'admin','2018-05-06 11:25:43','',NULL,'fa fa-meh','fa fa-meh','FontAwesome',0),(887,'admin','2018-05-06 11:25:44','',NULL,'fa fa-mercury','fa fa-mercury','FontAwesome',0),(888,'admin','2018-05-06 11:25:44','',NULL,'fa fa-microchip','fa fa-microchip','FontAwesome',0),(889,'admin','2018-05-06 11:25:44','',NULL,'fa fa-microphone','fa fa-microphone','FontAwesome',0),(890,'admin','2018-05-06 11:25:44','',NULL,'fa fa-microphone-slash','fa fa-microphone-slash','FontAwesome',0),(891,'admin','2018-05-06 11:25:44','',NULL,'fa fa-minus','fa fa-minus','FontAwesome',0),(892,'admin','2018-05-06 11:25:44','',NULL,'fa fa-minus-circle','fa fa-minus-circle','FontAwesome',0),(893,'admin','2018-05-06 11:25:44','',NULL,'fa fa-minus-square','fa fa-minus-square','FontAwesome',0),(894,'admin','2018-05-06 11:25:44','',NULL,'fa fa-mobile','fa fa-mobile','FontAwesome',0),(895,'admin','2018-05-06 11:25:44','',NULL,'fa fa-mobile-alt','fa fa-mobile-alt','FontAwesome',0),(896,'admin','2018-05-06 11:25:44','',NULL,'fa fa-money-bill-alt','fa fa-money-bill-alt','FontAwesome',0),(897,'admin','2018-05-06 11:25:44','',NULL,'fa fa-moon','fa fa-moon','FontAwesome',0),(898,'admin','2018-05-06 11:25:44','',NULL,'fa fa-motorcycle','fa fa-motorcycle','FontAwesome',0),(899,'admin','2018-05-06 11:25:44','',NULL,'fa fa-mouse-pointer','fa fa-mouse-pointer','FontAwesome',0),(900,'admin','2018-05-06 11:25:44','',NULL,'fa fa-music','fa fa-music','FontAwesome',0),(901,'admin','2018-05-06 11:25:44','',NULL,'fa fa-neuter','fa fa-neuter','FontAwesome',0),(902,'admin','2018-05-06 11:25:45','',NULL,'fa fa-newspaper','fa fa-newspaper','FontAwesome',0),(903,'admin','2018-05-06 11:25:45','',NULL,'fa fa-object-group','fa fa-object-group','FontAwesome',0),(904,'admin','2018-05-06 11:25:45','',NULL,'fa fa-object-ungroup','fa fa-object-ungroup','FontAwesome',0),(905,'admin','2018-05-06 11:25:45','',NULL,'fa fa-outdent','fa fa-outdent','FontAwesome',0),(906,'admin','2018-05-06 11:25:45','',NULL,'fa fa-paint-brush','fa fa-paint-brush','FontAwesome',0),(907,'admin','2018-05-06 11:25:45','',NULL,'fa fa-pallet','fa fa-pallet','FontAwesome',0),(908,'admin','2018-05-06 11:25:45','',NULL,'fa fa-paper-plane','fa fa-paper-plane','FontAwesome',0),(909,'admin','2018-05-06 11:25:45','',NULL,'fa fa-paperclip','fa fa-paperclip','FontAwesome',0),(910,'admin','2018-05-06 11:25:45','',NULL,'fa fa-paragraph','fa fa-paragraph','FontAwesome',0),(911,'admin','2018-05-06 11:25:45','',NULL,'fa fa-paste','fa fa-paste','FontAwesome',0),(912,'admin','2018-05-06 11:25:46','',NULL,'fa fa-pause','fa fa-pause','FontAwesome',0),(913,'admin','2018-05-06 11:25:46','',NULL,'fa fa-pause-circle','fa fa-pause-circle','FontAwesome',0),(914,'admin','2018-05-06 11:25:46','',NULL,'fa fa-paw','fa fa-paw','FontAwesome',0),(915,'admin','2018-05-06 11:25:46','',NULL,'fa fa-pen-square','fa fa-pen-square','FontAwesome',0),(916,'admin','2018-05-06 11:25:46','',NULL,'fa fa-pencil-alt','fa fa-pencil-alt','FontAwesome',0),(929,'admin','2018-05-06 11:32:44','',NULL,'1','btnExcel','ModActions',0),(931,'','2018-05-06 16:54:40','',NULL,'2','View','ModActions',0),(935,'admin','2018-05-06 19:40:57','',NULL,'SysManager','admin','RoleUser',0),(936,'admin','2018-05-06 19:41:08','',NULL,'SysManager','kevin','RoleUser',0),(937,'admin','2018-05-06 19:42:36','',NULL,'SysManager','1','RoleProfile',0),(938,'admin','2018-05-06 19:42:49','',NULL,'SysManager','pauline','RoleUser',0),(943,'admin','2018-05-06 20:49:25','',NULL,'General','1','RoleProfile',0),(950,'admin','2018-05-11 10:39:56','',NULL,'TrinitAdmin','2','RoleProfile',0),(1008,'admin','2018-06-11 19:38:38','',NULL,'OpenLink','OpenLink','ButtonType',0),(1009,'admin','2018-06-11 19:38:54','',NULL,'ModalOpen','ModalOpen','ButtonType',0),(1034,'admin','2018-06-21 13:54:00','',NULL,'Teachers','1','RoleProfile',0),(1135,'admin','2019-05-15 04:58:03','',NULL,'appconfigs','appconfigs','SystemTables',0),(1137,'admin','2019-05-15 04:58:04','',NULL,'dbbackup','dbbackup','SystemTables',0),(1138,'admin','2019-05-15 04:58:04','',NULL,'dh_applications','dh_applications','SystemTables',0),(1139,'admin','2019-05-15 04:58:04','',NULL,'dh_columns','dh_columns','SystemTables',0),(1141,'admin','2019-05-15 04:58:04','',NULL,'dh_listquery','dh_listquery','SystemTables',0),(1144,'admin','2019-05-15 04:58:04','',NULL,'dh_processinstances','dh_processinstances','SystemTables',0),(1145,'admin','2019-05-15 04:58:04','',NULL,'dh_profilepermissions','dh_profilepermissions','SystemTables',0),(1146,'admin','2019-05-15 04:58:04','',NULL,'dh_tmpfiles','dh_tmpfiles','SystemTables',0),(1147,'admin','2019-05-15 04:58:04','',NULL,'dh_usergroups','dh_usergroups','SystemTables',0),(1150,'admin','2019-05-15 04:58:04','',NULL,'dh_workflowactions','dh_workflowactions','SystemTables',0),(1151,'admin','2019-05-15 04:58:04','',NULL,'dh_workflows','dh_workflows','SystemTables',0),(1152,'admin','2019-05-15 04:58:04','',NULL,'dhalerts','dhalerts','SystemTables',0),(1153,'admin','2019-05-15 04:58:04','',NULL,'dhcomments','dhcomments','SystemTables',0),(1154,'admin','2019-05-15 04:58:04','',NULL,'elementstorage','elementstorage','SystemTables',0),(1155,'admin','2019-05-15 04:58:04','',NULL,'fileaccesslog','fileaccesslog','SystemTables',0),(1156,'admin','2019-05-15 04:58:04','',NULL,'filetypes','filetypes','SystemTables',0),(1158,'admin','2019-05-15 04:58:04','',NULL,'menuactions','menuactions','SystemTables',0),(1160,'admin','2019-05-15 04:58:05','',NULL,'dh_templateprefix','dh_templateprefix','SystemTables',0),(1161,'','2019-05-15 05:19:23','',NULL,'1','View','ModActions',0),(1162,'','2019-05-15 05:20:26','',NULL,'2','View','ModActions',0),(1163,'','2019-05-15 05:23:00','',NULL,'3','View','ModActions',0),(1165,'','2019-05-15 05:24:43','',NULL,'5','View','ModActions',0),(1225,'admin','2019-05-21 10:12:45','',NULL,'listitems','listitems','SystemTables',0),(1226,'admin','2019-05-21 10:13:07','',NULL,'adodb_logsql','adodb_logsql','SystemTables',0),(1229,'','2019-05-21 12:11:08','',NULL,'1','View','ModActions',0),(1230,'','2019-05-21 12:55:22','',NULL,'2','View','ModActions',0),(1231,'','2019-05-21 12:57:30','',NULL,'3','View','ModActions',0),(1233,'','2019-05-21 13:01:29','',NULL,'5','View','ModActions',0),(1234,'','2019-05-21 13:03:18','',NULL,'6','View','ModActions',0),(1235,'','2019-05-21 13:05:10','',NULL,'7','View','ModActions',0),(1236,'admin','2019-05-21 13:06:09','',NULL,'dh_userprofiles','dh_userprofiles','SystemTables',0),(1237,'admin','2019-05-21 13:06:26','',NULL,'syslogin','syslogin','SystemTables',0),(1238,'admin','2019-05-21 13:06:34','',NULL,'vw_dhrolegroups','vw_dhrolegroups','SystemTables',0),(1239,'admin','2019-05-21 13:06:48','',NULL,'vw_fileaccesslog','vw_fileaccesslog','SystemTables',0),(1240,'admin','2019-05-21 13:07:02','',NULL,'vw_modsearchflds','vw_modsearchflds','SystemTables',0),(1241,'admin','2019-05-21 13:07:12','',NULL,'vw_profilepermissions','vw_profilepermissions','SystemTables',0),(1242,'admin','2019-05-21 13:07:21','',NULL,'vw_userslist','vw_userslist','SystemTables',0),(1243,'admin','2019-05-21 13:07:33','',NULL,'vw_roleprofiles','vw_roleprofiles','SystemTables',0),(1244,'admin','2019-05-21 13:07:43','',NULL,'vw_usergroups','vw_usergroups','SystemTables',0),(1247,'admin','2019-05-30 11:14:19','',NULL,'dh_listview','dh_listview','SystemTables',0),(1249,'admin','2019-05-30 11:50:28','',NULL,'audit_trail','audit_trail','SystemTables',0),(1250,'admin','2019-05-30 13:43:36','',NULL,'dh_modules','dh_modules','SystemTables',0),(1252,'','2019-06-19 13:15:32','',NULL,'9','View','ModActions',0),(1268,'admin','2019-06-19 19:31:39','',NULL,'Hansard','2','RoleProfile',0),(1269,'admin','2019-06-19 19:37:02','',NULL,'Hansard','1','RoleProfile',0),(1364,'','2019-07-04 15:31:49','',NULL,'23','View','ModActions',0),(1373,'admin','2019-07-07 20:25:05','',NULL,'Monday','Monday','WeekDays',0),(1374,'admin','2019-07-07 20:25:17','',NULL,'Tuesday','Tuesday','WeekDays',0),(1375,'admin','2019-07-07 20:25:33','',NULL,'Wednesday','Wednesday','WeekDays',0),(1376,'admin','2019-07-07 20:25:46','',NULL,'Thursday','Thursday','WeekDays',0),(1377,'admin','2019-07-07 20:25:54','',NULL,'Friday','Friday','WeekDays',0),(1378,'admin','2019-07-07 20:26:09','',NULL,'Saturday','Saturday','WeekDays',0),(1379,'admin','2019-07-07 20:26:17','',NULL,'Sunday','Sunday','WeekDays',0),(1409,'admin','2019-07-16 13:08:53','',NULL,'SysManager','njuguna','RoleUser',0),(1438,'admin','2019-08-14 09:42:25',NULL,NULL,'Accounts','3','RoleProfile',NULL),(1439,NULL,'2019-09-05 11:05:30',NULL,NULL,'29','View','ModActions',NULL),(1445,NULL,'2019-11-07 08:08:38',NULL,NULL,'34','View','ModActions',NULL),(1446,NULL,'2019-11-07 09:21:34',NULL,NULL,'35','View','ModActions',NULL),(1449,'admin','2019-11-07 09:40:43',NULL,NULL,'Individuals','Individuals','SendChannel',NULL),(1453,'admin','2019-11-07 10:02:40',NULL,NULL,'SendNow','Send Now','SendFrequency',NULL),(1454,'admin','2019-11-07 10:03:19',NULL,NULL,'Composed','Composed','MessageType',NULL),(1455,'admin','2019-11-07 10:03:25',NULL,NULL,'SMSTemplates','SMS Templates','MessageType',NULL),(1457,'admin','2019-11-07 10:03:52',NULL,NULL,'ScheduleMessage','Schedule Message','SendFrequency',NULL),(1458,'admin','2019-11-07 10:53:39',NULL,NULL,'UserGroups','UserGroups','SendChannel',NULL),(1464,'admin','2019-11-09 08:07:57',NULL,NULL,'Clerks','4','RoleProfile',NULL),(1470,'admin','2019-11-09 08:24:40',NULL,NULL,'Sergeants','5','RoleProfile',NULL),(1481,'admin','2019-11-09 09:15:14',NULL,NULL,'Clerks','3','RoleProfile',NULL),(1484,NULL,'2019-12-05 11:01:46',NULL,NULL,'36','View','ModActions',NULL),(1485,NULL,'2020-01-23 11:49:12',NULL,NULL,'37','View','ModActions',NULL),(1488,'admin','2020-03-03 12:09:42',NULL,NULL,'General','General','NotificationType',NULL),(1497,'admin','2020-04-25 13:20:25',NULL,NULL,'InApplication','InApplication','ListingType',NULL),(1498,'admin','2020-04-25 13:20:46',NULL,NULL,'StandAlone','StandAlone','ListingType',NULL),(1502,NULL,'2020-04-25 13:41:33',NULL,NULL,'40','View','ModActions',NULL),(1504,'admin','2020-04-27 20:05:24',NULL,NULL,'SaccoAuditor','7','RoleProfile',NULL),(1505,'admin','2020-04-27 20:05:39',NULL,NULL,'SaccoAdmin','6','RoleProfile',NULL),(1531,'admin','2020-04-29 10:55:04',NULL,NULL,'OpenPage','OpenPage','CreateBtnType',NULL),(1532,'admin','2020-04-29 10:55:13',NULL,NULL,'OpenModal','OpenModal','CreateBtnType',NULL),(1549,'admin','2020-09-03 12:00:46',NULL,NULL,'Supplier','8','RoleProfile',NULL),(1550,'admin','2020-09-03 12:00:58',NULL,NULL,'Supplier','admin','RoleUser',NULL),(1551,'admin','2020-09-03 12:00:58',NULL,NULL,'Supplier','kevin','RoleUser',NULL),(1575,'admin','2021-03-23 10:45:43',NULL,NULL,'SysManager','8','RoleProfile',NULL),(1602,'admin','2021-03-27 11:47:47',NULL,NULL,'Deacons','9','RoleProfile',NULL),(1603,'admin','2021-03-27 11:47:59',NULL,NULL,'Deacons','allan','RoleUser',NULL),(1604,'admin','2021-03-27 11:47:59',NULL,NULL,'Deacons','jane','RoleUser',NULL),(1605,'admin','2021-03-27 11:47:59',NULL,NULL,'Deacons','walter','RoleUser',NULL),(1607,NULL,'2021-06-17 08:22:34',NULL,NULL,'MpesaAPI','MpesaAPI','ConfigurationType',NULL),(1608,NULL,'2021-06-17 08:22:34',NULL,NULL,'SMSAPI','SMSAPI','ConfigurationType',NULL),(1609,NULL,'2021-06-17 08:22:34',NULL,NULL,'AssetPath','AssetPath','ConfigurationType',NULL),(1610,NULL,'2021-06-17 08:22:34',NULL,NULL,'Mail','Mail','ConfigurationType',NULL),(1611,NULL,'2021-06-17 08:22:34',NULL,NULL,'CompanyInfo','CompanyInfo','ConfigurationType',NULL),(1612,NULL,'2021-06-17 08:22:34',NULL,NULL,'UserSetting','UserSetting','ConfigurationType',NULL),(1614,'admin','2021-06-17 09:22:18',NULL,NULL,'text','text','AttribType',NULL),(1615,'admin','2021-06-17 09:22:24',NULL,NULL,'number','number','AttribType',NULL),(1616,'admin','2021-06-17 09:22:34',NULL,NULL,'password','password','AttribType',NULL),(1617,'admin','2021-06-17 09:22:42',NULL,NULL,'date','date','AttribType',NULL),(1618,'admin','2021-06-17 09:23:22',NULL,NULL,'True','True','AttribRequired',NULL),(1619,'admin','2021-06-17 09:23:28',NULL,NULL,'False','False','AttribRequired',NULL),(1631,NULL,'2021-07-08 19:17:26',NULL,NULL,'60','View','ModActions',NULL),(1632,'admin','2021-07-09 06:40:36',NULL,NULL,'HeadofSections','10','RoleProfile',NULL),(1633,'admin','2021-07-09 06:40:52',NULL,NULL,'HeadofSections','admin','RoleUser',NULL),(1634,NULL,'2021-07-15 08:02:48',NULL,NULL,'61','View','ModActions',NULL),(1635,NULL,'2021-07-15 08:04:00',NULL,NULL,'62','View','ModActions',NULL),(1636,'admin','2021-08-13 09:59:19',NULL,NULL,'SectionTeamPlayer','SectionTeamPlayer','usertype',NULL),(1637,'admin','2021-08-13 09:59:31',NULL,NULL,'HeadofSections','HeadofSections','usertype',NULL),(1638,'admin','2021-08-13 09:59:41',NULL,NULL,'HeadofDepartments','HeadofDepartments','usertype',NULL),(1639,'admin','2021-08-13 09:59:54',NULL,NULL,'Directorate','Directorate','usertype',NULL),(1640,'admin','2021-09-09 09:05:42',NULL,NULL,'Permanent','Permanent','TermsofService',NULL),(1641,'admin','2021-09-09 09:05:52',NULL,NULL,'Contract','Contract','TermsofService',NULL);
/*!40000 ALTER TABLE `listitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuactions`
--

DROP TABLE IF EXISTS `menuactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menuactions` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `IconPosition` varchar(255) DEFAULT 'Prefix',
  `DisplayOrder` int DEFAULT NULL,
  `ParentMenu` varchar(255) DEFAULT NULL,
  `MenuType` varchar(255) DEFAULT NULL,
  `ActionName` varchar(255) NOT NULL DEFAULT '',
  `ActionClass` varchar(255) DEFAULT NULL,
  `ActionAttributes` varchar(255) DEFAULT NULL,
  `ActionToolTip` varchar(255) DEFAULT NULL,
  `DisplayName` varchar(255) DEFAULT NULL,
  `ActionIconRef` varchar(255) DEFAULT NULL,
  `MenuDescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ActionName`),
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuactions`
--

LOCK TABLES `menuactions` WRITE;
/*!40000 ALTER TABLE `menuactions` DISABLE KEYS */;
INSERT INTO `menuactions` VALUES (1,'admin','2018-05-06 11:26:10','',NULL,'Prefix',2,'btnHeldFilesAO','MenuItem','btnBringUp','','','','Bring-up','fa fa-reply','Bring-up'),(2,'admin','2018-05-06 11:26:10','',NULL,'Prefix',1,'','IconButton','btnDelete','','','Delete Record','Delete','fa fa-trash','Delete Record'),(3,'admin','2018-05-06 11:26:10','',NULL,'Prefix',2,'','IconButton','btnDownloadDocument','','','Download Document','','fa fa-download','Download Document'),(4,'admin','2018-05-06 11:26:10','',NULL,'Prefix',1,'','IconButton','btnEditDescription','','','Edit Document Description','','fa fa-edit','Edit Document Description'),(5,'admin','2018-05-06 11:26:10','admin',NULL,'Prefix',0,'','IconButton','btnExcel','btn btn-info','','Export to Excel','Export to Excel','fa fa-file-excel-o','Export to Excel'),(6,'admin','2018-05-06 11:26:10','',NULL,'Prefix',3,'btnHeldFilesAO','MenuItem','btnForward','','','','Forward','fa fa-forward','Forward to Action Officer'),(7,'admin','2018-05-06 11:26:10','',NULL,'Prefix',1,'','Pop-Up','btnHeldFilesAO','','','','Show Actions','fa fa-caret','Held Files AO'),(8,'admin','2018-05-06 11:26:10','',NULL,'Prefix',0,'','ButtonDropDown','btnMailFilingAction','','','','Mail Filing','fa fa-file','File Mails'),(9,'admin','2018-05-06 11:26:10','admin',NULL,'Prefix',7,'','IconButton','btnPdfExport','btn btn-info','','Export to PDF','Export to PDF','fa fa-file-pdf-o','Export PDF'),(10,'admin','2018-05-06 11:26:11','',NULL,'Prefix',0,'','ButtonDropDown','btnReceiveMail','','','Show Action','Actions','fa fa-caret-down','Mail Receive Actions'),(11,'admin','2018-05-06 11:26:11','',NULL,'Prefix',8,'btnHeldFilesAO','MenuItem','btnReturntoRMU','','','','Return to RMU','fa fa-reply','Return File to RMU'),(12,'admin','2018-05-06 11:26:11','admin',NULL,'Prefix',0,'','FormButton','btnSaveRecord','btn btn-success','','','Save Record','fa fa-save','Create'),(13,'admin','2018-05-06 11:26:11','',NULL,'Prefix',2,'btnReceiveMail','MenuItem','btnsendforFiling','','','','Send for Filing','fa fa-send','Send for Filing'),(14,'admin','2018-05-06 11:26:11','admin',NULL,'Prefix',1,'btnReceiveMail','MenuItem','btnSendtoMO','','','','Send to Marking Officer','fa fa-users','Send to Marking Officer'),(15,'admin','2018-05-06 11:26:11','admin',NULL,'Prefix',0,'','FormButton','btnUpdateRecord','btn btn-success','','','Update Record','fa fa-edit','Update Record'),(16,'admin','2018-05-06 11:26:11','',NULL,'Prefix',1,'btnHeldFilesAO','MenuItem','btnViewFile','','','','View File','fa fa-eye','View File AO'),(17,'admin','2018-05-06 11:26:11','',NULL,'Prefix',1,'','IconButton','View','','','View Template','View','fa fa-eye','View');
/*!40000 ALTER TABLE `menuactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificationlist`
--

DROP TABLE IF EXISTS `notificationlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notificationlist` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` datetime DEFAULT NULL,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL,
  `NTargetedTo` int DEFAULT NULL,
  `NStatus` varchar(255) DEFAULT 'Pending',
  `NotificationID` int DEFAULT NULL,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificationlist`
--

LOCK TABLES `notificationlist` WRITE;
/*!40000 ALTER TABLE `notificationlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificationlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `NType` varchar(255) DEFAULT NULL,
  `NBody` longtext,
  `MeetingID` int DEFAULT NULL,
  `CommitteeID` int DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `syslogin`
--

DROP TABLE IF EXISTS `syslogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `syslogin` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `logged_user` varchar(255) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_time` datetime DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `LoginType` varchar(255) DEFAULT 'Default',
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `syslogin`
--

LOCK TABLES `syslogin` WRITE;
/*!40000 ALTER TABLE `syslogin` DISABLE KEYS */;
INSERT INTO `syslogin` VALUES (1,'admin','2021-06-28 08:53:36',NULL,'f35dd1b799cadad9ab25738cfc325a38','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36','Default'),(2,'admin','2021-06-28 09:51:03',NULL,'f35dd1b799cadad9ab25738cfc325a38','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36','Default'),(3,'admin','2021-07-08 07:23:46',NULL,'c918fe9a7963994a9e2b327f819f0a53','10.0.0.2','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36','Default'),(4,'admin','2021-07-08 09:45:12',NULL,'c918fe9a7963994a9e2b327f819f0a53','10.0.0.2','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36','Default'),(5,'admin','2021-07-08 10:57:49',NULL,'c918fe9a7963994a9e2b327f819f0a53','10.0.0.2','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36','Default'),(6,'admin','2021-07-08 12:27:17',NULL,'c918fe9a7963994a9e2b327f819f0a53','10.0.0.2','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36','Default'),(7,'admin','2021-07-08 19:08:04',NULL,'c918fe9a7963994a9e2b327f819f0a53','10.0.0.2','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36','Default'),(8,'admin','2021-07-09 06:38:04',NULL,'6c94b9ff95f80d2013661722bacf30ef','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:89.0) Gecko/20100101 Firefox/89.0','Default'),(9,'admin','2021-07-15 07:55:06',NULL,'c918fe9a7963994a9e2b327f819f0a53','10.0.0.2','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36','Default'),(10,'admin','2021-08-09 10:45:23',NULL,'e52be1734b9163c9044158e2c0c4087d','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:90.0) Gecko/20100101 Firefox/90.0','Default'),(11,'admin','2021-08-12 14:36:23',NULL,'0018ef830d6d2bc60844878432e85c67','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0','Default'),(12,'admin','2021-08-13 09:28:28','2021-08-13 13:23:52','6128b4a17fc36b405f4ead75bc3d8854','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0','Default'),(13,'admin','2021-08-13 09:51:47','2021-08-13 13:23:52','6128b4a17fc36b405f4ead75bc3d8854','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0','Default'),(14,'admin','2021-08-13 10:24:00',NULL,'6128b4a17fc36b405f4ead75bc3d8854','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0','Default'),(15,'admin','2021-08-19 08:33:04',NULL,'2b8eb6bac20bdfcf15132b4f7c23992b','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0','Default'),(16,'admin','2021-08-26 09:08:05',NULL,'8070b04d4c6c90d92b5d80140c3881e6','127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0','Default'),(17,'admin','2021-08-31 10:37:04',NULL,'0f99c3785e1645b5f47bc1650fe06530','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36','Default'),(18,'admin','2021-09-07 09:28:57',NULL,'99517082dd5028e36763b47cc09e9322','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36','Default'),(19,'admin','2021-09-09 08:09:11',NULL,'5c80b5cc652103c0b8291dc1f9a803f2','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36','Default'),(20,'admin','2021-09-09 08:41:49',NULL,'5c80b5cc652103c0b8291dc1f9a803f2','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36','Default'),(21,'admin','2021-09-09 10:36:16',NULL,'5c80b5cc652103c0b8291dc1f9a803f2','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36','Default'),(22,'admin','2021-09-09 11:51:55',NULL,'5c80b5cc652103c0b8291dc1f9a803f2','::1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.63 Safari/537.36','Default');
/*!40000 ALTER TABLE `syslogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_bulksms`
--

DROP TABLE IF EXISTS `tbl_bulksms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_bulksms` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `MessageID` varchar(255) DEFAULT NULL,
  `SMSFrom` varchar(255) DEFAULT NULL,
  `SMSTo` varchar(255) DEFAULT NULL,
  `Message` longtext,
  `MessageParts` int DEFAULT NULL,
  `CharaterCount` int DEFAULT NULL,
  `SMSCost` decimal(10,2) DEFAULT NULL,
  `SMSStatus` varchar(255) NOT NULL DEFAULT 'Pending',
  `ReceiptID` varchar(255) DEFAULT NULL,
  `StatusCode` int DEFAULT NULL,
  `SendChannel` varchar(255) DEFAULT NULL,
  `GroupCode` varchar(255) DEFAULT NULL,
  `ParentMsgID` int DEFAULT NULL,
  `ScheduledDate` datetime DEFAULT NULL,
  `SendFrequency` varchar(255) DEFAULT NULL,
  `ReceiptientName` varchar(255) DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_bulksms`
--

LOCK TABLES `tbl_bulksms` WRITE;
/*!40000 ALTER TABLE `tbl_bulksms` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_bulksms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_departments`
--

DROP TABLE IF EXISTS `tbl_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_departments` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `DepartmentCode` varchar(255) DEFAULT NULL,
  `DepartmentName` varchar(255) DEFAULT NULL,
  `DirectorateID` int DEFAULT NULL,
  `HeadedBy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_departments`
--

LOCK TABLES `tbl_departments` WRITE;
/*!40000 ALTER TABLE `tbl_departments` DISABLE KEYS */;
INSERT INTO `tbl_departments` VALUES (2,'admin','2021-07-13 09:54:04','admin','2021-07-13 09:54:13','SAA','SAA',6,NULL),(3,'admin','2021-07-13 09:54:44',NULL,NULL,'CommS','Committee Services',6,NULL),(4,'admin','2021-07-13 09:55:40',NULL,NULL,'LPS','Legislative &amp; Proc Services',6,NULL),(5,'admin','2021-07-13 09:55:52',NULL,NULL,'LS','Legal Services',6,NULL),(6,'admin','2021-07-13 09:56:21','admin','2021-09-09 12:40:47','HR','Human Resource',2,'20160025543'),(7,'admin','2021-07-13 09:56:31',NULL,NULL,'Admin','Admin',2,NULL),(8,'admin','2021-07-13 09:56:46','admin','2021-07-13 09:57:00','Hansard','Hansard',5,NULL),(9,'admin','2021-07-13 09:57:45',NULL,NULL,'IRS','Information &amp; Research Services',5,NULL),(10,'admin','2021-07-13 09:58:05','admin','2021-09-09 12:40:37','Budget','Budget',3,'20160025543'),(11,'admin','2021-07-13 09:58:23',NULL,NULL,'Procurement','Procurement',3,NULL),(12,'admin','2021-07-13 09:58:35',NULL,NULL,'Acc','Accounts',3,NULL),(13,'admin','2021-07-13 09:58:52','admin','2021-07-13 09:59:15','IA','Internal Audit',4,NULL);
/*!40000 ALTER TABLE `tbl_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_directorates`
--

DROP TABLE IF EXISTS `tbl_directorates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_directorates` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `DirectorateCode` varchar(255) DEFAULT NULL,
  `DirectorateName` varchar(255) DEFAULT NULL,
  `HeadedBy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_directorates`
--

LOCK TABLES `tbl_directorates` WRITE;
/*!40000 ALTER TABLE `tbl_directorates` DISABLE KEYS */;
INSERT INTO `tbl_directorates` VALUES (2,'admin','2021-07-08 17:18:27',NULL,NULL,'HRM','HRM and Admin',NULL),(3,'admin','2021-07-08 17:18:48',NULL,NULL,'Fin','Financial Services',NULL),(4,'admin','2021-07-08 17:19:37','admin','2021-09-09 12:22:32','OFS','Office of the Speaker','20160025552'),(5,'admin','2021-07-08 17:20:17',NULL,NULL,'HRI','Hansard,Research and Information',NULL),(6,'admin','2021-07-08 17:21:18',NULL,NULL,'LP','Legislative and Procedural / Committee Services',NULL);
/*!40000 ALTER TABLE `tbl_directorates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_messageout`
--

DROP TABLE IF EXISTS `tbl_messageout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_messageout` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `SendChannel` varchar(255) DEFAULT NULL,
  `MessageType` varchar(255) DEFAULT NULL,
  `MessageBody` longtext,
  `SendFrequency` varchar(255) DEFAULT NULL,
  `SendDate` date DEFAULT NULL,
  `SendTime` time DEFAULT NULL,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_messageout`
--

LOCK TABLES `tbl_messageout` WRITE;
/*!40000 ALTER TABLE `tbl_messageout` DISABLE KEYS */;
INSERT INTO `tbl_messageout` VALUES (1,'admin','2020-09-08 11:27:11',NULL,NULL,'UserGroups','Composed','ddjjd','ScheduleMessage','2020-09-15','14:30:00');
/*!40000 ALTER TABLE `tbl_messageout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section1`
--

DROP TABLE IF EXISTS `tbl_section1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section1` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `StaffName` varchar(255) DEFAULT NULL,
  `PFNO` varchar(255) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Section` varchar(255) DEFAULT NULL,
  `Designation` varchar(255) DEFAULT NULL,
  `TermofService` varchar(255) DEFAULT NULL,
  `Scale` varchar(255) DEFAULT NULL,
  `WithEffectDate` date DEFAULT NULL,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section1`
--

LOCK TABLES `tbl_section1` WRITE;
/*!40000 ALTER TABLE `tbl_section1` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section10`
--

DROP TABLE IF EXISTS `tbl_section10`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section10` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section10`
--

LOCK TABLES `tbl_section10` WRITE;
/*!40000 ALTER TABLE `tbl_section10` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section10` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section2`
--

DROP TABLE IF EXISTS `tbl_section2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section2` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section2`
--

LOCK TABLES `tbl_section2` WRITE;
/*!40000 ALTER TABLE `tbl_section2` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section3`
--

DROP TABLE IF EXISTS `tbl_section3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section3` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section3`
--

LOCK TABLES `tbl_section3` WRITE;
/*!40000 ALTER TABLE `tbl_section3` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section5a`
--

DROP TABLE IF EXISTS `tbl_section5a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section5a` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section5a`
--

LOCK TABLES `tbl_section5a` WRITE;
/*!40000 ALTER TABLE `tbl_section5a` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section5a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section5b`
--

DROP TABLE IF EXISTS `tbl_section5b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section5b` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section5b`
--

LOCK TABLES `tbl_section5b` WRITE;
/*!40000 ALTER TABLE `tbl_section5b` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section5b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section6a`
--

DROP TABLE IF EXISTS `tbl_section6a`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section6a` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section6a`
--

LOCK TABLES `tbl_section6a` WRITE;
/*!40000 ALTER TABLE `tbl_section6a` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section6a` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section6b`
--

DROP TABLE IF EXISTS `tbl_section6b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section6b` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section6b`
--

LOCK TABLES `tbl_section6b` WRITE;
/*!40000 ALTER TABLE `tbl_section6b` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section6b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section8`
--

DROP TABLE IF EXISTS `tbl_section8`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section8` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section8`
--

LOCK TABLES `tbl_section8` WRITE;
/*!40000 ALTER TABLE `tbl_section8` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section8` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_section9`
--

DROP TABLE IF EXISTS `tbl_section9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_section9` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_section9`
--

LOCK TABLES `tbl_section9` WRITE;
/*!40000 ALTER TABLE `tbl_section9` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_section9` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sections`
--

DROP TABLE IF EXISTS `tbl_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_sections` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT 'ADMIN',
  `DateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `SectionName` varchar(255) DEFAULT NULL,
  `SectionCode` varchar(255) DEFAULT NULL,
  `HeadofSection` varchar(255) DEFAULT NULL,
  `DepartmentID` int DEFAULT NULL,
  `HeadedBy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`S_ROWID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sections`
--

LOCK TABLES `tbl_sections` WRITE;
/*!40000 ALTER TABLE `tbl_sections` DISABLE KEYS */;
INSERT INTO `tbl_sections` VALUES (2,'admin','2021-07-13 10:12:54',NULL,NULL,'Payroll','Payroll',NULL,6,NULL),(3,'admin','2021-07-13 10:13:43',NULL,NULL,'Records','Records',NULL,6,NULL),(4,'admin','2021-07-13 10:13:58',NULL,NULL,'Transport','Transport',NULL,7,NULL),(5,'admin','2021-07-13 10:14:31','admin','2021-09-09 12:41:40','Project &amp; Maintenance','PM',NULL,7,'20170026712'),(6,'admin','2021-07-13 10:14:57',NULL,NULL,'Secretarial Services','SS',NULL,7,NULL),(7,'admin','2021-07-13 10:15:18',NULL,NULL,'Research','Research',NULL,9,NULL),(8,'admin','2021-07-13 10:15:52',NULL,NULL,'Library','Library',NULL,9,NULL),(9,'admin','2021-07-13 10:16:09',NULL,NULL,'ICT','ICT',NULL,9,NULL),(10,'admin','2021-07-13 10:16:42',NULL,NULL,'PR &amp; Communication','PRComm',NULL,9,NULL);
/*!40000 ALTER TABLE `tbl_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_smstemplates`
--

DROP TABLE IF EXISTS `tbl_smstemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_smstemplates` (
  `S_ROWID` int NOT NULL AUTO_INCREMENT,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(255) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  `TemplateName` varchar(255) DEFAULT NULL,
  `TemplateBody` longtext,
  UNIQUE KEY `S_ROWID` (`S_ROWID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_smstemplates`
--

LOCK TABLES `tbl_smstemplates` WRITE;
/*!40000 ALTER TABLE `tbl_smstemplates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_smstemplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_departments`
--

DROP TABLE IF EXISTS `vw_departments`;
/*!50001 DROP VIEW IF EXISTS `vw_departments`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_departments` AS SELECT 
 1 AS `S_ROWID`,
 1 AS `CreatedBy`,
 1 AS `DateCreated`,
 1 AS `ModifiedBy`,
 1 AS `DateModified`,
 1 AS `DepartmentCode`,
 1 AS `DepartmentName`,
 1 AS `DirectorateID`,
 1 AS `DirectorateCode`,
 1 AS `DirectorateName`,
 1 AS `HeadedBy`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_dhrolegroups`
--

DROP TABLE IF EXISTS `vw_dhrolegroups`;
/*!50001 DROP VIEW IF EXISTS `vw_dhrolegroups`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_dhrolegroups` AS SELECT 
 1 AS `S_ROWID`,
 1 AS `CreatedBy`,
 1 AS `DateCreated`,
 1 AS `ModifiedBy`,
 1 AS `DateModified`,
 1 AS `GroupName`,
 1 AS `GroupCode`,
 1 AS `GroupDescription`,
 1 AS `GroupUsers`,
 1 AS `Fullname`,
 1 AS `UsersCount`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_fileaccesslog`
--

DROP TABLE IF EXISTS `vw_fileaccesslog`;
/*!50001 DROP VIEW IF EXISTS `vw_fileaccesslog`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_fileaccesslog` AS SELECT 
 1 AS `S_ROWID`,
 1 AS `DateAccessed`,
 1 AS `TimeAccessed`,
 1 AS `Fullname`,
 1 AS `DocID`,
 1 AS `StoragePool`,
 1 AS `DocDescription`,
 1 AS `AccessAgent`,
 1 AS `AccessIP`,
 1 AS `SessionID`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_messageout`
--

DROP TABLE IF EXISTS `vw_messageout`;
/*!50001 DROP VIEW IF EXISTS `vw_messageout`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_messageout` AS SELECT 
 1 AS `S_ROWID`,
 1 AS `CreatedBy`,
 1 AS `DateCreated`,
 1 AS `ModifiedBy`,
 1 AS `DateModified`,
 1 AS `SendChannel`,
 1 AS `MessageType`,
 1 AS `MessageBody`,
 1 AS `SendFrequency`,
 1 AS `SendDate`,
 1 AS `SendTime`,
 1 AS `RecptCount`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_modsearchflds`
--

DROP TABLE IF EXISTS `vw_modsearchflds`;
/*!50001 DROP VIEW IF EXISTS `vw_modsearchflds`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_modsearchflds` AS SELECT 
 1 AS `S_ROWID`,
 1 AS `CreatedBy`,
 1 AS `DateCreated`,
 1 AS `ModCode`,
 1 AS `FieldName`,
 1 AS `ModuleCode`,
 1 AS `TableName`,
 1 AS `ParentTable`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_profilepermissions`
--

DROP TABLE IF EXISTS `vw_profilepermissions`;
/*!50001 DROP VIEW IF EXISTS `vw_profilepermissions`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_profilepermissions` AS SELECT 
 1 AS `ProfileID`,
 1 AS `ModCode`,
 1 AS `ModOperation`,
 1 AS `IsAllowed`,
 1 AS `ModuleCode`,
 1 AS `ModuleName`,
 1 AS `ModIcon`,
 1 AS `ModDisplayOrder`,
 1 AS `AppS_ROWID`,
 1 AS `ApplicationName`,
 1 AS `AppIcon`,
 1 AS `AppDisplayOrder`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_roleprofiles`
--

DROP TABLE IF EXISTS `vw_roleprofiles`;
/*!50001 DROP VIEW IF EXISTS `vw_roleprofiles`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_roleprofiles` AS SELECT 
 1 AS `S_ROWID`,
 1 AS `CreatedBy`,
 1 AS `DateCreated`,
 1 AS `ProfileName`,
 1 AS `ProfileDescription`,
 1 AS `ItemDescription`,
 1 AS `ItemCode`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_sections`
--

DROP TABLE IF EXISTS `vw_sections`;
/*!50001 DROP VIEW IF EXISTS `vw_sections`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_sections` AS SELECT 
 1 AS `S_ROWID`,
 1 AS `CreatedBy`,
 1 AS `DateCreated`,
 1 AS `ModifiedBy`,
 1 AS `DateModified`,
 1 AS `SectionName`,
 1 AS `SectionCode`,
 1 AS `HeadofSection`,
 1 AS `DepartmentID`,
 1 AS `DepartmentName`,
 1 AS `DirectorateName`,
 1 AS `HeadedBy`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_usergroups`
--

DROP TABLE IF EXISTS `vw_usergroups`;
/*!50001 DROP VIEW IF EXISTS `vw_usergroups`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_usergroups` AS SELECT 
 1 AS `S_ROWID`,
 1 AS `UserGroup`,
 1 AS `loginid`,
 1 AS `Fullname`,
 1 AS `Phone`,
 1 AS `UserStatus`,
 1 AS `user_type`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_userslist`
--

DROP TABLE IF EXISTS `vw_userslist`;
/*!50001 DROP VIEW IF EXISTS `vw_userslist`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_userslist` AS SELECT 
 1 AS `S_ROWID`,
 1 AS `loginid`,
 1 AS `Fullname`,
 1 AS `Phone`,
 1 AS `Email`,
 1 AS `Position`,
 1 AS `PhoneExt`,
 1 AS `pswd`,
 1 AS `user_type`,
 1 AS `CreatedBy`,
 1 AS `DateCreated`,
 1 AS `shift`,
 1 AS `Department`,
 1 AS `Section`,
 1 AS `ProfileImage`,
 1 AS `userstatus`,
 1 AS `DeActivatedBy`,
 1 AS `DateDeActivated`,
 1 AS `DeActivateReason`,
 1 AS `ModifiedBy`,
 1 AS `DateModified`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_departments`
--

/*!50001 DROP VIEW IF EXISTS `vw_departments`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_departments` AS select `dp`.`S_ROWID` AS `S_ROWID`,`dp`.`CreatedBy` AS `CreatedBy`,`dp`.`DateCreated` AS `DateCreated`,`dp`.`ModifiedBy` AS `ModifiedBy`,`dp`.`DateModified` AS `DateModified`,`dp`.`DepartmentCode` AS `DepartmentCode`,`dp`.`DepartmentName` AS `DepartmentName`,`dp`.`DirectorateID` AS `DirectorateID`,`dd`.`DirectorateCode` AS `DirectorateCode`,`dd`.`DirectorateName` AS `DirectorateName`,`dp`.`HeadedBy` AS `HeadedBy` from (`tbl_departments` `dp` join `tbl_directorates` `dd` on((`dp`.`DirectorateID` = `dd`.`S_ROWID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_dhrolegroups`
--

/*!50001 DROP VIEW IF EXISTS `vw_dhrolegroups`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_dhrolegroups` AS select `d`.`S_ROWID` AS `S_ROWID`,`d`.`CreatedBy` AS `CreatedBy`,`d`.`DateCreated` AS `DateCreated`,`d`.`ModifiedBy` AS `ModifiedBy`,`d`.`DateModified` AS `DateModified`,`d`.`GroupName` AS `GroupName`,`d`.`GroupCode` AS `GroupCode`,`d`.`GroupDescription` AS `GroupDescription`,`d`.`GroupUsers` AS `GroupUsers`,`u`.`Fullname` AS `Fullname`,(select count(0) from `listitems` where ((`listitems`.`ItemType` = 'RoleUser') and (`listitems`.`ItemCode` = `d`.`GroupCode`))) AS `UsersCount` from (`dh_usergroups` `d` join `dh_users` `u` on((`d`.`CreatedBy` = `u`.`loginid`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_fileaccesslog`
--

/*!50001 DROP VIEW IF EXISTS `vw_fileaccesslog`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_fileaccesslog` AS select `f`.`S_ROWID` AS `S_ROWID`,cast(`f`.`DateCreated` as date) AS `DateAccessed`,cast(`f`.`DateCreated` as time) AS `TimeAccessed`,`u`.`Fullname` AS `Fullname`,`f`.`DocID` AS `DocID`,`e`.`StoragePool` AS `StoragePool`,`e`.`FileDescription` AS `DocDescription`,`f`.`AccessAgent` AS `AccessAgent`,`f`.`AccessIP` AS `AccessIP`,`f`.`SessionID` AS `SessionID` from ((`fileaccesslog` `f` join `dh_users` `u` on((`u`.`loginid` = `f`.`CreatedBy`))) join `elementstorage` `e` on((`f`.`DocID` = `e`.`S_ROWID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_messageout`
--

/*!50001 DROP VIEW IF EXISTS `vw_messageout`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_messageout` AS select `m`.`S_ROWID` AS `S_ROWID`,`m`.`CreatedBy` AS `CreatedBy`,`m`.`DateCreated` AS `DateCreated`,`m`.`ModifiedBy` AS `ModifiedBy`,`m`.`DateModified` AS `DateModified`,`m`.`SendChannel` AS `SendChannel`,`m`.`MessageType` AS `MessageType`,`m`.`MessageBody` AS `MessageBody`,`m`.`SendFrequency` AS `SendFrequency`,`m`.`SendDate` AS `SendDate`,`m`.`SendTime` AS `SendTime`,(select count(0) from `tbl_bulksms` where (`tbl_bulksms`.`ParentMsgID` = `m`.`S_ROWID`)) AS `RecptCount` from `tbl_messageout` `m` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_modsearchflds`
--

/*!50001 DROP VIEW IF EXISTS `vw_modsearchflds`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_modsearchflds` AS select `l`.`S_ROWID` AS `S_ROWID`,`l`.`CreatedBy` AS `CreatedBy`,`l`.`DateCreated` AS `DateCreated`,`l`.`ItemCode` AS `ModCode`,`l`.`ItemDescription` AS `FieldName`,`dh`.`ModuleCode` AS `ModuleCode`,`dh`.`TableName` AS `TableName`,`dh`.`ParentTable` AS `ParentTable` from (`listitems` `l` join `dh_modules` `dh` on((`l`.`ItemCode` = `dh`.`S_ROWID`))) where (`l`.`ItemType` = 'SearchFlds') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_profilepermissions`
--

/*!50001 DROP VIEW IF EXISTS `vw_profilepermissions`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_profilepermissions` AS select `pr`.`ProfileID` AS `ProfileID`,`pr`.`ModCode` AS `ModCode`,`pr`.`ModOperation` AS `ModOperation`,`pr`.`IsAllowed` AS `IsAllowed`,`dm`.`ModuleCode` AS `ModuleCode`,`dm`.`ModuleName` AS `ModuleName`,`dm`.`IconRef` AS `ModIcon`,`dm`.`DisplayOrder` AS `ModDisplayOrder`,`da`.`S_ROWID` AS `AppS_ROWID`,`da`.`ApplicationName` AS `ApplicationName`,`da`.`IconRef` AS `AppIcon`,`da`.`DisplayOrder` AS `AppDisplayOrder` from ((`dh_profilepermissions` `pr` join `dh_modules` `dm` on((`pr`.`ModCode` = `dm`.`S_ROWID`))) join `dh_applications` `da` on((`dm`.`AppName` = `da`.`AppCode`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_roleprofiles`
--

/*!50001 DROP VIEW IF EXISTS `vw_roleprofiles`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_roleprofiles` AS select `l`.`S_ROWID` AS `S_ROWID`,`p`.`CreatedBy` AS `CreatedBy`,`p`.`DateCreated` AS `DateCreated`,`p`.`ProfileName` AS `ProfileName`,`p`.`ProfileDescription` AS `ProfileDescription`,`l`.`ItemDescription` AS `ItemDescription`,`l`.`ItemCode` AS `ItemCode` from (`dh_userprofiles` `p` join `listitems` `l` on(((`p`.`S_ROWID` = `l`.`ItemDescription`) and (`l`.`ItemType` = 'RoleProfile')))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_sections`
--

/*!50001 DROP VIEW IF EXISTS `vw_sections`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_sections` AS select `s`.`S_ROWID` AS `S_ROWID`,`s`.`CreatedBy` AS `CreatedBy`,`s`.`DateCreated` AS `DateCreated`,`s`.`ModifiedBy` AS `ModifiedBy`,`s`.`DateModified` AS `DateModified`,`s`.`SectionName` AS `SectionName`,`s`.`SectionCode` AS `SectionCode`,`s`.`HeadofSection` AS `HeadofSection`,`s`.`DepartmentID` AS `DepartmentID`,`dp`.`DepartmentName` AS `DepartmentName`,`dp`.`DirectorateName` AS `DirectorateName`,`s`.`HeadedBy` AS `HeadedBy` from (`tbl_sections` `s` join `vw_departments` `dp` on((`s`.`DepartmentID` = `dp`.`S_ROWID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_usergroups`
--

/*!50001 DROP VIEW IF EXISTS `vw_usergroups`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_usergroups` AS select `l`.`S_ROWID` AS `S_ROWID`,`l`.`ItemCode` AS `UserGroup`,`l`.`ItemDescription` AS `loginid`,`u`.`Fullname` AS `Fullname`,`u`.`Phone` AS `Phone`,`u`.`UserStatus` AS `UserStatus`,`u`.`user_type` AS `user_type` from (`listitems` `l` join `dh_users` `u` on((`u`.`loginid` = `l`.`ItemDescription`))) where (`l`.`ItemType` = 'RoleUser') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_userslist`
--

/*!50001 DROP VIEW IF EXISTS `vw_userslist`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_userslist` AS select `dh_users`.`S_ROWID` AS `S_ROWID`,`dh_users`.`loginid` AS `loginid`,`dh_users`.`Fullname` AS `Fullname`,`dh_users`.`Phone` AS `Phone`,`dh_users`.`Email` AS `Email`,`dh_users`.`Position` AS `Position`,`dh_users`.`PhoneExt` AS `PhoneExt`,`dh_users`.`pswd` AS `pswd`,`dh_users`.`user_type` AS `user_type`,`dh_users`.`CreatedBy` AS `CreatedBy`,`dh_users`.`DateCreated` AS `DateCreated`,`dh_users`.`shift` AS `shift`,`dh_users`.`Department` AS `Department`,`dh_users`.`Section` AS `Section`,`dh_users`.`ProfileImage` AS `ProfileImage`,`dh_users`.`UserStatus` AS `userstatus`,`dh_users`.`DeActivatedBy` AS `DeActivatedBy`,`dh_users`.`DateDeActivated` AS `DateDeActivated`,`dh_users`.`DeActivateReason` AS `DeActivateReason`,`dh_users`.`ModifiedBy` AS `ModifiedBy`,`dh_users`.`DateModified` AS `DateModified` from `dh_users` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-09 15:48:54
