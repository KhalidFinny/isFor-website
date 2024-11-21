<?php

require_once '../config/database.php';
require_once '../controllers/RoadmapController.php';

$db = new PDO($dsn, $username, $password);
$controller = new RoadmapController($db);

header('Content-Type: application/json');
echo json_encode($controller->getRoadmap()); 