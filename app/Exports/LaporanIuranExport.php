<?php

namespace App\Exports;

use App\Models\CivilianPivotSubscription;
use App\Models\Expense;
use App\Models\SubscriptionTransaction;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanIuranExport implements FromArray, WithHeadings
{
    protected $subscriptionId;
    protected $finalBalance;

    public function __construct($subscriptionId)
    {
        $this->subscriptionId = $subscriptionId;

        // Hitung saldo akhir dari transaksi subscription terkait
        $transactions = Expense::where('subscription_id', $this->subscriptionId)
            ->orderBy('created_at')
            ->get();

        $totalIncome = $transactions->where('is_income', 1)->sum('amount');
        $totalOutgoing = $transactions->where('is_income', 0)->sum('amount');
        $balance = $totalIncome - $totalOutgoing;

        // Simpan hasil saldo akhir
        $this->finalBalance = $balance;
    }

    public function array(): array
    {
        $records = CivilianPivotSubscription::with('civilian')
            ->where('subscription_id', $this->subscriptionId)
            ->get();

        $data = [];
        $first = true; // untuk menandai baris pertama

        foreach ($records as $record) {
            $paidMonthsRaw = $record->paid_months ?? [];
            $paidMonths = [];

            foreach ($paidMonthsRaw as $monthStr) {
                $parts = explode('-', $monthStr);
                if (count($parts) === 2) {
                    $paidMonths[] = (int) $parts[1];
                }
            }

            $row = [
                'nama' => $record->civilian->full_name,
            ];

            for ($month = 1; $month <= 12; $month++) {
                $row[] = in_array($month, $paidMonths) ? '✓' : '-';
            }

            // Hanya baris pertama yang menampilkan saldo
            if ($first) {
                $row[] = 'Rp' . number_format($this->finalBalance, 0, ',', '.');
                $first = false;
            } else {
                $row[] = '';
            }

            $data[] = $row;
        }

        return $data;
    }


    public function headings(): array
    {
        return array_merge(
            ['Nama warga'],
            ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'],
            ['Balance']
        );
    }

}
