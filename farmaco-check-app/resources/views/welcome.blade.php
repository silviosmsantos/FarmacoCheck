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

        <div class="grid grid-cols-[1fr_1fr] gap-16 flex-1 items-center justify-center">

            <div class=" flex justify-center items-center h-screen w-full">
                <img src ='capa.jpg' class="object-cover h-full !w-full "/>
            </div>
            <div class="flex  h-screen items-center justify-center">
                <div class="text-center">
                    <x-application-logo-text class="w-80 h-auto fill-current text-teal-600 mb-8" />
                    <x-button primary xl href="{{ route('login') }}" class="px-8 py-4 text-lg">
                        <strong>Conheça Agora</strong>
                    </x-button>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
