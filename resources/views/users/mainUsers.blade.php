<section class="bg-gray-900 min-h-screen flex items-center justify-center relative top-0 z-30">
    <div class="py-8 px-4 mx-auto max-w-screen-lg text-center lg:py-16 relative z-30">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            Selamat datang di Eksis!
        </h1>
        <p class="mb-8 text-lg font-normal lg:text-xl sm:px-16 lg:px-32 text-gray-200">
            Sistem Pencatatan Eskul Siswa Digital
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="/listEkskul" class="inline-flex justify-center items-center py-3 px-6 text-base font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Semua Ekstrakurikuler
            </a>
            <a href="/tentangWebsite" class="inline-flex justify-center items-center py-3 px-6 text-base font-medium text-white rounded-lg bg-gray-700 hover:bg-gray-500 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-900">
                Tentang Website
            </a>
        </div>
    </div>
    <!-- bg gradient -->
    <div class="bg-gradient-to-b to-transparent from-blue-400 absolute inset-0 z-20">
    </div>
</section>
<div class="w-full flex items-center justify-center py-20">
    <div class="flex flex-col w-4/5 gap-16">
        <!-- Berita 1 -->
        <div class="flex items-center gap-10">
            <div class="w-1/2 flex justify-center">
                <img src="./assets/images/ekskul.png" class="w-96 h-64 object-cover rounded-lg shadow-lg">
            </div>
            <div class="w-1/2">
                <h2 class="text-xl font-bold text-gray-800">Judul Berita Dummy 1</h2>
                <p class="text-gray-600 mt-2">
                    Ini adalah deskripsi singkat dari berita dummy pertama. Konten ini hanya sebagai contoh.
                </p>
                <button class="mt-4 px-4 py-2 bg-blue-400 text-white rounded-xl">Baca Selengkapnya</button>
            </div>
        </div>

        <!-- Berita 2 -->
        <div class="flex items-center gap-10 flex-row-reverse">
            <div class="w-1/2 flex justify-center">
                <img src="./assets/images/ekskul.png" class="w-96 h-64 object-cover rounded-lg shadow-lg">
            </div>
            <div class="w-1/2">
                <h2 class="text-xl font-bold text-gray-800">Judul Berita Dummy 2</h2>
                <p class="text-gray-600 mt-2">
                    Ini adalah deskripsi singkat dari berita dummy kedua. Konten ini hanya sebagai contoh.
                </p>
                <button class="mt-4 px-4 py-2 bg-blue-400 text-white rounded-xl">Baca Selengkapnya</button>
            </div>
        </div>
    </div>
</div>


