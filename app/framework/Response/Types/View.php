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
        string $userRole = 'client',
        int $statusCode = 200
    ) {
        $this->setStatusCode($statusCode);
        $path = VIEWS_PATH . VIEWS_LAYOUT_DIR . ($userRole == 'client' ? VIEWS_CLIENT_TEMPLATE : VIEWS_ADMIN_TEMPLATE) . '.php';
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
}
