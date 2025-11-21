function openConfirmModal(name, id) {
    document.getElementById('confirmObjectName').textContent = name;
    document.getElementById('btnConfirmLink').href = "index.php?action=mesReservations/confirm&id=" + id;
    document.getElementById('confirmModal').style.display = 'flex';
}

function openReportModal(objectName) {
    document.getElementById('reportModal').style.display = 'flex';
}

function openCancelModal(name, id) {
    document.getElementById('cancelObjectName').textContent = name;
    document.getElementById('btnCancelLink').href = "index.php?action=mesReservations/cancel&id=" + id;
    document.getElementById('cancelModal').style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal-overlay')) {
        event.target.style.display = 'none';
    }
}