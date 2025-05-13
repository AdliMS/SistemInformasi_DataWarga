<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPekerjaanExport;

class LaporanPekerjaanExportController extends Controller
{
    public function export()
    {
        $filters = session('laporan_pekerjaan_filter', []);
        return Excel::download(new LaporanPekerjaanExport($filters), 'laporan_pekerjaan.xlsx');
    }
}
