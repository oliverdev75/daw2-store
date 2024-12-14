<?php

namespace Framework\Database;

use LogicException;
use mysqli;
use mysqli_result;
use ReflectionClass;
use ReflectionProperty;

class Database
{

    protected static $connection;
    private static $query;

    protected static function table(string $name): string
    {
        return strtolower(explode('\\', $name)[count(explode('\\', $name)) - 1]) . 's';
    }

    protected static function connect(): void
    {
        self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT, DB_SOCKET);
    }

    static function query(string $query): mixed
    {
        self::connect();
        $result = self::$connection->query($query);
        self::$connection->close();

        return $result;
    }

    static function queryRows(string $query): mixed
    {
        self::connect();
        $result = self::$connection->query($query);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        self::$connection->close();

        return $rows;
    }

    protected static function queryObjects(string $query, string $model): mixed
    {
        self::connect();
        $found = self::parseObjects(self::$connection->query($query), $model);
        self::$connection->close();

        return $found;
    }

    protected function select(string $query, array $paramBinders, string $typeIndicators, string $model): array
    {
        self::connect();
        // $this->checkDataTypes($paramBinders, $model);
        $preparedQuery = $this->execPrepared($query, $paramBinders, $typeIndicators);
        // $this->query = $this->prepareQuery($query, $paramBinders);
        $found = $this->parseObjects($preparedQuery->get_result(), $model);
        self::$connection->close();

        return $found;
    }

    static function execPrepared(string $query, array $params, string $typeIndicators): \mysqli_stmt
    {
        self::connect();
        // $this->checkDataTypes($params, $model);
        self::$query = preg_replace('/(?J)[ ]+(?<columns>:[a-zA-Z0-9_]+)[ ]{0,}/', ' ? ', $query);
        $preparedQuery = self::$connection->prepare(self::$query);
        var_dump(self::$query);
        $preparedQuery->bind_param($typeIndicators, ...$params);
        $preparedQuery->execute();
        // $this->query = $this->prepareQuery($query, $params);


        return $preparedQuery;
    }

    protected static function parseObjects(mysqli_result $found, string $model): array
    {
        $modelRows = [];
        while ($modelUnit = $found->fetch_object($model)) {
            $modelRows[] = $modelUnit;
        }

        return $modelRows;
    }

    // private function checkDataTypes(array $paramBinders, string $model): void
    // {
    //     $modelClass = new ReflectionClass($model);
    //     $foundParam = null;

    //     foreach ($paramBinders as $param => $value) {
    //         foreach ($modelClass->getProperties() as $prop) {
    //             if ($prop->getName() == ltrim($param, ':')) {
    //                 $foundParam = $prop;
    //                 break;
    //             }
    //         }


    //         if (!$foundParam) {
    //             throw new LogicException("Model property not found.");
    //         }

    //         if ($foundParam->hasType()) {
    //             $givenParam = $paramBinders[':'.$foundParam->getName()];
    //             $propType = $foundParam->getType()->getName() == 'int' ? 'integer' : $foundParam->getType()->getName();
    //             if (gettype($givenParam) != $propType) {
    //                 throw new LogicException("Invalid data type in DB query.");
    //             }
    //         }
    //     }
    // }

    // private function prepareQuery(string $query, array $paramBinders): string
    // {
    //     $prepQuery = $query;
    //     preg_match_all('/(?J)[ ]+(?<columns>:([a-zA-Z]+)[0-9]?)[ ]{0,}/', $query, $columns);

    //     foreach ($columns['columns'] as $columnFilter) {
    //         $columnValue = gettype($paramBinders[$columnFilter]) == 'string' ? "'{$paramBinders[$columnFilter]}'" : $paramBinders[$columnFilter];
    //         $prepQuery = str_replace($columnFilter, $columnValue, $prepQuery);
    //     }

    //     return $prepQuery;
    // }
}
