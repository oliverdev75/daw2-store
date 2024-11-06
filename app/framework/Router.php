<?php

namespace Framework;

class Router {

    /**
     * Contains all registered routes assigned to all pages of the applcation.
     * @param array $routes
     */
    private static $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Cleans the given array, removing all empty positions and ordering indexes.
     * @param array $array the array to be cleaned
     * @return array the cleaned array
     */
    private static function cleanArray(array $array): array
    {
        $filledArraymethod = fn ($value) => $value !== false && $value !== '' && $value !== null;
        $filledArray = array_filter($array, $filledArraymethod);
        return array_values($filledArray);
    }

    /**
     * Assigns the given route with the given request method to an assignment reference,
     * which can be a function; which will be executed directly, and a string or array;
     * Which both will be processed to execut them.
     * @param string $method is the method that identifies the HTTP request type
     * @param string $route is the route which will be assigned to the corresponding webapp function
     * @param mixed $assignment is the reference to the assignment that will be executed when the route
     * will being accessed
     */
    public static function assignRoute(
        string $method,
        string $route,
        mixed $assignment
    ): void
    {
        self::$routes[strtoupper($method)][$route] = $assignment;
    }

    public static function get(string $route, mixed $assignment): void
    {
        self::assignRoute('GET', $route, $assignment);
    }

    public static function post(string $route, mixed $assignment): void
    {
        self::assignRoute('POST', $route, $assignment);
    }

    private static function matchRoute($reqRoute, $registeredRoute): bool
    {
        if ($reqRoute == $registeredRoute) {
            return true;
        }

        /* $dividedReqRoute = self::cleanArray(explode('/', $reqRoute));
        $dividedRegisteredRoute = self::cleanArray(explode('/', $registeredRoute)); */
        $dividedReqRoute = self::cleanArray(preg_split('/[\/\/]/', $reqRoute));
        $dividedRegisteredRoute = self::cleanArray(preg_split('/[\/\/]/', $reqRoute));

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

    private static function matchURLParams(string $reqRoute, string $matchedRoute): array
    {
        $params = [];

        $dividedReqRoute = self::cleanArray(explode('/', $reqRoute));
        $dividedMatchedRoute = self::cleanArray(explode('/', $matchedRoute));
        $bracketsOpen = -1;
        $bracketsClose = -1;
        $cleanParamKey = '';

        for ($i = 0; $i < count($dividedMatchedRoute); $i++) {
            $bracketsOpen = strpos($dividedMatchedRoute[$i], '{') == 0;
            $bracketsClose = strpos($dividedMatchedRoute[$i], '}') > 0;
            if ($bracketsOpen && $bracketsClose) {
                $cleanParamKey = self::cleanArray(preg_split('/[\{\}]/', $dividedMatchedRoute[$i]))[0];
                $params[$cleanParamKey] = $dividedReqRoute[$i];
            }
        }

        return $params;
    }

    private static function matchQueryParams($reqMethod): array
    {
        $params = [];
        $reqParams = [];
        if ($reqMethod == 'GET') {
            $reqParams = $_GET;
        } else if ($reqMethod == 'POST') {
            $reqParams = $_POST;
        }

        foreach ($reqParams as $key => $param) {
            $params[$key] = $param;
        }

        return $params;
    }

    private static function matchParams(string $reqRoute, string $matchedRoute, string $reqMethod): array
    {
        $params = [
            'URL' => [],
            'QUERY' => []
        ];
        
        
        $params['URL'] = self::matchURLParams($reqRoute, $matchedRoute);
        $params['QUERY'] = self::matchQueryParams($reqMethod);
        

        return $params;
    }

    private static function checkRoute(string $reqRoute, string $reqMethod)
    {
        $matchedRoute = '404';

        foreach (self::$routes[$reqMethod] as $registeredRoute => $assignment) {
            if (count(explode('/', $reqRoute)) != count(explode('/', $registeredRoute))) {
                continue;
            }
            if (self::matchRoute($reqRoute, $registeredRoute)) {
                $matchedRoute = $registeredRoute;
                break;
            }
        }

        return $matchedRoute;
    }

    private static function sendResponse(mixed $assignment, array $params)
    {
        if (is_array($assignment)) {
            $controller = new $assignment[0]();
            $method = $assignment[1];
            return $controller->$method(...$params);
        } else if (is_string($assignment)) {
            $callableAssignment = explode('@', $assignment);
            $method = $callableAssignment[1];
            $controller = new $callableAssignment[0]();
            return $controller->$method(...$params);
        } else if (is_callable($assignment)) {
            return $assignment(...$params);
        }
    }

    public static function enable()
    {
        $reqRoute = $_SERVER['REQUEST_URI'];
        $reqMethod = $_SERVER['REQUEST_METHOD'];
        $matchedRoute = self::checkRoute($reqRoute, $reqMethod);
        
        if ($matchedRoute == '404') {
            http_response_code(404);
            die;
        }

        $params = self::matchParams($reqRoute, $matchedRoute, $reqMethod);
        $allParams = array_merge($params['URL'], $params['QUERY']);
        $assignment = self::$routes[$reqMethod][$matchedRoute];
        
        return self::sendResponse($assignment, $allParams);
    }
}