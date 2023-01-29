<x-app-layout>
    <x-slot name="header">教案詳細</x-slot>
    <div class="px-10 py-5">
        <div class="px-3 py-2 my-6 bg-orange-400">
            <h1 class="p-1 text-2xl font-bold text-gray-100">{{ $post->title }}</h1>
        </div>
        <table class="container text-left border-collapse">
            <tbody>
                <tr>
                    <th class="w-1/5 p-4 bg-yellow-200 border-2 border-gray-300 border-solid">レベル</th>
                    <td class="w-4/5 p-4 border-2 border-gray-300 border-solid">{{ $post->level }}</td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">使用テキスト</th>
                    @if(isset($post->text->text_name))
                    <td class="p-4 border-2 border-gray-300 border-solid">{{ $post->text->text_name }}</td>
                    @else
                    <td class="p-4 border-2 border-gray-300 border-solid">&ensp;-</td>
                    @endif
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">投稿者</th>
                    <td class="p-4 border-2 border-gray-300 border-solid hover:underline"><a href="">{{ $post->user->name }}</a></td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">概要</th>
                    <td class="p-4 border-2 border-gray-300 border-solid">{!! nl2br(e($post->description)) !!}</td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">添付ファイル</th>
                    <td class="p-4 border-2 border-gray-300 border-solid hover:underline"><a href="">{{ $post->file_name }}</a></td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">投稿日</th>
                    <td class="p-4 border-2 border-gray-300 border-solid">{{ $post->created_at->format('Y/m/d') }}</td>
                </tr>
                <tr>
                    <th class="p-4 bg-yellow-200 border-2 border-gray-300 border-solid">更新日</th>
                    <td class="p-4 border-2 border-gray-300 border-solid">{{ $post->updated_at->format('Y/m/d') }}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-center my-9">
            <x-primary-button onclick="location.href='{{ route('posts.index') }}'">戻る</x-primary-button>
        </div>
    </div>
</x-app-layout>
