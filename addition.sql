/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `7maru_test_results` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` char(8) NOT NULL,
  `score` int(11) NOT NULL,
  `scorefull` int(11) NOT NULL,
  `choiced` int(11) NOT NULL,
  `total_ques` int(11) NOT NULL,
  `hit` int(11) NOT NULL,
  `result` longtext NOT NULL,
  `test_time` datetime NOT NULL,
  `user_id` char(20) NOT NULL,
  PRIMARY KEY (`result_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

CREATE TABLE IF NOT EXISTS `7maru_comment_teachers` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` char(20) CHARACTER SET utf8 NOT NULL,
  `teacher_id` char(20) CHARACTER SET utf8 NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

CREATE TABLE IF NOT EXISTS `7maru_likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;