<div class="flex flex-col items-center h-screen p-12 gap-8 bg-slate-200">
    

    {{-- BAGIAN INPUT --}}
    <div class="flex flex-col bg-[#fafafa] gap-8 w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-16 border">

        <h1 class="text-4xl pb-4 font-medium border-b border-gray-300">Formulir Kegiatan Warga</h1> 
        {{-- Tombol Kembali --}}
        <a href="{{ route('filament.admin.pages.kegiatan') }}"
            class="ml-auto text-red-500 hover:underline font-medium text-sm">
            ← Kembali
        </a>

            <div>
                <!-- Form Input dalam Dropdown -->
        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Select Kategori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Warga</label>
                            <select 
                                wire:model.live="selectedCategory" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Select Warga -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Warga</label>
                            <select 
                                wire:model.live="selectedCivilian" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                                {{ !$selectedCategory ? 'disabled' : '' }}>
                                <option value="">Pilih Warga</option>
                                @foreach($civilians as $civilian)
                                    <option value="{{ $civilian->id }}">{{ $civilian->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div wire:loading wire:target="selectedCivilian" class="text-sm text-gray-500">
                            Memuat kegiatan...
                        </div>
                    </div>
            
                    <!-- Daftar Kegiatan -->
                    @if($selectedCivilian && $activities?->isNotEmpty())
                        <div class="space-y-4 my-6">
                            @foreach($activities as $activity)
                                <div class="p-4 rounded-lg border border-gray-200 shadow-sm">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-medium">{{ $activity['name'] }}</span>
                                        <span class="text-sm text-gray-500">Target: {{ $activity['target'] }}</span>
                                    </div>
                                    
                                    <div class="flex items-center gap-2">
                                        <input 
                                            type="number"
                                            wire:model="progressInputs.{{ $activity['id'] }}"
                                            class="w-20 px-3 py-2 border rounded focus:ring-blue-500"
                                            min="0"
                                            max="{{ $activity['target'] }}"
                                            placeholder="Progress">
                                    </div>
                                </div>
                            @endforeach
                        </div>
            
                        <!-- Action Buttons -->
             
                            
                            <div class="inline-block w-full text-center font-bold bg-blue-500 text-white rounded hover:bg-blue-600">
                                <button
                                  wire:click="saveAllProgress"
                                  wire:loading.attr="disabled"
                                  wire:target="saveAllProgress"
                                  class="inline-block w-full px-4 py-2 cursor-pointer"
                                >            
                                  {{-- Normal --}}
                                  <span wire:loading.remove>‍Simpan</span>
                              
                                  {{-- Saat loading --}}
                                    <span wire:loading class="flex items-center">
                                        <div
                                            class="flex items-center"
                                        >
                                            <svg class="animate-spin w-3 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                            </svg>
                                            Menyimpan...
                                        </div>     
                                    </span>
                                </button>
                            </div>
                            
                        
                    @endif
            </div>
        {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="w-full bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif
    </div>
            
</div>

@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets