<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ secure_asset('css/app.css') }} " rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js"
        integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="logo icon" type="png" href="{{ secure_asset('/images/Logo-icon.png') }}" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  
    <style>
        @font-face {
            font-family: Vimala;
            src: url('{{ secure_asset('/font/Vimala.ttf') }}');
        }

    </style>
    <title>{{ $title }}</title>
    @yield('head')
</head>

<body class="bg-gray-50"style="font-family: Poppins;">
    {{-- Navbar --}}
    <div class="fixed w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800 z-50 shadow-md h-14">
        <div class="w-full bg-white">
            <div x-data="{ open: false }"
                class="flex flex-col mx-auto md:items-center md:justify-between md:flex-row w-11/12 lg:w-10/12 laptopl:w-9/12">
                <div class="py-3 flex flex-row items-center justify-between">
                    <a href="/">
                        <img class="w-28" src="{{ asset('/images/Logo.png') }}" alt="Sibali Logo"></a>
                    <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                            <path x-show="!open" fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                            <path x-show="open" fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <nav :class="{'flex': open, 'hidden': !open}"
                    class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
                    <a class="px-4 py-2 mt-2 text-sm  bg-transparent rounded-lg  md:mt-0 md:ml-4 text-gray-600 hover:text-bali-600  {{ $title === 'Beranda' ? 'text-bali-300 font-extrabold' : '' }}"
                        href="/">Beranda</a>
                    {{-- dropdown alpine --}}
                    {{-- <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-white focus:text-white hover:bg-red-500 focus:bg-red-500 focus:outline-none focus:shadow-outline">
                        <span>Kerja Kami</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                            class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-white focus:text-white hover:bg-red-500 focus:bg-red-500 focus:outline-none focus:shadow-outline"
                                href="/kerjakami-tk.php">Taman Kanak - Kanak</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-white focus:text-white hover:bg-red-500 focus:bg-red-500 focus:outline-none focus:shadow-outline"
                                href="/kerjakami-sd.php">Sekolah Dasar</a>
                        </div>
                    </div>
                </div> --}}
                    <a class="pl-4 py-2 mt-2 text-sm bg-transparent rounded-lg md:mt-0 md:ml-4 text-gray-600 hover:text-bali-300  {{ $title === 'Penjelajahan' ? 'text-bali-300 font-extrabold' : '' }}"
                        href="/penjelajahan">Penjelajahan</a>
                    <a class="pl-4 py-2 mt-2 text-sm  bg-transparent rounded-lg md:mt-0 md:ml-4 text-gray-600 hover:text-bali-300 {{ $title === 'Pencarian' ? 'text-bali-300  font-extrabold' : '' }}"
                        href="/pencarian">Pencarian</a>
                    <a class="pl-4 py-2 mt-2 text-sm  bg-transparent rounded-lg md:mt-0 md:ml-4 text-gray-600 hover:text-bali-300 {{ $title === 'Lawan Kata' ? 'text-bali-300 font-extrabold' : '' }}"
                        href="/lawankata">Lawan Kata</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="h-14">
    </div>
    <div class="bg-gray-50">
        @yield('content')
    </div>
    @yield('script')
    <script>
        AOS.init({
            once: true
        });
    </script>
</body>

</html>
