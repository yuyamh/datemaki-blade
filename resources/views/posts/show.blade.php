<x-app-layout>
    <x-slot name="header">教案詳細</x-slot>
    <x-slot name="title">教案詳細</x-slot>
    <div class="w-full md:pb-16">
        <div class="flex items-center justify-between mb-5">
            <h1 class="w-2/3 pl-1 text-2xl truncate lg:text-3xl lg:w-4/5">{{ $post->title }}</h1>
            {{-- 自分の投稿にはブックマークボタンを表示しない --}}
            @if ($post->user_id !== Auth::id())
            <div class="flex content-center">
                @if (!Auth::user()->is_bookmarked($post->id))
                <form action="{{ route('bookmarks.store', $post) }}" method="POST" class="flex content-center">
                    @csrf
                    <button  class="inline-flex items-center px-4 py-4 m-1 text-xs font-semibold tracking-widest text-gray-600 uppercase transition duration-150 ease-in-out bg-transparent border border-gray-500 md:py-3 rounded-xl md:rounded-2xl focus:bg-transparent focus:ring-0 active:bg-transparent focus:text-gray-400 hover:scale-95 active:scale-90 focus:border-gray-400 focus:outline-none focus:ring-offset-2">
                        <i class="md:mr-1 fa-regular fa-bookmark fa-lg"></i>
                        <p class="hidden md:block">ブックマーク</p>
                    </button>
                </form>
                @else
                <form action="{{ route('bookmarks.destroy', $post) }}" method="POST" class="flex content-center">
                    @csrf
                    @method('DELETE')
                    <button  class="inline-flex items-center px-4 py-4 m-1 text-xs font-semibold tracking-widest text-gray-600 uppercase transition duration-150 ease-in-out bg-orange-200 border border-gray-500 md:rounded-2xl hover:bg-orange-200 focus:bg-orange-200 focus:ring-0 active:bg-orange-200 focus:text-gray-400 hover:scale-95 active:scale-90 focus:border-gray-400 md:py-3 rounded-xl active:bg-transparent focus:outline-none focus:ring-offset-2">
                        <i class="md:mr-1 fa-regular fa-bookmark fa-lg"></i>
                        <p class="hidden md:block">ブックマーク済</p>
                    </button>
                </form>
                @endif
            </div>
            @endif
        </div>
        <table class="w-full border-collapse md:text-left md:table-fixed">
            <tbody>
                <tr class="show-tr">
                    <th class="w-full show-th md:w-1/5">レベル</th>
                    <td class="w-full show-td md:w-4/5">{{ $post->level }}</td>
                </tr>
                <tr class="show-tr">
                    <th class="show-th">使用テキスト</th>
                    @if(isset($post->text->text_name))
                    <td class="show-td">{{ $post->text->text_name }}</td>
                    @else
                    <td class="show-td">&ensp;-</td>
                    @endif
                </tr>
                <tr class="show-tr">
                    <th class="show-th">投稿者</th>
                    <td class="show-td hover:underline"><a href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a></td>
                </tr>
                <tr class="show-tr">
                    <th class="show-th">概要</th>
                    <td class="show-td">{!! nl2br(e($post->description)) !!}</td>
                </tr>
                <tr class="show-tr">
                    <th class="show-th">添付ファイル</th>
                    <td class="show-td hover:underline"><a href="{{ $filePath }}">{{ $post->file_name }}</a></td>
                </tr>
                <tr class="show-tr">
                    <th class="show-th">ファイルサイズ</th>
                    <td class="show-td">{{ $post->file_size }}</td>
                </tr>
                <tr class="show-tr">
                    <th class="show-th">MIMEタイプ</th>
                    <td class="show-td">{{ $post->file_mimetype }}</td>
                </tr>
                <tr class="show-tr">
                    <th class="show-th">投稿日</th>
                    <td class="show-td">{{ $post->created_at->format('Y/m/d') }}</td>
                </tr>
                <tr class="show-tr">
                    <th class="md:border-b-2 show-th">更新日</th>
                    <td class="border-b-2 show-td">{{ $post->updated_at->format('Y/m/d') }}</td>
                </tr>
            </tbody>
        </table>
        @can('update', $post)
            <div class="flex justify-center my-9">
                <x-primary-button onclick="location.href='{{ route('posts.edit', $post) }}'" class="mr-12 bg-orange-400 shadow-md hover:bg-orange-300 active:bg-orange-400 focus:bg-orange-400">編集する</x-primary-button>
                <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-primary-button class="bg-red-500 shadow-md hover:bg-red-300 active:bg-red-500 focus:bg-red-500">削除する</x-primary-button>
                </form>
            </div>
        @endcan
    </div>
</x-app-layout>
