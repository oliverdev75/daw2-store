-- Active: 1733012109098@@127.0.0.1@3333@restaurant
CREATE TABLE IF NOT EXISTS offers (
    id int NOT NULL PRIMARY KEY,
    name VARCHAR(40) NOT NULL,
    type VARCHAR(11) NOT NULL,
    discount float NOT NULL,
    beggining_date DATE NOT NULL,
    ending_date DATE NOT NULL
);