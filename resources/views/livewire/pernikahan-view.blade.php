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

    <div class="flex h-20 p-2 gap-2 items-center">
        <!-- selectbox untuk filter status pernikahan -->
        <select 
            wire:model.defer="statusPernikahan" 
            class="js-example-basic-single">
                <option value="" default>Semua</option>
                <option value="belum_menikah">Belum menikah</option>
                <option value="sudah_menikah">Sudah menikah</option>
        </select>

        <!-- Input Pencarian Nama -->
        <div class="relative w-48">
            <input
                type="text"
                wire:model.debounce.500ms="searchName"
                placeholder="Cari nama warga..."
                class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
            >
            <!-- Clear Button -->
            <button 
                wire:click="$set('searchName', '')"
                class="absolute right-2 top-2 text-gray-400 hover:text-gray-600"
                style="{{ empty($searchName) ? 'display:none' : '' }}"
            >
                ✕
            </button>
        </div>
    
        <!-- tombol trigger filter -->
        <button 
            wire:click="applyFilter"
            wire:loading.attr="disabled"
            class="bg-blue-500 font-medium px-2 rounded-lg flex items-center h-10"
        >
            <span wire:loading wire:target="applyFilter" class="animate-spin">⏳</span>
            Terapkan Filter
        </button>
    </div>
    

    <!-- Tabel untuk Data civilians -->
    <table class="custom-table mt-4">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">Status pernikahan</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">Nama lengkap</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">Umur</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">Jenis kelamin</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">No. HP</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($civilians as $civilian)
                <tr>
                    @if ($civilian->married_status)
                        <td class="px-6 py-4 whitespace-nowrap text-blue-500">
                            Sudah menikah
                        </td>
                    @else
                        <td class="px-6 py-4 whitespace-nowrap text-red-500">
                            Belum menikah
                        </td>
                    @endif
                    <td class="px-6 py-4 whitespace-nowrap">{{ $civilian->full_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($civilian->born_date)->age . ' tahun' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap"> 
                        @if ($civilian->gender)
                            Wanita
                        @else
                            Pria
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $civilian->phone_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets
