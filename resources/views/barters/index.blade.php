<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Penawaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ tab: 'masuk' }" class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex" aria-label="Tabs">
                        <button @click="tab = 'masuk'" :class="{'border-primary text-primary-dark': tab === 'masuk', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'masuk'}" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm">
                            Penawaran Masuk
                        </button>
                        <button @click="tab = 'terkirim'" :class="{'border-primary text-primary-dark': tab === 'terkirim', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'terkirim'}" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm">
                            Penawaran Terkirim
                        </button>
                    </nav>
                </div>

                <div class="p-6 text-gray-900">
                    <div x-show="tab === 'masuk'">
                         @if($incomingOffers->isEmpty())
                            <div class="text-center py-12"><p class="text-gray-500">Belum ada penawaran yang masuk.</p></div>
                        @else
                            <div class="space-y-4">
                                @foreach ($incomingOffers as $offer)
                                    <div class="p-4 border border-gray-200 rounded-lg flex flex-col md:flex-row items-center justify-between gap-4">
                                        <div class="flex-grow text-center md:text-left">
                                            <p>
                                                <span class="font-semibold">{{ $offer->offerer->name }}</span>
                                                menawarkan barangnya <span class="font-semibold text-primary">{{ $offer->offeredItem->name }}</span>
                                                untuk ditukar dengan <span class="font-semibold text-primary">{{ $offer->requestedItem->name }}</span>.
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('messages.show', $offer->id) }}" class="px-4 py-2 bg-gray-600 text-white text-sm font-semibold rounded-md hover:bg-gray-700">Pesan</a>
                                            @if($offer->status == 'pending')
                                                <form method="POST" action="{{ route('barter.respond', $offer->id) }}"> @csrf <input type="hidden" name="status" value="accepted"> <button type="submit" class="px-4 py-2 bg-primary hover:bg-primary-dark text-white text-sm font-semibold rounded-md">Terima</button></form>
                                                <form method="POST" action="{{ route('barter.respond', $offer->id) }}"> @csrf <input type="hidden" name="status" value="rejected"> <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-700">Tolak</button></form>
                                            @elseif($offer->status == 'accepted')
                                                <span class="px-4 py-2 bg-gray-200 text-gray-500 text-sm font-semibold rounded-md">Diterima</span>
                                            @elseif($offer->status == 'rejected')
                                                <span class="px-4 py-2 bg-red-200 text-red-700 text-sm font-semibold rounded-md">Anda Tolak</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div x-show="tab === 'terkirim'" style="display: none;">
                        @if($sentOffers->isEmpty())
                            <div class="text-center py-12"><p class="text-gray-500">Anda belum pernah mengirim penawaran.</p></div>
                        @else
                            <div class="space-y-4">
                                @foreach ($sentOffers as $offer)
                                    <div class="p-4 border border-gray-200 rounded-lg">
                                        <p>Anda menawarkan <span class="font-semibold text-primary">{{ $offer->offeredItem->name }}</span> kepada <span class="font-semibold">{{ $offer->owner->name }}</span>.</p>
                                        <p class="text-sm mt-1">Status: <span class="font-bold @if($offer->status == 'pending') text-yellow-500 @endif @if($offer->status == 'accepted') text-green-600 @endif @if($offer->status == 'rejected') text-red-600 @endif">{{ ucfirst($offer->status) }}</span></p>
                                        <div class="mt-4">
                                            <a href="{{ route('messages.show', $offer->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Lihat Pesan</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>