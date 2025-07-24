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
    <h2 style=" font-size: 5rem; font-family: fantasy; text-align: center;">About Jurassic Journey</h2>



<section class="parallax-section">
  <div class="parallax-bg"></div>
  <div class="parallax-text">
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

<h2 style=" font-size: 5rem; font-family: fantasy; text-align: center;">Add Dinosaur</h2>




<div id="add-dinosaur" style="display: flex; justify-content: center; margin: 32px 0;">

  <button id="openModalBtn" title="Dinosaurier hinzufügen" style="
    background: none;
    border: none;
    padding: 0;
    cursor: none;
    outline: none;
    transition: transform 0.2s, box-shadow 0.2s;
    border-radius: 50%;
box-shadow: 0 2px 8px rgba(0,0,0,0.01);

    /* Animation wird per Klasse hinzugefügt */
  ">
    <img id="dinoEggImg" src="img/dinoegg.png" alt="" style="
      width: 110px;
      height: 110px;
      object-fit: contain;
      display: block;
      border-radius: 50%;
      box-shadow: 0 1px 4px rgba(0,0,0,0.01);
      transition: filter 0.2s;
    ">
  </button>
</div>
</div>
<style>
#openModalBtn:hover img#dinoEggImg {
  box-shadow: 0 8px 32px rgba(236, 233, 233, 0.88);
  filter: brightness(1.15) drop-shadow(0 0 12px #fff8);

  transition: box-shadow 0.2s, filter 0.2s, outline 0.2s;
}
@keyframes egg-shake {
  10% { transform: rotate(-8deg); }
  20% { transform: rotate(8deg); }
  30% { transform: rotate(-6deg); }
  40% { transform: rotate(6deg); }
  50% { transform: rotate(-4deg); }
  60% { transform: rotate(4deg); }
  70% { transform: rotate(-2deg); }
  80% { transform: rotate(2deg); }
  90% { transform: rotate(-1deg); }
  100% { transform: rotate(0deg); }
}
.dino-egg-shake {
  animation: egg-shake 0.7s cubic-bezier(.36,.07,.19,.97) both;
}
</style>
<script>
const dinoEggImg = document.getElementById('dinoEggImg');
function shakeEgg() {
  dinoEggImg.classList.remove('dino-egg-shake');
  // Force reflow to restart animation
  void dinoEggImg.offsetWidth;
  dinoEggImg.classList.add('dino-egg-shake');
}
// Alle 2.5 Sekunden vibrieren lassen
setInterval(shakeEgg, 2500);
// Auch beim Hover vibrieren lassen
dinoEggImg.addEventListener('mouseenter', shakeEgg);
</script>

<div id="modalOverlay" class="modal-overlay" style="display: none;">
  <div class="modal">

    <div class="tab-buttons">
      <button class="tab-btn active" data-tab="tab1">Allgemein</button>
      <button class="tab-btn" data-tab="tab2">Geografie</button>
      <button class="tab-btn" data-tab="tab3">Medien</button>
    </div>
    <form method="post" action="insert.php" enctype="multipart/form-data">
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

<label for="modell">3D Modell hochladen (.glb):</label>
<input  type="file" id="modell" name="modellDatei" accept=".glb">

      </div>

      <button type="submit">Dinosaurier hinzufügen</button>
    </form>
  </div>
</div>


<!-- Divider: Top -->
<div class="divider-container-top">
  <div class="divider-top"></div>
</div>

   <h2 style=" font-size: 5rem; font-family: fantasy; text-align: center;">Dino Details</h2>



  <div style="display: flex; flex-wrap: nowrap; justify-content: space-between; align-items: flex-start; width: 100%; margin: 0 auto;">

    <!-- Hinweis-Text links -->
    <div style="flex: 0 0 10%; padding: 0 16px;">
      <p style="font-size: 1.1rem; color: #777;  border-radius: 8px; padding: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); text-align: center; margin-bottom: 24px;">
        <i class="fa fa-hand-pointer-o" aria-hidden="true" style="margin-right: 8px; color: #bfc5bcff;"></i>
        Interaktives 3D-Modell: <span style="font-weight: bold;">Klicke und drehe den Dinosaurier.</span>
      </p>
    </div>

    <!-- Dino-Modell in der Mitte -->
    <div style="flex: 0 0 75%; display: flex; justify-content: center; align-items: center; padding: 0 16px;">
      <model-viewer 
        id="dinoModelViewer"
        src=""
        animation-name="Walk"
        autoplay
        auto-rotate
        camera-controls
        style="width:100%; height: 600px; background: transparent; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
      </model-viewer>
    </div>

    <!-- Dino-Details rechts -->
    <div class="details" id="details" style="flex: 0 0 15%; padding: 0 16px; position: relative; right:160px;">
  
        <p><strong>Name:</strong> <span id="detail-name">-</span></p>
        <p><strong>Zeitalter:</strong> <span id="detail-era">-</span></p>
        <p><strong>Körpergröße:</strong> <span id="detail-groesse">-</span></p>
        <p><strong>Ernährung:</strong> <span id="detail-diet">-</span></p>
        <p><strong>Beschreibung:</strong> <span id="detail-description">-</span></p>
      </div>
    </div>

  </div>