<!-- konten 1 -->
<div class="relative flex justify-center items-center mt-6">
    <div class="absolute w-full h-3 bg-slate-700 top-1/2 -translate-y-1/2"></div>

    <div class="relative flex gap-6 z-0">
        <!-- Kejuaraan -->
        <div class="rounded-xl shadow-xl min-h-[13rem] max-h-[13rem] min-w-[13rem] max-w-[13rem] bg-white flex flex-col justify-center items-center">
            <a class="flex flex-col" href="">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 items-center ml-4" viewBox="0 0 512 512">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M176 464h160M256 464V336M384 224c0-50.64-.08-134.63-.12-160a16 16 0 00-16-16l-223.79.26a16 16 0 00-16 15.95c0 30.58-.13 129.17-.13 159.79 0 64.28 83 112 128 112S384 288.28 384 224z" />
                    <path d="M128 96H48v16c0 55.22 33.55 112 80 112M384 96h80v16c0 55.22-33.55 112-80 112" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                </svg>
                <h1 class="text-3xl text-center">Kejuaraan</h1>
            </a>
        </div>

        <!-- Ekskul -->
        <div class="rounded-xl shadow-xl min-h-[13rem] max-h-[13rem] min-w-[13rem] max-w-[13rem] bg-white flex flex-col justify-center items-center">
            <a href="">
                <svg viewBox="0 0 512 512" class="w-24 items-center text-black" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                    <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zm-48 0l-.003-.282-26.064 22.741-62.679-58.5 16.454-84.355 34.303 3.072c-24.889-34.216-60.004-60.089-100.709-73.141l13.651 31.939L256 139l-74.953-41.525 13.651-31.939c-40.631 13.028-75.78 38.87-100.709 73.141l34.565-3.073 16.192 84.355-62.678 58.5-26.064-22.741-.003.282c0 43.015 13.497 83.952 38.472 117.991l7.704-33.897 85.138 10.447 36.301 77.826-29.902 17.786c40.202 13.122 84.29 13.148 124.572 0l-29.902-17.786 36.301-77.826 85.138-10.447 7.704 33.897C442.503 339.952 456 299.015 456 256zm-248.102 69.571l-29.894-91.312L256 177.732l77.996 56.527-29.622 91.312h-96.476z" />
                </svg>
                <h1 class="text-3xl text-center">Ekskul</h1>
            </a>
        </div>

        <!-- Berita -->
        <div class="rounded-xl shadow-xl min-h-[13rem] max-h-[13rem] min-w-[13rem] max-w-[13rem] bg-white flex flex-col justify-center items-center">
            <a class="flex flex-col" href="">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 items-center" viewBox="0 0 512 512">
                    <path d="M368 415.86V72a24.07 24.07 0 00-24-24H72a24.07 24.07 0 00-24 24v352a40.12 40.12 0 0040 40h328" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                    <path d="M416 464h0a48 48 0 01-48-48V128h72a24 24 0 0124 24v264a48 48 0 01-48 48z" fill="black" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M240 128h64M240 192h64M112 256h192M112 320h192M112 384h192" />
                    <path d="M176 208h-64a16 16 0 01-16-16v-64a16 16 0 0116-16h64a16 16 0 0116 16v64a16 16 0 01-16 16z" fill="black" />
                </svg>
                <h1 class="text-3xl text-center">Berita</h1>
            </a>
        </div>

    </div>
</div>
<p class="text-3xl translate-y-44 text-center font-semibold bg-slate-100 mt-[-135px]">Kejuaraan</p>
<div class="bg-slate-100 w-full flex items-center justify-center py-20 ">
    <div class="flex w-4/5 gap-10">
        <!-- Gambar Fixed -->
        <div class="w-1/2 flex justify-center mt-20">
            <img src="./assets/images/kejuaraan.png" class="w-86 h-86 ">
        </div>

        <!-- Slider -->
        <div class="w-1/2 relative overflow-hidden mt-36">
            <div class="relative w-full">
                <div class="overflow-hidden relative">
                    <div class="flex transition-transform duration-500 ease-in-out" id="slider">
                    @foreach ($blogsachi as $blog)
                        <div class="w-full flex-shrink-0">
                        @foreach($blog->blogImages as $image)
                        <img src="{{ asset('storage/blogs/' . $image->image_path) }}" alt="Gambar 1" class="w-full h-48 object-cover">
                        @endforeach
                            <p class="bg-white p-4 rounded-lg mt-2 shadow text-center font-semibold">{{ $blog->title }}</p>
                        </div>
                    @endforeach
                    </div>
                </div>
                <!-- Navigasi -->
                <button id="prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-blue-500 text-white p-2 rounded-full shadow-lg">&#10094;</button>
                <button id="next" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-blue-500 text-white p-2 rounded-full shadow-lg">&#10095;</button>
            </div>
        </div>
    </div>
</div>

