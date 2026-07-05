function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.add('flex');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.remove('flex');
}

function openEditModal(id, barcode, name, supplier_id, stock, min_stock) {
    const form = document.getElementById('form-edit-item');
    form.action = `/items/${id}`;
    
    document.getElementById('edit_barcode').value = barcode;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_supplier_id').value = supplier_id;
    document.getElementById('edit_stock').value = stock;
    document.getElementById('edit_min_stock').value = min_stock;
    
    openModal('modal-edit');
}
