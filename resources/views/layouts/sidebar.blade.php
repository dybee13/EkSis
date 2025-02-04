 <script src="https://cdn.tailwindcss.com"></script>
 <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
 <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
 </head>

 <body>
     <nav class="fixed top-0 z-50 w-screen bg-gray-800 border-gray-700">
         <div class="px-3 py-3 lg:px-5 lg:pl-3">
             <div class="flex items-center justify-between">
                 <div class="flex items-center justify-start rtl:justify-end">
                     <img src="./assets/images/ekskul.png" class="w-12 h-8" alt="">
                     <a href="#" class="flex ms-2 md:me-24">
                         <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">Sistem Pencatatan Eskul Siswa Digital</span>
                     </a>
                 </div>
                 <div class="flex items-center">
                     <div class="flex items-center ms-3">
                         <div>
                             <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                 <span class="sr-only">Open user menu</span>
                                 <img class="w-8 h-8 rounded-full" src="./assets/images/profile.png" alt="user photo">
                             </button>
                         </div>
                         <div class="z-50 hidden my-4 text-base list-none divide-yrounded-sm shadow-sm bg-gray-700 divide-gray-600" id="dropdown-user">
                             @if(Session::has('user'))
                             <div class="px-4 py-3" role="none">
                                 <p class="text-sm text-white" role="none">
                                     {{ Session::get('user')['name'] }}
                                 </p>
                                 <p class="text-sm font-medium truncate text-gray-300" role="none">
                                     {{ Session::get('user')['email'] }}
                                 </p>
                             </div>
                             @endif
                             <ul class="py-1" role="none">
                                 <li>
                                     <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-white" role="menuitem">Keluar</a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </nav>

     <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full border-r sm:translate-x-0 bg-gray-800 border-gray-700" aria-label="Sidebar">
         <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800">
             <ul class="space-y-2 font-medium">
                 <li>
                     <a href="/" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                         <svg class="w-5 h-5 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                             <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                             <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                         </svg>
                         <span class="ms-3">Dashboard</span>
                     </a>
                 </li>
                 <li>
                     <a href="/daftarEkskul" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                         <svg class="shrink-0 w-5 h-5 transition duration-75 text-gray-400 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                             <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                         </svg>
                         <span class="flex-1 ms-3 whitespace-nowrap">Daftar Ekskul</span>
                     </a>
                 </li>
                 <li>
                     <a href="/pembinaEkskul" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                         <svg class="shrink-0 w-5 h-5transition duration-75 text-gray-400  group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                             <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                         </svg>
                         <span class="flex-1 ms-3 whitespace-nowrap">Daftar Pembina Ekskul</span>
                     </a>
                 </li>
             </ul>
         </div>
     </aside>
     <div class="container">
         @yield('container')
     </div>

 </body>
 <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.1/dist/flowbite.min.js"></script>