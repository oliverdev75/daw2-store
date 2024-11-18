<?php

namespace Framework\Response;

use Framework\Response\Response;

class Json implements Response {

    protected $object;

    public function __construct(array $data)
    {
        $this->object = $data;
    }

    public function send()
    {
        echo json_encode($this->object);
    }
}