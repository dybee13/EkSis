@extends('partials.navbar')

<div class="container min-h-screen bg-gradient-to-b from-white via-blue-300 to-purple-200">
    <div class="m-8 ">
        <div class="flex items-center justify-center mt-20">
            <img src=".\assets\images\ekskul.png" class="w-24 h-24">
        </div>

    </div>

    <div class="w-full min-h-screen">
        <!-- Tabs -->
        <div class="flex space-x-12 gap-40 mb-4 w-full items-center justify-center">
            <button onclick="showTab('announcements')" class="font-bold tab-button text-blue-700" id="btn-announcements">Announcements</button>
            <button onclick="showTab('achievements')" class="font-bold tab-button text-black" id="btn-achievements">Achievements</button>
            <button onclick="showTab('blogs')" class="font-bold tab-button text-black" id="btn-blogs">Blogs</button>
            <button onclick="showTab('struktur')" class="font-bold tab-button text-black" id="btn-struktur">Struktur</button>
        </div>
        <!-- <img src=".\assets\images\ekskul.png" alt="Badminton" class="w-full"> -->
        <!-- Announcements Section -->
        <div id="announcements" class="grid grid-cols-4  gap-4">
            <div class="border p-6 m-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
            <div class="border p-6 m-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed, fugit?</div>
            <div class="border p-6 m-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni aliquam est facere.</div>
            <div class="border p-6 m-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni omnis pariatur molestiae nobis a voluptatum mollitia, debitis hic ullam ducimus.</div>
        </div>

        <!-- Achievements Section -->
        <div id="achievements" class="grid grid-cols-4 gap-4 hidden">
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Trophy" class="w-full">Lorem ipsum dolor sit amet.</div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Trophy" class="w-full">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, cupiditate.</div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Trophy" class="w-full">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, autem! In explicabo quaerat omnis autem?</div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Trophy" class="w-full">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae neque quibusdam temporibus illo adipisci necessitatibus. Dolores perferendis delectus rem dolor.</div>
        </div>

        <!-- Blogs Section -->
        <div id="blogs" class="grid grid-cols-4 gap-4 hidden">
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Writing" class="w-full">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat consequuntur odit reiciendis vero, perferendis voluptatem.</div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Writing" class="w-full">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi autem facere veritatis molestiae dolorum consectetur error facilis debitis odit illo!</div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Writing" class="w-full">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum, aspernatur exercitationem doloremque odio dignissimos consequatur animi non voluptates officiis aliquam sunt beatae assumenda voluptatem soluta!</div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Writing" class="w-full">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, corporis a atque obcaecati officiis explicabo reiciendis in nostrum culpa nam exercitationem tempore iure consequuntur aut saepe, eius beatae consectetur ducimus?</div>
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
            let sections = ['announcements', 'achievements', 'blogs', 'struktur'];
            let buttons = ['btn-announcements', 'btn-achievements', 'btn-blogs', 'btn-struktur'];

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