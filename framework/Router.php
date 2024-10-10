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

    private static function countDivisions(string $route): int
    {
        if ($dividedRoute = explode('/', $route)) {
            return count($dividedRoute);
        } else {
            return 0;
        }

        return $counter;
    }

    private static function matchRoute($reqRoute, $registeredRoute): bool
    {
        $dividedReqRoute = explode('/', $reqRoute);
        $dividedRegisteredRoute = explode('/', $registeredRoute);

        foreach ()
    }

    private static function checkRoute(string $reqRoute, string $reqMethod)
    {
        $params = [
            'URL' => [],
            'QUERY' => []
        ];


        foreach ($routes as $route) {
            if (Router::countDivisions($reqRoute) == Router::countDivisions($route)) {
                if ($reqRoute == '/') {
                    return '/';
                } else {

                }
            }
        }
    }

    public static function launch()
    {
        $reqRoute = $_SERVER['REQUEST_URI'];
        $reqMethod = $_SERVER['REQUEST_METHOD'];
        $params = Router::checkRoute($reqRoute, $reqMethod);
    }
}