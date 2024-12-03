<?php

namespace App\Models;

use Framework\Database\Database;
use Framework\Database\QueryBuilder;

class Model extends Database
{

    public int $id;

    static function all(): array
    {
        $rows = self::queryObjects(
            "select * from " . self::table(get_called_class()),
            get_called_class()
        );

        return $rows;
    }

    static function find(int $id): Model
    {
        $query = new QueryBuilder(get_called_class());

        return $query->where('id', $id)->get()[0];
    }

    static function where(...$args): QueryBuilder
    {
        $query = new QueryBuilder(get_called_class());

        return $query->where(...$args);
    }

    static function orWhere(...$args): QueryBuilder
    {
        $query = new QueryBuilder(get_called_class());

        return $query->orWhere(...$args);
    }

    static function in(string $column, array $args): QueryBuilder
    {
        $query = new QueryBuilder(get_called_class());

        return $query->in($column, $args);
    }


    function toArray(): array
    {
        $props = [];
        foreach ((new \ReflectionClass(get_called_class()))->getProperties() as $prop) {
            $propName = $prop->getName();
            $props[$propName] = $this->$propName;
        }

        $props['id'] = $this->getId();

        return $props;
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
        return $this->create_time;
    }
}
