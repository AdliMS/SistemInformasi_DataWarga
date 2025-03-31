<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Civilian;
use Illuminate\Support\Carbon;
use App\Models\CivilianPivotSubscription;

class PembayaranView extends Component
{
    public $paymentMonths = [];

    /**
     * Generate bulan mulai dari tanggal registrasi hingga Desember tahun ini
     */
    private function generateMonthsFromRegistrationDate($registrationDate)
    {
        $months = [];
        $startDate = Carbon::parse($registrationDate);
        $endDate = Carbon::now()->endOfYear(); // Sampai akhir tahun ini

        $currentDate = $startDate->copy()->startOfMonth();

        while ($currentDate <= $endDate) {
            $key = $currentDate->format('Y-m');
            $label = $currentDate->translatedFormat('F Y'); // Format: "Maret 2023"
            $months[$key] = $label;
            $currentDate->addMonth();
        }

        return $months;
    }

    public function togglePayment($pivotId, $monthKey)
    {
        $pivot = CivilianPivotSubscription::findOrFail($pivotId);
        $currentMonths = $pivot->paid_months ?? [];

        // Pastikan $currentMonths selalu array sequential
        $currentMonths = array_values($currentMonths);

        if (in_array($monthKey, $currentMonths)) {
            $currentMonths = array_diff($currentMonths, [$monthKey]);
        } else {
            $currentMonths = array_merge($currentMonths, [$monthKey]);
        }

        // Pastikan format tetap konsisten
        $pivot->paid_months = array_values(array_unique($currentMonths));
        $pivot->save();
    }

    public function render()
    {
        $subscriptions = CivilianPivotSubscription::with(['subscription', 'civilian'])
            ->get()
            ->map(function ($subscription) {
                $subscription->availableMonths = $this->generateMonthsFromRegistrationDate(
                    $subscription->civilian->created_at
                );
                return $subscription;
            });

        return view('livewire.pembayaran-view', [
            'subscriptions' => $subscriptions
        ]);
    }
}
