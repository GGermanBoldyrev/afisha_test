<?php

namespace src\controllers;

use src\core\View;
use src\interfaces\ControllerInterface;
use src\models\Role;
use src\models\User;

class UserController implements ControllerInterface
{
    private User $userModel;
    private Role $roleModel;
    private View $view;

    public function __construct(View $view)
    {
        $this->userModel = new User();
        $this->roleModel = new Role();
        $this->view = $view;
    }

    public function index(): void
    {
        $users = $this->userModel->getAll();
        $allRoles = $this->roleModel->getAll();

        $userRoles = [];
        foreach ($users as $user) {
            $userRoles[$user['id']] = [];
            // Проходим по всем связям пользователей и ролей
            foreach ($this->userModel->getAllRoles() as $userRole) {
                // Если связь соответствует текущему пользователю
                if ($userRole['user_id'] == $user['id']) {
                    // Находим роль по ID и добавляем ее название к ролям пользователя
                    $roleId = $userRole['role_id'];
                    foreach ($allRoles as $role) {
                        if ($role['id'] == $roleId) {
                            $userRoles[$user['id']][] = $role['name'];
                            break;
                        }
                    }
                }
            }
        }

        $this->view->assign([
            'users' => $users,
            'userRoles' => $userRoles,
        ]);

        $this->view->render('users/index.php');
    }

    public function create(): void
    {
        $roles = $this->roleModel->getAll();

        $this->view->assign(['roles' => $roles]);
        $this->view->render('users/create.php');
    }

    public function store(): void
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $roleIds = $_POST['role_ids'] ?? [];

        if ($userId = $this->userModel->create(['name' => $name, 'email' => $email,])) {
            foreach ($roleIds as $roleId) {
                $this->userModel->assignRole($userId, $roleId);
            }
            header('Location: /users');
            exit;
        } else {
            echo "Ошибка при создании пользователя";
        }
    }

    public function edit(string $id): void
    {
        $user = $this->userModel->getById($id);
        $allRoles = $this->roleModel->getAll();
        $userRoles = $this->userModel->getRoles($id);

        if (!$user) {
            http_response_code(404);
            $this->view->renderNotFound();
            exit;
        }
        $this->view->assign([
            'user' => $user,
            'roles' => $allRoles,
            'userRoles' => $userRoles,
        ]);
        $this->view->render('users/edit.php');
    }

    public function update(string $id): void
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $roleIds = $_POST['role_ids'] ?? [];

        if ($this->userModel->update($id, ['name' => $name, 'email' => $email])) {
            // Получаем роли пользователя
            $currentRoleIds = array_column($this->userModel->getRoles($id), 'id');
            // Находим роли, которые нужно добавить
            $rolesToAdd = array_diff($roleIds, $currentRoleIds);
            foreach ($rolesToAdd as $roleId) {
                $this->userModel->assignRole($id, $roleId);
            }
            // Находим роли, которые нужно удалить
            $rolesToRemove = array_diff($currentRoleIds, $roleIds);
            foreach ($rolesToRemove as $roleId) {
                $this->userModel->removeRole($id, $roleId);
            }
            header('Location: /users');
            exit;
        } else {
            echo "Ошибка при обновлении пользователя";
        }
    }

    public function show(string $id): void
    {
        $user = $this->userModel->getById($id);
        $roles = $this->userModel->getRoles($id);

        $this->view->assign([
            'user' => $user,
            'roles' => $roles,
        ]);
        $this->view->render('users/show.php');
    }

    public function delete(string $id): void
    {
        if ($this->userModel->delete($id)) {
            header('Location: /users');
            exit;
        } else {
            echo "Ошибка при удалении пользователя";
        }
    }
}