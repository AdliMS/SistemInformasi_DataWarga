<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPernikahanExport;

class LaporanPernikahanExportController extends Controller
{
    public function export(Request $request)
    {
        $status = session('statusPernikahan');
        $name = session('searchName');

        return Excel::download(new LaporanPernikahanExport($status, $name), 'laporan-pernikahan.xlsx');
    }

}
