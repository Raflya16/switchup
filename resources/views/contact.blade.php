<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kontak Kami') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6 md:p-8 border-b md:border-b-0 md:border-r border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Hubungi Kami</h3>
                        <p class="text-gray-600 mb-6">
                            Kami senang mendengar dari Anda! Silakan gunakan informasi di bawah ini atau isi formulir di samping untuk menghubungi tim SwitchUP.
                        </p>
                        
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-800">Email</h4>
                                    <a href="mailto:support@switchup.test" class="text-primary hover:underline">support@switchup.test</a>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-primary flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div class="ml-4">
                                    <h4 class="font-semibold text-gray-800">Alamat Kantor</h4>
                                    <p class="text-gray-600">Jl. Barter No. 123, Jakarta, Indonesia</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-500">Placeholder untuk Peta Lokasi</span>
                        </div>
                    </div>

                    <div class="p-6 md:p-8">
                         <h3 class="text-2xl font-bold text-gray-900 mb-4">Kirim Pesan</h3>
                         <form action="#" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Pesan Anda</label>
                                <textarea id="message" name="message" rows="5" class="mt-1 block w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm" required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <x-primary-button>
                                    Kirim Pesan
                                </x-primary-button>
                            </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>