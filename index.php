<?php

require __DIR__ . '/config/db.php';
$pdo = getConnection();

// Abfragen für dynamische Auswahlfelder
$gattungen = $pdo->query("SELECT GattungsId, Gattungsbezeichnung FROM Gattung")->fetchAll();
$perioden = $pdo->query("SELECT PeriodenId, Periodenname FROM Periode")->fetchAll();
$ernaehrungen = $pdo->query("SELECT ErnährungsId, Ernährungsbezeichnung FROM Ernährung")->fetchAll();
$kontinente = $pdo->query("SELECT KontinentId, Kontinentbezeichnung FROM Kontinent")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurassic Journey</title>
        <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/cursor.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/scrollHint.css">
        <link rel="stylesheet" href="css/video.css">
        <link rel="stylesheet" href="css/paralax.css">
        <link rel="stylesheet" href="css/divider.css">
        <link rel="stylesheet" href="css/addDinosaur.css">
</head>
<body>

    <!-- Cursor Area -->
    <div class="cursor-dot"></div>
    <div class="cursor-ring"></div>

    <header>
        <?php include 'includes/header.php'; ?>
    </header>

<!-- Video und Bildanimation -->
<div id="video-section">
  <video id="myVideo" autoplay muted playsinline preload="auto">
    <source src="img/StartsceneJurassic.mp4" type="video/mp4">
    Dein Browser unterstützt das Video-Tag nicht.
  </video>

  <img id="lifeImage" src="img/lifeFindsAWay.png" alt="Life Finds A Way">
  <img id="jurassicText" src="img/Schrift.png" alt="Jurassic Journey">
</div>

<div id="scrollHint" style="display: none; opacity: 0;">
    <p>⬇ Scroll down to discover more ⬇</p>
</div>

<!-- Divider: Top -->
<div class="divider-container-top">
  <div class="divider-top"></div>
</div>

<!-- Divider: Bottom -->
<div class="divider-container-bottom">
  <div class="divider-bottom"></div>
</div>

<section class="parallax-section">
  <div class="parallax-bg"></div>
  <div class="parallax-text">
    <h2>About Jurassic Journey</h2>
    <p>Jurassic Journey is an immersive experience that takes you back to the time of the dinosaurs. Explore the prehistoric world and discover the fascinating creatures that once roamed the Earth.</p>
    <p>Our mission is to educate and entertain, providing a unique platform for dinosaur enthusiasts of all ages. Whether you're a paleontology student or just curious about these magnificent creatures, Jurassic Journey has something for everyone.</p>
    <h3>Key Features:</h3>
    <ul>
      <li>Interactive dinosaur database</li>
      <li>Educational resources and articles</li>
      <li>Community forums for discussion</li>
      <li>Regular updates with new content</li>
    </ul>
  </div>
</section>

<!-- Divider: Top -->
<div class="divider-container-top">
  <div class="divider-top"></div>
</div>

<!-- Divider: Bottom -->
<div class="divider-container-bottom">
  <div class="divider-bottom"></div>
</div>


<div style="display: flex; flex-wrap: nowrap; justify-content: space-between; align-items: flex-start; width: 100%; max-width: 1100px; margin: 0 auto;">
  
  <!-- Dino-Modell links -->
  <div style="flex: 0 0 50%; padding: 0 16px;">
    <model-viewer 
      src="DinoModel/randaling-t-rex-animated/source/Trex1.glb"
      animation-name="Walk"
      autoplay
      auto-rotate
      camera-controls
      style="width: 100%; height: 400px; background: transparent; border: none;">
    </model-viewer>
  </div>

  <!-- Dino-Details rechts -->
  <div class="details" style="flex: 0 0 50%; padding: 0 16px;">
    <h2>Dino Details</h2>
    <p><strong>Name:</strong> <span id="detail-name">-</span></p>
    <p><strong>Zeitalter:</strong> <span id="detail-era">-</span></p>
    <p><strong>Körpergröße:</strong> <span id="detail-groesse">-</span></p>
    <p><strong>Ernährung:</strong> <span id="detail-diet">-</span></p>
    <p><strong>Beschreibung:</strong> <span id="detail-description">-</span></p>
  </div>

</div>

<!-- Divider: Top -->
<div class="divider-container-top">
  <div class="divider-top"></div>
</div>

<!-- Divider: Bottom -->
<div class="divider-container-bottom">
  <div class="divider-bottom"></div>
</div>


<div id="add-dinosaur">
<button id="openModalBtn">Dino hinzufügen</button>
</div>

