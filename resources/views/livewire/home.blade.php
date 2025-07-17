<div>
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
</div>
