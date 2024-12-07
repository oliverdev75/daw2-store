-- Active: 1733012109098@@127.0.0.1@3333@restaurant
CREATE TABLE IF NOT EXISTS orders (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id int NOT NULL,
    create_time DATETIME,
    CONSTRAINT fk_orders_users FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
);