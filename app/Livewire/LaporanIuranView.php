<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CivilianPivotSubscription;
use App\Models\Subscription;

class LaporanIuranView extends Component
{
    public $subscriptionId;
    public $subscriptionType = 'Iuran';
    public $subscriptions = [];
    public $civilians = [];

    public function mount()
    {
        $this->subscriptions = Subscription::all();
    }

    public function updatedSubscriptionId($value)
    {
        if ($value) {
            $subscription = Subscription::find($value);
            $this->subscriptionType = $subscription->name ?? 'Iuran';
            $this->loadData();
        } else {
            $this->civilians = [];
            $this->subscriptionType = 'Iuran';
        }

        // dd([
        //     'selected_value' => $value,
        //     'subscription_data' => Subscription::find($value)
        // ]);
    }

    // Helper method untuk normalisasi data paid_months
protected function normalizePaidMonths($paidMonths)
{
    if (empty($paidMonths)) {
        return [];
    }

    if (is_array($paidMonths)) {
        return $paidMonths;
    }

    if (is_string($paidMonths)) {
        $decoded = json_decode($paidMonths, true);
        return is_array($decoded) ? $decoded : [];
    }

    return [];
}

    public function loadData()
    {
        $data = CivilianPivotSubscription::with(['civilian', 'subscription'])
        ->where('subscription_id', $this->subscriptionId)
        ->get();

    $this->civilians = $data->map(function ($item) {
        $paidMonths = $this->normalizePaidMonths($item->paid_months);
        
        return [
            'id' => $item->id,
            'civilian_id' => $item->civilian_id,
            'name' => $item->civilian->full_name ?? 'N/A',
            'paid_months' => $paidMonths,
            // Tambahkan ini untuk debugging
            'paid_months_raw' => $item->paid_months 
        ];
    });
        
    }

    public function render()
    {
        return view('livewire.laporan-iuran-view');
    }
}