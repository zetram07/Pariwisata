<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-6">
                @forelse ($places as $place)
                    <div class="bg-white shadow rounded overflow-hidden flex flex-col">
                        <img src="{{ $place->photos[0]?->url ? asset($place->photos[0]->url) : 'https://picsum.photos/300/200' }}" alt="{{ $place->name }}" class="w-full h-48 object-cover">
                        <div class="flex-1 p-4 flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold">{{ $place->name }}</h3>
                                <p class="text-sm">{{ $place->location }}</p>
                            </div>
                            <div class="mt-4">
                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('monitored-places.show', $place) }}" class="inline-block w-full text-center px-4 py-2 bg-red-500 text-white rounded">
                                        Monitor
                                    </a>
                                @else
                                    <a href="{{ route('places.show', $place) }}" class="inline-block w-full text-center bg-green-500 px-4 py-2 text-white rounded flex-1">Lihat</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    No data
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
