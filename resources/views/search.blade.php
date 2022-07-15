<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pencarian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('search') }}" class="bg-white shadow-sm rounded p-4">
                <select name="day" class="w-full rounded">
                    <option>Senin</option>
                    <option>Selasa</option>
                    <option>Rabu</option>
                    <option>Kamis</option>
                    <option>Jumat</option>
                    <option>Sabtu</option>
                    <option>Minggu</option>
                </select>
                <input type="time" name="time" class="mt-4 w-full rounded">
                <input type="number" name="max_ticket_price" class="mt-4 w-full rounded" placeholder="Harga tiket">
                <button type="submit" class="mt-4 w-full bg-green-500 px-4 py-2 rounded text-white">Cari Pariwisata</button>
            </form>
        </div>
    </div>
</x-app-layout>
