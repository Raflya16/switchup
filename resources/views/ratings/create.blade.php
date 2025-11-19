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
                    <h3 class="text-lg font-semibold">Bagaimana pengalaman barter Anda?</h3>
                    
                    <form method="POST" action="{{ route('ratings.store', $barter->id) }}" class="mt-6 space-y-4">
                        @csrf
                        <div>
                            <label for="rating" class="block font-medium text-sm text-gray-700">Rating (1-5)</label>
                            <select name="rating" id="rating" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="5">5 - Sangat Bagus</option>
                                <option value="4">4 - Bagus</option>
                                <option value="3">3 - Biasa Saja</option>
                                <option value="2">2 - Kurang</option>
                                <option value="1">1 - Buruk</option>
                            </select>
                        </div>

                        <div>
                            <label for="comment" class="block font-medium text-sm text-gray-700">Komentar</label>
                            <textarea name="comment" id="comment" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
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