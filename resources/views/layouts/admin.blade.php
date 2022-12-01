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
@include('layouts.adminNavigation')

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
            <div class="overflow-y-auto py-4 px-3 bg-green-400  rounded dark:bg-gray-800 ">
                <ul class="space-y-2">
                    <li>
                        <a href="{{route('admin.dashboard')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('admin.foodCategory.create')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Create Food Category</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.foodCategory.index')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">List Of Food Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.restaurantCategory.create')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Create Restaurant Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.restaurantCategory.index')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">List of Restaurant Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.banner.create')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Create Banner</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.banner.index')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">List of Banners</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.discount.create')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Create Discount</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.discount.index')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">List of Discounts</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.comment.index')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Delete Comment Requests</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>


    </div>
</div>
</body>
</html>
