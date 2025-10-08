<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Barang
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 md:p-8 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <div x-data="{ mainImage: '{{ asset('storage/' . $item->image) }}' }">
                            <img :src="mainImage" alt="{{ $item->name }}" class="w-full h-auto rounded-lg shadow-md mb-4">
                            <div class="grid grid-cols-5 gap-2">
                                <div>
                                    <img src="{{ asset('storage/' . $item->image) }}" @click="mainImage = '{{ asset('storage/' . $item->image) }}'" 
                                         class="w-full h-20 object-cover rounded-md cursor-pointer border-2 hover:border-primary"
                                         :class="{ 'border-primary': mainImage === '{{ asset('storage/' . $item->image) }}' }">
                                </div>
                                @foreach($item->images as $galleryImage)
                                <div>
                                    <img src="{{ asset('storage/' . $galleryImage->path) }}" @click="mainImage = '{{ asset('storage/' . $galleryImage->path) }}'"
                                         class="w-full h-20 object-cover rounded-md cursor-pointer border-2 hover:border-primary"
                                         :class="{ 'border-primary': mainImage === '{{ asset('storage/' . $galleryImage->path) }}' }">
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            @if($item->category)
                                <span class="inline-block bg-blue-100 text-primary-dark text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full mb-2">
                                    {{ $item->category->name }}
                                </span>
                            @endif
                            <h1 class="text-3xl font-bold text-gray-900">{{ $item->name }}</h1>
                            
                            <p class="text-md text-gray-600 mt-2">
                                Oleh: <a href="{{ route('users.show', $item->user) }}" class="font-semibold text-primary hover:underline">{{ $item->user->name }}</a>
                            </p>

                            <p class="text-gray-700 mt-4 leading-relaxed">{{ $item->description }}</p>

                            @if(Auth::id() !== $item->user_id)
                                @if($userItems->count() > 0)
                                <div class="mt-6 border-t border-gray-200 pt-6">
                                    <h4 class="text-lg font-semibold text-gray-800">Tawarkan Barter dengan Barang Anda:</h4>
                                    <form method="POST" action="{{ route('barter.offer') }}">
                                        @csrf
                                        <input type="hidden" name="requested_item_id" value="{{ $item->id }}">
                                        
                                        <div class="mt-4">
                                            <label for="offered_item_id" class="block text-sm font-medium text-gray-700">Pilih Barang Anda</label>
                                            <select name="offered_item_id" id="offered_item_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                                @foreach ($userItems as $userItem)
                                                    <option value="{{ $userItem->id }}">{{ $userItem->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @auth
                                        <div class="flex items-center justify-end mt-4">
                                            <x-primary-button>
                                                Ajukan Penawaran
                                            </x-primary-button>
                                        </div>
                                    @else
                                        <div class="mt-6 border-t border-gray-200 pt-6">
                                            <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-dark">
                                                Login untuk Mengajukan Penawaran
                                            </a>
                                        </div>
                                    @endauth
                                    </form>
                                </div>
                                @else
                                <div class="mt-6 border-t border-gray-200 pt-6">
                                     <p class="text-red-600">Anda tidak punya barang untuk ditawarkan. <a href="{{ route('items.create') }}" class="underline font-semibold">Tambah barang dulu</a> untuk memulai barter.</p>
                                </div>
                                @endif
                            @else
                                <div class="mt-6 border-t border-gray-200 pt-6">
                                    <p class="text-blue-600 font-semibold">Ini adalah barang milik Anda.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>