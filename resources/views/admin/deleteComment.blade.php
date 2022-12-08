<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Delete Request Comments
        </h2>
    </x-slot>
    <table class="w-5/6  text-center text-green-800 font-extrabold dark:text-gray-400 mt-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
        <tr>
            <th scope="col" class="py-3 px-6 text-xl">Author Name</th>
            <th scope="col" class="py-3 px-6 text-xl">Score</th>
            <th scope="col" class="py-3 px-6 text-xl">Content</th>
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
                    <td class="py-4 px-6">
                        <form action="{{route('admin.comment.delete',$comment->id)}}" method="post">
                            @csrf
                            @method('delete')

                            <button type="submit"
                                    class="hover:shadow-form mx-auto rounded-md bg-red-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                Delete
                            </button>
                        </form>
                    </td>
                <td class="py-4 px-6">
                    <form action="{{route('admin.comment.accept',$comment->id)}}" method="post">
                        @csrf
                        @method('patch')

                        <button type="submit"
                                class="hover:shadow-form mx-auto rounded-md bg-green-600 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Accept
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <p>There is no Delete Comment Request to show</p>
        @endforelse
        </tbody>
    </table>
</x-admin-layout>
