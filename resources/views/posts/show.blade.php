<x-app-layout>
    <x-slot name="header">教案詳細</x-slot>
    <div class="p-10">
        <x-primary-button onclick="location.href='{{ route('posts.index') }}'">戻る</x-primary-button>
        <div class="px-3 py-2 bg-orange-400 my-7">
            <h1 class="p-1 text-2xl font-bold text-gray-100">{{ $post->title }}</h1>
        </div>
        <table class="container text-left border-collapse">
            <tbody>
                <tr>
                    <th class="w-1/5 p-4 bg-yellow-200 border-2 border-gray-300 border-solid">レベル</th>
                    <td class="w-4/5 p-4 border-2 border-gray-300 border-solid bg-gray-50">{{ $post->level }}</td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">使用テキスト</th>
                    @if(isset($post->text->text_name))
                    <td class="p-4 border-2 border-gray-300 border-solid bg-gray-50">{{ $post->text->text_name }}</td>
                    @else
                    <td class="p-4 border-2 border-gray-300 border-solid bg-gray-50">&ensp;-</td>
                    @endif
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">投稿者</th>
                    <td class="p-4 border-2 border-gray-300 border-solid hover:underline bg-gray-50"><a href="">{{ $post->user->name }}</a></td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">概要</th>
                    <td class="p-4 border-2 border-gray-300 border-solid bg-gray-50">{!! nl2br(e($post->description)) !!}</td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">添付ファイル</th>
                    <td class="p-4 border-2 border-gray-300 border-solid hover:underline bg-gray-50"><a href="">{{ $post->file_name }}</a></td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">投稿日</th>
                    <td class="p-4 border-2 border-gray-300 border-solid bg-gray-50">{{ $post->created_at->format('Y/m/d') }}</td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">更新日</th>
                    <td class="p-4 border-2 border-gray-300 border-solid bg-gray-50">{{ $post->updated_at->format('Y/m/d') }}</td>
                </tr>
            </tbody>
        </table>
        @can('update', $post)
            <div class="flex justify-center my-9">
                <x-primary-button onclick="location.href='{{ route('posts.edit', $post) }}'" class="mr-12 bg-orange-400 shadow-md hover:bg-orange-300">編集する</x-primary-button>
                <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-primary-button class="bg-red-500 shadow-md hover:bg-red-300">削除する</x-primary-button>
                </form>
            </div>
        @endcan
    </div>
</x-app-layout>
