<?php

class Router {

    private static $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function assignRoute(
        string $method,
        string $route,
        string | array $assignment
    ): void
    {
        $routes[strtoupper($method)][$route] = $assignment;
    }

    public static function get(string $route, string | array $assignment): void
    {
        Router::assignRoute('GET', $route, $assignment);
    }

    public static function post(string $route, string | array $assignment): void
    {
        Router::assignRoute('POST', $route, $assignment);
    }

    public static function readParams() {
        $params = [];
        $dividedReqRoute = explode('', $_SERVER['REQUEST_URI']);
        $comparedRoute = $dividedReqRoute;
        $openningBracketsIndex = -1;
        $closingBracketsIndex = -1;
        
        foreach ($dividedReqRoute as $char) {
            if ($char == '{') {
                $openningBracketsIndex = array_search('{', $dividedReqRoute);
            } else if ($char == '}') {
                $closingBracketsIndex = array_search('}', $dividedReqRoute);
            }
        }

        for ($char = $openningBracketsIndex + 1; $char < $closingBracketsIndex; $char++) {
            
        }
    }

    public static function launch()
    {
        $params = null;
    }
}