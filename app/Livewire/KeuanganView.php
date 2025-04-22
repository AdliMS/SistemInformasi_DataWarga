<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use App\Models\CivilianPivotSubscription;

class KeuanganView extends Component
{
    public $selectedSubscription = ''; // Ubah nama variabel
    public $subscriptions; // Simpan daftar iuran
    public $transactions = [];
    public $isLoading = false;
    public $showExpenseForm = false;
    public $expenseName = '';
    public $expenseAmount = '';
    public $expenses = []; // Tambah variabel untuk menyimpan data pengeluaran
    public $activeRowId; // Tambahkan ini untuk menyimpan ID baris yang aktif

    // Tambahkan property untuk form
    public $transactionAmount;
    public $transactionDescription;

    public function mount()
    {
        // Load semua iuran
        $this->subscriptions = Subscription::with('category')->get(); 

        // Set default ke air A atau item pertama
        $this->selectedSubscription = $this->subscriptions->firstWhere('name', 'air A')?->id
            ?? $this->subscriptions->first()->id;

        $this->applyFilter();
        $this->loadExpenses();
    }

    public function applyFilter()
    {
        $this->isLoading = true;

        $query = Expense::query()
            ->when($this->selectedSubscription, fn($q) => $q->where('subscription_id', $this->selectedSubscription))
            ->orderBy('created_at');

        // Hitung balance kumulatif
        $balance = 0;
        $this->transactions = $query->get()
            ->map(function ($expense) use (&$balance) {
                $description = $expense->is_income
                    ? "iuran " . ($expense->civilianPivotSubscription->civilian->full_name ?? 'N/A')
                    : $expense->expense_name;

                $balance += $expense->is_income ? $expense->amount : -$expense->amount;

                return [
                    'created_at' => $expense->created_at, // Sertakan created_at
                    'description' => $description,
                    'incoming' => $expense->is_income ? $expense->amount : 0,
                    'outgoing' => !$expense->is_income ? $expense->amount : 0,
                    'balance' => $balance,
                    'type' => $expense->is_income ? 'income' : 'expense'
                ];
            })
            ->toArray();

        $this->isLoading = false;
    }

    // Method untuk load data pengeluaran
    public function loadExpenses()
    {
        $query = Expense::query()
            ->when($this->selectedSubscription, fn($q) => $q->where('subscription_id', $this->selectedSubscription));

        $this->expenses = $query->get();
    }

    private function calculateCurrentBalance()
    {
        return Expense::where('subscription_id', $this->selectedSubscription)
            ->get()
            ->reduce(function ($balance, $expense) {
                return $expense->is_income 
                    ? $balance + $expense->amount 
                    : $balance - $expense->amount;
            }, 0);
    }

    // Method untuk menyimpan transaksi
    public function saveTransaction()
{
    $this->validate([
        'transactionAmount' => 'required|numeric',
        'transactionDescription' => 'required',
    ]);

    // Auto-detect jenis transaksi
    $isIncome = str_contains(strtolower($this->transactionDescription), 'iuran');
    
    // Validasi khusus pengeluaran
    if (!$isIncome) {
        $currentBalance = $this->calculateCurrentBalance();
        
        if ($this->transactionAmount > $currentBalance) {
            $this->dispatch('notify', 
                type: 'error',
                message: 'Saldo tidak mencukupi! Saldo tersedia: Rp'.number_format($currentBalance, 0, ',', '.')
            );
            return;
        }
    }

    Expense::create([
        'expense_name' => $this->transactionDescription,
        'amount' => $this->transactionAmount,
        'is_income' => $isIncome,
        'subscription_id' => $this->selectedSubscription,
    ]);

    $this->reset(['transactionAmount', 'transactionDescription']);
    $this->applyFilter();
}

    public function render()
    {
        return view('livewire.keuangan-view');
    }
}
