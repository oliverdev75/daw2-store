<?php

namespace Framework\Response\Types;

use Framework\Response\Response;

class Json {

    use Response;

    protected $headers = [];
    protected $content;

    function __construct(array $data, int $statusCode = 200)
    {
        $this->setStatusCode($statusCode);
        $this->allowOrigin();
        $this->allowHeaders();
        $this->allowMethods();
        $this->setContentType('application/json');
        $this->content = $data;
    }

    public function send()
    {
        $this->setHeaders();
        echo json_encode($this->content);
    }
}