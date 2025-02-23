@extends('layouts.main')
@section('container')

<div class="w-screen min-w-screen flex justify-center items-start mt-28 ml-32">
    <div class="w-screen max-w-screen-lg bg-white p-6 rounded-lg shadow">
        <!-- Dropdown Ekskul & Tombol Tambah -->
        <div class="mb-4 flex justify-between items-center">
            <div class="w-1/2">
                <label for="eskul" class="block text-sm font-medium text-gray-700">Pilih Kategori Ekskul</label>
                <select id="eskul" class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="all">Semua</option>
                    <option value="Olahraga">Olahraga</option>
                    <option value="Akademik">Seni</option>
                    <option value="Akademik">Akademik</option>
                </select>
            </div>
            <button id="btnTambahEkskul" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">+ Tambah Ekskul</button>
        </div>

        <!-- Tabel Data -->
        <div class="w-full overflow-x-auto">
            <table class="w-full table-auto bg-white rounded-lg border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-2 px-4 w-1/3 text-center text-gray-700">Ekskul</th>
                        <th class="py-2 px-4 w-1/3 text-center text-gray-700">Pembina</th>
                        <th class="py-2 px-4 w-1/3 text-center text-gray-700">Pengurus</th>
                        <th class="py-2 px-4 w-1/3 text-center text-gray-700">Status</th>
                        <th class="py-2 px-4 w-1/3 text-center text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($datas as $ekskul)
                    <tr class="border-b" data-eskul="kategori">
                        <td class="py-2 px-4 text-center">{{ $ekskul->nama_ekskul }}</td>
                        <td class="py-2 px-4 text-center">
                            @forelse ($ekskul->users->where('role', 'pembina') as $pembina)
                                <span class="badge bg-primary">{{ $pembina->name }}</span>
                            @empty
                                <span class="text-muted">Belum ada Pembina</span>
                            @endforelse
                        </td>
                        <td class="py-2 px-4 text-center">
                            @forelse ($ekskul->users->where('role', 'pengurus') as $pembina)
                                <span class="badge bg-primary">{{ $pembina->name }}</span>
                            @empty
                                <span class="text-muted">Belum ada Pembina</span>
                            @endforelse
                        </td>
                        <td class="py-2 px-4 text-center text-green-600 font-semibold">Aktif</td>
                        <td>
                            <button id="btnDetailEkskul" class="btn btn-warning btnDetailEkskul"
                                data-id="{{ $ekskul->id }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-[860px] ml-32 relative">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Detail Pembina</h2>
            <button id="closeDetailModal" class="text-gray-500 hover:text-gray-700">
                ✖
            </button>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Ekskul:</label>
            <p id="detailNamaEkskul" class="text-gray-700"></p>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Pembina:</label>
            <p id="detailNamaPembina" class="text-gray-700"></p>
        </div>

        <div class="mb-4">
            <label class="font-semibold">Pengurus:</label>
            <p id="detailNamaPengurus" class="text-gray-700"></p>
        </div>

        <div class="flex justify-end">
            <button id="btnEdit" class="px-4 py-2 m-2 bg-blue-500 text-white rounded">Edit</button>
            <button id="btnHapus" class="px-4 py-2 m-2 bg-red-500 text-white rounded-md hover:bg-red-600">Hapus</button>
        </div>
    </div>
</div>

