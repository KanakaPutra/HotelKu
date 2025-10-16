<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-50 text-black/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            {{-- Logo Default Laravel --}}
                        </div>
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @if (Route::has('login'))
                                <livewire:welcome.navigation />
                            @endif
                        </nav>
                    </header>
                    <main class="mt-6">
                       <div class="flex justify-center">
                           {{-- Konten Utama Halaman Welcome --}}
                           <h1 class="text-3xl font-bold">Selamat Datang di Laravel</h1>
                       </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="text-blue-500 underline">Masuk ke Aplikasi Hotel</a>
                        </div>
                    </main>
                    <footer class="py-16 text-center text-sm text-black/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>