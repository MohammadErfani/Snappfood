<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold font-extrabold text-2xl text-green-700 leading-tight text-center">
            Order Information
        </h2>
    </x-slot>
    <h2 class="font-bold text-xl ml-4 text-blue-800">Customer:</h2> <span class="text-blue-900 ml-20 text-lg ">{{$order->user->name}}</span>
    <h2 class="font-bold text-xl ml-4 text-blue-800">Delivered Address: </h2><span class="text-blue-900 ml-20 text-lg ">{{$order->address->address}}</span>
    <h2 class="font-bold text-xl ml-4 text-blue-800">Order Price: </h2><span class="text-blue-900 ml-20 text-lg ">{{$order->total_price}}</span>
    <table class="w-5/6  text-left text-green-800 font-extrabold dark:text-gray-400 mt-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6 text-xl">Picture</th>
            <th scope="col" class="py-3 px-6 text-xl"> Name</th>
            <th scope="col" class="py-3 px-6 text-xl"> Material</th>
        </tr>
        </thead>
        <tbody>
        @forelse($order->foods as $food )
            <tr>

                <td class="py-4 px-6"><a href="{{route('restaurant.food.edit',$food->id)}}">
                        @if($food->picture)
                            <img src="{{asset($food->picture)}}" class="w-28" alt="">
                        @else
                            <img src="{{asset('storage/images/food-category-icon.png')}}" class="w-28"
                                 alt="Doesn't have Picture">
                        @endif
                    </a></td>
                <td class="py-4 px-6 text-xl"><a
                        href="{{route('restaurant.food.edit',$food->id)}}">{{$food->name}}</a></td>
                <td class="py-4 px-6 text-xl"><a
                        href="{{route('restaurant.food.edit',$food->id)}}">{{$food->material}}</a></td>
            </tr>
        @empty
            <p>There is no Food  to show</p>
        @endforelse
        </tbody>
    </table>
       @if(!empty($comment=$order->comment))
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
        </tbody>
    </table>
       @else
            <p>There is no Comment to show</p>
       @endif

</x-restaurant-layout>
