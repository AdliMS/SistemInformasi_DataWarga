<?php

use App\Livewire\FormKegiatan;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/isi-kegiatan', FormKegiatan::class)->name('form-kegiatan');
