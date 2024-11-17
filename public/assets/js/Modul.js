// Function to open Delete Modal with animation
function openDeleteModal() {
    const modal = document.getElementById("deleteModal");
    const modalContent = modal.querySelector(".modal-content");
    
    modal.classList.add("show");
    modalContent.classList.add("animate");

    // Menghapus class animate agar animasi terjadi lagi setiap kali dibuka
    setTimeout(() => {
        modalContent.classList.remove("animate");
    }, 300);
}

// Function to close Delete Modal
function closeDeleteModal() {
    const modal = document.getElementById("deleteModal");
    modal.classList.remove("show");
}

// Function to confirm delete action
function confirmDelete() {
    alert("Modul berhasil dihapus.");
    closeDeleteModal();
}
