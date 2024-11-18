<?php

namespace Framework\Response;

class Text {
    
    use Response;

    protected $content;

    function __construct(string $text)
    {
        $this->content = $text;
    }

    public function send()
    {
        echo $this->content;
    }
}