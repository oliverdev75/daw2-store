<?php

namespace App\Controllers;

use Framework\Response\Send;
use Framework\Database\Database;
use App\Helpers\Storage;
use App\Models\User;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Log;

class ApiController
{

    public static function allUser()
    {
        return Send::json([
            'status' => 'ok',
            'data' => User::all()->get()
        ]);
    }

    public static function infoUser($id)
    {
        return Send::json([
            'status' => 'ok',
            'data' => User::find((int) $id)
        ]);
    }

    public static function storeUpdateUser($postData)
    {
        if ($postData->action == 'create') {
            User::create([
                'name' => $postData->name,
                'surnames' => $postData->surnames,
                'email' => $postData->email,
                'role' => $postData->role,
                'password' => password_hash($postData->password, PASSWORD_BCRYPT)
            ]);
        } else {
            User::where('id', $postData->id)
                ->set('name', $postData->data->name)
                ->set('surnames', $postData->data->surnames)
                ->set('email', $postData->data->email)
                ->set('password', password_hash($postData->data->password, PASSWORD_BCRYPT))
                ->set('role', $postData->data->role)
                ->update();
        }

        return Send::json([
            'status' => 'ok',
            'message' => 'User created/updated!'
        ]);
    }

    public static function destroyUser($postData)
    {
        User::where('id', (int) $postData->id)->delete();

        return Send::json([
            'status' => 'ok',
            'message' => 'Deleted successfuly'
        ]);
    }

    public static function allProduct()
    {
        $products = array_map(function ($product) {
            $ingredients = $product->getIngredients();
            return [...$product->setupImagePath()->toArray(), 'ingredients' => $ingredients, 'ingredientsQuantity' => count($ingredients)];
        }, Product::all()->get());

        return Send::json([
            'status' => 'ok',
            'data' => $products
        ]);
    }

    public static function infoProduct($id)
    {
        $product = Product::find((int) $id);

        return Send::json([
            'status' => 'ok',
            'data' => [...$product->setupImagePath()->toArray(), 'ingredients' => $product->getIngredients()]
        ]);
    }

    public static function storeUpdateProduct($postData)
    {
        if ($postData->action == 'create') {
            $imageName = strtolower(str_replace(' ', '_', $postData->data->name));
            Product::create([
                'name' => $postData->data->name,
                'category' => $postData->data->category,
                'image' => $imageName,
                'offer_id' => $postData->data->offer_id,
            ]);

            Storage::save('image', $imageName, 'product');
            foreach ($postData->data->ingredients as $ingredient) {
                $query = "INSERT INTO (product_id, ingredient_id, quantity) VALUES (?, ?, ?)";
                Database::execPrepared($query, [(int) $postData->id, (int) $ingredient->id, (int) $ingredient->quantity], 'iii');
            }
        } else {
            $imageName = strtolower(str_replace(' ', '_', $postData->data->name));
            if ($imageName != Product::find($postData->id)->image) {
                Storage::save('image', $imageName, 'product');
            }
            Product::where('id', $postData->id)
                ->set('name', $postData->data->name)
                ->set('category', $postData->data->category)
                ->set('image', $imageName)
                ->set('offer_id', $postData->data->offer_id)
                ->update();
            
            $query = "DELETE FROM products_ingredients WHERE id = ?";
            Database::execPrepared($query, [$postData->id], 'i');
            foreach ($postData->data->ingredients as $ingredient) {
                $query = "INSERT INTO products_ingredients (product_id, ingredient_id, quantity) VALUES (?, ?, ?)";
                Database::execPrepared($query, [(int) $postData->id, (int) $ingredient->id, (int) $ingredient->quantity], 'iii');
            }
        }

        return Send::json([
            'status' => 'ok',
            'message' => 'Product created/updated!'
        ]);
    }

    public static function destroyProduct($postData)
    {
        Product::where('id', (int) $postData->id)->delete();

        return Send::json([
            'status' => 'ok',
            'message' => 'Deleted successfuly'
        ]);
    }

    public static function allIngredient()
    {
        return Send::json([
            'status' => 'ok',
            'data' => array_map(
                function ($ingredient) {
                    return [...$ingredient->toArray(), 'imagePath' => $ingredient->getImage()];
                }
            , Ingredient::all()->get())
        ]);
    }

    public static function infoIngredient($id)
    {
        $ingredient = Ingredient::find((int) $id);

        return Send::json([
            'status' => 'ok',
            'data' => [...$ingredient->toArray(), 'imagePath' => $ingredient->getImage()]
        ]);
    }

    public static function storeUpdateIngredient($postData)
    {
        if ($postData->action == 'create') {
            $imageName = strtolower(str_replace(' ', '_', $postData->data->name));

            Ingredient::create([
                'name' => $postData->name,
                'price' => $postData->price,
                'image' => $postData->image,
            ]);

            Storage::save('image', $imageName, 'ingredient');
        } else {
            $imageName = strtolower(str_replace(' ', '_', $postData->data->name));
            if ($imageName != Ingredient::find($postData->id)->image) {
                Storage::save('image', $imageName, 'product');
            }

            Ingredient::where('id', $postData->id)
                ->set('name', $postData->data->name)
                ->set('price', $postData->data->price,)
                ->set('image', $postData->data->image)
                ->update();
        }

        return Send::json([
            'status' => 'ok',
            'message' => 'Ingredient created/updated!'
        ]);
    }

    public static function destroyIngredient($postData)
    {
        Ingredient::where('id', (int) $postData->id)->delete();

        return Send::json([
            'status' => 'ok',
            'message' => 'Ingredient destroyed successfuly'
        ]);
    }

    public static function allOrder()
    {
        $orders = array_map(function ($order) {
            return [...$order->toArray(), 'user' => $order->getUser()->toArray()];
        }, Order::all()->get());

        return Send::json([
            'status' => 'ok',
            'data' => $orders
        ]);
    }

    public static function infoOrder($id)
    {
        $order = Order::find((int) $id);   

        return Send::json([
            'status' => 'ok',
            'data' => [...$order->toArray(), 'user' => $order->getUser()->toArray()]
        ]);
    }

    public static function allLog()
    {
        $logs = array_map(function ($log) {
            return [...$log->toArray(), 'user' => $log->getUser()->toArray()];
        }, Log::all()->get());

        return Send::json([
            'status' => 'ok',
            'data' => $logs
        ]);
    }
}