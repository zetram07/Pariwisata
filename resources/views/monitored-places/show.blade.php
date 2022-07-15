<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $place->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-6">
                <div>
                    @forelse ($place->photos as $photo)
                        <img src="{{ asset($photo->url) }}" class="mb-6 w-full h-64 object-cover rounded">
                    @empty
                        <img src="https://picsum.photos/200" class="mb-6 w-full h-64 object-cover rounded">
                    @endforelse
                </div>
                <div>
                    <div class="bg-white shadow-sm p-4 rounded">
                        <h3 class="font-bold text-xl">{{ $place->name }}</h3>
                        <p class="text-xs">{{ $place->location }}</p>
                        <p class="mt-4 text-sm">{{ $place->description }}</p>
                    </div>
                    <div class="mt-6 bg-white shadow-sm p-4 rounded flex justify-between">
                        <div class="flex-1 text-center">
                            <h4 class="text-sm">Kapasitas Pengunjung</h4>
                            <p class="text-sm font-bold text-green-500">{{ $place->capacity }} orang</p>
                        </div>
                        <div class="flex-1 text-center">
                            <h4 class="text-sm">Status</h4>
                            <p class="text-sm font-bold text-green-500 uppercase">{{ $place->status }}</p>
                        </div>
                    </div>
                    <div class="mt-6 bg-white shadow-sm p-4 rounded">
                        <h4 class="text-sm">Jam Operasional</h4>
                        <table class="text-sm w-full">
                            @forelse ($place->operation_time as $day => $time)
                                <tr>
                                    <td class="py-2">
                                        {{ $day }}
                                    </td>
                                    <td class="py-2 text-end">
                                        {{ $time[0] }} - {{ $time[1] }}
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </table>
                    </div>
                    <div class="mt-6 bg-white shadow-sm p-4 rounded">
                        <p class="text-sm">Harga Tiket</p>
                        <p class="mt-2 text-lg font-bold text-green-500">Rp{{ $place->ticket_price }}/tiket</p>
                    </div>
                    <div class="mt-6 bg-white shadow-sm p-4 rounded">
                        <h4 class="font-bold">Usia Wisatawan</h4>
                        <div id="ageChart" class="mt-4"></div>
                    </div>
                </div>
                <div>
                    <div class="bg-white shadow-sm p-4 rounded text-center">
                        <div class="flex justify-center">
                            <span class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $place->averageRate)
                                        <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    @endif
                                @endfor
                            </span>
                            <span class="ml-2">{{ $place->averageRate }} dari 5</span>
                        </div>
                        <p class="mt-2 text-sm">
                            {{ $place->reviewCounts }} ulasan
                        </p>
                        <div id="rateBarChart" class="mt-4"></div>
                    </div>
                    <div class="mt-6 bg-white rounded shadow-sm divide-y">
                        <div class="p-4">
                            <h4>Ulasan Orang</h4>
                        </div>
                        @forelse ($place->reviews as $review)
                            <div class="p-4">
                                <div class="flex items-center">
                                    <img src="https://i.pravatar.cc/200" class="h-8 w-8 rounded-full">
                                    <div class="ml-2">
                                        <h5 class="text-sm font-bold">{{ $review->user->name }}</h5>
                                        <span class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rate)
                                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </span>
                                    </div>
                                </div>
                                <p class="text-sm mt-4">{{ $review->review ?? '-' }}</p>
                            </div>
                        @empty
                            <div class="p-4 text-sm">
                                <i>Belum ada ulasan</i>
                            </div>
                        @endforelse
                    </div>
                    <form action="{{ route('places.destroy', $place) }}" method="POST" onsubmit="return confirm('Apa Anda yakin ingin menghapus pariwisata ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-6 bg-red-500 text-white px-5 py-2 rounded w-full" >
                            Hapus Pariwisata Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var rateOptions = {
            series: [{
                data: @json($rateSeries),
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: ['5 Stars', '4 Stars', '3 Stars', '2 Stars', '1 Star', ],
            }
        };

        var chart = new ApexCharts(document.querySelector("#rateBarChart"), rateOptions);
        chart.render();

        var ageOptions = {
            series: @json($ageSeries),
            chart: {
                type: 'pie',
            },
            labels: ['Dewasa (> 18 tahun)', 'Remaja (13-18 tahun)', 'Anak (< 13 tahun)'],
            legend: {
                position: 'bottom'
            }
        };

        var chart = new ApexCharts(document.querySelector("#ageChart"), ageOptions);
        chart.render();
    </script>
</x-app-layout>
