<?php
session_start();

define('BASE_URL', '/isfor-web/');
define('CSS_PATH', BASE_URL . 'path/to/your/css');
define('JS_PATH', BASE_URL . 'path/to/your/js');
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <?php
    include_once __DIR__ . 'app/views/components/layouts/home/header/components/_title-component.php';
    include_once __DIR__ . 'app/views/components/layouts/home/header/components/_link-component.php';
    ?>
</head>