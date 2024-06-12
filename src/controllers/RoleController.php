<?php

namespace src\controllers;

use src\core\View;
use src\interfaces\ControllerInterface;
use src\models\Role;

class RoleController implements ControllerInterface
{
    private Role $roleModel;
    private View $view;

    public function __construct(View $view)
    {
        $this->roleModel = new Role();
        $this->view = $view;
    }

    public function index(): void
    {
        $roles = $this->roleModel->getAll();
        $this->view->assign(['roles' => $roles]);
        $this->view->render('roles/index.php');
    }

    public function create(): void
    {
        $this->view->render('roles/create.php');
    }

    public function store(): void
    {
        $name = $_POST['name'] ?? '';

        if ($this->roleModel->create(['name' => $name])) {
            header('Location: /roles');
            exit;
        } else {
            echo "Ошибка при создании роли";
        }
    }

    public function edit(string $id): void
    {
        $role = $this->roleModel->getById($id);
        if (!$role) {
            http_response_code(404);
            $this->view->renderNotFound();
            exit;
        }
        $this->view->assign(['role' => $role]);
        $this->view->render('roles/edit.php');
    }

    public function update(string $id): void
    {
        $name = $_POST['name'] ?? '';
        if ($this->roleModel->update($id, ['name' => $name])) {
            header('Location: /roles');
            exit;
        } else {
            echo "Ошибка при обновлении роли";
        }
    }

    public function show(string $id): void
    {
        $role = $this->roleModel->getById($id);
        $this->view->assign(['role' => $role]);
        $this->view->render('roles/show.php');
    }

    public function delete(string $id): void
    {
        if ($this->roleModel->delete($id)) {
            header('Location: /roles');
            exit;
        } else {
            echo "Ошибка при удалении роли";
        }
    }
}