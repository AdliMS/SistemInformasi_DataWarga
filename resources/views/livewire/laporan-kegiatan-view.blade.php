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

    {{-- FILTER --}}
    <div class="p-4 mb-6 bg-white rounded-lg shadow">
        <div class="flex flex-wrap gap-4 items-end">
            
            {{-- Select Kategori --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select
                    wire:model.defer="selectedCategory"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                >
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Input Nama Warga --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Warga</label>
                <input
                    type="text"
                    wire:model.defer="searchName"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    placeholder="Cari nama warga..."
                />
            </div>

            {{-- Tombol Filter --}}
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

            {{-- Tombol Ekspor .xlsx --}}
            <div class="inline-block bg-green-500 text-white rounded hover:bg-green-600">
                <button wire:click="exportToExcel" class="bg-green-600 px-4 py-2 rounded text-white">
                    Export ke Excel
                </button>

                <script>
                    window.addEventListener('triggerExcelDownload', function () {
                        window.location.href = "{{ route('laporan-kegiatan.export') }}";
                    });
                </script>
            </div>
        </div>
    </div>
    
    {{-- TABEL DATA --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full border border-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 border">No.</th>
            <th class="px-4 py-2 border">Nama Warga</th>
            <th class="px-4 py-2 border">Kategori Warga</th>
            <th class="px-4 py-2 border">Nama Kegiatan</th>
            <th class="px-4 py-2 border">Input Kegiatan</th>
            <th class="px-4 py-2 border">Target</th>
            <th class="px-4 py-2 border">Keterangan</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $civIndex => $civ)
            @php
              // Hitung total baris untuk warga ini
              $rowspanW     = collect($civ['categories'])->sum(fn($c)=> count($c['activities']));
              $displayWarga = true;
            @endphp
    
            @foreach($civ['categories'] as $cat)
              @php
                $acts            = $cat['activities'];
                $displayKategori = true;
              @endphp
    
              @foreach($acts as $act)
                <tr class="hover:bg-gray-50">
                  {{-- No. & Nama Warga --}}
                  @if($displayWarga)
                    <td rowspan="{{ $rowspanW }}" class="px-4 py-2 border text-center">
                      {{ $civIndex + 1 }}.
                    </td>
                    <td rowspan="{{ $rowspanW }}" class="px-4 py-2 border">
                      {{ $civ['full_name'] }}
                    </td>
                    @php $displayWarga = false; @endphp
                  @endif
    
                  {{-- Kategori --}}
                  @if($displayKategori)
                    <td rowspan="{{ count($acts) }}" class="px-4 py-2 border">
                      {{ $cat['name'] }}
                    </td>
                    @php $displayKategori = false; @endphp
                  @endif
    
                  {{-- Data Kegiatan --}}
                  <td class="px-4 py-2 border">{{ $act['name'] }}</td>
                  <td class="px-4 py-2 border text-center">{{ $act['progress'] }}</td>
                  <td class="px-4 py-2 border text-center">{{ $act['target'] }}</td>
                  <td class="px-4 py-2 border text-center">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $act['keterangan']['color'] }}">
                      {{ $act['keterangan']['label'] }}
                    </span>
                  </td>
                </tr>
              @endforeach
            @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
      
      {{-- PAGINASI --}}
    <div class="mt-4 px-4">
        {{ $data->links() }}
    </div>

</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets