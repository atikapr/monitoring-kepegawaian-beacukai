@extends('layouts.app')

@section('content')
<main class="mt-[80px]">
    <div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Info Pegawai</h1>
        <div class="text-end">
            <h5 id="currentDate" class="text-muted"></h5>
        </div>
    </div>

    <!-- Status Cards -->
<div class="row mb-4 g-4">
    <div class="col-md-4">
        <div class="status-card" data-status="belum">
            <div class="card-premium bg-danger">
                <div class="card-glass">
                    <div class="card-content">
                        <div class="icon-stack">
                            <div class="icon-circle">
                                <i class="fas fa-briefcase icon-primary"></i>
                            </div>
                            <div class="status-badge">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </div>
                        <div class="card-details">
                            <h5 class="status-title">Belum Ditindaklanjuti</h5>
                            <div class="counter-wrapper">
                                <span class="counter-number">{{ count($monitoringData['belum']) }}</span>
                                <small class="counter-label">Info Pegawai</small>
                            </div>
                        </div>
                        <div class="card-footer-custom">
                            <span class="view-details">Lihat Detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="status-card" data-status="sudah">
            <div class="card-premium bg-success">
                <div class="card-glass">
                    <div class="card-content">
                        <div class="icon-stack">
                            <div class="icon-circle">
                                <i class="fas fa-briefcase icon-primary"></i>
                            </div>
                            <div class="status-badge">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="card-details">
                            <h5 class="status-title">Sudah Ditindaklanjuti</h5>
                            <div class="counter-wrapper">
                                <span class="counter-number">{{ count($monitoringData['sudah']) }}</span>
                                <small class="counter-label">Info Pegawai</small>
                            </div>
                        </div>
                        <div class="card-footer-custom">
                            <span class="view-details">Lihat Detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="status-card" data-status="tidak">
            <div class="card-premium bg-warning">
                <div class="card-glass">
                    <div class="card-content">
                        <div class="icon-stack">
                            <div class="icon-circle">
                                <i class="fas fa-briefcase icon-primary"></i>
                            </div>
                            <div class="status-badge">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                        <div class="card-details">
                            <h5 class="status-title">Tidak Ditindaklanjuti</h5>
                            <div class="counter-wrapper">
                                <span class="counter-number">{{ count($monitoringData['tidak']) }}</span>
                                <small class="counter-label">Info Pegawai</small>
                            </div>
                        </div>
                        <div class="card-footer-custom">
                            <span class="view-details">Lihat Detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Main Content -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="belum-tab" data-bs-toggle="tab" href="#belum" role="tab">
                        Belum Ditindaklanjuti
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="sudah-tab" data-bs-toggle="tab" href="#sudah" role="tab">
                        Sudah Ditindaklanjuti
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tidak-tab" data-bs-toggle="tab" href="#tidak" role="tab">
                        Tidak Ditindaklanjuti
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <!-- Tab Belum -->
                @include('monitoring.partials.belum-table', ['data' => $monitoringData['belum']])
                
                <!-- Tab Sudah -->
                @include('monitoring.partials.sudah-table', ['data' => $monitoringData['sudah']])
                
                <!-- Tab Tidak -->
                @include('monitoring.partials.tidak-table', ['data' => $monitoringData['tidak']])
            </div>
        </div>
    </div>
</div>
</main>

@include('monitoring.partials.modals')
@endsection

@push('styles')
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
    .status-card {
    cursor: pointer;
    perspective: 1000px;
}

.card-premium {
    min-height: 280px;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
}

.card-glass {
    height: 100%;
    width: 100%;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05));
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.18);
}

.card-content {
    padding: 2rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    color: white;
}

.icon-stack {
    position: relative;
    margin-bottom: 1.5rem;
    width: fit-content;
}

.icon-circle {
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease;
}

.icon-primary {
    font-size: 2rem;
    color: white;
}

.status-badge {
    position: absolute;
    bottom: -5px;
    right: -5px;
    background: white;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.bg-warning {
    background-color: #e6a004 !important; /* Warna kuning yang lebih gelap */
}

.bg-danger .status-badge i {
    color: #dc3545;
}

.bg-success .status-badge i {
    color: #198754;
}

.bg-warning .status-badge i {
    color: #e6a004;
}

.status-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.counter-wrapper {
    text-align: center;
    margin: 1.5rem 0;
}

.counter-number {
    font-size: 3rem;
    font-weight: 700;
    line-height: 1;
    display: block;
    margin-bottom: 0.5rem;
}

.counter-label {
    font-size: 0.9rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.card-footer-custom {
    margin-top: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.view-details {
    font-size: 0.9rem;
    font-weight: 500;
    opacity: 0.9;
}

.card-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
    pointer-events: none;
}

/* Hover Effects */
.status-card:hover .card-premium {
    transform: translateY(-10px);
    box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
}

.status-card:hover .icon-circle {
    transform: scale(1.1) rotate(5deg);
}

.status-card:hover .card-footer-custom i {
    animation: slideRight 0.5s ease infinite;
}

@keyframes slideRight {
    0%, 100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(5px);
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-premium {
        min-height: 250px;
    }
    
    .counter-number {
        font-size: 2.5rem;
    }
}

.table {
            vertical-align: middle;
        }

        .table thead th {
            background: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 15px;
        }

.btn-primary {
    padding: 0.5rem 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary i {
    font-size: 1rem;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
let noteModal;
let viewNoteModal;
let currentActionData;

document.addEventListener('DOMContentLoaded', function() {
    initializeModals();
    initializeDateDisplay();
    initializeDataTables();
    initializeEventListeners();
});

function initializeModals() {
    noteModal = new bootstrap.Modal(document.getElementById('noteModal'));
    viewNoteModal = new bootstrap.Modal(document.getElementById('viewNoteModal'));
}

function initializeDateDisplay() {
    const currentDate = new Date().toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    document.getElementById('currentDate').textContent = currentDate;
}

function initializeDataTables() {
    ['belum', 'sudah', 'tidak'].forEach(status => {
        $(`#${status}Table`).DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            },
            order: status === 'sudah' ? [[6, 'desc']] : [[3, 'asc']],
            columnDefs: [{
                targets: [5, 6], // Action and Detail columns
                orderable: false
            }],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]]
        });
    });
}

