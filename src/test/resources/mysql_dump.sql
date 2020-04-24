-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: bitrix.loc    Database: bitrix
-- ------------------------------------------------------
-- Server version	5.7.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE `bitrix` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `bitrix`

--
-- Table structure for table `b_sale_basket`
--

DROP TABLE IF EXISTS `b_sale_basket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_sale_basket` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FUSER_ID` int(11) NOT NULL,
  `ORDER_ID` int(11) DEFAULT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `PRODUCT_PRICE_ID` int(11) DEFAULT NULL,
  `PRICE_TYPE_ID` int(11) DEFAULT NULL,
  `PRICE` decimal(18,4) NOT NULL,
  `CURRENCY` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `BASE_PRICE` decimal(18,4) DEFAULT NULL,
  `VAT_INCLUDED` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `DATE_INSERT` datetime NOT NULL,
  `DATE_UPDATE` datetime NOT NULL,
  `DATE_REFRESH` datetime DEFAULT NULL,
  `WEIGHT` double(18,2) DEFAULT NULL,
  `QUANTITY` double(18,4) NOT NULL DEFAULT '0.0000',
  `LID` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `DELAY` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CAN_BUY` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `MODULE` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CALLBACK_FUNC` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NOTES` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ORDER_CALLBACK_FUNC` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DETAIL_PAGE_URL` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DISCOUNT_PRICE` decimal(18,4) NOT NULL,
  `CANCEL_CALLBACK_FUNC` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PAY_CALLBACK_FUNC` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRODUCT_PROVIDER_CLASS` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CATALOG_XML_ID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PRODUCT_XML_ID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DISCOUNT_NAME` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DISCOUNT_VALUE` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DISCOUNT_COUPON` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VAT_RATE` decimal(18,4) DEFAULT '0.0000',
  `SUBSCRIBE` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `DEDUCTED` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `RESERVED` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `BARCODE_MULTI` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `RESERVE_QUANTITY` double DEFAULT NULL,
  `CUSTOM_PRICE` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `DIMENSIONS` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TYPE` int(11) DEFAULT NULL,
  `SET_PARENT_ID` int(11) DEFAULT NULL,
  `MEASURE_CODE` int(11) DEFAULT NULL,
  `MEASURE_NAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RECOMMENDATION` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SORT` int(11) NOT NULL DEFAULT '100',
  `XML_ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IXS_BASKET_LID` (`LID`),
  KEY `IXS_BASKET_USER_ID` (`FUSER_ID`),
  KEY `IXS_BASKET_ORDER_ID` (`ORDER_ID`),
  KEY `IXS_BASKET_PRODUCT_ID` (`PRODUCT_ID`),
  KEY `IXS_BASKET_PRODUCT_PRICE_ID` (`PRODUCT_PRICE_ID`),
  KEY `IXS_SBAS_XML_ID` (`PRODUCT_XML_ID`,`CATALOG_XML_ID`),
  KEY `IXS_BASKET_DATE_INSERT` (`DATE_INSERT`),
  KEY `IXS_BASKET_SET_PARENT_ID` (`SET_PARENT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=545257 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `b_sale_order`
--

