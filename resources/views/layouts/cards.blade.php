<div class="flex justify-center items-center z-50 relative">
    <button id="dropdownButton" class="px-6 py-3 mt-20 ml-16 mr-16 w-[900px] font-semibold bg-blue-600 text-white rounded-lg focus:outline-none">
        Pilih Kategori
    </button>

    <div id="dropdownMenu" class="absolute top-full mt-2 w-[900px] bg-white border rounded-lg shadow-lg hidden">
        <div class="grid grid-cols-4 gap-4 p-4">
            <button data-category="all" class="px-6 py-3 text-gray-800 hover:bg-gray-200 text-center rounded-lg border">Semua</button>
            <button data-category="olahraga" class="px-6 py-3 text-gray-800 hover:bg-gray-200 text-center rounded-lg border">Olahraga</button>
            <button data-category="seni" class="px-6 py-3 text-gray-800 hover:bg-gray-200 text-center rounded-lg border">Seni</button>
            <button data-category="bahasa" class="px-6 py-3 text-gray-800 hover:bg-gray-200 text-center rounded-lg border">Bahasa</button>
            <button data-category="sains" class="px-6 py-3 text-gray-800 hover:bg-gray-200 text-center rounded-lg border">Religi</button>
        </div>
    </div>
</div>



<div id="cardContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6 mt-8">
    @foreach ($ekskuls as $ekskul)
        @php
            $logo = optional($ekskul->informasiEkskul)->logo ?? 'images/ekstrakulikuler/default.png';
            $kategori = optional($ekskul->informasiEkskul)->kategori ?? 'lainnya'; // Ambil kategori dari DB
        @endphp
        <a href="/dataEkskul/{{ $ekskul->id }}" class="card relative rounded-lg overflow-hidden shadow-lg transform transition duration-300 hover:scale-105" data-category="{{ $kategori }}">
            <img src="{{ asset('storage/' . $logo) }}" class="w-full h-64 object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center text-center hover:bg-opacity-50">
                <div class="p-4">
                    <h2 class="text-xl font-bold text-white">{{ $ekskul->nama_ekskul }}</h2>
                </div>
            </div>
        </a>  
    @endforeach
</div>

<!-- Pesan jika tidak ada ekskul yang sesuai -->
<p id="no-ekskul-message" class="text-gray-600 text-center mt-4 font-semibold hidden">Tidak ada ekstrakurikuler dalam kategori ini.</p>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownButton = document.getElementById("dropdownButton");
        const dropdownMenu = document.getElementById("dropdownMenu");
        const cardContainer = document.getElementById("cardContainer");
        const dropdownOptions = dropdownMenu.querySelectorAll("button");

        // Toggle dropdown
        dropdownButton.addEventListener("click", function() {
            dropdownMenu.classList.toggle("hidden");
        });

        // Hide dropdown when clicking outside
        document.addEventListener("click", function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add("hidden");
            }
        });

        // Filter function
        // dropdownOptions.forEach(option => {
        //     option.addEventListener("click", function() {
        //         const category = this.getAttribute("data-category");
        //         dropdownButton.innerText = this.innerText; // Update button text
        //         dropdownMenu.classList.add("hidden"); // Close dropdown

        //         const cards = cardContainer.querySelectorAll(".card");
        //         cards.forEach(card => {
        //             if (category === "all" || card.getAttribute("data-category") === category) {
        //                 card.classList.remove("hidden");
        //             } else {
        //                 card.classList.add("hidden");
        //             }
        //         });
        //     });
        // });

        let allButton = document.querySelector('#dropdownMenu button[data-category="all"]');
        allButton.classList.add('bg-green-500', 'text-white'); // Warna hijau saat awal

        document.querySelectorAll('#dropdownMenu button').forEach(button => {
            button.addEventListener('click', function() {
                let selectedCategory = this.getAttribute('data-category');
                let ekskulCards = document.querySelectorAll('#cardContainer .card');
                let adaEkskul = false; // Cek apakah ada ekskul yang tampil

                // Reset warna semua tombol sebelum menambahkan warna ke tombol yang dipilih
                document.querySelectorAll('#dropdownMenu button').forEach(btn => {
                    btn.classList.remove('bg-green-500', 'text-white');
                    btn.classList.add('text-gray-800', 'hover:bg-gray-200');
                });

                // Tambahkan warna hijau ke tombol yang diklik
                this.classList.add('bg-green-500', 'text-white');
                this.classList.remove('text-gray-800', 'hover:bg-gray-200');

                ekskulCards.forEach(card => {
                    let category = card.getAttribute('data-category');

                    if (selectedCategory === "all" || category === selectedCategory) {
                        card.style.display = "block";
                        adaEkskul = true;
                    } else {
                        card.style.display = "none";
                    }
                });

                // Jika tidak ada ekskul yang tampil, munculkan pesan
                let noEkskulMessage = document.getElementById('no-ekskul-message');
                if (!adaEkskul) {
                    noEkskulMessage.classList.remove("hidden");
                } else {
                    noEkskulMessage.classList.add("hidden");
                }
            });
        });
    });
</script>