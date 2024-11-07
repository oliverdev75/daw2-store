<?php

namespace Framework\View;

use Framework\View\Printable;

class Component extends Printable {

    public function __construct(string $name, array | null $data = null, string $type = 'components')
    {
        $path = self::VIEWS_PATH."/{$type}/" . str_replace('.', '/', $name).'.php';
        parent::__construct($path, $data);
        $this->show($this->path);
    }
}