<?php

namespace src\models;

use PDO;
use src\core\Database;
use src\interfaces\ModelInterface;

class User implements ModelInterface
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->getConnection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|bool
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool|string
    {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $this->db->getConnection()->prepare($sql);
        if ($stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email']
        ])) {
            return $this->db->getConnection()->lastInsertId();
        } else {
            return false;
        }
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':email' => $data['email']
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getRoles(int $userId): array
    {
        $sql = "SELECT r.* 
            FROM roles r
            JOIN user_roles ur ON r.id = ur.role_id
            WHERE ur.user_id = :userId";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRoles(): array
    {
        $sql = "SELECT * FROM user_roles";
        $stmt = $this->db->getConnection()->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function assignRole(int $userId, int $roleId): bool
    {
        $sql = "INSERT INTO user_roles (user_id, role_id) VALUES (:userId, :roleId)";
        $stmt = $this->db->getConnection()->prepare($sql);
        return $stmt->execute([
            ':userId' => $userId,
            ':roleId' => $roleId,
        ]);
    }

    public function removeRole(int $userId, int $roleId): bool
    {
        $sql = "DELETE FROM user_roles WHERE user_id = :userId AND role_id = :roleId";
        $stmt = $this->db->getConnection()->prepare($sql);
        return $stmt->execute([
            ':userId' => $userId,
            ':roleId' => $roleId,
        ]);
    }
}