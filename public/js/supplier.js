// public/js/supplier.js

function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.add('flex');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.remove('flex');
}

// Fungsi khusus untuk mengisi data ke Modal Edit
function openEditModal(id, name, phone, address) {
    // Ubah URL action pada form edit
    const form = document.getElementById('form-edit-supplier');
    form.action = `/supplier/${id}`;
    
    // Isi inputan dengan data yang diklik
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_phone').value = phone;
    document.getElementById('edit_address').value = address;
    
    // Buka modalnya
    openModal('modal-edit');
}
