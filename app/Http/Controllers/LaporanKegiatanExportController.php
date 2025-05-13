<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKegiatanExport;

class LaporanKegiatanExportController extends Controller
{
    public function export()
    {
        $filters = session('laporan_kegiatan_filter', []);
        return Excel::download(new LaporanKegiatanExport($filters), 'laporan_kegiatan.xlsx');
    }
}
