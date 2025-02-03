@extends('layouts.sidebar')
@section('container')

<div class="w-full min-h-screen flex justify-center items-start mt-10 ml-32 px-6">
    <div class="w-full max-w-screen-lg bg-white p-6 rounded-lg">
        <!-- Dropdown Ekskul -->
        <div class="mb-4">
            <label for="eskul" class="block text-sm font-medium text-gray-700">Pilih Ekskul</label>
            <select id="eskul" class="w-full mt-1 block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="all">Semua</option>
                <option value="Basket">Basket</option>
                <option value="Futsal">Futsal</option>
                <option value="Rohis">Rohis</option>
            </select>
        </div>

        <!-- Tabel Data -->
        <div class="w-full">
            <table class="w-full table-auto bg-white rounded-lg border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-2 px-2 text-left text-gray-700">Nama</th>
                        <th class="py-2 px-2 text-left text-gray-700">NIS</th>
                        <th class="py-2 px-2 text-left text-gray-700">Ekskul</th>
                        <th class="py-2 px-2 text-left text-gray-700">Status</th>
                        <th class="py-2 px-2 text-left text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr class="border-b" data-eskul="Rohis">
                        <td class="py-2 px-2">Dymas</td>
                        <td class="py-2 px-2">122287334</td>
                        <td class="py-2 px-2">Rohis</td>
                        <td class="py-2 px-2 text-green-600 font-semibold">Aktif</td>
                        <td class="py-2 px-2">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">Detail</button>
                        </td>
                    </tr>
                    <tr class="border-b" data-eskul="Basket">
                        <td class="py-2 px-2">Aldo</td>
                        <td class="py-2 px-2">122287335</td>
                        <td class="py-2 px-2">Basket</td>
                        <td class="py-2 px-2 text-green-600 font-semibold">Aktif</td>
                        <td class="py-2 px-2">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">Detail</button>
                        </td>
                    </tr>
                    <tr class="border-b" data-eskul="Futsal">
                        <td class="py-2 px-2">Rafi</td>
                        <td class="py-2 px-2">122287336</td>
                        <td class="py-2 px-2">Futsal</td>
                        <td class="py-2 px-2 text-red-600 font-semibold">NonAktif</td>
                        <td class="py-2 px-2">
                            <button class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('eskul').addEventListener('change', function() {
        let selectedEskul = this.value;
        let rows = document.querySelectorAll('#table-body tr');

        rows.forEach(row => {
            let eskul = row.getAttribute('data-eskul');
            if (selectedEskul === 'all' || eskul === selectedEskul) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection