  // Slow scroll with easing
  function scrollToSection(event, targetId) {
    event.preventDefault();
    const target = document.getElementById(targetId);
    if (!target) return;
    const offset = 250; // Abstand nach oben in Pixeln
    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    const duration = 1200;
    let start = null;

    function step(timestamp) {
      if (!start) start = timestamp;
      const progress = timestamp - start;
      const ease = easeInOutQuad(Math.min(progress / duration, 1));
      window.scrollTo(0, startPosition + distance * ease);
      if (progress < duration) requestAnimationFrame(step);
    }

    function easeInOutQuad(t) {
      return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
    }

    requestAnimationFrame(step);
  }

  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function(e) {
      const href = this.getAttribute('href').substring(1);
      scrollToSection(e, href);
    });
  });