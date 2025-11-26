//ouvr le popup d'approbation
function openApproveModal(objectName, url) {
    document.getElementById('approveNamePlace').textContent = objectName;
    // Affiche la modale
    document.getElementById('modalApprove').style.display = 'flex';
}

// ouvr le popup de refus
function openRefuseModal(objectName, url) {
    document.getElementById('refuseNamePlace').textContent = objectName;
    document.getElementById('confirmRefuserButton').onclick = () => changeLocation(url);

    // Affiche la modale
    document.getElementById('modalRefuse').style.display = 'flex';
}
function changeLocation(url){
    window.location.href = url;
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