<?php

namespace App\Models;

use Framework\Database\Database;
use Framework\Database\QueryBuilder;

class Model extends Database
{

    protected static $table = null;

    public static function getLastId(): int
    {
        return (int) self::$connection->insert_id;
    }

    public static function create(array $values = []): void
    {
        $table = static::$table ?? self::table(get_called_class());
        $values['create_time'] = date('c');

        $data = array_values($values);
        $columns = rtrim(array_reduce(array_keys($values), fn($columnsLine, $value) => $columnsLine .= "{$value}, ", ''), ', ');
        $valuesBinders = rtrim(array_reduce($data, fn($binders, $value) => $binders .= "?, ", ''), ', ');
        $typeIndicators = '';

        foreach (array_values($values) as $value) {
            if (is_string($value)) {
                $typeIndicators .= 's';
            } else if (is_int($value)) {
                $typeIndicators .= 'i';
            } else if (is_float($value) || is_double($value)) {
                $typeIndicators .= 'd';
            }
        }

        self::execPrepared("insert into $table ($columns) values ($valuesBinders)", $data, $typeIndicators);
    }

    public static function all(): QueryBuilder
    {
        return (new QueryBuilder(static::$table ?? self::table(get_called_class()), get_called_class()))->all();
    }

    public static function find(int $id): Model
    {
        return (new QueryBuilder(static::$table ?? self::table(get_called_class()), get_called_class()))->where('id', $id)->first();
    }

    public static function first(): Model
    {
        return (new QueryBuilder(static::$table ?? self::table(get_called_class()), get_called_class()))->all()->first();
    }

    public static function where(...$args): QueryBuilder
    {
        return (new QueryBuilder(static::$table ?? self::table(get_called_class()), get_called_class()))->where(...$args);
    }

    public static function in(string $column, array $args): QueryBuilder
    {
        return (new QueryBuilder(static::$table ?? self::table(get_called_class()), get_called_class()))->in($column, $args);
    }


    function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of id
     */
    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of creation_time;
     */
    function getCreationTime()
    {
        return date_parse($this->create_time);
    }
}
