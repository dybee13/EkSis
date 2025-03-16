@extends('layouts.main')
@section('container')

<!-- Table -->
<table class="w-5xl text-sm text-left text-gray-500 ml-[320px] mt-32">
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
                <form action="{{ route('blog.ban', $blog->id) }}" method="POST" onsubmit="return confirm('Yakin ingin ban blog ini?');">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="deleteButton text-red-500 hover:text-red-700 mt-4">
                        <i class="fa-regular fa-circle-xmark text-2xl"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

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