<?php
// PENTING SEBELUM DI RUN CEK AgendaModel.php

require_once '../app/init.php';
require_once '../../vendor/autoload.php';
if (function_exists('opcache_reset')) {
    opcache_reset();
}

$app = new App;


