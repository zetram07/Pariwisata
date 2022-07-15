<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded shadow-sm p-4">
                @csrf
                <div>
                    <label for="name">Nama Tempat</label>
                    <input id="name" name="name" type="text" class="mt-2 w-full" required>
                </div>
                <div class="mt-4">
                    <label for="location">Lokasi</label>
                    <input id="location" name="location" type="text" class="mt-2 w-full" required>
                </div>
                <div class="mt-4">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="mt-2 w-full"></textarea>
                </div>
                <div class="mt-4">
                    <label for="capacity">Kapasitas Pengunjung</label>
                    <input id="capacity" name="capacity" type="number" class="mt-2 w-full" required>
                </div>
                <div class="mt-4">
                    <label for="ticketPrice">Harga Tiket</label>
                    <input id="ticketPrice" name="ticket_price" type="number" class="mt-2 w-full" required>
                </div>
                <div class="mt-4">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="mt-2 w-full" required>
                        <option value="open">Buka</option>
                        <option value="close">Tutup</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="photo">Foto</label>
                    <input id="photo" name="photo" type="file" class="mt-2 w-full" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="mt-4">
                    <p>Waktu Operasional</p>
                    @php
                        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    @endphp
                    @foreach ($days as $i => $day)
                        <div class="flex justify-between items-center my-2">
                            <div>
                                <input type="checkbox" name="operation_time[{{ $i }}][day]" id="day{{ $i }}" class="mr-2" value="{{ $day }}">
                                <label for="day{{ $i }}">{{ $day }}</label>
                            </div>
                            <div>
                                <input type="time" name="operation_time[{{ $i }}][open_time]" value="08:00">
                                <input type="time" name="operation_time[{{ $i }}][close_time]" value="18:00">
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="mt-4 px-4 py-2 bg-green-500 rounded text-white">
                    Buat Pariwisata
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
