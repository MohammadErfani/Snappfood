<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-center font-extrabold text-green-700 leading-tight">
            Restaurant Setting
        </h2>
    </x-slot>
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px] bg-white">
            <form method="POST" action="{{route('restaurant.update')}}" enctype="multipart/form-data">
                @csrf
                @method('put')
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
                        placeholder="Restaurant Name"
                        value="{{$restaurant['name']}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="phone"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Phone
                    </label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        placeholder="Restaurant Phone"
                        value="{{$restaurant->phone}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="bankAccount"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Bank Account
                    </label>
                    <input
                        type="text"
                        name="bankAccount"
                        id="bankAccount"
                        placeholder="Restaurant BankAccount"
                        value="{{$restaurant->bank_account}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <label
                    for="restaurantCategories"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                >
                    Restaurant Categories
                </label>
                <div class="flex">
                    @foreach($restaurantCategories as $restaurantCategory)
                        <div class="flex items-center mb-4 mr-4 gap-0.5">
                            <input id="$restaurantCategory_{{ $restaurantCategory->id }}"
                                   type="checkbox"
                                   value="{{ $restaurantCategory->id }}"
                                   name="restaurantCategory[]"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300
                                                                focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800
                                                                 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                {{ $restaurant->restaurantCategories()->where('restaurant_category_id',$restaurantCategory->id)->get()->isNotEmpty() ? 'checked' : '' }}
                            >
                            <label for="service_{{ $restaurantCategory->id }}"
                                   class="ml-2 text-xl font-medium text-gray-900 dark:text-gray-300">{{ $restaurantCategory->name }}</label>
                            <img src="{{asset($restaurantCategory->picture)}}" class="w-28" alt="Doesn't have Picture">
                        </div>
                    @endforeach
                </div>
                <div class="mb-7">
                    <img src="{{asset($restaurant->picture)}}" class="w-56 text-xs" alt="Doesn't have Picture">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload Restaurant Picture</label>
                    <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file" name="picture">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">JPG,PNG(max:2MB)</p>
                </div>
                <div>
                    <button
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                    >
                        Edit Restaurant
                    </button>
                </div>
            </form>
            <form action="{{route('restaurant.destroy')}}" method="post">
                @csrf
                @method('delete')
                <button type="submit"
                        class="hover:shadow-form w-full rounded-md bg-red-600 mt-4 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                    Delete Restaurant
                </button>
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
