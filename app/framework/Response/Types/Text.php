<?php

namespace Framework\Response\Types;

use Framework\Response\Response;

class Text {
    
    use Response;

    protected $content;

    function __construct(string $text, int $statusCode = 200)
    {
        $this->setStatusCode($statusCode);
        $this->content = $text;
    }

    public function send()
    {
        echo $this->content;
    }
}