<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <style>
        /* Style untuk tabel */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
        }

        .custom-table th,
        .custom-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .custom-table th {
            background-color: #f7fafc;
            font-weight: 600;
            color: #4a5568;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        .custom-table tbody tr:hover {
            background-color: #f0f4f8;
        }

        /* style untuk pagination */
        .pagination-info {
            font-size: 0.875rem;
            color: #4a5568;
        }

        .pagination-select {
            padding: 6px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 0.875rem;
        }
    </style>

<!-- Notifikasi Error - Letakkan di bagian paling atas komponen -->
<div x-data="{ showError: false, errorMessage: '' }"
x-on:notify.window="showError = true; errorMessage = $event.detail.message; setTimeout(() => showError = false, 5000)"
x-show="showError"
x-transition
class="fixed inset-x-0 top-4 flex justify-center z-50">
<div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
   <span x-text="errorMessage" class="font-medium mx-4"></span>
   <button @click="showError = false" class="ml-4 text-white hover:text-gray-200">
       ✕
   </button>
</div>
</div>
    

<div>




        <!-- Filter -->
        <div class="flex gap-4">
            <select wire:model="selectedSubscription" class="border rounded px-4 py-2">
                @foreach($subscriptions as $sub)
                    <option value="{{ $sub->id }}">
                        {{ $sub->name }}
                    </option>
                @endforeach
            </select>
            <button 
                wire:click="applyFilter" 
                wire:loading.attr="disabled"
                class="bg-blue-500 px-4 py-2 rounded"
                >
                <span wire:loading wire:target="applyFilter" class="animate-spin mr-2">⏳</span>
                Terapkan Filter
            </button>
        </div>

        <!-- Form Tambah Transaksi -->
        <div x-data="{ showForm: false }" class="mb-6 relative">
            <!-- Tombol Trigger -->
            <button 
                @click="showForm = !showForm" 
                class="bg-blue-500 hover:bg-blue-600 text-black px-4 py-2 rounded flex items-center"
            >
                <span>+ Tambah Transaksi</span>
                <svg 
                    class="w-4 h-4 ml-2 transition-transform duration-200" 
                    :class="{ 'rotate-180': showForm }" 
                    fill="none" 
                    viewBox="0 0 24 24" 
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown Form -->
            <div 
                x-cloak
                x-show="showForm"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute z-10 mt-2 w-full md:w-96 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700"
            >
                <div class="p-4">
                    <!-- Input Fields -->
                    <div class="space-y-4">
                        <!-- Input Jumlah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah (Rp)</label>
                            <input 
                                type="number" 
                                wire:model="transactionAmount"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                placeholder="0"
                            >
                            @error('transactionAmount') 
                                <span class="text-red-500 text-xs">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Input Keterangan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Keterangan</label>
                            <input 
                                type="text" 
                                wire:model="transactionDescription"
                                class="w-full border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                placeholder="Contoh: Iuran bulanan"
                            >
                            @error('transactionDescription') 
                                <span class="text-red-500 text-xs">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4 flex justify-end space-x-2">
                        <button 
                            @click="showForm = false" 
                            type="button" 
                            class="px-3 py-1 text-sm border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            Batal
                        </button>
                        <button 
                            wire:click="saveTransaction"
                            wire:loading.attr="disabled"
                            class="px-4 py-2 bg-green-500 hover:bg-green-600 text-black rounded-md flex items-center"
                        >
                            <span wire:loading wire:target="saveTransaction" class="animate-spin mr-2">↻</span>
                            Simpan
                        </button>

                        <!-- Notifikasi Error -->
                        <div x-data="{ showError: false, message: '' }"
                        x-on:notify.window="showError = true; message = $event.detail.message; setTimeout(() => showError = false, 5000)"
                        x-show="showError"
                        class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded">
                        <span x-text="message"></span>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    
        <!-- Tabel Transaksi -->
        <table class="min-w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Keterangan</th>
                    <th class="px-4 py-2 text-right">Incoming</th>
                    <th class="px-4 py-2 text-right">Outgoing</th>
                    <th class="px-4 py-2 text-right">Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $trx)
                    <tr class="border-b">
                        <td class="px-4 py-2 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($trx['created_at'])->format('d M Y') }}
                        </td>
                        <td class="px-4 py-2">
                            {{ $trx['description'] }}
                            @if($trx['type'] === 'income')
                                <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                    Pemasukan
                                </span>
                            @else
                                <span class="ml-2 text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">
                                    Pengeluaran
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-right">
                            @if($trx['incoming'] > 0)
                                Rp{{ number_format($trx['incoming'], 0, ',', '.') }}
                            @endif
                        </td>
                        <td class="px-4 py-2 text-right">
                            @if($trx['outgoing'] > 0)
                                Rp{{ number_format($trx['outgoing'], 0, ',', '.') }}
                            @endif
                        </td>
                        <td class="px-4 py-2 text-right font-medium 
                            @if($trx['balance'] >= 0) text-green-600 @else text-red-600 @endif">
                            Rp{{ number_format($trx['balance'], 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
@endassets

{{-- works --}}