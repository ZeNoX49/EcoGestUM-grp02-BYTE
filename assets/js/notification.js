const drawer = document.getElementById('notif-drawer');
const overlay = document.getElementById('drawer-overlay');
const btnOpen = document.getElementById('open-notif');
const btnClose = document.getElementById('close-notif');

function toggleDrawer() {
  drawer.classList.toggle('open');
  overlay.classList.toggle('active');
}

function chargerNotification() {
  fetch('notification')
      .then(response => response.text())
      .then(data => {
        document.getElementById('notif-drawer').innerHTML = data;
        console.log(data)
      })
      .catch(error => console.error('Erreur:', error))
}
btnOpen.onclick = toggleDrawer;
btnClose.onclick = toggleDrawer;
overlay.onclick = toggleDrawer;
window.onload = chargerNotification;
console.log("Charger notification loaded");
