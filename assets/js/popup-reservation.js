//ouvrir le popup de Confirmation (Vert)
function openConfirmModal(objectName) {
    document.getElementById('confirmObjectName').textContent = objectName;
    document.getElementById('confirmModal').style.display = 'flex';
}

// ouvrir le popup de Signalement
function openReportModal(objectName) {
    document.getElementById('reportModal').style.display = 'flex';
}

// Ffermer un popup
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

//au clic en dehors de la boîte blanche
window.onclick = function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.style.display = 'none';
    }
}