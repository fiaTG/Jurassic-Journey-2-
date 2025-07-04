
  <section class=" top-nav">
    <div class="nav-wrapper">

      <div class="nav-center">
        <a href="index.php">
          <img class="logoHeader" src="img/IconJuraasicPlain.png" alt="Logo">
        </a>
      </div>

      <div class="burger" id="burgerIcon" onclick="toggleMobileMenu(event)">
        <div></div>
        <div></div>
        <div></div>
      </div>

      <div class="nav-left" id="navLeft">
        <ul class="menu">
          <li><a class="egOne" href="#add-dinosaur" onclick="scrollToSection(event, 'add-dinosaur')">Add a Dinosaur</a></li>
        </ul>
      </div>

      <div class="nav-right" id="navRight">
        <ul class="menu">
          <li><a class="egOne" href="#dinosaur-overview" onclick="scrollToSection(event, 'dinosaur-overview')">Dinosaur Overview</a></li>
        </ul>
      </div>
    </div>

    <div class="mobile-menu" id="mobileMenu">
      <ul class="menu">
        <li><a href="#add-dinosaur" onclick="scrollToSection(event, 'add-dinosaur'); toggleMobileMenu(event)">Add a Dinosaur</a></li>
        <li><a href="#dinosaur-overview" onclick="scrollToSection(event, 'dinosaur-overview'); toggleMobileMenu(event)">Dinosaur Overview</a></li>
      </ul>
    </div>
  </section>
