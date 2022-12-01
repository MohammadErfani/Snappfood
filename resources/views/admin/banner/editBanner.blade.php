<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight text-center">
            Edit Banner
        </h2>
    </x-slot>
    <div class="flex items-center justify-center p-12">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="mx-auto w-full max-w-[550px] bg-white">
            <form method="POST" action="{{route('admin.banner.update',$banner->id)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-5">
                    <label
                        for="name"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Banner Title
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        placeholder="Banner Title"
                        value="{{$banner->title}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                        <img src="{{asset($banner->picture)}}" class="w-28" alt="">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload Food Category Picture</label>
                    <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file" name="picture">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">JPG,PNG(max:2MB)</p>
                </div>
                <div>
                    <button
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                    >
                        Edit Banner
                    </button>
                </div>
            </form>

            <div class="mt-3">
                <form action="{{route('admin.banner.destroy',$banner->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit"
                            class="hover:shadow-form w-full rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Delete
                    </button>
                </form>
            </div>
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
