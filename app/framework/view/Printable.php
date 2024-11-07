<?php

namespace Framework\View;

use Framework\View\Component;

abstract class Printable {

    protected const VIEWS_PATH = 'views';
    protected const RESOURCES_PATH = '/resources';
    protected $name;
    protected $data;

    public function __construct(string $name, array | null $data = null)
    {
        $this->name = $name;
        $this->data = $data;
    }

    abstract protected function path();

    function show($viewFile): void
    {
        if ($this->data) {
            foreach ($this->data as $key => $value) {
                ${$key} = $value;
            }
        }

        require_once($viewFile);
    }

    protected function css(string $name): string
    {
        return $this->resource('css', $name);
    }

    protected function js(string $name): string
    {
        return $this->resource('js', $name);
    }

    protected function resource(string $type, string $name): string
    {
        return '/'.self::VIEWS_PATH.self::RESOURCES_PATH."/{$type}/{$name}.{$type}";
    }

    protected function component(string $name, array | null $data = null): Component
    {
        return new Component($name, $data);
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }
}