<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
@extends('partials.navbar')
<div class="relative lg:h-screen h-[80vh] flex items-center justify-center">
    <!-- Overlay Gradient -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/80"></div>

    <!-- Background Image (Responsif di sm & md) -->
    <div class="absolute inset-0 bg-cover bg-center opacity-30 sm:bg-contain md:bg-cover"
        style="background-image: url('{{ asset('assets/images/ekstrakulikuler/futsal.jpg') }}');">
    </div>

    <!-- Content Box -->
    <div class="relative px-6 py-6 flex justify-center bg-slate-100 mx-6 sm:mx-12 md:mx-32 lg:mx-64 rounded-2xl">
        <p class="text-3xl font-bold text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam in eius quos ut nesciunt iure perspiciatis quaerat consectetur eos quasi?
        </p>
    </div>
</div>


<div class="flex justify-start px-[34px] py-6 mx-24 mb-10 bg-black -translate-y-32">
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


<div class="max-w-6xl mx-auto bg-white shadow-md overflow-hidden -translate-y-14">
    <!-- Gambar -->
    <img src="assets/images/ekstrakulikuler/futsal.jpg" alt="Image" class="w-full">

    <div class="p-6 flex flex-col md:flex-row gap-6">
        <!-- Konten Kiri -->
        <div class="flex-1">
            <p class="text-gray-700 text-lg">
                <span class="font-bold text-green-700">SMKN 1 Cirebon</span> atau <span class="font-bold">NEPER</span> menunjukkan komitmen yang kuat dalam upaya melestarikan budaya lokal. Setelah sukses melaksanakan Pergelaran Tari Kolosal Cepetan 1.000 penari dalam kegiatan puncak gelar karya Projek Penguatan. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloremque pariatur quasi, enim aspernatur qui tempora in quibusdam, magni unde, cupiditate iure. Expedita ipsam magnam aut reprehenderit quidem repellat ad id inventore natus. Provident, sunt sed iure cum perferendis excepturi dolores! Incidunt dolorem sunt, deleniti similique, natus accusamus explicabo id dicta illo ratione optio pariatur tenetur. Veniam cupiditate rem ullam eligendi eveniet necessitatibus ad quam excepturi vitae tempore quae provident commodi incidunt, nobis temporibus? Deleniti dolore voluptatibus nostrum! Expedita dicta necessitatibus nisi neque sit perferendis beatae laudantium deserunt consequuntur iusto quo amet, eligendi ducimus qui quos, quibusdam, non doloribus illo facere?
            </p>
            <p class="mt-4 text-lg">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi ipsum explicabo error. Asperiores, ab. Omnis nesciunt aspernatur facere nam corporis.
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat a sit animi perspiciatis saepe fugiat libero inventore reprehenderit quae? Atque id dolores corporis molestiae error eos minima numquam sit deserunt.
            </p>
        </div>

        <!-- Sidebar -->
        <div class="w-full md:w-1/3 bg-gray-100 p-4 rounded-lg">
            <!-- Penulis Postingan -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold border-b-2 border-green-600 pb-2">Penulis Postingan</h3>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="bg-green-200 text-green-700 px-3 py-1 rounded-full text-sm">Admin</span>
                </div>
            </div>

            <!-- Semua Label -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold border-b-2 border-green-600 pb-2">Label</h3>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">SMK Hebat</span>
                </div>
            </div>
        </div>
    </div>
</div>