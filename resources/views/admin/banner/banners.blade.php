<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-700 leading-tight text-center">
           All Of Banners
        </h2>
    </x-slot>
    <table class="w-5/6  text-left text-green-800 font-extrabold dark:text-gray-400 mt-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6 text-xl">Picture</th>
            <th scope="col" class="py-3 px-6 text-xl">Banner Title</th>


        </tr>
        </thead>
        <tbody>
        @forelse($banners as $banner )
            <tr>

                <td class="py-4 px-6"><a href="{{route('admin.banner.edit',$banner->id)}}">
                            <img src="{{asset($banner->picture)}}" class="w-28" alt="">

                    </a></td>
                <td class="py-4 px-6 text-xl"><a href="{{route('admin.banner.edit',$banner->id)}}">
                        {{$banner->title}}</a></td>
                <td class="py-4 px-6">
                    <form action="{{route('admin.banner.destroy',$banner->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit"
                                class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Delete
                        </button>
                    </form>

                </td>

            </tr>
        @empty
            <p>There is no Banner to show</p>
        @endforelse
        </tbody>
    </table>

</x-admin-layout>
