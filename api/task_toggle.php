<?php
require_once __DIR__ . '/../includes/db.php';
$data = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->prepare("
    INSERT INTO checklist_progress (user_id, checklist_item_id, completed)
    VALUES (?, ?, ?)
    ON DUPLICATE KEY UPDATE completed=VALUES(completed)
");
$stmt->execute([
    $data['user_id'],
    $data['task_id'],
    $data['completed']
]);
