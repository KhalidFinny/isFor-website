<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate and sanitize data here

    // Save data to a file or database
    $filePath = '../../data/roadmapData.json';
    if (file_put_contents($filePath, json_encode($data))) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to save data']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>