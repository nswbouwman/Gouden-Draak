<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/db5e8007c3.js" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="bg-blue-900s p-4 flex justify-between">
            <a href="{{ route('admin.dashboard') }}" class="font-bold">{{ __('admin/navigation.title') }}</a>
            <div>
                <a href="{{ route('admin.menu.index') }}">{{ __('admin/menu.manage-menu') }}</a>
                <a href="{{ route('admin.sales.index') }}" class="ml-12">
                    {{ __('admin/sales.title') }}
                </a>
                <a href="{{ route('logout') }}" class="ml-12">
                    {{ __('admin/navigation.logout') }}
                </a>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </body>
</html>
