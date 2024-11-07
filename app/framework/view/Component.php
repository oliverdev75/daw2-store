<?php

namespace Framework\View;

use Framework\View\Printable;

class Component extends Printable {

    protected const COMPONENTS_PATH = '/components';

    public function __construct(string $name, array | null $data = null)
    {
        parent::__construct($name, $data);
        $this->show($this->path());
    }

    protected function path(): string
    {
        return '/'.self::VIEWS_PATH.self::COMPONENTS_PATH.'/' . str_replace('.', '/', $this->name).'.php';
    }
}