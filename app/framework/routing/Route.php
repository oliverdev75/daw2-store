<?php

namespace Framework\Routing;

class Route {

    protected $name;
    protected $uri;
    protected $method;
    protected $assignment;

    public function __construct(string | null $name = null, string $uri, string $method, mixed $assignment)
    {
        $this->name = $name;
        $this->uri = $uri;
        $this->method = $method;
        $this->assignment = $assignment;
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
     * Get the value of uri
     */ 
    function getUri()
    {
        return $this->uri;
    }

    /**
     * Get the value of method
     */ 
    public function getMethod()
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