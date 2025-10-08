<x-app-layout>
    <div class="bg-blue-50 border-b border-blue-100">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Isi Ulang Token,</span>
                    <span class="block text-primary">Nikmati Lebih Banyak Fitur!</span>
                </h1>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                    Gunakan token Anda untuk menambah penawaran dan transaksi barter yang lebih cepat.
                </p>
            </div>
        </div>
    </div>

    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="h-6 w-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v.01M12 18v-2m0-4v-2m0-4V4m0-2v.01M6 12H4m2 0h2m0 0h2m-4 0H2m14 0h-2m2 0h2m0 0h2" />
                    </svg>
                    Informasi Token
                </h3>

                <div class="text-center">
                    <p class="text-gray-600 mb-2">Saldo Token Anda</p>
                    <p id="saldo-token" class="text-5xl font-bold text-primary mb-4">{{ auth()->user()->tokens }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 12H4m16 0a8 8 0 01-16 0 8 8 0 0116 0z" />
                    </svg>
                    Pilih Paket Token
                </h3>

                <div class="flex justify-center">
                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8 justify-items-center max-w-5xl w-full">
                        @foreach ([
                        ['token' => 5, 'harga' => 'Rp10.000'],
                        ['token' => 15, 'harga' => 'Rp25.000'],
                        ['token' => 35, 'harga' => 'Rp50.000'],
                        ] as $paket)
                        <div
                            class="border border-gray-200 rounded-xl p-6 text-center w-full sm:w-64 md:w-72 hover:border-primary hover:shadow-lg transition transform hover:scale-105 cursor-pointer">
                            <p class="text-4xl font-extrabold text-primary">{{ $paket['token'] }}</p>
                            <p class="text-gray-500 mb-2">Token</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $paket['harga'] }}</p>

                            <button
                                class="mt-3 w-full bg-primary hover:bg-primary-dark text-white font-medium px-4 py-2 rounded-md shadow transition btn-beli-token"
                                data-token="{{ $paket['token'] }}"
                                data-price="{{ preg_replace('/\D/', '', $paket['harga']) }}">
                                Beli Sekarang
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 w-full">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <svg class="h-6 w-6 text-gray-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Riwayat Top Up
                </h3>

                <div class="mb-4 flex justify-end">
                    <input type="text" id="search-history" placeholder="Cari..." class="border rounded px-4 py-2">
                </div>

                <div id="history-table">
                    <table class="min-w-full text-sm border border-gray-200 rounded-lg overflow-hidden w-full">
                        <thead class="bg-gray-100 text-gray-800 text-sm font-semibold">
                            <tr>
                                <th class="px-6 py-3 text-left">Tanggal</th>
                                <th class="px-6 py-3 text-center">Order ID</th>
                                <th class="px-6 py-3 text-center">Jumlah Token</th>
                                <th class="px-6 py-3 text-center">Total Bayar</th>
                                <th class="px-6 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($histories as $history)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3">{{ $history->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-3 text-center">{{ $history->order_id }}</td>
                                <td class="px-6 py-3 text-center">{{ $history->token_amount }}</td>
                                <td class="px-6 py-3 text-center">Rp{{ number_format($history->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-3 text-center">
                                    @if($history->status === 'success')
                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Sukses</span>
                                    @elseif($history->status === 'pending')
                                    <span
                                        class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">Menunggu</span>
                                    @else
                                    <span
                                        class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">Gagal</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $histories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript"
        src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>

    <script>
        document.querySelectorAll('.btn-beli-token').forEach(button => {
            button.addEventListener('click', function() {
                const tokenAmount = this.dataset.token;
                const price = this.dataset.price;

                fetch("{{ route('tokens.checkout') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            token_amount: tokenAmount,
                            price: price
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        snap.pay(data.snapToken, {
                            onSuccess: function(result) {
                                alert('Pembayaran sukses!');
                            },
                            onPending: function(result) {
                                alert('Menunggu pembayaran...');
                            },
                            onError: function(result) {
                                alert('Pembayaran gagal!');
                            },
                            onClose: function() {
                                console.log('Popup ditutup');
                            }
                        });
                    })
                    .catch(error => console.error("Error:", error));
            });
        });

        function fetchHistories(page = 1, search = '') {
            fetch(`{{ route('tokens.index') }}?page=${page}&search=${search}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const table = doc.getElementById('history-table');
                    document.getElementById('history-table').innerHTML = table.innerHTML;
                });
        }

        document.getElementById('search-history').addEventListener('input', function() {
            fetchHistories(1, this.value);
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.pagination a')) {
                e.preventDefault();
                const url = new URL(e.target.href);
                const page = url.searchParams.get('page');
                const search = document.getElementById('search-history').value;
                fetchHistories(page, search);
            }
        });

        setInterval(() => {
            const search = document.getElementById('search-history').value;
            fetchHistories(1, search);
        }, 5000);
    </script>

    <script>
        function updateSaldoToken() {
            fetch("{{ route('tokens.saldo') }}")
                .then(res => res.json())
                .then(data => {
                    if (data.saldo !== undefined) {
                        document.getElementById('saldo-token').textContent = data.saldo;
                    }
                })
                .catch(err => console.error("Gagal update saldo token:", err));
        }

        setInterval(updateSaldoToken, 5000);
    </script>

</x-app-layout>