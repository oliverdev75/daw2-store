<?php

namespace Framework\View;

use Framework\View\Printable;

class View extends Printable {

    protected const TEMPLATE = 'layout.template';

    public function __construct(
        string $bodyContent,
        string $title = "SymfonyRestaurant",
        array | null $bodyData = null, 
        mixed $user = 'none'
    )
    {        
        $path = self::VIEWS_PATH.'/' . str_replace('.', '/', self::TEMPLATE).'.php';

        parent::__construct(
            $path,
            compact(
                'title',
                'bodyContent',
                'bodyData',
                'user'
            )
        );
    }

    public function send()
    {
        $this->show($this->path);
    }

    protected function meta(array | null $data = null): void
    {
        $this->component('meta', $data, 'layout');
    }

    protected function header(array | null $data = null): void
    {
        $this->component('header', $data, 'layout');
    }

    protected function footer(): void
    {
        $this->component('footer', [], 'layout');
    }
}