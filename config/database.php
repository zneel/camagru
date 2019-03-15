<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-05
 * Time: 21:42
 */

$DB_DSN = 'mysql:3306';
$DB_NAME = 'camagru';
$DB_USER = 'camagru';
$DB_PASSWORD = 'camagru';

$DB_USERS = "CREATE TABLE IF NOT EXISTS `users` (
  `id`             int(11)      NOT NULL AUTO_INCREMENT,
  `username`       varchar(45)  NOT NULL,
  `password`       varchar(255) NOT NULL,
  `email`          varchar(45)  NOT NULL,
  `verified_at`    datetime     DEFAULT NULL,
  `email_hash`     varchar(80)  DEFAULT NULL,
  `created_at`     timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password_hash`  varchar(80)  DEFAULT NULL,
  `receive_emails` tinyint(1)   NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_uindex` (`email`),
  UNIQUE KEY `users_username_uindex` (`username`)) 
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8";

$DB_IMAGES = "CREATE TABLE IF NOT EXISTS `images`
(
  `id`         int(11)      NOT NULL AUTO_INCREMENT,
  `path`       varchar(255) NOT NULL,
  `created_at` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id`    int(11)      DEFAULT NULL,
  PRIMARY KEY(`id`),
  UNIQUE KEY `images_id_uindex` (`id`),
  KEY `images_users_id_fk` (`user_id`),
  CONSTRAINT `images_users_id_fk` FOREIGN KEY(`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) 
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8";

$DB_IMAGES_HAS_LIKES = "CREATE TABLE IF NOT EXISTS `images_has_likes` (
  `user_id`  int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  KEY `images_has_likes_images_id_fk` (`image_id`),
  KEY `images_has_likes_users_id_fk` (`user_id`),
  CONSTRAINT `images_has_likes_images_id_fk` FOREIGN KEY(`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `images_has_likes_users_id_fk` FOREIGN KEY(`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) 
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8";

$DB_COMMENTS = "CREATE TABLE IF NOT EXISTS `comments` (
  `id`         int(11)    NOT NULL AUTO_INCREMENT,
  `comment`    longtext   NOT NULL,
  `created_at` timestamp  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id`    int(11)    NOT NULL,
  `image_id`   int(11)    NOT NULL,
  PRIMARY KEY(`id`),
  KEY `comments_images_id_fk` (`image_id`),
  KEY `comments_users_id_fk` (`user_id`),
  CONSTRAINT `comments_images_id_fk` FOREIGN KEY(`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_users_id_fk` FOREIGN KEY(`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) 
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8";
