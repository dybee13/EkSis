@extends('layouts.main')
@extends('partials.navbar')
@section('container')

<div class="w-screen min-h-screen bg-gradient-to-b from-white via-blue-300 to-purple-200 overflow-x-hidden">
    <div class="m-8">
        <div class="flex flex-col items-center justify-center mt-20">
            @php
                $logo = optional($ekskul->informasiEkskul)->logo ?? 'images/ekstrakulikuler/default.png';
            @endphp
            <img src="{{ asset('storage/' . $logo) }}" class="w-24 h-24">
            <p>{{ $ekskul->nama_ekskul }}</p>
        </div>
    </div>

    <div class="w-full min-h-screen">
        <!-- Tabs -->
        <div class="flex space-x-6 mb-4 w-full items-center justify-center">
            <button onclick="showTab('announcements')" class="font-bold tab-button text-blue-700" id="btn-announcements">Announcements</button>
            <button onclick="showTab('achievements')" class="font-bold tab-button text-black" id="btn-achievements">Achievements</button>
            <button onclick="showTab('activities')" class="font-bold tab-button text-black" id="btn-activities">Activities</button>
            <button onclick="showTab('struktur')" class="font-bold tab-button text-black" id="btn-struktur">Struktur</button>
        </div>

        <!-- Announcements Section -->
        <div id="announcements" class="grid grid-cols-4 gap-4 px-4">
            @if ($announcements->isNotEmpty())
                @foreach ($announcements as $announc)
                    <div class="border p-6">{{ $announc->title }}{{ Str::limit($announc->body, 100) }}</div>
                @endforeach
            @else
                <h1 class="text-center">Belum Memiliki Berita</h1>
            @endif
        </div>

        <!-- Achievements Section -->
        <div id="achievements" class="grid grid-cols-4 gap-4 px-4 hidden">
            @if ($achievments->isNotEmpty())
                @foreach ($achievments as $achiev)
                    <div class="border p-6">
                        @if ($achiev->blogImages->isNotEmpty())
                            @php
                                $thumbnail = $achiev->blogImages()->where('is_thumbnail', true)->first() ?? $achiev->blogImages->first();
                            @endphp
                            @if ($thumbnail)
                                <img src="{{ asset('storage/blogs/' . $thumbnail->image_path) }}" class="w-full h-48 object-cover" alt="">
                            @endif
                        @else
                            <p class="text-gray-500 italic">Tidak ada gambar</p>
                        @endif
                        <h3 class="berita-title text-lg font-semibold mt-2">{{ $achiev->title }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($achiev->body, 60) }}</p>
                    </div>
                @endforeach
            @else
                <h1 class="text-center">Belum Memiliki Berita</h1>
            @endif
        </div>

        <!-- Blogs Section -->
        <div id="activities" class="grid grid-cols-4 gap-4 px-4 hidden">
            @if ($activities->isNotEmpty())
                @foreach ($activities as $activ)
                    <div class="border p-6">
                        @if ($activ->blogImages->isNotEmpty())
                            @php
                                $thumbnail = $activ->blogImages()->where('is_thumbnail', true)->first() ?? $activ->blogImages->first();
                            @endphp
                            @if ($thumbnail)
                                <img src="{{ asset('storage/blogs/' . $thumbnail->image_path) }}" class="w-full h-48 object-cover" alt="">
                            @endif
                        @else
                            <p class="text-gray-500 italic">Tidak ada gambar</p>
                        @endif
                        <h3 class="berita-title text-lg font-semibold mt-2">{{ $activ->title }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($activ->body, 60) }}</p>
                    </div>
                @endforeach
            @else
                <h1 class="text-center">Belum Memiliki Berita</h1>
            @endif
        </div>

        <!-- Struktur -->
        <div class="grid grid-cols-2 gap-4 px-4 hidden" id="struktur">
            <div>
            @foreach ($pembina as $p)
                <p class="text-lg font-mono mb-0.5">Pembina : {{ $p->name ?? ' - ' }}</p>
            @endforeach
                <p class="text-lg font-mono mb-0.5">Jadwal Latihan : {{ $ekskul->informasiEkskul->jadwal ?? ' - ' }}</p>
                <p class="text-lg font-mono mb-0.5">Slogan : {{ $ekskul->informasiEkskul->deskripsi ?? ' - ' }}</p>
            </div>
            <div>
                <p class="text-lg font-mono mb-0.5">Ketua : {{ $ekskul->strukturEkskul->ketua_ekskul ?? ' - ' }}</p>
                <p class="text-lg font-mono mb-0.5">Wakil Ketua : {{ $ekskul->strukturEkskul->waketu_ekskul ?? ' - ' }}</p>
                <p class="text-lg font-mono mb-0.5">Bendahara : {{ $ekskul->strukturEkskul->bendahara ?? ' - ' }}</p>
                <p class="text-lg font-mono mb-0.5">Sekretaris : {{ $ekskul->strukturEkskul->sekretaris ?? ' - ' }}</p>
            </div>
        </div>
    </div>
</div>

<script>
    function showTab(tabName) {
        let sections = ['announcements', 'achievements', 'activities', 'struktur'];
        let buttons = ['btn-announcements', 'btn-achievements', 'btn-activities', 'btn-struktur'];

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

@endsection