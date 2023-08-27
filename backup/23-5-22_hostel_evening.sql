/*
SQLyog Ultimate
MySQL - 10.4.22-MariaDB : Database - 17837_asadullah
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`17837_asadullah` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `17837_asadullah`;

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `blog_title` varchar(50) DEFAULT NULL,
  `post_per_page` int(11) DEFAULT NULL,
  `blog_background_image` text DEFAULT NULL,
  `blog_status` enum('active','in-active') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`blog_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `blog` */

insert  into `blog`(`blog_id`,`user_id`,`blog_title`,`post_per_page`,`blog_background_image`,`blog_status`,`created_at`,`updated_at`) values 
(24,87,'Business News',NULL,NULL,'active','2022-05-20 10:00:21','2022-05-21 09:44:38'),
(26,87,'Life Hacks and Tips (Life Hacking)',0,NULL,'active','2022-05-22 16:43:33','2022-05-22 16:49:03'),
(27,87,'Data Republic (IT)',0,NULL,'active','2022-05-22 16:47:34','2022-05-22 16:49:28');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `category_status` enum('active','in-active') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_title`,`category_description`,`category_status`,`created_at`,`updated_at`) values 
(2,'Travelling ducks','                        Vlogging, Blogging, Travelling Guidence                                         ','in-active','2022-05-16 00:40:04','2022-05-22 22:01:43'),
(5,'Flim Industry','In this category, we will discuss Movies, Actors, Directors, Releasing and much more','active','2022-05-16 00:35:17','2022-05-22 17:03:18'),
(6,'Social Media','In this category we will discuss about social media issues and news                   ','active','2022-05-16 00:36:40','2022-05-22 17:00:52'),
(8,'StudyHacks (Study Habits)','In this category, we will learn how to improve concentration in study                        ','active','2022-05-22 16:51:47','2022-05-22 17:00:13');

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_summary` longtext NOT NULL,
  `post_description` longtext NOT NULL,
  `featured_image` text DEFAULT NULL,
  `post_status` enum('active','in-active') DEFAULT 'active',
  `is_comment_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`post_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `post` */

insert  into `post`(`post_id`,`blog_id`,`post_title`,`post_summary`,`post_description`,`featured_image`,`post_status`,`is_comment_allowed`,`created_at`,`updated_at`) values 
(20,24,'business title','business summary','business description','uploaded_data/27260-profile-post_img_1.jpg','active',1,'2022-05-22 00:42:48','2022-05-23 10:47:39'),
(22,27,'Atomic Habbits','This is post summary example text.','This is post description, example text.','uploaded_data/8311-profile-post_img_3.jpg','active',0,'2022-05-23 09:51:33','2022-05-23 10:47:27'),
(23,24,'Stock Market High','A stock market, equity market, or share market is the aggregation of buyers and sellers of stocks.','You can invest and trade in the stock market through TREC (Trading Rights Entitlement Certificate) holders/ brokerage firms recognised by PSX and licensed by the Securities &amp; Exchange Commission of Pakistan (SECP).','uploaded_data/19857-profile-post_img_4.jpg','active',1,'2022-05-23 09:54:53','2022-05-23 10:47:16'),
(25,27,'Advance Effects in Movies','this is summary','this is description','uploaded_data/38487-profile-post_img_4.jpg','in-active',0,'2022-05-23 10:54:11',NULL),
(26,24,'Music Title','kzdngvaijegbk','kSDJBGKEJGBLK','uploaded_data/47775-post-post_img_2.jpg','active',1,'2022-05-23 11:50:47',NULL),
(27,26,'Esay Tips and Tricks','The Spoon Bend is a classic trick that every smart-aleck needs to know.','You grab any spoon, press down on it with your hands and appear to bend the spoon. ','uploaded_data/48541-post-post_img_6.jpg','active',0,'2022-05-23 22:50:47',NULL);

/*Table structure for table `post_atachment` */

DROP TABLE IF EXISTS `post_atachment`;

