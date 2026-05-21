<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Materi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $adminId = $admin ? $admin->id : 1;
        $sekarang = Carbon::now();

        // 1. Buat Kategori
        $katSmp = Kategori::firstOrCreate([
            'nama_kategori' => 'SMP', 
            'slug' => 'smp',
            'deskripsi' => 'Kumpulan materi pembelajaran tingkat Sekolah Menengah Pertama (SMP).',
            'tanggal_publikasi' => $sekarang
        ]);
        
        $katSma = Kategori::firstOrCreate([
            'nama_kategori' => 'SMA', 
            'slug' => 'sma',
            'deskripsi' => 'Kumpulan materi pembelajaran tingkat Sekolah Menengah Atas (SMA).',
            'tanggal_publikasi' => $sekarang
        ]);
        
        $katKuliah = Kategori::firstOrCreate([
            'nama_kategori' => 'Kuliah', 
            'slug' => 'kuliah',
            'deskripsi' => 'Kumpulan materi pembelajaran tingkat lanjut untuk Mahasiswa.',
            'tanggal_publikasi' => $sekarang
        ]);

        // ==========================================
        // MATERI SMP (PANJANG & DETAIL)
        // ==========================================
        $kontenSmpIPA = <<<HTML
        <h2>Eksplorasi Mendalam Tata Surya Kita</h2>
        <p>Tata surya adalah sistem keplanetan yang terletak di dalam Galaksi Bima Sakti (Milky Way). Sistem ini terdiri atas sebuah bintang raksasa yang kita sebut Matahari, serta semua objek langit yang terikat secara permanen oleh gaya gravitasi raksasanya. Objek-objek tersebut sangat bervariasi, mulai dari delapan planet utama yang berukuran masif, planet-planet kerdil yang berada di pinggiran sistem, ratusan satelit alami (bulan) yang mengorbit planet-planet tersebut, hingga jutaan bongkahan batu dan es berupa asteroid, meteoroid, dan komet. Pembentukan tata surya ini diyakini terjadi sekitar 4,6 miliar tahun yang lalu dari keruntuhan gravitasi sebuah awan molekul raksasa.</p>
        
        <h3>Anatomi Matahari sebagai Reaktor Nuklir Alami</h3>
        <p>Matahari bukanlah sekadar bola api biasa. Ia adalah sebuah bintang deret utama tipe G (G-type main-sequence star) yang menyumbang sekitar 99,86% dari total massa seluruh Tata Surya. Volume Matahari sangat fantastis; Anda bisa memasukkan sekitar 1,3 juta planet seukuran Bumi ke dalamnya. Kekuatan utama Matahari terletak di bagian intinya, di mana suhu mencapai 15 juta derajat Celcius. Pada suhu dan tekanan yang ekstrem ini, terjadilah reaksi fusi nuklir, yaitu proses di mana atom-atom hidrogen bertabrakan dengan kecepatan luar biasa untuk bergabung membentuk helium. Proses ini melepaskan energi yang sangat masif, yang kemudian merambat keluar melewati zona radiatif dan zona konvektif, sebelum akhirnya dipancarkan ke luar angkasa dalam bentuk cahaya dan panas yang menopang kehidupan di Bumi.</p>
        
        <h3>Karakteristik Unik Planet Terestrial (Berbatu)</h3>
        <p>Empat planet terdekat dari Matahari diklasifikasikan sebagai planet terestrial karena permukaannya yang padat dan berbatu, serupa dengan Bumi. Mereka adalah:</p>
        <ul>
            <li><strong>Merkurius:</strong> Planet terkecil dan terdekat dengan Matahari. Karena tidak memiliki atmosfer yang signifikan untuk menahan panas, suhu di siang hari bisa mencapai 430°C, namun anjlok drastis menjadi -180°C di malam hari.</li>
            <li><strong>Venus:</strong> Sering disebut "saudara kembar" Bumi karena ukurannya yang mirip. Namun, Venus memiliki efek rumah kaca yang sangat ekstrem. Atmosfernya dipenuhi karbon dioksida tebal dan awan asam sulfat, membuatnya menjadi planet terpanas di tata surya dengan suhu permukaan rata-rata 462°C.</li>
            <li><strong>Bumi:</strong> Satu-satunya planet yang diketahui memiliki air dalam wujud cair di permukaannya dan memiliki biosfer yang mendukung kehidupan yang kompleks. Atmosfer kita yang kaya akan nitrogen dan oksigen melindungi kita dari radiasi kosmik berbahaya.</li>
            <li><strong>Mars:</strong> Dikenal sebagai Planet Merah karena kandungan oksida besi (karat) di permukaannya. Mars memiliki gunung berapi tertinggi di tata surya (Olympus Mons) dan ngarai terdalam (Valles Marineris). Saat ini, Mars menjadi target utama eksplorasi robotik untuk mencari jejak kehidupan masa lalu.</li>
        </ul>

        <h3>Keagungan Planet Raksasa Gas dan Es (Jovian)</h3>
        <p>Bergerak lebih jauh melintasi Sabuk Asteroid, kita akan menemukan empat planet raksasa yang tidak memiliki permukaan padat. Mereka didominasi oleh gas dan es:</p>
        <ul>
            <li><strong>Jupiter:</strong> Raja tata surya, planet terbesar yang sebagian besar terdiri dari hidrogen dan helium. Jupiter terkenal dengan Bintik Merah Raksasa (Great Red Spot), sebuah badai raksasa yang ukurannya lebih besar dari Bumi dan telah berlangsung selama berabad-abad.</li>
            <li><strong>Saturnus:</strong> Planet tercantik berkat sistem cincinnya yang sangat luas dan terang. Cincin ini sebenarnya terbentuk dari miliaran bongkahan es dan batu, mulai dari seukuran butiran debu hingga sebesar rumah, yang terperangkap oleh gravitasi Saturnus.</li>
            <li><strong>Uranus:</strong> Planet es raksasa pertama yang ditemukan menggunakan teleskop. Keunikannya terletak pada sumbu rotasinya yang miring hampir 98 derajat, sehingga ia mengorbit Matahari seolah-olah sedang menggelinding seperti bola.</li>
            <li><strong>Neptunus:</strong> Planet terjauh yang diketahui, sebuah dunia yang sangat dingin, gelap, dan diwarnai oleh angin terkencang di tata surya yang melaju hingga 2.100 km/jam. Warnanya yang biru tua berasal dari kandungan gas metana di atmosfer atasnya.</li>
        </ul>

        <h3>Batas Luar Tata Surya: Sabuk Kuiper dan Awan Oort</h3>
        <p>Tata surya tidak berhenti di orbit Neptunus. Di luarnya terdapat Sabuk Kuiper, sebuah wilayah berbentuk donat yang penuh dengan objek es purba, termasuk planet kerdil paling terkenal, Pluto. Lebih jauh lagi, menyelimuti seluruh tata surya seperti cangkang raksasa, terdapat Awan Oort. Wilayah teoretis ini diyakini sebagai "gudang" tempat lahirnya komet-komet periode panjang. Mempelajari batas luar ini sangat krusial karena benda-benda es tersebut menyimpan "fosil" material asli yang membentuk tata surya kita miliaran tahun silam.</p>
        HTML;

        Materi::create([
            'kategori_id' => $katSmp->kategori_id,
            'admin_id' => $adminId,
            'judul_materi' => 'IPA SMP: Mengenal Tata Surya',
            'konten_teks' => $kontenSmpIPA,
            'tanggal_publikasi' => $sekarang
        ]);

        // ==========================================
        // MATERI SMA (PANJANG & DETAIL)
        // ==========================================
        $kontenSmaSejarah = <<<HTML
        <h2>Kronik Lengkap Detik-Detik Proklamasi Kemerdekaan Indonesia</h2>
        <p>Proklamasi Kemerdekaan Republik Indonesia pada 17 Agustus 1945 bukanlah sebuah hadiah yang diberikan secara sukarela oleh penjajah, melainkan hasil dari perebutan momentum yang sangat presisi, keberanian mengambil risiko, dan dinamika psikologis yang luar biasa antara berbagai faksi pejuang. Peristiwa ini merupakan titik kulminasi dari ratusan tahun perlawanan fisik dan puluhan tahun perjuangan intelektual melalui pergerakan nasional. Pemahaman akan sejarah ini mengajarkan kita tentang pentingnya ketegasan, kecerdasan berpolitik, dan semangat pantang menyerah.</p>
        
        <h3>Konteks Global: Kehancuran Kekaisaran Jepang</h3>
        <p>Pada pertengahan tahun 1945, situasi Perang Dunia II di Front Pasifik semakin menyudutkan posisi Jepang. Titik baliknya terjadi pada bulan Agustus yang mematikan. Pada 6 Agustus 1945, pesawat pengebom B-29 Enola Gay milik Amerika Serikat menjatuhkan bom atom "Little Boy" di kota Hiroshima, memusnahkan sebagian besar kota dan menewaskan puluhan ribu penduduk dalam sekejap. Belum sempat Jepang bangkit, bom atom kedua, "Fat Man", dijatuhkan di Nagasaki pada 9 Agustus 1945. Pada saat yang bersamaan, Uni Soviet juga membatalkan pakta non-agresi dan melancarkan serangan besar-besaran ke pasukan Jepang di Manchuria.</p>
        <p>Kombinasi kehancuran absolut akibat bom atom dan invasi Soviet memaksa Kaisar Hirohito turun tangan langsung. Pada 14 Agustus 1945, melalui siaran radio yang sangat bersejarah (Gyokuon-hoso), Kaisar mengumumkan penyerahan tanpa syarat Kekaisaran Jepang kepada blok Sekutu. Di Indonesia, militer Jepang diperintahkan untuk menjaga status quo dan tidak mengubah kondisi politik apapun sampai pasukan Sekutu tiba untuk melucuti senjata mereka. Jepang yang semula menjanjikan "kemerdekaan di kemudian hari" melalui BPUPKI dan PPKI kini tidak lagi memiliki wewenang tersebut.</p>
        
        <h3>Perang Urat Saraf: Golongan Tua vs Golongan Muda</h3>
        <p>Berita kekalahan Jepang yang berusaha disembunyikan oleh militer (Gunseikan) berhasil disadap oleh Sutan Sjahrir, seorang tokoh pergerakan bawah tanah, melalui radio gelombang pendek rahasia pada 15 Agustus 1945. Sjahrir segera menghubungi Mohammad Hatta dan Soekarno untuk membatalkan rencana rapat PPKI yang dikontrol Jepang. Sjahrir dan kelompok pemuda radikal (dikenal sebagai Golongan Muda, yang meliputi Wikana, Chaerul Saleh, Sukarni, dan Darwis) mendesak agar kemerdekaan dideklarasikan saat itu juga tanpa campur tangan PPKI, agar proklamasi tidak dicap oleh Sekutu sebagai "kemerdekaan buatan Fasisme Jepang".</p>
        <p>Namun, Soekarno dan Hatta (Golongan Tua) bersikap lebih hati-hati. Mereka mempertimbangkan kekuatan militer Jepang (Rikugun dan Kaigun) yang masih bersenjata lengkap dan menguasai Jakarta. Soekarno berpendapat bahwa terburu-buru melakukan proklamasi tanpa perhitungan matang dapat memicu pertumpahan darah rakyat yang sia-sia, dan bersikeras untuk membahasnya secara formal di dalam sidang PPKI tanggal 16 Agustus. Ketegangan memuncak pada malam 15 Agustus di rumah Soekarno, di mana Wikana bahkan mengancam akan terjadi pertumpahan darah jika Soekarno tidak mengumumkan kemerdekaan besok paginya. Soekarno marah dan menantang Wikana untuk menggorok lehernya malam itu juga.</p>
        
        <h3>Penculikan Historis: Peristiwa Rengasdengklok</h3>
        <p>Menghadapi jalan buntu, Golongan Muda mengadakan rapat darurat di Cikini 71. Mereka memutuskan untuk "mengamankan" Soekarno dan Hatta agar tidak terpengaruh oleh Jepang. Pada dini hari tanggal 16 Agustus 1945, dengan bantuan anggota PETA (Pembela Tanah Air) di bawah pimpinan Shodanco Singgih, mereka membawa Soekarno (beserta istri Fatmawati dan anak Guntur) serta Hatta ke Rengasdengklok, sebuah kota kecil di Karawang yang strategis dan sudah dikuasai penuh oleh PETA.</p>
        <p>Di Rengasdengklok, Soekarno dan Hatta terus didesak untuk memproklamasikan kemerdekaan. Sementara itu di Jakarta, kebingungan melanda karena kedua tokoh utama bangsa ini menghilang. Achmad Soebardjo, salah satu tokoh senior, berhasil melacak keberadaan mereka setelah bernegosiasi dengan Wikana. Soebardjo kemudian berangkat ke Rengasdengklok dan memberikan jaminan taruhan nyawa kepada Golongan Muda bahwa Proklamasi Kemerdekaan akan dibacakan di Jakarta keesokan harinya, selambat-lambatnya pukul 12.00 siang. Jaminan ini membuat Golongan Muda luluh dan mengizinkan Soekarno-Hatta kembali ke Jakarta malam itu juga.</p>
        
        <h3>Malam Panjang di Rumah Laksamana Maeda</h3>
        <p>Setibanya di Jakarta jelang tengah malam, hotel Des Indes yang rencananya digunakan untuk rapat menolak mereka karena jam malam militer Jepang telah berlaku. Beruntung, Laksamana Tadashi Maeda, seorang perwira tinggi Angkatan Laut Jepang yang bersimpati pada perjuangan Indonesia, menawarkan rumah dinasnya (kini Museum Perumusan Naskah Proklamasi di Jl. Imam Bonjol No. 1) yang dijamin kekebalan militer sebagai tempat penyusunan naskah proklamasi.</p>
        <p>Di ruang makan Maeda, Soekarno, Hatta, dan Achmad Soebardjo merumuskan teks proklamasi yang sangat krusial. Achmad Soebardjo menyumbangkan kalimat pertama ("Kami bangsa Indonesia dengan ini menyatakan kemerdekaan Indonesia") yang mewakili kemauan keras bangsa. Hatta menyumbangkan kalimat kedua ("Hal-hal yang mengenai pemindahan kekuasaan dan lain-lain diselenggarakan dengan cara saksama dan dalam tempo yang sesingkat-singkatnya") yang berfokus pada transisi birokrasi dan kekuasaan. Soekarno menulis draf tersebut di secarik kertas.</p>
        <p>Teks tulisan tangan tersebut kemudian dibacakan di hadapan para tokoh yang hadir di ruang depan. Sempat terjadi perdebatan mengenai siapa yang harus menandatangani naskah tersebut. Atas usul Sukarni, disepakati bahwa naskah cukup ditandatangani oleh Soekarno dan Hatta "Atas Nama Bangsa Indonesia". Draf tersebut kemudian diketik ulang oleh Sayuti Melik dengan beberapa perubahan ejaan yang lebih baku (seperti "tempoh" menjadi "tempo", dan "wakil-wakil bangsa Indonesia" menjadi "Atas nama bangsa Indonesia").</p>

        <h3>Pagi Bersejarah: 17 Agustus 1945</h3>
        <p>Awalnya, proklamasi direncanakan dibacakan di Lapangan Ikada (kini kawasan Monas). Namun, Soekarno membatalkannya karena lapangan tersebut telah dijaga ketat oleh tentara Jepang yang siap menembak, sehingga rawan bentrokan berdarah. Akhirnya, pembacaan dialihkan ke halaman rumah Soekarno di Jalan Pegangsaan Timur No. 56, Jakarta.</p>
        <p>Pada hari Jumat, 17 Agustus 1945 yang bertepatan dengan bulan suci Ramadhan, persiapan dilakukan dengan sangat sederhana. Mikrofon pinjaman dari stasiun radio, dan tiang bendera bambu darurat disiapkan. Tepat pukul 10.00 WIB, dengan suara yang tegas meski kondisinya sedang sakit malaria, Ir. Soekarno membacakan teks Proklamasi Kemerdekaan Indonesia, didampingi oleh Mohammad Hatta. Setelah itu, bendera Merah Putih yang dijahit sendiri oleh Ibu Fatmawati dinaikkan oleh Latief Hendraningrat dan Suhud, diiringi nyanyian spontan lagu kebangsaan Indonesia Raya oleh hadirin. Sejak detik itu, Republik Indonesia secara *de facto* lahir sebagai negara yang merdeka dan berdaulat, memulai babak baru perang fisik dan diplomasi mempertahankan kemerdekaan.</p>
        HTML;

        Materi::create([
            'kategori_id' => $katSma->kategori_id,
            'admin_id' => $adminId,
            'judul_materi' => 'Sejarah SMA: Proklamasi 1945',
            'konten_teks' => $kontenSmaSejarah,
            'tanggal_publikasi' => $sekarang
        ]);

        // ==========================================
        // MATERI KULIAH 1 (Pemrograman Web)
        // ==========================================
        $kontenKuliahWeb = <<<HTML
        <h2>Bedah Tuntas Arsitektur MVC (Model-View-Controller) dalam Framework Modern</h2>
        <p>Dalam rekayasa perangkat lunak modern (modern software engineering), membangun aplikasi berskala besar tanpa pola arsitektur yang jelas adalah resep menuju bencana (sering disebut *spaghetti code*). Kode logika bisnis, query database, dan tag HTML yang dicampur menjadi satu file akan membuat aplikasi sangat sulit dibaca, rawan bug, dan mustahil untuk dikerjakan secara tim. Untuk mengatasi kekacauan ini, industri perangkat lunak mengadopsi <strong>Arsitektur MVC (Model-View-Controller)</strong>. Pola yang pertama kali diperkenalkan oleh Trygve Reenskaug pada era 1970-an ini telah menjadi standar industri mutlak dan menjadi tulang punggung framework web terpopuler dunia seperti Laravel (PHP), Django (Python), Spring (Java), dan Ruby on Rails.</p>
        
        <h3>1. Model (Data & Business Logic Layer)</h3>
        <p>Model adalah jantung dari aplikasi Anda. Komponen ini bertanggung jawab secara eksklusif untuk merepresentasikan struktur data, mengelola hubungan antar entitas (relationships), dan menangani semua logika bisnis (business logic) yang berkaitan dengan manipulasi informasi. Model adalah satu-satunya entitas yang diizinkan untuk berbicara secara langsung dengan sistem basis data (database).</p>
        <p>Dalam framework modern seperti Laravel, Model tidak lagi ditulis menggunakan SQL murni yang panjang, melainkan dibungkus menggunakan konsep ORM (Object-Relational Mapping) seperti Eloquent. Dengan ORM, tabel dalam database diperlakukan sebagai sebuah "Class" di PHP, dan setiap baris datanya adalah sebuah "Object". Hal ini memungkinkan developer melakukan operasi CRUD kompleks hanya dengan kode singkat seperti <code>User::where('status', 'active')->with('orders')->get();</code>. Model sama sekali buta terhadap HTML atau API; tugasnya hanya memastikan data valid, memprosesnya sesuai aturan bisnis, dan menyimpannya dengan aman.</p>
        
        <h3>2. View (Presentation Layer)</h3>
        <p>Jika Model adalah jantung, maka View adalah wajah aplikasi. View adalah satu-satunya lapisan yang bersentuhan langsung dengan pengguna akhir (end-user). Tugas tunggal dari View adalah mengambil data mentah yang dikirimkan oleh sistem dan merendernya ke dalam format yang ramah manusia—seperti halaman HTML yang dipercantik dengan CSS dan dihidupkan dengan JavaScript, atau output JSON jika sedang membangun antarmuka REST API.</p>
        <p>Aturan emas dalam MVC adalah: <strong>View tidak boleh berisi logika perhitungan yang rumit atau query database sama sekali</strong>. View bersifat pasif (dumb layer). Di Laravel, pengelolaan View didukung oleh Blade Templating Engine. Blade memungkinkan developer untuk melakukan perulangan (looping) atau kondisional (if-else) pada antarmuka HTML dengan sintaks yang sangat bersih (seperti <code>@foreach</code>), serta melindungi sistem dari serangan injeksi skrip lintas situs (XSS attacks) secara otomatis setiap kali mencetak data ke layar menggunakan <code>{{ }}</code>.</p>
        
        <h3>3. Controller (Application Flow & Routing Layer)</h3>
        <p>Controller adalah otak manajerial atau konduktor orkestra dalam sistem MVC. Ketika pengguna mengetikkan URL di browser atau mengklik sebuah tombol, permintaan HTTP tersebut (Request) pertama-tama akan ditangkap oleh sistem *Routing*, yang kemudian mendistribusikannya ke Controller yang relevan. Controller menerima instruksi tersebut dan memutuskankan tindakan apa yang harus diambil selanjutnya.</p>
        <p>Misalnya, ketika pengguna meminta halaman "Profil Siswa", Controller akan menjalankan urutan kerja berikut: (1) Menerima request ID siswa dari URL, (2) Memanggil Model 'Siswa' untuk mencari data berdasarkan ID tersebut, (3) Melakukan validasi izin apakah pengguna yang login berhak melihat profil tersebut, dan (4) Mengirimkan data profil yang berhasil didapatkan ke View 'Profile' untuk dirender menjadi halaman web utuh. Industri memiliki pepatah <em>"Fat Models, Skinny Controllers"</em>—yang berarti Controller harus tetap ramping dan hanya berfungsi sebagai jembatan pembawa pesan, sedangkan logika proses yang rumit harus diserahkan kepada Model atau Service Class terpisah.</p>
        
        <h3>Mengapa Perusahaan Membutuhkan MVC?</h3>
        <p>Pengadopsian arsitektur MVC bukan sekadar gaya-gayaan penulisan kode, melainkan memiliki dampak langsung terhadap manajemen proyek dan produktivitas tim pengembang perangkat lunak:</p>
        <ul>
            <li><strong>Pengembangan Paralel (Simultaneous Development):</strong> Karena kode antar lapisan terpisah secara fisik di folder yang berbeda, seorang Front-end developer bisa menata desain tombol di View, sementara Back-end developer merancang struktur tabel di Model pada saat yang sama tanpa mengalami bentrok kode (merge conflict).</li>
            <li><strong>Pemeliharaan Tinggi (High Maintainability):</strong> Jika aplikasi mengalami *error* pada perhitungan pajak keranjang belanja, *engineer* tahu persis bahwa mereka harus mencari perbaikannya di Model terkait, tanpa perlu menggulir ribuan baris kode tampilan HTML. Ini menghemat jam kerja pemecahan masalah (debugging) secara eksponensial.</li>
            <li><strong>Fleksibilitas Antarmuka:</strong> Karena Model mengurus data secara independen, kita bisa menggunakan kembali (reuse) Model yang sama untuk melayani View HTML di website, View JSON untuk aplikasi Android, atau XML untuk komunikasi antar-server, tanpa perlu menulis ulang logika pengolahan data intinya.</li>
        </ul>
        <p>Meskipun ada kurva belajar (learning curve) di awal, penguasaan terhadap pola desain MVC adalah syarat mutlak bagi siapapun yang ingin berkarir sebagai Web Engineer profesional di industri modern.</p>
        HTML;

        Materi::create([
            'kategori_id' => $katKuliah->kategori_id,
            'admin_id' => $adminId,
            'judul_materi' => 'Web Dev: Arsitektur MVC Secara Mendalam',
            'konten_teks' => $kontenKuliahWeb,
            'tanggal_publikasi' => $sekarang
        ]);

        // ==========================================
        // MATERI KULIAH 2 (Desain UI/UX)
        // ==========================================
        $kontenKuliahUIUX = <<<HTML
        <h2>Seni dan Ilmu Desain Antarmuka (UI) dan Pengalaman Pengguna (UX)</h2>
        <p>Dalam era digital di mana rentang perhatian pengguna (user attention span) semakin memendek, produk perangkat lunak tidak lagi bisa sekadar mengandalkan fungsionalitas belaka. Sebuah aplikasi yang canggih algoritmanya akan segera ditinggalkan penggunanya jika tampilannya membingungkan dan sulit dioperasikan. Di sinilah disiplin ilmu UI/UX Design memegang peranan vital. Meskipun sering dirangkai menjadi satu istilah, UI (User Interface) dan UX (User Experience) adalah dua profesi, fokus, dan tanggung jawab yang sangat berbeda namun mutlak saling membutuhkan layaknya struktur tulang dan kulit pada tubuh manusia.</p>
        
        <h3>Membongkar Mitos: UX Jauh Lebih Dari Sekadar Antarmuka</h3>
        <p><strong>User Experience (UX)</strong> adalah disiplin analitis dan strategis. Ini berurusan dengan psikologi pengguna, struktur logika, dan bagaimana rasanya menggunakan produk tersebut. Seorang UX Designer tidak bekerja dengan warna-warni cantik pada tahap awal. Mereka menghabiskan waktunya untuk melakukan riset pasar, mewawancarai calon pengguna, membuat *User Persona* (karakter fiktif target pasar), dan memetakan *User Journey* (langkah demi langkah pengguna dari awal sampai tujuan akhir tercapai).</p>
        <p>Tugas utama UX adalah memastikan produk memiliki *Utility* (kegunaan), *Usability* (kemudahan penggunaan), dan *Desirability* (daya tarik fungsional). Misalnya, jika pengguna ingin membeli sepatu di aplikasi e-commerce, UX Designer akan merancang alur: Bagaimana cara pengguna memfilter ukuran sepatu? Seberapa pendek formulir *checkout* yang dibutuhkan agar pengguna tidak malas mengisi? Bagaimana jika kartu kredit pengguna ditolak sistem, pesan apa yang harus muncul agar mereka tidak panik? Itulah yang disebut dengan mendesain "pengalaman".</p>

        <h3>UI Design: Representasi Visual dan Emosi Produk</h3>
        <p>Jika UX menentukan bagaimana sebuah mobil bekerja dan terasa nyaman dikendarai, maka <strong>User Interface (UI)</strong> adalah cat luar mobil, desain setir, dan tampilan dasbornya. UI Design sepenuhnya bersifat visual, interaktif, dan berhubungan dengan estetika presentasi produk digital. Seorang UI Designer akan mengambil *wireframe* (kerangka kasar) yang telah divalidasi oleh tim UX, lalu memberikan "nyawa" kepadanya.</p>
        <p>UI Design melibatkan pemahaman mendalam tentang teori warna (color psychology), di mana warna merah digunakan untuk peringatan bahaya dan hijau untuk kesuksesan. Mereka juga mengatur pasangan tipografi (font) agar teks mudah dibaca (*legibility*). Salah satu prinsip paling penting dalam UI adalah pengelolaan ruang kosong (*Whitespace* atau *Negative Space*). Ruang kosong bukanlah ruang yang terbuang sia-sia; ia digunakan untuk memberikan "napas" pada antarmuka agar pengguna tidak merasa kewalahan oleh informasi yang padat. UI Designer juga membuat desain mikro-interaksi, seperti animasi perubahan warna saat sebuah tombol disorot (hover) oleh kursor mouse.</p>

        <h3>10 Heuristik Usability dari Jakob Nielsen</h3>
        <p>Dalam dunia UX, terdapat pedoman universal yang diciptakan oleh Jakob Nielsen pada tahun 1990 yang tetap menjadi standar industri hingga detik ini untuk mengevaluasi kualitas desain antarmuka. Beberapa poin paling esensial dari 10 Heuristik tersebut meliputi:</p>
        <ol>
            <li><strong>Visibilitas Status Sistem (Visibility of system status):</strong> Aplikasi harus selalu memberi tahu pengguna apa yang sedang terjadi. Misalnya, menampilkan indikator *loading spinner* ketika aplikasi sedang memproses unggahan file, agar pengguna tidak mengira aplikasinya *hang* atau *error*.</li>
            <li><strong>Kecocokan Sistem dengan Dunia Nyata (Match between system and the real world):</strong> Gunakan bahasa dan konsep yang familiar bagi pengguna awam, bukan istilah teknis *programmer*. Misalnya, gunakan ikon "Keranjang Belanja" untuk fitur e-commerce, karena itu relevan dengan dunia nyata.</li>
            <li><strong>Kendali dan Kebebasan Pengguna (User control and freedom):</strong> Pengguna sering kali melakukan klik secara tidak sengaja. Berikan mereka "pintu darurat" yang jelas untuk membatalkan tindakan, seperti fitur tombol *Undo* (urungkan) atau kemampuan untuk membatalkan proses unggahan di tengah jalan.</li>
            <li><strong>Pencegahan Kesalahan (Error prevention):</strong> Desain yang baik tidak hanya memberikan pesan error yang jelas, tapi mencegah error itu terjadi sejak awal. Contohnya: menonaktifkan (*disable*) tombol 'Submit' sebelum semua kolom wajib pada formulir diisi dengan benar.</li>
            <li><strong>Konsistensi dan Standar (Consistency and standards):</strong> Jangan membuat pengguna menebak-nebak apakah kata atau ikon yang berbeda memiliki arti yang sama. Jika tombol aksi utama (Primary Button) di halaman beranda berwarna biru dengan bentuk melengkung, maka di halaman pengaturan tombol tersebut juga harus berwarna biru dengan lengkungan yang sama.</li>
        </ol>

        <h3>Alur Kerja Modern (Modern Handoff Workflow)</h3>
        <p>Di perusahaan teknologi, proses desain tidak berhenti pada gambar cantik. Desain harus diserahkan (handoff) kepada tim Front-end Developer untuk diubah menjadi kode program sungguhan. Saat ini, standar industri menggunakan alat berbasis cloud komprehensif seperti Figma. Di dalam Figma, UI Designer membuat *Design System* (perpustakaan komponen terpusat berisi warna, font, dan ukuran tombol). Ketika diserahkan ke *developer*, Figma dapat secara otomatis menerjemahkan desain visual tersebut ke dalam variabel CSS dan tata letak dasar, menjembatani kesenjangan komunikasi antara seniman visual dan teknisi kode (coder).</p>
        HTML;

        Materi::create([
            'kategori_id' => $katKuliah->kategori_id,
            'admin_id' => $adminId,
            'judul_materi' => 'Desain Digital: Pendalaman Teori UI/UX',
            'konten_teks' => $kontenKuliahUIUX,
            'tanggal_publikasi' => $sekarang
        ]);
    }
}