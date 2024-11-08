<?php

namespace Framework\View;

use Framework\View\Component;

class Printable {

    protected const VIEWS_PATH = 'views';
    protected const RESOURCES_PATH = '/resources';
    protected $data;
    protected $path;

    public function __construct(string $path, array | null $data = null)
    {
        $this->data = $data;
        $this->path = $path;
    }

    function show($viewFile): void
    {
        if ($this->data) {
            foreach ($this->data as $key => $value) {
                ${$key} = $value;
            }
        }

        require_once($viewFile);
    }

    protected function image(string $name): string
    {
        return $this->resource('img', $name);
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
        $parsedName = str_replace('.', '/', $name);
        $extension = match ($type) {
            'img' => 'webp',
            default => $type
        };

        return '/'.self::VIEWS_PATH.self::RESOURCES_PATH."/{$type}/{$parsedName}.{$extension}";
    }

    protected function component(string $name, array | null $data = null, string $type = 'components'): Component
    {
        return new Component($name, $data, $type);
    }

    /**
     * Get the value of path
     */ 
    public function getPath()
    {
        return $this->path;
    }
}