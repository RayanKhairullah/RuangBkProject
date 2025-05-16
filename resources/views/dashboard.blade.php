<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Siswa</title>
  @vite(['resources/css/app.css'])
  <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
</head>
<body class="bg-white">
<header class="top-0 mx-auto flex justify-between items-center p-6 bg-white">
  <div class="flex items-center">
  <img src="{{ asset('images/logoKonselor.png') }}" alt="Logo Bk" class="h-10 w-auto mr-2">
  <span class="text-xl font-extrabold bg-gradient-to-r from-[#2400FF] to-[#FFFF00] bg-clip-text text-transparent">
    Ruang<span class="text-yellow-500">Bk</span>
  </span>
  </div>
  <nav class="flex-grow text-center">
    <ul class="space-x-6 inline-flex">
      <li><a href="javascript:void(0);" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" id="homeLink" onclick="handleHomeClick()">Home</a></li>
      <li><a href="#riwayat-pelanggaran" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('riwayat-pelanggaran')">Riwayat Pelanggaran</a></li>
      <li><a href="#biodata" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('biodata')">Biodata</a></li>
      <li><a href="#structure" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('structure')">Structure</a></li>
    </ul>
  </nav>
  <div class="dropdown">
    <div class="dropdown-toggle" onclick="toggleDropdown()">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><defs><style>.cls-3{fill:#6fabe6}.cls-4{fill:#82bcf4}</style></defs><g id="User_profile" data-name="User profile"><path d="M47 24A23 23 0 1 1 12.81 3.91 23 23 0 0 1 47 24z" style="fill:#374f68"/><path d="M47 24a22.91 22.91 0 0 1-8.81 18.09A22.88 22.88 0 0 1 27 45C5.28 45-4.37 17.34 12.81 3.91A23 23 0 0 1 47 24z" style="fill:#425b72"/><path class="cls-3" d="M39.2 35.39a19 19 0 0 1-30.4 0 17 17 0 0 1 10.49-8.73 8.93 8.93 0 0 0 9.42 0 17 17 0 0 1 10.49 8.73z"/><path class="cls-4" d="M39.2 35.39a19 19 0 0 1-4.77 4.49 19 19 0 0 1-15.13-1 7.08 7.08 0 0 1-.51-12.18c.1-.07 0-.05.5-.05a9 9 0 0 0 9.42 0 17 17 0 0 1 10.49 8.74z"/><path class="cls-3" d="M33 19a9 9 0 1 1-12.38-8.34A9 9 0 0 1 33 19z"/><path class="cls-4" d="M33 19a9 9 0 0 1-2.6 6.33c-9.13 3.74-16.59-7.86-9.78-14.67A9 9 0 0 1 33 19z"/></g></svg>
        <span class="font-bold text-black">Hi, Aldi</span>
      <img width="16" height="16" src="https://img.icons8.com/metro/50/chevron-down.png" alt="chevron-down"/>
    </div>
            <ul class="dropdown-content">
                <li class="font-bold"><a href="#">Akses Admin</a></li>
                <li class="font-bold"><a href="#">Akses Guru</a></li>
                <li class="font-bold"><a href="#">Akses Siswa</a></li>
            </ul>
        </div>
        <div class="md:hidden cursor-pointer" onclick="toggleSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </div>
        <div class="sidebar fixed top-0 right-0 h-full w-64 bg-white z-40 transform translate-x-full transition-transform duration-300 ease-in-out">
            <div class="p-6">
                <button onclick="toggleSidebar()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <ul id="ul1" class="relative space-y-6">
                  <li><a href="javascript:void(0);" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" id="homeLink" onclick="handleHomeClick()">Home</a></li>
                  <li><a href="#riwayat-pelanggaran" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('riwayat-pelanggaran')">Riwayat Pelanggaran</a></li>
                  <li><a href="#biodata" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('biodata')">Biodata</a></li>
                  <li><a href="#structure" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('structure')">Structure</a></li>
                </ul>
                <hr class="border-gray-200 my-4">
                <div class="mt-6 font-bold text-black">
                    <ul class="relative space-y-2 mt-2">
                        <li><a href="#">Akses Admin</a></li>
                        <li><a href="#">Akses Guru</a></li>
                        <li><a href="#">Akses Siswa</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
  </header>
  <section id="home" class="flex flex-col md:flex-row items-center justify-between px-8 py-16 space-y-10 md:space-y-0 md:space-x-10">
    <div class="md:w-1/2 space-y-6">
      <p class="text-3xl font-bold">Hi, (user)!</p>
        <h1 class="text-5xl font-extrabold leading-tight bg-gradient-to-r from-[#2400FF] via-[#FFFF00] to-[#FFB800] bg-clip-text text-transparent">
          Selamat Datang<br>
          Di RuangBk!
        </h1>  
        <a href="#" class="btn-daftar">
          Konseling
        </a>
      </div>
      <div class="md:w-1/2 mt-8 md:mt-0">
        <img src="{{ asset('images/graphic2.jpg') }}" alt="Graphic Image" class="responsive-img">
      </div>
  </section>
  <section id="riwayat-pelanggaran" class="px-8 py-16">
    <div class="mt-10">
    <div class="relative w-64 mx-4">
  <span class="absolute inset-y-0 left-0 flex items-center pl-3">
    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1016.65 2a7.5 7.5 0 000 14.5z" />
    </svg>
  </span>
  <input type="text" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search...">
</div>

      <table class="min-w-full border text-sm text-left">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 border">No</th>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Riwayat Kasus</th>
            <th class="px-4 py-2 border">Catatan</th>
            <th class="px-4 py-2 border">Poin</th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td class="px-4 py-2 border text-center">1</td>
              <td class="px-4 py-2 border">Aldi</td>
              <td class="px-4 py-2 border">Mencuri</td>
              <td class="px-4 py-2 border">sekali lagi, masuk bk</td>
              <td class="px-4 py-2 border">10 (Atribut sekolah tidak lengkap)</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
  <section id="biodata">
    <!-- Belum ditambahkan -->
  </section>
  <section id="structure" class="items-center py-6 min-h-screen">
    <div class="text-center py-12">
      <h2 class="text-3xl font-bold">Mekanisme Penanganan Kasus</h2>
      <h2 class="text-3xl font-bold">di SMKN 1 KOTA BENGKULU</h2>
    </div>
    <div class="flex justify-center items-center">
      <img src="{{ asset('images/structure1.jpg') }}" alt="Alur Kasus" class="responsive-img">
    </div>
  </section>
  <footer class="px-8 py-6">
    <ul class="flex space-x-8 font-bold pt-16 pl-4">
      <li><a href="#">Home</a></li>
      <li><a href="#riwayat-pelanggaran">Riwayat Pelanggaran</a></li>
      <li><a href="#biodata">Biodata</a></li>
      <li><a href="#structure">Structure</a></li>
      <li><a href="#footer" id="footer">Footer</a></li>
    </ul>
    <hr class="w-full border-black my-4">
    <p class="text-black pl-4">
      Copyright &copy;2024 all rights reserved &vert;&vert; By Veritas Group
    </p>
  </footer>
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