<!-- Konten 2 -->
<div class="bg-white">

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <defs>
            <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="0" dy="10" stdDeviation="10" flood-color="rgba(0, 0, 0, 0.3)" />
            </filter>
        </defs>
        <path fill="#f3f4f5" fill-opacity="1" filter="url(#shadow)" d="M0,224L120,192C240,160,480,96,720,96C960,96,1200,160,1320,192L1440,224L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"></path>
    </svg>

    <p class="text-3xl text-center font-semibold">Ekstrakulikuler</p>
    <div class="w-full flex items-center justify-center py-2 ">
        <div class="flex w-4/5 gap-10">
            <div class="w-1/2 relative overflow-hidden mt-36">
                <div class="relative w-full">
                    <div class="overflow-hidden relative">
                        <div class="flex transition-transform duration-500 ease-in-out" id="slider2">
                            <div class="w-full flex-shrink-0">
                                <img src="./assets/images/ekskul.png" alt="Slide 1" class="w-96 h-64 md:ml-12 rounded-lg items-center">
                                <p class="p-4 rounded-lg mt-2 shadow text-center font-semibold">Badminton</p>
                            </div>
                            <div class="w-full flex-shrink-0">
                                <img src="./assets/images/ekskul.png" alt="Slide 2" class="w-96 h-64 md:ml-12 items-center rounded-lg">
                                <p class="p-4 rounded-lg mt-2 shadow text-center font-semibold">Nemo Band</p>
                            </div>
                            <div class="w-full flex-shrink-0">
                                <img src="./assets/images/ekskul.png" alt="Slide 3" class="w-96 h-64 md:ml-12 rounded-lg items-center">
                                <p class="p-4 rounded-lg mt-2 shadow text-center font-semibold">Silat</p>
                            </div>
                        </div>
                    </div>
                    <button id="prev2" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-blue-500 text-white p-2 rounded-full shadow-lg">&#10094;</button>
                    <button id="next2" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-blue-500 text-white p-2 rounded-full shadow-lg">&#10095;</button>
                </div>
            </div>
            <div class="w-1/2 flex justify-center mt-20">
                <img src="./assets/images/kejuaraan.png" class="w-86 h-86 ">
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <defs>
            <filter id="strongShadow" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="0" dy="15" stdDeviation="15" flood-color="rgba(0, 0, 0, 0.5)" />
            </filter>
        </defs>
        <path fill="#f3f4f5" fill-opacity="1" filter="url(#strongShadow)" d="M0,64L120,96C240,128,480,192,720,197.3C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
    </svg>

</div>

<!-- konten 3 -->
<div class="bg-slate-100">
    <p class="text-3xl text-center font-semibold mb-6">Berita</p>
    <div id="post-container" class="flex justify-center gap-6 px-4 flex-wrap">
        @foreach ($blogs as $blog)
            <!-- Card 1 -->
        <a href="/mainBlog" class="bg-white shadow-lg rounded-xl overflow-hidden w-80 block">
            @foreach($blog->blogImages as $image)
            <img src="{{ asset('storage/blogs/' . $image->image_path) }}" alt="Gambar 1" class="w-full h-48 object-cover">
            @endforeach
            <div class="p-4">
                <span class="bg-green-600 text-white text-sm px-3 py-1 rounded-lg inline-block mb-2 -translate-y-[200px]">{{ $blog->keterangan }}</span>
                <p class="font-semibold text-lg">{{ $blog->title }}</p>
            </div>
        </a>
        @endforeach
    </div>

    <div class="text-center mt-6">
        <button id="load-more" class="border border-green-600 text-green-600 px-6 py-2 rounded-full hover:bg-green-600 hover:text-white transition">LEBIH BANYAK</button>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="-translate-y-86">
        <defs>
            <filter id="strongShadow" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="0" dy="15" stdDeviation="15" flood-color="rgba(0, 0, 0, 0.5)" />
            </filter>
        </defs>
        <path fill="#f3f4f5" fill-opacity="1" filter="url(#strongShadow)" d="M0,64L120,96C240,128,480,192,720,197.3C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
    </svg>

</div>

