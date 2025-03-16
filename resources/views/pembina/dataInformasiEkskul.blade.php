@extends('layouts.main')
@section('container')
    <section
        class="container mb-8 mt-16 px-4 sm:ml-56 sm:w-8/12 md:mt-20 md:w-6/12 md:ml-72 lg:w-6/12 lg:mx-auto lg:ml-72 xl:ml-64 xl:w-10/12">
        <h1 class="text-2xl font-serif font-bold mt-4 mb-3 xl:text-3xl">Informasi Eskul</h1>
        @if (session('success'))
            <div style="background-color: green; color: white; padding: 10px; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif
        <section class="flex flex-col gap-4 xl:flex-row xl:justify-between">
            <article
                class="flex flex-col gap-2 py-2 px-2 pl-2 border border-gray-400 shadow-md rounded-md shadow-gray-400
              xl:flex-row  xl:w-full">
                <div
                    class="w-10/12 h-60 mx-auto my-4 border border-gray-300 bg-cover rounded-xl shadow-md
                 shadow-gray-700 animation duration-300 md:h-72 lg:h-72 lg:my-6 xl:w-6/12 xl:ml-0">
                    <img src="{{ optional($informasiEkskul)->logo ? asset('storage/' . $informasiEkskul->logo) : 'ga ada' }}"
                        loading="lazy" alt="profile-eskul" class="w-full h-full object-cover rounded-xl">
                </div>
                <section class="relative xl:-ml-24">
                    <table
                        class=" table-auto border-separate border-spacing-x-3 border-spacing-y-1 text-left mb-12
                     md:border-spacing-x-6 lg:border-spacing-x-10 xl:border-spacing-x-28 xl:border-spacing-y-4 ">
                        <tr>
                            <th class="">Nama Eskul :</th>
                        </tr>
                        <tr>
                            <td class="pl-3">{{ $ekskul->nama_ekskul ?? 'Belum memiliki nama eskul' }}</td>
                        </tr>
                        <tr>
                            <th class="">Nama Pembina :</th>
                        </tr>
                        <tr>
                            <td class="pl-3">{{ $pembina->name ?? 'Belum memiliki pembina' }}</td>
                        </tr>
                        <tr>
                            <th class="">Tanggal Berdiri :</th>
                        </tr>
                        <tr>
                            <td class="pl-3">
                                {{ optional($informasiEkskul)->tgl_berdiri ? $informasiEkskul->tgl_berdiri->format('d F Y') : 'Belum memiliki tanggal berdiri' }}
                            </td>
                        </tr>
                        <tr>
                            <th class="">Deskripsi :</th>
                        </tr>
                        <tr>
                            <td class="pl-3">{{ $informasiEkskul->deskripsi ?? 'Belum memiliki deskripsi' }}
                            </td>
                        </tr>
                        <tr>
                            <th class="">Kategori :</th>
                        </tr>
                        <tr>
                            <td class="pl-3">{{ $informasiEkskul->kategori ?? 'Belum memiliki deskripsi' }}
                            </td>
                        </tr>
                    </table>
                    {{-- Button Ubah --}}
                    @if ($informasiEkskul)
                        <button id="btnUbahInformasi"
                            class="absolute bottom-0 right-0 px-4 py-2 bg-blue-500 text-white rounded">Ubah</button>
                    @else
                        <button id="btnTambahInformasi"
                            class="absolute bottom-0 right-0 px-4 py-2 bg-blue-500 text-white rounded">Tambah</button>
                    @endif
                </section>
            </article>
            <article class="relative w-full p-3 border border-gray-400 shadow-md rounded-md shadow-gray-400 xl:w-8/12">
                <h1 class="text-xl font-semibold mb-2 xl:mb-2 xl:text-2xl">Struktur Organisasi</h1>
                <table
                    class="table-auto border-separate border-spacing-x-1 border-spacing-y-1 text-left mb-12
             md:border-spacing-x-6 lg:border-spacing-x-6 xl:border-spacing-x-4 xl:border-spacing-y-2">
                    <tr class="">
                        <th class="">Nama Ketua Eskul :</th>
                    </tr>
                    <tr>
                        <td class="pl-3">{{ $strukturEkskul->ketua_ekskul ?? 'Belum memiliki ketua eskul' }}</td>
                    </tr>
                    <tr class="">
                        <th class="">Nama Wakil Ketua Eskul :</th>
                    </tr>
                    <tr>
                        <td class="pl-3">{{ $strukturEkskul->waketu_ekskul ?? 'Belum memiliki wakil ketua eskul' }}</td>
                    </tr>
                    <tr class="">
                        <th class="">Nama Sekretaris Eskul :</th>
                    </tr>
                    <tr>
                        <td class="pl-3">{{ $strukturEkskul->sekretaris ?? 'Belum memiliki sekretaris eskul' }}</td>
                    </tr>
                    <tr class="">
                        <th class="">Nama Bendahara Eskul :</th>
                    </tr>
                    <tr>
                        <td class="pl-3">{{ $strukturEkskul->bendahara ?? 'Belum memiliki bendahara eskul' }}</td>
                    </tr>
                </table>
                {{-- Button Tambah / Ubah Struktur --}}
                @if (!$strukturEkskul)
                    <button id="btnTambahStruktur"
                        class="absolute bottom-0 right-0 px-4 py-2 m-2 ml-40 bg-blue-500 text-white rounded">Tambah</button>
                @else
                    <button id="btnUbahStruktur"
                        class="absolute bottom-0 right-0 px-4 py-2 m-2 ml-40 bg-blue-500 text-white rounded">Ubah</button>
                @endif
            </article>
        </section>

        <section class="w-full flex">
            <article
                class="flex-col gap-2 py-2 px-2 pl-2 border border-gray-400 shadow-md rounded-md shadow-gray-400
              xl:flex-row xl:w-full">
                @foreach ($jadwal as $item)
                    <p>Hari: {{ ucfirst($item->hari) }}</p>
                    <p>Jam Mulai: {{ $item->jam_mulai }}</p>
                    <p>Jam Selesai: {{ $item->jam_selesai }}</p>
                @endforeach
                <button id="btnTambahJadwal"
                            class="px-4 py-2 bg-blue-500 text-white rounded">Tambah Jadwal</button>
                    {{-- Button Ubah --}}
                    <!-- @if ($jadwal)
                        <button id="btnUbahJadwal"
                            class="absolute bottom-0 right-0 px-4 py-2 bg-blue-500 text-white rounded">Ubah</button>
                    @else
                        <button id="btnTambahJadwal"
                            class="absolute bottom-0 right-0 px-4 py-2 bg-blue-500 text-white rounded">Tambah Jadwal</button>
                    @endif -->
            </article>
        </section>
        {{-- Modal Form Tambah Informasi --}}
        <div id="dataModalTambahInformasi"
            class="hidden fixed inset-0 overflow-y-scroll bg-black bg-opacity-50 z-0 flex justify-center items-center">
            <form method="POST" id="formInformasi" action="{{ route('saveDataInformasiEkskul') }}"
                enctype="multipart/form-data" class="w-11/12 mx-auto md:w-6/12 lg:w-4/12">
                @csrf
                <div id="methodField"></div>
                <div class="bg-white p-6 rounded-lg shadow-lg mt-40 md:mt-36 lg:mt-32 xl:mt-12">
                    <h2 class="text-lg font-semibold mb-4" id="modalTitle">Tambah Informasi Eskul</h2>
                    <input type="number" name="id_ekskul" id="id_ekskul" value="{{ $ekskul->id }}" hidden>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Berdiri</label>
                    <input type="date" id="tanggalBerdiri" name="tgl_berdiri" id="tgl_berdiri"
                        class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsiEskul" name="deskripsi" id="deskripsi"
                        class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md"></textarea>
                    <!-- Keterangan -->
                    <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <select id="kategori" name="kategori" class="form-select w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 mb-4">
                        <option selected>Pilih Keterangan</option>
                        <option value="seni">Seni & Musik</option>
                        <option value="olahraga">Olahraga</option>
                        <option value="religi">Religi</option>
                        <option value="akademik">Akademik</option>
                        <option value="kepemimpinan">Kepemimpinan</option>
                    </select>
                    <label class="block text-sm font-medium text-gray-700">Foto Eskul</label>
                    <input type="file" id="fotoEskul" name="logo" id="logo"
                        class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md">
                    <div class="flex justify-end space-x-2">
                        <button id="btnBatalTambahInformasi" type="button"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Batal</button>
                        <button type="submit" id="btnSimpan"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- Modal Form Tambah Jadwal --}}
        <div id="dataModalTambahJadwal"
            class="hidden fixed inset-0 overflow-y-scroll bg-black bg-opacity-50 z-0 flex justify-center items-center">
            <form method="POST" id="formJadwal" action="{{ route('saveJadwalEkskul') }}"
                class="w-11/12 mx-auto md:w-6/12 lg:w-4/12">
                @csrf
                <div id="methodField"></div>
                <div class="bg-white p-6 rounded-lg shadow-lg mt-40 md:mt-36 lg:mt-32 xl:mt-12">
                    <h2 class="text-lg font-semibold mb-4" id="modalTitle">Tambah Jadwal Eskul</h2>
                    <input type="number" name="id_ekskul" id="id_ekskul" value="{{ $ekskul->id }}" hidden>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Hari</label>
                        <select name="hari" class="border p-2 rounded w-full">
                            <option value="senin">Senin</option>
                            <option value="selasa">Selasa</option>
                            <option value="rabu">Rabu</option>
                            <option value="kamis">Kamis</option>
                            <option value="jumat">Jumat</option>
                            <option value="sabtu">Sabtu</option>
                            <option value="minggu">Minggu</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="border p-2 rounded w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="border p-2 rounded w-full" required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button id="btnBatalTambahJadwal" type="button"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Batal</button>
                        <button type="submit" id="btnSimpan"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- Modal Form Tambah Struktur --}}
        <div id="dataModalTambahStruktur"
            class="hidden fixed inset-0 overflow-y-scroll bg-black bg-opacity-50 z-0 px-4 flex justify-center items-center">
            <form method="POST" id="formStruktur" action="{{ route('saveDataStrukturEkskul') }}">
                @csrf
                <div id="methodField"></div>
                <div
                    class="flex flex-col gap-2 border bg-white p-6 rounded-lg shadow-lg mt-20 md:mt-20 md:ml-48 lg:mt-24 xl:mt-12">
                    <h2 class="text-lg font-semibold mb-4" id="modalTitle">Tambah Struktur Eskul</h2>
                    <input type="hidden" id="id_ekskul" name="id_ekskul" value="{{ $ekskul->id }}">
                    <!-- Ubah sesuai id ekskul -->

                    <!-- Ketua Ekskul -->
                    <label class="border p-2 border-gray-500 rounded-lg">Nama Ketua Ekskul:
                        <select name="ketua_ekskul" id="ketua_ekskul">
                            <option value="" selected>Nama Anggota eskul</option>
                            @foreach ($anggotaEkskul as $anggota)
                                <option value="{{ $anggota->name }}">{{ $anggota->name }}</option>
                            @endforeach
                        </select>
                    </label>

                    <!-- Wakil Ketua Ekskul -->
                    <label class="border p-2 border-gray-500 rounded-lg">Nama Wakil Ketua Ekskul:
                        <select name="waketu_ekskul" id="waketu_ekskul">
                            <option value="" selected>Nama Anggota eskul</option>
                            @foreach ($anggotaEkskul as $anggota)
                                <option value="{{ $anggota->name }}">{{ $anggota->name }}</option>
                            @endforeach
                        </select>
                    </label>

                    <!-- Sekretaris -->
                    <label class="border p-2 border-gray-500 rounded-lg">Nama Sekretaris:
                        <select name="sekretaris" id="sekretaris">
                            <option value="" selected>Nama Anggota eskul</option>
                            @foreach ($anggotaEkskul as $anggota)
                                <option value="{{ $anggota->name }}">{{ $anggota->name }}</option>
                            @endforeach
                        </select>
                    </label>

                    <!-- Bendahara -->
                    <label class="border p-2 border-gray-500 rounded-lg">Nama Bendahara:
                        <select name="bendahara" id="bendahara">
                            <option value="" selected>Nama Anggota eskul</option>
                            @foreach ($anggotaEkskul as $anggota)
                                <option value="{{ $anggota->name }}">{{ $anggota->name }}</option>
                            @endforeach
                        </select>
                    </label>

                    <div class="flex justify-end space-x-2">
                        <button id="btnBatalTambahStruktur" type="button"
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
            const btnTambahInformasi = document.getElementById("btnTambahInformasi");
            const btnTambahStruktur = document.getElementById("btnTambahStruktur");
            const ModalTambahInformasi = document.getElementById('dataModalTambahInformasi');
            const ModalTambahStruktur = document.getElementById('dataModalTambahStruktur');
            const ModalTambahJadwal = document.getElementById('dataModalTambahJadwal');
            const btnBatalTambahInformasi = document.getElementById("btnBatalTambahInformasi");
            const btnBatalTambahStruktur = document.getElementById("btnBatalTambahStruktur");
            const btnBatalTambahJadwal = document.getElementById("btnBatalTambahJadwal");
            const formInformasi = document.getElementById("formInformasi");
            const formStruktur = document.getElementById("formStruktur");
            const formJadwal = document.getElementById("formJadwal");

            // Fungsi untuk membuka modal
            const showModal = (modal) => modal?.classList.remove('hidden');

            // Fungsi untuk menutup modal
            const hideModal = (modal) => modal?.classList.add('hidden');

            // Event untuk membuka modal
            btnTambahStruktur?.addEventListener('click', () => showModal(ModalTambahStruktur));
            btnTambahInformasi?.addEventListener('click', () => showModal(ModalTambahInformasi));
            btnTambahJadwal?.addEventListener('click', () => showModal(ModalTambahJadwal));

            // Event untuk menutup modal
            btnBatalTambahStruktur?.addEventListener("click", () => hideModal(ModalTambahStruktur));
            btnBatalTambahInformasi?.addEventListener("click", () => hideModal(ModalTambahInformasi));
            btnBatalTambahJadwal?.addEventListener("click", () => hideModal(ModalTambahJadwal));

            // Menutup modal dengan klik di luar modal
            [ModalTambahStruktur, ModalTambahInformasi].forEach(modal => {
                modal?.addEventListener("click", function(event) {
                    if (event.target === modal) {
                        hideModal(modal);
                    }
                });
            });

            // Fungsi untuk submit form via AJAX dengan async/await
            // const submitFormInformasi = async (form, route) => {
            //     form?.addEventListener("submit", async function(event) {
            //         event.preventDefault();
            //         let formData = new FormData(this);

            //         try {
            //             let response = await fetch(route, {
            //                 method: "POST",
            //                 body: formData,
            //                 headers: {
            //                     "X-CSRF-TOKEN": document.querySelector(
            //                         "meta[name='csrf-token']").content
            //                 }
            //             });

            //             let data = await response.json();

            //             if (data.success) {
            //                 alert("Data berhasil disimpan!");
            //                 location.reload();
            //             } else {
            //                 alert("Terjadi kesalahan, coba lagi.");
            //             }
            //         } catch (error) {
            //             console.error("Error:", error);
            //             alert("Gagal menghubungi server!");
            //         }
            //     });
            // };

            // Fungsi untuk submit form via AJAX dengan async/await
            // const submitFormStruktur = async (form, route) => {
            //     form?.addEventListener("submit", async function(event) {
            //         event.preventDefault();
            //         let formData = new FormData(this);

            //         try {
            //             let response = await fetch(route, {
            //                 method: "POST",
            //                 body: formData,
            //                 headers: {
            //                     "X-CSRF-TOKEN": document.querySelector(
            //                         "meta[name='csrf-token']").content
            //                 }
            //             });

            //             let data = await response.json();

            //             if (data.success) {
            //                 alert("Data berhasil disimpan!");
            //                 location.reload();
            //             } else {
            //                 alert("Terjadi kesalahan, coba lagi.");
            //             }
            //         } catch (error) {
            //             console.error("Error:", error);
            //             alert("Gagal menghubungi server!");
            //         }
            //     });
            // };

            // Handle form submit
            // submitFormInformasi(formInformasi, "{{ route('saveDataInformasiEkskul') }}");
            // submitFormStruktur(formStruktur, "{{ route('saveDataStrukturEkskul') }}"); // Pastikan route benar


            // batas
            // //input form informasi
            // const id_ekskul = document.getElementById('id_ekskul')
            const tgl_berdiri = document.getElementById('tgl_berdiri');
            const deskripsi = document.getElementById('deskripsi');
            const jadwal = document.getElementById('jadwal');
            const kategori = document.getElementById('kategori');
            const logo = document.getElementById('logo');
            //input form struktur
            const id_ekskul = document.getElementById('id_ekskul')
            const ketua_ekskul = document.getElementById('ketua_ekskul');
            const waketu_ekskul = document.getElementById('waketu_ekskul');
            const sekretaris = document.getElementById('sekretaris');
            const bendahara = document.getElementById('bendahara');

            // Open modal for adding data informasi
            formInformasi.addEventListener('click', () => {
                dataForm.action = "{{ route('saveDataInformasiEkskul') }}";
                dataForm.method = "POST";
                id_ekskul.value = "";
                ketua_ekskul.value = "";
                waketu_ekskul.value = "";
                sekretaris.value = "";
                bendahara.value = "";
                methodField.innerHTML = "";
                ModalTambahInformasi.classList.remove('hidden');
            });

            // Open modal for adding data struktur
            formStruktur.addEventListener('click', () => {
                dataForm.action = "{{ route('saveDataInformasiEkskul') }}";
                dataForm.method = "POST";
                id_ekskul.value = "";
                tgl_berdiri.value = "";
                deskripsi.value = "";
                jadwal.value = "";
                logo.value = "";
                methodField.innerHTML = "";
                ModalTambahInformasi.classList.remove('hidden');
            });


        });
    </script>
@endsection
