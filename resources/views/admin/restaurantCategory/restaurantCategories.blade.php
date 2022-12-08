<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight text-center">
            All Restaurant Categories
        </h2>
    </x-slot>
    <table class="w-5/6  text-left text-green-800 font-extrabold dark:text-gray-400 mt-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6 text-xl">Picture</th>
            <th scope="col" class="py-3 px-6 text-xl">Category Name</th>
            <th scope="col" class="py-3 px-6 text-xl">Delete Category</th>


        </tr>
        </thead>
        <tbody>
        @forelse($restaurantCategories as $restaurantCategory )
            <tr>

                <td class="py-4 px-6"><a href="{{route('admin.restaurantCategory.edit',$restaurantCategory->id)}}">
                        @if($restaurantCategory->picture)
                            <img src="{{asset($restaurantCategory->picture)}}" class="w-28" alt="">
                        @else
                            <img src="{{asset('storage/images/restaurant-category-icon.png')}}" class="w-28" alt="Doesn't have Picture">
                        @endif
                    </a></td>
                <td class="py-4 px-6 text-xl"><a
                        href="{{route('admin.restaurantCategory.edit',$restaurantCategory->id)}}">
                        {{$restaurantCategory->name}}</a></td>
                <td class="py-4 px-6">
                    <form action="{{route('admin.restaurantCategory.destroy',$restaurantCategory->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{$restaurantCategory->id}}" name="id">
                        <button type="submit"
                                class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Delete
                        </button>
                    </form>

                </td>
                {{--                </a>--}}

            </tr>
        @empty
            <p>There is no Restaurant Category to show</p>
        @endforelse
        </tbody>
    </table>

</x-admin-layout>
