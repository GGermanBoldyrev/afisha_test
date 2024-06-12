<?php

namespace src\core;

class View
{
    private array $data = [];
    private string $templatePath = __DIR__ . "/../views";
    private string $layoutPath = __DIR__ . "/../views/layout.php";

    public function assign(array $data): void
    {
        $this->data = array_merge($this->data, $data);
    }

    public function render(string $template = 'index.php'): void
    {
        $templatePath = $this->templatePath . '/' . $template;

        // Выполняем шаблон в контексте текущего объекта
        extract($this->data);
        ob_start();
        require $templatePath;
        $content = ob_get_clean();
        // Подключаем layout
        require $this->layoutPath;
    }

    public function renderNotFound(): void
    {
        $this->render('notFound.php');
    }
}