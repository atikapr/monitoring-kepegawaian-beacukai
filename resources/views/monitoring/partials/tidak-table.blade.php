<div class="tab-pane fade" id="tidak" role="tabpanel">
    <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('monitoring.export', 'tidak') }}" class="btn btn-primary">
        <i class="fas fa-download me-2"></i>Export CSV
    </a>
</div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="tidakTable">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama Lengkap</th>
                                        <th>Info Pegawai</th>
                                        <th>TMT Berikutnya</th>
                                        <th>Status</th>
                                        <th>Tindak Lanjut</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{ $item['nip'] }}</td>
                                        <td>{{ $item['nama_lengkap'] }}</td>
                                        <td>{{ $item['info_pegawai'] }}</td>
                                        <td data-sort="{{ \Carbon\Carbon::parse($item['tmt_berikutnya'])->format('Y-m-d') }}">
                                            {{ \Carbon\Carbon::parse($item['tmt_berikutnya'])->format('d F Y') }}
                                        </td>
                                        <td>
                                            <span class="badge bg-warning text-dark">Tidak Ditindaklanjuti</span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-success btn-custom btn-sm action-btn" 
                                                    data-status="Sudah" 
                                                    data-nip="{{ $item['nip'] }}" 
                                                    data-info="{{ $item['info_pegawai'] }}"
                                                    title="Tandai Sudah">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-danger btn-custom btn-sm action-btn" 
        data-status="Belum" 
        data-nip="{{ $item['nip'] }}" 
        data-info="{{ $item['info_pegawai'] }}"
        title="Kembalikan ke Belum">
    <i class="fas fa-exclamation-triangle"></i>
</button>

                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-info btn-custom btn-sm view-note" 
                                                    data-nip="{{ $item['nip'] }}" 
                                                    data-info="{{ $item['info_pegawai'] }}"
                                                    title="Lihat Catatan">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>