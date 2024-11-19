<?php

namespace Framework\Routing;


class Router {

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


    private function getWebRoutes(): void
    {
        $this->getRegisteredRoutes(__DIR__.'/../../routes/web.php');
    }


    private function getApiRoutes(): void
    {
        $registerRoutes = fn () => $this->getRegisteredRoutes(__DIR__.'/../../routes/api.php');
        $this->catchRoutes($registerRoutes, function (Route $catched) {
            $catched->setType('api');

            return $catched;
        });
    }


    private function getRegisteredRoutes(string $routesFile): void
    {
        require($routesFile);

        $this->routes = array_merge($this->routes, Route::getCollection());
        Route::emptyCollection();
    }


    private function catchRoutes(callable $registerRoutesFunc, callable $callback): void
    {
        $newRoutesStart = count($this->routes);
        $registerRoutesFunc();
        
        for ($i = $newRoutesStart; $i < count($this->routes); $i++) {
            $this->routes[$i] = $callback($this->routes[$i]);
        }
    }


    function solve()
    {
        $reqRoute = $_SERVER['REQUEST_URI'];
        $reqMethod = $_SERVER['REQUEST_METHOD'];
        $matchedRoute = $this->checkRoute($reqRoute, $reqMethod);
        
        if ($matchedRoute == 'notfound') {
            header('Location: /');
        }

        if ($reqRoute != '/' && str_ends_with($reqRoute, '/')) {
            header("Location: {$this->parseToOriginalRoute($reqRoute)}");
        }

        $params = $this->matchParams($reqRoute, $matchedRoute, $reqMethod);
        $allParams = array_merge($params['URL'], $params['QUERY']);
        
        return $this->sendResponse($matchedRoute, $allParams);
    }


    private function checkRoute(string $reqRoute, string $reqMethod)
    {
        $matchedRoute = 'notfound';
        
        foreach ($this->routes as $route) {
            if ($route->getMethod() == $reqMethod && $this->matchRoute($reqRoute, $route->getUri())) {    
                $matchedRoute = $route;
                break;
            }
        }

        return $matchedRoute;
    }


    private function matchRoute(string $reqRoute, string $registeredRoute): bool
    {
        if ($reqRoute == $registeredRoute) {
            return true;
        }

        $dividedReqRoute = $this->divideRoute($reqRoute);
        $dividedRegisteredRoute = $this->divideRoute($registeredRoute);

        return $this->matchDivisions($dividedReqRoute, $dividedRegisteredRoute);
    }


    private function matchDivisions(array $dividedReqRoute, array $dividedRegisteredRoute): bool
    {
        $bracketsOpenPos = -1;
        $bracketsClosePos = -1;

        for ($i = 0; $i < count($dividedReqRoute); $i++) {
            if (count($dividedRegisteredRoute) > 0) {
                $bracketsOpenPos = strpos($dividedRegisteredRoute[$i], '{') == 0;
                $bracketsClosePos = strpos($dividedRegisteredRoute[$i], '}') > 0;
                
                if ($bracketsOpenPos && $bracketsClosePos) {
                    continue;
                }

                if ($dividedReqRoute[$i] != $dividedRegisteredRoute[$i]) {
                    return false;
                }
            }
        }

        return true;
    }


    private function matchParams(string $reqRoute, Route $matchedRoute, string $reqMethod): array
    {
        return [
            'URL' => $this->matchURLParams($reqRoute, $matchedRoute),
            'QUERY' => $this->matchQueryParams($reqMethod, $matchedRoute)
        ];
    }


    private function matchURLParams(string $reqRoute, Route $matchedRoute): array
    {
        $params = [];

        $dividedReqRoute = $this->divideRoute($reqRoute);
        $dividedMatchedRoute = $this->divideRoute($matchedRoute->getUri());
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


    private function matchQueryParams(string $reqMethod, Route $matchedRoute): array
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
    private function cleanArray(array $array): array
    {
        $removeEmptiesFunc = fn ($value) => $value !== false && $value !== '' && $value !== null;

        return array_values(array_filter($array, $removeEmptiesFunc));
    }


    private function divideRoute(string $route): array
    {
        return $this->cleanArray(explode('/', $route));
    }


    private function parseToOriginalRoute($reqRoute): string
    {
        return rtrim($reqRoute, '/');
    }


    private function sendResponse(Route $route, array $params)
    {
        $action = $route->getAction();

        if (is_array($action)) {
            $controller = new $action[0]();
            $function = $action[1];
            return $controller->$function(...$params);
        } else if (is_string($action)) {
            $callableAction = explode('@', $action);
            $function = $callableAction[1];
            $controller = new $callableAction[0]();
            return $controller->$function(...$params);
        } else if (is_callable($action)) {
            return $action(...$params);
        }
    }
}