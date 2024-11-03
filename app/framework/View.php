<?php

namespace Framework;

class View {

    protected const VIEWS_PATH = 'views';
    protected $name;
    protected $data;

    public function __construct(string $name, array | null $data = null)
    {
        $this->name = $name;
        $this->data = $data;
    }

    function show()
    {
        if ($this->data) {
            foreach ($this->data as $key => $value) {
                ${$key} = $value;
            }
        }

        require_once($this->path());
    }

    function path()
    {
        return self::VIEWS_PATH.'/' . str_replace('.', '/', $this->name).'.php';
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }
}