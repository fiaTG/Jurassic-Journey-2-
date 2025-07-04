
  (function() {
    const dot = document.querySelector('.cursor-dot');
    const ring = document.querySelector('.cursor-ring');
    if (!ring) return;
    if (!dot || !ring) {
      // Required elements not found, do not run cursor script
      return;
    }

    let mouseX = 0, mouseY = 0;
    let dotX = 0, dotY = 0;
    let ringX = 0, ringY = 0;

    const DOT_SMOOTHNESS = 0.35;
    const RING_SMOOTHNESS = 0.18;

    // Check if hovering interactive element
    function setHoverState(isHovering) {
      if (isHovering) {
        ring.classList.add('hovered');
        dot.classList.add('hovered');
      } else {
        ring.classList.remove('hovered');
        dot.classList.remove('hovered');
      }
    }

    window.addEventListener('mousemove', e => {
      mouseX = e.clientX;
      mouseY = e.clientY;
    });

    // Attach hover listeners to interactive elements
    const interactiveElements = document.querySelectorAll('a, button, input, textarea, select, label');

    interactiveElements.forEach(el => {
      el.addEventListener('mouseenter', () => setHoverState(true));
      el.addEventListener('mouseleave', () => setHoverState(false));
    });

    // Linear interpolation function
    function lerp(start, end, amt) {
      return (1 - amt) * start + amt * end;
    }

    // Animation loop
  function animate() {
    dotX = lerp(dotX, mouseX, DOT_SMOOTHNESS);
    dotY = lerp(dotY, mouseY, DOT_SMOOTHNESS);
    ringX = lerp(ringX, mouseX, RING_SMOOTHNESS);
    ringY = lerp(ringY, mouseY, RING_SMOOTHNESS);

    if (dot) {
      dot.style.transform = `translate(${dotX}px, ${dotY}px) translate(-50%, -50%)`;
    }
    if (ring) {
      ring.style.transform = `translate(${ringX}px, ${ringY}px) translate(-50%, -50%)`;
    }

    requestAnimationFrame(animate);
  }

  animate();
})();