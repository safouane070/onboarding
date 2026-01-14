<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);

$pdo->prepare("DELETE FROM checklist_items WHERE id=?")->execute([$data['id']]);
$pdo->prepare("DELETE FROM checklist_progress WHERE checklist_item_id=?")->execute([$data['id']]);
