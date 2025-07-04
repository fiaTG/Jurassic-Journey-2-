<?php
require __DIR__ . '/config/db.php';
$pdo = getConnection();

// Eingaben validieren & bereinigen
$name = trim($_POST['name'] ?? '');
$beschreibung = trim($_POST['beschreibung'] ?? '');
$körpergröße = floatval($_POST['körpergröße'] ?? 0);
$gattungId = intval($_POST['gattung'] ?? 0);
$ernährungsId = intval($_POST['ernährung'] ?? 0);
$perioden = $_POST['Periode'] ?? [];
$kontinente = $_POST['kontinent'] ?? [];

// Basisvalidierung
if (empty($name) || $gattungId === 0 || $ernährungsId === 0) {
    die("Fehlende Pflichtfelder.");
}

// Dinosaurier einfügen
$stmt = $pdo->prepare("
    INSERT INTO Dinosaurier (Name, Beschreibung, Körpergröße, GattungsId, ErnährungsId)
    VALUES (?, ?, ?, ?, ?)
");

if (!$stmt->execute([$name, $beschreibung, $körpergröße, $gattungId, $ernährungsId])) {
    die("Fehler beim Einfügen des Dinosauriers.");
}

$dinoId = $pdo->lastInsertId();

// Perioden verknüpfen
$stmtPeriode = $pdo->prepare("INSERT INTO DinoPeriode (DinoId, PeriodenId) VALUES (?, ?)");
foreach ($perioden as $periodeId) {
    $periodeId = intval($periodeId);
    if (!$stmtPeriode->execute([$dinoId, $periodeId])) {
        echo "Fehler bei Periode-Zuordnung.<br>";
    }
}

// Kontinente verknüpfen
$stmtKontinent = $pdo->prepare("INSERT INTO DinoKontinent (DinoId, KontinentId) VALUES (?, ?)");
foreach ($kontinente as $kontinentId) {
    $kontinentId = intval($kontinentId);
    if (!$stmtKontinent->execute([$dinoId, $kontinentId])) {
        echo "Fehler bei Kontinent-Zuordnung.<br>";
    }
}

echo "<p style='color: green; font-size: 20px; font-weight: bold; text-align: center;'>Dinosaurier erfolgreich hinzugefügt!</p>";

header("Location: index.php");
exit;
