@extends('partials.navbar')
<div class="relative lg:h-screen h-[80vh] flex items-center justify-center">
    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/80"></div>

    <div class="absolute inset-0 bg-cover bg-center opacity-30 sm:bg-contain md:bg-cover">
        <img class="bg-cover h-full w-full object-cover" src="{{ $detailBlog->blogImages->isNotEmpty() ? asset('storage/blogs/' . $detailBlog->blogImages->first()->image_path) : asset('storage/blogs/default.png') }}" alt="">
    </div>

    <!-- Content Box -->
    <div class="relative px-6 py-6 flex justify-center bg-slate-100 mx-6 sm:mx-12 md:mx-32 lg:mx-64 rounded-2xl">
        <p class="text-3xl font-bold text-center">
            {{ $detailBlog->title }}
        </p>
    </div>
</div>


<div class="flex justify-start px-[34px] py-6 mx-24 mb-10 bg-black -translate-y-16">
    <ul>
        <a href="/mainEkskul" class="flex flex-col items-center text-center rounded-sm md:p-0 {{ request()->is('mainEkskul') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white' }}">
            <svg class="w-6 h-6 mb-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M10.2 2.4a2.25 2.25 0 0 1 3.6 0l7.5 10A2.25 2.25 0 0 1 19.5 15H18v5.25A2.25 2.25 0 0 1 15.75 22h-2.25a.75.75 0 0 1-.75-.75V16.5a.75.75 0 0 0-.75-.75H12a.75.75 0 0 0-.75.75v4.75a.75.75 0 0 1-.75.75H8.25A2.25 2.25 0 0 1 6 20.25V15H4.5a2.25 2.25 0 0 1-1.8-3.6l7.5-10Z" />
            </svg>
            Home
        </a>
    </ul>

    <ul class="text-white mx-4 font-bold">
        <
            </ul>
            <ul>
                <a href="/listEskul" class="flex flex-col whitespace-nowrap items-center text-center rounded-sm md:p-0 {{ request()->is('mainEkskul') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.5 6.75A.75.75 0 0 1 5.25 6h13.5a.75.75 0 0 1 0 1.5H5.25a.75.75 0 0 1-.75-.75ZM4.5 12a.75.75 0 0 1 .75-.75h13.5a.75.75 0 0 1 0 1.5H5.25A.75.75 0 0 1 4.5 12ZM5.25 17.25a.75.75 0 0 0 0 1.5h13.5a.75.75 0 0 0 0-1.5H5.25Z" clip-rule="evenodd" />
                    </svg>
                    Semua Extrakulikuler
                </a>
            </ul>

            <ul class="text-white mx-4 h-5 font-bold">
                <
                    </ul>
                    <ul class="text-base text-white whitespace-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum perferendis dicta nesciunt illum, dolorum quibusdam voluptatibus fugit nam facilis facere!</ul>
</div>


<div class="max-w-6xl mx-auto bg-white overflow-hidden -translate-y-14 flex flex-col md:flex-row rounded-xl">
    <div class="w-full md:w-2/3">
        <!-- deskripsi 1 -->
        <div class="px-6 py-4">
            <img src="{{ $detailBlog->blogImages->isNotEmpty() ? asset('storage/blogs/' . $detailBlog->blogImages->first()->image_path) : asset('storage/blogs/default.png') }}" alt="Image" class="w-full h-auto object-cover rounded-xl">
            <p class="text-base text-black mt-4">
                <span class="text-lg text-black font-semibold">{{ $detailBlog->title }}. </span>{{ $detailBlog->body }}
            </p>
        </div>
        <div class="px-6 py-4">
        @if($detailBlog->blogImages->count() > 1)
            <!-- Menampilkan gambar kedua jika ada lebih dari satu gambar -->
            <img src="{{ asset('storage/blogs/' . $detailBlog->blogImages[1]->image_path) }}" 
                alt="Gambar Kedua - {{ $detailBlog->title }}" 
                class="w-full h-48 object-cover">
        @elseif($detailBlog->blogImages->count() == 1)
            <!-- Menampilkan gambar pertama jika hanya ada satu gambar -->
            <img src="{{ asset('storage/blogs/' . $detailBlog->blogImages[0]->image_path) }}" 
                alt="Gambar Pertama - {{ $detailBlog->title }}" 
                class="w-full h-48 object-cover">
        @else
            <!-- Menampilkan gambar default jika tidak ada gambar -->
            <img src="{{ asset('storage/blogs/default.png') }}" 
                alt="Gambar Default - {{ $detailBlog->title }}" 
                class="w-full h-48 object-cover">
        @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div class="w-full md:w-1/3 bg-gray-100 p-6 rounded-lg ml-4 max-h-auto overflow-auto mt-4">
        <div class="mb-4">
            <h3 class="text-lg font-semibold border-b-2 border-green-600 pb-2">Penulis Blog</h3>
            <div class="flex flex-wrap gap-2 mt-2">
                <span class="bg-green-200 text-green-700 px-3 py-1 rounded-full text-sm">{{ $detailBlog->ekskul->nama_ekskul }}</span>
            </div>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-semibold border-b-2 border-green-600 pb-2">Label</h3>
            <div class="flex flex-wrap gap-2 mt-2">
                <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">{{ $detailBlog->keterangan }}</span>
            </div>
        </div>

        <!-- Berita Lainnya  -->
        <!-- card 1 -->
        <div class="mb-4">
            <h3 class="text-lg font-semibold border-b-2 border-green-600 pb-2">Berita Lainnya</h3>
            @foreach ($blogs as $blog)
            <div class="flex flex-wrap gap-2 mt-2">
                <a href="/detailBlog/{{ $blog->id }}" class="card relative rounded-lg mt-2 overflow-hidden shadow-lg transform transition duration-300 hover:scale-105" data-category="olahraga">
                    <img src="{{ asset('storage/blogs/' . $blog->blogImages->first()->image_path) }}" class="h-48 w-[335px] object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-10 flex items-center justify-center text-center hover:bg-opacity-20">
                        <div class="p-4">
                            <h2 class="text-xs font-bold text-white -translate-x-[4px] translate-y-[64px] whitespace-normal">{{ Str::limit($blog->body, 80) }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- card 2
        <div class="mb-4">
            <div class="flex flex-wrap gap-2 mt-2">
                <a href="/dataEkskul" class="card relative rounded-lg mt-2 overflow-hidden shadow-lg transform transition duration-300 hover:scale-105" data-category="olahraga">
                    <img src="./assets/images/ekstrakulikuler/nemo.jpg" class="h-48 w-[335px] object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-10 flex items-center justify-center text-center hover:bg-opacity-20">
                        <div class="p-4">
                            <h2 class="text-xs font-bold text-white -translate-x-[4px] translate-y-[64px] whitespace-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo itaque laboriosam ipsa commodi quasi nulla magnam facilis, sit ex doloribus.</h2>
                        </div>
                    </div>
                </a>
            </div>
        </div> -->

    </div>

</div>