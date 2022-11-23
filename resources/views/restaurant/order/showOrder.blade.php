<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold font-extrabold text-2xl text-green-700 leading-tight text-center">
            Order Information
        </h2>
    </x-slot>
    <h2 class="font-bold text-xl ml-4 text-blue-800">Customer:</h2> <span class="text-blue-900 ml-20 text-lg ">{{$order->user->name}}</span>
    <h2 class="font-bold text-xl ml-4 text-blue-800">Delivered Address: </h2><span class="text-blue-900 ml-20 text-lg ">{{$order->address->address}}</span>
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

                {{--                <a href="{{route('music.edit',$music->id)}}">--}}
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

</x-restaurant-layout>
