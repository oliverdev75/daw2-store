<?php

namespace App\Database;

abstract class Model extends Database {

    protected static function all(): array
    {
        $rows = self::query(
            "select * from " . strtolower(get_called_class()),
            get_called_class()
        );

        self::$connection->close();
        
        return $rows;
    }

    abstract static function filter(): array;

    protected static function find(int $id): Model
    {
        self::$connection->prepare('select * from ' . strtolower(get_called_class()) . ' where id = ?');
        self::$connection->bind_param('i', $id);
        self::$connection->execute();

        return self::getObjects(self::$connection->get_result(), get_called_class())[0];
    }

}