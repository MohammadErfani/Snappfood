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
                <div class="flex">
                    @foreach($foodCategories as $foodCategory)
                        <div class="flex items-center mb-4 mr-4 gap-0.5">
                            <input id="foodCategory_{{ $foodCategory->id }}"
                                   type="checkbox"
                                   value="{{ $foodCategory->id }}"
                                   name="foodCategory[]"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300
                                                                focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800
                                                                 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                {{ in_array($foodCategory->id , old('restaurantCategory') ?? []) ? 'checked' : '' }}
                            >
                            <label for="foodCategory_{{ $foodCategory->id }}"
                                   class="ml-2 text-xl font-medium text-gray-900 dark:text-gray-300">{{ $foodCategory->name }}</label>
                            <img src="{{asset($foodCategory->picture)}}" class="w-28 text-xs" alt="Doesn't have Picture">
                        </div>
                    @endforeach
                </div>
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload Food Picture</label>
                    <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file" name="picture">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">JPG,PNG(max:2MB)</p>
                </div>
                <div>
                    <button
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                    >
                        Create Restaurant
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
