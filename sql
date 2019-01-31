CREATE TABLE `Guestbook`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(155) NULL,
  `email` VARCHAR(155) NOT NULL,
  `password` VARCHAR(155) NOT NULL,
  `is_admin` TINYINT(2) NULL,
  PRIMARY KEY (`id`));


CREATE TABLE `Guestbook`.`posts` (
  `id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(155) NULL,
  `summary` VARCHAR(255) NULL,
  `approved` BIT(1) NULL,
  `deleted` BIT(1) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `image` VARCHAR(155) NULL,
  PRIMARY KEY (`id`));
