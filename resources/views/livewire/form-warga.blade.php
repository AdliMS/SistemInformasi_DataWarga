<div class="flex flex-col items-center justify-center min-h-screen p-12 bg-slate-200">
    {{-- Form Container --}}
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-10 space-y-8">
        <h1 class="text-3xl font-semibold border-b border-slate-300 pb-4">Formulir Data Warga</h1>

        <form wire:submit.prevent="submit" class="space-y-6">
            {{-- Grid for Inputs --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama lengkap --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama lengkap</label>
                    <input type="text" wire:model="full_name" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400" placeholder="Ketikkan nama lengkap" />
                    @error('full_name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis kelamin --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis kelamin</label>
                    <select wire:model="gender" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400">
                        <option value="">Pilih jenis kelamin</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                    @error('gender')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tempat lahir --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tempat lahir</label>
                    <input type="text" wire:model="born_place" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400" placeholder="Ketikkan tempat lahir" />
                    @error('born_place')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal lahir --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal lahir</label>
                    <input type="date" wire:model="born_date" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400" />
                    @error('born_date')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NIK --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIK</label>
                    <input type="text" wire:model="nik" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400" placeholder="Nomor Induk Kependudukan" />
                    @error('nik')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea wire:model="home_address" rows="3" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400" placeholder="Alamat lengkap"></textarea>
                    @error('home_address')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status pernikahan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status pernikahan</label>
                    <select wire:model="married_status" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400">
                        <option value="">Pilih status</option>
                        <option value="Belum menikah">Belum menikah</option>
                        <option value="Menikah">Menikah</option>
                    </select>
                    @error('married_status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor HP --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                    <input type="text" wire:model="phone_number" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400" placeholder="08xxxxxxxxxx" />
                    @error('phone_number')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Data Tanggungan --}}
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold">Data Tanggungan</h2>

                    @foreach ($tanggungan as $index => $item)
                        <div class="flex flex-col gap-2 rounded relative border border-gray-300 p-4 bg-gray-50">

                            <div>
                                <label class="text-sm">Nama</label>
                                <input type="text" wire:model="tanggungan.{{ $index }}.full_name" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400" />
                                @error('tanggungan.{{ $index }}.full_name')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm">Tanggal Lahir</label>
                                <input type="date" wire:model="tanggungan.{{ $index }}.born_date" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400" />
                                @error('tanggungan.{{ $index }}.born_date')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm">Jenis Kelamin</label>
                                <select wire:model="tanggungan.{{ $index }}.gender" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400">
                                    <option value="">Pilih</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                                @error('tanggungan.{{ $index }}.gender')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-sm">Pendidikan Terakhir</label>
                                <select wire:model="tanggungan.{{ $index }}.last_education" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400">
                                    <option value="">Pilih</option>
                                    <option value="Belum menempuh pendidikan">Belum menempuh pendidikan</option>
                                    <option value="SD sederajat">SD sederajat</option>
                                    <option value="SMP sederajat">SMP sederajat</option>
                                    <option value="SMA sederajat">SMA sederajat</option>
                                    <option value="D4/S1">D4/S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                                @error('tanggungan.{{ $index }}.last_education')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tombol Hapus --}}
                            <button type="button" wire:click="removeTanggungan({{ $index }})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full px-2">×</button>
                        </div>
                    @endforeach

                    <button type="button" wire:click="addTanggungan" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        + Tambah Tanggungan
                    </button>
                </div>

                {{-- Data Pekerjaan --}}
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold">Data Pekerjaan</h2>

                    @foreach ($pekerjaan as $index => $item)
                        <div class="flex flex-col gap-2 rounded relative border border-gray-300 p-4 bg-gray-50">

                            <div>
                                <label class="text-sm">Pekerjaan</label>
                                <select wire:model="pekerjaan.{{ $index }}.civilian_job_id" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400">
                                    <option value="">Pilih pekerjaan</option>
                                    @foreach($jobOptions as $id => $job)
                                        <option value="{{ $id }}">{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="text-sm">Tahun Masuk</label>
                            <select wire:model="pekerjaan.{{ $index }}.accepted_date" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400">
                                <option value="">Pilih tahun</option>
                                @for ($year = 2010; $year <= 2020; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>

                            <label class="text-sm">Tahun Berhenti <span class="text-xs text-gray-500">(Opsional)</span></label>
                            <select wire:model="pekerjaan.{{ $index }}.retirement_date" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:outline-blue-400">
                                <option value="">Pilih tahun</option>
                                @for ($year = 2015; $year <= now()->year; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>


                            {{-- Tombol Hapus --}}
                            <button type="button" wire:click="removePekerjaan({{ $index }})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full px-2">×</button>
                        </div>
                    @endforeach

                    <button type="button" wire:click="addPekerjaan" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        + Tambah Pekerjaan
                    </button>
                </div>


            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-between pt-6 border-t border-slate-300">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Buat</button>
            </div>
        </form>
    </div>
</div>


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    window.addEventListener('show-success-alert', event => {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: event.detail.message || 'Data berhasil disimpan.',
            showConfirmButton: false,
            timer: 4000, 
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    });

</script>
@endpush


@assets
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
@endassets