<?php

namespace Framework\Response;

use Framework\Response\Response;

class Json {

    use Response;

    protected $content;

    function __construct(array $data)
    {
        $this->setContentType('application/json');
        $this->content = $data;
    }

    public function send()
    {
        echo json_encode($this->content);
    }
}