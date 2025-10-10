<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="col-span-2 md:col-span-1">
                <a href="/" class="text-2xl font-bold text-gray-800" translate="no">
                    <span class="text-primary">Switch</span>UP
                </a>
                <p class="mt-2 text-sm text-gray-500">
                    Platform barter modern untuk menukar barang, menghemat uang, dan menjaga lingkungan.
                </p>
                <div class="mt-4 flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-primary">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="https://www.instagram.com/switchupp.id?igsh=a3U2bndnc29nMmhj" class="text-gray-400 hover:text-primary">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.08 2.525c.636-.247 1.363-.416 2.427-.465C9.53 2.013 9.884 2 12.315 2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm5.25-10a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary">
                        <span class="sr-only">X</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M13.6 11.9l4.7-5.2H17l-4 4.5-3.3-4.5H4.5l5 7.1-5 5.2h1.4l4.3-4.8 3.6 4.8H20l-5.2-7.5zm-2.1 2.5l-.6-1-4.2-6h2l3.4 5 .6 1 4.4 6.2h-2l-3.6-5.1z" /></svg>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Navigasi</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="{{ route('home') }}" class="text-base text-gray-500 hover:text-primary">Beranda</a></li>
                    <li><a href="{{ route('about') }}" class="text-base text-gray-500 hover:text-primary">Tentang Kami</a></li>
                    <li><a href="{{ route('contact') }}" class="text-base text-gray-500 hover:text-primary">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Kategori</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-base text-gray-500 hover:text-primary">Elektronik</a></li>
                    <li><a href="#" class="text-base text-gray-500 hover:text-primary">Fashion</a></li>
                    <li><a href="#" class="text-base text-gray-500 hover:text-primary">Mainan</a></li>
                    <li><a href="#" class="text-base text-gray-500 hover:text-primary">Otomotif</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase">Legal</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="#" class="text-base text-gray-500 hover:text-primary">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-base text-gray-500 hover:text-primary">Syarat & Ketentuan</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-200 pt-8 text-center">
            <p class="text-base text-gray-400">&copy; {{ date('Y') }} SwitchUP. All Right Reserved.</p>
        </div>
    </div>
</footer>