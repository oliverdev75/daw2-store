<?php

namespace Framework\Database;

use LogicException;
use mysqli;
use mysqli_result;
use ReflectionClass;
use ReflectionProperty;

class Database
{

    private static $connection;
    private $query;

    protected static function table(string $name): string
    {
        return strtolower(explode('\\', $name)[count(explode('\\', $name)) - 1]).'s';
    }

    protected static function connect(): void
    {
        self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    }


    protected static function query(string $query, string $model): mixed
    {
        self::connect();
        $found = self::getObjects(self::$connection->query($query), $model);
        // var_dump($query);
        self::$connection->close();

        return $found;
    }

    protected function select(string $query, array $paramBinders, string $typeIndicators, string $model): array
    {
        self::connect();
        // $this->checkDataTypes($paramBinders, $model);
        $preparedQuery = $this->execPrepared($query, $paramBinders, $typeIndicators);
        // $this->query = $this->prepareQuery($query, $paramBinders);

        $found = $this->getObjects($preparedQuery->get_result(), $model);
        self::$connection->close();
        
        return $found;
    }

    protected function execPrepared(string $query, array $paramBinders, string $typeIndicators): \mysqli_stmt
    {
        self::connect();
        // $this->checkDataTypes($paramBinders, $model);
        $this->query = preg_replace('/(?J)[ ]+(?<columns>:([a-zA-Z]+)[0-9]?)[ ]{0,}/', ' ? ', $query);
        $preparedQuery = self::$connection->prepare($this->query);
        $preparedQuery->bind_param($typeIndicators, ...$paramBinders);
        var_dump($paramBinders, $typeIndicators);
        $preparedQuery->execute();
        var_dump($this->query);
        // $this->query = $this->prepareQuery($query, $paramBinders);
        
        return $preparedQuery;
    }


    protected static function getObjects(mysqli_result $found, string $model): array
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
