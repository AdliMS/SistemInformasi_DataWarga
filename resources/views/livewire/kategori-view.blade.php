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
        
        <div class="flex flex-row justify-between">

            <div class="flex flex-wrap gap-4 items-end">

                <!-- Selectbox untuk filter kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select 
                        wire:model.defer="selectedCategory" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="" default>Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                    </select>
                </div>

                <!-- Input Pencarian Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Warga</label>
                    <input
                        type="text"
                        wire:model.debounce.500ms="searchName"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        placeholder="Cari nama warga..."
                    >
                </div>

                <!-- Tombol Filter -->
                <div class="inline-block bg-slate-500 text-white rounded hover:bg-slate-600">
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

                        {{-- <span wire:loading wire:target="applyFilter" class="animate-spin">⏳</span> --}}
                    </button>
                </div>

                <div class="inline-block bg-green-500 text-white rounded hover:bg-green-600">
                    <button wire:click="exportToExcel" class="bg-green-600 px-4 py-2 rounded text-white">
                        Export ke Excel
                    </button>
                    
                    <script>
                        window.addEventListener('triggerExcelDownload', function () {
                            window.location.href = "{{ route('laporan-kategori.export') }}";
                        });
                    </script>
                    
                </div>
            </div>

            <div class="flex h-20 pt-2 gap-2 justify-end">
                <div class="mt-8">
                    @if (!$appliedCategory)
                        <div class="mb-6 w-fit px-4 py-2  bg-blue-200 text-white text-left rounded">
                            <button class="flex items-center" disabled>
                                + Tambah Data
                            </button>
                        </div>
                    @else
                        <div class="mb-6 w-fit  bg-blue-500 hover:bg-blue-600 text-white text-left rounded">
                            <a 
                            href="{{ route('form-warga', ['category_id' => $appliedCategory]) }}"
                            class=" w-fit px-4 py-2 rounded  flex items-center"
                            >
                                <svg class="flex w-8 h-4 mr-2 justify-center" 
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Data
                                @if($appliedCategory)
                                    @php
                                        $selectedCategoryName = $categories->firstWhere('id', $appliedCategory)?->name;
                                    @endphp
                                    @if($selectedCategoryName)
                                    
                                            ({{ $selectedCategoryName }})
                                    
                                    @endif
                                @endif
                            </a>
                        </div>    
                    @endif
                    
                </div>
                
            </div>
        </div>
        
    </div>

    <!-- TABEL DATA -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Nama lengkap</th>
                    <th class="px-4 py-2 border">Umur</th>
                    <th class="px-4 py-2 border">Jenis kelamin</th>
                    <th class="px-4 py-2 border">No. HP</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($civilians as $civilian)
                    <tr>
                        <td class="px-4 py-2 border text-blue-500">
                            {{ $civilian->categories->pluck('name')->implode(', ') }}
                        </td>
                        
                        <td class="px-4 py-2 border">{{ $civilian->full_name }}</td>
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($civilian->born_date)->age }} tahun</td>
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
    


    <!-- Pagination -->
    <div class="mt-4">
        {{ $civilians->links() }}
    </div>
</div>

@push('scripts')
<script>
    Livewire.on('triggerExcelDownload', () => {
        window.location.href = "{{ route('laporan-kategori.export') }}";
    });
</script>
@endpush

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets