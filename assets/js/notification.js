const drawer = document.getElementById('notif-drawer');
const overlay = document.getElementById('drawer-overlay');
const btnOpen = document.getElementById('open-notif');
const btnClose = document.getElementById('close-notif');
const badge = document.getElementById('notif-badge');

function toggleDrawer() {
  drawer.classList.toggle('open');
  overlay.classList.toggle('active');
}

function chargerNotification() {
  fetch('index.php?action=notification/show')
    .then(response => response.text())
    .then(data => {
      document.getElementById('notif-content').innerHTML = data;
      updateBadge();
    })
    .catch(error => console.error('Erreur:', error));
}

function supprimerNotif(id) {
  const formData = new FormData();
  formData.append('id', id);

  fetch('index.php?action=notification/erase', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(result => {
      if (result.trim() === "success") {
        const element = document.getElementById('notif-' + id);
        element.style.transition = "0.3s";
        element.style.opacity = "0";
        setTimeout(() => element.remove(), 300);
        updateBadge();
      }
    });
}

function updateBadge() {
  fetch('index.php?action=notification/getCount')
    .then(response => response.text())
    .then(count => {
      badge.innerText = count;
      badge.style.display = parseInt(count) === 0 ? 'none' : 'inline-block';
    });
}

/* Rafraîchissement auto */
setInterval(() => {
  updateBadge();
  chargerNotification();
}, 60000);

btnOpen.onclick = toggleDrawer;
btnClose.onclick = toggleDrawer;
overlay.onclick = toggleDrawer;

/* ⚠️ window.onload ne doit être défini qu’UNE fois */
window.onload = () => {
  updateBadge();
  chargerNotification();
};
