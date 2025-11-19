<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Daftar Penawaran') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ tab: 'masuk' }" class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-300">
                <div class="border-b border-gray-200 dark:border-gray-300">
                    <nav class="-mb-px flex" aria-label="Tabs">
                        <button @click="tab = 'masuk'" :class="{'border-primary text-primary-dark': tab === 'masuk', 'border-transparent text-gray-500': tab !== 'masuk'}" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm">Penawaran Masuk</button>
                        <button @click="tab = 'terkirim'" :class="{'border-primary text-primary-dark': tab === 'terkirim', 'border-transparent text-gray-500': tab !== 'terkirim'}" class="w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm">Penawaran Terkirim</button>
                    </nav>
                </div>

                <div class="p-6 text-gray-900">
                    <div x-show="tab === 'masuk'">
                        @forelse ($incomingOffers as $offer)
                        <div class="mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <p class="font-bold text-lg">{{ $offer->offerer->name }} <span class="text-sm font-normal text-gray-500">(Penawar)</span></p>
                                    <p class="text-gray-600">Ingin menukar: <span class="text-primary font-semibold">{{ $offer->offeredItem->name }}</span> dengan <span class="text-primary font-semibold">{{ $offer->requestedItem->name }}</span></p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold 
                                    {{ $offer->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $offer->status == 'accepted' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $offer->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $offer->status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ strtoupper($offer->status) }}
                                </span>
                            </div>

                            @if($offer->status == 'pending')
                                <div class="flex space-x-2">
                                    <form method="POST" action="{{ route('barter.respond', $offer->id) }}"> @csrf <input type="hidden" name="status" value="accepted"> 
                                        <button onclick="return confirm('Terima penawaran? 1 Token akan ditahan dari saldo Anda.')" class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-dark">Terima (Biaya 1 Token)</button>
                                    </form>
                                    <form method="POST" action="{{ route('barter.respond', $offer->id) }}"> @csrf <input type="hidden" name="status" value="rejected"> 
                                        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Tolak</button>
                                    </form>
                                    <a href="{{ route('messages.show', $offer->id) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded">Chat</a>
                                </div>

                            @elseif($offer->status == 'accepted' || $offer->status == 'completed')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 border-t pt-4">
                                    <div>
                                        <h4 class="font-semibold mb-2">Pengiriman Barang Anda:</h4>
                                        @if($offer->resi_owner)
                                            <p class="text-green-600">Resi: {{ $offer->resi_owner }}</p>
                                        @else
                                            <form action="{{ route('barter.resi', $offer->id) }}" method="POST" class="flex gap-2">
                                                @csrf @method('PATCH')
                                                <input type="text" name="resi" placeholder="Input No. Resi" class="text-sm rounded border-gray-300 w-full" required>
                                                <button class="px-3 py-1 bg-gray-800 text-white text-xs rounded">Simpan</button>
                                            </form>
                                        @endif
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-semibold mb-2">Barang dari Penawar:</h4>
                                        <p class="text-sm mb-2">Resi: {{ $offer->resi_offerer ?? 'Belum diinput' }}</p>
                                        
                                        @if(!$offer->confirmed_owner)
                                            <form action="{{ route('barter.confirm', $offer->id) }}" method="POST">
                                                @csrf
                                                <button class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">Konfirmasi Barang Diterima</button>
                                            </form>
                                        @else
                                            <p class="text-green-600 font-bold text-sm">✓ Anda sudah mengonfirmasi penerimaan</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end gap-2">
                                     <a href="{{ route('messages.show', $offer->id) }}" class="px-4 py-2 bg-primary text-white rounded">Buka Chat Room</a>
                                     @if($offer->status == 'completed')
                                        <a href="{{ route('ratings.create', $offer->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded">Beri Ulasan</a>
                                     @endif
                                </div>
                            @endif
                        </div>
                        @empty
                        <p class="text-center py-8 text-gray-500">Belum ada penawaran.</p>
                        @endforelse
                    </div>

                    <div x-show="tab === 'terkirim'" style="display: none;">
                        @forelse ($sentOffers as $offer)
                        <div class="mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                             <div class="flex justify-between items-center mb-4">
                                <div>
                                    <p class="font-bold text-lg">Ke: {{ $offer->owner->name }}</p>
                                    <p class="text-gray-600">Barang Anda: <span class="text-primary font-semibold">{{ $offer->offeredItem->name }}</span></p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $offer->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($offer->status == 'accepted' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100') }}">{{ strtoupper($offer->status) }}</span>
                            </div>

                            @if($offer->status == 'accepted' || $offer->status == 'completed')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 border-t pt-4">
                                    <div>
                                        <h4 class="font-semibold mb-2">Pengiriman Barang Anda:</h4>
                                        @if($offer->resi_offerer)
                                            <p class="text-green-600">Resi: {{ $offer->resi_offerer }}</p>
                                        @else
                                            <form action="{{ route('barter.resi', $offer->id) }}" method="POST" class="flex gap-2">
                                                @csrf @method('PATCH')
                                                <input type="text" name="resi" placeholder="Input No. Resi" class="text-sm rounded border-gray-300 w-full" required>
                                                <button class="px-3 py-1 bg-gray-800 text-white text-xs rounded">Simpan</button>
                                            </form>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-semibold mb-2">Barang dari Pemilik:</h4>
                                        <p class="text-sm mb-2">Resi: {{ $offer->resi_owner ?? 'Belum diinput' }}</p>
                                        @if(!$offer->confirmed_offerer)
                                            <form action="{{ route('barter.confirm', $offer->id) }}" method="POST">
                                                @csrf
                                                <button class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">Konfirmasi Barang Diterima</button>
                                            </form>
                                        @else
                                            <p class="text-green-600 font-bold text-sm">✓ Anda sudah mengonfirmasi penerimaan</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end gap-2">
                                    <a href="{{ route('messages.show', $offer->id) }}" class="px-4 py-2 bg-primary text-white rounded">Buka Chat Room</a>
                                </div>
                            @endif
                        </div>
                        @empty
                        <p class="text-center py-8 text-gray-500">Belum ada penawaran terkirim.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>