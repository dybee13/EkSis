<div id="filterBerita" class="grid grid-cols-6 gap-2 p-4">
    <div class="col-span-full flex justify-between items-center mt-16">
        <p class="text-2xl font-semibold mb-2">Filter Berita berdasarkan Kategori :</p>
        <div class="relative mb-2">
            <input id="search-input" type="text" placeholder="Cari blog atau ekskul..." class="form-control border border-gray-300 rounded-lg px-4 py-2 text-sm w-96 pl-10 focus:outline-none focus:ring-2 focus:ring-green-500">
            <div id="search-results"></div>
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.4-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Semua</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Achievments</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Activities</span>
    <span class="filter-item bg-gray-200 text-green-700 px-5 py-3 rounded-full text-sm cursor-pointer text-center">Announcements</span>
</div>

<div id="berita-section" class="col-span-full grid grid-cols-4 gap-4 mt-8 p-6">
    @foreach ($blogs as $blog)
    <a href="/detailBlog/{{ $blog->id }}" class="bg-white shadow-lg rounded-xl overflow-hidden w-80 block blog-filter">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden berita-card" data-keterangan="{{ $blog->keterangan }}">
            @if ($blog->blogImages->isNotEmpty())
                @php
                    $thumbnail = $blog->blogImages()->where('is_thumbnail', true)->first() ?? $blog->blogImages->first();
                @endphp
                @if ($thumbnail)
                <td class="px-4 py-2">
                    <img src="{{ asset('storage/blogs/' . $thumbnail->image_path) }}" class="w-full h-48 object-cover" alt="">
                </td>
                @endif
            @else
                <td class="px-4 py-2 text-gray-500 italic">Tidak ada gambar</td>
            @endif
        <div class="mt-2 ml-2">
            <div class="flex gap-3">
                <span class="berita-category bg-blue-600 text-white px-3 py-1 rounded-full text-sm">{{ $blog->ekskul->nama_ekskul }}</span>
                <span class="berita-category bg-green-600 text-white px-3 py-1 rounded-full text-sm">{{ $blog->keterangan }}</span>
            </div>
            <h3 class="berita-title text-lg font-semibold mt-2">{{ $blog->title }}</h3>
            <p class="text-gray-600 text-sm mt-1">{{ Str::limit($blog->body, 60) }}</p>
        </div>
    </div>
    </a>
    @endforeach
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('search-input').addEventListener('keyup', function() {
        let query = this.value.trim();
        let beritaSection = document.getElementById('berita-section');

        // Jika input kosong, ambil ulang semua berita
        if (query === "") {
            fetchAllBlogs();
            return;
        }

        fetch(`/search-blogs?query=${query}`)
            .then(response => response.json())
            .then(blogs => {
                beritaSection.innerHTML = ""; // Kosongkan section sebelum menampilkan hasil baru

                if (blogs.length === 0) {
                    beritaSection.innerHTML = "<p class='text-red-500 col-span-full text-center'>Tidak ada hasil ditemukan</p>";
                } else {
                    blogs.forEach(blog => {
                        let truncatedBody = blog.body.length > 100 ? blog.body.substring(0, 100) + "..." : blog.body;
                        let blogHtml = `
                            <div class="bg-white shadow-lg rounded-lg overflow-hidden berita-card">
                                ${blog.blog_images.length > 0 ? 
                                    `<img src="/storage/blogs/${blog.blog_images[0].image_path}" alt="Berita ${blog.title}" class="w-full h-48 object-cover">`
                                    : ''
                                }
                                <div class="mt-2 ml-2">
                                    <div class="flex gap-3">
                                    <span class="berita-category bg-blue-600 text-white px-3 py-1 rounded-full text-sm">${blog.ekskul.nama_ekskul}</span>
                                    <span class="berita-category bg-green-600 text-white px-3 py-1 rounded-full text-sm">${blog.keterangan}</span>
                                </div>
                                    <h3 class="berita-title text-lg font-semibold mt-2">${blog.title}</h3>
                                    <p class="text-gray-600 text-sm mt-1">${truncatedBody}</p>
                                </div>
                            </div>
                        `;
                        beritaSection.innerHTML += blogHtml;
                    });
                }
            });
    });

    // Fungsi untuk menampilkan semua berita saat input kosong
    function fetchAllBlogs() {
        fetch(`/search-blogs?query=`)
            .then(response => response.json())
            .then(blogs => {
                let beritaSection = document.getElementById('berita-section');
                beritaSection.innerHTML = ""; // Kosongkan section sebelum mengisi ulang

                blogs.forEach(blog => {
                    let truncatedBody = blog.body.length > 100 ? blog.body.substring(0, 100) + "..." : blog.body;
                    let blogHtml = `
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden berita-card">
                            ${blog.blog_images.length > 0 ? 
                                `<img src="/storage/blogs/${blog.blog_images[0].image_path}" alt="Berita ${blog.title}" class="w-full h-48 object-cover">`
                                : ''
                            }
                            <div class="mt-2 ml-2">
                                <div class="flex gap-3">
                                    <span class="berita-category bg-blue-600 text-white px-3 py-1 rounded-full text-sm">${blog.ekskul.nama_ekskul}</span>
                                    <span class="berita-category bg-green-600 text-white px-3 py-1 rounded-full text-sm">${blog.keterangan}</span>
                                </div>
                                <h3 class="berita-title text-lg font-semibold mt-2">${blog.title}</h3>
                                <p class="text-gray-600 text-sm mt-1">${truncatedBody}</p>
                            </div>
                        </div>
                    `;
                    beritaSection.innerHTML += blogHtml;
                });
            });
        }

        document.querySelectorAll('.filter-item').forEach(item => {
    item.addEventListener('click', function() {
        let selectedKeterangan = this.textContent.trim().toLowerCase();
        let rows = document.querySelectorAll('.blog-filter');
        let adaBerita = false; // Menyimpan status apakah ada berita yang ditampilkan

        // Hapus class "is-active" dari semua filter-item
        document.querySelectorAll('.filter-item').forEach(btn => {
            btn.classList.remove('bg-green-700', 'text-white');
            btn.classList.add('bg-gray-200', 'text-green-700');
        });

        // Tambahkan class "is-active" pada tombol yang diklik
        this.classList.remove('bg-gray-200', 'text-green-700');
        this.classList.add('bg-green-700', 'text-white');

        rows.forEach(row => {
            let blogKeterangan = row.querySelector('.berita-card').getAttribute("data-keterangan").toLowerCase();

            if (selectedKeterangan === "semua" || blogKeterangan === selectedKeterangan) {
                row.style.display = "block";
                adaBerita = true;
            } else {
                row.style.display = "none";
            }
        });

        // Cek apakah ada berita yang tampil, jika tidak tampilkan pesan
        let noNewsMessage = document.getElementById('no-news-message');
        if (!adaBerita) {
            if (!noNewsMessage) {
                noNewsMessage = document.createElement('p');
                noNewsMessage.id = 'no-news-message';
                noNewsMessage.textContent = "Tidak ada berita";
                noNewsMessage.classList.add("text-gray-600", "text-center", "mt-4", "font-semibold");
                document.getElementById('berita-section').appendChild(noNewsMessage);
            }
        } else {
            if (noNewsMessage) {
                noNewsMessage.remove();
            }
        }
    });
});



    });
</script>