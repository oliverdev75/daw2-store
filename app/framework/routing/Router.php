<?php

namespace Framework\Routing;

require_once(__DIR__.'/Route.php');

use Framework\Routing\Route;

class Router {

    /**
     * Is the instance of the Router created once the web is starting.
     * @param Router $singleton
     */
    static $singleton = null;

    /**
     * Contains all registered routes assigned to all resources of the application.
     * @param array $routes
     */
    private $routes = [];

    public function __construct()
    {
        $this->getWebRoutes();
        $this->getApiRoutes();
    }


    static function instance()
    {
        if (!self::$singleton) {
            self::$singleton = new self;
        }
        
        return self::$singleton;
    }


    function createRoute(Route $route): void
    {
        array_push($this->routes, $route);
    }


    function getWebRoutes(): void
    {
        require('routes/web.php');
    }


    function getApiRoutes(): void
    {
        $regiterRoutes = fn() => require('routes/api.php');
        $this->catchRoutes($registerRoutes, function (Route $catched) {
            $catched->setType('api');

            return $catched;
        });
    }


    function catchRoutes(callable $registerRoutesFunc, callable $callback): void
    {
        $routesQuantBeforeAdding = count($this->routes);
        $registerRoutesFunc();

        for ($i = $routesQuantBeforeAdding - 1; $i < count($this->routes); $i++) {
            $this->routes[$i] = $callback($this->routes[$i]);
        }
    }


    static function enable(): Response
    {
        $reqRoute = $_SERVER['REQUEST_URI'];
        $reqMethod = $_SERVER['REQUEST_METHOD'];
        $matchedRoute = $this->checkRoute($reqRoute, $reqMethod);
        
        if ($matchedRoute == '404') {
            http_response_code(404);
            die;
        }

        $params = $this->matchParams($reqRoute, $matchedRoute, $reqMethod);
        $allParams = array_merge($params['URL'], $params['QUERY']);
        
        return $this->sendResponse($matchedRoute, $allParams);
    }


    private static function checkRoute(string $reqRoute, string $reqMethod)
    {
        $matchedRoute = '404';

        foreach ($this->$routes as $route) {
            if ($route->getMethod() == $reqMethod) {
                if (count(explode('/', $route->getUri())) != count(explode('/', $reqRoute))) {
                    continue;
                }
    
                if ($this->matchRoute($reqRoute, $route->getUri())) {
                    $matchedRoute = $route;
                    break;
                }
            }
        }

        return $matchedRoute;
    }


    private static function matchRoute(string $reqRoute, string $registeredRoute): bool
    {
        if ($reqRoute == $registeredRoute) {
            return true;
        }

        $dividedReqRoute = Router::cleanArray(explode('/', $reqRoute));
        $dividedRegisteredRoute = Router::cleanArray(explode('/', $registeredRoute));

        return $this->matchDivisions($dividedReqRoute, $dividedRegisteredRoute);
    }


    private static function matchDivisions(array $dividedReqRoute, array $dividedRegisteredRoute): bool
    {
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
        return [
            'URL' => $this->matchURLParams($reqRoute, $matchedRoute),
            'QUERY' => $this->matchQueryParams($reqMethod, $matchedRoute)
        ];
    }


    private static function matchURLParams(string $reqRoute, string $matchedRoute): array
    {
        $params = [];

        $dividedReqRoute = $this->cleanArray(explode('/', $reqRoute));
        $dividedMatchedRoute = $this->cleanArray(explode('/', $matchedRoute->getUri()));
        $bracketsOpen = -1;
        $bracketsClose = -1;
        $cleanParamKey = '';

        for ($i = 0; $i < count($dividedMatchedRoute); $i++) {
            $bracketsOpen = strpos($dividedMatchedRoute[$i], '{') == 0;
            $bracketsClose = strpos($dividedMatchedRoute[$i], '}') > 0;
            if ($bracketsOpen && $bracketsClose) {
                $cleanParamKey = $this->cleanArray(preg_split('/[\{\}]/', $dividedMatchedRoute[$i]))[0];
                $params[$cleanParamKey] = $dividedReqRoute[$i];
            }
        }

        return $params;
    }


    private static function matchQueryParams(string $reqMethod, Route $matchedRoute): array
    {
        if ($reqMethod == 'GET') {
            return $_GET;
        } else if ($reqMethod == 'POST') {
            if ($matchedRoute->getType() == 'web') {
                return $_POST;
            } else {
                return json_decode(file_get_contents('php://input'));
            }
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
    }


    private static function sendResponse(Route $route, array $params)
    {
        $assignment = $route->getAssignment();

        if (is_array($assignment)) {
            $controller = new $assignment[0]();
            $function = $assignment[1];
            return $controller->$function(...$params);
        } else if (is_string($assignment)) {
            $callableAssignment = explode('@', $assignment);
            $function = $callableAssignment[1];
            $controller = new $callableAssignment[0]();
            return $controller->$function(...$params);
        } else if (is_callable($assignment)) {
            return $assignment(...$params);
        }
    }
}