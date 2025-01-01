<?php

namespace App\Controllers;

use Framework\Response\Send;
use App\Models\User;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\Order;

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
        if ($postData['action'] == 'create') {
            User::create([
                'name' => $postData['name'],
                'surnames' => $postData['surnames'],
                'email' => $postData['email'],
                'role' => $postData['role'],
                'password' => password_hash($postData['password'], PASSWORD_BCRYPT)
            ]);
        } else {
            User::where('id', $postData['id'])
                ->set('name', $postData['data']['name'])
                ->set('surnames', $postData['data']['surnames'])
                ->set('email', $postData['data']['email'])
                ->set('password', password_hash($postData['data']['password'], PASSWORD_BCRYPT))
                ->set('role', $postData['data']['role'])
                ->update();
        }

        return Send::json([
            'status' => 'ok',
            'message' => 'User created/updated!'
        ]);
    }

    public static function deleteUser($postData)
    {
        User::where('id', (int) $postData['id'])->delete();

        return Send::json([
            'status' => 'ok',
            'message' => 'Deleted successfuly'
        ]);
    }

    public static function allProduct()
    {
        $products = array_map(function ($product) {
            return [...$product->toArray(), 'ingredients' => $product->getIngredients()];
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
            'data' => [...$product->toArray(), 'ingredients' => $product->getIngredients()]
        ]);
    }

    public static function storeUpdateProduct($postData)
    {
        if ($postData['action'] == 'create') {
            Product::create([
                'name' => $postData['name'],
                'category' => $postData['category'],
                'offer_id' => $postData['offer_id'],
            ]);
        } else {
            Product::where('id', $postData['id'])
                ->set('name', $postData['data']['name'])
                ->set('category', $postData['data']['category'])
                ->set('offer_id', $postData['data']['offer_id'])
                ->update();
        }

        return Send::json([
            'status' => 'ok',
            'message' => 'Product created/updated!'
        ]);
    }

    public static function deleteProduct($postData)
    {
        Product::where('id', (int) $postData['id'])->delete();

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
        if ($postData['action'] == 'create') {
            Ingredient::create([
                'name' => $postData['name'],
                'price' => $postData['price'],
                'image' => $postData['image'],
            ]);
        } else {
            Ingredient::where('id', $postData['id'])
                ->set('name', $postData['data']['name'])
                ->set('price', password_hash($postData['data']['price'], PASSWORD_BCRYPT))
                ->set('image', $postData['data']['image'])
                ->update();
        }

        return Send::json([
            'status' => 'ok',
            'message' => 'Ingredient created/updated!'
        ]);
    }

    public static function deleteIngredient($postData)
    {
        Ingredient::where('id', (int) $postData['id'])->delete();

        return Send::json([
            'status' => 'ok',
            'message' => 'Ingredient deleted successfuly'
        ]);
    }

    public static function allOrder()
    {
        return Send::json([
            'status' => 'ok',
            'data' => Order::all()->get()
        ]);
    }

    public static function infoOrder($id)
    {
        $order = Order::find((int) $id);
        $user = User::find((int) $order->getId());

        

        return Send::json([
            'status' => 'ok',
            'data' => [...$order->toArray(), 'user' => $user->toArray()]
        ]);
    }
}