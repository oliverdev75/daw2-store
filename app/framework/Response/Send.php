<?php

namespace Framework\Response;

use Framework\Response\Types\View;
use Framework\Response\Types\Json;
use Framework\Response\Types\Text;
use Framework\Response\Types\Redirection;

class Send {

    static function view(
        string $bodyContent,
        string $title = "SymfonyRestaurant",
        array | null $bodyData = null, 
        mixed $user = 'none',
        int $statusCode = 200
    ): View
    {
        return new View(
            $bodyContent,
            $title,
            $bodyData, 
            $user,
            $statusCode
        );
    }

    static function json(array $data, int $statusCode = 200): Json
    {
        return new Json($data, $statusCode);
    }

    static function text(string $text, int $statusCode = 200): Text
    {
        return new Text($text, $statusCode);
    }

    static function redirect(string $uri = '/'): Redirection
    {
        return new Redirection($uri);
    }
}