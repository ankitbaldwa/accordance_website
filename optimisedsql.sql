RENAME TABLE `accorsb2_test_accordance`.`package_pricing` TO `accorsb2_test_accordance`.`packages`;
ALTER TABLE `packages` ADD `product_id` INT NOT NULL AFTER `id`, ADD INDEX `product_id` (`product_id`);
ALTER TABLE packages ADD no_of_days INT NOT NULL AFTER currency;
ALTER TABLE pages ADD heading VARCHAR(255) NOT NULL;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0 for Inactive & 1 for Active, 2 for default',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `product_features` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` blob,
  `status` enum('0','1') NOT NULL COMMENT '0 for Inactive and 1 for Active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

RENAME TABLE `accorsb2_test_accordance`.`request` TO `accorsb2_test_accordance`.`requests`;

ALTER TABLE requests ADD `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 for not verified,\r\n1 for verified' AFTER message;

RENAME TABLE `accorsb2_test_accordance`.`payments_log` TO `accorsb2_test_accordance`.`payment_logs`;

RENAME TABLE `accorsb2_test_accordance`.`subscription` TO `accorsb2_test_accordance`.`subscriptions`;
ALTER TABLE `subscriptions` CHANGE `comapny_db_password` `company_db_password` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

ALTER TABLE `testimonials` CHANGE `status` `status` ENUM('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1' COMMENT '0 for Inactive, 1 for Active';

ALTER TABLE `users` ADD `role` ENUM('Admin','User') NOT NULL AFTER `password`;

RENAME TABLE `accorsb2_test_accordance`.`package_benefit` TO `accorsb2_test_accordance`.`package_benefits`;
