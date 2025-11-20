//ouvr le popup d'approbation
function openApproveModal(requestName) {
    document.getElementById('approveNamePlace').textContent = requestName;
    // Affiche la modale
    document.getElementById('modalApprove').style.display = 'flex';
}

// ouvr le popup de refus
function openRefuseModal(requestName) {
    document.getElementById('refuseNamePlace').textContent = requestName;
    // Affiche la modale
    document.getElementById('modalRefuse').style.display = 'flex';
}

//fermer une modale par son ID
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Fermer si on clique sur le fond gris
window.onclick = function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.style.display = 'none';
    }
}