DROP TABLE IF EXISTS `b_sale_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_sale_order` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LID` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `PERSON_TYPE_ID` int(11) NOT NULL,
  `PAYED` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `DATE_PAYED` datetime DEFAULT NULL,
  `EMP_PAYED_ID` int(11) DEFAULT NULL,
  `CANCELED` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `DATE_CANCELED` datetime DEFAULT NULL,
  `EMP_CANCELED_ID` int(11) DEFAULT NULL,
  `REASON_CANCELED` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS_ID` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_STATUS` datetime NOT NULL,
  `EMP_STATUS_ID` int(11) DEFAULT NULL,
  `PRICE_DELIVERY` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `PRICE_PAYMENT` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `ALLOW_DELIVERY` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `DATE_ALLOW_DELIVERY` datetime DEFAULT NULL,
  `EMP_ALLOW_DELIVERY_ID` int(11) DEFAULT NULL,
  `DEDUCTED` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `DATE_DEDUCTED` datetime DEFAULT NULL,
  `EMP_DEDUCTED_ID` int(11) DEFAULT NULL,
  `REASON_UNDO_DEDUCTED` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MARKED` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `DATE_MARKED` datetime DEFAULT NULL,
  `EMP_MARKED_ID` int(11) DEFAULT NULL,
  `REASON_MARKED` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RESERVED` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `PRICE` decimal(18,4) NOT NULL,
  `CURRENCY` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `DISCOUNT_VALUE` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `USER_ID` int(11) NOT NULL,
  `PAY_SYSTEM_ID` int(11) DEFAULT NULL,
  `DELIVERY_ID` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATE_INSERT` datetime NOT NULL,
  `DATE_UPDATE` datetime NOT NULL,
  `USER_DESCRIPTION` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ADDITIONAL_INFO` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PS_STATUS` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PS_STATUS_CODE` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PS_STATUS_DESCRIPTION` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PS_STATUS_MESSAGE` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PS_SUM` decimal(18,2) DEFAULT NULL,
  `PS_CURRENCY` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PS_RESPONSE_DATE` datetime DEFAULT NULL,
  `COMMENTS` text COLLATE utf8_unicode_ci,
  `TAX_VALUE` decimal(18,2) NOT NULL DEFAULT '0.00',
  `STAT_GID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SUM_PAID` decimal(18,2) NOT NULL DEFAULT '0.00',
  `IS_RECURRING` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `RECURRING_ID` int(11) DEFAULT NULL,
  `PAY_VOUCHER_NUM` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PAY_VOUCHER_DATE` date DEFAULT NULL,
  `LOCKED_BY` int(11) DEFAULT NULL,
  `DATE_LOCK` datetime DEFAULT NULL,
  `RECOUNT_FLAG` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `AFFILIATE_ID` int(11) DEFAULT NULL,
  `DELIVERY_DOC_NUM` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DELIVERY_DOC_DATE` date DEFAULT NULL,
  `UPDATED_1C` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `STORE_ID` int(11) DEFAULT NULL,
  `ORDER_TOPIC` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CREATED_BY` int(11) DEFAULT NULL,
  `RESPONSIBLE_ID` int(11) DEFAULT NULL,
  `COMPANY_ID` int(11) DEFAULT NULL,
  `DATE_PAY_BEFORE` datetime DEFAULT NULL,
  `DATE_BILL` datetime DEFAULT NULL,
  `ACCOUNT_NUMBER` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TRACKING_NUMBER` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `XML_ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_1C` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VERSION_1C` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VERSION` int(11) NOT NULL DEFAULT '0',
  `EXTERNAL_ORDER` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `RUNNING` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `BX_USER_ID` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `IXS_ACCOUNT_NUMBER` (`ACCOUNT_NUMBER`),
  KEY `IXS_ORDER_PERSON_TYPE_ID` (`PERSON_TYPE_ID`),
  KEY `IXS_ORDER_STATUS_ID` (`STATUS_ID`),
  KEY `IXS_ORDER_REC_ID` (`RECURRING_ID`),
  KEY `IX_SOO_AFFILIATE_ID` (`AFFILIATE_ID`),
  KEY `IXS_ORDER_UPDATED_1C` (`UPDATED_1C`),
  KEY `IXS_SALE_COUNT` (`USER_ID`,`LID`,`PAYED`,`CANCELED`),
  KEY `IXS_DATE_UPDATE` (`DATE_UPDATE`),
  KEY `IXS_XML_ID` (`XML_ID`),
  KEY `IXS_ID_1C` (`ID_1C`),
  KEY `IX_BSO_DATE_ALLOW_DELIVERY` (`DATE_ALLOW_DELIVERY`),
  KEY `IX_BSO_ALLOW_DELIVERY` (`ALLOW_DELIVERY`),
  KEY `IX_BSO_DATE_CANCELED` (`DATE_CANCELED`),
  KEY `IX_BSO_CANCELED` (`CANCELED`),
  KEY `IX_BSO_DATE_PAYED` (`DATE_PAYED`),
  KEY `IX_BSO_DATE_INSERT` (`DATE_INSERT`),
  KEY `IX_BSO_DATE_PAY_BEFORE` (`DATE_PAY_BEFORE`)
) ENGINE=InnoDB AUTO_INCREMENT=41098 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `b_event`
--

DROP TABLE IF EXISTS `b_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_event` (
  `ID` int(18) NOT NULL AUTO_INCREMENT,
  `EVENT_NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MESSAGE_ID` int(18) DEFAULT NULL,
  `LID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `C_FIELDS` longtext COLLATE utf8_unicode_ci,
  `DATE_INSERT` datetime DEFAULT NULL,
  `DATE_EXEC` datetime DEFAULT NULL,
  `SUCCESS_EXEC` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `DUPLICATE` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `LANGUAGE_ID` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ix_success` (`SUCCESS_EXEC`),
  KEY `ix_b_event_date_exec` (`DATE_EXEC`)
) ENGINE=InnoDB AUTO_INCREMENT=300723 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `b_user`
--

DROP TABLE IF EXISTS `b_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_user` (
  `ID` int(18) NOT NULL AUTO_INCREMENT,
  `TIMESTAMP_X` timestamp NULL DEFAULT NULL,
  `LOGIN` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CHECKWORD` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ACTIVE` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `NAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LAST_NAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EMAIL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LAST_LOGIN` datetime DEFAULT NULL,
  `DATE_REGISTER` datetime NOT NULL,
  `LID` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_PROFESSION` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_WWW` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_ICQ` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_GENDER` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_BIRTHDATE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_PHOTO` int(18) DEFAULT NULL,
  `PERSONAL_PHONE` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_FAX` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_MOBILE` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_PAGER` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_STREET` text COLLATE utf8_unicode_ci,
  `PERSONAL_MAILBOX` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_CITY` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_STATE` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_ZIP` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_COUNTRY` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_NOTES` text COLLATE utf8_unicode_ci,
  `WORK_COMPANY` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_DEPARTMENT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_POSITION` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_WWW` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_PHONE` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_FAX` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_PAGER` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_STREET` text COLLATE utf8_unicode_ci,
  `WORK_MAILBOX` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_CITY` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_STATE` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_ZIP` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_COUNTRY` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WORK_PROFILE` text COLLATE utf8_unicode_ci,
  `WORK_LOGO` int(18) DEFAULT NULL,
  `WORK_NOTES` text COLLATE utf8_unicode_ci,
  `ADMIN_NOTES` text COLLATE utf8_unicode_ci,
  `STORED_HASH` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `XML_ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PERSONAL_BIRTHDAY` date DEFAULT NULL,
  `EXTERNAL_AUTH_ID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CHECKWORD_TIME` datetime DEFAULT NULL,
  `SECOND_NAME` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CONFIRM_CODE` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOGIN_ATTEMPTS` int(18) DEFAULT NULL,
  `LAST_ACTIVITY_DATE` datetime DEFAULT NULL,
  `AUTO_TIME_ZONE` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIME_ZONE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TIME_ZONE_OFFSET` int(18) DEFAULT NULL,
  `TITLE` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BX_USER_ID` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LANGUAGE_ID` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ix_login` (`LOGIN`,`EXTERNAL_AUTH_ID`),
  UNIQUE KEY `IX_PERSONAL_PHONE` (`PERSONAL_PHONE`),
  KEY `ix_b_user_email` (`EMAIL`),
  KEY `ix_b_user_activity_date` (`LAST_ACTIVITY_DATE`),
  KEY `IX_B_USER_XML_ID` (`XML_ID`),
  KEY `ix_user_last_login` (`LAST_LOGIN`),
  KEY `ix_user_date_register` (`DATE_REGISTER`)
) ENGINE=InnoDB AUTO_INCREMENT=146133 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-25 17:55:26
