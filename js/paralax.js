document.addEventListener('DOMContentLoaded', () => {
  const text = document.querySelector('.parallax-text');
  const observer = new IntersectionObserver(([entry]) => {
    if (entry.isIntersecting) {
      text.style.opacity = '1';
      text.style.transform = 'translateY(0)';
    }
  }, { threshold: 0.1 });

  observer.observe(text);

  window.addEventListener('scroll', () => {
    const section = document.querySelector('.parallax-section');
    const scrollTop = window.pageYOffset;
    const sectionTop = section.offsetTop;
    const distance = scrollTop - sectionTop;

    if (scrollTop + window.innerHeight > sectionTop + 100) {
      text.style.transform = `translateY(${50 - distance * 0.3}px)`;
    }
  });
});