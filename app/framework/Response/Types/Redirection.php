<?php

namespace Framework\Response\Types;

use Framework\Routing\Router;

class Redirection {

    protected $uri;

    function __construct(string $uri = '/')
    {
        $this->uri = $uri;    
    }

    function route(string $routeName): self
    {
        $this->uri = Router::getRoute($routeName);
        return $this;
    }

    public function send(): void
    {
        header("Location: {$this->uri}");
    }
}