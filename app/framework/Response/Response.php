<?php

namespace Framework\Response;


trait Response {

    protected function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    protected function allowOrigin(string $origin = '*'): void
    {
        $this->headers[] = "Access-Control-Allow-Origin: $origin";
    }

    protected function allowHeaders(array $headers = ['Content-Type', 'Access-Control-Allow-Headers', 'Authorization', 'X-Requested-With']): void
    {
        $headersString = join(', ', $headers);
        $this->headers[] = "Access-Control-Allow-Headers: $headersString";
    }

    protected function allowMethods(array $origin = ['GET', 'POST', 'PUT', 'DELETE']): void
    {
        $originString = join(', ', $origin);
        $this->headers[] = "Access-Control-Allow-Methods: $originString";
    }

    protected function setContentType(string $type = 'text/html; charset=UTF-8'): void
    {
        $this->headers[] = "Content-Type: $type";
    }

    protected function setHeaders(): void
    {
        foreach ($this->headers as $header) {
            header($header);
        }
    }

}