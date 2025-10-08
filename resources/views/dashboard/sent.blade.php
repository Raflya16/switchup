<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Penawaran Barter yang Terkirim') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-300">
                <div class="p-6 text-gray-900 dark:text-gray-900">

                    @if($sentOffers->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500">Anda belum pernah mengirim penawaran barter.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($sentOffers as $offer)
                                <div class="p-4 border border-gray-200 dark:border-gray-300 rounded-lg">
                                    <p>
                                        Anda menawarkan barang 
                                        <span class="font-semibold text-emerald-600">{{ $offer->offeredItem->name }}</span>
                                        kepada 
                                        <span class="font-semibold">{{ $offer->requestedItem->user->name }}</span>.
                                    </p>
                                    <p class="text-sm mt-1">Status: 
                                        <span class="font-bold 
                                            @if($offer->status == 'pending') text-yellow-500 @endif
                                            @if($offer->status == 'accepted') text-emerald-600 @endif
                                            @if($offer->status == 'rejected') text-red-600 @endif
                                        ">
                                            {{ ucfirst($offer->status) }}
                                        </span>
                                    </p>

                                    <div class="mt-4 flex items-center space-x-4">
                                        <a href="{{ route('messages.show', $offer->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                            Lihat Pesan
                                        </a>
                                        @if($offer->status == 'accepted')
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