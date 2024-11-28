<?php

namespace App\Database;

use Framework\Database\Database;
use Framework\Database\QueryBuilder;

class Model extends Database {

    protected static function all(): array
    {
        $rows = self::query(
            "select * from " . strtolower(get_called_class()),
            get_called_class()
        );

        self::$connection->close();
        
        return $rows;
    }

    protected static function find(int $id): Model
    {
        $query = new QueryBuilder(get_called_class());

        return $query->where('id', $id)->get()[0];
    }

}