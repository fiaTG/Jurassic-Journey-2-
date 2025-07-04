const video = document.getElementById('myVideo');
  const videoSection = document.getElementById('video-section');
  const lifeImage = document.getElementById('lifeImage');
  const jurassicText = document.getElementById('jurassicText');
  const bgImageUrl = 'url(img/wallCracks.png)';

  video.addEventListener('ended', () => {
    // 1. Video ausblenden
    video.classList.add('fade-out');

    // 2. Nach 1s: Crack-Hintergrund
    setTimeout(() => {
      video.style.display = 'none';
      videoSection.style.backgroundImage = bgImageUrl;

      // Sanft lifeImage einblenden
      setTimeout(() => {
        lifeImage.style.display = 'block';
        lifeImage.style.opacity = '0';
        setTimeout(() => {
          lifeImage.style.opacity = '1';
        }, 50);
      }, 200);

      // Nach 2.2s: lifeImage ausblenden
      setTimeout(() => {
        lifeImage.style.opacity = '0';
        setTimeout(() => {
          lifeImage.style.display = 'none';
          // jurassicText einblenden, gleiche Animation
          jurassicText.style.display = 'block';
          jurassicText.style.opacity = '0';
          setTimeout(() => {
            jurassicText.style.opacity = '1';

            // Scroll-Hinweis erst jetzt einblenden!
            setTimeout(() => {
              const scrollHint = document.getElementById('scrollHint');
              scrollHint.style.display = 'block';
              setTimeout(() => {
                scrollHint.style.opacity = '1';
              }, 100);
            }, 1000); // Optional: 1 Sekunde nach JurassicJourney-Einblendung
          }, 50);
        }, 1000); // 1s für das Ausblenden von lifeImage
      }, 2200); // 2.2s nach dem Einblenden von lifeImage

    }, 2000);
  });
