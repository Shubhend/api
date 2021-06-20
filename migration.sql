CREATE TABLE `api`.`autoindexusers` ( `id` INT NOT NULL AUTO_INCREMENT ,  `email` VARCHAR(200) NOT NULL ,  `date` VARCHAR(200) NOT NULL ,  `count` INT(20) NOT NULL ,  `site` VARCHAR(200) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;



CREATE TABLE `api`.`autoindex` ( `id` INT NOT NULL AUTO_INCREMENT ,  `email` VARCHAR(200) NOT NULL ,  `count` INT(20) NULL ,  `created_date` VARCHAR(200) NOT NULL ,  `site` VARCHAR(200) NOT NULL ,  `paid` VARCHAR(200) NULL ,  `version` VARCHAR(200) NOT NULL ,  `block` VARCHAR(200) NULL ,  `updated_date` VARCHAR(200) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;

CREATE TABLE `api`.`license` ( `id` INT NOT NULL AUTO_INCREMENT ,  `user` VARCHAR(200) NOT NULL ,  `secret_key` VARCHAR(200) NULL ,  `date` VARCHAR(200) NULL ,  `expiry_date` VARCHAR(200) NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;


CREATE TABLE `api`.`requesturl` ( `id` INT NOT NULL AUTO_INCREMENT ,  `user` VARCHAR(200) NOT NULL ,  `url` VARCHAR(200) NULL ,  `status` VARCHAR(200) NULL ,  `code` VARCHAR(200) NULL ,  `type` VARCHAR(200) NULL ,  `date` VARCHAR(200) NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;




CREATE TABLE `api`.`notice` ( `id` INT NOT NULL AUTO_INCREMENT ,  `info` VARCHAR(200) NOT NULL ,  `date` VARCHAR(200) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;



ALTER TABLE `license`  ADD `coupon` VARCHAR(200) NULL  AFTER `date`;


CREATE TABLE `api`.`company` ( `id` INT NOT NULL AUTO_INCREMENT ,  `coupon` VARCHAR(200) NOT NULL ,  `email` VARCHAR(200) NOT NULL ,  `date` VARCHAR(200) NOT NULL ,  `valid` VARCHAR(200) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;

ALTER TABLE `company`  ADD `count` VARCHAR(200) NULL  AFTER `email`;