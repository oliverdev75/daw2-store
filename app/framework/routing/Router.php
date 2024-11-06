<?php

namespace Framework\Routing;

require_once(__DIR__.'/Route.php');
require_once(__DIR__.'/../Response.php');

use Framework\Routing\Route;
use Framework\Response;

class Router {

<<<<<<< HEAD:app/framework/routing/Router.php
    /**
     * Contains all registered routes assigned to all pages of the applcation.
     * @param array $routes
     */
    private static $routes = [];

    public static function get(string $name, string $route, mixed $assignment): void
=======
    private static $routes = [
        'GET' => [],
        'POST' => []
    ];

    private static function cleanArray(array $array): array
>>>>>>> 354e192 (Adding app fronted design):app/framework/Router.php
    {
        self::$routes[] = new Route($name, $route, 'GET', $assignment);
    }

<<<<<<< HEAD:app/framework/routing/Router.php
    public static function post(string $name, string $route, mixed $assignment): void
    {
        self::$routes[] = new Route($name, $route, 'POST', $assignment);
=======
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
>>>>>>> 354e192 (Adding app fronted design):app/framework/Router.php
    }

    public static function enable()
    {
<<<<<<< HEAD:app/framework/routing/Router.php
        $reqRoute = $_SERVER['REQUEST_URI'];
        $reqMethod = $_SERVER['REQUEST_METHOD'];
        $matchedRoute = self::checkRoute($reqRoute, $reqMethod);
        
        if ($matchedRoute == '404') {
            http_response_code(404);
            die;
        }

        $params = self::matchParams($reqRoute, $matchedRoute, $reqMethod);
        $allParams = array_merge($params['URL'], $params['QUERY']);
        
        return self::sendResponse($matchedRoute, $allParams);
=======
        Router::assignRoute('GET', $route, $assignment);
>>>>>>> 354e192 (Adding app fronted design):app/framework/Router.php
    }

    private static function checkRoute(string $reqRoute, string $reqMethod)
    {
<<<<<<< HEAD:app/framework/routing/Router.php
        $matchedRoute = '404';

        foreach (self::$routes as $route) {
            if ($route->getMethod() == $reqMethod)
            if (count(explode('/', $route->getUri())) != count(explode('/', $reqRoute))) {
                continue;
            }

            if (self::matchDivisions($reqRoute, $route->getUri())) {
                $matchedRoute = $route;
                break;
            }
        }

        return $matchedRoute;
=======
        Router::assignRoute('POST', $route, $assignment);
    }

    private static function countDivisions(string $route): int
    {
        return count(explode('/', $route));
>>>>>>> 354e192 (Adding app fronted design):app/framework/Router.php
    }

    private static function matchDivisions(string $reqRoute, string $registeredRoute): bool
    {
        if ($reqRoute == $registeredRoute) {
            return true;
        }

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

<<<<<<< HEAD:app/framework/routing/Router.php
    private static function sendResponse(Route $route, array $params)
    {
        $assignment = $route->getAssignment();

        if (is_array($assignment)) {
            $controller = new $assignment[0]();
            $function = $assignment[1];
            return new Response($controller->$function(...$params));
        } else if (is_string($assignment)) {
            $callableAssignment = explode('@', $assignment);
            $function = $callableAssignment[1];
            $controller = new $callableAssignment[0]();
            return new Response($controller->$function(...$params));
        } else if (is_callable($assignment)) {
            return new Response($assignment(...$params));
        }
    }

    private static function matchParams(string $reqRoute, Route $matchedRoute, string $reqMethod): array
=======
    private static function matchParams(string $reqRoute, string $matchedRoute, string $reqMethod): array
>>>>>>> 354e192 (Adding app fronted design):app/framework/Router.php
    {
        $params = [
            'URL' => [],
            'QUERY' => []
        ];
        
<<<<<<< HEAD:app/framework/routing/Router.php
        $params['URL'] = self::matchURLParams($reqRoute, $matchedRoute->getUri());
        $params['QUERY'] = self::matchQueryParams($reqMethod);
=======
        $dividedReqRoute = Router::cleanArray(explode('/', $reqRoute));
        $dividedMatchedRoute = Router::cleanArray(explode('/', $matchedRoute));
        $paramValueIndex = -1;
        
        foreach (Router::$routes[$reqMethod][$matchedRoute]['params'] as $paramKey) {
            $paramValueIndex = array_search('{'.$paramKey.'}', $dividedMatchedRoute);
            $params['URL'][] = $dividedReqRoute[$paramValueIndex];
        }
>>>>>>> 354e192 (Adding app fronted design):app/framework/Router.php

        return $params;
    }

<<<<<<< HEAD:app/framework/routing/Router.php
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
        if ($reqMethod == 'GET') {
            return $_GET;
        } else if ($reqMethod == 'POST') {
            return $_POST;
        }
    }

    
    /**
     * Cleans the given array, removing all empty positions and ordering indexes.
     * @param array $array the array to be cleaned
     * @return array the cleaned array
     */
    private static function cleanArray(array $array): array
    {
        $removeEmptiesFunc = fn ($value) => $value !== false && $value !== '' && $value !== null;

        return array_values(array_filter($array, $removeEmptiesFunc));
=======
    private static function checkRoute(string $reqRoute, string $reqMethod)
    {
        $matchedRoute = '404';

        foreach (Router::$routes[$reqMethod] as $registeredRoute => $assignment) {
            if (Router::countDivisions($reqRoute) != Router::countDivisions($registeredRoute)) {
                continue;
            }
            if (Router::matchRoute($reqRoute, $registeredRoute)) {
                $matchedRoute = $registeredRoute;
                break;
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
>>>>>>> 354e192 (Adding app fronted design):app/framework/Router.php
    }
}