<x-app-layout>
    <x-slot name="header">投稿フォーム</x-slot>
    <x-errors />
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div>
            <p>レベル（CEFR基準）</p>
            {{-- A1をselectedにする --}}
            <input type="radio" id="level-A1" name="level" value="A1" {{ old('level','A1') == 'A1' ? 'checked' : '' }}>
            <label for="level-A1">A1</label>
            <input type="radio" id="level-A2" name="level" value="A2" {{ old('level','A1') == 'A2' ? 'checked' : '' }}>
            <label for="level-A2">A2</label>
            <input type="radio" id="level-B1" name="level" value="B1" {{ old('level','A1') == 'B1' ? 'checked' : '' }}>
            <label for="level-B1">B1</label>
            <input type="radio" id="level-B2" name="level" value="B2" {{ old('level','A1') == 'B2' ? 'checked' : '' }}>
            <label for="level-B2">B2</label>
            <input type="radio" id="level-C1" name="level" value="C1" {{ old('level','A1') == 'C1' ? 'checked' : '' }}>
            <label for="level-C1">C1</label>
            <input type="radio" id="level-C2" name="level" value="C2" {{ old('level','A1') == 'C2' ? 'checked' : '' }}>
            <label for="level-C2">C2</label>
        </div>
        <div>
            <p>使用テキスト</p>
            <select name="text_id">
                <option value="">&ensp;-&ensp;</option>
                {{-- 上記の選択肢はセレクトボックスの初期値＆テキスト選択なし（null）を予定 --}}
                @foreach ($texts as $text)
                <option value="{{ $text->id }}" {{ old('text_id', $text->id ?? '') === $text->id ? "selected" : "" }}>
                    {{ $text->text_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="description">概要</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="file_name">添付ファイル</label>
            <input type="text" name="file_name" id="file" value="{{ old('file_name') }}">
        </div>
        <x-primary-button type="submit" class="bg-orange-400 hover:bg-orange-300">投稿する</x-primary-button>
        <x-secondary-button onclick="location.href='{{ route('posts.index') }}'">キャンセル</x-secondary-button>
    </form>
</x-app-layout>
