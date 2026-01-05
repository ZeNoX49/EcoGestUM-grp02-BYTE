const dataTransfer = new DataTransfer();
function previewImages(input) {
    const gallery = document.getElementById('previewGallery');
    if (input.files && input.files.length > 0) {
        for (let i = 0; i < input.files.length; i++) {
            const file = input.files[i];
            let isDuplicate = false;
            for (let j = 0; j < dataTransfer.items.length; j++) {
                const existingFile = dataTransfer.items[j].getAsFile();
                if (existingFile.name === file.name && existingFile.size === file.size) {
                    isDuplicate = true;
                    break;
                }
            }
            if (!isDuplicate) {
                dataTransfer.items.add(file);
            }
        }
    }
    input.files = dataTransfer.files;
    gallery.innerHTML = '';
    if (dataTransfer.files.length > 0) {
        Array.from(dataTransfer.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-thumb');
                    gallery.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        });
    } else {
        gallery.innerHTML = '<span class="gallery-placeholder">Aucune image sélectionnée</span>';
    }
}