<?php

namespace Framework\View;

use Framework\View\Printable;

class Component extends Printable {

    public function __construct(string $name, array | null $data = null, string $type = 'component')
    {
        $directory = '';

        if ($type == 'components') {
            $directory = 'components/';
        } else if ($type == 'layout') {
            $directory = 'layout/';
        }

        $path = self::VIEWS_PATH."/{$directory}" . str_replace('.', '/', $name).'.php';
        parent::__construct($path, $data);
        $this->show($this->path);
    }
}