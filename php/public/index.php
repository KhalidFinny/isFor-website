<?php

require_once __DIR__ . '/../app/helpers/SessionHelper.php';
require_once __DIR__ . '/../app/controllers/LoginController.php';
require_once __DIR__ . '/../app/controllers/RegisterController.php';
require_once __DIR__ . '/../app/Router.php';

use app\Router;

$page = $_GET['page'] ?? 'login';
$router = new Router();
$router->route($page);