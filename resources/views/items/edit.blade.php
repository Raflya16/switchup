<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Barang') }}: {{ $item->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-300">
                <div class="p-6 text-gray-900 dark:text-gray-900">

                    <form x-data="{ submitting: false }" @submit="submitting = true" method="POST" action="{{ route('items.update', $item->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Nama Barang')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $item->name)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Kategori')" />
                            <x-custom-select :options="$categories" :selected="$item->category_id" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi Barang')" />
                            <textarea name="description" id="description" rows="4" class="block mt-1 w-full border-gray-300 bg-white text-gray-900 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm" required>{{ old('description', $item->description) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Gambar Utama (Opsional)')" />
                            <div class="mt-2 mb-2">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-40 h-auto rounded">
                            </div>
                            <input id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:bg-white dark:text-gray-900 dark:border-gray-300 focus:outline-none file:bg-gray-800 file:text-white file:border-none file:px-4 file:py-2 file:mr-4" type="file" name="image" />
                            <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button ::disabled="submitting">
                                <span x-show="!submitting">
                                    {{ __('Update Barang') }}
                                </span>
                                <span x-show="submitting">
                                    Menyimpan...
                                </span>
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>