<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold font-extrabold text-2xl text-green-700 leading-tight text-center">
            All The Food
        </h2>
    </x-slot>
    <table class="w-5/6  text-left text-green-800 font-extrabold dark:text-gray-400 mt-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6 text-xl">Picture</th>
            <th scope="col" class="py-3 px-6 text-xl">Food Name</th>
            <th scope="col" class="py-3 px-6 text-xl">Food Material</th>
            <th scope="col" class="py-3 px-6 text-xl">Food Price</th>

        </tr>
        </thead>
        <tbody>
        @forelse($foods as $food )
            <tr>

                {{--                <a href="{{route('music.edit',$music->id)}}">--}}
                <td class="py-4 px-6"><a href="{{route('restaurant.food.edit',$food->id)}}">
                        <img src="{{asset($food->picture)}}" class="w-56" alt="Doesn't have Picture"></a></td>
                <td class="py-4 px-6 text-xl"><a
                        href="{{route('restaurant.food.edit',$food->id)}}">{{$food->name}}</a></td>
                <td class="py-4 px-6 text-xl"><a
                        href="{{route('restaurant.food.edit',$food->id)}}">{{$food->material}}</a></td>
                <td class="py-4 px-6 text-xl"><a
                        href="{{route('restaurant.food.edit',$food->id)}}">{{$food->price}}</a></td>
                <td class="py-4 px-6">
                    <form action="{{route('restaurant.food.destroy',$food->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{$food->id}}" name="id">
                        <button type="submit"
                                class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Delete
                        </button>
                    </form>

                </td>
                {{--                </a>--}}

            </tr>
        @empty
            <p>There is no Food  to show</p>
        @endforelse
        </tbody>
    </table>

</x-restaurant-layout>
