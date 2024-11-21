<?php
$filePath = '../../data/roadmapData.json';
if (file_exists($filePath)) {
    $data = file_get_contents($filePath);
    echo $data;
} else {
    echo json_encode([]);
}
?>