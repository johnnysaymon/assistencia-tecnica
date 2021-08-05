SET names 'utf8';

CREATE TABLE IF NOT EXISTS `item` (
    `id` VARCHAR(20) NOT NULL,
    `name` VARCHAR(200) NOT NULL,
    `category_id` VARCHAR(20) NOT NULL,
    `attribute_list` JSON NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;