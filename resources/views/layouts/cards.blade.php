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
        <a href="/dataEkskul/{{ $ekskul->id }}" class="card relative rounded-lg overflow-hidden shadow-lg transform transition duration-300 hover:scale-105" data-category="olahraga">
            <img src="{{ asset('storage/blogs/default.png') }}" class="w-full h-64 object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center text-center hover:bg-opacity-50">
                <div class="p-4">
                    <h2 class="text-xl font-bold text-white">{{ $ekskul->nama_ekskul }}</h2>
                </div>
            </div>
        </a>  
    @endforeach
</div>

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
        dropdownOptions.forEach(option => {
            option.addEventListener("click", function() {
                const category = this.getAttribute("data-category");
                dropdownButton.innerText = this.innerText; // Update button text
                dropdownMenu.classList.add("hidden"); // Close dropdown

                const cards = cardContainer.querySelectorAll(".card");
                cards.forEach(card => {
                    if (category === "all" || card.getAttribute("data-category") === category) {
                        card.classList.remove("hidden");
                    } else {
                        card.classList.add("hidden");
                    }
                });
            });
        });
    });
</script>