<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <!-- Notifikasi keberhasilan -->
            @if(session('success'))
                <div id="notification" class="mb-6 px-4 sm:px-0">
                    <div class="bg-green-900/30 border border-green-700 text-green-200 px-6 py-4 rounded-xl flex items-center animate-fadeIn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-white mb-3 tracking-tight">Detail Pesanan</h1>
                <p class="text-gray-400 max-w-md mx-auto">Informasi lengkap tentang pesanan Anda</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Bagian informasi produk -->
                <div class="space-y-8">
                    <!-- Card produk -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8">
                        <h2 class="text-3xl font-bold text-white mb-4">{{ $order->produk->nama ?? '-' }}</h2>
                        
                        <div class="flex justify-between items-center mt-6">
                            <div class="flex flex-col">
                                <span class="text-gray-400 font-medium">Total Harga</span>
                                <span class="text-2xl font-bold text-green-500 mt-1">
                                    Rp {{ number_format((int) $order->total_harga, 0, ',', '.') }}
                                </span>
                            </div>
                            
                            <div class="flex flex-col text-right">
                                <span class="text-gray-400 font-medium">Jumlah Barang</span>
                                <span class="text-xl font-semibold text-gray-200 mt-1">
                                    {{ $order->jumlah }} item
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card detail pesanan -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8">
                        <h3 class="text-xl font-semibold text-white mb-6 pb-3 border-b border-gray-700">Detail Pesanan</h3>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-5">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Nama Pemesan</span>
                                    <span class="text-gray-200 font-medium mt-1">
                                        {{ $order->nama_pemesan }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Alamat</span>
                                    <span class="text-gray-200 font-medium mt-1 break-words whitespace-normal">
                                        {{ $order->alamat }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="space-y-5">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Metode Pembayaran</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                        @if($order->metode === 'COD') bg-yellow-900/30 text-yellow-400
                                        @elseif($order->metode === 'TRANSFER') bg-purple-900/30 text-purple-400
                                        @else bg-gray-700 text-gray-300 @endif">
                                        {{ $order->metode }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Kurir Pengiriman</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                        @if($order->kurir === 'JNE') bg-yellow-900/30 text-yellow-400
                                        @elseif($order->kurir === 'JNT') bg-indigo-900/30 text-indigo-400
                                        @elseif($order->kurir === 'POS') bg-blue-900/30 text-blue-400
                                        @else bg-gray-700 text-gray-300 @endif">
                                        {{ $order->kurir }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bagian gambar produk dan status -->
                <div class="space-y-8">
                    <!-- Card gambar produk -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8 flex flex-col justify-center items-center">
                        @if($order->produk && $order->produk->gambar)
                            <img src="{{ asset('storage/' . $order->produk->gambar) }}" 
                                alt="{{ $order->produk->nama }}"
                                class="max-h-80 w-full object-contain rounded-xl shadow-lg border border-gray-700">
                        @else
                            <div class="w-full h-80 flex items-center justify-center bg-gray-900/50 border-2 border-dashed border-gray-700 rounded-xl">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="mt-4 text-gray-500 font-medium">Tidak ada gambar produk</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Card status -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8">
                        <h3 class="text-xl font-semibold text-white mb-6 pb-3 border-b border-gray-700">Status Pesanan</h3>
                        
                        <div class="flex justify-center mb-6">
                            <span id="statusBadge" class="inline-flex items-center px-5 py-2 rounded-full text-lg font-bold
                                @if($order->status === 'Pending') bg-yellow-900/30 text-yellow-400
                                @elseif($order->status === 'Processed') bg-blue-900/30 text-blue-400
                                @elseif($order->status === 'Sending') bg-orange-900/30 text-orange-400
                                @elseif($order->status === 'Confirmed') bg-green-900/30 text-green-400
                                @elseif($order->status === 'Canceled') bg-red-900/30 text-red-400
                                @else bg-gray-700 text-gray-300 @endif animate-pulseScale">
                                {{ $order->status }}
                            </span>
                        </div>
                        
                        <!-- Ubah Status (for sellers) -->
                        @if(auth()->user()->role === 'Seller')
                        <div class="mt-8 pt-6 border-t border-gray-700">
                            <h4 class="text-lg font-semibold text-white mb-4">Ubah Status Pesanan</h4>
                            <form id="statusForm" action="{{ route('Pemesanan.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <select name="status" class="flex-1 bg-gray-700 text-white rounded-xl border border-gray-600 py-3 px-4 focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200">
                                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Processed" {{ $order->status == 'Processed' ? 'selected' : '' }}>Processed</option>
                                        <option value="Sending" {{ $order->status == 'Sending' ? 'selected' : '' }}>Sending</option>
                                        <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                    <button type="submit" id="updateButton" class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium shadow-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105">
                                        Perbarui
                                    </button>
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('Pemesanan.index') }}" class="px-6 py-3 rounded-xl bg-gray-700 text-white font-medium shadow-lg hover:bg-gray-600 transition-all duration-200 transform hover:scale-105">
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Status update form handling
                const statusForm = document.getElementById('statusForm');
                const statusBadge = document.getElementById('statusBadge');
                
                if(statusForm) {
                    statusForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        // Add animation to button
                        const submitButton = document.getElementById('updateButton');
                        submitButton.classList.add('animate-pulse');
                        submitButton.disabled = true;
                        
                        // Show loading state with animation
                        statusBadge.innerHTML = 'Memperbarui...';
                        statusBadge.classList.remove('p-2', 'animate-pulseScale');
                        statusBadge.classList.add('animate-pulse');
                        
                        // Submit the form
                        const formData = new FormData(statusForm);
                        fetch(statusForm.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                                'X-HTTP-Method-Override': 'PUT'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            // Parse the response to get the updated status
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newStatus = doc.querySelector('#statusBadge').textContent;
                            
                            // Update the status badge with animation
                            statusBadge.innerHTML = newStatus;
                            
                            // Update badge classes based on status
                            statusBadge.className = 'inline-flex items-center px-5 py-2 rounded-full text-lg font-bold';
                            
                            if(newStatus.includes('Pending')) {
                                statusBadge.classList.add('bg-yellow-900/30', 'text-yellow-400');
                            } else if(newStatus.includes('Processed')) {
                                statusBadge.classList.add('bg-blue-900/30', 'text-blue-400');
                            } else if(newStatus.includes('Sending')) {
                                statusBadge.classList.add('bg-orange-900/30', 'text-orange-400');
                            } else if(newStatus.includes('Confirmed')) {
                                statusBadge.classList.add('bg-green-900/30', 'text-green-400');
                            } else if(newStatus.includes('Canceled')) {
                                statusBadge.classList.add('bg-red-900/30', 'text-red-400');
                            } else {
                                statusBadge.classList.add('bg-gray-700', 'text-gray-300');
                            }
                            
                            // Add smooth animation to status badge
                            setTimeout(() => {
                                statusBadge.classList.add('animate-pulseScale');
                            }, 10);
                            
                            // Reset button state
                            submitButton.classList.remove('animate-pulse');
                            submitButton.disabled = false;
                            
                            // Show success notification with animation
                            const notification = document.createElement('div');
                            notification.id = 'notification';
                            notification.className = 'mb-6 px-4 sm:px-0 animate-fadeIn';
                            notification.innerHTML = `
                                <div class="bg-green-900/30 border border-green-700 text-green-200 px-6 py-4 rounded-xl flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Status pesanan berhasil diperbarui!</span>
                                </div>
                            `;
                            
                            // Add notification to the page
                            const container = document.querySelector('.max-w-6xl');
                            if(document.getElementById('notification')) {
                                document.getElementById('notification').remove();
                            }
                            container.insertBefore(notification, container.firstChild);
                            
                            // Auto-hide notification after 3 seconds
                            setTimeout(() => {
                                if(notification) {
                                    notification.style.opacity = '0';
                                    setTimeout(() => {
                                        if(notification.parentNode) {
                                            notification.remove();
                                        }
                                    }, 500);
                                }
                            }, 3000);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Reset button state
                            submitButton.classList.remove('animate-pulse');
                            submitButton.disabled = false;
                            
                            // Show error notification
                            const notification = document.createElement('div');
                            notification.id = 'notification';
                            notification.className = 'mb-6 px-4 sm:px-0 animate-fadeIn';
                            notification.innerHTML = `
                                <div class="bg-red-900/30 border border-red-700 text-red-200 px-6 py-4 rounded-xl flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span>Gagal memperbarui status pesanan!</span>
                                </div>
                            `;
                            
                            // Add notification to the page
                            const container = document.querySelector('.max-w-6xl');
                            if(document.getElementById('notification')) {
                                document.getElementById('notification').remove();
                            }
                            container.insertBefore(notification, container.firstChild);
                        });
                    });
                }
            });
        </script>
        
        <style>
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            @keyframes pulseScale {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
            
            .animate-fadeIn {
                animation: fadeIn 0.5s ease-out;
            }
            
            .animate-pulseScale {
                animation: pulseScale 1.5s infinite;
            }
        </style>
    </div>
</x-app-layout>