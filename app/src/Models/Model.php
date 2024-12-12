<?php

namespace App\Models;

use Framework\Database\Database;
use Framework\Database\QueryBuilder;

class Model extends Database
{

    static function create(array $values): void
    {
        $table = self::table(get_called_class());
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
                $typeIndicators .= 'f';
            }
        }

        self::execPrepared("insert into $table ($columns) values ($valuesBinders)", $data, $typeIndicators);
    }

    static function all(): QueryBuilder
    {
        /* $rows = self::queryObjects(
            "select * from " . self::table(get_called_class()),
            get_called_class()
        ); */

        return (new QueryBuilder(get_called_class()))->all();
    }

    static function find(int $id): Model
    {
        $query = new QueryBuilder(get_called_class());

        return $query->where('id', $id)->get()[0];
    }

    static function first(): Model
    {
        return (new QueryBuilder(get_called_class()))->all()->first();
    }

    static function where(...$args): QueryBuilder
    {
        $query = new QueryBuilder(get_called_class());

        return $query->where(...$args);
    }

    static function in(string $column, array $args): QueryBuilder
    {
        $query = new QueryBuilder(get_called_class());

        return $query->in($column, $args);
    }


    function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * Get the value of id
     */
    protected function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of creation_time;
     */
    protected function getCreationTime()
    {
        return date_parse($this->create_time);
    }
}
