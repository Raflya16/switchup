<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penawaran Barter yang Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-300">
                <div class="p-6 text-gray-900 dark:text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($incomingOffers->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500">Belum ada penawaran yang masuk untuk barang Anda.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($incomingOffers as $offer)
                                <div class="p-4 border border-gray-200 dark:border-gray-300 rounded-lg flex flex-col md:flex-row items-center justify-between gap-4">
                                    <div class="flex-grow text-center md:text-left">
                                        <p>
                                            <span class="font-semibold">{{ $offer->offeredItem->user->name }}</span>
                                            menawarkan barangnya
                                            <span class="font-semibold text-emerald-600">{{ $offer->offeredItem->name }}</span>
                                            untuk ditukar dengan barang Anda
                                            <span class="font-semibold text-emerald-600">{{ $offer->requestedItem->name }}</span>.
                                        </p>
                                    </div>
                                    
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('messages.show', $offer->id) }}" class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-md hover:bg-gray-700">
                                            Lihat Pesan
                                        </a>

                                        @if($offer->status == 'pending')
                                            <form method="POST" action="{{ route('barter.respond', $offer->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-md hover:bg-emerald-700">
                                                    Terima
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('barter.respond', $offer->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700">
                                                    Tolak
                                                </button>
                                            </form>
                                        @endif

                                        @if($offer->status == 'accepted')
                                            <span class="px-4 py-2 bg-gray-200 text-gray-500 text-sm font-semibold rounded-md">Diterima</span>
                                            <a href="{{ route('ratings.create', $offer->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">
                                                Beri Ulasan
                                            </a>
                                        @endif
                                        </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>