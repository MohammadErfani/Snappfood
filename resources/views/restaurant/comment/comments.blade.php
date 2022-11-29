<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Orders
        </h2>
    </x-slot>
    <table class="w-5/6  text-center text-green-800 font-extrabold dark:text-gray-400 mt-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
        <tr>
            <th scope="col" class="py-3 px-6 text-xl">Author Name</th>
            <th scope="col" class="py-3 px-6 text-xl">Score</th>
            <th scope="col" class="py-3 px-6 text-xl">Content</th>
            <th scope="col" class="py-3 px-6 text-xl">Answer</th>

        </tr>
        </thead>
        <tbody>
        @forelse($comments as $comment )
            <tr>
                <td class="py-4 px-6 text-xl">
                    {{$comment->user->name}}
                </td>
                <td class="py-4 px-6 text-xl">
                    {{$comment->score}}
                </td>
                <td class="py-4 px-6 text-xl">
                    {{$comment->content}}
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
                <td >
                @if($comment->status == \App\Models\Comment::DELETEREQUEST)
                    <span class="text-red-600">Delete Request Sent</span>
                @endif
                </td>
                {{--                <td class="py-4 px-6 text-xl">--}}
                {{--                    <a href="{{route('restaurant.order.show',$order->id)}}">{{$order->total_price}}</a>--}}
                {{--                </td>--}}
                {{--                @if($order->status === \App\Models\Order::ADDED)--}}

                {{--                                    <td class="py-4 px-6">--}}
                {{--                                        <form action="{{route('restaurant.order.reject',$order->id)}}" method="post">--}}
                {{--                                            @csrf--}}
                {{--                                            @method('patch')--}}

                {{--                                            <button type="submit"--}}
                {{--                                                    class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">--}}
                {{--                                                Reject--}}
                {{--                                            </button>--}}
                {{--                                        </form>--}}
                {{--                                    </td>--}}
                {{--                    <td class="py-4 px-6">--}}
                {{--                        <form action="{{route('restaurant.order.accept',$order->id)}}" method="post">--}}
                {{--                            @csrf--}}
                {{--                            @method('patch')--}}

                {{--                            <button type="submit"--}}
                {{--                                    class="hover:shadow-form mx-auto rounded-md bg-green-500 py-3 px-8 text-center text-base font-semibold text-white outline-none">--}}
                {{--                                Accept--}}
                {{--                            </button>--}}
                {{--                        </form>--}}
                {{--                    </td>--}}
                {{--                @endif--}}
                {{--                @if($order->status === \App\Models\Order::INPROGRESS)--}}
                {{--                    <td class="py-4 px-6">--}}
                {{--                        <form action="{{route('restaurant.order.sending',$order->id)}}" method="post">--}}
                {{--                            @csrf--}}
                {{--                            @method('patch')--}}

                {{--                            <button type="submit"--}}
                {{--                                    class="hover:shadow-form mx-auto rounded-md bg-blue-500 py-3 px-8 text-center text-base font-semibold text-white outline-none">--}}
                {{--                                Sending--}}
                {{--                            </button>--}}
                {{--                        </form>--}}
                {{--                    </td>--}}
                {{--                @endif--}}
                {{--                @if($order->status === \App\Models\Order::SENDING)--}}
                {{--                    <td class="py-4 px-6">--}}
                {{--                        <form action="{{route('restaurant.order.delivered',$order->id)}}" method="post">--}}
                {{--                            @csrf--}}
                {{--                            @method('patch')--}}

                {{--                            <button type="submit"--}}
                {{--                                    class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">--}}
                {{--                                Delivered--}}
                {{--                            </button>--}}
                {{--                        </form>--}}
                {{--                    </td>--}}
                {{--                @endif--}}
                {{--                --}}{{--                </a>--}}

            </tr>
        @empty
            <p>There is no Comment to show</p>
        @endforelse
        </tbody>
    </table>
</x-restaurant-layout>
