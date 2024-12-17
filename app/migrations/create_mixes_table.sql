-- Active: 1733158023054@@127.0.0.1@3336@restaurant
CREATE TABLE `mixes` (
    `id` int NOT NULL,
    `product_id` int NOT NULL,
    `ingredient_id` int NOT NULL,
    `quantity` int NOT NULL,
    `total_price` float NOT NULL,
    PRIMARY KEY (
        `id`,
        `product_id`,
        `ingredient_id`
    ),
    KEY `fk_mixes_products` (`product_id`),
    KEY `fk_mixes_ingredients` (`ingredient_id`),
    CONSTRAINT `fk_order_line_ingredient` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_order_line_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci