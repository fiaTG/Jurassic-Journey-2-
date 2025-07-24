<?php
require __DIR__ . '/config/db.php';
header('Content-Type: application/json');

$pdo = getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM Dinosaurier WHERE DinoId = ?");
        $stmt->execute([$id]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Ungültige ID']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Ungültige Methode']);
}
exit;
