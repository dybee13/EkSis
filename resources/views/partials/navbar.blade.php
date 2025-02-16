<script src="https://cdn.tailwindcss.com"></script>

<nav class="bg-white border-gray-200 dark:bg-gray-900 fixed top-0 z-50 w-full md:text-lg">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="./assets/images/ekskul.png" class="h-8" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Sistem Pencatatan Eskul Siswa Digital</span>
        </a>
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="./assets/images/PROFILE.png" alt="user photo">
            </button>
            <!-- Dropdown menu -->
            <div class="hidden absolute mb-6 translate-y-28 right-0 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                <div class="px-4 py-3">
                    <span class="block text-sm text-gray-900 dark:text-white">Anonymous</span>
                    <span class="block text-sm text-gray-500 truncate dark:text-gray-400">NIS</span>
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">Pengaturan</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="/mainEkskul" class="block py-2 px-3 rounded-sm md:p-0 {{ request()->is('mainEkskul') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="listEkskul" class="block py-2 px-3 rounded-sm md:p-0 {{ request()->is('listEkskul') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                        Semua Ekstrakulikuler
                    </a>
                </li>
                <li>
                    <a href="/tentangWebsite" class="block py-2 px-3 rounded-sm md:p-0 {{ request()->is('tentangWebsite') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                        Tentang Website
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Dropdown toggle logic
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    userMenuButton.addEventListener('click', () => {
        userDropdown.classList.toggle('hidden');
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', (e) => {
        if (!userMenuButton.contains(e.target) && !userDropdown.contains(e.target)) {
            userDropdown.classList.add('hidden');
        }
    });

    // Hide dropdown on scroll
    window.addEventListener('scroll', () => {
        userDropdown.classList.add('hidden');
    });
</script>