<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- Tombol Tambah Blog -->
<button type="button" class="text-white whitespace-nowrap ml-[1080px] mt-20 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none" id="openModal">
    + Tambahkan Blogs
</button>

<!-- Modal Tambah Blog -->
<div id="tambahBlogs" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 md:w-[960px]">
        <h2 class="text-lg font-semibold mb-4">Tambah Blog</h2>
        <form id="addBlogForm">
            <!-- Gambar Input -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" id="image" name="image" multiple class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <!-- Preview Gambar -->
            <div id="imagePreview" class="mb-4 flex flex-wrap gap-2"></div>

            <!-- Judul -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" name="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan deskripsi blog" required></textarea>
            </div>

            <!-- Deskripsi 2 -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi 2</label>
                <textarea id="description" name="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan deskripsi blog" required></textarea>
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

<!-- Table -->
<table class="w-5xl text-sm text-left text-gray-500 ml-[230px] mt-2">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th class="px-4 py-1">No</th>
            <th class="px-4 py-1">Gambar</th>
            <th class="px-4 py-1">Judul</th>
            <th class="px-4 py-1">Tanggal</th>
            <th class="px-4 py-1">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr class="bg-white border-b border-gray-200">
            <td class="px-4 py-3 font-medium text-gray-900 whitespace-normal">1</td>
            <td class="px-4 py-2"><img src="./assets/images/kejuaraan.png" class="w-15 h-15" alt=""></td>
            <td class="px-4 py-2">Lorem ipsum dolor sit amet...</td>
            <td class="px-4 py-2">25/02/2025</td>
            <td class="px-4 py-2 flex items-center space-x-4">
                <button class="editButton text-green-500 hover:text-green-700 mt-4">
                    <i class="fas fa-edit text-2xl"></i>
                </button>
                <button class="deleteButton text-red-500 hover:text-red-700 mt-4">
                    <i class="fas fa-trash text-2xl"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>

<!-- Modal Edit Blog -->
<div id="editBlogModal" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 md:w-[960px]">
        <h2 class="text-lg font-semibold mb-4">Edit Blog</h2>
        <form id="editBlogForm">
            <div class="mb-4">
                <label for="editTitle" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" id="editTitle" name="editTitle" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required />
            </div>
            <div class="mb-4">
                <label for="editDescription" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="editDescription" name="editDescription" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>
            <div class="mb-4">
                <label for="editDescription" class="block text-sm font-medium text-gray-700">Deskripsi 2</label>
                <textarea id="editDescription" name="editDescription" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>
            <div class="mb-4">
                <label for="editDate" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="editDate" name="editDate" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required />
            </div>
            <div class="flex justify-between mt-4">
                <button type="button" id="closeEditModal" class="text-gray-500 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modal Tambah Blog
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');
    const tambahBlogs = document.getElementById('tambahBlogs');
    const addBlogForm = document.getElementById('addBlogForm');

    openModal.addEventListener('click', () => {
        tambahBlogs.classList.remove('hidden');
    });

    closeModal.addEventListener('click', () => {
        tambahBlogs.classList.add('hidden');
        addBlogForm.reset(); // Reset form saat modal ditutup
    });

    // Modal Edit Blog
    const editBlogModal = document.getElementById('editBlogModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const editBlogForm = document.getElementById('editBlogForm');

    document.querySelectorAll('.editButton').forEach(button => {
        button.addEventListener('click', () => {
            editBlogModal.classList.remove('hidden');
        });
    });

    closeEditModal.addEventListener('click', () => {
        editBlogModal.classList.add('hidden');
        editBlogForm.reset(); // Reset form saat modal edit ditutup
    });

    // Fungsi Hapus Blog
    document.querySelectorAll('.deleteButton').forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr'); // Cari elemen tr terdekat
            if (confirm("Apakah Anda yakin ingin menghapus blog ini?")) {
                row.remove(); // Hapus baris tabel jika user konfirmasi
            }
        });
    });
</script>