<div class="divider-container-top">
  <div class="divider-top"></div>
</div>


<div id="dinosaur-overview" class="overview">
    <h2 style=" margin-top: 20px; font-size: 5rem; font-family: fantasy; text-align: center;">Dinosaur Overview</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Zeitalter</th>
                <th>Ernährung</th>
                <th>Beschreibung</th>
                    <th>Aktion</th>
            </tr>
        </thead>
        <tbody id="dinoTableBody">
            <?php
            // Beispielabfrage: Daten aus Dinosaurier + Perioden + Ernährung holen
$sql = "
    SELECT 
        d.DinoId,
        d.Name, 
        d.Körpergröße AS Koerpergroesse,
        GROUP_CONCAT(p.Periodenname SEPARATOR ', ') AS Zeitalter,
        e.Ernährungsbezeichnung AS Ernährung,
        d.Beschreibung,
        m.ModellPfad
    FROM Dinosaurier d
    LEFT JOIN DinoPeriode dp ON d.DinoId = dp.DinoId
    LEFT JOIN Periode p ON dp.PeriodenId = p.PeriodenId
    LEFT JOIN Ernährung e ON d.ErnährungsId = e.ErnährungsId
    LEFT JOIN DreiDModell m ON d.DinoId = m.DinoId
    GROUP BY d.DinoId
    ORDER BY d.Name
";


            $stmt = $pdo->query($sql);
            $dinos = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($dinos as $dino) {
echo "<tr class='dino-row' data-name='" . htmlspecialchars($dino['Name'], ENT_QUOTES) . "' data-groesse='" . htmlspecialchars($dino['Koerpergroesse']) . "' data-zeit='" . htmlspecialchars($dino['Zeitalter'], ENT_QUOTES) . "' data-ernaehrung='" . htmlspecialchars($dino['Ernährung'], ENT_QUOTES) . "' data-beschreibung='" . htmlspecialchars($dino['Beschreibung'], ENT_QUOTES) . "' data-modellpfad='" . htmlspecialchars($dino['ModellPfad'], ENT_QUOTES) . "'>";
echo "<td data-label='Name'>" . htmlspecialchars($dino['Name']) . "</td>";
echo "<td data-label='Zeitalter'>" . htmlspecialchars($dino['Zeitalter']) . "</td>";
echo "<td data-label='Ernährung'>" . htmlspecialchars($dino['Ernährung']) . "</td>";
echo "<td data-label='Beschreibung'>" . htmlspecialchars($dino['Beschreibung']) . "</td>";

echo "<td>
  <button class='delete-dino-btn' data-id='" . htmlspecialchars($dino['DinoId']) . "'>🗑️</button>
</td>";

    echo "</tr>";
}
            ?>
        </tbody>
    </table>
</div>


<div id="deleteModal" class="modal-overlay" style="display: none;">
  <div class="modal" style="max-width: 400px; text-align: center;">
    <p style="margin-bottom: 1rem;">Möchtest du diesen Dinosaurier wirklich löschen?</p>
    <div style="display: flex; justify-content: space-between;">
      <button id="cancelDelete" style="flex: 1; margin-right: 5px; background: #ccc; border: none; padding: 10px; cursor: pointer;">Abbrechen</button>
      <button id="confirmDelete" style="flex: 1; background: #c62828; color: white; border: none; padding: 10px; cursor: pointer;">🗑️ Löschen</button>
    </div>
  </div>
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
    <script src="js/deleteDinosaur.js"></script>

<script>
  const openBtn = document.getElementById('openModalBtn');
  const overlay = document.getElementById('modalOverlay');
  const tabButtons = document.querySelectorAll('.tab-btn');
  const tabs = document.querySelectorAll('.tab');
  const closeBtn = document.querySelector('.close-modal'); // Optional, aber empfohlen

  // Öffnen
  openBtn.addEventListener('click', () => {
    overlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    document.documentElement.style.overflow = 'hidden';
  });

  // Schließen durch Klick auf Overlay
  overlay.addEventListener('click', e => {
    if (e.target === overlay) {
      overlay.style.display = 'none';
      document.body.style.overflow = '';
      document.documentElement.style.overflow = '';
    }
  });

  // Schließen durch "X"-Button
  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      overlay.style.display = 'none';
      document.body.style.overflow = '';
    });
  }

  // Tab-Umschaltung
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