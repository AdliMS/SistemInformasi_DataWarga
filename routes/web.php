<?php

use App\Livewire\FormKegiatan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanIuranExportController;
use App\Http\Controllers\LaporanKategoriExportController;
use App\Http\Controllers\LaporanKegiatanExportController;
use App\Http\Controllers\LaporanPekerjaanExportController;
use App\Http\Controllers\LaporanPernikahanExportController;


Route::get('/isi-kegiatan', FormKegiatan::class)->name('form-kegiatan');
Route::get('/laporan-kategori/export', [LaporanKategoriExportController::class, 'export'])->name('laporan-kategori.export');
Route::get('/laporan-iuran/export/{subscriptionId}', [LaporanIuranExportController::class, 'export'])
    ->name('laporan-iuran.export');
Route::get('/laporan-pekerjaan/export', [LaporanPekerjaanExportController::class, 'export'])->name('laporan-pekerjaan.export');
Route::get('/laporan-kegiatan/export', [LaporanKegiatanExportController::class, 'export'])->name('laporan-kegiatan.export');
Route::get('/laporan-pernikahan/export', [LaporanPernikahanExportController::class, 'export'])->name('laporan-pernikahan.export');