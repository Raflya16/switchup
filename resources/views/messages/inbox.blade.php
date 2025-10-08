<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Kotak Masuk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-300">
                <div class="p-6 text-gray-900">
                    @if($barters->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500">Anda tidak memiliki percakapan aktif.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($barters as $barter)
                                @php
                                    // Tentukan siapa lawan bicara
                                    $otherUser = auth()->id() == $barter->owner_id ? $barter->offerer : $barter->owner;
                                @endphp
                                <a href="{{ route('messages.show', $barter->id) }}" class="block p-4 border border-gray-200 dark:border-gray-300 rounded-lg hover:bg-gray-50">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-semibold">Percakapan dengan {{ $otherUser->name }}</p>
                                            <p class="text-sm text-gray-600">
                                                Mengenai: {{ $barter->requestedItem->name }}
                                            </p>
                                        </div>
                                        @if($barter->unread_messages_count > 0)
                                        <span class="flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full">
                                            {{ $barter->unread_messages_count }}
                                        </span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>