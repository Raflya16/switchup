<x-app-layout>
    <div class="relative bg-gray-800">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Tim bekerja sama">
            <div class="absolute inset-0 bg-primary-dark mix-blend-multiply opacity-75" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Tentang SwitchUP</h1>
            <p class="mt-6 text-xl text-indigo-100">Menghubungkan komunitas, menghemat sumber daya, satu pertukaran dalam satu waktu.</p>
        </div>
    </div>

    <div class="py-16 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-base font-semibold text-primary tracking-wide uppercase">Misi Kami</p>
                <h2 class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">Platform Barter Modern untuk Semua</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Kami percaya setiap barang memiliki nilai. Misi kami adalah menciptakan ekosistem di mana Anda dapat dengan mudah menukar barang yang tidak terpakai menjadi sesuatu yang baru dan bermanfaat, tanpa perlu mengeluarkan uang.
                </p>
            </div>
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v.01M12 18v-2m0-4v-2m0-4V4m0-2v.01M6 12H4m2 0h2m0 0h2m-4 0H2m14 0h-2m2 0h2m0 0h2m-4-8l1.673-1.673M6 6l-1.414-1.414M20 12l-1.414 1.414M6 18l-1.414 1.414m13.328-1.673l1.414 1.414"></path></svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Hemat</h3>
                    <p class="mt-2 text-base text-gray-500">Dapatkan barang yang Anda butuhkan tanpa membuka dompet. Hemat uang Anda untuk hal-hal yang lebih penting.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Berkelanjutan</h3>
                    <p class="mt-2 text-base text-gray-500">Perpanjang siklus hidup barang Anda dan kurangi limbah. Setiap pertukaran adalah langkah kecil untuk bumi yang lebih baik.</p>
                </div>
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Komunitas</h3>
                    <p class="mt-2 text-base text-gray-500">Bergabunglah dengan ribuan orang dengan minat yang sama. Temukan koneksi baru melalui setiap transaksi yang bermakna.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white">
        <div class="max-w-4xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                <span class="block">Siap untuk memulai pertukaran pertama Anda?</span>
            </h2>
            <a href="{{ route('register') }}" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-dark sm:w-auto">
                Barter Sekarang
            </a>
        </div>
    </div>
</x-app-layout>