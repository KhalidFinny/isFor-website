<?php

require_once '../config/database.php';
require_once '../controllers/RoadmapController.php';

$db = new PDO($dsn, $username, $password);
$controller = new RoadmapController($db);

$data = json_decode(file_get_contents('php://input'), true);

if ($controller->updateItem($data['id'], $data['item'])) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
} 