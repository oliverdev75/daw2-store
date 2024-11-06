<?php

namespace Framework\View;

use Framework\View\Printable;

class View extends Printable {

    protected const TEMPLATE = self::VIEWS_PATH.'/layout/template.php';

    public function __construct(string $name, string $title, array | null $data = null)
    {
        $viewData = [
            'title' => $title,
            'body' => $name,
            'body_data' => $data
        ];
        parent::__construct(self::TEMPLATE, $viewData);
    }

    protected function path(): string
    {
        return self::VIEWS_PATH.'/' . str_replace('.', '/', $this->name).'.php';
    }

    protected function meta(array | null $data = null): void
    {
        $this->component('layout.meta', $data);
    }

    protected function header(array | null $data = null): void
    {
        $this->component('layout.header', $data);
    }

    protected function footer(array | null $data = null): void
    {
        $this->component('layout.footer', $data);
    }
}