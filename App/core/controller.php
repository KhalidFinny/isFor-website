<?php
// File: App/core/Controller.php

class Controller {
    protected $viewPath = __DIR__ . '/../views/';

    function render($view, $data = []) {
        $viewFile = $this->viewPath . $view . '.php';
    
        if (!file_exists($viewFile)) {
            echo "<h1 style='color: red; text-align: center;'>View not found: $view</h1>";
            return;
        }
    
        extract($data);
        include $viewFile;
    }
}
