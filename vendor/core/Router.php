<?php

class Router {
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes() {
        return self::$routes;
    }

    public static function getRoute() {
        return self::$route;
    }

    public static function matchRoute($url) {
        debug($url);
        foreach (self::$routes as $pattern => $route) {
            // i - модификатор шаблона который делает его регистро не зависимым
            if (preg_match("#$pattern#i", $url, $matches)) {
                //debug($matches);
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route["action"])) {
                    $route["action"] = "index";
                }
                self::$route = $route;
                //debug(self::$route);
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url) {
        if (self::matchRoute($url)) {
            $controller = self::$route["controller"];
            if (class_exists($controller)) {
                echo 'Okay';
            } else {
                echo "Contoller <b>". $controller ."</b> not found";
            }
        }else{
            http_response_code(404);
            include "404.html";
        }
    }
}