<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);

$pdo->prepare("DELETE FROM checklist_assignments WHERE user_id=?")->execute([$data['user_id']]);
$pdo->prepare("DELETE FROM checklist_progress WHERE user_id=?")->execute([$data['user_id']]);
