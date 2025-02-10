@extends('partials.navbar')



<div class="container min-h-screen">
    <div class="m-8">
        <div class="flex items-center justify-center mt-20">
            <img src=".\assets\images\ekskul.png" class="w-24 h-24">
        </div>
        <p class="text-lg font-mono m-1">Pembina : M.Dymas</p>
        <p class="text-lg font-mono m-1">Ketua : M.Dymas</p>
        <p class="text-lg font-mono m-1">Jadwal Latihan : M.Dymas</p>
        <p class="text-lg font-mono m-1">Waktu : M.Dymas</p>
    </div>

    <div class="w-full min-h-screen">
        <!-- Tabs -->
        <div class="flex space-x-4 mb-4 w-full items-center justify-center">
            <button onclick="showTab('announcements')" class="font-bold tab-button text-blue-700" id="btn-announcements">Announcements</button>
            <button onclick="showTab('achievements')" class="font-bold tab-button text-black" id="btn-achievements">Achievements</button>
            <button onclick="showTab('blogs')" class="font-bold tab-button text-black" id="btn-blogs">Blogs</button>
        </div>

        <!-- Announcements Section -->
        <div id="announcements" class="grid grid-cols-4  gap-4">
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Badminton" class="w-full"></div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Badminton" class="w-full"></div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Badminton" class="w-full"></div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Badminton" class="w-full"></div>
        </div>

        <!-- Achievements Section -->
        <div id="achievements" class="grid grid-cols-4 gap-4 hidden">
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Trophy" class="w-full"></div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Trophy" class="w-full"></div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Trophy" class="w-full"></div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Trophy" class="w-full"></div>
        </div>

        <!-- Blogs Section -->
        <div id="blogs" class="grid grid-cols-4 gap-4 hidden">
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Writing" class="w-full"></div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Writing" class="w-full"></div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Writing" class="w-full"></div>
            <div class="border p-6 m-2"><img src=".\assets\images\ekskul.png" alt="Writing" class="w-full"></div>
        </div>

    </div>

    <script>
        function showTab(tabName) {
            let sections = ['announcements', 'achievements', 'blogs'];
            let buttons = ['btn-announcements', 'btn-achievements', 'btn-blogs'];

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

@extends('partials.footer')