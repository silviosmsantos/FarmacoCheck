<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FarmacoCheck</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 min-h-screen flex flex-col">
        <div class="absolute top-4 right-6">
            @if (Route::has('login'))
            <livewire:welcome.navigation />
            @endif
        </div>

        <div class="grid grid-cols-[1fr_1fr] md  gap-4 flex-1 items-center justify-center grid-welcome">

            <div class=" flex justify-center items-center h-screen w-full image-wrapper ">
                <img src='capa.jpg' class="object-cover h-full !w-full " />
            </div>
            <div class="flex  h-screen items-center justify-center">
                <div class="flex gap-4 flex-col items-center justify-center">
                    <x-application-logo-text class="w-80 h-auto fill-current text-teal-600 " />
                    <div class="flex gap-2 flex-col max-w-[500px] items-center text-center">
                        <h1 class="font-bold text-lg text-neutral-800">
                            Bem-vindo ao FarmacoCheck!
                        </h1>
                        <p class="font-normal text-base text-neutral-600">Verifique possíveis interações entre medicamentos de forma rápida e confiável. Mais segurança para suas decisões clínicas!</p>
                    </div>
                    <x-button primary xl href="{{ route('login') }}" class="px-8 py-4 text-lg mt-6">
                        <strong>Conheça Agora</strong>
                    </x-button>

                    <footer class=" dark:bg-gray-800 mt-20">
                        <div class="w-full max-w-screen-xl mx-auto text-center">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                © 2023 
                                <a href="https://github.com/silviosmsantos/FarmacoCheck" class="hover:underline">FarmacoCheck™</a>. 
                                All Rights Reserved.
                            </span>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</body>

</html>