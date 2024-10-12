<?php

class Controller {

    public function view(string $path, array $data)
    
    {

        require_once("views/$path.php");
    }
}