@extends('layouts.main')
@section('container')
    <section
        class="container mb-8 mt-16 px-4 sm:ml-56 sm:w-8/12 md:mt-20 md:w-6/12 md:ml-72 lg:w-6/12 lg:mx-auto lg:ml-72 xl:ml-64 xl:w-10/12">
        <h1 class="text-2xl font-serif font-bold mt-4 mb-3 xl:text-3xl">Informasi Eskul</h1>
        <section class="flex flex-col gap-4 xl:flex-row xl:justify-between">
            <article
                class="flex flex-col items-start gap-2 border border-gray-400 shadow-md rounded-md shadow-gray-400
              xl:flex-row  xl:w-full xl:px-6">
                <div
                    class="w-10/12 h-40 mx-auto my-4 border border-gray-300 bg-cover rounded-xl shadow-md
                 shadow-gray-700 animation duration-300 md:h-48 lg:h-60 lg:my-6 xl:w-6/12 xl:ml-0 hover:scale-105">
                    <img src="{{ optional($informasiEkskul)->logo ? asset('storage/' . $informasiEkskul->logo) : 'ga ada' }}"
                        loading="lazy" alt="profile-eskul" class="w-full h-full object-cover rounded-xl">
                </div>
                <section class="xl:-ml-24">
                    <table
                        class="table-auto border-separate border-spacing-x-3 border-spacing-y-1 text-left
                     md:border-spacing-x-6 lg:border-spacing-x-10 xl:border-spacing-x-28 xl:border-spacing-y-4 ">
                        <tr>
                            <th class="">Nama Eskul :</th>
                        <tr>
                            <td class="pl-3">{{ $ekskul->nama_ekskul ?? 'Belum ada nama eskul' }}</td>
                        </tr>
                        </tr>
                        <tr>
                            <th class="">Nama Pembina :</th>
                        <tr>
                            <td class="pl-3">{{ $user->name ?? 'Belum memiliki pembina' }}</td>
                        </tr>
                        </tr>
                        <tr>
                            <th class="">Tanggal Berdiri :</th>
                        <tr>
                            <td class="pl-3">
                                {{ optional($informasiEkskul)->tgl_berdiri ? $informasiEkskul->tgl_berdiri->format('d F Y') : 'Belum ada tanggal berdiri' }}
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <th class="">Deskripsi :</th>
                        <tr>
                            <td class="pl-3">{{ $informasiEkskul->deskripsi ?? 'Belum ada deskripsi' }}
                            </td>
                        </tr>
                        </tr>
                        <tr class="">
                            <th class="">Jadwal Latihan :</th>
                        <tr>
                            <td class="pl-3">
                                {{ $informasiEkskul->jadwal ?? 'Belum ada jadwal' }}
                            </td>
                        </tr>
                        </tr>
                    </table>
                    {{-- Button Ubah --}}
                    @if ($informasiEkskul)
                        <button id="btnUbahInformasi"
                            class="px-4 py-2 m-2 ml-48 md:ml-64 lg:ml-96 xl:ml-72 bg-blue-500 text-white rounded">Ubah</button>
                    @else
                        <button id="btnTambahInformasi"
                            class="px-4 py-2 m-2 ml-48 md:ml-64 lg:ml-96 xl:ml-72 bg-blue-500 text-white rounded">Tambah</button>
                    @endif
                </section>
            </article>
            <article class="w-full p-3 border border-gray-400 shadow-md rounded-md shadow-gray-400 xl:w-8/12">
                <h1 class="text-xl font-semibold mb-2 xl:mb-2 xl:text-2xl">Struktur Organisasi</h1>
                <table
                    class="table-auto border-separate border-spacing-x-1 border-spacing-y-1 text-left
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
                        class="px-4 py-2 m-2 ml-48 md:ml-64 lg:ml-96 xl:ml-72 bg-blue-500 text-white rounded">Tambah</button>
                @else
                    <button id="btnUbahStruktur"
                        class="px-4 py-2 m-2 ml-48 md:ml-64 lg:ml-96 xl:ml-72 bg-blue-500 text-white rounded">Ubah</button>
                @endif
            </article>
        </section>
        {{-- Modal Form Tambah Informasi --}}
        <div id="dataModalTambahInformasi"
            class="hidden fixed inset-0 overflow-y-scroll bg-black bg-opacity-50 z-0 flex justify-center items-center">
            <form method="POST" id="dataFormInformasi" action="{{ route('saveDataInformasiEkskul') }}"
                enctype="multipart/form-data" class="w-11/12 mx-auto md:w-6/12 lg:w-4/12">
                @csrf
                <div id="methodField"></div>
                <div class="bg-white p-6 rounded-lg shadow-lg mt-40 md:mt-36 lg:mt-32 xl:mt-12">
                    <h2 class="text-lg font-semibold mb-4" id="modalTitle">Tambah Informasi Eskul</h2>
                    <input type="number" name="id_ekskul" hidden>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Berdiri</label>
                    <input type="date" id="tanggalBerdiri" name="tgl_berdiri"
                        class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsiEskul" name="deskripsi" class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md"></textarea>
                    <label class="block text-sm font-medium text-gray-700">Jadwal Latihan</label>
                    <input type="text" id="jadwalLatihan" name="jadwal"
                        class="w-full mt-1 mb-4 p-2 border border-gray-300 rounded-md">
                    <label class="block text-sm font-medium text-gray-700">Foto Eskul</label>
                    <input type="file" id="fotoEskul" name="logo"
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
        {{-- Modal Form Tambah Struktur --}}
        <div id="dataModalTambahStruktur"
            class="hidden fixed inset-0 overflow-y-scroll bg-black bg-opacity-50 z-0 flex justify-center items-center">
            <form method="POST" id="dataFormStruktur" action="{{ route('saveDataStrukturEkskul') }}"
                enctype="multipart/form-data">
                @csrf
                <div id="methodField"></div>
                <div class="bg-white p-6 rounded-lg shadow-lg mt-40 md:mt-36 lg:mt-32 xl:mt-12">
                    <h2 class="text-lg font-semibold mb-4" id="modalTitle">Tambah Struktur Eskul</h2>
                    <input type="hidden" name="id_ekskul" value="1"> <!-- Ubah sesuai id ekskul -->

                    <!-- Ketua Ekskul -->
                    <label>Nama Ketua Ekskul:
                        <select name="ketua_ekskul">
                            <option value="" selected disabled>Nama Anggota eskul</option>
                            @foreach ($anggotaEkskul as $anggota)
                                <option value="{{ $anggota->name }}">{{ $anggota->name }}</option>
                            @endforeach
                        </select>
                    </label><br>

                    <!-- Wakil Ketua Ekskul -->
                    <label>Nama Wakil Ketua Ekskul:
                        <select name="waketu_ekskul">
                            <option value="" selected disabled>Nama Anggota eskul</option>
                            @foreach ($anggotaEkskul as $anggota)
                                <option value="{{ $anggota->name }}">{{ $anggota->name }}</option>
                            @endforeach
                        </select>
                    </label><br>

                    <!-- Sekretaris -->
                    <label>Nama Sekretaris:
                        <select name="sekretaris">
                            <option value="" selected disabled>Nama Anggota eskul</option>
                            @foreach ($anggotaEkskul as $anggota)
                                <option value="{{ $anggota->name }}">{{ $anggota->name }}</option>
                            @endforeach
                        </select>
                    </label><br>

                    <!-- Bendahara -->
                    <label>Nama Bendahara:
                        <select name="bendahara">
                            <option value="" selected disabled>Nama Anggota eskul</option>
                            @foreach ($anggotaEkskul as $anggota)
                                <option value="{{ $anggota->name }}">{{ $anggota->name }}</option>
                            @endforeach
                        </select>
                    </label><br>

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
    {{-- <script>
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
    </script> --}}
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tambahEskulModal = document.getElementById("tambahEskulModal");
            const strukturEskulModal = document.getElementById("strukturEskulModal");
            const btnTambahInformasi = document.getElementById("btnTambahInformasi");
            const btnTambahStruktur = document.getElementById("btnTambahStruktur");
            const tambahEskulForm = document.getElementById("tambahEskulForm");
            const ModalTambahInformasi = document.getElementById('dataModalTambahInformasi');
            const ModalTambahStruktur = document.getElementById('dataModalTambahStruktur');
            const btnBatalTambahInformasi = document.getElementById("btnBatalTambahInformasi");
            const btnBatalTambahStruktur = document.getElementById("btnBatalTambahStruktur");


            // STRUKTUR EKSKUL
            // Event untuk membuka modal tambah informasi
            btnTambahStruktur.addEventListener('click', () => {
                console.log('cek');
                ModalTambahStruktur.classList.remove('hidden');
            });
            // Event untuk menutup modal tambah ekskul
            btnBatalTambahStruktur.addEventListener("click", function() {
                console.log('cek');
                ModalTambahStruktur.classList.add("hidden");
            });
            // Event untuk membuka modal tambah informasi
            btnTambahInformasi.addEventListener('click', () => {
                ModalTambahInformasi.classList.remove('hidden');
            });

            // Event untuk menutup modal tambah informasi
            btnBatalTambahInformasi.addEventListener("click", function() {
                ModalTambahInformasi.classList.add("hidden");
            });

            // // Event untuk menutup modal dengan klik di luar form
            // ModalTambahInformasi.addEventListener("click", function(event) {
            //     if (event.target === ModalTambahInformasi) {
            //         ModalTambahInformasi.classList.add("hidden");
            //     }
            // });

            // Event untuk menutup modal dengan klik di luar form
            ModalTambahStruktur.addEventListener("click", function(event) {
                if (event.target === ModalTambahStruktur) {
                    ModalTambahStruktur.classList.add("hidden");
                }
            });

            // Handle submit form tambah dengan AJAX
            tambahEskulForm.addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = new FormData(this);

                fetch("{{ route('saveDataInformasiEkskul') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Eskul berhasil ditambahkan!");
                            location.reload();
                        } else {
                            alert("Terjadi kesalahan, coba lagi.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });

            // Handle submit form edit dengan AJAX
            editEskulForm.addEventListener("submit", function(event) {
                event.preventDefault();
                let formData = new FormData(this);

                fetch("{{ route('saveDataInformasiEkskul') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Eskul berhasil ditambahkan!");
                            location.reload();
                        } else {
                            alert("Terjadi kesalahan, coba lagi.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });


        });
    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnTambahInformasi = document.getElementById("btnTambahInformasi");
            const btnTambahStruktur = document.getElementById("btnTambahStruktur");
            const ModalTambahInformasi = document.getElementById('dataModalTambahInformasi');
            const ModalTambahStruktur = document.getElementById('dataModalTambahStruktur');
            const btnBatalTambahInformasi = document.getElementById("btnBatalTambahInformasi");
            const btnBatalTambahStruktur = document.getElementById("btnBatalTambahStruktur");
            const tambahEskulForm = document.getElementById("tambahEskulForm");
            const editEskulForm = document.getElementById("editEskulForm"); // Pastikan ada di HTML

            // Fungsi untuk membuka modal
            const showModal = (modal) => modal?.classList.remove('hidden');

            // Fungsi untuk menutup modal
            const hideModal = (modal) => modal?.classList.add('hidden');

            // Event untuk membuka modal
            btnTambahStruktur?.addEventListener('click', () => showModal(ModalTambahStruktur));
            btnTambahInformasi?.addEventListener('click', () => showModal(ModalTambahInformasi));

            // Event untuk menutup modal
            btnBatalTambahStruktur?.addEventListener("click", () => hideModal(ModalTambahStruktur));
            btnBatalTambahInformasi?.addEventListener("click", () => hideModal(ModalTambahInformasi));

            // Menutup modal dengan klik di luar modal
            [ModalTambahStruktur, ModalTambahInformasi].forEach(modal => {
                modal?.addEventListener("click", function(event) {
                    if (event.target === modal) {
                        hideModal(modal);
                    }
                });
            });

            // Fungsi untuk submit form via AJAX dengan async/await
            const submitFormInformasi = async (form, route) => {
                form?.addEventListener("submit", async function(event) {
                    event.preventDefault();
                    let formData = new FormData(this);

                    try {
                        let response = await fetch(route, {
                            method: "POST",
                            body: formData,
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    "meta[name='csrf-token']").content
                            }
                        });

                        let data = await response.json();

                        if (data.success) {
                            alert("Data berhasil disimpan!");
                            location.reload();
                        } else {
                            alert("Terjadi kesalahan, coba lagi.");
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        alert("Gagal menghubungi server!");
                    }
                });
            };

            // Fungsi untuk submit form via AJAX dengan async/await
            const submitFormStruktur = async (form, route) => {
                form?.addEventListener("submit", async function(event) {
                    event.preventDefault();
                    let formData = new FormData(this);

                    try {
                        let response = await fetch(route, {
                            method: "POST",
                            body: formData,
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    "meta[name='csrf-token']").content
                            }
                        });

                        let data = await response.json();

                        if (data.success) {
                            alert("Data berhasil disimpan!");
                            location.reload();
                        } else {
                            alert("Terjadi kesalahan, coba lagi.");
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        alert("Gagal menghubungi server!");
                    }
                });
            };

            // Handle form submit
            submitFormInformasi(tambahEskulForm, "{{ route('saveDataInformasiEkskul') }}");
            submitFormInformasi(editEskulForm, "{{ route('saveDataInformasiEkskul') }}"); // Pastikan route benar
        });
    </script>
@endsection
