import "./bootstrap";
import Chart from "chart.js/auto";
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();
document.querySelectorAll(".action-btn").forEach((button) => {
    button.addEventListener("click", function () {
        const nip = this.getAttribute("data-nip");
        const info = this.getAttribute("data-info");
        const status = this.getAttribute("data-status");

        // Panggil fungsi updateStatus
        updateStatus(nip, info, status);
    });
});

function updateStatus(nip, info, status) {
    console.log(`NIP: ${nip}, Info: ${info}, Status: ${status}`);
    // Tambahkan logika untuk update status
}
