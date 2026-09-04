<div class="tab-pane fade" id="sudah" role="tabpanel">
    <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('monitoring.export', 'sudah') }}" class="btn btn-primary">
        <i class="fas fa-download me-2"></i>Export CSV
    </a>
</div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="sudahTable">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama Lengkap</th>
                                        <th>Info Pegawai</th>
                                        <th>TMT Lama</th>
                                        <th>TMT Berikutnya</th>
                                        <th>Tanggal Tindak Lanjut</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td>{{ $item['nip'] }}</td>
                                        <td>{{ $item['nama_lengkap'] }}</td>
                                        <td>{{ $item['info_pegawai'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['tmt_lama'])->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['tmt_berikutnya'])->format('d F Y') }}</td>
                                        <td data-sort="{{ \Carbon\Carbon::parse($item['tanggal_tindak_lanjut'])->format('Y-m-d') }}">
                                            {{ \Carbon\Carbon::parse($item['tanggal_tindak_lanjut'])->format('d F Y') }}
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Sudah Ditindaklanjuti</span>
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