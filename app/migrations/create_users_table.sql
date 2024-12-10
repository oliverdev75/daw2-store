-- Active: 1733012109098@@127.0.0.1@3333@restaurant
CREATE TABLE IF NOT EXISTS users (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20),
    surnames VARCHAR(30),
    username VARCHAR(20),
    password VARCHAR(255),
    role VARCHAR(6),
    create_time DATETIME
);