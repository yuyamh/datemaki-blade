<div class="flex flex-col p-2 md:py-10">
    <div class="overflow-x-auto md:overflow-x-hidden">
        @if ($posts->isEmpty())
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <p>{{ $message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <table class="border-b-2 table-fixed md:w-full table-index">
                <thead class="bg-orange-300 border-b-2 border-gray-500">
                    <tr>
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
                    @foreach ($posts as $post)
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
                    @endforeach
                </tbody>
            </table>
        @endif
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