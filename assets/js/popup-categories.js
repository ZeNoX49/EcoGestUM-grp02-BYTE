function openDeleteModal(categoryName, count) {
    document.getElementById('delCatName').textContent = categoryName;
    document.getElementById('delCatCount').textContent = count;

    // Afficher
    document.getElementById('modalDeleteCat').style.display = 'flex';
}

// GESTION MODALE EDITION / AJOUT
function openEditModal(name, desc, mode) {
    const modalTitle = document.querySelector('.modal-title-blue');
    const nameInput = document.getElementById('editCatNameInput');
    const descInput = document.getElementById('editCatDescInput');

    if (mode === 'new') {
        modalTitle.textContent = "Ajouter une catégorie";
        nameInput.value = "";
        descInput.value = "";
        nameInput.placeholder = "Ex: Matériel Informatique";
    } else {
        modalTitle.textContent = "Modifier la catégorie";
        nameInput.value = name;
        descInput.value = desc;
    }

    // Affiche
    document.getElementById('modalEditCat').style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Fermer au clic sur le fond gris
window.onclick = function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.style.display = 'none';
    }
}