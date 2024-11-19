<?php

namespace Framework\Routing;

class Route {

    protected static $collection = [];

    protected $name;
    protected $type;
    protected $uri;
    protected $method;
    protected $action;

    private function __construct(string | null $name = null, string $uri, string $method, mixed $action, string $type)
    {
        $this->name = $name;
        $this->uri = $uri;
        $this->type = $type;
        $this->method = $method;
        $this->action = $action;
    }

    static function getCollection(): array
    {
        return self::$collection;
    }

    static function emptyCollection(): void
    {
        self::$collection = [];
    }

    static function get(string $name, string $route, mixed $action, string $type = 'web'): void
    {
        array_push(self::$collection, new self($name, $route, 'GET', $action, $type));
    }


    static function post(string $name, string $route, mixed $action, string $type = 'web'): void
    {
        array_push(self::$collection, new self($name, $route, 'POST', $action, $type));
    }

    static function controller(string $controller, callable $routesExec): void
    {
        self::catchRoutes($routesExec, function (Route $catched) use ($controller) {
            return $catched->setAction([$controller, $catched->getAction()]);
        });
    }

    private static function catchRoutes(callable $registerRoutesFunc, callable $callback): void
    {
        $newRoutesStart = count(self::$collection);
        $registerRoutesFunc();
        
        for ($i = $newRoutesStart; $i < count(self::$collection); $i++) {
            self::$collection[$i] = $callback(self::$collection[$i]);
        }
    }

    /**
     * Get the value of name
     */ 
    function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of uri
     */ 
    function getUri()
    {
        if ($this->type == 'web') {
            return $this->uri;
        } else {
            return \API_PREFIX.$this->uri;
        }
    }

    /**
     * Get the value of method
     */ 
    function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Get the value of action
     */ 
    function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return  self
     */ 
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }
}