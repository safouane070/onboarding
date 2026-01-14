<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->prepare("UPDATE checklist_items SET title=? WHERE id=?");
$stmt->execute([$data['title'], $data['id']]);
