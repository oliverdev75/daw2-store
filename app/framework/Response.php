<?php

namespace Framework;

use Framework\Response;

class Response {

    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * Get the value of view
     */ 
    public function getView()
    {
        return $this->view;
    }
}