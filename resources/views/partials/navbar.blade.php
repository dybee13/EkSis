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
            <div class="hidden absolute mb-6 translate-y-[60px] right-0 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                <div class="px-4 py-3">
                @if (Session::has('user'))
                    <span class="block text-sm text-white">
                        {{ Session::get('user')['name'] }}
                    </span>
                    <span class="block text-sm truncate text-white">
                        {{ Session::get('user')['nis'] }}
                    </span>
                @elseif (!Session::has('user'))
                    <span class="block text-sm text-white">
                        Anonymous
                    </span>
                    <span class="block text-sm truncate text-white">
                        -
                    </span>
                @endif
                </div>
                <ul class="py-2" aria-labelledby="user-menu-button">
                    @if (Session::has('user'))
                        @if (Auth::user()->role === 'pengurus')
                        <li>
                            <a href="/pengurusDashboard" class="block px-4 py-2 text-sm text-white">Dashboard</a>
                        </li>
                        @elseif (Auth::user()->role === 'pembina')
                        <li>
                            <a href="/pembinaDashboard" class="block px-4 py-2 text-sm text-white">Dashboard</a>
                        </li>
                        @endif
                    <li>
                        <a href="/logout" class="block px-4 py-2 text-sm text-white">Keluar</a>
                    </li>
                    @elseif (!Session::has('user'))
                    <li>
                        <a href="/login" class="block px-4 py-2 text-sm text-white">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="/" class="flex items-center gap-2 block py-2 px-3 rounded-sm md:p-0 {{ request()->is('mainEkskul') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10.2 2.4a2.25 2.25 0 0 1 3.6 0l7.5 10A2.25 2.25 0 0 1 19.5 15H18v5.25A2.25 2.25 0 0 1 15.75 22h-2.25a.75.75 0 0 1-.75-.75V16.5a.75.75 0 0 0-.75-.75H12a.75.75 0 0 0-.75.75v4.75a.75.75 0 0 1-.75.75H8.25A2.25 2.25 0 0 1 6 20.25V15H4.5a2.25 2.25 0 0 1-1.8-3.6l7.5-10Z" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <a href="listEkskul" class="flex items-center gap-2 block py-2 px-3 rounded-sm md:p-0 {{ request()->is('listEkskul') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.5 6.75A.75.75 0 0 1 5.25 6h13.5a.75.75 0 0 1 0 1.5H5.25a.75.75 0 0 1-.75-.75ZM4.5 12a.75.75 0 0 1 .75-.75h13.5a.75.75 0 0 1 0 1.5H5.25A.75.75 0 0 1 4.5 12ZM5.25 17.25a.75.75 0 0 0 0 1.5h13.5a.75.75 0 0 0 0-1.5H5.25Z" clip-rule="evenodd" />
                        </svg>
                        Semua Ekstrakurikuler
                    </a>
                </li>
                <li>
                    <a href="semuaBerita" class="flex items-center gap-2 block py-2 px-3 rounded-sm md:p-0 {{ request()->is('semuaBerita') ? 'text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 items-center" viewBox="0 0 512 512">
                            <path d="M368 415.86V72a24.07 24.07 0 00-24-24H72a24.07 24.07 0 00-24 24v352a40.12 40.12 0 0040 40h328" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="16" />
                            <path d="M416 464h0a48 48 0 01-48-48V128h72a24 24 0 0124 24v264a48 48 0 01-48 48z" fill="black" stroke="currentColor" stroke-linejoin="round" stroke-width="16" />
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M240 128h64M240 192h64M112 256h192M112 320h192M112 384h192" />
                            <path d="M176 208h-64a16 16 0 01-16-16v-64a16 16 0 0116-16h64a16 16 0 0116 16v64a16 16 0 01-16 16z" fill="black" />
                        </svg>
                        Semua Berita
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