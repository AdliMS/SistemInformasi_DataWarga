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
        {{-- <div class="relative w-48">
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
        </div> --}}
    
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

    {{-- <div>
        <div wire:ignore> 
            <select class="select2" name="state">
                <option value="AL">Alabama</option>
                <option value="WY">Wyoming</option>
            </select>
     
            <!-- Select2 will insert its DOM here. -->
        </div>
    </div> --}}

    

    <!-- Tabel untuk Data civilians -->
    <table class="custom-table mt-4">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">Nama warga</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">Januari</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">Februari</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-black uppercase tracking-wider">so on...</th>

            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            {{-- @foreach ($civilians as $civilian)
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
                    <td class="px-6 py-4 whitespace-nowrap"> 
                        @if ($civilian->gender)
                            Wanita
                        @else
                            Pria
                        @endif
                    <td class="px-6 py-4 whitespace-nowrap">{{ $civilian->phone_number }}</td>
                </tr>
            @endforeach --}}
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
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endassets

{{-- @push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush --}}

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        let namaSelect2 = null;
    
        // Inisialisasi Select2 untuk status
        $('#statusSelect').select2({
            width: '100%'
        });
    
        // Fungsi untuk inisialisasi ulang select nama
        const initNamaSelect = () => {
            if (namaSelect2) {
                namaSelect2.destroy();
            }
            
            namaSelect2 = $('#namaSelect').select2({
                width: '100%'
            }).on('change', function() {
                @this.set('selectedName', $(this).val());
            });
        };
        
        // Inisialisasi pertama
        initNamaSelect();
    
        // Handle ketika opsi nama berubah
        Livewire.on('updateNamaOptions', (options) => {
            const select = $('#namaSelect')[0];
            select.innerHTML = '<option value="">Semua Nama</option>';
            
            options.forEach(option => {
                select.add(new Option(option.name, option.id));
            });
            
            initNamaSelect();
            $('#namaSelect').val(@this.get('selectedName')).trigger('change');
        });
    
        // Cleanup saat komponen di-destroy
        Livewire.hook('component.destroy', ({ component }) => {
            if (component.id === @this.__instance.id && namaSelect2) {
                namaSelect2.destroy();
            }
        });
    });
    </script>
@endpush