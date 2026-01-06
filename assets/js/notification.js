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
  fetch('notification')
      .then(response => response.text())
      .then(data => {
        document.getElementById('notif-drawer').innerHTML = data;
        updateBadge();
      })
      .catch(error => console.error('Erreur:', error))
}

function supprimerNotif(id){
  let formaData = new FormData();
  formaData.append('id', id);

  let formData = new FormData();
  formData.append('id', id);

  // 3. Appel AJAX vers le fichier de suppression
  fetch('notification/erase', {
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
          chargerNotification();
        }
      });
}

function updateBadge() {
  console.log("fonction lancé");
  fetch('notification/getCount')
      .then(response => response.text())
      .then(count => {
        badge.innerText = count;
        if (parseInt(count) === 0) {
          badge.style.display = 'none';
        } else {
          badge.style.display = 'inline-block';
        }
      });
}

setInterval(function() {
  updateBadge();
  chargerNotification();

}, 60000);
btnOpen.onclick = toggleDrawer;
btnClose.onclick = toggleDrawer;
overlay.onclick = toggleDrawer;
window.onload = updateBadge;
window.onload = chargerNotification;

