<?php

namespace Framework;

class Router {

    private static $routes = [
        'GET' => [],
        'POST' => []
    ];

    private static function cleanArray(array $array): array
    {
        $filledArraymethod = fn ($value) => $value !== false && $value !== '' && $value !== null;
        $filledArray = array_filter($array, $filledArraymethod);
        return array_values($filledArray);
    }

    public static function assignRoute(
        string $method,
        string $route,
        mixed $assignment
    ): void
    {
        Router::$routes[strtoupper($method)][$route]['assignment'] = $assignment;
        Router::$routes[strtoupper($method)][$route]['params'] = [];
        $bracketsOpenPos = -1;
        $bracketsClosePos = -1;
        $cleanArrayParam = [];

        foreach (explode('/', $route) as $division) {
            $bracketsOpenPos = strpos($division, '{') == 0;
            $bracketsClosePos = strpos($division, '}') > 0;
            if ($bracketsOpenPos && $bracketsClosePos) {
                $cleanArrayParam = Router::cleanArray(preg_split('/[\{\}]/', $division));
                Router::$routes[strtoupper($method)][$route]['params'][] = $cleanArrayParam[0];
            }
        }
    }

    public static function get(string $route, mixed $assignment): void
    {
        Router::assignRoute('GET', $route, $assignment);
    }

    public static function post(string $route, mixed $assignment): void
    {
        Router::assignRoute('POST', $route, $assignment);
    }

    private static function countDivisions(string $route): int
    {
        if ($dividedRoute = preg_split('/[\/]/', $route)) {
            return count($dividedRoute);
        } else {
            return 0;
        }

        return $counter;
    }

    private static function matchRoute($reqRoute, $registeredRoute): bool
    {
        $dividedReqRoute = Router::cleanArray(explode('/', $reqRoute));
        $dividedRegisteredRoute = Router::cleanArray(explode('/', $registeredRoute));
        
        $bracketsOpenPos = -1;
        $bracketsClosePos = -1;
        
        for ($i = 0; $i < count($dividedReqRoute); $i++) {
            $bracketsOpenPos = strpos($dividedRegisteredRoute[$i], '{') == 0;
            $bracketsClosePos = strpos($dividedRegisteredRoute[$i], '}') > 0;

            if ($bracketsOpenPos && $bracketsClosePos) {
                continue;
            }
            
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
        
        $dividedReqRoute = Router::cleanArray(explode('/', $reqRoute));
        $dividedMatchedRoute = Router::cleanArray(explode('/', $matchedRoute));
        $paramValueIndex = -1;
        
        foreach (Router::$routes[$reqMethod][$matchedRoute]['params'] as $paramKey) {
            $paramValueIndex = array_search('{'.$paramKey.'}', $dividedMatchedRoute);
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
            $method = $assignment[1];
            return $controller->$method(...$allParams);
        } else if (is_string($assignment)) {
            $callableAssignment = explode('@', $assignment);
            $method = $callableAssignment[1];
            $controller = new $callableAssignment[0]();
            return $controller->$method(...$allParams);
        } else if (is_callable($assignment)) {
            return $assignment(...$allParams);
        }
    }
}