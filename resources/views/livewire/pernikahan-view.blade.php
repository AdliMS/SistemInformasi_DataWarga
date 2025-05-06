<div>
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

    {{-- FILTER --}}
    <div class="p-4 mb-6 bg-white rounded-lg shadow">
        <div class="flex flex-wrap gap-4 items-end">
            <!-- selectbox untuk filter status pernikahan -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Status Pernikahan</label>
                <select 
                    wire:model.defer="statusPernikahan" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    >
                    <option value="" default>Semua</option>
                    <option value="belum_menikah">Belum menikah</option>
                    <option value="sudah_menikah">Sudah menikah</option>
                </select>
            </div>
            
            <!-- Input Pencarian Nama -->
            <div class="relative w-48">
                <label class="block text-sm font-medium text-gray-700">Nama Warga</label>
                <input
                    type="text"
                    wire:model.debounce.500ms="searchName"
                    placeholder="Cari nama warga..."
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                >
                {{-- <!-- Clear Button -->
                <button 
                    wire:click="$set('searchName', '')"
                    class="absolute right-2 top-2 text-gray-400 hover:text-gray-600"
                    style="{{ empty($searchName) ? 'display:none' : '' }}"
                >
                    ✕
                </button> --}}
            </div>
        
            <!-- tombol trigger filter -->
            <div class="inline-block  bg-slate-500 text-white rounded hover:bg-slate-600">
                <button 
                    wire:click="applyFilter"
                    wire:loading.attr="disabled"
                    wire:target="applyFilter"
                    class="inline-block px-4 py-2"
                >
                    {{-- Normal --}}
                    <span wire:loading.remove>Terapkan Filter</span>
    
                    {{-- Saat loading --}}
                    <span wire:loading class="flex items-center">
                        <div
                            class="flex items-center"
                        >
                            <svg class="animate-spin w-[0.8rem] mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            Terapkan Filter
                        </div>     
                    </span>
                </button>
            </div>
            
        </div>
    </div>

    <!-- TABEL DATA -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <th class="px-4 py-2 border">Status pernikahan</th>
                <th class="px-4 py-2 border">Nama lengkap</th>
                <th class="px-4 py-2 border">Umur</th>
                <th class="px-4 py-2 border">Jenis kelamin</th>
                <th class="px-4 py-2 border">No. HP</th>
            </thead>
            <tbody>
                @foreach ($civilians as $civilian)
                    <tr>
                        @if ($civilian->married_status)
                            <td class="px-4 py-2 border text-blue-500">
                                Sudah menikah
                            </td>
                        @else
                            <td class="px-4 py-2 border text-red-500">
                                Belum menikah
                            </td>
                        @endif
                        <td class="px-4 py-2 border">{{ $civilian->full_name }}</td>
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($civilian->born_date)->age . ' tahun' }}</td>
                        <td class="px-4 py-2 border"> 
                            @if ($civilian->gender)
                                Wanita
                            @else
                                Pria
                            @endif
                        </td>
                        <td class="px-4 py-2 border">{{ $civilian->phone_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets
