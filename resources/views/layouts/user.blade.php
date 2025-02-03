<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Kepuasan UNIB</title>
    <link rel="shortcut icon" href="{{ asset('assets/Logo.svg') }}">
    <!-- stylesheets tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- alpine js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&family=Shrikhand&family=Poppins&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body class="  antialiased leading-normal tracking-wide 2xl:text-xl font-nunito    text-slate-900">
    <div id="home"></div>
    <!-- Preloader Start -->
    <div x-data="{ show: false }" x-transition:enter="transition duration-700" style="z-index: 99;"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        class="bg-white rounded p-4" x-show="show">
        <!-- Preloader Start -->
        <div id="loader-wrapper">
            <div id="loader-logo">
                <div id="loader"></div>
            </div>
        </div>
        <!-- Preloader Start -->
    </div>
    <!-- Preloader Start -->
    <!-- navbar  -->
    <nav x-data="{ isOpen: false }" class="  top-0   z-50 w-full     ">
        <div id="navbar"
            class=" px-6 lg:py-4 py-2 mx-auto duration-300  bg-blue-900     ">
            <div class="lg:flex lg:items-center lg:justify-between  ">
                <div class="flex items-center justify-between">
                    <!-- logo -->
                    <a href="/" class="flex items-center text-black   mx-4 md:ml-6">
                        <img src="{{ asset('assets/Logo.svg') }}" alt="logo" class="w-12 h-12">
                        <div class="ml-3  text-white">
                            <p class="font-sans text-gray-100 font-extrabold ">SURVEI KEPUASAN</p>
                            <p class="  -mt-2  text-base">UNIVERSITAS BENGKULU</p>
                        </div>
                    </a>
                </div>
                @yield('back')
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- content -->
    @yield('content')
    <!-- end content -->

    <!-- Footer  -->
    <footer class="relative     ">
        <div
            class="px-12 mx-auto py-4  relative flex flex-wrap flex-col sm:flex-row bg-blue-900  ">
            <p class="text-white  text-sm text-center sm:text-left">Copyright&copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> | Survei Kepuasan
                <a href="#" class="text-yellow-400 font-bold">Universitas
                    Bengkulu</a>. All rights reserved.
            </p>

        </div>
    </footer>
    <!-- end Footer -->
    <!-- back to top  -->
    <div class="" x-data="{ scrollBackTop: false }" x-cloak>
        <svg x-show="scrollBackTop" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            x-on:scroll.window="scrollBackTop = (window.pageYOffset > window.outerHeight * 0.5) ? true : false"
            aria-label="Back to top" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            class="bi bi-arrow-up-circle-fill fixed bottom-0 right-0 mx-3 my-10 h-8 w-8 fill-blue-500 shadow-lg cursor-pointer hover:fill-blue-400 bg-white rounded-full"
            viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
        </svg>
    </div>
</body>
<!-- script -->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/user.js') }}" defer></script>
@stack('scripts')

</html>
