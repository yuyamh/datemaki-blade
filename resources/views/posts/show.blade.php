<x-app-layout>
    <x-slot name="header">教案詳細</x-slot>
    <div class="w-full px-3 py-8 md:p-10">
        <x-primary-button onclick="location.href='{{ route('posts.index') }}'">戻る</x-primary-button>
        <div class="py-2 mb-2 mt-7">
            <h1 class="p-1 text-2xl lg:text-4xl">{{ $post->title }}</h1>
        </div>
        <table class="container w-full border-collapse md:text-left md:table-fixed">
            {{-- TODO:table-cellでずれるので修正 --}}
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
                    <td class="show-td hover:underline"><a href="">{{ $post->user->name }}</a></td>
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
