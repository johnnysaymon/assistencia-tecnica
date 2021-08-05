SET names 'utf8';

CREATE TABLE IF NOT EXISTS `category` (
    `id` VARCHAR(20) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `category_attribute` (
    `id` VARCHAR(25) NOT NULL,
    `category_id` VARCHAR(20) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;