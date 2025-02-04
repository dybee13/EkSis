@extends('layouts.sidebar')
@section('container')

<div class="w-screen min-w-screen flex justify-center items-start mt-10 ml-32 px-6">
    <div class="w-screen max-w-screen-lg bg-white p-6 rounded-lg shadow">
        <!-- Dropdown Ekskul & Tombol Tambah -->
        <div class="mb-4 flex justify-between items-center">
            <div class="w-1/2">
                <label for="eskul" class="block text-sm font-medium text-gray-700">Pilih Ekskul</label>
                <select id="eskul" class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="all">Semua</option>
                    <option value="Basket">Basket</option>
                    <option value="Futsal">Futsal</option>
                    <option value="Nemo">Nemo</option>
                </select>
            </div>
            <button id="btnTambahEskul" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">+ Tambah Ekskul</button>
        </div>

        <!-- Tabel Data -->
        <div class="w-full overflow-x-auto">
            <table class="w-full table-auto bg-white rounded-lg border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-2 px-4 w-1/3 text-center text-gray-700">Ekskul</th>
                        <th class="py-2 px-4 w-1/3 text-center text-gray-700">Status</th>
                        <th class="py-2 px-4 w-1/3 text-center text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr class="border-b" data-eskul="Rohis">
                        <td class="py-2 px-4 text-center">Nemo</td>
                        <td class="py-2 px-4 text-center text-green-600 font-semibold">Aktif</td>
                        <td class="py-2 px-4 text-center">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">Detail</button>
                        </td>
                    </tr>
                    <tr class="border-b" data-eskul="Basket">
                        <td class="py-2 px-4 text-center">Basket</td>
                        <td class="py-2 px-4 text-center text-green-600 font-semibold">Aktif</td>
                        <td class="py-2 px-4 text-center">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">Detail</button>
                        </td>
                    </tr>
                    <tr class="border-b" data-eskul="Futsal">
                        <td class="py-2 px-4 text-center">Futsal</td>
                        <td class="py-2 px-4 text-center text-red-600 font-semibold">NonAktif</td>
                        <td class="py-2 px-4 text-center">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Ekskul -->
<div id="modalTambahEskul" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-lg font-semibold mb-4">Tambah Ekskul</h2>

        <label class="block text-sm font-medium text-gray-700">Nama Ekskul</label>
        <input type="text" id="namaEskul" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

        <label class="block text-sm font-medium text-gray-700">Guru Pembina</label>
        <input type="text" id="guruPembina" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

        <div class="flex justify-end space-x-2">
            <button id="btnBatal" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Batal</button>
            <button id="btnSimpan" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
        </div>
    </div>
</div>

<script>
    const modalTambahEskul = document.getElementById('modalTambahEskul');
    const btnTambahEskul = document.getElementById('btnTambahEskul');
    const btnBatal = document.getElementById('btnBatal');
    const btnSimpan = document.getElementById('btnSimpan');


    btnTambahEskul.addEventListener('click', () => {
        modalTambahEskul.classList.remove('hidden');
    });


    btnBatal.addEventListener('click', () => {
        modalTambahEskul.classList.add('hidden');
    });


    btnSimpan.addEventListener('click', () => {
        let namaEskul = document.getElementById('namaEskul').value;
        let guruPembina = document.getElementById('guruPembina').value;

        if (namaEskul.trim() === '' || guruPembina.trim() === '') {
            alert('Harap isi semua kolom!');
            return;
        }

        alert(`Ekskul "${namaEskul}" dengan Guru Pembina "${guruPembina}" telah ditambahkan!`);
        modalTambahEskul.classList.add('hidden');
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