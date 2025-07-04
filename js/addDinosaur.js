
document.querySelectorAll('.dino-row').forEach(row => {
  row.addEventListener('click', (event) => {
    console.log('Zeitalter data-Attribut:', row.dataset.zeit);
    document.querySelectorAll('.dino-row').forEach(r => r.classList.remove('selected'));
    row.classList.add('selected');
        const name = row.dataset.name || '-';
    const groesse = row.dataset.groesse || '-';
    const zeitalter = row.dataset.zeit || '-';
    const ernahrung = row.dataset.ernaehrung || '-';
    const beschreibung = row.dataset.beschreibung || '-';

    document.getElementById('detail-name').textContent = name;
    document.getElementById('detail-groesse').textContent = groesse + " m";
    document.getElementById('detail-era').textContent = zeitalter;
    document.getElementById('detail-diet').textContent = ernahrung;
    document.getElementById('detail-description').textContent = beschreibung;
     scrollToSection(event, 'add-dinosaur');
});
});