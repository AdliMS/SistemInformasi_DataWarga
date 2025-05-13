<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanKategoriExport;

class LaporanKategoriExportController extends Controller
{
    public function export()
    {
        $filters = session('laporan_kategori_filter', []);
        return Excel::download(new LaporanKategoriExport($filters), 'laporan_kategori.xlsx');
    }
}
