<?php

namespace Controllers;

use Framework\View\View;
use Framework\Response\Json;

class Controller {

    protected function view(
        string $bodyContent,
        string $title = "SymfonyRestaurant",
        array | null $bodyData = null, 
        mixed $user = 'none'
    ): View
    {
        return new View(
            $bodyContent,
            $title,
            $bodyData, 
            $user
        );
    }

    protected function json(array $data): Json
    {
        return new Json($data);
    } 
}