function openDeleteModal(objectName, deleteUrl) {
    //met à jours le texte avec le nom de l'objet cliqué
    document.getElementById('modalObjectName').textContent = objectName;
    
    //Ssa met à jour le lien du bouton rouge (pour supprimer le bon ID)
    document.getElementById('confirmDeleteBtn').href = deleteUrl;
    
    //affiche la popup
    document.getElementById('deleteModal').style.display = 'flex';
}

// Ferme la popup
function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Fermer quant on clique en dehors du popup
window.onclick = function(event) {
    const modal = document.getElementById('deleteModal');
    if (event.target == modal) {
        closeDeleteModal();
    }
}