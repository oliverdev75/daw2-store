<?php

namespace Framework\Database;


class QueryBuilder extends Database
{

    protected $model;
    protected $filterParams = [];
    protected $updateParams = [];
    protected $paramBinders;
    protected $updateTypeIndicators;
    protected $typeIndicators = '';
    protected $order = '';

    function __construct(string $model)
    {
        $this->model = $model;
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
        $this->filterParams[] = "and $column in(";
        $conditionPos = count($this->filterParams) - 1;

        foreach ($values as $value) {
            if (is_string($value)) {
                $this->typeIndicators .= 's';
            } else if (is_int($value)) {
                $this->typeIndicators .= 'i';
            } else if (is_float($value)) {
                $this->typeIndicators .= 'f';
            }

            $this->filterParams[$conditionPos] .= "?,";
            $this->paramBinders[] = $value;
        }

        $this->filterParams[$conditionPos] = rtrim($this->filterParams[$conditionPos], ',');
        $this->filterParams[$conditionPos] .= ')';

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
        if (is_string($value)) {
            $this->typeIndicators .= 's';
        } else if (is_int($value)) {
            $this->typeIndicators .= 'i';
        } else if (is_float($value)) {
            $this->typeIndicators .= 'f';
        }

        if ($sequenceOperator != ', ') {
            $this->filterParams[] = "$sequenceOperator $column $condOperator :$column";
        } else {
            $this->updateParams[] = "$sequenceOperator $column $condOperator :$column";
        }

        $this->paramBinders[] = $value;
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

    /**
     * Undocumented function
     *
     * @return array
     */
    function get(): array
    {
        return $this->select(
            "select * from {$this->table($this->model)} where {$this->parseFilterParams()}",
            $this->paramBinders,
            $this->typeIndicators,
            $this->model
        );
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    function update(): void
    {
        $this->execPrepared(
            "update {$this->table($this->model)} set {$this->parseUpdateParams()} where {$this->parseFilterParams()}",
            $this->paramBinders,
            $this->typeIndicators
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
            "delete from table {$this->table($this->model)} where {$this->parseFilterParams()}",
            $this->paramBinders,
            $this->typeIndicators
        );
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function parseFilterParams()
    {
        $string = implode(' ', $this->filterParams);
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
