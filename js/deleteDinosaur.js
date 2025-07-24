
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('deleteModal');
  const confirmBtn = document.getElementById('confirmDelete');
  const cancelBtn = document.getElementById('cancelDelete');

  let targetRow = null;
  let targetId = null;

  document.querySelectorAll('.delete-dino-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      targetId = btn.dataset.id;
      targetRow = btn.closest('tr');
      modal.style.display = 'flex';
    });
  });

  cancelBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    targetRow = null;
    targetId = null;
  });

  confirmBtn.addEventListener('click', () => {
    if (!targetId) return;

    fetch('delete.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: new URLSearchParams({id: targetId})
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        targetRow.remove();
        modal.style.display = 'none';
      } else {
        alert("Fehler: " + (data.error || "Unbekannter Fehler"));
      }
    })
    .catch(err => {
      console.error(err);
      alert("Serverfehler beim Löschen.");
    });
  });
});

