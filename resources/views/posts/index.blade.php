<x-app-layout>
    <x-slot name="header">教案一覧</x-slot>
    <div class="flex flex-col py-2">
        <div class="inline-block min-w-full">
            <table class="w-full border-b-2 table-fixed">
                <thead class="bg-orange-400 border-b-2 border-black">
                    <tr>
                        <div class="font-bold">
                            <th scope="col" class="w-1/12 px-6 py-4 text-lg text-left text-gray-100 ">♯</th>
                            <th scope="col" class="w-6/12 px-6 py-4 text-lg text-left text-gray-100 ">タイトル</th>
                            <th scope="col" class="w-2/12 px-6 py-4 text-lg text-left text-gray-100 ">レベル</th>
                            <th scope="col" class="w-2/12 px-6 py-4 text-lg text-left text-gray-100 ">投稿者</th>
                            <th scope="col" class="w-2/12 px-6 py-4 text-lg text-left text-gray-100 ">投稿日</th>
                        </div>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        @if ($loop->index % 2 === 0)
                        <tr class="bg-gray-100 border-b hover:cursor-pointer hover:bg-yellow-100" data-href="{{ route('posts.show', $post) }}">
                        @else
                        <tr class="bg-white border-b hover:cursor-pointer hover:bg-yellow-100" data-href="{{ route('posts.show', $post) }}">
                        @endif
                                <td class="px-6 py-3 font-medium truncate">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-3 font-light truncate">{{ $post->title }}</td>
                                <td class="px-6 py-3 font-light truncate">{{ $post->level }}</a></td>
                                <td class="px-6 py-3 font-light truncate">{{ $post->user->name }}</a></td>
                                <td class="px-6 py-3 font-light truncate">{{ $post->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="m-4">{{ $posts->links() }}</div>
    </div>
    <script>
    const tr = document.querySelectorAll('tr[data-href]');
    tr.forEach(function(el) {
        el.onclick = function(e) {
                const clickedElement = e.currentTarget;
                console.log(clickedElement);
                const href = clickedElement.dataset.href;
                location.href = href;
            }
    });
    </script>
</x-app-layout>
