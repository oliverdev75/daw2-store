<?php

namespace Framework\Response\Types;

use Framework\Routing\Router;

class Redirection {

    protected $uri;

    function __construct(string $uri = '/')
    {
        $this->uri = $uri;    
    }

    function route(string $routeName, ?array $params = null, ?array $queryParams = null): self
    {
        $this->uri = Router::getRoute($routeName, $params, $queryParams);
        return $this;
    }

    public function send(): void
    {
        header("Location: {$this->uri}");
    }
}