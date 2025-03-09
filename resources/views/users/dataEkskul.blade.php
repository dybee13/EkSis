@extends('partials.navbar')

<div class="container min-h-screen bg-gradient-to-b from-white via-blue-300 to-purple-200">
    <div class="m-8 ">
        <div class="flex flex-col items-center justify-center mt-20">
            <img src=".\assets\images\ekskul.png" class="w-24 h-24">
            <p>{{ $ekskul->nama_ekskul }}</p>
        </div>

    </div>

    <div class="w-full min-h-screen">
        <!-- Tabs -->
        <div class="flex space-x-12 gap-40 mb-4 w-full items-center justify-center">
            <button onclick="showTab('announcements')" class="font-bold tab-button text-blue-700" id="btn-announcements">Announcements</button>
            <button onclick="showTab('achievements')" class="font-bold tab-button text-black" id="btn-achievements">Achievements</button>
            <button onclick="showTab('activities')" class="font-bold tab-button text-black" id="btn-acti">Activities</button>
            <button onclick="showTab('struktur')" class="font-bold tab-button text-black" id="btn-struktur">Struktur</button>
        </div>
        <!-- <img src=".\assets\images\ekskul.png" alt="Badminton" class="w-full"> -->
        <!-- Announcements Section -->
        <div id="announcements" class="grid grid-cols-4  gap-4">
            @foreach ($announcements as $announc)
                <div class="border p-6 m-2">{{ $announc->title }}{{ Str::limit($announc->body, 100) }}</div>
            @endforeach
        </div>

        <!-- Achievements Section -->
        <div id="achievements" class="grid grid-cols-4 gap-4 hidden">
            @foreach ($achievments as $achiev)
                <div class="border p-6 m-2">
                @if ($achiev->blogImages->isNotEmpty())
                @php
                    $thumbnail = $achiev->blogImages()->where('is_thumbnail', true)->first() ?? $achiev->blogImages->first();
                @endphp
                @if ($thumbnail)
                <td class="px-4 py-2">
                    <img src="{{ asset('storage/blogs/' . $thumbnail->image_path) }}" class="w-full h-48 object-cover" alt="">
                </td>
                @endif
                @else
                    <td class="px-4 py-2 text-gray-500 italic">Tidak ada gambar</td>
                @endif
                <h3 class="berita-title text-lg font-semibold mt-2">{{ $achiev->title }}</h3>
                <p class="text-gray-600 text-sm mt-1">{{ Str::limit($achiev->body, 60) }}</p>
                </div>
            @endforeach
        </div>

        <!-- Blogs Section -->
        <div id="activities" class="grid grid-cols-4 gap-4 hidden">
            @foreach ($activities as $activ)
                <div class="border p-6 m-2">
                    @if ($activ->blogImages->isNotEmpty())
                    @php
                        $thumbnail = $activ->blogImages()->where('is_thumbnail', true)->first() ?? $activ->blogImages->first();
                    @endphp
                    @if ($thumbnail)
                    <td class="px-4 py-2">
                        <img src="{{ asset('storage/blogs/' . $thumbnail->image_path) }}" class="w-full h-48 object-cover" alt="">
                    </td>
                    @endif
                    @else
                        <td class="px-4 py-2 text-gray-500 italic">Tidak ada gambar</td>
                    @endif
                    <h3 class="berita-title text-lg font-semibold mt-2">{{ $activ->title }}</h3>
                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($activ->body, 60) }}</p>
                </div>
            @endforeach
        </div>

        <!-- Struktur -->
        <div class="grid grid-cols-2 gap-4 hidden" id="struktur">
            <div class="items-start">
                <p class="text-lg font-mono mb-0.5">Ketua : M.Dymas Rafi</p>
                <p class="text-lg font-mono mb-0.5">Jadwal Latihan : Selasa - Jum'at</p>
                <p class="text-lg font-mono mb-0.5">Waktu : 16.00 - 17.00</p>
            </div>
            <div class="items-end">
                <p class="text-lg font-mono mb-0.5 ml-24">Wakil Ketua : Maman</p>
                <p class="text-lg font-mono mb-0.5 ml-24">Bendahara : Halim</p>
                <p class="text-lg font-mono mb-0.5 ml-24">Sekretaris : Jahdan</p>
            </div>
        </div>

    </div>

    <script>
        function showTab(tabName) {
            let sections = ['announcements', 'achievements', 'activities', 'struktur'];
            let buttons = ['btn-announcements', 'btn-achievements', 'btn-acti', 'btn-struktur'];

            sections.forEach(section => {
                document.getElementById(section).classList.add('hidden');
            });

            buttons.forEach(button => {
                document.getElementById(button).classList.remove('text-blue-700');
                document.getElementById(button).classList.add('text-black');
            });

            document.getElementById(tabName).classList.remove('hidden');
            document.getElementById('btn-' + tabName).classList.add('text-blue-700');
        }
    </script>

</div>