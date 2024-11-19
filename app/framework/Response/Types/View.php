<?php

namespace Framework\Response\Types;

use Framework\View\Printable;
use Framework\Response\Response;

class View extends Printable {

    use Response;

    public function __construct(
        string $template,
        string $title = "SymfonyRestaurant",
        array | null $bodyData = null, 
        mixed $user = 'none',
        int $statusCode = 200
    )
    {
        $this->setStatusCode($statusCode);

        $path = \VIEWS_PATH.\VIEWS_LAYOUT_DIR.\VIEWS_TEMPLATE.'.php';
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

    protected function header(array | null $data = null): void
    {
        $this->component('header', $data, 'layout');
    }

    protected function footer(): void
    {
        $this->component('footer', [], 'layout');
    }
}