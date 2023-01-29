<x-app-layout>
    <x-slot name="header">投稿フォーム</x-slot>
    <div class="w-full max-w-2xl py-8 pt-6 mx-auto">
        <form action="{{ route('posts.store') }}" method="POST" class="">
            @csrf
            <div class="form-group">
                <label for="title" class="block text-lg">タイトル</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="例：クラスメートに自己紹介しよう" class="form-input">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="form-group">
                <p class="block text-lg">レベル（CEFR基準）</p>
                <div class="grid w-full grid-cols-6 p-2 space-x-2 bg-gray-200 shadow-sm rounded-xl">
                    {{-- A1をselectedに設定する --}}
                    <div>
                        <input type="radio" id="level-A1" name="level" class="hidden peer" value="A1"{{ old('level','A1') == 'A1' ? " checked" : "" }}>
                        <label for="level-A1" class="radio-label">A1</label>
                    </div>
                    <div>
                        <input type="radio" id="level-A2" name="level" class="hidden peer" value="A2"{{ old('level','A1') == 'A2' ? " checked" : "" }}>
                        <label for="level-A2" class="radio-label">A2</label>
                    </div>
                    <div>
                        <input type="radio" id="level-B1" name="level" class="hidden peer" value="B1"{{ old('level','A1') == 'B1' ? " checked" : "" }}>
                        <label for="level-B1" class="radio-label">B1</label>
                    </div>
                    <div>
                        <input type="radio" id="level-B2" name="level" class="hidden peer" value="B2"{{ old('level','A1') == 'B2' ? " checked" : "" }}>
                        <label for="level-B2" class="radio-label">B2</label>
                    </div>
                    <div>
                        <input type="radio" id="level-C1" name="level" class="hidden peer" value="C1"{{ old('level','A1') == 'C1' ? " checked" : "" }}>
                        <label for="level-C1" class="radio-label">C1</label>
                    </div>
                    <div>
                        <input type="radio" id="level-C2" name="level" class="hidden peer" value="C2"{{ old('level','A1') == 'C2' ? " checked" : "" }}>
                        <label for="level-C2" class="radio-label">C2</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <p class="block text-lg">使用テキスト<span class="text-sm text-gray-500">&ensp;-&nbsp;任意</span></p>
                <select name="text_id" class="form-input">
                    <option value="">なし</option>
                    @foreach ($texts as $text)
                    <option value="{{ $text->id }}"{{ old('text_id') == $text->id ? " selected" : "" }}>
                        {{ $text->text_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description" class="block text-lg">概要</label>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="授業内容、教案の補足説明などを記入する。" class="form-input">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="form-group">
                <label for="file_name" class="block text-lg">添付ファイル</label>
                <input type="text" name="file_name" id="file" value="{{ old('file_name') }}" class="form-input">
                <x-input-error :messages="$errors->get('file_name')" class="mt-2" />
            </div>
            <div class="flex justify-center py-5">
                <x-primary-button type="submit" class="mr-12 bg-orange-400 shadow-md hover:bg-orange-300">投稿する</x-primary-button>
                <x-secondary-button onclick="location.href='{{ route('posts.index') }}'">キャンセル</x-secondary-button>
            </div>
        </form>
    </div>
</x-app-layout>
