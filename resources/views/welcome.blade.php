<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuangBk</title>
    @vite(['resources/css/app.css'])
    <link rel="icon" href="{{ asset('images/logoKonselor.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('images/logoKonselor.png') }}" alt="Logo Bk" class="h-12 w-auto mr-3">
                    <span class="text-2xl font-bold text-blue-900">
                        Ruang<span class="text-blue-900">Bk</span>
                    </span>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-[#D4AF37] font-medium transition-colors">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-[#D4AF37] font-medium transition-colors">About</a>
                    <a href="#structure" class="text-gray-700 hover:text-[#D4AF37] font-medium transition-colors">Structure</a>
                    @if (Route::has('login'))
                        <nav class="flex items-center justify-end gap-4">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="block w-full px-4 py-3 bg-[#D4AF37] text-white text-center rounded-lg font-medium"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="block w-full px-4 py-3 bg-[#D4AF37] text-white text-center rounded-lg font-medium"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="block w-full px-4 py-3 bg-[#D4AF37] text-white text-center rounded-lg font-medium">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </nav>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden fixed inset-y-0 right-0 w-64 bg-white shadow-xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out" id="mobileMenu">
            <div class="p-6 flex justify-end">
                <button onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-6 space-y-6">
                <a href="#home" class="block text-xl text-blue-900 font-medium">Home</a>
                <a href="#about" class="block text-xl text-gray-700 font-medium">About</a>
                <a href="#structure" class="block text-xl text-gray-700 font-medium">Structure</a>
                @if (Route::has('login'))
                    <nav class="flex items-center justify-end gap-4">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="block w-full px-4 py-3 bg-[#D4AF37] text-white text-center rounded-lg font-medium"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="block w-full px-4 py-3 bg-[#D4AF37] text-white text-center rounded-lg font-medium"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="block w-full px-4 py-3 bg-[#D4AF37] text-white text-center rounded-lg font-medium">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
        <div class="md:hidden fixed inset-0 bg-black/50 z-40 hidden" id="mobileMenuOverlay" onclick="toggleMobileMenu()"></div>
    </header>

    <section id="home" class="flex flex-col md:flex-row items-center justify-between px-4 sm:px-12 py-12 md:py-20">
        <div class="md:w-1/2 space-y-6 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-blue-900">
                Selamat Datang<br>
                Di RuangBk!
            </h1>            
            <p class="text-lg text-gray-600 md:pr-8">
                Platform profesional untuk bimbingan karier dan konseling siswa dengan pendekatan modern.
            </p>
            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="inline-block px-8 py-3 bg-[#D4AF37] text-white rounded-lg font-semibold hover:bg-[#B89C30] transition-colors">
                    Mulai Sekarang
                </a>
            @endif
        </div>
        <div class="md:w-1/2 mt-8 md:mt-0">
            <img src="{{ asset('images/graphic1.jpg') }}" alt="Graphic Image" class="rounded-lg">
        </div>
    </section>

    <section id="about" class="bg-gray-50 py-12 md:py-16">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-3xl font-bold text-blue-900 mb-4 relative inline-block pb-2">
                    Tentang Kami
                    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-1 bg-[#D4AF37]"></span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">Platform inovatif untuk pengembangan karier siswa</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 md:gap-8">
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm">
                    <div class="mb-4 md:mb-6">
                        <img src="{{ asset('images/logoKonselor.png') }}" alt="About" class="w-24 h-24 md:w-32 md:h-32 mx-auto">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3 md:mb-4">Visi Kami</h3>
                    <p class="text-gray-600">Membantu siswa menemukan potensi terbaik melalui bimbingan profesional dan sistem pendukung terintegrasi.</p>
                </div>
                
                <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm">
                    <div class="mb-4 md:mb-6">
                        <img src="{{ asset('images/logoKonselor.png') }}" alt="About" class="w-24 h-24 md:w-32 md:h-32 mx-auto">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3 md:mb-4">Misi Kami</h3>
                    <p class="text-gray-600">Menyediakan platform konseling modern dengan fitur lengkap untuk kebutuhan pengembangan karier siswa.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="structure" class="py-12 md:py-16">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-3xl font-bold text-blue-900 mb-4 relative inline-block pb-2">
                    Mekanisme Penanganan Kasus
                    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-1 bg-[#D4AF37]"></span>
                </h2>
                <h3 class="text-xl text-gray-600 mt-4">di SMKN 1 KOTA BENGKULU</h3>
            </div>
            <div class="max-w-4xl mx-auto">
                <img src="{{ asset('images/structure1.png') }}" alt="Alur Kasus" class="w-full h-auto rounded-lg">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-12 md:pt-16">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 items-start">
                <!-- Logo Section -->
                <div class="flex flex-col items-center md:items-start">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full bg-white p-2 mb-4">
                        <img src="{{ asset('images/veritasGroup.jpg') }}" alt="Logo" class="w-full h-full object-contain rounded-full">
                    </div>
                    <h3 class="text-2xl font-bold text-[#D4AF37] mb-2">RuangBk</h3>
                    <p class="text-sm text-gray-300">Bimbingan & Konseling Profesional</p>
                </div>

                <!-- Contact Column -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-[#D4AF37]">Kontak Kami</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-[#D4AF37]"></i>
                            SMKN 1 Kota Bengkulu
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-[#D4AF37]"></i>
                            +62 812 3456 7890
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-[#D4AF37]"></i>
                            support@ruangbk.id
                        </li>
                    </ul>
                </div>

                <!-- Social Media Column -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-[#D4AF37]">Media Sosial</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-[#D4AF37] rounded-full flex items-center justify-center text-white hover:bg-[#B89C30] transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-[#D4AF37] rounded-full flex items-center justify-center text-white hover:bg-[#B89C30] transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-[#D4AF37] rounded-full flex items-center justify-center text-white hover:bg-[#B89C30] transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-[#D4AF37]">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-300 hover:text-[#D4AF37] transition-colors">Beranda</a></li>
                        <li><a href="#about" class="text-gray-300 hover:text-[#D4AF37] transition-colors">Tentang</a></li>
                        <li><a href="#structure" class="text-gray-300 hover:text-[#D4AF37] transition-colors">Struktur</a></li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-[#D4AF37] mt-12 py-4 text-center">
                <p class="text-sm text-gray-300">
                    &copy; 2025 RuangBk. All rights reserved. &vert; Developed by Veritas Group
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('mobileMenuOverlay');
            menu.classList.toggle('translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Close menu on resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                document.getElementById('mobileMenu').classList.add('translate-x-full');
                document.getElementById('mobileMenuOverlay').classList.add('hidden');
            }
        });

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>