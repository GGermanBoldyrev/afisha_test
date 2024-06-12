<?php

namespace src\interfaces;

use src\core\View;

interface ControllerInterface
{
    public function __construct(View $view);

    public function index(): void;

    public function create(): void;

    public function store(): void;

    public function edit(string $id): void;

    public function update(string $id): void;

    public function show(string $id): void;

    public function delete(string $id): void;
}