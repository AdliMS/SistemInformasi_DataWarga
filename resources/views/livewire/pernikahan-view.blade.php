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

    <!-- selectbox untuk filter status pernikahan -->
    <div class="flex h-20 p-2 gap-2 items-center">
        <select wire:model.defer="statusPernikahan"  class="js-example-basic-single">
            <option value="" default>Semua</option>
            <option value="belum_menikah">Belum menikah</option>
            <option value="sudah_menikah">Sudah menikah</option>
        </select>
    
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
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($civilian->married_status)
                            Sudah menikah
                        @else
                            Belum menikah
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $civilian->full_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($civilian->born_date)->age . ' tahun' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $civilian->gender }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $civilian->phone_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{-- <div class="flex justify-between items-center mt-4">
        <div class="pagination-info">
            Menampilkan {{ $civilians->firstItem() }} sampai {{ $civilians->lastItem() }} dari {{ $civilians->total() }} hasil
        </div>
        <div class="flex items-center space-x-2">
            <select wire:model="perPage" class="pagination-select">
                <option value="10">10 per halaman</option>
                <option value="20">20 per halaman</option>
                <option value="50">50 per halaman</option>
            </select>
        </div>
    </div> --}}
</div>

@assets
<!-- Pastikan jQuery dan Select2 dimuat -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets

@script
<!-- Inisialisasi Select2 -->
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        // Event saat select berubah
        $('.js-example-basic-single').on('change', function(event) {
            @this.set('statusPernikahan', event.target.value); // Update Livewire property langsung
        });
    });
</script>
@endscript