CREATE TABLE `post_atachment` (
  `post_atachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `post_attachment_title` varchar(200) DEFAULT NULL,
  `post_attachment_path` text DEFAULT NULL,
  `is_active` enum('active','in-active') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`post_atachment_id`),
  KEY `fk1` (`post_id`),
  CONSTRAINT `fk1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `post_atachment` */

insert  into `post_atachment`(`post_atachment_id`,`post_id`,`post_attachment_title`,`post_attachment_path`,`is_active`,`created_at`,`updated_at`) values 
(10,20,'Excel File','uploaded_data/42424_Project_ERD_Updated.xlsx','active','2022-05-22 00:42:48','2022-05-23 11:51:39'),
(12,22,'PDF File','uploaded_data/46602_1652935478_Assad Ali_profile.pdf','active','2022-05-23 09:51:33','2022-05-23 11:51:30'),
(13,23,'Excel File','uploaded_data/23678_Project_ERD_Updated.xlsx','active','2022-05-23 09:54:53','2022-05-23 11:51:22'),
(15,25,'Excel File','uploaded_data/11093_Project_ERD_Updated.xlsx','active','2022-05-23 10:54:11','2022-05-23 11:51:10'),
(16,26,'pdf file','uploaded_data/42192_1652935478_Assad Ali_profile.pdf','active','2022-05-23 11:50:48',NULL),
(17,27,'pdf File','uploaded_data/20426_1652935478_Assad Ali_profile.pdf','active','2022-05-23 22:50:47',NULL);

/*Table structure for table `post_category` */

DROP TABLE IF EXISTS `post_category`;

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`post_category_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `post_category` */

insert  into `post_category`(`post_category_id`,`post_id`,`category_id`,`created_at`,`updated_at`) values 
(18,20,2,'2022-05-22 00:42:48',NULL),
(20,22,8,'2022-05-23 09:51:33',NULL),
(21,23,6,'2022-05-23 09:54:53',NULL),
(23,25,5,'2022-05-23 10:54:11',NULL),
(24,26,2,'2022-05-23 11:50:48',NULL),
(25,27,2,'2022-05-23 22:50:47',NULL);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_type`,`is_active`) values 
(1,'admin','Active'),
(2,'user','Active');

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` varchar(100) DEFAULT NULL,
  `setting_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `setting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `setting` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_approved` enum('pending','approved','rejected') DEFAULT 'pending',
  `is_active` enum('active','in-active') DEFAULT 'in-active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`user_id`,`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`user_image`,`address`,`is_approved`,`is_active`,`created_at`,`updated_at`) values 
(91,1,'Asadullah','Phull','assadullahphull@gmail.com','2723.Asad','Male','1997-02-25','uploaded_data/19943-post-admin-img.jpg','                        Village Hoti Phull                    ','approved','active','2022-05-24 02:37:03','0000-00-00 00:00:00'),
(92,2,'Ravi','Rathore','csravi816@gmail.com','Aa1@aaa','Male','2022-05-11','uploaded_data/11410-profile-user-3.jpg','Islamkot Tharparkar','approved','active','2022-05-24 02:38:14','2022-05-24 02:43:10'),
(93,2,'Asad','Rehman','assadphl@gmail.com','2723@phulL','Male','2021-09-21','uploaded_data/15330-profile-user-4.jpg','Karachi, Sindh','approved','active','2022-05-24 02:39:32','2022-05-24 02:43:13'),
(94,2,'Naseer Ali','Soomro','phpstudent2022@gmail.com','@Php123','Male','2020-07-07','uploaded_data/8827-profile-user-1.jpg','Karachi, Sindh','approved','active','2022-05-24 02:41:34','2022-05-24 02:43:16'),
(95,2,'Asad','Khan','asad@gmail.com','Aa1@aaa','Male','2022-05-03','uploaded_data/47359-profile-user-5.jpg','This is Addres Example, can be rest.','pending','in-active','2022-05-24 03:29:59',NULL),
(96,2,'aliza','shah','shah@gmail.com','Aliza12@','Female','2022-05-11','uploaded_data/47965-profile-user-2.jpg','This is Addres Example, can be rest.','pending','in-active','2022-05-24 03:30:47',NULL),
(97,2,'Sittara','Tagar','tagar@gmail.com','Tara@12','Female','2022-05-20','uploaded_data/3253-profile-user-6.jpg','This is Addres Example, can be rest.','pending','in-active','2022-05-24 03:31:40',NULL),
(98,2,'Ansa','Khanzada','khanzada@gmail.com','Ansa12@','Female','2022-05-11','uploaded_data/20240-profile-user-8.JPG','This is Addres Example, can be rest.','pending','in-active','2022-05-24 03:32:24',NULL);

/*Table structure for table `user_blog_following` */

DROP TABLE IF EXISTS `user_blog_following`;

CREATE TABLE `user_blog_following` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `blog_following_id` int(11) DEFAULT NULL,
  `status` enum('Followed','Unfollowed') DEFAULT 'Followed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`follow_id`),
  KEY `blog_following_id` (`blog_following_id`),
  KEY `follower_id` (`follower_id`),
  CONSTRAINT `user_blog_following_ibfk_1` FOREIGN KEY (`blog_following_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_blog_following_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_blog_following` */

/*Table structure for table `user_feedback` */

DROP TABLE IF EXISTS `user_feedback`;

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_feedback` */

insert  into `user_feedback`(`feedback_id`,`user_id`,`user_name`,`user_email`,`feedback`,`created_at`,`updated_at`) values 
(2,NULL,'Ali','ali@gmail.com','This ALi I am sending a feedback.','2022-05-22 16:22:21',NULL),
(3,NULL,'Sidhu Paji','sadia@gmail.com','This is a feedback message from a Visitor user, who is not registered.','2022-05-22 16:31:32',NULL),
(4,NULL,'Sidhu Paji','sadia@gmail.com','This is a feedback message from a Visitor user, who is not registered.','2022-05-22 16:32:32',NULL);

/*Table structure for table `user_post_comment` */

DROP TABLE IF EXISTS `user_post_comment`;

CREATE TABLE `user_post_comment` (
  `post_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_active` enum('active','in-active') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_comment_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `user_post_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_post_comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_post_comment` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
