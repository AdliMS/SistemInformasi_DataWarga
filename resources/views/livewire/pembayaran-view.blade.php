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



    <!-- Tabel untuk Data civilians -->
    <table class="custom-table mt-4">
        <thead>
            <tr>
                <th>Jenis Iuran</th>
                <th>Nama Warga</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($subscriptions as $subscription)
                <tr wire:key="sub-{{ $subscription->id }}">

                    <td class="px-6 py-4 whitespace-nowrap">{{ $subscription->subscription->name }} - {{ $subscription->subscription->amount }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $subscription->civilian->full_name }}</td>

                    <td class="relative" x-data="{ open: false }">
                        <!-- Trigger Button -->
                        <button
                            @click="open = !open"
                            type="button"
                            class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none"
                        >
                            Pilih Bulan
                            <span class="ml-2 bg-gray-100 rounded-full px-2 py-0.5 text-xs">
                                {{ count($subscription->paid_months ?? []) }} terpilih
                            </span>
                            <svg class="-mr-1 ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    
                        <!-- Dropdown Menu -->
                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute left-4 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10"
                        >
                            <div class="py-1 max-h-60 overflow-y-auto">
                                
                    
                    
                                <!-- Month List -->
                                @foreach($subscription->availableMonths as $monthKey => $monthLabel)
                                    <label class="flex items-center px-4 py-2 text-sm cursor-pointer hover:bg-gray-50">
                                        <input 
                                            type="checkbox"
                                            {{ in_array($monthKey, $subscription->paid_months ?? []) ? 'checked' : '' }}
                                            wire:change="togglePayment({{ $subscription->id }}, '{{ $monthKey }}')"
                                            class="rounded text-green-600 focus:ring-green-500 mr-3"
                                        >
                                        <span class="text-gray-700">{{ $monthLabel }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </td>
                    @endforeach
                </tr>
        </tbody>
    </table>

</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
@endassets

