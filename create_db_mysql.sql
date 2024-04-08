CREATE TABLE `coupons` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `min_price` decimal(18,2) NOT NULL DEFAULT '0.00',
  `max_price` decimal(18,2) DEFAULT NULL,
  `discount` decimal(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `IX_UniqueCode` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` int unsigned DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(18,2) NOT NULL,
  `stock_qty` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
  KEY `FK_CouponId` (`coupon_id`),
  CONSTRAINT `FK_CouponId` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `clients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(100) NOT NULL,
  `vat_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_code` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `privacy` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int unsigned NOT NULL,
  `total_price` decimal(18,2) NOT NULL,
  `invoice` tinyint(1) NOT NULL DEFAULT '0',
  `order_address` text NOT NULL
  `complete` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ClientId` (`client_id`),
  CONSTRAINT `FK_ClientId` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `order_products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_OrderId` (`order_id`),
  KEY `FK_ProductId` (`product_id`),
  CONSTRAINT `FK_OrderId` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `FK_ProductId` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `custom_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text_1` mediumtext DEFAULT NULL,
  `text_2` mediumtext DEFAULT NULL,
  `text_3` mediumtext DEFAULT NULL,
  `text_4` mediumtext DEFAULT NULL,
  `text_5` mediumtext DEFAULT NULL,
  `string_1` varchar(255) DEFAULT NULL,
  `string_2` varchar(255) DEFAULT NULL,
  `string_3` varchar(255) DEFAULT NULL,
  `string_4` varchar(255) DEFAULT NULL,
  `string_5` varchar(255) DEFAULT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `custom_pages` (`id`, `title`, `text_1`, `text_2`, `text_3`, `text_4`, `text_5`, `string_1`, `string_2`, `string_3`, `string_4`, `string_5`) VALUES
(1, 'home', '', '', '', '', '', '', '', '', '', ''),
(2, 'Contatti', '', '', '', '', '', '', '', '', '', '');


CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `roles` (`id`, `title`) VALUES
(1, 'Admin'),
(2, 'Manager');


CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
   KEY `FK_RoleId` (`role_id`),
  CONSTRAINT `FK_RoleId` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `users` (`id`, `role_id`, `email`, `password`, `username`, `created`, `modified`) VALUES
(1, 1, 'giuseppeosenda1@gmail.com', '$2y$10$MNbsAEQpVlbCUNuhHIrh8Onw7M.rjaM7Irvt7EccJ1H0H/GZKfL2.', 'Giuseppe', '2024-03-02 20:55:54', '2024-03-10 18:15:47'),
(2, 2, 'cliente@gmail.com', '$2y$10$nPM4IaGydg0zaUAhqlmww./Wxj3T.v8SjtOaqP651NJRCFi7xGZ0S', 'cliente', '2024-03-15 12:11:34', '2024-03-15 12:11:34');


