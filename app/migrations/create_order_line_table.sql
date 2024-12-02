-- Active: 1733158023054@@127.0.0.1@3336@restaurant
CREATE TABLE IF NOT EXISTS order_line(  
    order_id int FOREIGN KEY,
    product_id int FOREIGN KEY,
    ingredient_id int FOREIGN KEY,
    quantity int,
    total_price float,
    PRIMARY KEY (order_id, product_id, ingredient_id),
    CONSTRAINT fk_order_line_orders (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    CONSTRAINT fk_order_line_products (product_id) REFERENCES products(id) ON DELETE CASCADE ,
    CONSTRAINT fk_order_line_ingredient (ingredient_id) REFERENCES ingredient(id) ON DELETE CASCADE 
);