<?php

namespace Framework\View;

use Framework\View\Printable;

class View extends Printable {

    public function __construct(string $name, array | null $data = null)
    {
        parent::__construct($name, $data);
    }

    protected function path(): string
    {
        return self::VIEWS_PATH.'/' . str_replace('.', '/', $this->name).'.php';
    }
}