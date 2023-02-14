<x-app-layout>
    <x-slot name="header">じぶんの教案一覧</x-slot>
    <x-slot name="title">じぶんの教案</x-slot>
    <div class="flex flex-col py-10">
        <div class="inline-block min-w-full">
            <table class="w-full border-b-2 table-fixed mytable">
                <thead class="bg-orange-300 border-b-2 border-gray-500">
                    <tr>
                        <div class="font-bold">
                            <th scope="col" class="w-1/12">♯</th>
                            <th scope="col" class="w-6/12">タイトル</th>
                            <th scope="col" class="w-2/12">レベル</th>
                            <th scope="col" class="w-2/12">投稿日</th>
                            <th scope="col" class="w-2/12">操作</th>
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
                                <td class="px-6 py-3 font-medium truncate">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-3 font-light truncate">{{ $post->title }}</td>
                                <td class="px-6 py-3 font-light truncate">{{ $post->level }}</td>
                                <td class="px-6 py-3 font-light truncate">{{ $post->created_at->format('Y/m/d') }}</td>
                                <td class="px-6 py-3 font-light truncate">
                                    <div class="flex">
                                        <a href="{{ route('posts.edit', $post) }}" class="mr-5 text-sm leading-6 text-blue-400 hover:text-blue-700 hover:underline">編集</a>
                                        {{-- <a href="route('posts.edit', $post)" class="text-sm text-red-400 hover:text-red-700 hover:underline">削除</a> --}}
                                        <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('posts.destroy', $post) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-sm leading-6 text-red-400 hover:text-red-700 hover:underline">削除</button>
                                        </form>
                                    </div>
                                </td>
                        </tr>
                    @empty
                    <tr>
                        <td></td>
                        <td class="px-6 py-3">教案が投稿されていません。みんなにシェアしてみましょう！</td>
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
