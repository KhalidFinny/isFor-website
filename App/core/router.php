<?php

class Router {
    private $routes = [];
    private $basePath = '';

    public function __construct($basePath = '') {
        $this->basePath = trim($basePath, '/');
    }

    public function add($route, $callback) {
        $route = trim($route, '/');
        $this->routes[$route] = $callback;
    }

    public function dispatch($uri) {
        // Remove the base path from URI if present
        $uri = trim(str_replace($this->basePath, '', parse_url($uri, PHP_URL_PATH)), '/');
        
        foreach ($this->routes as $route => $callback) {
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches); // Remove the full match
                call_user_func_array($callback, $matches);
                return;
            }
        }

        echo "<h1 style='color: red; text-align: center;'>404 Not Found</h1>";
        echo "<pre style='text-align: center;'>Requested URI: " . htmlentities($uri) . "</pre>";
    }
}
