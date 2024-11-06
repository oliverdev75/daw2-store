<?php

namespace Controllers;

use Framework\View\View;

class Controller {

    public function view(string $name, array $data): View
    {
        return new View($name, $data);
    }
}