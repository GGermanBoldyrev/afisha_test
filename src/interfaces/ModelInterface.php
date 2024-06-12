<?php

namespace src\interfaces;

use src\core\View;

interface ModelInterface
{
    public function __construct();

    public function getAll(): array;

    public function getById(int $id): array|bool;

    public function create(array $data): bool|string;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

}