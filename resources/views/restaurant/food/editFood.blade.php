<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-center font-extrabold text-green-700 leading-tight">
            Food Setting
        </h2>
    </x-slot>
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px] bg-white">
            <form method="POST" action="{{route('restaurant.food.update',$food->id)}}" enctype="multipart/form-data">
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
                        placeholder="Food Name"
                        value="{{$food['name']}}"
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
                        value="{{$food->price}}"
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
                        placeholder="FoodMaterial"
                        value="{{$food->material}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <label
                    for="foodCategories"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                >
                    Food Categories
                </label>
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
                                    <input value="{{$foodCategory->id}}" id="checkbox-item-1" type="checkbox"
                                           name="foodCategory[]"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        {{ $food->foodCategories()->where('food_category_id',$foodCategory->id)->get()->isNotEmpty() ? 'checked' : '' }}>
                                    <label for="checkbox-item-1"
                                           class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$foodCategory->name}}</label>
                                </div>
                            </li>

                        @endforeach
                    </ul>
                </div>
                <div class="mb-7">
                    @if($food->picture)
                        <img src="{{asset($food->picture)}}" class="w-28" alt="">
                    @else
                        <img src="{{asset('storage/images/food-category-icon.png')}}" class="w-28"
                             alt="Doesn't have Picture">
                    @endif
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Upload
                        Food Picture</label>
                    <input
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" type="file" name="picture">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">JPG,PNG(max:2MB)</p>
                </div>
                <div class="mb-3">
                    <label for="discount" class="mb-3 block text-base font-medium text-[#07074D]">Select A Discount For
                        This Food</label>
                    <select name="discount" id="discount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="{{null}}" selected>Without Discount</option>
                        @foreach($discounts as $discount)
                            <option
                                value="{{$discount->id}}" {{$discount->id== $food->discount_id?'selected':''}}>{{$discount->title}}
                                =>({{$discount->percentage}})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button
                        class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                    >
                        Edit Food
                    </button>
                </div>
            </form>
            <form action="{{route('restaurant.food.destroy',$food->id)}}" method="post">
                @csrf
                @method('delete')
                <button type="submit"
                        class="hover:shadow-form w-full rounded-md bg-red-600 mt-4 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                    Delete Food
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
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px] bg-white">
            <h2 class="font-semibold text-2xl text-center font-extrabold text-green-700 leading-tight">
                Food Party
            </h2>
            <form action="{{route('restaurant.foodParty.store')}}" method="post">
                @csrf
                <div class="mb-5">
                    <label
                        for="count"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Count
                    </label>
                    <input
                        type="number"
                        name="count"
                        id="count"
                        min="1"
                        max="10"
                        placeholder="Count"
                        value="{{$food->foodParty->food_count??old('count')}}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <input type="text" name="food_id" hidden value="{{$food->id}}">
                <div class="mb-3">
                    <label for="discount" class="mb-3 block text-base font-medium text-[#07074D]">Select A Discount For
                        This Food</label>
                    <select name="foodPartyDiscount" id="discount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="{{null}}" selected>Without Discount</option>
                        @foreach($discounts as $discount)
                            <option
                                value="{{$discount->id}}" {{ $food->foodParty != null ?$food->foodParty->discount_id == $discount->id?'selected':'':''}}>{{$discount->title}}
                                =>({{$discount->percentage}})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button
                        class="hover:shadow-form w-full rounded-md bg-green-600 py-3 px-8 text-center text-base font-semibold text-white outline-none"
                    >
                        Add to Food Party
                    </button>
                </div>
            </form>
            @if($food->foodParty !== null)
                <form action="{{route('restaurant.foodParty.destroy',$food->foodParty->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit"
                            class="hover:shadow-form w-full rounded-md bg-red-600 mt-4 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Delete Food Party
                    </button>
                </form>
            @endif
        </div>
    </div>


    @if(count($comments=$food->comments)!==0)
        <table class="w-5/6  text-center text-green-800 font-extrabold dark:text-gray-400 mt-3">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
            <tr>
                <th scope="col" class="py-3 px-6 text-xl">Author Name</th>
                <th scope="col" class="py-3 px-6 text-xl">Score</th>
                <th scope="col" class="py-3 px-6 text-xl">Content</th>
                <th scope="col" class="py-3 px-6 text-xl text-left">Answer</th>

            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td class="py-4 px-6 text-xl">
                        <a href="{{route('restaurant.order.show',$comment->order->id)}}">
                            {{$comment->user->name}}
                        </a>
                    </td>
                    <td class="py-4 px-6 text-xl">
                        <a href="{{route('restaurant.order.show',$comment->order->id)}}">
                            {{$comment->score}}
                        </a>
                    </td>
                    <td class="py-4 px-6 text-xl">
                        <a href="{{route('restaurant.order.show',$comment->order->id)}}">
                            {{$comment->content}}
                        </a>
                    </td>

                    <td class="py-4 px-6 text-xl">
                        <form action="{{route('restaurant.comment.answer',$comment->id)}}" method="post" class="flex">
                            @method('patch')
                            @csrf
                            <input
                                type="text"
                                name="answer"
                                id="answer"
                                placeholder="Answer"
                                value="{{$comment->answer}}"
                                class=" rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md mr-2"
                            />
                            <button type="submit"
                                    class="hover:shadow-form mx-auto rounded-md bg-blue-500 py-3 px-2  text-center text-base text-white outline-none">
                                Add
                            </button>
                        </form>
                    </td>
                    @if($comment->status == \App\Models\Comment::ADDED)
                        <td class="py-4 px-6">
                            <form action="{{route('restaurant.comment.accept',$comment->id)}}" method="post">
                                @csrf
                                @method('patch')

                                <button type="submit"
                                        class="hover:shadow-form mx-auto rounded-md bg-green-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                    Accept
                                </button>
                            </form>
                        </td>
                        <td class="py-4 px-6">
                            <form action="{{route('restaurant.comment.delete',$comment->id)}}" method="post">
                                @csrf
                                @method('patch')

                                <button type="submit"
                                        class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                    Delete
                                </button>
                            </form>
                        </td>
                    @endif
                    <td>
                        @if($comment->status == \App\Models\Comment::DELETEREQUEST)
                            <span class="text-red-600">Delete Request Sent</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>There is no Comment to show</p>
    @endif
</x-restaurant-layout>
