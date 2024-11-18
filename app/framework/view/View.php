<?php

namespace Framework\View;

use Framework\View\Printable;
use Framework\Response\Response;

class View extends Printable implements Response {

    protected const TEMPLATE = 'template';

    public function __construct(
        string $template,
        string $title = "SymfonyRestaurant",
        array | null $bodyData = null, 
        mixed $user = 'none'
    )
    {        
        $path = self::VIEWS_PATH.'/layout/' . self::TEMPLATE.'.php';
        $templateParsedName = ".templates.$template";

        parent::__construct(
            $path,
            compact(
                'title',
                'templateParsedName',
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