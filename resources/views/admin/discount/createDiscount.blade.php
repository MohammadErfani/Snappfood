<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight text-center">
            Create Discount
        </h2>
    </x-slot>
    <div class="flex items-center justify-center p-12">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="mx-auto w-full max-w-[550px] bg-white">
            <form method="POST" action="{{route('admin.discount.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label
                        for="title"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Discount Title
                    </label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        placeholder="Discount Title"
                        value="{{old('title')}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="percentage"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Discount Percentage
                    </label>
                    <input
                        type="text"
                        name="percentage"
                        id="percentage"
                        placeholder="Discount Percentage"
                        value="{{old('percentage')}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div>
                    <button
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                    >
                        Create Discount
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
