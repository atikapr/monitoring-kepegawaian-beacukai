<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MonitoringHistory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class MonitoringController extends Controller
{
    public function index()
    {
        $monitoringData = $this->generateMonitoringData();
        return view('monitoring.index', compact('monitoringData'));
    }

    private function generateMonitoringData()
    {
        $data = collect();
        $today = Carbon::now();

        // Get all Monitoring data
        $monitoring = Monitoring::all()->keyBy(function ($item) {
            return $item->nip . '-' . $item->jenis_info;
        });

        // Function to calculate next TMT based on current TMT
        $calculateNextTmt = function($currentTmt, $type) {
            $years = match($type) {
                'Pangkat' => 4,
                'Grading', 'KGB' => 2,
                default => 2
            };
            return Carbon::parse($currentTmt)->addYears($years);
        };

        // Get history data for completed items
        $histories = MonitoringHistory::with('pegawai')
            ->orderBy('tanggal_tindak_lanjut', 'desc')
            ->get()
            ->map(function ($history) use ($today) {
                return [
                    'nip' => $history->nip,
                    'nama_lengkap' => $history->pegawai->nama_lengkap ?? '-',
                    'info_pegawai' => $history->jenis_info,
                    'tmt_lama' => $history->tmt,
                    'tmt_berikutnya' => $history->tmt_berikutnya,
                    'tanggal_tindak_lanjut' => $history->tanggal_tindak_lanjut,
                    'days_until' => $today->diffInDays($history->tmt_berikutnya, false),
                    'keterangan' => 'Sudah Ditindaklanjuti',
                    'catatan' => $history->catatan
                ];
            });

        // Function to generate monitoring data for each type
        $generateData = function($query, $type) use ($monitoring, $today, $calculateNextTmt) {
            return $query->get()->map(function ($p) use ($monitoring, $today, $type, $calculateNextTmt) {
                $key = $p->nip . '-' . $type;
                $monitoringRecord = $monitoring->get($key);
                $tmt_field = 'tmt_' . strtolower($type);

                // Handle TMT calculation based on monitoring status
                if ($monitoringRecord) {
                    $tmt = $monitoringRecord->tmt ?? $p->$tmt_field;
                    $tmt_berikutnya = $monitoringRecord->tmt_berikutnya;
                    $status = $monitoringRecord->status_tindak_lanjut;
                    $catatan = $monitoringRecord->catatan;
                } else {
                    $tmt = $p->$tmt_field;
                    $tmt_berikutnya = $calculateNextTmt($tmt, $type);
                    $status = 'Belum';
                    $catatan = null;
                }

                return [
                    'nip' => $p->nip,
                    'nama_lengkap' => $p->nama_lengkap,
                    'info_pegawai' => $type,
                    'tmt_lama' => $tmt,
                    'tmt_berikutnya' => $tmt_berikutnya,
                    'days_until' => $today->diffInDays($tmt_berikutnya, false),
                    'keterangan' => match($status) {
                        'Sudah' => 'Sudah Ditindaklanjuti',
                        'Tidak' => 'Tidak ditindaklanjuti',
                        default => 'Belum Ditindaklanjuti'
                    },
                    'catatan' => $catatan
                ];
            });
        };

        // Combine all data
        $data = collect([
            ...$generateData(Pegawai::whereNotNull('tmt_grading'), 'Grading'),
            ...$generateData(Pegawai::whereNotNull('tmt_pangkat'), 'Pangkat'),
            ...$generateData(Pegawai::whereNotNull('tmt_kgb'), 'KGB')
        ]);

        // Return sorted data by category
        return [
            'belum' => $data->where('keterangan', 'Belum Ditindaklanjuti')
                           ->sortBy('days_until')
                           ->values(),
            'sudah' => $histories->values(),
            'tidak' => $data->where('keterangan', 'Tidak ditindaklanjuti')
                           ->sortBy('days_until')
                           ->values()
        ];
    }

    public function updateStatus(Request $request)
    {
        try {
            \Log::info('Received update status request:', $request->all());

            $validated = $request->validate([
                'nip' => 'required',
                'jenis_info' => 'required',
                'status' => 'required|in:Sudah,Tidak,Belum',
                'catatan' => 'required|string'
            ]);

            $pegawai = Pegawai::where('nip', $validated['nip'])->firstOrFail();
            $tmt_field = 'tmt_' . strtolower($validated['jenis_info']);
            $current_tmt = $pegawai->$tmt_field;
            $now = Carbon::now();

            // Calculate years to add based on type
            $years_to_add = match($validated['jenis_info']) {
                'Pangkat' => 4,
                'Grading', 'KGB' => 2,
                default => 2
            };

            // Handle status changes
            switch($validated['status']) {
                case 'Sudah':
                    // Update pegawai's TMT
                    $pegawai->$tmt_field = $now;
                    $pegawai->save();

                    $tmt_berikutnya = $now->copy()->addYears($years_to_add);

                    // Create history record
                    MonitoringHistory::create([
                        'nip' => $validated['nip'],
                        'jenis_info' => $validated['jenis_info'],
                        'tmt' => $current_tmt,
                        'tmt_berikutnya' => $tmt_berikutnya,
                        'status_tindak_lanjut' => $validated['status'],
                        'catatan' => $validated['catatan'],
                        'tanggal_tindak_lanjut' => $now
                    ]);

                    // Delete existing monitoring record
                    Monitoring::where('nip', $validated['nip'])
                             ->where('jenis_info', $validated['jenis_info'])
                             ->delete();
                    break;

                case 'Tidak':
                    $tmt_berikutnya = Carbon::parse($current_tmt)->addYears($years_to_add);
                    
                    // Update or create monitoring record
                    Monitoring::updateOrCreate(
                        [
                            'nip' => $validated['nip'],
                            'jenis_info' => $validated['jenis_info']
                        ],
                        [
                            'status_tindak_lanjut' => 'Tidak',
                            'tmt' => $current_tmt,
                            'tmt_berikutnya' => $tmt_berikutnya,
                            'keterangan' => 'Tidak ditindaklanjuti',
                            'catatan' => $validated['catatan']
                        ]
                    );
                    break;

                case 'Belum':
    // Update status to 'Belum' without deleting the record
    Monitoring::updateOrCreate(
        [
            'nip' => $validated['nip'],
            'jenis_info' => $validated['jenis_info']
        ],
        [
            'status_tindak_lanjut' => 'Belum',
            'catatan' => $validated['catatan'] // Tetap menyimpan catatan
        ]
    );
    break;

            }

            \Log::info('Status updated successfully');

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui',
                'data' => $this->generateMonitoringData()
            ]);

        } catch (\Exception $e) {
            \Log::error('Error updating status:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getNote($nip, $jenis_info)
    {
        try {
            $monitoring = Monitoring::where('nip', $nip)
                                  ->where('jenis_info', $jenis_info)
                                  ->first();

            $history = MonitoringHistory::where('nip', $nip)
                                      ->where('jenis_info', $jenis_info)
                                      ->orderBy('tanggal_tindak_lanjut', 'desc')
                                      ->first();

            $catatan = $monitoring?->catatan ?? $history?->catatan ?? 'Tidak ada catatan';

            return response()->json([
                'success' => true,
                'catatan' => $catatan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function exportCsv($type)
{
    // Get data based on type
    $monitoringData = $this->generateMonitoringData();
    $data = $monitoringData[$type] ?? collect();
    
    // Define filename
    $filename = 'monitoring_' . $type . '_' . date('Y-m-d_His') . '.csv';
    
    // Create the response
    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );
    
    // Create the CSV
    $handle = fopen('php://temp', 'r+');
    
    // Add headers based on type
    switch($type) {
        case 'belum':
        case 'tidak':
            fputcsv($handle, ['NIP', 'Nama Lengkap', 'Info Pegawai', 'TMT Berikutnya', 'Status', 'Catatan']);
            foreach ($data as $row) {
                fputcsv($handle, [
                    $row['nip'],
                    $row['nama_lengkap'],
                    $row['info_pegawai'],
                    Carbon::parse($row['tmt_berikutnya'])->format('d F Y'),
                    $row['keterangan'],
                    $row['catatan'] ?? '-'
                ]);
            }
            break;
            
        case 'sudah':
            fputcsv($handle, ['NIP', 'Nama Lengkap', 'Info Pegawai', 'TMT Lama', 'TMT Berikutnya', 'Tanggal Tindak Lanjut', 'Status', 'Catatan']);
            foreach ($data as $row) {
                fputcsv($handle, [
                    $row['nip'],
                    $row['nama_lengkap'],
                    $row['info_pegawai'],
                    Carbon::parse($row['tmt_lama'])->format('d F Y'),
                    Carbon::parse($row['tmt_berikutnya'])->format('d F Y'),
                    Carbon::parse($row['tanggal_tindak_lanjut'])->format('d F Y'),
                    $row['keterangan'],
                    $row['catatan'] ?? '-'
                ]);
            }
            break;
    }
    
    rewind($handle);
    $content = stream_get_contents($handle);
    fclose($handle);
    
    return response($content, 200, $headers);
}
}