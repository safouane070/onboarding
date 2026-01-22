<?php
require_once __DIR__ . '/../includes/db.php';
header('Content-Type: application/json');

// read json input
$data = json_decode(file_get_contents('php://input'), true);
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$user_id = isset($data['user_id']) ? (int)$data['user_id'] : 0;
$checklist_id = isset($data['checklist_id']) ? (int)$data['checklist_id'] : 0;
$title = isset($data['title']) ? trim($data['title']) : '';

if (!$user_id || !$checklist_id || $title === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Ongeldige invoer']);
    exit;
}

// Determine next sort_order for this user's checklist
$stmt = $pdo->prepare("SELECT IFNULL(MAX(sort_order), 0) + 1 FROM user_tasks WHERE user_id = ? AND checklist_id = ?");
$stmt->execute([$user_id, $checklist_id]);
$nextOrder = (int)$stmt->fetchColumn();

$insert = $pdo->prepare("INSERT INTO user_tasks (user_id, checklist_id, title, sort_order, completed) VALUES (?, ?, ?, ?, 0)");
$insert->execute([$user_id, $checklist_id, $title, $nextOrder]);

echo json_encode(['id' => $pdo->lastInsertId()]);
