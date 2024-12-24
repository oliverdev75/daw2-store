<?php

namespace Framework\Database;

use App\Models\Model;
use ReflectionClass;

class QueryBuilder extends Database
{

    protected $model;
    protected $table;
    protected $isFiltered = true;
    protected $conditionParams = [];
    protected $updateParams = [];
    protected $conditionParamBinders = [];
    protected $updateParamBinders = [];
    protected $updateTypeIndicators = '';
    protected $conditionTypeIndicators = '';
    protected $order = '';

    function __construct(string $table, string $model)
    {
        $this->table = $table;
        $this->model = $model;
    }

    function all(): self
    {
        $this->isFiltered = false;

        return $this;
    }

    function where(): self
    {
        $args = func_get_args();
        $column = $args[0];
        $value = '';
        $operator = '=';

        if (count($args) > 2) {
            $operator = $args[1];
            $value = $args[2];
        } else {
            $value = $args[1];
        }

        $this->setParam($column, $operator, $value, 'and');

        return $this;
    }

    function orWhere(): self
    {
        $args = func_get_args();
        $column = $args[0];
        $value = '';
        $operator = '=';

        if (count($args) > 2) {
            $operator = $args[1];
            $value = $args[2];
        } else {
            $value = $args[1];
        }

        $this->setParam($column, $operator, $value, 'or');

        return $this;
    }

    function in(string $column, array $values): self
    {
        $this->conditionParams[] = "and $column in(";
        $conditionPos = count($this->conditionParams) - 1;

        foreach ($values as $value) {
            if (is_string($value)) {
                $this->conditionTypeIndicators .= 's';
            } else if (is_int($value)) {
                $this->conditionTypeIndicators .= 'i';
            } else if (is_float($value)) {
                $this->conditionTypeIndicators .= 'd';
            }

            $this->conditionParams[$conditionPos] .= "?,";
            $this->conditionParamBinders[] = $value;
        }

        $this->conditionParams[$conditionPos] = rtrim($this->conditionParams[$conditionPos], ',');
        $this->conditionParams[$conditionPos] .= ')';

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $column
     * @param mixed $value
     * @return self
     */
    function set(string $column, mixed $value): self
    {
        $this->setParam($column, '=', $value);

        return $this;
    }


    /**
     * 
     * @param string $column
     * @param string $condOperator
     * @param mixed $value
     * @param string $sequenceOperator
     */
    private function setParam(string $column, string $condOperator, mixed $value, string $sequenceOperator = ', '): void
    {
        $typeIndicatorsProperty = 'conditionTypeIndicators';
        $paramsProperty = 'conditionParams';
        $paramBindersProperty = 'conditionParamBinders';

        if ($sequenceOperator == ', ') {
            $typeIndicatorsProperty = 'updateTypeIndicators';
            $paramsProperty = 'updateParams';
            $paramBindersProperty = 'updateParamBinders';
        }

        if (is_string($value)) {
            $this->$typeIndicatorsProperty .= 's';
        } else if (is_int($value)) {
            $this->$typeIndicatorsProperty .= 'i';
        } else if (is_float($value)) {
            $this->$typeIndicatorsProperty .= 'd';
        }

        array_push($this->$paramsProperty, "$sequenceOperator $column $condOperator :$column");
        array_push($this->$paramBindersProperty, $value);
    }


    /**
     * Undocumented function
     *
     * @param string $column
     * @param string $order
     * @return self
     */
    function orderBy(string $column, string $order = ''): self
    {
        $this->order = " order by $column $order";

        return $this;
    }

    function first(): Model | null
    {
        if ($found = $this->get()[0]) {
            return $found;
        }

        return null;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    function get(): array
    {
        $query = "select * from {$this->table}";
        $query .= $this->isFiltered ? " where {$this->parseFilterParams()}" : '';
        $query .= $this->order;

        if ($this->isFiltered) {
            return $this->filteredSelect(
                $query,
                array_merge($this->conditionParamBinders, $this->updateParamBinders),
                $this->conditionTypeIndicators . $this->updateTypeIndicators,
                $this->model
            );
        } else {
            return $this->select($query, $this->model);
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function update(): void
    {
        $this->execPrepared(
            "update {$this->table} set {$this->parseUpdateParams()} where {$this->parseFilterParams()}",
            array_merge($this->updateParamBinders, $this->conditionParamBinders),
            $this->updateTypeIndicators . $this->conditionTypeIndicators
        );
    }

    /**
     * 
     *
     * @return void
     */
    function delete(): void
    {
        $this->execPrepared(
            "delete from table {$this->table} where {$this->parseFilterParams()}",
            array_merge($this->conditionParamBinders, $this->updateParamBinders),
            $this->conditionTypeIndicators . $this->updateTypeIndicators
        );
    }

    function getQuery(): string
    {
        $query = " {$this->table}";

        if ($this->isFiltered) {
            $query .=  " where {$this->parseFilterParams()}";
        }

        return $query . $this->order;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function parseFilterParams()
    {
        $string = implode(' ', $this->conditionParams);
        $parsed = preg_replace('/^(and|or )/', '', $string);

        return $parsed;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function parseUpdateParams()
    {
        $string = implode(' ', $this->updateParams);
        $parsed = preg_replace('/^(, )/', '', $string);

        return $parsed;
    }
}
