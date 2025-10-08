<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Percakapan Mengenai: {{ $barter->requestedItem->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    
                    <div class="space-y-4 mb-6 h-96 overflow-y-auto pr-4">
                        @forelse($messages as $message)
                            <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-lg px-4 py-2 rounded-lg {{ $message->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-gray-200 text-gray-800' }}">
                                    <p>{{ $message->body }}</p>
                                    <span class="text-xs opacity-75 mt-1 block">{{ $message->created_at->format('H:i') }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">Belum ada pesan. Mulai percakapan!</p>
                        @endforelse
                    </div>

                    <form method="POST" action="{{ route('messages.store', $barter->id) }}">
                        @csrf
                        <div class="flex items-center">
                            <textarea name="body" rows="2" class="flex-grow border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary" placeholder="Ketik pesan Anda..." required></textarea>
                            <button type="submit" class="ml-3 px-6 py-3 bg-primary text-white font-semibold rounded-md hover:bg-primary-dark">Kirim</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>