<x-app-layout>
    <x-slot name="header">教案一覧</x-slot>
    <div class="flex flex-col p-2 md:py-10">
        <div class="overflow-x-auto md:overflow-x-hidden">
            <table class="border-b-2 table-fixed lg:w-full table-index">
                <thead class="bg-orange-300 border-b-2 border-gray-500 ">
                    <tr class="text-sm lg:text-lg">
                        <div class="font-bold">
                            <th scope="col" class="w-1/12">♯</th>
                            <th scope="col" class="w-3/12 lg:w-5/12">タイトル</th>
                            <th scope="col" class="w-2/12 lg:w-2/12">レベル</th>
                            <th scope="col" class="w-2/12">投稿者</th>
                            <th scope="col" class="w-2/12">投稿日</th>
                        </div>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        @if ($loop->index % 2 === 0)
                        <tr class="bg-gray-100 border-b hover:cursor-pointer hover:bg-yellow-100" data-href="{{ route('posts.show', $post) }}">
                        @else
                        <tr class="bg-white border-b hover:cursor-pointer hover:bg-yellow-100" data-href="{{ route('posts.show', $post) }}">
                        @endif
                                <td class="font-medium truncate">{{ $loop->index + 1 }}</td>
                                <td class="font-light truncate">{{ $post->title }}</td>
                                <td class="font-light truncate">{{ $post->level }}</td>
                                <td class="font-light truncate">{{ $post->user->name }}</td>
                                <td class="font-light truncate">{{ $post->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @empty
                    <tr>
                        <td></td>
                        <td>まだ教案が投稿されていません。</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="m-4">{{ $posts->onEachSide(1)->links() }}</div>
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
