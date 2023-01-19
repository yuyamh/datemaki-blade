<x-app-layout>
    <x-slot name="header">教案一覧</x-slot>
    <div class="flex flex-col py-2 px-8">
        <div class="inline-block min-w-full">
            <table class="w-full border-b-2 table-fixed">
                <thead class="bg-white border-b-2 border-black">
                    <tr>
                        <th scope="col" class="text-medium font-bold text-gray-900 px-6 py-4 text-left w-1/12">♯</th>
                        <th scope="col" class="text-medium font-bold text-gray-900 px-6 py-4 text-left w-6/12">タイトル</th>
                        <th scope="col" class="text-medium font-bold text-gray-900 px-6 py-4 text-left w-2/12">レベル</th>
                        <th scope="col" class="text-medium font-bold text-gray-900 px-6 py-4 text-left w-2/12">投稿者</th>
                        <th scope="col" class="text-medium font-bold text-gray-900 px-6 py-4 text-left w-2/12">投稿日</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        @if ($loop->index % 2 === 0)
                        <tr class="bg-gray-100 border-b">
                        @else
                        <tr class="bg-white border-b">
                        @endif
                            <td class="px-6 py-3 truncate text-sm font-medium text-gray-900">{{ $loop->index + 1 }}</td>
                            <td class="px-6 py-3 truncate text-sm font-light text-gray-900"><a href="">{{ $post->title }}</a></td>
                            <td class="px-6 py-3 truncate text-sm font-light text-gray-900"><a href="">{{ $post->level }}</a></td>
                            <td class="px-6 py-3 truncate text-sm font-light text-gray-900"><a href="">{{ $post->user->name }}</a></td>
                            <td class="px-6 py-3 truncate text-sm font-light text-gray-900">{{ $post->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="m-4">{{ $posts->links() }}</div>
    </div>
</x-app-layout>
