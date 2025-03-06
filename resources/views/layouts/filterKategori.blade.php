<div id="filterBerita" class="grid grid-cols-6 gap-2 p-4">
    <div class="col-span-full flex justify-between items-center mt-16">
        <p class="text-2xl font-semibold mb-2">Filter Berita berdasarkan Kategori :</p>
        <div class="relative mb-2">
            <input id="searchInput" type="text" placeholder="Cari berita berdasarkan judul" class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-96 pl-10 focus:outline-none focus:ring-2 focus:ring-green-500">
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.4-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Semua</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Pengurus</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Siswa</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Guru</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Kegiatan</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Prestasi</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Alumni</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Pengumuman</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Event</span>
</div>

<div class="col-span-full grid grid-cols-4 gap-4 mt-8 p-6">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden berita-card">
        <img src="https://via.placeholder.com/300" alt="Berita 1" class="w-full h-48 object-cover">
        <div class="mt-2 ml-2">
            <span class="berita-category bg-green-600 text-white px-3 py-1 rounded-full text-sm">Pengumuman</span>
            <span class="berita-category bg-green-600 text-white px-3 py-1 rounded-full text-sm">Kejuaraan</span>
            <h3 class="berita-title text-lg font-semibold mt-2">Judul Berita 1</h3>
            <p class="text-gray-600 text-sm mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi delectus saepe commodi eum. Ratione?</p>
        </div>
    </div>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden berita-card">
        <img src="https://via.placeholder.com/300" alt="Berita 2" class="w-full h-48 object-cover">
        <div class="mt-2 ml-2">
            <span class="berita-category bg-green-600 text-white px-3 py-1 rounded-full text-sm">Pengumuman</span>
            <span class="berita-category bg-green-600 text-white px-3 py-1 rounded-full text-sm">Kejuaraan</span>
            <span class="berita-category bg-green-600 text-white px-3 py-1 rounded-full text-sm">Prestasi</span>
            <h3 class="berita-title text-lg font-semibold mt-2">Judul Berita 2</h3>
            <p class="text-gray-600 text-sm mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi delectus saepe commodi eum. Ratione?</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector("#searchInput");
        const filterItems = document.querySelectorAll(".filter-item");
        const beritaCards = document.querySelectorAll(".berita-card");

        function filterNews() {
            const searchText = searchInput.value.toLowerCase();
            const activeCategory = document.querySelector(".filter-item.bg-green-700")?.innerText.trim().toLowerCase();

            beritaCards.forEach(card => {
                const title = card.querySelector(".berita-title").innerText.toLowerCase();
                const categories = Array.from(card.querySelectorAll(".berita-category")).map(cat => cat.innerText.toLowerCase());

                const matchesSearch = searchText === "" || title.includes(searchText);
                const matchesCategory = !activeCategory || activeCategory === "semua" || categories.includes(activeCategory);

                card.style.display = matchesSearch && matchesCategory ? "block" : "none";
            });
        }

        searchInput.addEventListener("input", filterNews);

        filterItems.forEach(item => {
            item.addEventListener("click", function(event) {
                filterItems.forEach(i => i.classList.remove("bg-green-700", "text-white"));
                event.target.classList.add("bg-green-700", "text-white");
                filterNews();
            });
        });
    });
</script>