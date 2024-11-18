<?php

namespace Framework\Routing;

use Framework\Routing\Router;

class Route {

    protected const API_PREFIX = '/api';

    protected $name;
    protected $type;
    protected $uri;
    protected $method;
    protected $assignment;

    public function __construct(string | null $name = null, string $uri, string $method, mixed $assignment, string $type)
    {
        $this->name = $name;
        $this->uri = $uri;
        $this->method = $method;
        $this->assignment = $assignment;
    }

    static function get(string $name, string $route, mixed $assignment, string $type = 'web'): Route
    {
        Router::instance()->createRoute(new self($name, $route, 'GET', $assignment, $type));
    }


    static function post(string $name, string $route, mixed $assignment, string $type = 'web'): Route
    {
        Router::instance()->createRoute(new self($name, $route, 'POST', $assignment, $type));
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
            return self::API_PREFIX.$this->uri;
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
     * Get the value of assignment
     */ 
    function getAssignment()
    {
        return $this->assignment;
    }
}