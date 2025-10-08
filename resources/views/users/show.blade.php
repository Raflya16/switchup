<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-300">
                <div class="p-6 md:p-8 text-gray-900">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold">{{ $user->name }}</h2>
                        <p class="text-gray-500 mt-1">Bergabung sejak {{ $user->created_at->format('d F Y') }}</p>

                        <div class="flex items-center mt-2">
                            <span class="text-yellow-500 font-bold text-xl">{{ number_format($averageRating, 1) }}</span>
                            <span class="text-gray-500 ml-1">/ 5.0</span>
                            <svg class="w-5 h-5 text-yellow-400 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 6.462l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            <span class="text-gray-500 ml-3">({{ $ratings->count() }} ulasan)</span>
                        </div>
                        </div>

                    <h3 class="text-2xl font-semibold border-b pb-2 mb-4">Barang yang Ditawarkan</h3>
                    @if($items->isEmpty())
                        <p class="text-gray-500">{{ $user->name }} belum menawarkan barang apapun saat ini.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($items as $item)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300 border border-gray-200 dark:border-gray-700">
                                    <a href="{{ route('items.show', $item->id) }}">
                                        <img class="object-cover h-48 w-full" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" />
                                    </a>
                                    <div class="p-4">
                                        <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ Str::limit($item->name, 25) }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <h3 class="text-2xl font-semibold border-b pb-2 mb-4 mt-12">Ulasan Pengguna</h3>
                    @if($ratings->isEmpty())
                        <p class="text-gray-500">Belum ada ulasan untuk pengguna ini.</p>
                    @else
                        <div class="space-y-6">
                            @foreach($ratings as $rating)
                                <div class="border-b pb-4">
                                    <div class="flex items-center mb-1">
                                        <span class="font-semibold">{{ $rating->rater->name }}</span>
                                        <span class="text-yellow-500 ml-4 flex items-center">
                                            {!! str_repeat('<svg class="w-4 h-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20"><path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 6.462l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/></svg>', $rating->rating) !!}
                                            {!! str_repeat('<svg class="w-4 h-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20"><path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 6.462l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/></svg>', 5 - $rating->rating) !!}
                                        </span>
                                    </div>
                                    <p class="text-gray-600">{{ $rating->comment }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $rating->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>