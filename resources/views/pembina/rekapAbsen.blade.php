@extends('layouts.main')

@section('container')
<div class="container mx-auto p-6 w-5xl pt-20 pl-72">
    <h2 class="text-2xl font-bold mb-4">Rekap Absen Anggota Ekskul</h2>

    <!-- Tombol untuk setiap tanggal -->
    <div class="w-5xl flex-wrap gap-2 mb-4">
        @foreach ($rekapAbsen as $tanggal => $absenGroup)
            <button onclick="showAbsen('{{ $tanggal }}', this)" 
                class="w-full h-[60px] px-4 py-2 mb-4 bg-gray-400 text-white rounded hover:bg-gray-500">
                {{ $tanggal }}
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates esse quo fugiat ullam consequuntur, nisi quod repudiandae, modi fuga nihil molestias quia autem ipsa aspernatur hic exercitationem unde distinctio, architecto veritatis! Explicabo corporis ipsa officiis nobis fugiat eius aliquam doloribus blanditiis similique, libero quaerat veniam aliquid eligendi? Rerum iure, commodi veniam eius ex quibusdam inventore voluptatem optio cum quaerat numquam praesentium est facere unde doloremque atque ipsa doloribus dignissimos! Natus et possimus repudiandae consequuntur aliquam accusamus impedit illum quis facere quas blanditiis asperiores laboriosam velit voluptas similique tenetur, vitae enim illo. Quasi unde repellat, alias dolores quidem magnam debitis explicabo corporis! Hic tempore, itaque ex laboriosam eos debitis ipsum cumque corrupti officia impedit soluta iste dolorem voluptas doloribus ea facilis rem sapiente repellat adipisci quis mollitia eveniet! Temporibus obcaecati praesentium voluptatibus illo pariatur ad ut voluptatem necessitatibus asperiores, eos impedit?
            </button>

            <!-- Template tabel tersembunyi -->
            <div id="template-absen-{{ $tanggal }}" class="hidden">
                <h3 class="text-lg font-semibold mt-4 mb-2">Absen Tanggal: {{ $tanggal }}</h3>
                
                <!-- Filter Status (Frontend) -->
                <div class="mb-3">
                    <button onclick="filterStatus('{{ $tanggal }}', '')"
                        class="px-2 py-1 rounded bg-gray-300 hover:bg-gray-400 text-black text-sm">Semua</button>
                    <button onclick="filterStatus('{{ $tanggal }}', 'hadir')"
                        class="px-2 py-1 rounded bg-green-200 hover:bg-green-300 text-green-700 text-sm">Hadir</button>
                    <button onclick="filterStatus('{{ $tanggal }}', 'izin')"
                        class="px-2 py-1 rounded bg-yellow-200 hover:bg-yellow-300 text-yellow-700 text-sm">Izin</button>
                    <button onclick="filterStatus('{{ $tanggal }}', 'sakit')"
                        class="px-2 py-1 rounded bg-blue-200 hover:bg-blue-300 text-blue-700 text-sm">Sakit</button>
                    <button onclick="filterStatus('{{ $tanggal }}', 'alpha')"
                        class="px-2 py-1 rounded bg-red-200 hover:bg-red-300 text-red-700 text-sm">Alpha</button>
                </div>

                <table class="w-[900px] border-collapse border border-gray-300 mb-4">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">NIS</th>
                            <th class="border border-gray-300 p-2">Nama Anggota</th>
                            <th class="border border-gray-300 p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody id="absen-body-{{ $tanggal }}">
                        @foreach ($absenGroup as $absen)
                        <tr class="absen-row" data-status="{{ strtolower($absen->status) }}">
                            <td class="border border-gray-300 p-2">{{ $absen->anggota->nis }}</td>
                            <td class="border border-gray-300 p-2">{{ $absen->anggota->name }}</td>
                            <td class="border border-gray-300 p-2">
                                <span class="px-2 py-1 rounded 
                                    @if ($absen->status == 'hadir') bg-green-200 text-green-700
                                    @elseif ($absen->status == 'izin') bg-yellow-200 text-yellow-700
                                    @elseif ($absen->status == 'sakit') bg-blue-200 text-blue-700
                                    @else bg-red-200 text-red-700 @endif">
                                    {{ ucfirst($absen->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>

<script>
    function showAbsen(tanggal, button) {
        document.querySelectorAll('.absen-table').forEach(table => table.remove());

        let existingTable = document.getElementById('absen-' + tanggal);
        if (existingTable) {
            existingTable.remove();
            return;
        }

        let table = document.createElement('div');
        table.innerHTML = document.getElementById('template-absen-' + tanggal).innerHTML;
        table.classList.remove('hidden');
        table.id = 'absen-' + tanggal;

        button.insertAdjacentElement('afterend', table);
    }

    function filterStatus(tanggal, status) {
        const rows = document.querySelectorAll(`#absen-body-${tanggal} .absen-row`);
        rows.forEach(row => {
            if (status === "" || row.getAttribute("data-status") === status) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>
@endsection