@extends('layouts.main')
@section('container')

<div class="w-full min-h-screen flex justify-center items-start mt-32 ml-32 px-6">
    <div class="w-full max-w-screen-lg bg-white p-6 rounded-lg shadow">
        <!-- Dropdown Ekskul & Tombol Tambah -->
        <div class="mb-4 flex justify-between items-center">
            <div class="w-1/2">
                <label for="eskul" class="block text-sm font-medium text-gray-700">Pilih Pembina Ekskul</label>
                <select id="eskul" class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="all">Semua</option>
                    <option value="Basket">Basket</option>
                    <option value="Futsal">Futsal</option>
                    <option value="Rohis">Rohis</option>
                </select>
            </div>
            <button id="btnTambahGuru" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">+ Tambah Guru</button>
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
                    <tr class="border-b" data-eskul="Rohis">
                        <td class="py-2 px-4 text-center">{{ $pembina->name }}</td>
                        <td class="py-2 px-4 text-center">{{ $pembina->nip }}</td>
                        <td>
                            @foreach ($pembina->ekskuls as $ekskulUser)
                                {{ $ekskulUser->ekskul->nama_ekskul }}<br>
                            @endforeach
                        </td>
                        <td class="py-2 px-4 text-center text-green-600 font-semibold">Aktif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Guru Pembina -->
<div id="modalTambahGuru" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
    <form method="POST" action="/savePembina">
        @csrf
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 h-auto">
        <h2 class="text-lg font-semibold mb-4">Tambah Guru Pembina</h2>

        <label class="block text-sm font-medium text-gray-700">Nama Guru</label>
        <input type="text" id="namaGuru" name="name" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

        <label class="block text-sm font-medium text-gray-700">NIP</label>
        <input type="text" id="nipGuru" name="nip" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        
        <label class="block text-sm font-medium text-gray-700">No. Handphone</label>
        <input type="text" id="noHp" name="noHp" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="text" id="email" name="email" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

        <label class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

        <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">

        <div class="flex justify-end space-x-2">
            <button onclick="window.location.href=`{{ url('/masterDataPembina') }}`" id="btnBatal" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Batal</button>
            <button type="submit" id="btnSimpan" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
        </div>
    </div>
    </form>
</div>

<script>
    const modalTambahGuru = document.getElementById('modalTambahGuru');
    const btnTambahGuru = document.getElementById('btnTambahGuru');
    const btnBatal = document.getElementById('btnBatal');
    const btnSimpan = document.getElementById('btnSimpan');


    btnTambahGuru.addEventListener('click', () => {
        modalTambahGuru.classList.remove('hidden');
    });


    btnBatal.addEventListener('click', () => {
        modalTambahGuru.classList.add('hidden');
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