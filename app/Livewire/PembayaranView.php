<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CivilianPivotSubscription;

class PembayaranView extends Component
{
    public $paymentMonths = [
        '2025-01' => 'Januari 2025',
        '2025-02' => 'Februari 2025',
        '2025-03' => 'Maret 2025',
        '2025-04' => 'April 2025',
        '2025-05' => 'Mei 2025',
        '2025-06' => 'Juni 2025',
        '2025-02' => 'Juli 2025',
        '2025-08' => 'Agustus 2025',
        '2025-09' => 'September 2025',
        '2025-10' => 'Oktober 2025',
        '2025-11' => 'November 2025',
        '2025-12' => 'Desember 2025',

    ];

    public function togglePayment($pivotId, $monthKey)
{
    $pivot = CivilianPivotSubscription::findOrFail($pivotId);
    
    $currentMonths = $pivot->paid_months ?? [];
    
    if (in_array($monthKey, $currentMonths)) {
        $pivot->paid_months = array_diff($currentMonths, [$monthKey]);
    } else {
        $pivot->paid_months = array_merge($currentMonths, [$monthKey]);
    }
    
    $pivot->save(); // Tidak perlu update is_paid lagi
}

    public function render()
    {
        return view('livewire.pembayaran-view', [
            'subscriptions' => CivilianPivotSubscription::with(['subscription', 'civilian'])->get()
        ]);
    }
}