<div class="py-10 ">
    <div class="flex w-full pb-2 text-xl border-b border-gray-300">
        <span class="mr-2"><i class="fa-solid fa-magnifying-glass"></i></span>
        <h1>教案検索</h1>
    </div>
    <form action="{{ route('posts.index') }}" method="GET">
        <div class="form-group">
            <label for="keyword" class="block text-lg">キーワード</label>
            <input type="text" id="keyword" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Search" class="form-input">
        </div>
        <div class="form-group">
        <p class="block text-lg">使用テキスト</p>
            <select name="text_id" class="form-input">
                <option value="">なし</option>
                @foreach ($texts as $text)
                <option value="{{ $text->id }}"{{ $text->id == Request::get('text_id') ? ' selected' : '' }}>
                    {{ $text->text_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <p class="block text-lg">レベル別（CEFR基準）</p>
            <div class="grid w-full grid-rows-6 p-2 bg-gray-200 shadow-sm rounded-xl">
                <div>
                    <input type="radio" id="level-A1" name="level" class="hidden peer" value="A1"{{ 'A1' == Request::get('level') ? ' checked' : '' }}>
                    <label for="level-A1" class="radio-label">A1</label>
                </div>
                <div>
                    <input type="radio" id="level-A2" name="level" class="hidden peer" value="A2"{{ 'A2' == Request::get('level') ? ' checked' : '' }}>
                    <label for="level-A2" class="radio-label">A2</label>
                </div>
                <div>
                    <input type="radio" id="level-B1" name="level" class="hidden peer" value="B1"{{ 'B1' == Request::get('level') ? ' checked' : '' }}>
                    <label for="level-B1" class="radio-label">B1</label>
                </div>
                <div>
                    <input type="radio" id="level-B2" name="level" class="hidden peer" value="B2"{{ 'B2' == Request::get('level') ? ' checked' : '' }}>
                    <label for="level-B2" class="radio-label">B2</label>
                </div>
                <div>
                    <input type="radio" id="level-C1" name="level" class="hidden peer" value="C1"{{ 'C1' == Request::get('level') ? ' checked' : '' }}>
                    <label for="level-C1" class="radio-label">C1</label>
                </div>
                <div>
                    <input type="radio" id="level-C2" name="level" class="hidden peer" value="C2"{{ 'C2' == Request::get('level') ? ' checked' : '' }}>
                    <label for="level-C2" class="radio-label">C2</label>
                </div>
            </div>
        </div>
        <div class="text-center">
            <x-primary-button type="submit" class="bg-green-500 shadow-md hover:bg-green-400 hover:scale-95 active:scale-90 active:ring-offset-0 focus:ring-offset-0 active:bg-green-400 focus:bg-green-400 focus:ring-transparent">検索</x-primary-button>
        </div>
        <script>
            const radioBtns = document.querySelectorAll('input[type="radio"]');
            let prevRadio = null;
            radioBtns.forEach((radioBtn) => {
                radioBtn.addEventListener('click', () => {
                    if (prevRadio === radioBtn && radioBtn.checked) {
                        radioBtn.checked = false;
                        prevRadio = null;
                    } else {
                        prevRadio = radioBtn;
                    }
                });
            });
        </script>
    </form>
</div>
