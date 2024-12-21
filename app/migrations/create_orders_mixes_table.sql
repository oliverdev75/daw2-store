-- Active: 1732818887997@@127.0.0.1@3336@restaurant
CREATE TABLE IF NOT EXISTS orders_mixes (
    order_id int NOT NULL,
    mix_id int NOT NULL,
    quantity int NOT NULL,
    total_price float NOT NULL,
    PRIMARY KEY (
        order_id,
        mix_id
    ),
    CONSTRAINT fk_order_mixes_orders FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
    CONSTRAINT fk_order_mixes_mixes FOREIGN KEY (mix_id) REFERENCES mixes (id) ON DELETE CASCADE
);