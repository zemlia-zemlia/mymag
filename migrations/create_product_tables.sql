CREATE TABLE `product` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`article` varchar(255) NOT NULL UNIQUE,
	`decsription` TEXT,
	`slug` varchar(255) NOT NULL,
	`price` int(11) NOT NULL,
	`meta_title` varchar(255) NOT NULL,
	`meta_desc` varchar(255) NOT NULL,
	`meta_keywords` varchar(255) NOT NULL,
	`created_at` int(11) NOT NULL,
	`updated_at` int(11) NOT NULL,
	`group_id` int(11),
	PRIMARY KEY (`id`)
);

CREATE TABLE `property` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`slug` varchar(255) NOT NULL,
	`type` int(1) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `category_property` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`id_category` int(11) NOT NULL,
	`id_property` int(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `property_value` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`id_property` int(11) NOT NULL,
	`value` varchar(255) NOT NULL,
	`id_product` int(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `category` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`decsription` TEXT,
	`slug` varchar(255) NOT NULL,
	`meta_title` varchar(255) NOT NULL,
	`meta_desc` varchar(255) NOT NULL,
	`meta_keywords` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `category_product` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`id_category` int(11) NOT NULL,
	`id_product` int(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `group` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`slug` varchar(255) NOT NULL,
	`id_property` int(11) NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `product` ADD CONSTRAINT `product_fk0` FOREIGN KEY (`group_id`) REFERENCES `group`(`id`);

ALTER TABLE `category_property` ADD CONSTRAINT `category_property_fk0` FOREIGN KEY (`id_category`) REFERENCES `category`(`id`);

ALTER TABLE `category_property` ADD CONSTRAINT `category_property_fk1` FOREIGN KEY (`id_property`) REFERENCES `property`(`id`);

ALTER TABLE `property_value` ADD CONSTRAINT `property_value_fk0` FOREIGN KEY (`id_property`) REFERENCES `property`(`id`);

ALTER TABLE `property_value` ADD CONSTRAINT `property_value_fk1` FOREIGN KEY (`id_product`) REFERENCES `product`(`id`);

ALTER TABLE `category_product` ADD CONSTRAINT `category_product_fk0` FOREIGN KEY (`id_category`) REFERENCES `category`(`id`);

ALTER TABLE `category_product` ADD CONSTRAINT `category_product_fk1` FOREIGN KEY (`id_product`) REFERENCES `product`(`id`);

ALTER TABLE `group` ADD CONSTRAINT `group_fk0` FOREIGN KEY (`id_property`) REFERENCES `property`(`id`);

