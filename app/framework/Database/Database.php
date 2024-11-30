<?php

namespace Framework\Database;

use mysqli;
use mysqli_result;
use ReflectionClass;

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
        $exec = self::$connection->query($query);
        $found = self::getObjects($exec->get_result(), $model);
        $exec->close();

        return $found;
    }

    protected function execPrepared(string $query, array $paramBinders, string $model): array
    {
        self::connect();
        $prepQuery = null;
        $exec = $this->connection->query($query);
        $found = $this->getObjects($exec->get_results(), $model);
        $exec->close();

        return $found;
    }


    protected static function getObjects(mysqli_result $found, string $model): array
    {
        $modelRows = [];
        while ($entity = $found->fetch_object($model)) {
            array_push($modelRows, $entity);
        }

        return $modelRows;
    }

    private function checkDataTypes(array $paramBinders): void
    {
        $modelClass = new ReflectionClass(get_called_class());
        foreach ($modelClass->getProperties() as $prop) {
            if ($prop)
        }
    }
}