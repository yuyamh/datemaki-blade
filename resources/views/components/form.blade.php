@csrf
<div class="form-group">
    <label for="title" class="block text-lg">
        <span>タイトル</span>
        <span class="text-sm text-red-500">&ensp;※&nbsp;必須</span>
    </label>
    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" placeholder="例：クラスメートに自己紹介しよう" class="form-input">
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
</div>
<div class="form-group">
    <p class="block text-lg">
        <span>レベル（CEFR基準）</span>
        <span class="text-sm text-red-500">&ensp;※&nbsp;必須</span>
    </p>
    <div class="grid w-full grid-cols-6 p-2 space-x-2 bg-gray-200 shadow-sm rounded-xl">
        {{-- A1をselectedに設定 --}}
        <div>
            <input type="radio" id="level-A1" name="level" class="hidden peer" value="A1"{{ old('level', $post->level ?? 'A1') == 'A1' ? " checked" : "" }}>
            <label for="level-A1" class="radio-label">A1</label>
        </div>
        <div>
            <input type="radio" id="level-A2" name="level" class="hidden peer" value="A2"{{ old('level', $post->level ?? 'A1') == 'A2' ? " checked" : "" }}>
            <label for="level-A2" class="radio-label">A2</label>
        </div>
        <div>
            <input type="radio" id="level-B1" name="level" class="hidden peer" value="B1"{{ old('level', $post->level ?? 'A1') == 'B1' ? " checked" : "" }}>
            <label for="level-B1" class="radio-label">B1</label>
        </div>
        <div>
            <input type="radio" id="level-B2" name="level" class="hidden peer" value="B2"{{ old('level', $post->level ?? 'A1') == 'B2' ? " checked" : "" }}>
            <label for="level-B2" class="radio-label">B2</label>
        </div>
        <div>
            <input type="radio" id="level-C1" name="level" class="hidden peer" value="C1"{{ old('level', $post->level ?? 'A1') == 'C1' ? " checked" : "" }}>
            <label for="level-C1" class="radio-label">C1</label>
        </div>
        <div>
            <input type="radio" id="level-C2" name="level" class="hidden peer" value="C2"{{ old('level', $post->level ?? 'A1') == 'C2' ? " checked" : "" }}>
            <label for="level-C2" class="radio-label">C2</label>
        </div>
    </div>
    <x-input-error :messages="$errors->get('level')" class="mt-2" />
</div>
<div class="form-group">
    <p class="block text-lg">使用テキスト</p>
    <select name="text_id" class="form-input">
        <option value="">なし</option>
        @foreach ($texts as $text)
        <option value="{{ $text->id }}"{{ old('text_id', $post->text_id) == $text->id ? " selected" : "" }}>
            {{ $text->text_name }}
        </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('text_id')" class="mt-2" />
</div>
<div class="form-group">
    <label for="description" class="block text-lg">
        <span>概要</span>
        <span class="text-sm text-red-500">&ensp;※&nbsp;必須、マークダウン記法可</span>
        <button
        class="ml-1 hover:scale-90 active:scale-80"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'markdown-description')"
        >
        <i class="fa-regular fa-circle-question" style="color: #e79608;"></i>
        </button>
        <x-modal name="markdown-description">
            <x-markdown-description />
        </x-modal>
    </label>
    <textarea name="description" id="description" cols="30" rows="10" placeholder="授業内容、教案の補足説明などを記入する。" class="form-input">{{ old('description', $post->description) }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>
<div class="form-group">
    <p class="block mb-2 text-lg">
        <span>ファイルアップロード</span>
        <span class="ml-2 text-sm text-red-500">※1点まで</span>
    </p>
    <div class="flex flex-col-reverse md:flex-row">
        <div class="flex flex-col items-center justify-center w-full h-64 bg-gray-200 border-2 border-gray-400 border-dashed rounded-lg cursor-pointer md:w-2/3 hover:bg-gray-100 hover:border-orange-400 hover:border-4" onclick="$('#form-upload-input').click()" id="form-dropzone">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <i class="m-5 text-6xl text-gray-400 fa-solid fa-cloud-arrow-up"></i>
                <p class="hidden mb-2 text-sm text-gray-500 lg:block">ここにファイルをドロップ</p>
                <p class="mb-2 text-sm text-gray-500"><span class="hidden lg:inline">または</span>クリックしてファイルを選択</p>
            </div>
        </div>
        <input type="file" name="file_name" id="form-upload-input" class="hidden w-full my-1">
        <div>
            @if (isset($post->file_name))
            <div class="my-2 ml-2 text-sm">
                <p class="mb-1">現在のファイル&nbsp;:&nbsp;</p>
                <p class="flex mb-5">
                    <span>{{ $post->file_name}}</span>
                    <a href="{{ $post->file_url }}" target="_blank" rel="noopener noreferrer" class="ml-3 underline hover:text-gray-600">表示</a>
                </p>
            </div>
            @endif
            <p class="mt-2 mb-4 text-base md:ml-3" id="dropped-filename"></p>
        </div>
    </div>
    <x-input-error :messages="$errors->get('file_name')" class="mt-2" />
</div>
<div class="w-full h-40 p-3 mb-6 text-sm border-2 border-gray-300 rounded-lg shadow-md bg-gray-50 md:w-2/3 md:text-base">
    <p class="my-1 font-semibold text-orange-500">ファイルアップロードに関する注意事項</p>
    <ul class="py-2">
        <li class="py-1">点数：1点まで</li>
        <li class="py-1">ファイル形式：pdf&thinsp;/&thinsp;docx&thinsp;/&thinsp;zip&thinsp;/&thinsp;xlsx&thinsp;/&thinsp;jpeg&thinsp;/&thinsp;jpg&thinsp;/&thinsp;png</li>
        {{-- TODO:ファイルの容量を記載する --}}
        {{-- <li>容量&nbsp;:&nbsp;KBまで</li> --}}
    </ul>
</div>
<script src="{{ asset('js/form_file_upload.js') }}"></script>
