<?php

namespace src\core;

class App
{
    private Router $router;
    private View $view;


    public function __construct()
    {
        $this->view = new View();
        $this->router = new Router($this->view);

        // Маршруты
        $this->defineRoutes();
    }

    public function handleRequest(): void
    {
        $this->router->route();
    }

    private function defineRoutes(): void
    {
        // Маршруты для сайта
        $this->router->get('/', 'SiteController@index');

        // Маршруты для пользователей
        $this->router->get('/users', 'UserController@index');
        $this->router->get('/users/create', 'UserController@create');
        $this->router->post('/users', 'UserController@store');
        $this->router->get('/users/show/{id}', 'UserController@show');
        $this->router->get('/users/edit/{id}', 'UserController@edit');
        $this->router->post('/users/update/{id}', 'UserController@update');
        $this->router->get('/users/delete/{id}', 'UserController@delete');

        // Маршруты для ролей
        $this->router->get('/roles', 'RoleController@index');
        $this->router->get('/roles/create', 'RoleController@create');
        $this->router->post('/roles', 'RoleController@store');
        $this->router->get('/roles/show/{id}', 'RoleController@show');
        $this->router->get('/roles/edit/{id}', 'RoleController@edit');
        $this->router->post('/roles/update/{id}', 'RoleController@update');
        $this->router->get('/roles/delete/{id}', 'RoleController@delete');

        // 404 not found
        $this->router->get('/404', 'SiteController@notFound');
    }
}
