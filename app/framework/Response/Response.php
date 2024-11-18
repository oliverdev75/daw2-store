<?php

namespace Framework\Response;


trait Response {

    protected function setContentType(string $type = 'text/html; charset=UTF-8'): void
    {
        header("Content-Type: $type");
    }
}