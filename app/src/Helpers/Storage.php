<?php

namespace App\Helpers;

class Storage
{
    public static function save($tmp, $filename, $model)
    {
        $path = STORAGE.match($model) {
            'user' => USERS_IMAGES,
            'product' => PRODUCT_IMAGES,
            'ingredient' => INGREDIENTS_IMAGES,
        }.$filename;
        move_uploaded_file($_FILES[$tmp]['tmp_name'], $path);
    }
}