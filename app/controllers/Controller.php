<?php

namespace Controllers;

use Framework\View\View;

class Controller {

    public function view(
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
}