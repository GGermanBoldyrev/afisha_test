<?php

namespace src\core;

class Router
{
    protected array $routes = [];
    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function get(string $route, string $controller): void
    {
        $this->routes['GET'][$route] = $controller;
    }

    public function post(string $route, string $controller): void
    {
        $this->routes['POST'][$route] = $controller;
    }

    public function route(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $controller = $this->findRoute($method, $uri);

        if ($controller) {
            $this->callController($controller);
        } else {
            $this->redirectNotFound();
        }
    }

    private function findRoute($method, $uri): array | bool
    {
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $controller) {
                // Проверяем наличие фигурных скобок - признак динамического сегмента
                if (strpos($route, '{') !== false) {
                    $routePattern = '#^' . preg_replace('/\{.+?\}/', '(.+)', $route) . '$#';
                    if (preg_match($routePattern, $uri, $matches)) {
                        // Удаляем первый элемент (полный URL) из массива matches
                        array_shift($matches);
                        // Возвращаем контроллер и найденные параметры
                        return ['controller' => $controller, 'params' => $matches];
                    }
                } elseif ($route === $uri) {
                    return ['controller' => $controller, 'params' => []];
                }
            }
        }
        return false;
    }

    private function callController(array | string $controllerData): void
    {
        if (is_array($controllerData)) {
            $controller = $controllerData['controller'];
            $params = $controllerData['params'];
        } else {
            $controller = $controllerData;
            $params = [];
        }

        list($controllerName, $actionName) = explode('@', $controller);
        $controllerName = "src\\controllers\\" . $controllerName;

        if (class_exists($controllerName)) {
            $controllerInstance = new $controllerName($this->view);
            if (method_exists($controllerInstance, $actionName)) {
                // Вызываем метод контроллера с параметрами
                call_user_func_array([$controllerInstance, $actionName], $params);
            } else {
                $this->redirectNotFound();
            }
        } else {
            $this->redirectNotFound();
        }
    }

    private function redirectNotFound(): void
    {
        http_response_code(404);
        header('Location: /404');
        exit;
    }
}