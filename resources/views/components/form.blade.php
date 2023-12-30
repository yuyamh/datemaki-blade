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
            <p class="mt-2 mb-4 text-xl mb:text-2xl md:ml-3" id="dropped-filename"></p>
        </div>
    </div>
    <x-input-error :messages="$errors->get('file_name')" class="mt-2" />
</div>
<div class="w-full border-2 border-gray-400 rounded-lg shadow-md bg-gray-50 h-52 md:w-1/2">

</div>
<script>
    $(function () {
        // ドロップゾーンに入ったときCSSの指定を追加
        $('#form-dropzone').on('dragenter dragover', function () {
            $(this).addClass('bg-gray-50 border-orange-400 border-4');
        });

        // ドロップゾーンから離れたときに追加したCSS指定を削除
        $('#form-dropzone').on('dragleave', function () {
            $(this).removeClass('bg-gray-50 border-orange-400 border-4');
        });

        // ドロップされたファイルを取得する
        $('#form-dropzone').on('drop', function (e) {
            $('#form-upload-input')[0].files = e.originalEvent.dataTransfer.files;
            // changeイベントの発火
            $('#form-upload-input').trigger('change');
        });

        // ファイルが選択されたら、ファイル名を表示する
        $('#form-upload-input').on('change', function () {
            let fileName = $(this)[0].files[0].name;
            let fileName_html = `
                ${fileName}<i class="ml-2 text-gray-900 hover:text-gray-300 fa-solid fa-xmark" id="upload-close-btn"></i>
            `;
            $('#dropped-filename').html(fileName_html);
        });

        // ファイル名横の「ｘ」ボタン押下で、ドラッグ&ドロップしたファイル消去
        $('#dropped-filename').on('click','#upload-close-btn', function () {
            // ファイル名の非表示
            $('#dropped-filename').empty();
            // ファイルをInputから削除
            $('#form-upload-input').val('');
        });

        // デフォルトの挙動をキャンセルする
        $(document).on('dragover drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });
</script>
