-- Active: 1733012109098@@127.0.0.1@3333@restaurant
CREATE TABLE IF NOT EXISTS products_ingredients (
    product_id int NOT NULL,
    ingredient_id int NOT NULL,
    quantity int NOT NULL,
    PRIMARY KEY (product_id, ingredient_id),
    CONSTRAINT fk_products_ingredients_products FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE,
    CONSTRAINT fk_products_ingredients_ingredients FOREIGN KEY (ingredient_id) REFERENCES ingredients (id) ON DELETE CASCADE
);