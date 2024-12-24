<?php

namespace Framework\Response\Types;

use Framework\View\Printable;
use Framework\Response\Response;
use App\Controllers\UserController;

class View extends Printable
{

    use Response;

    private $headers = [];

    public function __construct(
        string $template,
        string $title = "SymfonyRestaurant",
        array | null $data = null,
        int $statusCode = 200,
        bool $httpAllowAll = false
    ) {
        $this->setStatusCode($statusCode);
        if ($httpAllowAll) {
            $this->allowOrigin();
            $this->setContentType('application/json');
        }

        $path = \VIEWS_PATH . \VIEWS_LAYOUT_DIR . \VIEWS_TEMPLATE . '.php';
        $templateParsedName = ".templates.$template";

        parent::__construct(
            $path,
            compact(
                'title',
                'templateParsedName',
                'data'
            )
        );
    }

    public function send()
    {
        $this->setHeaders();
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
