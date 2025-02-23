@extends('layouts.main')
@section('container')
    <section
        class="container mb-8 mt-16 px-4 sm:ml-56 sm:w-8/12 md:mt-20 md:w-6/12 md:ml-72 lg:w-6/12 lg:mx-auto lg:ml-72 xl:ml-64 xl:w-10/12">
        <h1 class="text-2xl font-serif font-bold mt-4 mb-3 xl:text-3xl">Informasi Eskul</h1>
        <section class="flex flex-col gap-4 xl:flex-row xl:justify-between">
            <article
                class="flex flex-col items-start gap-2 border border-gray-400 shadow-md rounded-md shadow-gray-400
              xl:flex-row  xl:w-full xl:px-6 ">
                <div
                    class="w-10/12 h-40 mx-auto my-4 border border-gray-300 bg-cover rounded-xl shadow-md
                 shadow-gray-700 animation duration-300 md:h-48 lg:h-60 lg:my-6 xl:w-6/12 xl:ml-0 hover:scale-105">
                    <img src="{{ asset('assets/images/ekstrakulikuler/badminton.jpg') }}" alt="profile-eskul"
                        class="w-full h-full object-cover rounded-xl">
                </div>
                <section class="xl:-ml-40">
                    <table
                        class="table-auto border-separate border-spacing-x-3 border-spacing-y-1 text-left
                     md:border-spacing-x-6 lg:border-spacing-x-10 xl:border-spacing-x-28 xl:border-spacing-y-4">
                        <tr>
                            <th class="">Nama Eskul :</th>
                        <tr>
                            <td class="pl-3">{{ $ekskuls->first()->nama_ekskul ?? 'Belum memiliki ekskul' }}</td>
                        </tr>
                        </tr>
                        <tr>
                            <th class="">Tanggal Berdiri :</th>
                        <tr>
                            <td class="pl-3">
                                {{ $ekskuls->first()->created_at->format('H F Y') ?? 'Belum memiliki ekskul' }}</td>
                        </tr>
                        </tr>
                        <tr>
                            <th class="">Deskripsi :</th>
                        <tr>
                            <td class="pl-3">{{ $ekskuls->first()->nama_ekskul ?? 'Belum memiliki ekskul' }} }}</td>
                        </tr>
                        </tr>
                        <tr class="">
                            <th class="">Jadwal Latihan :</th>
                        <tr>
                            <td class="mt-2">
                                <ul class="pl-3">
                                    <li>Senin</li>
                                    <li>Selasa</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    {{-- Button Ubah --}}
                    <button id="btnEdit"
                        class="px-4 py-2 m-2 ml-48 md:ml-64 lg:ml-96 xl:ml-72 bg-blue-500 text-white rounded">Ubah</button>
                </section>
            </article>
            <article class="w-full p-3 border border-gray-400 shadow-md rounded-md shadow-gray-400 xl:w-8/12">
                <h1 class="text-xl font-semibold mb-2 xl:mb-2 xl:text-2xl">Struktur Organisasi</h1>
                <table
                    class="table-auto border-separate border-spacing-x-1 border-spacing-y-1 text-left
             md:border-spacing-x-6 lg:border-spacing-x-6 xl:border-spacing-x-4 xl:border-spacing-y-2">
                    <tr>
                        <th class="">Nama Pembina :</th>
                    </tr>
                    <tr>
                        <td class="pl-3">{{ $user->name ?? 'Belum memiliki ekskul' }}</td>
                    </tr>
                    <tr class="">
                        <th class="">Nama Ketua Eskul :</th>
                    </tr>
                    <tr>
                        <td class="pl-3">Anonim</td>
                    </tr>
                    <tr class="">
                        <th class="">Nama Wakil Ketua Eskul :</th>
                    </tr>
                    <tr>
                        <td class="pl-3">Anonim</td>
                    </tr>
                    <tr class="">
                        <th class="">Nama Sekertaris Eskul :</th>
                    </tr>
                    <tr>
                        <td class="pl-3">Anonim</td>
                    </tr>
                    <tr class="">
                        <th class="">Nama Bendahara Eskul :</th>
                    </tr>
                    <tr>
                        <td class="pl-3">Anonim</td>
                    </tr>
                </table>
            </article>
        </section>
        {{-- Modal Ubah Data --}}
        <div id="dataModal"
            class="fixed inset-0 overflow-y-scroll bg-black bg-opacity-50 z-50 flex justify-center items-center">
            <form method="POST" id="dataForm" class="w-11/12 mx-auto md:w-6/12 lg:w-4/12">
                @csrf
                <div id="methodField"></div>
                <div class="bg-white p-6 rounded-lg shadow-lg mt-40 md:mt-36 lg:mt-32 xl:mt-12">
                    <h2 class="text-lg font-semibold mb-4" id="modalTitle">Edit Informasi Eskul</h2>
                    <label class="block text-sm font-medium text-gray-700">Nama Eskul</label>
                    <input type="text" id="namaEskul" name="nama_ekskul"
                        class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md">
                    <label class="block text-sm font-medium text-gray-700">Tanggal Berdiri</label>
                    <input type="date" id="tanggalBerdiri" name="tanggal_berdiri"
                        class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsiEskul" name="deskripsi" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md"></textarea>
                    <label class="block text-sm font-medium text-gray-700">Jadwal Latihan</label>
                    <input type="text" id="jadwalLatihan" name="jadwal"
                        class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md">
                    <label class="block text-sm font-medium text-gray-700">Foto Eskul</label>
                    <input type="file" id="fotoEskul" name="foto"
                        class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md">
                    <div class="flex justify-end space-x-2">
                        <button id="btnBatal" type="button"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Batal</button>
                        <button type="submit" id="btnSimpan"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnEdit = document.getElementById("btnEdit");
            const dataModal = document.getElementById("dataModal");
            const btnBatal = document.getElementById("btnBatal");
            const dataForm = document.getElementById("dataForm");
            const methodField = document.getElementById("methodField");

            // Event untuk membuka modal
            btnEdit.addEventListener("click", function() {
                dataModal.classList.remove("hidden");
                document.body.classList.add("overflow-hidden"); // Mencegah scroll saat modal terbuka

                document.getElementById("idAnggota").value = ekskul.id;
                document.getElementById("namaAnggota").value = ekskul.name;
                document.getElementById("nisAnggota").value = ekskul.nis;
                document.getElementById("noHp").value = ekskul.noHp;
                document.getElementById("email").value = ekskul.email;
                document.getElementById("jurusanSelect").value = ekskul.jurusan;

                methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
            });

            // Event untuk menutup modal
            btnBatal.addEventListener("click", function(event) {
                event.preventDefault();
                dataModal.classList.add("hidden");
                document.body.classList.remove("overflow-hidden");
            });

            // Event untuk menutup modal dengan klik di luar modal
            dataModal.addEventListener("click", function(event) {
                if (event.target === dataModal) {
                    dataModal.classList.add("hidden");
                    document.body.classList.remove("overflow-hidden");
                }
            });

            // Mencegah form dikirim tanpa validasi (contoh sederhana)
            dataForm.addEventListener("submit", function(event) {
                const name = document.getElementById("namaAnggota").value.trim();
                const nis = document.getElementById("nisAnggota").value.trim();
                const email = document.getElementById("email").value.trim();

                if (!name || !nis || !email) {
                    alert("Harap isi semua kolom yang diperlukan!");
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection
