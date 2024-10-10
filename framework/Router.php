<?php

namespace Framework;

class Router {

    private static $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function assignRoute(
        string $method,
        string $route,
        mixed $assignment
    ): void
    {
        Router::$routes[strtoupper($method)][$route]['assignment'] = $assignment;
        
        foreach (explode('/', $route) as $division) {
            if (strpos($division, '{') && strpos($division, '}')) {
                Router::$routes[strtoupper($method)][$route]['params'][] = explode('{', explode('}', $division)[0])[0];
            }
        }
    }

    public static function get(string $route, mixed $assignment): void
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
        
        for ($i = 0; $i < count($dividedReqRoute); $i++) {
            if (strpos($dividedRegisteredRoute[$i], '{') != false && strpos($dividedRegisteredRoute[$i], '}') != false) {
                continue;
            }
            if ($i == count($dividedReqRoute) - 1) {
                echo "<br><br>final<br><br>";
            }
            echo "<br><br><h2>$i</h2>";
            echo "<b>Req route:</b> $dividedRegisteredRoute[$i]";
            echo "<br><b>Regist route:</b> $dividedReqRoute[$i]";
            if ($dividedReqRoute[$i] != $dividedRegisteredRoute[$i]) {
                return false;
            }
        }

        return true;
    }

    private static function matchParams(string $reqRoute, string $matchedRoute, string $reqMethod): array
    {
        $params = [
            'URL' => [],
            'QUERY' => []
        ];

        $dividedReqRoute = explode('/', $reqRoute);
        $dividedMatchedRoute = explode('/', $matchedRoute);
        $paramValueIndex = -1;

        foreach (Router::$routes[strtoupper($reqMethod)][$matchedRoute]['params'] as $paramKey) {
            $paramValueIndex = array_search("\{$paramKey\}", $dividedMatchedRoute);
            $params['URL'][] = $dividedReqRoute[$paramValueIndex];
        }

        return $params;
    }

    private static function checkRoute(string $reqRoute, string $reqMethod)
    {
        $matchedRoute = '404';

        foreach (Router::$routes[$reqMethod] as $registeredRoute => $assignment) {
            if (Router::countDivisions($reqRoute) != Router::countDivisions($registeredRoute)) {
                continue;
            }
            if (Router::matchRoute($reqRoute, $registeredRoute)) {
                $matchedRoute = $registeredRoute;
            }
        }

        return $matchedRoute;
    }

    public static function enable()
    {
        $reqRoute = $_SERVER['REQUEST_URI'];
        $reqMethod = $_SERVER['REQUEST_METHOD'];
        $matchedRoute = Router::checkRoute($reqRoute, $reqMethod);

        if ($matchedRoute == '404') {
            http_response_code(404);
            die;
        }

        $params = Router::matchParams($reqRoute, $matchedRoute, $reqMethod);
        $allParams = array_merge($params['URL'], $params['QUERY']);
        $assignment = Router::$routes[$reqMethod][$matchedRoute]['assignment'];

        if (is_array($assignment)) {
            $controller = new $assignment[0]();
            return $controller->$assignment[1](...$allParams);
        } else if (is_string($assignment)) {
            $callableAssignment = explode('@', $assignment);
            $controller = new $callableAssignment[0]();
            return $controller->$callableAssignment[1](...$allParams);
        } else if (is_callable($assignment)) {
            return $assignment(...$allParams);
        }
    }
}