<!-- Credit -->
<div class="w-full h-1 bg-black"></div>
<div class="flex justify-between m-12">
    <!-- Box 1 -->
    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 w-80">
        <h2 class="text-xl font-semibold text-gray-800">&#9432; Tentang</h2>
        <div class="mt-4 space-y-2">
            <button class="w-full bg-slate-400 text-white py-2 px-4 rounded-md">&#128101; Pengembang Website</button>
        </div>
    </div>

    <!-- Box 2 -->
    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 w-80">
        <h2 class="text-xl font-semibold text-gray-800">&#128279; Kunjungi Website Lain</h2>
        <div class="mt-4 space-y-2">
            <button class="w-full bg-slate-400 text-white py-2 px-4 rounded-md">NEPARKING</button>
            <!-- <button class="w-full bg-green-600 text-white py-2 px-4 rounded-md"></button>
            <button class="w-full bg-green-600 text-white py-2 px-4 rounded-md"></button> -->
        </div>
    </div>

    <!-- Box 3 -->
    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200 w-80">
        <h2>Informasi Sekolah</h2>
        <h2 class="text-xl font-semibold text-gray-800">SMK Negeri 1 Cirebon</h2>
        <p class="mt-2 text-slate-600"> Jl. Perjuangan By Pass Sunyaragi, Cirebon, Indonesia 45132</p>
        <p class="mt-1 text-slate-600">&#9742; Telp & Fax: +62-0231-480202</p>
        <p class="mt-1 text-slate-600">&#128231; Email: info@smkn1-cirebon.sch.id</p>
        <div class="mt-4 flex space-x-2 justify-center">
            <a class="bg-gray-200 p-2 rounded-md" href="https://referensi.data.kemdikbud.go.id/tabs.php?npsn=20222174">&#8505;</a>
        </div>
    </div>
</div>

<div class="w-full h-1 bg-black mt-6"></div>


<footer class="shadow-sm bg-gray-900 sticky w-full z-10">
    <div class="w-full max-w-screen-xl mx-auto p-2">
        <p class="text-sm sm:text-center text-gray-400">© 2025 | <a href="#" class="hover:underline">Sistem Pencatatan Ekskul Siswa Digital SMK Negeri 1 CIREBON</a></p>
        <p class="text-sm sm:text-center text-gray-400">All Rights Reserved. Created with ❤️</p>
    </div>
</footer>

<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('#slider > div');
    const totalSlides = slides.length;
    const slider = document.getElementById("slider");

    function updateSlider() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlider();
    }

    document.getElementById("next").addEventListener("click", nextSlide);
    document.getElementById("prev").addEventListener("click", prevSlide);

    // Auto slide every 3 seconds
    setInterval(nextSlide, 3000);

    let currentIndex2 = 0;
    const slides2 = document.querySelectorAll('#slider2 > div');
    const totalSlides2 = slides2.length;
    const slider2 = document.getElementById("slider2");

    function updateSlider2() {
        slider2.style.transform = `translateX(-${currentIndex2 * 100}%)`;
    }

    function nextSlide2() {
        currentIndex2 = (currentIndex2 + 1) % totalSlides2;
        updateSlider2();
    }

    function prevSlide2() {
        currentIndex2 = (currentIndex2 - 1 + totalSlides2) % totalSlides2;
        updateSlider2();
    }

    document.getElementById("next2").addEventListener("click", nextSlide2);
    document.getElementById("prev2").addEventListener("click", prevSlide2);

    // Auto slide every 3 seconds
    setInterval(nextSlide2, 3000);


    // load more
    document.getElementById('load-more').addEventListener('click', function() {
        const container = document.getElementById('post-container');
        for (let i = 0; i < 3; i++) {
            let newCard = document.createElement('div');
            newCard.className = "bg-white shadow-lg rounded-xl overflow-hidden w-80";
            newCard.innerHTML = `
                <img src="image-placeholder.jpg" alt="Gambar Baru" class="w-full h-48 object-cover">
                <div class="p-4">
                    <span class="bg-green-600 text-white text-sm px-3 py-1 rounded-lg inline-block mb-2 -translate-y-[200px]">Admin</span>
                    <p class="font-semibold text-lg">Konten...</p>
                </div>
            `;
            container.appendChild(newCard);
        }
    });
</script>