function openEditModal(id, name, desc, icon, status, mode) {
    const modalTitle = document.getElementById('modalTitle');
    const form = document.getElementById('editCatForm');
    const idInput = document.getElementById('editCatIdInput');
    const nameInput = document.getElementById('editCatNameInput');
    const descInput = document.getElementById('editCatDescInput');
    const statusInput = document.getElementById('editCatStatusInput');
    const radios = document.getElementsByName('image_categorie');

    if (mode === 'new') {
        modalTitle.textContent = "Ajouter une catégorie";
        form.action = "index.php?action=gestionCategories/add";
        idInput.value = "";
        nameInput.value = "";
        descInput.value = "";
        if(statusInput) statusInput.value = "Active";

        if(radios.length > 0) radios[0].checked = true;
    } else {
        modalTitle.textContent = "Modifier la catégorie";
        form.action = "index.php?action=gestionCategories/update";
        idInput.value = id;
        nameInput.value = name;
        descInput.value = desc;
        if(statusInput) statusInput.value = status;

        for(let radio of radios) {
            if(radio.value === icon) {
                radio.checked = true;
            }
        }
    }

    document.getElementById('modalEditCat').style.display = 'flex';
}

function openDeleteModal(id, categoryName, count) {
    document.getElementById('delCatName').textContent = categoryName;
    document.getElementById('delCatCount').textContent = count;
    document.getElementById('deleteIdInput').value = id;
    document.getElementById('modalDeleteCat').style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.style.display = 'none';
    }
}