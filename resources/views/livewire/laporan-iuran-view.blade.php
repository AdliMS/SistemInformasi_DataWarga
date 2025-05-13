<div>
    <style>
        /* Style untuk tabel */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
        }
        /* ... (keep your existing styles) ... */
    </style>

    <div class="p-4 mb-6 bg-white rounded-lg shadow">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Laporan iuran untuk: {{ $subscriptionType }}</h2>
        
        <div class="w-full md:w-1/3">
            <label for="subscription-select" class="block text-sm font-medium text-gray-700 mb-1">Pilih Jenis Iuran</label>
            <select 
                id="subscription-select"
                wire:model.live="subscriptionId" 
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
            >
                <option value="">-- Pilih Jenis Iuran --</option>
                @foreach($subscriptions as $subscription)
                    <option value="{{ $subscription->id }}">{{ $subscription->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if($subscriptionId)

        <div class="inline-block my-2 bg-green-500 text-white rounded hover:bg-green-600">
            <form method="GET" action="{{ route('laporan-iuran.export', ['subscriptionId' => $subscriptionId]) }}">
                <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition">
                    Ekspor ke Excel
                </button>
            </form>
        </div>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Warga</th>
                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $month)
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $month }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($civilians as $civilian)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $civilian['name'] }}
                                
                            </td>
                            @foreach (range(1, 12) as $month)
                                @php
                                    $monthFormatted = date('Y-m', mktime(0, 0, 0, $month, 1, date('Y')));
                                    $isPaid = in_array($monthFormatted, $civilian['paid_months'] ?? []) || 
                                            in_array($month, $civilian['paid_months'] ?? []);
                                @endphp
                                <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    @if($isPaid)
                                        <span class="text-green-500">✓</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada data yang tersedia untuk iuran ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="p-4 bg-white rounded-lg shadow text-center text-gray-500">
            Silakan pilih jenis iuran untuk melihat laporan
        </div>
    @endif
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets