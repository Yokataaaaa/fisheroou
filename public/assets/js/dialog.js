// Menampilkan dialog form
document.getElementById('addDataBtn').addEventListener('click', function() {
    document.getElementById('dataDialog').style.display = 'flex';
});

// Menutup dialog form
document.getElementById('closeDialog').addEventListener('click', function() {
    document.getElementById('dataDialog').style.display = 'none';
});

// Menangani submit form dan menambahkan data ke tabel
document.getElementById('dataForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Ambil nilai dari input form
    const nama = document.getElementById('nama').value;
    const posisi = document.getElementById('posisi').value;
    const umur = document.getElementById('umur').value;
    const tanggalMulai = document.getElementById('tanggalMulai').value;

    // Tambahkan baris baru ke tabel
    const table = document.getElementById('datatable2').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();
    newRow.innerHTML = `<td>${nama}</td><td>${posisi}</td><td>${umur}</td><td>${tanggalMulai}</td>`;

    // Reset form dan tutup dialog
    document.getElementById('dataForm').reset();
    document.getElementById('dataDialog').style.display = 'none';
});