<div id="modalOverlay" class="modal-overlay" style="display: none;">
  <div class="modal">
    <div class="tab-buttons">
      <button class="tab-btn active" data-tab="tab1">Allgemein</button>
      <button class="tab-btn" data-tab="tab2">Geografie</button>
      <button class="tab-btn" data-tab="tab3">Medien</button>
    </div>
    <form method="post" action="insert.php">
      <div class="tab active" id="tab1">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="gattung">Gattung:</label>
        <select id="gattung" name="gattung" required>
          <option>Bitte wählen...</option>
                <?php foreach ($gattungen as $gattung): ?>
            <option value="<?= $gattung['GattungsId'] ?>"><?= htmlspecialchars($gattung['Gattungsbezeichnung']) ?></option>
        <?php endforeach; ?>
        </select>

        <label for="ernaehrung">Ernährung:</label>
        <select id="ernaehrung" name="ernährung" required>
          <option>Bitte wählen...</option>
             <?php foreach ($ernaehrungen as $ernaehrung): ?>
            <option value="<?= $ernaehrung['ErnährungsId'] ?>"><?= htmlspecialchars($ernaehrung['Ernährungsbezeichnung']) ?></option>
        <?php endforeach; ?>
        </select>
      </div>

      <div class="tab" id="tab2">
        <label for="periode">Zeitalter:</label>
        <select id="periode" name="Periode[]" multiple required>
              <?php foreach ($perioden as $periode): ?>
            <option value="<?= $periode['PeriodenId'] ?>"><?= htmlspecialchars($periode['Periodenname']) ?></option>
        <?php endforeach; ?>
        </select>

        <label for="kontinent">Kontinente:</label>
        <select id="kontinent" name="kontinent[]" multiple required>
            <?php foreach ($kontinente as $kontinent): ?>
            <option value="<?= $kontinent['KontinentId'] ?>"><?= htmlspecialchars($kontinent['Kontinentbezeichnung']) ?></option>
        <?php endforeach; ?>
        </select>
      </div>

      <div class="tab" id="tab3">
        <label for="groesse">Körpergröße (m):</label>
        <input type="number" step="0.01" id="groesse" name="körpergröße" required>

        <label for="beschreibung">Beschreibung:</label>
        <textarea id="beschreibung" name="beschreibung" rows="4" required></textarea>

        <label for="bild">Bild-URL:</label>
        <input type="url" id="bild" name="BildURL">

        <label for="modell">3D Modell-URL:</label>
        <input type="url" id="modell" name="ModellPfad">
      </div>

      <button type="submit">Dinosaurier hinzufügen</button>
    </form>
  </div>
</div>





<div id="dinosaur-overview" class="section">
    <h2>Dinosaur Overview</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Zeitalter</th>
                <th>Ernährung</th>
                <th>Beschreibung</th>
            </tr>
        </thead>
        <tbody id="dinoTableBody">
            <?php
            // Beispielabfrage: Daten aus Dinosaurier + Perioden + Ernährung holen
$sql = "
    SELECT 
        d.Name, 
        d.Körpergröße AS Koerpergroesse,
        GROUP_CONCAT(p.Periodenname SEPARATOR ', ') AS Zeitalter,
        e.Ernährungsbezeichnung AS Ernährung,
        d.Beschreibung
    FROM Dinosaurier d
    LEFT JOIN DinoPeriode dp ON d.DinoId = dp.DinoId
    LEFT JOIN Periode p ON dp.PeriodenId = p.PeriodenId
    LEFT JOIN Ernährung e ON d.ErnährungsId = e.ErnährungsId
    GROUP BY d.DinoId
    ORDER BY d.Name
";


            $stmt = $pdo->query($sql);
            $dinos = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($dinos as $dino) {
    echo "<tr class='dino-row' data-name='" . htmlspecialchars($dino['Name'], ENT_QUOTES) . "' data-groesse='" . htmlspecialchars($dino['Koerpergroesse']) . "' data-zeit='" . htmlspecialchars($dino['Zeitalter'], ENT_QUOTES) . "' data-ernaehrung='" . htmlspecialchars($dino['Ernährung'], ENT_QUOTES) . "' data-beschreibung='" . htmlspecialchars($dino['Beschreibung'], ENT_QUOTES) . "'>";
    echo "<td>" . htmlspecialchars($dino['Name']) . "</td>";
    echo "<td>" . htmlspecialchars($dino['Zeitalter']) . "</td>";  // Hier richtig anzeigen
    echo "<td>" . htmlspecialchars($dino['Ernährung']) . "</td>";
    echo "<td>" . htmlspecialchars($dino['Beschreibung']) . "</td>";
    echo "</tr>";
}
            ?>
        </tbody>
    </table>
</div>




    <footer>
        <?php include 'includes/footer.php'; ?>
    </footer>


    <!-- Script Area -->

    <script src="js/header.js"></script>
    <script src="js/cursor.js"></script>
    <script src="js/landingscene.js"></script>
    <script src="js/paralax.js"></script>
    <script src="js/addDinosaur.js"></script>
    <script src="js/toTheTop.js"></script>
    <script src="js/scrollToSection.js"></script>

<script>
  const openBtn = document.getElementById('openModalBtn');
  const overlay = document.getElementById('modalOverlay');
  const tabButtons = document.querySelectorAll('.tab-btn');
  const tabs = document.querySelectorAll('.tab');

  openBtn.onclick = () => overlay.style.display = 'flex';
  overlay.onclick = e => {
    if (e.target === overlay) overlay.style.display = 'none';
  };

  tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      tabButtons.forEach(b => b.classList.remove('active'));
      tabs.forEach(tab => tab.classList.remove('active'));
      btn.classList.add('active');
      document.getElementById(btn.dataset.tab).classList.add('active');
    });
  });
</script>
</body>
</html>