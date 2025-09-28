CREATE TABLE `users` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `is_active` BOOLEAN NOT NULL,
    `is_admin` BOOLEAN NOT NULL 
);

CREATE TABLE `colors` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `color` VARCHAR(255) NOT NULL
);

CREATE TABLE `products` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `price` INT NOT NULL,
    `color_id` INT NOT NULL,
    FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE
);


CREATE TABLE `categories` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);

CREATE TABLE `images` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `filepath` VARCHAR(500) NOT NULL,
    `product_id` INT NOT NULL,
    FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
);


CREATE TABLE `product_category` (
    `product_id` INT NOT NULL,
    `category_id` INT NOT NULL,
    PRIMARY KEY (`product_id`, `category_id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
);

CREATE TABLE `carts` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
);
CREATE TABLE `cart_items` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `quantity` INT NOT NULL,
    `product_id` INT NOT NULL,
    FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
);

INSERT into `users` 
    ( `email`,`password`,`first_name`,`last_name`,`is_active`,`is_admin`)
    VALUES
    ('admin@example.com','12','Admin','Admin','1','1')
;    