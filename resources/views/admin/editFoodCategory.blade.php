<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight text-center">
            Edit Food Category
        </h2>
    </x-slot>
    <div class="flex items-center justify-center p-12">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="mx-auto w-full max-w-[550px] bg-white">
            <form method="POST" action="{{route('admin.foodCategory.update',$foodCategory->id)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-5">
                    <label
                        for="name"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Category Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Category Name"
                        value="{{$foodCategory->name}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-3">
                    <label for="parentCategory" class="mb-3 block text-base font-medium text-[#07074D]">Select your parent Category</label>
                    <select name="parentCategory" id="parentCategory" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="{{null}}">Doesn't have Parent Category</option>
                        @forelse($parentCategories as $parentCategory)
                            @if($parentCategory->id == $foodCategory->id)
                                @continue
                            @endif
                            {{$status = $parentCategory->id == $foodCategory->parent_category ? 'selected':''}}
                            <option value="{{$parentCategory->id}}" {{$status}}>{{$parentCategory->name}}</option>
                        @empty
                            <option value="{{null}}">There isn't any Category yet</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-5">
                    <img src="{{asset($foodCategory->picture)}}" class="w-56" alt="Doesn't have Picture">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload Food Category Picture</label>
                    <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file" name="picture">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">JPG,PNG(max:2MB)</p>
                </div>
                <div>
                    <button
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                    >
                        Create Category
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
</x-admin-layout>
