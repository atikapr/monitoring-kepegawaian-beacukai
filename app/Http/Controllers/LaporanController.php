<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Exception;

class LaporanController extends Controller
{
    public function index()
    {
        try {
            $data = $this->getAllData();
            return view('laporan.index', compact('data'));
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    public function downloadPDF()
    {
        try {
            $data = $this->getAllData();
            
            // Generate chart images for PDF
            $charts = $this->generateChartsForPDF($data);
            
            // Load PDF view with data and charts
            $pdf = PDF::loadView('laporan.pdf', [
                'data' => $data,
                'charts' => $charts,
                'tanggal' => Carbon::now()->locale('id')->isoFormat('D MMMM Y'),
                'waktu' => Carbon::now()->locale('id')->isoFormat('HH:mm:ss')
            ]);
            
            // Configure PDF settings
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOptions([
                'dpi' => 300,
                'defaultFont' => 'sans-serif',
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'margin_top' => 20,
                'margin_bottom' => 20,
                'margin_left' => 20,
                'margin_right' => 20
            ]);

            // Cleanup temporary files after generating PDF
            $this->cleanupTempFiles();

            return $pdf->download('laporan-kepegawaian-' . date('Y-m-d') . '.pdf');
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengunduh PDF: ' . $e->getMessage());
        }
    }

    private function generateChartsForPDF($data)
    {
        $charts = [];
        $tempPath = storage_path('app/public/temp/charts');
        
        // Create temp directory if not exists
        if (!File::exists($tempPath)) {
            File::makeDirectory($tempPath, 0777, true);
        }

        // Store base64 chart images temporarily
        foreach ($data as $key => $values) {
            if (is_array($values) && !empty($values)) {
                $filename = $key . '_' . time() . '.png';
                $filepath = $tempPath . '/' . $filename;
                
                // Create placeholder image with chart data
                // In production, you would use a proper charting library here
                $this->createPlaceholderChart($values, $filepath);
                
                $charts[$key] = $filepath;
            }
        }

        return $charts;
    }

    private function createPlaceholderChart($data, $filepath)
    {
        // This is a basic placeholder. In production, use a proper charting library
        $width = 800;
        $height = 400;
        
        $image = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        
        // Fill background
        imagefilledrectangle($image, 0, 0, $width, $height, $white);
        
        // Add some basic text
        $text = "Chart Placeholder";
        imagestring($image, 5, 10, 10, $text, $black);
        
        // Save image
        imagepng($image, $filepath);
        imagedestroy($image);
    }

    private function cleanupTempFiles()
    {
        $tempPath = storage_path('app/public/temp/charts');
        if (File::exists($tempPath)) {
            File::deleteDirectory($tempPath);
        }
    }

    private function getAllData()
    {
        $totalPegawai = Pegawai::count();

        // Jenis Kelamin dengan persentase dan formatting
        $jenisKelaminData = Pegawai::select('kode_kelamin')
            ->selectRaw('count(*) as total')
            ->groupBy('kode_kelamin')
            ->get()
            ->map(function ($item) use ($totalPegawai) {
                return [
                    'label' => $item->kode_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                    'value' => $item->total,
                    'percentage' => number_format(($item->total / $totalPegawai) * 100, 1),
                    'formatted_value' => number_format($item->total, 0, ',', '.'),
                    'icon' => $item->kode_kelamin === 'L' ? 'male' : 'female'
                ];
            })->values();

        // Pendidikan dengan sorting dan formatting
        $pendidikanData = Pegawai::select('pendidikan_terakhir')
            ->selectRaw('count(*) as total')
            ->groupBy('pendidikan_terakhir')
            ->orderBy('pendidikan_terakhir')
            ->get()
            ->map(function ($item) use ($totalPegawai) {
                return [
                    'label' => $item->pendidikan_terakhir,
                    'value' => $item->total,
                    'percentage' => number_format(($item->total / $totalPegawai) * 100, 1),
                    'formatted_value' => number_format($item->total, 0, ',', '.')
                ];
            })->values();

        // Seksi dengan formatting
        $seksiData = Pegawai::select('seksi')
            ->selectRaw('count(*) as total')
            ->whereNotNull('seksi')
            ->groupBy('seksi')
            ->orderBy('total', 'desc')
            ->get()
            ->map(function ($item) use ($totalPegawai) {
                return [
                    'label' => $item->seksi,
                    'value' => $item->total,
                    'percentage' => number_format(($item->total / $totalPegawai) * 100, 1),
                    'formatted_value' => number_format($item->total, 0, ',', '.')
                ];
            })->values();

        // Usia dengan range dan formatting
        $usiaRanges = [
            '20-30' => [20, 30],
            '31-40' => [31, 40],
            '41-50' => [41, 50],
            '51-60' => [51, 60],
            '> 60' => [61, 100]
        ];

        $usiaData = collect($usiaRanges)->map(function ($range, $key) use ($totalPegawai) {
            $count = Pegawai::whereBetween('usia', $range)->count();
            return [
                'label' => $key . ' tahun',
                'value' => $count,
                'percentage' => number_format(($count / $totalPegawai) * 100, 1),
                'formatted_value' => number_format($count, 0, ',', '.')
            ];
        })->values();

        // Status Pegawai dengan formatting
        $statusPegawaiData = Pegawai::select('status_pegawai')
            ->selectRaw('count(*) as total')
            ->groupBy('status_pegawai')
            ->orderBy('total', 'desc')
            ->get()
            ->map(function ($item) use ($totalPegawai) {
                return [
                    'label' => $item->status_pegawai,
                    'value' => $item->total,
                    'percentage' => number_format(($item->total / $totalPegawai) * 100, 1),
                    'formatted_value' => number_format($item->total, 0, ',', '.')
                ];
            })->values();

        // Lama Penugasan dengan range dan formatting
        $lamaPenempatanRanges = [
            '0-1 tahun' => [0, 1],
            '1-3 tahun' => [1, 3],
            '3-5 tahun' => [3, 5],
            '5-10 tahun' => [5, 10],
            '> 10 tahun' => [10, 100]
        ];

        $lamaPenempatanData = collect($lamaPenempatanRanges)->map(function ($range, $key) use ($totalPegawai) {
            $count = Pegawai::get()->filter(function ($pegawai) use ($range) {
                $years = Carbon::parse($pegawai->tmt_penempatan_seksi)->diffInYears(Carbon::now());
                return $years > $range[0] && $years <= $range[1];
            })->count();
            
            return [
                'label' => $key,
                'value' => $count,
                'percentage' => number_format(($count / $totalPegawai) * 100, 1),
                'formatted_value' => number_format($count, 0, ',', '.')
            ];
        })->values();

        // Lama Penugasan dengan range dan formatting
        $lamaPenugasanRanges = [
            '0-1 tahun' => [0, 1],
            '1-3 tahun' => [1, 3],
            '3-5 tahun' => [3, 5],
            '5-10 tahun' => [5, 10],
            '> 10 tahun' => [10, 100]
        ];

        $lamaPenugasanData = collect($lamaPenugasanRanges)->map(function ($range, $key) use ($totalPegawai) {
            $count = Pegawai::get()->filter(function ($pegawai) use ($range) {
                $years = Carbon::parse($pegawai->tmt_awal_penugasan)->diffInYears(Carbon::now());
                return $years > $range[0] && $years <= $range[1];
            })->count();
            
            return [
                'label' => $key,
                'value' => $count,
                'percentage' => number_format(($count / $totalPegawai) * 100, 1),
                'formatted_value' => number_format($count, 0, ',', '.')
            ];
        })->values();

        // Calculate additional statistics
        $statistik = [
            'total_pegawai' => number_format($totalPegawai, 0, ',', '.'),
            'rata_rata_usia' => number_format(Pegawai::avg('usia'), 1),
            'usia_termuda' => Pegawai::min('usia'),
            'usia_tertua' => Pegawai::max('usia'),
            'total_laki_laki' => number_format(Pegawai::where('kode_kelamin', 'L')->count(), 0, ',', '.'),
            'total_perempuan' => number_format(Pegawai::where('kode_kelamin', 'P')->count(), 0, ',', '.'),
        ];

        return [
            'jenisKelamin' => $jenisKelaminData,
            'pendidikan' => $pendidikanData,
            'seksi' => $seksiData,
            'usia' => $usiaData,
            'statusPegawai' => $statusPegawaiData,
            'lamaPenugasan' => $lamaPenugasanData,
            'statistik' => $statistik,
            'lamaPenempatan' => $lamaPenempatanData,
            'statistik' => $statistik
        ];
    }
}