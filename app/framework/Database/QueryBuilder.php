<?php

namespace Framework\Database;

class QueryBuilder extends Database {
    
    protected $model;
    protected $paramBinders;
    protected $filterParams;
    protected $order = '';
    
    function __construct(string $model)
    {
        $this->model = $model;
    }

    private function table(): string
    {
        return strtolower($this->model);
    }

    function where(string $column, mixed $value): QueryBuilder
    {
        $this->setCondition($column, '=', $value, 'and');

        return $this;
    }

    function where(string $column, string $operator, mixed $value): QueryBuilder
    {
        $this->setCondition($column, $operator, $value, 'and');

        return $this;
    }

    function orWhere(string $column, mixed $value): QueryBuilder
    {
        $this->setCondition($column, '=', $value, 'or');
        
        return $this;
    }

    function orWhere(string $column, string $operator, mixed $value): QueryBuilder
    {
        $this->setCondition($column, $operator, $value, 'or');
        
        return $this;
    }

    function setCondition(string $column, string $condOperator, mixed $value, string $sequenceOperator): QueryBuilder
    {
        array_push($this->filterStrings, "$column $condOperator :$column $sequenceOperator");
        $dataType = 's';

        $this->paramBinders[":$column"] = $value;
    }

    function orderBy(string $column, string $order = ''): QueryBuilder
    {
        $this->order = " order by $column $order";

        return $this;
    }

    function get(): array
    {
         return $this->execPrepared(
            "select * from " . $this->table() . " where " . $this->parseFilterParams(),
            $this->paramBinders,
            $this->model
        );
    }

    private function parseFilterParams()
    {
        $string = implode(' ', $this->filterStrings);
        $andParsed = rtrim('and',$string);

        return rtrim('or', $string);
    }

}