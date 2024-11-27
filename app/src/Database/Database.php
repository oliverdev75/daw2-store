<?php

namespace App\Database;

use mysqli;
use mysqli_result;

class Database {

    protected $connection;
    protected $query;


    protected static function connect(): void
    {
        self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    }
    

    protected static function query(string $query, string $model): mixed
    {
        self::connect();
        self::$connection->query($query);

        return self::getObjects(self::$connection->get_result(), $model);
    }


    protected static function getObjects(mysqli_result $found, string $model): array
    {
        self::connect();
        $modelRows = [];
        while ($entity = $found->fetch_object($model)) {
            array_push($modelRows, $entity);
        }

        return $modelRows;
    }
}