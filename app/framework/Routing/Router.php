<?php

namespace Framework\Routing;

use Framework\Response\Send;

class Router
{

    private const PARAM_OPENER = '{';
    private const PARAM_CLOSER = '}';

    /**
     * Contains all registered routes assigned to all resources of the application.
     * @param array $routes
     */
    private static $routes = [];

    public function __construct()
    {
        $this->getWebRoutes();
        $this->getApiRoutes();
    }


    private function getWebRoutes(): void
    {
        $this->getRegisteredRoutes(__DIR__ . '/../../routes/web.php');
    }


    private function getApiRoutes(): void
    {
        $registerRoutes = fn() => $this->getRegisteredRoutes(__DIR__ . '/../../routes/api.php');
        $this->catchRoutes($registerRoutes, function (Route $catched) {
            $catched->setType('api');

            return $catched;
        });
    }


    private function getRegisteredRoutes(string $routesFile): void
    {
        require($routesFile);

        self::$routes = array_merge(self::$routes ?? [], Route::getCollection());
        Route::emptyCollection();
    }


    private function catchRoutes(callable $registerRoutesFunc, callable $callback): void
    {
        $newRoutesStart = count(self::$routes);
        $registerRoutesFunc();

        for ($i = $newRoutesStart; $i < count(self::$routes); $i++) {
            self::$routes[$i] = $callback(self::$routes[$i]);
        }
    }

    private static function getName(string $routeName): string
    {
        foreach (self::$routes as $route) {
            if ($route->getName() == $routeName) {
                return $route->getUri();
            }
        }

        return '';
    }

    static function route(string $name, array $params = []): string
    {
        $route = self::getName($name);

        if ($params) {
            $dividedRoute = self::divideRoute($route);
            foreach ($params as $param => $value) {
                $route = str_replace(self::parseToParam($param), $value, $route);
            }
        }

        return $route;
    }

    function solve()
    {
        $reqRoute = $_SERVER['REQUEST_URI'];
        $reqMethod = $_SERVER['REQUEST_METHOD'];
        $matchedRoute = $this->checkRoute($reqRoute, $reqMethod);

        if ($matchedRoute == 'notfound') {
            if (! $this->isApiRoute($reqRoute)) {
                return Send::redirect();
            } else {
                return Send::json(['status' => 'denied', 'message' => 'Not Found'], 404);
            }
        }

        if ($reqRoute != '/' && str_ends_with($reqRoute, '/')) {
            return Send::redirect($this->parseToOriginalRoute($reqRoute));
        }

        $params = $this->matchParams($reqRoute, $matchedRoute, $reqMethod);
        $allParams = [];
        if ($params) {
            $allParams = array_merge($params['URL'], $params['METHOD']);
        }

        return $this->sendResponse($matchedRoute, $allParams);
    }


    private function checkRoute(string $reqRoute, string $reqMethod)
    {
        $matchedRoute = 'notfound';

        foreach (self::$routes as $route) {
            if ($route->getMethod() == $reqMethod && (count($this->divideRoute($reqRoute)) == count($this->divideRoute($route->getUri())))) {
                if ($this->matchRoute($reqRoute, $route->getUri())) {
                    $matchedRoute = $route;
                    break;
                }
            }
        }

        return $matchedRoute;
    }


    private function matchRoute(string $reqRoute, string $registeredRoute): bool
    {
        if ($reqRoute == $registeredRoute) {
            return true;
        } else if ($registeredRoute == '/') {
            return false;
        }

        $dividedReqRoute = $this->divideRoute($reqRoute);
        $dividedRegisteredRoute = $this->divideRoute($registeredRoute);

        return $this->matchChilds($dividedReqRoute, $dividedRegisteredRoute);
    }


    private function matchChilds(array $dividedReqRoute, array $dividedRegisteredRoute): bool
    {
        $bracketsOpenPos = -1;
        $bracketsClosePos = -1;

        for ($i = 0; $i < count($dividedReqRoute); $i++) {
            if (count($dividedRegisteredRoute) > 0) {
                if ($this->isParam($dividedRegisteredRoute[$i])) {
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
            'METHOD' => $this->matchQueryParams($reqMethod, $matchedRoute)
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
                return ['postData' => $_POST];
            } else {
                return ['postData' => json_decode(file_get_contents('php://input'))];
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
        $removeEmptiesFunc = fn($value) => $value !== false && $value !== '' && $value !== null;

        return array_values(array_filter($array, $removeEmptiesFunc));
    }


    private static function divideRoute(string $route): array
    {
        return self::cleanArray(explode('/', $route));
    }


    private function parseToOriginalRoute(string $reqRoute): string
    {
        return rtrim($reqRoute, '/');
    }


    private function isApiRoute(string $route): bool
    {
        return str_starts_with($route, API_PREFIX);
    }


    private function isParam(string $child): bool
    {
        if (str_contains($child, self::PARAM_OPENER) && str_contains($child, self::PARAM_CLOSER)) {
            return true;
        }

        return false;
    }


    private static function parseToParam(string $param): string
    {
        return self::PARAM_OPENER . $param . self::PARAM_CLOSER;
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
