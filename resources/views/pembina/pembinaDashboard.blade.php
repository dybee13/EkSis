@extends('layouts.main')
@section('container')
    <div class="bg-white shadow-md mt-28 ml-72 p-10 rounded-xl border border-gray-200 w-[60rem]">
        <h2 class="text-xl font-semibold text-gray-800">Selamat Datang di halaman Admin</h2>
    </div>
    @foreach ($ekskuls as $ekskul)
    <div class="bg-white shadow-md mt-8 ml-72 p-10 rounded-xl border border-gray-200 w-[20rem]">
        <h2 class="text-lg font-semibold text-gray-800">Jumlah Anggota Ekskul</h2>
        <h2 class="text-6xl text-center font-semibold text-blue-500">{{ $ekskul->anggota_ekskul_count }}</h2>
    </div>
    @endforeach
@endsection