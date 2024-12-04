-- Active: 1733158023054@@127.0.0.1@3336@restaurant
CREATE TABLE IF NOT EXISTS ingredients(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30),
    price FLOAT,
    create_time DATETIME
);