<x-app-layout>
    <div class="bg-blue-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Tukar Barang,</span>
                        <span class="block text-primary">Hemat Uang!</span>
                    </h1>
                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-dark">
                            Mulai Barter
                        </a>
                        <a href="#barang-terbaru" class="inline-flex items-center justify-center px-6 py-3 border border-primary-light text-base font-medium rounded-md text-primary-dark bg-white hover:bg-gray-100">
                            Lihat Barang
                        </a>
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <p class="text-lg text-gray-600">
                        Platform barter terpercaya untuk menukar barang yang tidak terpakai dengan barang yang Anda butuhkan.
                    </p>
                    <div class="mt-8 max-w-lg">
                        <form action="{{ route('home') }}" method="GET" class="sm:flex">
                            <input type="text" name="search" placeholder="Cari barang impianmu..." class="w-full px-5 py-3 border border-gray-300 shadow-sm rounded-md text-gray-900 focus:ring-primary focus:border-primary">
                            <button type="submit" class="mt-3 w-full sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0 px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-dark">
                                Cari
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-50 border-t border-b border-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-sm p-6 text-center border border-gray-100">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Komunitas Aktif</h3>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 text-center border border-gray-100">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                         <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Ragam Kategori</h3>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 text-center border border-gray-100">
                     <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Transaksi Aman</h3>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 text-center border border-gray-100">
                     <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v.01M12 18v-2m0-4v-2m0-4V4m0-2v.01M6 12H4m2 0h2m0 0h2m-4 0H2m14 0h-2m2 0h2m0 0h2m-4-8l1.673-1.673M6 6l-1.414-1.414M20 12l-1.414 1.414M6 18l-1.414 1.414m13.328-1.673l1.414 1.414"></path></svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Hemat Uang</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div id="barang-terbaru" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Barang Tersedia</h3>
                @auth
                    <a href="{{ route('items.create') }}" class="inline-flex ...">
                        + Tambah Barang
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex ...">
                        + Tambah Barang
                    </a>
                @endauth
            </div>
            
            <div class="flex flex-wrap items-center gap-2 mb-8">
                <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium rounded-full transition {{ !request('category') ? 'bg-primary text-white shadow-sm' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Semua
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('home', ['category' => $category->slug]) }}" class="px-4 py-2 text-sm font-medium rounded-full transition {{ request('category') == $category->slug ? 'bg-primary text-white shadow-sm' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            @if($items->isEmpty())
                <div class="text-center py-16 bg-white rounded-lg shadow-sm border border-gray-200">
                    <p class="text-gray-500">Tidak ada barang yang cocok dengan kriteria Anda.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($items as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300 border border-gray-200">
                        <a href="{{ route('items.show', $item->id) }}">
                            <img class="object-contain h-48 w-full" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" />
                        </a>
                        <div class="p-4">
                            @if($item->category)
                                <span class="inline-block bg-blue-100 text-primary-dark text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full mb-2">
                                    {{ $item->category->name }}
                                </span>
                            @endif
                            <h5 class="text-lg font-bold tracking-tight text-gray-900">{{ Str::limit($item->name, 25) }}</h5>
                            <p class="text-sm text-gray-500 mt-1">Oleh: <a href="{{ route('users.show', $item->user) }}" class="font-semibold text-primary hover:underline">{{ $item->user->name }}</a></p>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-8">
                    {{ $items->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>