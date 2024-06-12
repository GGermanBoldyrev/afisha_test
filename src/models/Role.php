<?php

namespace src\models;

use PDO;
use src\core\Database;
use src\interfaces\ModelInterface;

class Role implements ModelInterface
{
    private Database $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM `roles`";
        $stmt = $this->db->getConnection()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array | bool
    {
        $sql = "SELECT * FROM roles WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool|string
    {
        $sql = "INSERT INTO roles (name) VALUES (:name)";
        $stmt = $this->db->getConnection()->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name']
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM roles WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE roles SET name = :name WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name']
        ]);
    }
}