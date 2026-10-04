<?php

class Router {
    private $routes = [];

    public function get($path, $action) {
        $this->addRoute('GET', $path, $action);
    }

    public function post($path, $action) {
        $this->addRoute('POST', $path, $action);
    }

    private function addRoute($method, $path, $action) {
        $this->routes[] = [
            'method' => $method,
            'path'   => $path,
            'action' => $action
        ];
    }

    public function dispatch($uri, $method) {
        // Hapus prefix "/persyadha.org"
        $uri = str_replace('/persyadha.org', '', $uri);

        foreach ($this->routes as $route) {

            // Regex untuk {id}
            $pattern = "@^" . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $route['path']) . "$@";

            if ($method === $route['method'] && preg_match($pattern, $uri, $matches)) {

                array_shift($matches); // hapus full match

                // 🔥 Jika action berupa Closure
                if ($route['action'] instanceof \Closure) {
                    return call_user_func_array($route['action'], $matches);
                }

                // 🔥 Action berupa Controller
                if (is_array($route['action'])) {
                    [$controller, $func] = $route['action'];
                    $obj = new $controller();
                    return call_user_func_array([$obj, $func], $matches);
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
