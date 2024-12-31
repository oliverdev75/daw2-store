<?php

namespace Framework\View;

use Framework\Routing\Router;

class Printable
{

    protected const ASSETS_PATH = '/assets';
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

        require($viewFile);
    }

    protected function image(string $name): string
    {
        return $this->asset('img', $name);
    }

    protected function css(string $name): string
    {
        return $this->asset('css', $name);
    }

    protected function js(string $name): string
    {
        return $this->asset('js', $name);
    }

    protected function asset(string $type, string $name): string
    {
        $parsedName = str_replace('.', '/', $name);
        $extension = match ($type) {
            'img' => 'webp',
            default => $type
        };

        return self::ASSETS_PATH . "/{$type}/{$parsedName}.{$extension}";
    }

    protected function component(string $name, array | null $data = null, string $type = 'components'): Component
    {
        return new Component($name, $data, $type);
    }

    protected function route(string $routeName, ?array $params = null, ?array $queryParams = null): string
    {
        return Router::getRoute($routeName, $params, $queryParams);
    }

    /**
     * Get the value of path
     */
    public function getPath()
    {
        return $this->path;
    }
}
