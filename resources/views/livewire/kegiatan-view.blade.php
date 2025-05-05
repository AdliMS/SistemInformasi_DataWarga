<div>

    <!-- Tombol Tambah -->
    <div class="flex h-20 p-2 gap-2 justify-end">
    
        <div class="mb-6">
            <div class="mb-6 w-30 px-4 py-2  bg-blue-500 text-white rounded hover:bg-blue-600">
                <a 
                href="{{ route('form-kegiatan') }}"
                class="flex items-center"
                >
                    <svg class="flex w-4 h-4 mr-2 justify-center" 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah
                </a>
            </div>           
        </div>
    </div>
        
    {{-- === TABEL DATA === --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-4 py-2 border">No.</th>
              <th class="px-4 py-2 border">Nama Warga</th>
              <th class="px-4 py-2 border">Kategori</th>
              <th class="px-4 py-2 border">Nama Kegiatan</th>
              <th class="px-4 py-2 border">Progress</th>
              <th class="px-4 py-2 border">Target</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $civIndex => $civ)
              @php
                $cats     = collect($civ['categories']);
                // total baris untuk warga ini = jumlah semua activities across categories
                $rowspanW = $cats->sum(fn($c)=> count($c['activities']));
                $displayW = true;
              @endphp
    
              @foreach($cats as $cat)
                @php
                  $acts         = collect($cat['activities']);
                  $displayCat   = true;
                @endphp
    
                @foreach($acts as $act)
                  <tr class="hover:bg-gray-50">
                    {{-- “No” & “Nama Warga” hanya sekali per warga --}}
                    @if($displayW)
                      <td rowspan="{{ $rowspanW }}" class="px-4 py-2 border text-center">
                        {{ $data->firstItem() + $civIndex }}.
                      </td>
                      <td rowspan="{{ $rowspanW }}" class="px-4 py-2 border">
                        {{ $civ['full_name'] }}
                      </td>
                      @php $displayW = false; @endphp
                    @endif
    
                    {{-- “Kategori” hanya sekali per kategori --}}
                    @if($displayCat)
                      <td rowspan="{{ $acts->count() }}" class="px-4 py-2 border">
                        {{ $cat['name'] }}
                      </td>
                      @php $displayCat = false; @endphp
                    @endif
    
                    {{-- Data Kegiatan --}}
                    <td class="px-4 py-2 border">{{ $act['name'] }}</td>
                    <td class="px-4 py-2 border text-center">{{ $act['progress'] }}</td>
                    <td class="px-4 py-2 border text-center">{{ $act['target'] }}</td>
                  </tr>
                @endforeach
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
        {{-- pagination links --}}
        <div class="mt-4 px-4">
            {{ $data->links() }}
        </div>
    
        
</div>
    
@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets