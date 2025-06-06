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

            <!-- Selectbox untuk filter pekerjaan -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                <select 
                    wire:model="selectedJob" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    >
                    <option value="">Semua Pekerjaan</option>
                    @foreach($jobs as $job)
                        <option value="{{ $job->id }}">{{ $job->job_place }}</option>
                    @endforeach
                </select>
            </div>   
     
            <!-- Input Nama Warga -->
            <div class="bg-green">
                <label class="block text-sm font-medium text-gray-700">Nama Warga</label>
                <div>
                    <input
                    type="text"
                    wire:model.debounce.500ms="searchName"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-red-500"
                    placeholder="Cari nama warga..."
                    >
                </div>
                
            </div>
     
            <!-- Tombol Filter -->
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

            {{-- Tombol Ekspor .xlxs --}}
            <div class="inline-block bg-green-500 text-white rounded hover:bg-green-600">
                <button wire:click="exportToExcel" class="bg-green-600 px-4 py-2 rounded text-white">
                    Export ke Excel
                </button>

                <script>
                    window.addEventListener('triggerExcelDownload', function () {
                        window.location.href = "{{ route('laporan-pekerjaan.export') }}";
                    });
                </script>
            </div>

        </div>
    </div>

    <!-- TABEL DATA -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <th class="px-4 py-2 border">Tempat Kerja</th>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Tahun Masuk</th>
                <th class="px-4 py-2 border">Tahun Berlangsung</th>
            </thead>
            <tbody>
                @forelse ($civilians as $civilian)
                    <tr>
                        <td class="px-4 py-2 border text-center">
                            <div class="flex flex-wrap gap-1 text-blue-500">
                                @foreach($civilian->civilian_jobs as $job)
                                    {{ $job->job_place }}
                                    @if(!$loop->last), @endif
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-2 border">{{ $civilian->full_name }}</td>
                        <td class="px-4 py-2 border text-center">
                            @foreach($civilian->civilian_jobs as $job)
                                {{ $job->pivot->accepted_date }}
                                @if(!$loop->last)<br>@endif
                            @endforeach
                        </td>
                        <td class="px-4 py-2 border text-center">
                            @foreach($civilian->civilian_jobs as $job)
                                {{ $job->pivot->retirement_date }}
                                @if(!$loop->last)<br>@endif
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data yang ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $civilians->links() }}
    </div>
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets
