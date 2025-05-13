<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LaporanIuranExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanIuranExportController extends Controller
{
    public function export($subscriptionId)
    {
        return Excel::download(new LaporanIuranExport($subscriptionId), 'laporan_iuran.xlsx');
    }
}
