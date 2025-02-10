@extends('layouts.main')
@section('container')
    <div class="w-full min-h-screen flex justify-center items-start mt-32 ml-32 px-6">
        <div class="w-full max-w-screen-lg bg-white p-6 rounded-lg shadow">
            <!-- Dropdown Ekskul & Tombol Tambah -->
            <div class="mb-4 flex justify-between items-center">
                <div class="w-1/2">
                    <label for="eskul" class="block text-sm font-medium text-gray-700">Pilih Pembina Ekskul</label>
                    <select id="eskul"
                        class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="all">Semua</option>
                        <option value="Basket">Basket</option>
                        <option value="Futsal">Futsal</option>
                        <option value="Rohis">Rohis</option>
                    </select>
                </div>
                <button id="btnTambah" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">+ Tambah
                    Guru</button>
            </div>

            <!-- Tabel Data -->
            @if (session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto bg-white rounded-lg border border-gray-300 text-center">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">Nama Pembina</th>
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">NIP</th>
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">Ekskul</th>
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">Status</th>
                            <th class="py-2 px-4 w-1/4 text-center text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($datas as $pembina)
                            <tr class="border-b">
                                <td class="py-2 px-4 text-center">{{ $pembina->name }}</td>
                                <td class="py-2 px-4 text-center">{{ $pembina->nip }}</td>
                                <td>
                                    @foreach ($pembina->ekskuls as $ekskulUser)
                                        {{ $ekskulUser->ekskul->nama_ekskul }}<br>
                                    @endforeach
                                </td>
                                <td class="py-2 px-4 text-center text-green-600 font-semibold">Aktif</td>
                                <td>
                                    <button id="btnDetail" class="btn btn-warning btnDetail" data-id="{{ $pembina->id }}"
                                        data-name="{{ $pembina->name }}" data-email="{{ $pembina->email }}"
                                        data-nohp="{{ $pembina->no_hp }}" data-nip="{{ $pembina->nip }}"
                                        data-ekskul="{{ implode(', ', $pembina->ekskuls->map(fn($e) => $e->ekskul->nama_ekskul)->toArray()) }}">
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
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-lg font-bold mb-4">Detail Pembina</h2>

            <div class="mb-4">
                <label class="font-semibold">NIP:</label>
                <p id="detailNip" class="text-gray-700"></p>
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
                <label class="font-semibold">Ekskul:</label>
                <p id="detailEkskul" class="text-gray-700"></p>
            </div>

            <div class="flex justify-between">
                <button id="closeDetailModal" class="px-4 py-2 bg-gray-500 text-white rounded">Tutup</button>
                <button id="btnEdit" class="px-4 py-2 bg-blue-500 text-white rounded">Edit</button>
                <button id="btnHapus" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data Guru Pembina -->
    <div id="dataModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center dataModal">
        <form method="POST" id="dataForm">
            @csrf
            <div id="methodField"></div> <!-- Tempat untuk @method('PUT') -->
            <div class="bg-white p-6 ml-36 mt-16 rounded-lg shadow-lg w-[860px]">
                <h2 class="text-lg font-semibold mb-4 modalTitle" id="modalTitle">Tambah Guru Pembina</h2>

                <input type="hidden" id="idGuru" name="id">

                <label class="block text-sm font-medium text-gray-700">Nama Guru</label>
                <input type="text" id="namaGuru" name="name"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

                <label class="block text-sm font-medium text-gray-700">NIP</label>
                <input type="text" id="nipGuru" name="nip"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

                <label class="block text-sm font-medium text-gray-700">No. Handphone</label>
                <input type="text" id="noHp" name="noHp"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" id="email" name="email"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

                <div class="flex justify-end space-x-2">
                    <button onclick="window.location.href=`{{ url('/masterDataPembina') }}`" id="btnBatal"
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
            const closeDetailModal = document.getElementById('closeDetailModal');
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
            const detailNip = document.getElementById('detailNip');
            const detailName = document.getElementById('detailName');
            const detailNoHp = document.getElementById('detailNoHp');
            const detailEmail = document.getElementById('detailEmail');
            const detailEkskul = document.getElementById('detailEkskul');

            let currentId = null;
            let currentName = null;
            let currentNip = null;
            let currentEmail = null;
            let currentNoHp = null;
            let currentEkskul = null;

            //input form
            const idGuru = document.getElementById('idGuru')
            const namaGuru = document.getElementById('namaGuru');
            const nipGuru = document.getElementById('nipGuru');
            const email = document.getElementById('email');
            const noHp = document.getElementById('noHp');
            const pw = document.getElementById('password');
            const konfpw = document.getElementById('password_confirmation');

            // Open Modal Detail
            btnDetail.forEach(button => {
                button.addEventListener('click', () => {
                    currentId = button.dataset.id;
                    currentName = button.dataset.name;
                    currentNip = button.dataset.nip;
                    currentEmail = button.dataset.email;
                    currentNoHp = button.dataset.nohp;
                    currentEkskul = button.dataset.ekskul;

                    detailNip.innerText = currentNip;
                    detailName.innerText = currentName;
                    detailEmail.innerText = currentEmail;
                    detailNoHp.innerText = currentNoHp;
                    detailEkskul.innerText = currentEkskul;
                    detailModal.classList.remove('hidden');
                });
            });

            // Open modal for adding data
            btnTambah.addEventListener('click', () => {
                modalTitle.innerText = "Tambah Data";
                dataForm.action = "/savePembina";
                dataForm.method = "POST";
                namaGuru.value = "";
                nipGuru.value = "";
                email.value = "";
                noHp.value = "";
                idGuru.value = "";
                pw.value = "";
                konfpw.value = "";
                methodField.innerHTML = "";
                dataModal.classList.remove('hidden');
            });

            // Open Modal Edit from Detail Modal
            btnEdit.addEventListener('click', () => {
                if (currentId) {
                    dataForm.action = `/editPembina/${currentId}`;
                    dataForm.method = "POST";
                    namaGuru.value = currentName;
                    nipGuru.value = currentNip;
                    email.value = currentEmail;
                    noHp.value = currentNoHp;
                    idGuru.value = currentId;
                    methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';

                    detailModal.classList.add('hidden'); // Tutup Modal Detail
                    dataModal.classList.remove('hidden'); // Buka Modal Edit
                }
            });

            // Delete Data with Confirmation
            btnHapus.addEventListener('click', () => {
                if (currentId) {
                    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                        fetch(`/hapusPembina/${currentId}`, {
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


        btnBatal.addEventListener('click', () => {
            dataModal.classList.add('hidden');
        });

        closeDetailModal.addEventListener('click', () => {
            detailModal.classList.add('hidden');
        });

        btnSimpan.addEventListener('click', () => {
            let namaGuru = document.getElementById('namaGuru').value;
            let nipGuru = document.getElementById('nipGuru').value;

            if (namaGuru.trim() === '' || nipGuru.trim() === '') {
                alert('Harap isi semua kolom!');
                return;
            }

            alert(`Guru "${namaGuru}" dengan NIP "${nipGuru}" telah ditambahkan!`);
            modalTambahGuru.classList.add('hidden');
        });


        document.getElementById('eskul').addEventListener('change', function() {
            let selectedEskul = this.value;
            let rows = document.querySelectorAll('#table-body tr');

            rows.forEach(row => {
                let eskul = row.getAttribute('data-eskul');
                row.style.display = (selectedEskul === 'all' || eskul === selectedEskul) ? '' : 'none';
            });
        });
    </script>
@endsection
