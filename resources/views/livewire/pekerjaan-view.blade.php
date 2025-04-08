<div>
    {{-- Stop trying to control. --}}

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
       <!-- Selectbox untuk filter pekerjaan -->
        <select 
            wire:model="selectedJob" 
            class="js-example-basic-single"
        >
            <option value="">Semua Pekerjaan</option>
            @foreach($jobs as $job)
                <option value="{{ $job->id }}">{{ $job->job_place }}</option>
            @endforeach
        </select>

        <!-- Input Pencarian Nama -->
        <div class="relative w-48">
            <input
                type="text"
                wire:model.debounce.500ms="searchName"
                placeholder="Cari nama warga..."
                class="w-full border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
            >
            <button 
                wire:click="$set('searchName', '')"
                class="absolute right-2 top-2 text-gray-400 hover:text-gray-600"
                style="{{ empty($searchName) ? 'display:none' : '' }}"
            >
                ✕
            </button>
        </div>

        <!-- Tombol Filter -->
        <button 
            wire:click="applyFilter"
            wire:loading.attr="disabled"
            class=""bg-blue-500 font-medium px-2 rounded-lg flex items-center h-100"
        >
            <span wire:loading wire:target="applyFilter" class="animate-spin mr-2">⏳</span>
            Terapkan Filter
        </button>

        <!-- Tombol Reset -->
        {{-- <button 
            wire:click="resetFilters"
            class="text-gray-600 hover:text-gray-800 ml-2 text-sm border border-gray-300 px-3 py-2 rounded-lg"
        >
            Reset
        </button> --}}
    </div>

    <!-- Tabel -->
    <table class="custom-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tempat Kerja</th>
                <th>Tahun Masuk</th>
                <th>Tahun Berlangsung</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($civilians as $civilian)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-wrap gap-1 text-blue-500">
                            @foreach($civilian->civilian_jobs as $job)
                                {{ $job->job_place }}
                                @if(!$loop->last), @endif
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $civilian->full_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @foreach($civilian->civilian_jobs as $job)
                        {{ $job->pivot->accepted_date }}
                        @if(!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @foreach($civilian->civilian_jobs as $job)
                            {{ $job->pivot->retirement_date }}
                            @if(!$loop->last)<br>@endif
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $civilian->phone_number }}</td>
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

    {{ $civilians->links() }}
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets
