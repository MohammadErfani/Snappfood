<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Orders
        </h2>
    </x-slot>
    <table class="w-5/6  text-left text-green-800 font-extrabold dark:text-gray-400 mt-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6 text-xl">Food with count</th>
            <th scope="col" class="py-3 px-6 text-xl">Order Price</th>
            {{--            <th scope="col" class="py-3 px-6 text-xl">Deny</th>--}}
            {{--            <th scope="col" class="py-3 px-6 text-xl">Send</th>--}}
            {{--            <th scope="col" class="py-3 px-6 text-xl">Delivered</th>--}}


        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order )
            <tr>
                <td class="py-4 px-6 text-xl">
                    @foreach($order->foods as $food)
                        {{--                <a href="{{route('music.edit',$music->id)}}">--}}
                        <a
                            href="{{route('restaurant.order.show',$order->id)}}">{{$food->name}} {{$order->foodCounts()[$food->id]}}</a>
                        <br>
                    @endforeach
                </td>
                <td class="py-4 px-6 text-xl">
                    <a href="{{route('restaurant.order.show',$order->id)}}">{{$order->total_price}}</a>
                </td>
            @if($order->status === \App\Models\Order::ADDED)

                    <td class="py-4 px-6">
                        <form action="{{route('restaurant.order.reject',$order->id)}}" method="post">
                            @csrf
                            @method('patch')

                            <button type="submit"
                                    class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                Reject
                            </button>
                        </form>
                    </td>
                    <td class="py-4 px-6">
                        <form action="{{route('restaurant.order.accept',$order->id)}}" method="post">
                            @csrf
                            @method('patch')

                            <button type="submit"
                                    class="hover:shadow-form mx-auto rounded-md bg-green-500 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                Accept
                            </button>
                        </form>
                    </td>
                @endif
                @if($order->status === \App\Models\Order::INPROGRESS)
                    <td class="py-4 px-6">
                        <form action="{{route('restaurant.order.sending',$order->id)}}" method="post">
                            @csrf
                            @method('patch')

                            <button type="submit"
                                    class="hover:shadow-form mx-auto rounded-md bg-blue-500 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                Sending
                            </button>
                        </form>
                    </td>
                @endif
                @if($order->status === \App\Models\Order::SENDING)
                    <td class="py-4 px-6">
                        <form action="{{route('restaurant.order.delivered',$order->id)}}" method="post">
                            @csrf
                            @method('patch')

                            <button type="submit"
                                    class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                Delivered
                            </button>
                        </form>
                    </td>
                @endif
                {{--                </a>--}}

            </tr>
        @empty
            <p>There is no Order to show</p>
        @endforelse
        </tbody>
    </table>
</x-restaurant-layout>
