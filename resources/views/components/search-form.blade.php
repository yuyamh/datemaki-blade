<div class="w-full p-6 mb-10 bg-yellow-50 rounded-xl">
    <div class="flex w-full py-2 mb-5 border-b border-orange-300">
        <span class="mr-3"><i class="text-xl fa-solid fa-magnifying-glass" style="color: #f59e0b;"></i></span>
        <h1 class="text-lg font-bold">見つける</h1>
    </div>
    <div class="flex flex-col md:flex-row">
        <div class="p-4 bg-green-100 md:mr-6 lg:mr-10 rounded-xl">
            <div class="flex w-full py-2 mb-5 text-lg border-b border-green-500">
                <span class="mr-3"><i class="fa-solid fa-book" style="color: #22c55e;"></i></span>
                <h1>教案を探す</h1>
            </div>
            <form action="{{ route('posts.index') }}" method="GET">
                <div class="grid-cols-2 gap-3 md:grid">
                    <div class="col-span-1 form-group">
                        <label for="keyword" class="block text-base">キーワード</label>
                        <input type="text" id="keyword" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Search" class="form-input-search" autocomplete=”off”>
                    </div>
                    <div class="col-span-1 form-group">
                    <p class="block text-base">使用テキスト</p>
                        <select name="text_id" class="form-input-search">
                            <option value="">なし</option>
                            @foreach ($texts as $text)
                            <option value="{{ $text->id }}"{{ $text->id == Request::get('text_id') ? ' selected' : '' }}>
                                {{ $text->text_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <p class="block text-base">レベル別（CEFR基準）</p>
                    <div class="grid w-full grid-cols-2 p-2 bg-white shadow-sm md:grid-cols-3 rounded-xl">
                        <div>
                            <input type="radio" id="level-A1-search" name="level" class="hidden peer input-search" value="A1"{{ 'A1' == Request::get('level') ? ' checked' : '' }}>
                            <label for="level-A1-search" class="radio-level">A1</label>
                        </div>
                        <div>
                            <input type="radio" id="level-A2-search" name="level" class="hidden peer input-search" value="A2"{{ 'A2' == Request::get('level') ? ' checked' : '' }}>
                            <label for="level-A2-search" class="radio-level">A2</label>
                        </div>
                        <div>
                            <input type="radio" id="level-B1-search" name="level" class="hidden peer input-search" value="B1"{{ 'B1' == Request::get('level') ? ' checked' : '' }}>
                            <label for="level-B1-search" class="radio-level">B1</label>
                        </div>
                        <div>
                            <input type="radio" id="level-B2-search" name="level" class="hidden peer input-search" value="B2"{{ 'B2' == Request::get('level') ? ' checked' : '' }}>
                            <label for="level-B2-search" class="radio-level">B2</label>
                        </div>
                        <div>
                            <input type="radio" id="level-C1-search" name="level" class="hidden peer input-search" value="C1"{{ 'C1' == Request::get('level') ? ' checked' : '' }}>
                            <label for="level-C1-search" class="radio-level">C1</label>
                        </div>
                        <div>
                            <input type="radio" id="level-C2-search" name="level" class="hidden peer input-search" value="C2"{{ 'C2' == Request::get('level') ? ' checked' : '' }}>
                            <label for="level-C2-search" class="radio-level">C2</label>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <x-primary-button type="submit" class="bg-green-500 shadow-md hover:bg-green-400 hover:scale-95 active:scale-90 active:ring-offset-0 focus:ring-offset-0 active:bg-green-400 focus:bg-green-400 focus:ring-transparent">検索</x-primary-button>
                </div>
            </form>
        </div>
        <div class="h-full p-4 mt-6 bg-rose-100 rounded-xl md:mt-0">
            <div class="flex w-full py-2 mb-5 text-lg border-b border-rose-400">
                <span class="mr-3"><i class="fa-solid fa-user" style="color: #fb7185;"></i></span>
                <h1>ユーザーを探す</h1>
            </div>
            <form action="{{ route('users.index') }}" method="GET">
                <div class="form-group">
                    <label for="user_name_keyword" class="block text-base">ユーザー名</label>
                    <input type="text" id="user_name_keyword" name="user_name_keyword" value="{{ Request::get('user_name_keyword') }}" placeholder="Search" class="form-input-search focus:ring-rose-300" autocomplete=”off”>
                </div>
                <div class="text-center">
                    <x-primary-button type="submit" class="shadow-md bg-rose-400 hover:bg-rose-300 hover:scale-95 active:scale-90 active:ring-offset-0 focus:ring-offset-0 active:bg-rose-300 focus:bg-rose-300 focus:ring-transparent">検索</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const radioBtns = document.querySelectorAll('.input-search');
    let prevRadio = null;
    radioBtns.forEach((radioBtn) =>
    {
        radioBtn.addEventListener('click', () =>
        {
            if (prevRadio === radioBtn && radioBtn.checked)
            {
                radioBtn.checked = false;
                prevRadio = null;
            } else
            {
                prevRadio = radioBtn;
            }
        });
    });
</script>
