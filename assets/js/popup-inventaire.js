// Ouvrir la modale
function openInventaireEditModal(objectName, objectStatut, objectQuantities, url) {
    document.getElementById('modalObjectNameEdit').value = objectName;
    document.getElementById('modalObjectQuantitiesEdit').value = objectQuantities;
    document.getElementById('modalEditObject').style.display = 'flex';
}
// Fermer la modale
function closeModal() {
    document.getElementById('modalEditObject').style.display = 'none';
}
// Fermer si on clique sur le fond gris
window.onclick = function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        closeModal();
    }
}