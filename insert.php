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

// Datei-Upload vorbereiten
$modellPfad = null;
$uploadVerzeichnis = __DIR__ . '/uploads/';

if (!empty($_FILES['modellDatei']['name'])) {
    $dateiname = basename($_FILES['modellDatei']['name']);
    $zielpfad = $uploadVerzeichnis . $dateiname;

    // Ordner erstellen falls nicht vorhanden
    if (!is_dir($uploadVerzeichnis)) {
        mkdir($uploadVerzeichnis, 0755, true);
    }

    // Datei verschieben
    if (move_uploaded_file($_FILES['modellDatei']['tmp_name'], $zielpfad)) {
        $modellPfad = 'uploads/' . $dateiname;
    } else {
        die("Fehler beim Hochladen der Modell-Datei.");
    }
}

// Dinosaurier in Haupttabelle einfügen
$stmt = $pdo->prepare("
    INSERT INTO Dinosaurier (Name, Beschreibung, Körpergröße, GattungsId, ErnährungsId)
    VALUES (?, ?, ?, ?, ?)
");

if (!$stmt->execute([$name, $beschreibung, $körpergröße, $gattungId, $ernährungsId])) {
    die("Fehler beim Einfügen des Dinosauriers.");
}

$dinoId = $pdo->lastInsertId();

// Perioden-Zuordnung
$stmtPeriode = $pdo->prepare("INSERT INTO DinoPeriode (DinoId, PeriodenId) VALUES (?, ?)");
foreach ($perioden as $periodeId) {
    $periodeId = intval($periodeId);
    if (!$stmtPeriode->execute([$dinoId, $periodeId])) {
        echo "Fehler bei Periode-Zuordnung.<br>";
    }
}

// Kontinent-Zuordnung
$stmtKontinent = $pdo->prepare("INSERT INTO DinoKontinent (DinoId, KontinentId) VALUES (?, ?)");
foreach ($kontinente as $kontinentId) {
    $kontinentId = intval($kontinentId);
    if (!$stmtKontinent->execute([$dinoId, $kontinentId])) {
        echo "Fehler bei Kontinent-Zuordnung.<br>";
    }
}

// 3D-Modell speichern, falls vorhanden
if ($modellPfad !== null) {
    $stmtModell = $pdo->prepare("
        INSERT INTO DreiDModell (DinoId, ModellPfad, Erstellungsdatum)
        VALUES (?, ?, CURDATE())
    ");
    if (!$stmtModell->execute([$dinoId, $modellPfad])) {
        echo "Fehler beim Einfügen des 3D-Modells.<br>";
    }
}

// Erfolgsmeldung & Weiterleitung
header("Location: index.php");
exit;
