<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<button type="button" class="text-white whitespace-nowrap ml-[1080px] mt-20 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none" id="openModal">
    + Tambahkan Blogs
</button>

<div id="tambahBlogs" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-6 md:w-[960px]">
            <h2 class="text-lg font-semibold mb-4">Tambah Blog</h2>
            <form id="addBlogForm">

                <!-- Gambar Input with multiple attribute for multiple file uploads -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" id="image" name="image" multiple class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                </div>

                <!-- Gambar Preview -->
                <div id="imagePreview" class="mb-4 flex flex-wrap gap-2">
                </div>

                <!-- Judul -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan judul blog" required />
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <input type="text" id="description" name="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan deskripsi blog" required />
                </div>

                <!-- Tanggal -->
                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="date" name="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-4">
                    <button type="button" id="closeModal" class="text-gray-500 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md">Batal</button>
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Table -->
<table class="w-5xl text-sm text-left text-gray-500 ml-[230px] mt-2">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-4 py-1">No</th>
            <th scope="col" class="px-4 py-1">Gambar</th>
            <th scope="col" class="px-4 py-1">Judul</th>
            <th scope="col" class="px-4 py-1">Tanggal</th>
            <th scope="col" class="px-4 py-1">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr class="bg-white border-b border-gray-200">
            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal">1</th>
            <td class="px-4 py-2"><img src="./assets/images/kejuaraan.png" class="w-15 h-15" alt=""></td>
            <td class="px-4 py-2">Lorem ipsum dolor sit amet...</td>
            <td class="px-4 py-2">25/02/2025</td>
            <td class="px-4 py-2 flex items-center space-x-4">
                <button id="editButton" class="text-green-500 hover:text-green-700 mt-4">
                    <i class="fas fa-edit text-2xl"></i>
                </button>


                <button class="text-red-500 hover:text-red-700 mt-4" onclick="confirmDelete(event)">
                    <i class="fas fa-trash text-2xl"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>

<!-- Modal Edit Blog -->
<div id="editBlogModal" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-6 md:w-[960px]">
            <h2 class="text-lg font-semibold mb-4">Edit Blog</h2>
            <form id="editBlogForm">
                <div class="mb-4">
                    <label for="editTitle" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" id="editTitle" name="editTitle" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>

                <div class="mb-4">
                    <label for="editDescription" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <input type="text" id="editDescription" name="editDescription" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>

                <div class="mb-4">
                    <label for="editDate" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="editDate" name="editDate" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
                </div>

                <div class="flex justify-between mt-4">
                    <button type="button" id="closeEditModal" class="text-gray-500 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md">Batal</button>
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Penghapusan</h2>
            <p class="mb-4">Apakah Anda yakin ingin menghapus blog ini?</p>
            <div class="flex justify-between mt-4">
                <button type="button" id="closeConfirmModal" class="text-gray-500 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md">Batal</button>
                <button type="button" id="confirmDeleteButton" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- modal 1 -->
<script>
    const openModalButton = document.getElementById('openModal');
    const closeModalButton = document.getElementById('closeModal');
    const modal = document.getElementById('tambahBlogs');
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const addBlogForm = document.getElementById('addBlogForm');


    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });


    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
        addBlogForm.reset();
        imagePreview.innerHTML = '';
    });


    imageInput.addEventListener('change', (event) => {
        const files = event.target.files;
        imagePreview.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = (function(theFile) {
                return function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('w-20', 'h-20', 'object-cover', 'rounded-md');
                    imagePreview.appendChild(imgElement);
                };
            })(file);

            reader.readAsDataURL(file);
        }
    });

    // Handle form submission
    addBlogForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(addBlogForm);
        const images = formData.getAll('image'); // Get all uploaded images

        alert('Blog added!');
        modal.classList.add('hidden');
        addBlogForm.reset();
        imagePreview.innerHTML = ''; // Clear image previews after submission
    });
</script>

<!-- modal 2 -->
<script>
    const editButton = document.getElementById('editButton');
    const editModal = document.getElementById('editBlogModal');
    const closeEditModalButton = document.getElementById('closeEditModal');
    const editBlogForm = document.getElementById('editBlogForm');

    // Saat tombol Edit diklik, modal muncul
    editButton.addEventListener('click', () => {
        editModal.classList.remove('hidden');
    });

    // Saat tombol Batal diklik, modal ditutup
    closeEditModalButton.addEventListener('click', () => {
        editModal.classList.add('hidden');
    });

    // Tangani form edit
    editBlogForm.addEventListener('submit', (event) => {
        event.preventDefault();
        alert('Blog berhasil diedit!');
        editModal.classList.add('hidden');
    });
</script>