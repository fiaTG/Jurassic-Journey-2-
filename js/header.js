function toggleMobileMenu(event) {
  event.stopPropagation();
  const menu = document.getElementById('mobileMenu');
  const burger = document.getElementById('burgerIcon');
  menu.classList.toggle('active');
  burger.classList.toggle('active');
}

function handleResize() {
  const menu = document.getElementById('mobileMenu');
  const burger = document.getElementById('burgerIcon');
  if (window.innerWidth > 700) {
    menu.classList.remove('active');
    burger.classList.remove('active');
  }
}

window.addEventListener('resize', handleResize);

document.addEventListener('click', function(event) {
  const menu = document.getElementById('mobileMenu');
  const burger = document.getElementById('burgerIcon');
  if (!menu.contains(event.target) && !burger.contains(event.target)) {
    menu.classList.remove('active');
    burger.classList.remove('active');
  }
});