<!-- Modal Data Sudah Diperbaiki -->
<div id="modalData" class="fixed inset-0 w-full bg-black bg-opacity-50 hidden flex justify-center items-center">
    <form method="POST" id="dataForm">
        @csrf
        <input type="hidden" id="ekskulId"> <!-- Hidden input untuk ID ekskul (digunakan saat edit) -->

        <div class="bg-white p-6 rounded-lg shadow-lg w-[860px] ml-32">
            <h2 id="modalTitle" class="text-lg font-semibold mb-4">Tambah Ekskul</h2>

            <label class="block text-sm font-medium text-gray-700">Nama Ekskul</label>
            <input type="text" id="namaEkskulInput" name="nama_ekskul" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

            <label class="block text-sm font-medium text-gray-700">Guru Pembina</label>
            <select id="users" name="users[]" class="form-select w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option selected>Pilih Guru Pembina</option>
                @foreach ($pembinas as $pembina)
                <option value="{{ $pembina->id }}">{{ $pembina->name }}</option>
                @endforeach
            </select>

            <label class="block text-sm font-medium text-gray-700">Siswa Pengurus</label>
            <select id="pengurus" name="id_pengurus[]" class="form-select w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option selected>Pilih Siswa Pengurus</option>
                @foreach ($pengurus as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>

            <!-- 
        <label class="block text-sm font-medium text-gray-700">Kategori</label>
        <select id="kategories" name="kategories[]" multiple class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
                <option value="olahraga">Olahraga</option>
                <option value="seni">Seni & Kreativitas</option>
                <option value="bahasaSastra">Bahasa & Sastra</option>
                <option value="kepemimpinan">Kepemimpinan & Organisasi</option>
                <option value="religi">Religi & Sosial</option>
                <option value="alam">Alam & Lingkungan</option>
        </select> -->

            <div class="flex justify-end space-x-2">
                <a type="button" id="btnBatal" class="px-4 py-2 mt-2 bg-red-600 text-white rounded-md hover:bg-red-700">Batal</a>
                <button type="submit" id="btnSimpan" class="px-4 py-2 mt-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
            </div>
        </div>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detailModal = document.getElementById('detailModal');
        const btnDetailEkskul = document.getElementById('btnDetailEkskul');
        document.getElementById("closeDetailModal").addEventListener("click", function() {
            document.getElementById("detailModal").classList.add("hidden");
        });
        const detailNamaEkskul = document.getElementById('detailNamaEkskul');
        const detailNamaPembina = document.getElementById('detailNamaPembina');
        const modalData = document.getElementById('modalData');
        const btnTambahEkskul = document.getElementById('btnTambahEkskul');
        const btnBatal = document.getElementById('btnBatal');
        const btnEdit = document.getElementById('btnEdit');
        const btnHapus = document.getElementById('btnHapus');
        const btnSimpan = document.getElementById('btnSimpan');
        const modalTitle = document.getElementById('modalTitle');
        const ekskulIdInput = document.getElementById('ekskulId');
        const namaEkskulInput = document.getElementById('namaEkskulInput');
        const usersSelect = document.getElementById('users');
        const dataForm = document.getElementById('dataForm');

        let currentEkskulId = null; // Simpan ID ekskul yang sedang dibuka
        let isEditMode = false; // Untuk cek apakah modal dalam mode edit

        // Event listener untuk membuka modal detail
        document.querySelectorAll('.btnDetailEkskul').forEach(button => {
            button.addEventListener('click', () => {
                const ekskulId = button.dataset.id;

                fetch(`/ekskul/${ekskulId}/dataEdit`)
                    .then(response => response.json())
                    .then(data => {
                        console.log("Data diterima:", data); // Debugging
                        
                        if (data && data.ekskul) {
                            currentEkskulId = data.ekskul.id;
                            detailNamaEkskul.textContent = data.ekskul.nama_ekskul;

                            // Kosongkan daftar pembina & pengurus sebelumnya
                            detailNamaPembina.innerHTML = '';
                            detailNamaPengurus.innerHTML = '';

                            // Tambahkan daftar pembina
                            if (Array.isArray(data.pembina)) {
                                data.pembina.forEach(user => {
                                    const li = document.createElement('li');
                                    li.textContent = user.name;
                                    detailNamaPembina.appendChild(li);
                                });
                            } else {
                                console.log("Data pembina tidak ditemukan atau bukan array");
                            }

                            // Tambahkan daftar pengurus
                            if (Array.isArray(data.pengurus)) {
                                data.pengurus.forEach(user => {
                                    const li = document.createElement('li');
                                    li.textContent = user.name;
                                    detailNamaPengurus.appendChild(li);
                                });
                            } else {
                                console.log("Data pengurus tidak ditemukan atau bukan array");
                            }

                            detailModal.classList.remove('hidden');
                        } else {
                            console.error("Data ekskul tidak ditemukan");
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        closeDetailModal.addEventListener('click', () => {
            detailModal.classList.add('hidden');
        });

        // Event: Buka modal untuk tambah ekskul
        btnTambahEkskul.addEventListener('click', () => {
            isEditMode = false;
            modalTitle.textContent = "Tambah Ekskul";
            ekskulIdInput.value = "";
            namaEkskulInput.value = "";

            const usersSelect = document.getElementById("users");
            if (usersSelect) {
                Array.from(usersSelect.options).forEach(option => option.selected = false);
            }

            modalData.classList.remove('hidden');
        });

        // Event listener untuk membuka modal edit dari modal detail
        btnEdit.addEventListener('click', () => {
            detailModal.classList.add('hidden');
            openEditModal(currentEkskulId);
            isEditMode = true;
        });

        // Fungsi untuk membuka modal edit
        function openEditModal(id) {
            fetch(`/ekskul/${id}/dataEdit`)
                .then(response => response.json())
                .then(data => {
                    isEditMode = true;
                    modalTitle.textContent = "Edit Ekskul";
                    ekskulIdInput.value = data.ekskul.id;
                    namaEkskulInput.value = data.ekskul.nama_ekskul;

                    // Reset opsi pembina dan pilih yang sesuai
                    usersSelect.innerHTML = '';
                    fetch('/get-users')
                        .then(response => response.json())
                        .then(users => {
                            users.forEach(user => {
                                const option = document.createElement('option');
                                option.value = user.id;
                                option.textContent = user.name;

                                // Tandai pembina yang sudah terdaftar di ekskul
                                if (data.ekskul.users.some(u => u.id == user.id)) {
                                    option.selected = true;
                                }

                                usersSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error mengambil daftar guru:', error));

                    modalData.classList.remove('hidden');
                })
                .catch(error => console.error('Error mengambil data ekskul:', error));
        }

        // Event: Simpan data (Tambah atau Edit)
        dataForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const id = ekskulIdInput.value;
            const formData = new FormData();

            // Ambil nilai input nama ekskul
            const namaEkskul = namaEkskulInput.value.trim();
            if (namaEkskul === "") {
                alert("Nama Ekskul tidak boleh kosong!");
                return;
            }
            formData.append('nama_ekskul', namaEkskul); // Ubah ke 'nama_ekskul' agar sesuai dengan backend

            // Ambil user yang dipilih
            const selectedUsers = Array.from(usersSelect.selectedOptions).map(option => option.value);
            if (selectedUsers.length === 0) {
                alert("Minimal pilih 1 pembina!");
                return;
            }
            selectedUsers.forEach(user => formData.append('users[]', user));

            let url = "/saveEkskul";
            let method = "POST"; // Default untuk tambah ekskul

            if (isEditMode) {
                url = `/updateEkskul/${id}`;
                formData.append('_method', 'PUT'); // Laravel hanya menerima PUT jika ada _method
            }

            fetch(url, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    modalData.classList.add('hidden');
                    location.reload(); // Refresh halaman setelah update
                })
                .catch(error => console.error('Error:', error));
        });

        //hapus data
        document.getElementById('btnHapus').addEventListener('click', function() {
            if (confirm("Apakah Anda yakin ingin menghapus ekskul ini?")) {
                fetch(`/hapusEkskul/${currentEkskulId}`, {
                        method: "POST", // Laravel hanya menerima DELETE jika ada _method
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            _method: "DELETE"
                        }) // Laravel butuh _method untuk DELETE
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        detailModal.classList.add('hidden'); // Tutup modal setelah hapus
                        location.reload(); // Refresh halaman untuk memperbarui data
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        btnBatal.addEventListener('click', () => {
            modalData.classList.add('hidden');
            isEditMode = false;
        });

        document.getElementById('eskul').addEventListener('change', function() {
            let selectedEskul = this.value;
            let rows = document.querySelectorAll('#table-body tr');

            rows.forEach(row => {
                let eskul = row.getAttribute('data-eskul');
                row.style.display = (selectedEskul === 'all' || eskul === selectedEskul) ? '' : 'none';
            });
        });
    });
</script>


@endsection