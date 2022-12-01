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
            {{--            <th scope="col" class="py-3 px-6 text-xl">Accept</th>--}}
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
                            href="{{route('restaurant.order.show',$order->id)}}">{{$food->name}} {{$order->foodCounts()[$food->id]}}</a><br>
                    @endforeach
                </td>
            </tr>
        @empty
            <p>There is no Order to show</p>
        @endforelse
        </tbody>
    </table>
</x-restaurant-layout>

