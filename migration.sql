CREATE TABLE  `autoindexusers` ( `id` INT NOT NULL AUTO_INCREMENT ,  `email` VARCHAR(200) NOT NULL ,  `date` VARCHAR(200) NOT NULL ,  `count` INT(20) NOT NULL ,  `site` VARCHAR(200) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;



CREATE TABLE  `autoindex` ( `id` INT NOT NULL AUTO_INCREMENT ,  `email` VARCHAR(200) NOT NULL ,  `count` INT(20) NULL ,  `created_date` VARCHAR(200) NOT NULL ,  `site` VARCHAR(200) NOT NULL ,  `paid` VARCHAR(200) NULL ,  `version` VARCHAR(200) NOT NULL ,  `block` VARCHAR(200) NULL ,  `updated_date` VARCHAR(200) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;

CREATE TABLE  `license` ( `id` INT NOT NULL AUTO_INCREMENT ,  `user` VARCHAR(200) NOT NULL ,  `secret_key` VARCHAR(200) NULL ,  `date` VARCHAR(200) NULL ,  `expiry_date` VARCHAR(200) NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;


CREATE TABLE  `requesturl` ( `id` INT NOT NULL AUTO_INCREMENT ,  `user` VARCHAR(200) NOT NULL ,  `url` VARCHAR(200) NULL ,  `status` VARCHAR(200) NULL ,  `code` VARCHAR(200) NULL ,  `type` VARCHAR(200) NULL ,  `date` VARCHAR(200) NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;




CREATE TABLE  `notice` ( `id` INT NOT NULL AUTO_INCREMENT ,  `info` VARCHAR(200) NOT NULL ,  `date` VARCHAR(200) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;



ALTER TABLE `license`  ADD `coupon` VARCHAR(200) NULL  AFTER `date`;


ALTER TABLE `company` ADD `discount` INT NULL AFTER `valid`;


CREATE TABLE  `company` ( `id` INT NOT NULL AUTO_INCREMENT ,  `coupon` VARCHAR(200) NOT NULL ,  `email` VARCHAR(200) NOT NULL ,  `date` VARCHAR(200) NOT NULL ,  `valid` VARCHAR(200) NOT NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;

ALTER TABLE `company`  ADD `count` VARCHAR(200) NULL  AFTER `email`;

ALTER TABLE `company` ADD `update_at` VARCHAR(222) NULL AFTER `discount`;

CREATE TABLE  `transactions` ( `id` INT NOT NULL ,  `userid` INT(222) NULL ,  `type` VARCHAR(222) NULL ,  `email` VARCHAR(222) NULL ,  `transaction_id` VARCHAR(222) NULL ,  `response` TEXT NULL ,  `userlog` TEXT NULL ,  `date` INT NOT NULL ) ENGINE = InnoDB;

ALTER TABLE `transactions` ADD PRIMARY KEY(`id`);

ALTER TABLE `transactions` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `transactions` CHANGE `date` `date` VARCHAR(222) NOT NULL;