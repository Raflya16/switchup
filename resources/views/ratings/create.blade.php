<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Beri Ulasan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-300">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold">Beri ulasan untuk transaksi barang: "{{ $barter->requestedItem->name }}"</h3>
                    <p class="text-gray-600 mt-1">Anda bertransaksi dengan: {{ (auth()->id() === $barter->owner_id) ? $barter->offeredItem->user->name : $barter->requestedItem->user->name }}</p>

                    <form method="POST" action="{{ route('ratings.store', $barter->id) }}" class="mt-6 space-y-4">
                        @csrf

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div>
                            <label for="rating" class="block font-medium text-sm text-gray-700">Rating Bintang</label>
                            <select name="rating" id="rating" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Rating --</option>
                                <option value="5">★★★★★ (Luar Biasa)</option>
                                <option value="4">★★★★☆ (Baik)</option>
                                <option value="3">★★★☆☆ (Cukup)</option>
                                <option value="2">★★☆☆☆ (Buruk)</option>
                                <option value="1">★☆☆☆☆ (Sangat Buruk)</option>
                            </select>
                        </div>

                        <div>
                            <label for="comment" class="block font-medium text-sm text-gray-700">Komentar (Opsional)</label>
                            <textarea name="comment" id="comment" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" placeholder="Bagaimana pengalaman barter Anda?"></textarea>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>