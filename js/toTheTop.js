     // Show "to top" button if not already present
      let toTopBtn = document.getElementById('toTopBtn');
      if (!toTopBtn) {
        toTopBtn = document.createElement('button');
        toTopBtn.id = 'toTopBtn';
        toTopBtn.textContent = '↑';
        toTopBtn.title = 'Nach oben scrollen';
        toTopBtn.style.position = 'fixed';
        toTopBtn.style.bottom = '32px';
        toTopBtn.style.right = '32px';
        toTopBtn.style.zIndex = '10000';
        toTopBtn.style.display = 'none';
        toTopBtn.style.background = '#222';
        toTopBtn.style.color = '#fff';
        toTopBtn.style.border = 'none';
        toTopBtn.style.borderRadius = '50%';
        toTopBtn.style.width = '48px';
        toTopBtn.style.height = '48px';
        toTopBtn.style.fontSize = '1.5em';
        toTopBtn.style.cursor = 'pointer';
        toTopBtn.style.boxShadow = '0 2px 8px rgba(0,0,0,0.3)';
        toTopBtn.style.transition = 'transform 0.2s cubic-bezier(.4,2,.6,1)';
        document.body.appendChild(toTopBtn);

        toTopBtn.addEventListener('click', function() {
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        toTopBtn.addEventListener('mouseenter', function() {
          toTopBtn.style.transform = 'scale(1.18)';
          toTopBtn.style.color = 'yellow';
        });
        toTopBtn.addEventListener('mouseleave', function() {
          toTopBtn.style.transform = 'scale(1)';
          toTopBtn.style.color = '#fff';
        });

        window.addEventListener('scroll', function() {
          if (window.scrollY > 200) {
            toTopBtn.style.display = 'block';
          } else {
            toTopBtn.style.display = 'none';
          }
        });
      }
    