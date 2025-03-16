@extends('layouts.main')

@section('container')
<div class="container mx-auto p-6 w-5xl pt-20 pl-72">
    <h1 class="text-2xl font-bold mb-4">Absen Anggota Ekskul</h1>

    @if(session('error'))
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pengurus.submitAbsen', $idEkskul) }}" method="POST">
        @csrf
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">No.</th>
                    <th class="border border-gray-300 px-4 py-2">NIS</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Hadir</th>
                    <th class="border border-gray-300 px-4 py-2">Izin</th>
                    <th class="border border-gray-300 px-4 py-2">Sakit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggotaEkskul as $index => $anggota)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $index+1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $anggota->nis }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $anggota->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <input type="checkbox" name="hadir[{{ $anggota->id }}]" class="checkbox-hadir">
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <input type="checkbox" name="izin[{{ $anggota->id }}]" class="checkbox-izin">
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <input type="checkbox" name="sakit[{{ $anggota->id }}]" class="checkbox-sakit">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="w-full mt-4 bg-blue-500 text-white px-4 py-2 rounded" {{ $adaLatihan ? '' : 'disabled' }}>
            Simpan Absen
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const checkboxes = row.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    checkboxes.forEach(cb => {
                        if (cb !== checkbox) cb.checked = false;
                    });
                });
            });
        });
    });
</script>
@endsection