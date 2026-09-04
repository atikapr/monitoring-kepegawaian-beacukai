// Fungsi untuk memperbarui tabel
function updateTables(data) {
    console.log("Updating tables with:", data);

    // Fungsi helper untuk memformat tanggal
    function formatDate(dateString) {
        return new Date(dateString).toLocaleDateString("id-ID", {
            day: "numeric",
            month: "long",
            year: "numeric",
        });
    }

    // Fungsi untuk membuat baris tabel
    function createTableRow(item) {
        return `
            <tr>
                <td>${item.nip}</td>
                <td>${item.nama_lengkap}</td>
                <td>${item.info_pegawai}</td>
                <td>${formatDate(item.tmt_berikutnya)}</td>
                <td>
                    <!-- Tambahkan tombol atau checkbox sesuai kebutuhan -->
                    <div class="btn-group">
                        <button class="btn btn-success btn-sm update-status" 
                                data-nip="${item.nip}" 
                                data-jenis="${item.info_pegawai}" 
                                data-status="Sudah">
                            ✓
                        </button>
                        <!-- Tambahkan tombol lain jika diperlukan -->
                    </div>
                </td>
            </tr>
        `;
    }

    // Update setiap tabel
    ["belum", "sudah", "tidak"].forEach((status) => {
        const tableBody = document.querySelector(`#table-${status} tbody`);
        if (tableBody && data[status]) {
            tableBody.innerHTML = data[status].map(createTableRow).join("");
        }
    });
}

// Event handler untuk tombol update status
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("update-status")) {
        const nip = e.target.dataset.nip;
        const jenis = e.target.dataset.jenis;
        const status = e.target.dataset.status;

        // Tampilkan modal untuk input catatan
        // Asumsikan Anda memiliki modal dengan id 'catatanModal' dan input dengan id 'catatanInput'
        const modal = new bootstrap.Modal(
            document.getElementById("catatanModal")
        );
        modal.show();

        // Handler untuk submit catatan
        document.getElementById("submitCatatan").onclick = function () {
            const catatan = document.getElementById("catatanInput").value;

            // Kirim request ke server
            fetch("/monitoring/update-status", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    nip: nip,
                    jenis_info: jenis,
                    status: status,
                    catatan: catatan,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Update tampilan tabel dengan data baru
                        updateTables(data.updatedData);

                        // Tutup modal
                        modal.hide();

                        // Reset form
                        document.getElementById("catatanInput").value = "";

                        // Tampilkan notifikasi sukses
                        alert("Status berhasil diperbarui");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan saat memperbarui status");
                });
        };
    }
});
