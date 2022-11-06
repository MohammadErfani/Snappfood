<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-center font-extrabold text-green-700 leading-tight">
            Create Food
        </h2>
    </x-slot>
    <div class="flex items-center justify-center p-12">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="mx-auto w-full max-w-[550px] bg-white">
            <h1 class=" text-center text-3xl mb-6">Create Food</h1>
            <form method="POST" action="{{route('restaurant.food.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label
                        for="name"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Food Name"
                        value="{{old('name')}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="price"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Price
                    </label>
                    <input
                        type="number"
                        name="price"
                        id="price"
                        placeholder="Food Price"
                        value="{{old('price')}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="material"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Material
                    </label>
                    <input
                        type="text"
                        name="material"
                        id="material"
                        placeholder="Food Material"
                        value="{{old('material')}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <label
                    for="restaurantCategories"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                >
                    Food Categories
                </label>
                {{--                <div class="flex">--}}
{{--                @foreach($foodCategories as $foodCategory)--}}
                    {{--                        <div class="flex items-center mb-4  ">--}}
                    {{--                            <input id="foodCategory_{{ $foodCategory->id }}"--}}
                    {{--                                   type="checkbox"--}}
                    {{--                                   value="{{ $foodCategory->id }}"--}}
                    {{--                                   name="foodCategory[]"--}}
                    {{--                                   class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300--}}
                    {{--                                                                focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800--}}
                    {{--                                                                 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"--}}
                    {{--                                {{ in_array($foodCategory->id , old('restaurantCategory') ?? []) ? 'checked' : '' }}--}}
                    {{--                            >--}}
                    {{--                            <label for="foodCategory_{{ $foodCategory->id }}"--}}
                    {{--                                   class="ml-2 text-xl font-medium text-gray-900 dark:text-gray-300 w-36">{{ $foodCategory->name }}</label>--}}
                    {{--                            <img src="{{asset($foodCategory->picture)}}" class="w-28 text-xs " alt="Doesn't have Picture">--}}
                    {{--                        </div>--}}
                    {{--                    @endforeach--}}
                    {{--                </div>--}}

                    <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Food Category
                        <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownBgHover" class="hidden z-10 w-48 bg-white rounded shadow dark:bg-gray-700"
                         data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                         style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 381px);">
                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownBgHoverButton">
                            @foreach($foodCategories as $foodCategory)
                                <li>
                                    <div class="flex items-center">
                                        <input value="{{$foodCategory->id}}" id="checkbox-item-1" type="checkbox" name="foodCategory[]" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="checkbox-item-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$foodCategory->name}}</label>
                                    </div>
                                </li>

                            @endforeach
                        </ul>
                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload
                            Food Picture</label>
                        <input
                            class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" type="file" name="picture">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">
                            JPG,PNG(max:2MB)</p>
                    </div>
                    <div>
                        <button
                            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                        >
                            Create Food
                        </button>
                    </div>
            </form>


            @if ($errors->any())
                <div class="mt-3 bg-red-50 border border-red-500 text-red-900  text-sm rounded-lg ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</x-restaurant-layout>
