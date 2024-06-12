<?php

namespace src\core;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config.php';
        try {
            $dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['db_name']};";
            $username = $config['db']['username'];
            $password = $config['db']['password'];

            $this->connection = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo "Ошибка подключения к базе данных: " . $e->getMessage();
            exit;
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}