@extends('layouts.main')
@section('container')
<!-- Tombol Tambah Blog -->
<button type="button" class="text-white whitespace-nowrap ml-[1080px] mt-20 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none" id="openModal">
    + Tambahkan Blogs
</button>

<!-- Modal Tambah Blog -->
<div id="tambahBlogs" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 md:w-[960px]">
        <h2 class="text-lg font-semibold mb-4">Tambah Blog</h2>
        <form id="addBlogForm" method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Gambar Input -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" id="images" name="images[]" accept="image/*" multiple class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <!-- Preview Gambar -->
            <div id="imagePreview" class="mb-4 flex flex-wrap gap-2"></div>

            <!-- Judul -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" id="title" name="judul" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required />
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" name="body" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan deskripsi blog" required></textarea>
            </div>

            <!-- Keterangan -->
            <label class="block text-sm font-medium text-gray-700">Keterangan</label>
            <select id="keterangan" name="keterangan" class="form-select w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option selected>Pilih Keterangan</option>
                <option value="activities">Akivitas</option>
                <option value="achievments">Penghargaan</option>
                <option value="announcements">Pemberitahuan</option>
            </select>

            <!-- Buttons -->
            <div class="flex justify-between mt-4">
                <button type="button" id="closeModal" class="text-gray-500 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<table class="w-5xl text-sm text-left text-gray-500 ml-[320px] mt-2">
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
        @foreach ($blogs as $index => $blog)
        <tr class="bg-white border-b border-gray-200">
        <td class="px-4 py-3 font-medium text-gray-900 whitespace-normal">{{ $index + 1 }}</td>
            @if ($blog->blogImages->isNotEmpty())
                @php
                    $thumbnail = $blog->blogImages()->where('is_thumbnail', true)->first() ?? $blog->blogImages->first();
                @endphp
                @if ($thumbnail)
                <td class="px-4 py-2">
                    <img src="{{ asset('storage/blogs/' . $thumbnail->image_path) }}" class="w-15 h-15" alt="">
                </td>
                @endif
            @else
                <td class="px-4 py-2 text-gray-500 italic">Tidak ada gambar</td>
            @endif
            <td class="px-4 py-2">{{ $blog->title }}</td>
            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($blog->created_at)->format('d-m-Y') }}</td>
            <td class="px-4 py-2 flex items-center space-x-4">
                <button class="editButton text-green-500 hover:text-green-700 mt-4">
                    <i class="fas fa-edit text-2xl"></i>
                </button>
                <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus blog ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="deleteButton text-red-500 hover:text-red-700 mt-4">
                        <i class="fas fa-trash text-2xl"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Edit Blog
<div id="editBlogModal" class="fixed inset-0 z-50 hidden bg-gray-500 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 md:w-[960px]">
        <h2 class="text-lg font-semibold mb-4">Edit Blog</h2>
        <form id="editBlogForm">
            <div class="mb-4">
                <label for="editTitle" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" id="editTitle" name="judul" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required />
            </div>
            <div class="mb-4">
                <label for="editDescription" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="editDescription" name="body" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>
            <label class="block text-sm font-medium text-gray-700">Keterangan</label>
            <select id="keterangan" name="keterangan" class="form-select w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option selected>Pilih Keterangan</option>
                <option value="activities">Akivitas</option>
                <option value="achievments">Penghargaan</option>
                <option value="announcements">Pemberitahuan</option>
            </select>
            <div class="flex justify-between mt-4">
                <button type="button" id="closeEditModal" class="text-gray-500 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md">Batal</button>
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div> -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
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

        // // Modal Edit Blog
        // const editBlogModal = document.getElementById('editBlogModal');
        // const closeEditModal = document.getElementById('closeEditModal');
        // const editBlogForm = document.getElementById('editBlogForm');

        // document.querySelectorAll('.editButton').forEach(button => {
        //     button.addEventListener('click', () => {
        //         editBlogModal.classList.remove('hidden');
        //     });
        // });

        // closeEditModal.addEventListener('click', () => {
        //     editBlogModal.classList.add('hidden');
        //     editBlogForm.reset(); // Reset form saat modal edit ditutup
        // });
});
</script>
@endsection