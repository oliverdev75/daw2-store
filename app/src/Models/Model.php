<?php

namespace App\Models;

use Framework\Database\Database;
use Framework\Database\QueryBuilder;

class Model extends Database
{

    private const USERS_IMAGES = '/users';
    private const PRODUCTS_IMAGES = '/products';
    private const INGREDIENTS_IMAGES = '/ingredients';

    protected static $table = null;

    private static function table()
    {
        return static::$table ?? self::makeTable(get_called_class());
    }

    private static function builder()
    {
        return new QueryBuilder(self::table(), get_called_class());
    }

    public static function getLastId(): int
    {
        return self::query('SELECT MAX(id) FROM '.self::table())->fetch_column();
    }

    public static function create(array $values = []): void
    {
        $table = self::table();
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
        return self::builder()->all();
    }

    public static function find(int $id): mixed
    {
        return self::builder()->where('id', $id)->first();
    }

    public static function first(): mixed
    {
        return self::builder()->all()->first();
    }

    public static function where(...$args): QueryBuilder
    {
        return self::builder()->where(...$args);
    }

    public static function in(string $column, array $args): QueryBuilder
    {
        return self::builder()->in($column, $args);
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

    function getImage()
    {
        return STORAGE. match ($this->table()) {
            'users' => self::USERS_IMAGES,
            'products' => self::PRODUCTS_IMAGES,
            'ingredients' => self::INGREDIENTS_IMAGES,
        } ."/{$this->image}.webp";
    }
}
