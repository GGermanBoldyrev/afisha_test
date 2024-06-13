<?php

require __DIR__ . '/../vendor/autoload.php';

use src\core\App;

$app = new App();
// Точка входа в приложение
$app->handleRequest();
