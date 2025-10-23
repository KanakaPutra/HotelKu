<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HotelKu - Reservasi Hotel Terbaik</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom Styles -->
        <style>
            html {
                scroll-behavior: smooth;
            }

            body {
                font-family: 'Inter', sans-serif;
                background-color: #f8f9fa;
            }

            .font-playfair {
                font-family: 'Playfair Display', serif;
            }

            .hero-section {
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://placehold.co/1920x1080/334155/ffffff?text=HotelKu+Exterior');
                background-size: cover;
                background-position: center;
            }

            .btn {
                transition: all 0.3s ease;
            }

            .btn-primary {
                background-color: #c0a07b; /* A sophisticated gold color */
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
            }

            .btn-primary:hover {
                background-color: #a98b65;
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            }

            .card {
                background-color: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            }
            
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            .hero-content {
                animation: fadeIn 1s ease-out 0.3s forwards;
                opacity: 0;
            }
        </style>
    </head>
<body class="antialiased text-gray-800">

    <!-- Header -->
    <header class="absolute top-0 left-0 right-0 z-10 p-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-white">HotelKu</a>
            <nav class="hidden md:flex items-center space-x-6">
                <a href="#rooms" class="text-white hover:text-gray-200">Kamar</a>
                <a href="#about" class="text-white hover:text-gray-200">Tentang Kami</a>
                <a href="#contact" class="text-white hover:text-gray-200">Kontak</a>
            </nav>
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-white font-semibold hover:underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary text-sm">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero-section h-screen flex items-center justify-center text-center text-white">
            <div class="max-w-3xl px-4 hero-content">
                <h2 class="font-playfair text-5xl md:text-7xl font-bold mb-4 leading-tight">Pengalaman Menginap yang Tak Terlupakan</h2>
                <p class="text-lg md:text-xl mb-8 text-gray-200">Temukan kemewahan dan kenyamanan di jantung kota. Pesan kamar Anda sekarang dan nikmati penawaran eksklusif.</p>
                <a href="#booking" class="btn btn-primary px-8 py-4 rounded-lg font-semibold text-lg">Mulai Memesan</a>
            </div>
        </section>

        <!-- Booking Form Section -->
        <section id="booking" class="bg-white -mt-16 relative z-10 max-w-5xl mx-auto rounded-xl shadow-2xl p-8">
             <form class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                 <div>
                     <label for="checkin" class="block text-sm font-medium text-gray-700">Check-in</label>
                     <input type="date" id="checkin" name="checkin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                 </div>
                 <div>
                     <label for="checkout" class="block text-sm font-medium text-gray-700">Check-out</label>
                     <input type="date" id="checkout" name="checkout" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                 </div>
                 <div>
                     <label for="guests" class="block text-sm font-medium text-gray-700">Tamu</label>
                     <select id="guests" name="guests" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                         <option>1 Tamu</option>
                         <option selected>2 Tamu</option>
                         <option>3 Tamu</option>
                         <option>4 Tamu</option>
                     </select>
                 </div>
                 <button type="submit" class="w-full btn btn-primary py-2 rounded-lg font-semibold text-base h-10">Cari Kamar</button>
             </form>
        </section>

        <!-- Featured Rooms Section -->
        <section id="rooms" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h3 class="font-playfair text-4xl font-bold text-gray-900">Kamar Pilihan Kami</h3>
                    <p class="mt-4 text-lg text-gray-600">Setiap kamar dirancang untuk kenyamanan maksimal Anda.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Room Card 1 -->
                    <div class="card">
                        <img src="https://placehold.co/600x400/a5b4fc/ffffff?text=Deluxe+Room" alt="Deluxe Room" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h4 class="text-xl font-semibold mb-2">Deluxe Room</h4>
                            <p class="text-gray-600 mb-4">Pemandangan kota yang menakjubkan dengan fasilitas modern.</p>
                            <div class="flex justify-between items-center mt-6">
                                <span class="text-lg font-semibold text-gray-800">Rp 1.200.000<span class="text-sm font-normal text-gray-600">/malam</span></span>
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-primary text-sm">
                                        Login untuk Pesan
                                    </a>
                                @else
                                    <a href="#" class="btn btn-primary text-sm">
                                        Pesan Sekarang
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    <!-- Room Card 2 -->
                    <div class="card">
                        <img src="https://placehold.co/600x400/818cf8/ffffff?text=Executive+Suite" alt="Executive Suite" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h4 class="text-xl font-semibold mb-2">Executive Suite</h4>
                            <p class="text-gray-600 mb-4">Ruang tamu terpisah dan akses ke lounge eksekutif.</p>
                             <div class="flex justify-between items-center mt-6">
                                <span class="text-lg font-semibold text-gray-800">Rp 2.500.000<span class="text-sm font-normal text-gray-600">/malam</span></span>
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-primary text-sm">
                                        Login untuk Pesan
                                    </a>
                                @else
                                    <a href="#" class="btn btn-primary text-sm">
                                        Pesan Sekarang
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    <!-- Room Card 3 -->
                    <div class="card">
                        <img src="https://placehold.co/600x400/6366f1/ffffff?text=Presidential+Suite" alt="Presidential Suite" class="w-full h-56 object-cover">
                        <div class="p-6">
                            <h4 class="text-xl font-semibold mb-2">Presidential Suite</h4>
                            <p class="text-gray-600 mb-4">Kemewahan tertinggi dengan layanan pribadi dan pemandangan terbaik.</p>
                             <div class="flex justify-between items-center mt-6">
                                <span class="text-lg font-semibold text-gray-800">Rp 5.000.000<span class="text-sm font-normal text-gray-600">/malam</span></span>
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-primary text-sm">
                                        Login untuk Pesan
                                    </a>
                                @else
                                    <a href="#" class="btn btn-primary text-sm">
                                        Pesan Sekarang
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About/Features Section -->
        <section id="about" class="py-20 bg-white">
             <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                   <h3 class="font-playfair text-4xl font-bold text-gray-900">Kenapa Memilih HotelKu?</h3>
                   <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Kami berdedikasi untuk memberikan pengalaman menginap yang istimewa dengan layanan dan fasilitas terbaik.</p>
                   <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-12">
                         <div class="feature">
                               <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-4">
                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                               </div>
                               <h4 class="text-xl font-semibold">Lokasi Strategis</h4>
                               <p class="text-gray-600 mt-2">Terletak di pusat kota, dekat dengan pusat perbelanjaan dan atraksi wisata.</p>
                         </div>
                         <div class="feature">
                               <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-4">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                               </div>
                               <h4 class="text-xl font-semibold">Layanan Bintang 5</h4>
                               <p class="text-gray-600 mt-2">Staf kami yang ramah siap melayani Anda 24/7 untuk memastikan kenyamanan Anda.</p>
                         </div>
                         <div class="feature">
                               <div class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.904 10.236-3.904 14.141 0M1.394 8.111c6.248-6.248 16.379-6.248 22.627 0" /></svg>
                               </div>
                               <h4 class="text-xl font-semibold">Fasilitas Lengkap</h4>
                               <p class="text-gray-600 mt-2">Nikmati kolam renang, pusat kebugaran, spa, dan WiFi gratis di seluruh area hotel.</p>
                         </div>
                   </div>
             </div>
        </section>

    </main>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <div>
                    <h3 class="text-xl font-bold mb-4">HotelKu</h3>
                    <p class="text-gray-400">Jl. Sudirman No. 123, Jakarta, Indonesia</p>
                    <p class="text-gray-400">Telepon: (021) 123-4567</p>
                    <p class="text-gray-400">Email: info@hotelku.com</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Tautan Cepat</h3>
                    <ul>
                        <li><a href="#about" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
                        <li><a href="#rooms" class="text-gray-400 hover:text-white">Kamar</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Ikuti Kami</h3>
                     <div class="flex justify-center md:justify-start space-x-4">
                         <a href="#" class="text-gray-400 hover:text-white" aria-label="Twitter">
                             <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"></path></svg>
                         </a>
                         <a href="#" class="text-gray-400 hover:text-white" aria-label="Facebook">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3v9h4v-9z"></path></svg>
                         </a>
                         <a href="#" class="text-gray-400 hover:text-white" aria-label="Instagram">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.217.598 1.772 1.153a4.908 4.908 0 011.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122s-.013 3.056-.06 4.122c-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 01-1.153 1.772 4.915 4.915 0 01-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06s-3.056-.013-4.122-.06c-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 01-1.772-1.153 4.904 4.904 0 01-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12s.013-3.056.06-4.122c.05-1.065.218-1.79.465-2.428a4.88 4.88 0 011.153-1.772A4.904 4.904 0 015.39 3.638c.637-.248 1.363-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 1.62c-2.67 0-2.987.01-4.043.058-1.034.048-1.631.218-2.203.43-1.02.39-1.8.95-2.6 1.75s-1.36 1.58-1.75 2.6c-.212.572-.382 1.17-.43 2.203-.048 1.056-.058 1.373-.058 4.043s.01 2.987.058 4.043c.048 1.034.218 1.631.43 2.203.39 1.02.95 1.8 1.75 2.6s1.58 1.36 2.6 1.75c.572.212 1.17.382 2.203.43 1.056.048 1.373.058 4.043.058s2.987-.01 4.043-.058c1.034-.048 1.631-.218 2.203-.43 1.02-.39 1.8-.95 2.6-1.75s1.36-1.58 1.75-2.6c.212-.572.382-1.17.43-2.203.048-1.056.058-1.373.058-4.043s-.01-2.987-.058-4.043c-.048-1.034-.218-1.631-.43-2.203-.39-1.02-.95-1.8-1.75-2.6s-1.58-1.36-2.6-1.75c-.572-.212-1.17-.382-2.203-.43C14.987 3.63 14.67 3.62 12 3.62zM12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8.38c-1.853 0-3.38-1.527-3.38-3.38s1.527-3.38 3.38-3.38 3.38 1.527 3.38 3.38-1.527 3.38-3.38 3.38zm6.38-9.6c-.663 0-1.2.537-1.2 1.2s.537 1.2 1.2 1.2 1.2-.537 1.2-1.2-.537-1.2-1.2-1.2z"></path></svg>
                         </a>
                     </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-6 text-center text-gray-500">
                &copy; 2024 HotelKu. All rights reserved. (Laravel v{{ Illuminate\Foundation\Application::VERSION }})
            </div>
        </div>
    </footer>

</body>
</html>

