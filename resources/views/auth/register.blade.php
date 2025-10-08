<x-guest-layout>
    <div class="min-h-screen flex">
        <div class="hidden lg:flex w-1/2 bg-gradient-to-tr from-primary-light to-primary-dark items-center justify-center p-12 text-white text-center">
            <div>
                <h1 class="text-5xl font-bold mb-4 tracking-tight">Bergabung dengan Komunitas Barter Terbesar</h1>
                <p class="text-lg opacity-80">Daftarkan diri Anda dan mulailah menukar barang dengan mudah, aman, dan tanpa biaya.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8">
            <div class="w-full max-w-md">
                 <div class="text-center mb-8">
                    <a href="/" class="text-3xl font-bold text-gray-800" translate="no">
                        <span class="text-primary">Switch</span>UP
                    </a>
                    <h2 class="mt-2 text-2xl font-semibold text-gray-700">Buat Akun Baru</h2>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Alamat Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <x-primary-button class="w-full justify-center">
                            {{ __('Daftar') }}
                        </x-primary-button>
                    </div>

                     <p class="mt-6 text-sm text-center text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">
                            Login di sini
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>