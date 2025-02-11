<div class=" flex justify-center items-center z-50 relative">
    <button id="dropdownButton" class="px-6 py-3 mt-20 ml-16 mr-16 w-[900px] font-semibold bg-blue-600 text-white rounded-lg focus:outline-none">
        Pilih Kategori
    </button>

    <div id="dropdownMenu" class="absolute top-full mt-2 w-[900px] bg-white border rounded-lg shadow-lg hidden">
        <button data-category="all" class="block px-6 py-3 w-[900px] text-gray-800 hover:bg-gray-200 text-center">Semua</button>
        <button data-category="olahraga" class="block px-6 py-3 w-[900px] text-gray-800 hover:bg-gray-200 text-center">Olahraga</button>
        <button data-category="seni" class="block px-6 py-3 w-[900px] text-gray-800 hover:bg-gray-200 text-center">Seni</button>
    </div>
</div>

<div id="cardContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6 mt-8">
    <!-- Card 1 (Olahraga) -->
    <a href="/dataEkskul" class="card relative rounded-lg overflow-hidden shadow-lg transform transition duration-300 hover:scale-105" data-category="olahraga">
        <img src="./assets/images/ekstrakulikuler/badminton.jpg" class="w-full h-64 object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center text-center hover:bg-opacity-50">
            <div class="p-4">
                <h2 class="text-xl font-bold text-white">Badminton</h2>
            </div>
        </div>
    </a>

    <!-- Card 2 (Olahraga) -->
    <a href="#" class="card relative rounded-lg overflow-hidden shadow-lg transform transition duration-300 hover:scale-105" data-category="olahraga">
        <img src="./assets/images/ekstrakulikuler/basket.jpg" class="w-full h-64 object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center text-center hover:bg-opacity-50">
            <div class="p-4">
                <h2 class="text-xl font-bold text-white">Basket</h2>
            </div>
        </div>
    </a>

    <!-- Card 3 (Olahraga) -->
    <a href="#" class="card relative rounded-lg overflow-hidden shadow-lg transform transition duration-300 hover:scale-105" data-category="olahraga">
        <img src="./assets/images/ekstrakulikuler/futsal.jpg" class="w-full h-64 object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center text-center hover:bg-opacity-50">
            <div class="p-4">
                <h2 class="text-xl font-bold text-white">Futsal</h2>
            </div>
        </div>
    </a>

    <!-- Card 4 (Seni) -->
    <a href="#" class="card relative rounded-lg overflow-hidden shadow-lg transform transition duration-300 hover:scale-105" data-category="seni">
        <img src="./assets/images/ekstrakulikuler/nemo.jpg" class="w-full h-64 object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center text-center hover:bg-opacity-50">
            <div class="p-4">
                <h2 class="text-xl font-bold text-white">Nemo</h2>
            </div>
        </div>
    </a>
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