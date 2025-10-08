<x-guest-layout>
    <div class="min-h-screen flex">
        <div class="hidden lg:flex w-1/2 bg-gradient-to-tr from-primary-light to-primary-dark items-center justify-center p-12 text-white text-center">
            <div>
                <h1 class="text-5xl font-bold mb-4 tracking-tight">Selamat Datang Kembali di SwitchUP</h1>
                <p class="text-lg opacity-80">Tukarkan barang lama Anda menjadi sesuatu yang baru. Hemat, mudah, dan menyenangkan.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <a href="/" class="text-3xl font-bold text-gray-800" translate="no">
                        <span class="text-primary">Switch</span>UP
                    </a>
                    <h2 class="mt-2 text-2xl font-semibold text-gray-700">Login ke Akun Anda</h2>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Alamat Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <div class="flex justify-between">
                            <x-input-label for="password" :value="__('Password')" />
                             @if (Route::has('password.request'))
                                <a class="text-sm text-primary hover:underline" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <div class="mt-6">
                        <x-primary-button class="w-full justify-center">
                            {{ __('Login') }}
                        </x-primary-button>
                    </div>

                    <p class="mt-6 text-sm text-center text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-medium text-primary hover:underline">
                            Daftar di sini
                        </a>
                    </p>

                    <div class="mt-4 text-center">
                        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-primary hover:underline">
                            Lewatkan & Masuk sebagai Tamu
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>