function initializeEventListeners() {
    // Status card clicks
    document.querySelectorAll('.status-card').forEach(card => {
        card.addEventListener('click', function() {
            const status = this.dataset.status;
            document.querySelector(`#${status}-tab`).click();
        });
    });



    // Action buttons (checkmark dan undo)
    document.querySelectorAll('.action-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            currentActionData = {
                nip: this.dataset.nip,
                info: this.dataset.info,
                status: this.dataset.status,
                tmt_lama: this.dataset.tmt
            };

            // Reset modal catatan
        document.getElementById('noteCatatan').value = '';

            if (this.dataset.status === 'Sudah') {
                // Untuk tombol ceklis, tampilkan modal catatan
                document.getElementById('noteCatatan').value = '';
                noteModal.show();
            } else if (this.dataset.status === 'Tidak') {
                currentActionData = {
        nip: this.dataset.nip,
        info: this.dataset.info,
        status: 'Tidak',  // Pastikan nilai ini benar
        tmt_lama: this.dataset.tmt
    };
            // Untuk tombol silang, tampilkan modal catatan
            document.getElementById('noteCatatan').value = '';
            noteModal.show();
            } else if (this.dataset.status === 'Belum') {
                currentActionData = {
        nip: this.dataset.nip,
        info: this.dataset.info,
        status: 'Belum',
        tmt_lama: this.dataset.tmt
    };
    document.getElementById('noteCatatan').value = '';
    noteModal.show();
}
        });
    });

    // Save note button
    document.getElementById('saveNote').addEventListener('click', handleNoteSave);

    // View note buttons
    document.querySelectorAll('.view-note').forEach(btn => {
        btn.addEventListener('click', function() {
            handleViewNote(this.dataset.nip, this.dataset.info);
        });
    });
}

function handleNoteSave() {
    const catatan = document.getElementById('noteCatatan').value.trim();
    
    if (!catatan) {
        showError('Catatan harus diisi');
        return;
    }

    // Tambahkan konfirmasi khusus untuk perpindahan status
    let confirmMessage = '';
    if (currentActionData.status === 'Sudah') {
        confirmMessage = 'Apakah Anda yakin akan memindahkan data ke Sudah Ditindaklanjuti?';
    } else if (currentActionData.status === 'Belum') {
        confirmMessage = 'Apakah Anda yakin akan mengembalikan data ke Belum Ditindaklanjuti?';
    } else if (currentActionData.status === 'Tidak') {
        confirmMessage = 'Apakah Anda yakin akan memindahkan data ke Tidak Ditindaklanjuti?';
    }

    Swal.fire({
        title: 'Konfirmasi',
        text: confirmMessage,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            const requestData = {
                nip: currentActionData.nip,
                jenis_info: currentActionData.info,
                status: currentActionData.status,
                catatan: catatan,
                tmt_lama: currentActionData.tmt_lama
            };
            updateStatus(requestData);
        }
    });
}

function updateStatus(data) {
    fetch('/monitoring/update-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            noteModal.hide();
            showSuccess('Status berhasil diperbarui').then(() => {
                window.location.reload();
            });
        } else {
            throw new Error(result.message || 'Terjadi kesalahan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showError('Terjadi kesalahan saat memperbarui status');
    });
}

function handleViewNote(nip, info) {
    document.getElementById('noteContent').textContent = 'Memuat...';
    viewNoteModal.show();
    
    fetch(`/monitoring/get-note/${nip}/${info}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('noteContent').textContent = 
                data.success ? data.catatan : 'Tidak ada catatan';
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('noteContent').textContent = 
                'Error mengambil catatan';
        });
}

function showSuccess(message) {
    return Swal.fire({
        title: 'Sukses!',
        text: message,
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    });
}

function showError(message) {
    return Swal.fire({
        title: 'Error!',
        text: message,
        icon: 'error'
    });
}


</script>
@endpush