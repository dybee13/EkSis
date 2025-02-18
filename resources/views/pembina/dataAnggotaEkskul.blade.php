@extends('layouts.main')
@section('container')
    <div class="w-full min-h-screen flex justify-center items-start mt-32 ml-32 px-6">
        <div class="w-full max-w-screen-lg bg-white p-6 rounded-lg shadow">
            <!-- Dropdown Ekskul & Tombol Tambah -->
            <div class="mb-4 flex justify-between items-center">
                <div class="w-1/2">
                    <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                    <select id="jurusan"
                        class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="all">Semua</option>
                    </select>
                </div>
                <button id="btnTambah" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">+ Tambah
                    Anggota</button>
            </div>

            <!-- Tabel Data -->
            @if (session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto bg-white rounded-lg border border-gray-300 text-center">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">Nama Anggota</th>
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">NIS</th>
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">Jabatan</th>
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">Status</th>
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @forelse ($datas as $user)
                            <tr class="border-b" data-jurusan="{{ $user['anggota']->jurusan }}">
                                <td class="py-2 px-4 text-center">{{ $user['anggota']->name }}</td>
                                <td class="py-2 px-4 text-center">{{ $user['anggota']->nis }}</td>
                                <td class="py-2 px-4 text-center">
                                    @forelse ($user['ekskuls'] as $ekskul)
                                        {{ $ekskul->nama_ekskul }}
                                    @empty
                                        Tidak ada ekskul
                                    @endforelse
                                </td>
                                <td class="py-2 px-4 text-center text-green-600 font-semibold">Aktif</td>
                                <td>
                                    <button id="btnDetail" class="btn btn-warning btnDetail" data-id="{{ $user['anggota']->id }}"
                                        data-name="{{ $user['anggota']->name }}" data-email="{{ $user['anggota']->email }}"
                                        data-nohp="{{ $user['anggota']->no_hp }}" data-nis="{{ $user['anggota']->nis }}"
                                        data-kejuruan="{{ $user['anggota']->jurusan }}"
                                        data-ekskul="@foreach($user['ekskuls'] as $ekskul){{ $ekskul->nama_ekskul }}, @endforeach">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada anggota ekskul.</td>
                                </tr>
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-96">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">Detail Anggota</h2>
                <button id="closeDetailModal" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <div class="mb-4">
                <label class="font-semibold">NIS:</label>
                <p id="detailNis" class="text-gray-700"></p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Nama:</label>
                <p id="detailName" class="text-gray-700"></p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Nomor Handphone:</label>
                <p id="detailNoHp" class="text-gray-700"></p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Email:</label>
                <p id="detailEmail" class="text-gray-700"></p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Jurusan:</label>
                <p id="detailJurusan" class="text-gray-700"></p>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Ekskul:</label>
                <p id="detailEkskul" class="text-gray-700"></p>
            </div>

            <div class="flex justify-end">
                <!-- <button id="closeDetailModal" class="px-4 py-2 bg-gray-500 text-white rounded">Tutup</button> -->
                <button id="btnEdit" class="px-4 py-2 m-2 bg-blue-500 text-white rounded">Edit</button>
                <button id="btnHapus"
                    class="px-4 py-2 m-2 bg-red-500 text-white rounded-md hover:bg-red-600">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data Anggota anggota -->
    <div id="dataModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center dataModal">
        <form method="POST" id="dataForm">
            @csrf
            <div id="methodField"></div> <!-- Tempat untuk @method('PUT') -->
            <div class="bg-white p-6 ml-36 mt-16 rounded-lg shadow-lg w-[860px]">
                <h2 class="text-lg font-semibold mb-4 modalTitle" id="modalTitle">Tambah Anggota</h2>

                <input type="hidden" id="id" name="id">

                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="nama" name="name"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <div class="text-red-500 bg-red-100 border border-red-400 p-2 rounded-md mt-1">
                        {{ $message }}
                    </div>
                @enderror

                <label class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="text" id="nis" name="nis"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('nis')
                    <div class="text-red-500 bg-red-100 border border-red-400 p-2 rounded-md mt-1">
                        {{ $message }}
                    </div>
                @enderror

                <label class="block text-sm font-medium text-gray-700">No. Handphone</label>
                <input type="number" id="noHp" name="noHp"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('noHp')
                    <div class="text-red-500 bg-red-100 border border-red-400 p-2 rounded-md mt-1">
                        {{ $message }}
                    </div>
                @enderror

                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" id="email" name="email"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('email')
                    <div class="text-red-500 bg-red-100 border border-red-400 p-2 rounded-md mt-1">
                        {{ $message }}
                    </div>
                @enderror

                <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                <select id="jurusanSelect" name="jurusan"
                    class="form-select w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected>Pilih Jurusan</option>
                </select>

                <div class="flex justify-end space-x-2">
                    <button id="btnBatal"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Batal</button>
                    <button type="submit" id="btnSimpan"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //modal
            const detailModal = document.getElementById('detailModal');
            document.getElementById("closeDetailModal").addEventListener("click", function() {
                document.getElementById("detailModal").classList.add("hidden");
            });

            const dataModal = document.getElementById('dataModal');
            const dataForm = document.getElementById('dataForm');
            const modalTitle = document.getElementById('modalTitle');
            const btnTambah = document.getElementById('btnTambah');
            const btnDetail = document.querySelectorAll('.btnDetail');
            const btnEdit = document.getElementById('btnEdit');
            const btnBatal = document.getElementById('btnBatal');
            const btnSimpan = document.getElementById('btnSimpan');
            const btnHapus = document.getElementById('btnHapus');
            const methodField = document.getElementById('methodField');

            // Detail
            const detailId = document.getElementById('detailId');
            const detailNis = document.getElementById('detailNis');
            const detailName = document.getElementById('detailName');
            const detailNoHp = document.getElementById('detailNoHp');
            const detailEmail = document.getElementById('detailEmail');
            const detailJurusan = document.getElementById('detailJurusan');
            const detailEkskul = document.getElementById('detailEkskul');

            let currentId = null;
            let currentName = null;
            let currentNis = null;
            let currentEmail = null;
            let currentNoHp = null;
            let currentJurusan = null;
            let currentEkskul = null;

            //input form
            const id = document.getElementById('id')
            const nama = document.getElementById('nama');
            const nis = document.getElementById('nis');
            const email = document.getElementById('email');
            const jurusan = document.getElementById('jurusanSelect');
            const noHp = document.getElementById('noHp');

            // Open Modal Detail
            btnDetail.forEach(button => {
                button.addEventListener('click', () => {
                    currentId = button.dataset.id;
                    currentName = button.dataset.name;
                    currentNis = button.dataset.nis;
                    currentEmail = button.dataset.email;
                    currentNoHp = button.dataset.nohp;
                    currentJurusan = button.dataset.kejuruan;
                    currentEkskul = button.dataset.ekskul;

                    console.log("Data ID yang dimasukkan ke tombol Edit:", btnEdit.dataset.id);

                    detailNis.innerText = currentNis;
                    detailName.innerText = currentName;
                    detailEmail.innerText = currentEmail;
                    detailNoHp.innerText = currentNoHp;
                    detailJurusan.innerText = currentJurusan;
                    detailEkskul.innerText = currentEkskul;
                    detailModal.classList.remove('hidden');
                });
            });

            // Open modal for adding data
            btnTambah.addEventListener('click', () => {
                modalTitle.innerText = "Tambah Data";
                dataForm.action = "/saveAnggota";
                dataForm.method = "POST";
                nama.value = "";
                nis.value = "";
                jurusan.value = "";
                email.value = "";
                noHp.value = "";
                id.value = "";
                methodField.innerHTML = "";
                dataModal.classList.remove('hidden');
                // Panggil fungsi untuk mengisi dropdown jurusan
                loadJurusan();
            });

            // Fungsi untuk fetch jurusan dari backend dan memasukkan ke dalam select option
            function loadJurusan() {
                fetch('/api/jurusan')
                    .then(response => response.json())
                    .then(data => {
                        let selectJurusan = document.getElementById("jurusanSelect");

                        // Hapus option sebelumnya agar tidak menumpuk
                        selectJurusan.innerHTML = '<option value="">-- Pilih Jurusan --</option>';

                        for (const [key, value] of Object.entries(data)) {
                            let option = document.createElement("option");
                            option.value = key;
                            option.textContent = value;
                            selectJurusan.appendChild(option);
                        }
                    })
                    .catch(error => console.error("Error fetching jurusan:", error));
            }

            btnEdit.addEventListener('click', function () {
                if (currentId) {
                    modalTitle.innerText = "Edit Data";
                    dataForm.action = `/updateAnggota/${currentId}`;
                    dataForm.method = "POST"; // Laravel mendukung metode PUT/PATCH dalam form melalui input hidden
                    // Tambahkan field hidden untuk metode PUT agar Laravel mengenalinya
                    methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                    nama.value = currentName;
                    nis.value = currentNis;
                    email.value = currentEmail;
                    noHp.value = currentNoHp;

                    // Tampilkan modal
                    dataModal.classList.remove('hidden');
                    detailModal.classList.add('hidden'); // Tutup Modal Detail

                    // Panggil fungsi untuk mengisi dropdown jurusan
                    // Fungsi load jurusan dengan opsi terpilih
                    loadJurusan(jurusan);
                }
            });

            // Delete Data with Confirmation
            btnHapus.addEventListener('click', () => {
                if (currentId) {
                    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                        fetch(`/hapusAnggota/${currentId}`, {
                                method: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                        .content
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                alert(data.message);
                                detailModal.classList.add('hidden');
                                location.reload(); // Reload halaman setelah penghapusan
                            })
                            .catch(error => console.error("Error:", error));
                    }
                }
            });


        });

        document.addEventListener("DOMContentLoaded", function () {
            fetch('/api/jurusan')
                    .then(response => response.json())
                    .then(data => {
                        let selectJurusan = document.getElementById("jurusan");

                        // Hapus option sebelumnya agar tidak menumpuk
                        selectJurusan.innerHTML = '<option value="">-- Semua Jurusan --</option>';

                        for (const [key, value] of Object.entries(data)) {
                            let option = document.createElement("option");
                            option.value = key;
                            option.textContent = value;
                            selectJurusan.appendChild(option);
                        }
                    })
                    .catch(error => console.error("Error fetching jurusan:", error));
        });

        btnBatal.addEventListener('click', () => {
            dataModal.classList.add('hidden');
        });

        closeDetailModal.addEventListener('click', () => {
            detailModal.classList.add('hidden');
        });

        document.getElementById('jurusan').addEventListener('change', function() {
            let selectedJurusan = this.value;
            let rows = document.querySelectorAll('#table-body tr');

            rows.forEach(row => {
            if (selectedJurusan === "" || row.getAttribute("data-jurusan") === selectedJurusan) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
    </script>
@endsection
