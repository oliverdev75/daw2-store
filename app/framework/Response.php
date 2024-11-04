<?php

namespace Framework;

use Framework\View\View;

class Response {

    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * Get the value of view
     */ 
    public function getView(): View
    {
        return $this->view;
    }
}