
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight text-center">
            All Discounts
        </h2>
    </x-slot>
    <table class="w-5/6  text-left text-green-800 font-extrabold dark:text-gray-400 mt-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6 text-xl">Discount Name</th>
            <th scope="col" class="py-3 px-6 text-xl">Discount Percentage</th>


        </tr>
        </thead>
        <tbody>
        @forelse($discounts as $discount )
            <tr>

                {{--                <a href="{{route('music.edit',$music->id)}}">--}}
                <td class="py-4 px-6 text-xl"><a
                        href="{{route('admin.discount.edit',$discount->id)}}">{{$discount->title}}</a></td>
                <td class="py-4 px-6 text-xl"><a
                        href="{{route('admin.discount.edit',$discount->id)}}">{{$discount->percentage}}</a></td>

                <td class="py-4 px-6">
                    <form action="{{route('admin.discount.destroy',$discount->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" value="{{$discount->id}}" name="id">
                        <button type="submit"
                                class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Delete
                        </button>
                    </form>

                </td>
                {{--                </a>--}}

            </tr>
        @empty
            <p>There is No Discount to show</p>
        @endforelse
        </tbody>
    </table>

</x-admin-layout>
