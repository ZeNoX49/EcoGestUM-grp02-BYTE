
function showSection(sectionId, element) {
    //Cache les sections pas active
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(sec => sec.classList.remove('active-section'));

    // Afficher la section demandée
    document.getElementById(sectionId).classList.add('active-section');

    //Gere la classe "active" sur le menu de gauche
    if (element) {
    const menuItems = document.querySelectorAll('.profile-sidebar li');
    menuItems.forEach(item => item.classList.remove('active'));
    element.classList.add('active');
    }
}

