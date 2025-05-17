<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Siswa</title>
  @vite(['resources/css/app.css'])
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="bg-white">
  <header class="top-0 mx-auto flex justify-between items-center p-6 bg-white">
    <div class="flex items-center">
      <img src="{{ asset('images/logoKonselor.png') }}" alt="Logo Bk" class="h-10 w-auto mr-2">
      <span class="text-xl font-extrabold bg-gradient-to-r from-[#2400FF] to-[#FFFF00] bg-clip-text text-transparent">
        Ruang<span class="text-yellow-500">Bk</span>
      </span>
    </div>
    <nav class="flex-grow text-center hidden md:block">
      <ul class="space-x-6 inline-flex">
        <li><a href="javascript:void(0);" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" id="homeLink" onclick="handleHomeClick()">Home</a></li>
        <li><a href="#riwayat-pelanggaran" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('riwayat-pelanggaran')">Riwayat Pelanggaran</a></li>
        <li><a href="#structure" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('structure')">Structure</a></li>
      </ul>
    </nav>
    <div class="dropdown relative hidden md:inline-block">
      <div class="dropdown-toggle cursor-pointer flex items-center text-[1.2em] font-semibold" onclick="toggleDropdown()">
        <span class="font-bold text-black mr-2">Aldi</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <span class="arrow ml-[5px] transition-transform duration-300">
          <img width="20" height="20" src="https://img.icons8.com/metro/50/chevron-down.png" alt="chevron-down"/>
        </span>
      </div>
        <ul class="dropdown-content absolute right-0 min-w-[160px] bg-white shadow-lg z-[1] opacity-0 transition-opacity duration-300 delay-300 hidden">
          <li class="font-bold block px-4 py-3 text-black no-underline hover:bg-gray-100"><a href="#">Biodata</a></li>
        </ul>
    </div>
    <div class="hamburger md:hidden cursor-pointer" onclick="toggleSidebar()">
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
        <ul class="ul1 relative space-y-6">
            <li><a href="javascript:void(0);" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" id="homeLink" onclick="handleHomeClick()">Home</a></li>
            <li><a href="#riwayat-pelanggaran" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('riwayat-pelanggaran')">Pelanggaran</a></li>
            <li><a href="#structure" class="nav-link w-24 h-10 text-lg font-bold font-poppins text-white hover:text-black text-stroke transition-colors duration-300 ease-in-out" onclick="setActiveLink('structure')">Structure</a></li>
        </ul>
        <hr class="border-gray-200 my-4">
        <div class="mt-6 font-bold text-black">
          <ul class="relative space-y-2 mt-2">
            <li><a href="#">Biodata</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="overlay hidden fixed inset-0 z-30"></div>
  </header>
  <section id="home" class="flex flex-col md:flex-row items-center justify-between px-12 py-12 md:py-0">
    <div class="md:w-1/2 space-y-6">
      <p class="text-3xl font-bold">Hi, Aldi!</p>
        <h1 class="text-5xl font-extrabold leading-tight bg-gradient-to-r from-[#2400FF] via-[#FFFF00] to-[#FFB800] bg-clip-text text-transparent">
          Selamat Datang<br>
          Di RuangBk!
        </h1>  
        <a href="#" class="inline-block px-6 py-3 border-2 border-[#2400FF] font-extrabold rounded-[16px] bg-gradient-to-r from-[#2400FF] to-[#FFFF00] text-transparent bg-clip-text transition-transform duration-300 hover:scale-110">
          Konseling
        </a>
      </div>
      <div class="md:w-1/2 mt-8 md:mt-0">
        <img src="{{ asset('images/graphic2.jpg') }}" alt="Graphic Image" class="w-full h-auto">
      </div>
  </section>
  <section id="riwayat-pelanggaran" class="px-8 py-16 mt-10">
    <div class="relative w-64 mx-0 py-4">
      <span class="absolute inset-y-0 left-0 flex items-center pl-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
      </span>
      <input type="text" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari Kasus">
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
