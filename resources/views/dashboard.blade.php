<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-900">Selamat datang kembali, <span class="text-primary">{{ auth()->user()->name }}</span>!</h2>
                <p class="text-gray-500">Aktivitas barter Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h4 class="text-gray-500 text-sm font-medium">Total Barang Aktif</h4>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $activeItemsCount }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h4 class="text-gray-500 text-sm font-medium">Penawaran Masuk</h4>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $incomingOffersCount }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h4 class="text-gray-500 text-sm font-medium">Penawaran Terkirim</h4>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $sentOffersCount }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Daftar Barang Milik Anda</h3>
                        <a href="{{ route('items.create') }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-dark">
                            + Tambah Barang Baru
                        </a>
                    </div>
                    
                    @if($userItems->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500">Anda belum menambahkan barang apapun.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($userItems as $item)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300 border border-gray-200">
                                <a href="{{ route('items.show', $item->id) }}">
                                    <img class="object-contain h-48 w-full" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" />
                                </a>
                                <div class="p-4">
                                    <h5 class="text-lg font-bold tracking-tight text-gray-900">{{ Str::limit($item->name, 25) }}</h5>
                                    <span class="inline-block mt-1 bg-{{ $item->status == 'available' ? 'blue' : 'red' }}-100 text-{{ $item->status == 'available' ? 'blue' : 'red' }}-800 text-xs font-medium px-2.5 py-0-5 rounded-full">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    <div class="flex space-x-2 mt-4">
                                        <a href="{{ route('items.edit', $item->id) }}" class="flex-1 text-center px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700">
                                            Edit
                                        </a>
                                        <form class="flex-1" method="POST" action="{{ route('items.destroy', $item->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
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