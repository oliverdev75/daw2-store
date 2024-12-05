-- Active: 1733012109098@@127.0.0.1@3333@restaurant
CREATE TABLE IF NOT EXISTS products (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30),
    offer_id int FOREIGN KEY,
    create_time DATETIME,
    CONSTRAINT fk_products_offers (offer_id) REFERENCES offers (id)
);