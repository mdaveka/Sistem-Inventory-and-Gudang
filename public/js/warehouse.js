// public/js/warehouse.js

function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.add('flex');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.remove('flex');
}

// Fungsi khusus untuk mengisi data ke Modal Edit Gudang
function openEditModal(id, name, location) {
    // Ubah URL action pada form edit
    const form = document.getElementById('form-edit-warehouse');
    form.action = `/warehouse/${id}`;
    
    // Isi inputan dengan data yang diklik
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_location').value = location;
    
    // Buka modalnya
    openModal('modal-edit');
}