<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->prepare("
    INSERT INTO checklist_items (checklist_id, title, sort_order)
    VALUES (?, '', 999)
");
$stmt->execute([$data['checklist_id']]);

echo json_encode([
    "id" => $pdo->lastInsertId()
]);
