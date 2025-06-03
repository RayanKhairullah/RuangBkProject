<x-layouts.app :title="__('Dokumentasi Aplikasi')">
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-8 text-center animate-pulse">
            📚 {{ __('Dokumentasi Penggunaan Aplikasi') }} 🚀
        </h1>

        <p class="text-lg text-gray-700 dark:text-gray-300 mb-8 text-center italic">
            {{ __('Selamat datang! Panduan ini akan membantu Anda memahami berbagai fitur dan cara menggunakannya secara efektif.') }}
        </p>

        <section class="mb-12 border-b pb-8 border-gray-200 dark:border-gray-700">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-6">
                <span class="text-blue-600 dark:text-blue-400">1.</span> {{ __('Umum') }}
            </h2>
            <div class="space-y-6 text-gray-700 dark:text-gray-300">
                <h3 class="text-2xl font-semibold leading-relaxed">🔑 {{ __('1.1. Login & Dashboard') }}</h3>
                <p>
                    {{ __('Setelah berhasil login, Anda akan diarahkan ke halaman Dashboard. Halaman ini menampilkan ringkasan aktivitas dan menu navigasi penting.') }}
                </p>
                <p>
                    {{ __('Peran Anda (Guru atau Siswa) akan secara otomatis menentukan menu dan fitur yang terlihat di sidebar, memastikan pengalaman yang relevan.') }}
                </p>

                <h3 class="text-2xl font-semibold leading-relaxed">⚙️ {{ __('1.2. Pengaturan Profil') }}</h3>
                <p>
                    {{ __('Anda dapat memperbarui informasi pribadi (nama, email), dan pengaturan tampilan (Appearance) melalui menu "Settings" di pojok kiri bawah sidebar.') }}
                </p>
                <ul class="list-disc list-inside ml-8 space-y-2">
                    <li><strong>📝 {{ __('Nama & Email:') }}</strong> {{ __('Perbarui nama dan alamat email Anda. Jika email diubah, Anda mungkin perlu melakukan verifikasi ulang.') }}</li>
                    <li><strong>🔒 {{ __('Password:') }}</strong> {{ __('Penting untuk secara berkala memperbarui password Anda melalui fitur ini, demi menjaga keamanan data pribadi dan mencegah akses tidak sah.') }}</li>
                </ul>
            </div>
        </section>

        @if (auth()->user()->role === App\Enums\UserRole::Teacher)
        <section class="mb-12 border-b pb-8 border-gray-200 dark:border-gray-700">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-6">
                <span class="text-green-600 dark:text-green-400">2.</span> {{ __('Untuk Guru') }}
            </h2>
            <div class="space-y-6 text-gray-700 dark:text-gray-300">
                <h3 class="text-2xl font-semibold leading-relaxed">🏫 {{ __('2.1. Kelas (Rooms)') }}</h3>
                <p>
                    {{ __('Kelola data kelas siswa. Anda memiliki kemampuan penuh untuk membuat, melihat detail, mengedit, dan menghapus data kelas.') }}
                </p>
                <ul class="list-disc list-inside ml-8 space-y-2">
                    <li><strong>➕ {{ __('Membuat Kelas:') }}</strong> <span class="font-medium">{{ __('Saat membuat kelas, pastikan kombinasi Jurusan, Angkatan, dan Tingkatan Kelas unik. Sistem akan secara otomatis menolak duplikasi untuk menjaga integritas data.') }}</span></li>
                    <li><strong>👀 {{ __('Melihat Kelas:') }}</strong> {{ __('Di halaman detail kelas, Anda dapat dengan mudah melihat daftar siswa yang terdaftar di kelas tersebut, lengkap dengan status biodata mereka.') }}</li>
                    <li><strong class="text-red-500">⚠️ {{ __('Menghapus Kelas:') }}</strong> <span class="font-bold">{{ __('HARAP BERHATI-HATI! Tindakan ini sangat krusial dan akan menghapus SEMUA data siswa yang terkait dengan kelas tersebut secara permanen. Pastikan Anda sudah mem-backup data jika diperlukan.') }}</span></li>
                </ul>

                <h3 class="text-2xl font-semibold leading-relaxed">🧩 {{ __('2.2. Jurusan') }}</h3>
                <p>
                    {{ __('Kelola data jurusan. Jurusan merupakan entitas yang sangat krusial karena terkait langsung dengan struktur data kelas dan siswa.') }}
                </p>
                <ul class="list-disc list-inside ml-8 space-y-2">
                    <li><strong class="text-red-500">🚨 {{ __('Peringatan Krusial:') }}</strong> <span class="font-bold">{{ __('Membuat dan terutama menghapus jurusan adalah tindakan yang berisiko tinggi. Kesalahan dapat menyebabkan inkonsistensi yang meluas dan kehilangan data yang tidak dapat dipulihkan di seluruh aplikasi, terutama pada data kelas dan relasinya.') }}</span></li>
                </ul>

                <h3 class="text-2xl font-semibold leading-relaxed">💬 {{ __('2.3. Konseling') }}</h3>
                <p>
                    {{ __('Fungsionalitas ini memungkinkan Anda untuk menjadwalkan dan mencatat setiap sesi konseling dengan siswa. Anda dapat dengan mudah melihat riwayat konseling dan memantau statusnya.') }}
                </p>

                <h3 class="text-2xl font-semibold leading-relaxed">📝 {{ __('2.4. Catatan Siswa') }}</h3>
                <p>
                    {{ __('Buat dan kelola catatan-catatan penting terkait siswa. Ini bisa berupa catatan perilaku, kasus tertentu, prestasi, atau informasi relevan lainnya yang membantu dalam bimbingan.') }}
                </p>

                <h3 class="text-2xl font-semibold leading-relaxed">✉️ {{ __('2.5. Surat Panggilan Ortu') }}</h3>
                <p>
                    {{ __('Fasilitas untuk membuat dan mengelola surat panggilan resmi yang ditujukan kepada orang tua/wali siswa. Ini sangat membantu dalam komunikasi terkait masalah atau kebutuhan siswa.') }}
                </p>
            </div>
        </section>
        @endif

        @if (auth()->user()->role === App\Enums\UserRole::User)
        <section class="mb-12 border-b pb-8 border-gray-200 dark:border-gray-700">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-6">
                <span class="text-purple-600 dark:text-purple-400">3.</span> {{ __('Untuk Siswa') }}
            </h2>
            <div class="space-y-6 text-gray-700 dark:text-gray-300">
                <h3 class="text-2xl font-semibold leading-relaxed">👤 {{ __('3.1. Biodata') }}</h3>
                <p>
                    {{ __('Lengkapi dan perbarui informasi biodata pribadi Anda di sini. Pastikan semua data terisi dengan benar dan akurat.') }}
                </p>

                <h3 class="text-2xl font-semibold leading-relaxed">🗣️ {{ __('3.2. Konseling') }}</h3>
                <p>
                    {{ __('Lihat jadwal konseling yang telah diatur dan riwayat sesi konseling Anda. Anda juga dapat mengajukan permintaan konseling baru melalui email kepada guru BK.') }}
                </p>

                <h3 class="text-2xl font-semibold leading-relaxed">📄 {{ __('3.3. Catatan Siswa') }}</h3>
                <p>
                    {{ __('Lihat catatan-catatan penting yang dibuat oleh guru terkait Anda. Ini sangat bermanfaat untuk memantau kemajuan belajar atau area yang perlu Anda tingkatkan.') }}
                </p>
            </div>
        </section>
        @endif

        <section>
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-6">
                💡 {{ __('4. Bantuan & Dukungan') }}
            </h2>
            <p class="text-lg text-gray-700 dark:text-gray-300 mb-4">
                {{ __('Jika Anda memiliki pertanyaan lebih lanjut atau mengalami masalah, silakan hubungi administrator sistem Anda.') }}
                <a href="https://github.com/RayanKhairullah" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                    Github
                </a>
            </p>
            <p class="text-lg text-gray-700 dark:text-gray-300">
                {{ __('Terima kasih telah menggunakan aplikasi ini.') }}
            </p>
        </section>
    </div>
</x-layouts.app>