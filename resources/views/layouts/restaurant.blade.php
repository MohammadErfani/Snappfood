<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen ">
@include('layouts.restaurantNavigation')

<!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
    <div class="flex ">
        <!-- Page Content -->
        <main class="w-5/6">
            {{ $slot }}
        </main>
        <aside class="w-64  right h-screen  sticky top-0  " aria-label="Sidebar">
            <div class="overflow-y-auto py-4 px-3 bg-blue-400   rounded dark:bg-gray-800 ">
                <ul class="space-y-2">
                    <li>
                        <a href="{{route('restaurant.dashboard')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="ml-3 font-extrabold">داشبورد</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('restaurant.food.create')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">ساخت غذا</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('restaurant.food.index')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">لیست غذاها</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">آرشیو سفارش ها</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('restaurant.edit')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">تنظیمات رستوران</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">نظرات</span>
                        </a>
                    </li>

                </ul>
                <div class="h-28"></div>
            </div>
        </aside>


    </div>
</div>
</body>
</html>
