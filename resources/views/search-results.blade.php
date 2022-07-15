<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pencarian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-6">
                @forelse ($places as $place)
                    <div class="bg-white shadow rounded overflow-hidden">
                        <img src="{{ $place->photos[0]?->url ? asset($place->photos[0]->url) : 'https://picsum.photos/300/200' }}" alt="{{ $place->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-bold">{{ $place->name }}</h3>
                            <p class="text-sm">{{ $place->location }}</p>
                            <a href="{{ route('places.show', $place) }}" class="mt-4 inline-block text-center bg-green-500 px-4 py-2 text-white rounded w-full">Lihat</a>
                        </div>
                    </div>
                @empty
                    No data
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
