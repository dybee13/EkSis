<div id="filterBerita" class="grid grid-cols-6 gap-2 p-4">
    <div class="col-span-full flex justify-between items-center mt-16">
        <p class="text-2xl font-semibold mb-2">Filter Berita berdasarkan Kategori :</p>
        <div class="relative mb-2">
            <input type="text" placeholder="Cari berita berdasarkan judul" class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-96 pl-10 focus:outline-none focus:ring-2 focus:ring-green-500">
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.4-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <script>
        function setActiveFilter(event) {
            document.querySelectorAll('.filter-item').forEach(item => {
                item.classList.remove('bg-green-700', 'text-white');
                item.classList.add('bg-gray-200', 'text-green-700');
            });
            event.target.classList.remove('bg-gray-200', 'text-green-700');
            event.target.classList.add('bg-green-700', 'text-white');
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.filter-item').forEach(item => {
                item.addEventListener('click', setActiveFilter);
            });
        });
    </script>

    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center" onclick="setActiveFilter(event)">Semua</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center" onclick="setActiveFilter(event)">Pengurus</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center" onclick="setActiveFilter(event)">Siswa</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center" onclick="setActiveFilter(event)">Guru</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center" onclick="setActiveFilter(event)">Kegiatan</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center" onclick="setActiveFilter(event)">Prestasi</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center" onclick="setActiveFilter(event)">Alumni</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center" onclick="setActiveFilter(event)">Pengumuman</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center" onclick="setActiveFilter(event)">Event</span>
</div>

<div class="col-span-full grid grid-cols-4 gap-4 mt-8 p-6">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="https://via.placeholder.com/300" alt="Berita 1" class="w-full h-48 object-cover">
        <div class="mt-2 ml-2">
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Pengumuman</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Event</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Kejuaraan</span>
            <h3 class="text-lg font-semibold mt-2">Judul Berita 1</h3>
            <p class="text-gray-600 text-sm mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi delectus saepe commodi eum. Ratione?</p>
        </div>
    </div>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="https://via.placeholder.com/300" alt="Berita 1" class="w-full h-48 object-cover">
        <div class="mt-2 ml-2">
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Pengumuman</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Event</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Kejuaraan</span>
            <h3 class="text-lg font-semibold mt-2">Judul Berita 1</h3>
            <p class="text-gray-600 text-sm mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi delectus saepe commodi eum. Ratione?</p>
        </div>
    </div>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="https://via.placeholder.com/300" alt="Berita 1" class="w-full h-48 object-cover">
        <div class="mt-2 ml-2">
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Pengumuman</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Event</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Kejuaraan</span>
            <h3 class="text-lg font-semibold mt-2">Judul Berita 1</h3>
            <p class="text-gray-600 text-sm mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi delectus saepe commodi eum. Ratione?</p>
        </div>
    </div>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="https://via.placeholder.com/300" alt="Berita 1" class="w-full h-48 object-cover">
        <div class="mt-2 ml-2">
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Pengumuman</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Event</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Kejuaraan</span>
            <h3 class="text-lg font-semibold mt-2">Judul Berita 1</h3>
            <p class="text-gray-600 text-sm mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi delectus saepe commodi eum. Ratione?</p>
        </div>
    </div>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="https://via.placeholder.com/300" alt="Berita 1" class="w-full h-48 object-cover">
        <div class="mt-2 ml-2">
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Pengumuman</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Event</span>
            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm">Kejuaraan</span>
            <h3 class="text-lg font-semibold mt-2">Judul Berita 1</h3>
            <p class="text-gray-600 text-sm mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi delectus saepe commodi eum. Ratione?</p>
        </div>
    </div>
</div>