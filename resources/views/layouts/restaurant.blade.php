<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Restaurant Panel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- neshan address with leaflet 1.4 with jquery -->

    <link href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css" rel="stylesheet" type="text/css">
    <script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js" type="text/javascript"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <!-- flowbite cdn -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
</head>
<body class="font-sans antialiased">
<div class="min-h-screen ">
@include('layouts.restaurantNavigation')

<!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow flex ">
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
            <div class="overflow-y-auto py-4 px-3 bg-blue-400 text-left  rounded dark:bg-gray-800 ">
                <ul class="space-y-2">
                    <li>
                        <a href="{{route('restaurant.dashboard')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('restaurant.food.create')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Create Food</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('restaurant.food.index')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">List of Foods</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('restaurant.order.archive')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Archive of Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('restaurant.edit')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Restaurant Setting</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('restaurant.comment.index')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Comments</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('restaurant.report.index')}}"
                           class="flex items-center p-4 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                            <span class="flex-1 ml-3 whitespace-nowrap font-extrabold">Sales Report</span>
                        </a>
                    </li>

                </ul>

                @if($a = \Illuminate\Support\Facades\Auth::guard('salesman')->user()->restaurant->picture)
                    <img src="{{asset($a)}}" class="w-52    " alt="da">
                @else
                    <img src="{{asset('storage/images/restaurant-category-icon.png')}}" alt="na">
                @endif
            </div>
        </aside>


    </div>
</div>
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</body>
</html>
