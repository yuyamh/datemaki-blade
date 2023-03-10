<nav class="sticky top-0 z-50 flex w-full h-16 bg-gradient-to-r from-orange-300 via-yellow-400 to-orange-400">
    <div class="flex items-stretch w-full h-full">
        <div class="items-center hidden h-full md:mx-2 md:flex shrink-0">
            <a href="{{ route('posts.index') }}">
                <x-application-logo class="block w-auto text-gray-800 rounded-full fill-current h-9" />
            </a>
        </div>
        {{-- スマホ版レスポンシブメニュー --}}
        <div class="flex items-center flex-grow ml-1 md:hidden">
            <x-dropdown class="h-full md:hidden" align="left">
                <x-slot name="trigger" class="h-full">
                    <x-primary-button class="h-full m-3 text-base bg-transparent rounded-lg md:hidden focus:bg-transparent focus:ring-transparent active:bg-yellow-100 focus:text-yellow-800" style="margin:0px;padding:2px 8px;">
                        <span class="text-2xl md:hidden"><i class="fa-sharp fa-solid fa-bars"></i></span>
                    </x-primary-button>
                </x-slot>
                <x-slot name="content">
                @if (Auth::check())
                    <x-dropdown-link :href="route('posts.index')">みんなの教案</x-dropdown-link>
                    <x-dropdown-link :href="route('myposts.index')">じぶんの教案</x-dropdown-link>
                @else
                    <x-dropdown-link :href="route('login')">ログイン</x-dropdown-link>
                    <x-dropdown-link :href="route('register')">会員登録</x-dropdown-link>
                @endif
                </x-slot>
            </x-dropdown>
            <div class="flex items-center h-full m-1 md:mx-2 shrink-0">
                <a href="{{ route('posts.index') }}">
                    <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                </a>
            </div>
            <a href="{{ route('posts.index') }}" class="flex items-center py-2 pl-1 text-base font-bold leading-normal text-white drop-shadow-lg">だてまき</a>
            <div class="flex items-stretch justify-end h-full ml-auto">
                @if (Auth::check())
                    <a href="{{ route('posts.create') }}" class="flex flex-col items-center justify-center px-4 m-2 text-sm text-yellow-900 bg-yellow-200 border-2 border-yellow-800 rounded-xl hover:scale-95 active:scale-90">
                        <span><i class="fa-solid fa-pen"></i></span>
                        <span>投稿</span>
                    </a>
                    <x-dropdown contentClasses="p-1 bg-white mr-2">
                        <x-slot name="trigger">
                            <img src="{{ isset(Auth::user()->profile_photo_path) ? asset('storage/' . Auth::user()->profile_photo_path) : asset('images/user_icon.png') }}" class="w-12 h-12 m-2 bg-gray-200 rounded-full cursor-pointer active:scale-90 hover:scale-95" alt="photo">
                        </x-slot>
                        <x-slot name="content">
                            <p class="block p-2 mx-2 text-sm italic leading-5 text-left text-gray-700 border-b">{{ Auth::user()->name }}</p>
                            <x-dropdown-link :href="route('profile.edit')">設定</x-dropdown-link>
                            <x-dropdown-link :href="route('bookmarks')">ブックマーク一覧</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">ログアウト
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="#" class="flex items-center px-2 mx-2 my-1 text-xs text-yellow-900 bg-yellow-200 border-2 border-yellow-800 rounded-xl hover:scale-95 active:scale-90">
                        <span class="mr-1"><i class="fa-solid fa-user-check"></i></span>
                        <span>かんたんログイン</span>
                    </a>
                @endif
            </div>
        </div>

        {{-- PC版レスポンシブメニュー --}}
        <a href="{{ route('posts.index') }}" class="items-center hidden px-4 py-2 pl-1 text-xl font-bold leading-normal text-white md:flex drop-shadow-lg">だてまき</a>
        <div class="hidden md:items-stretch md:flex-grow md:flex">
            <div class="flex items-stretch justify-end pr-2 ml-auto">
                @if (Auth::check())
                <a href="{{ route('posts.index') }}" class="nav-items{{ Request::routeIs('posts.index') ? ' border-b-2 border-yellow-800' : ''}}">みんなの教案</a>
                <a href="{{ route('myposts.index') }}" class="nav-items{{ Request::routeIs('myposts.index') ? ' border-b-2 border-yellow-800' : ''}}">じぶんの教案</a>
                <a href="{{ route('posts.create') }}" class="flex items-center px-2 m-2 text-sm text-yellow-900 bg-yellow-200 border-2 border-yellow-800 rounded-xl hover:scale-95 active:scale-90">
                    <span class="mr-2"><i class="fa-solid fa-pen"></i></span>
                    <span>投稿する</span>
                </a>
                <x-dropdown contentClasses="py-1 bg-white mr-2">
                    <x-slot name="trigger">
                            <img src="{{ isset(Auth::user()->profile_photo_path) ? asset('storage/' . Auth::user()->profile_photo_path) : asset('images/user_icon.png') }}" class="w-12 h-12 m-2 bg-gray-200 rounded-full cursor-pointer active:scale-90 hover:scale-95" alt="photo">
                    </x-slot>
                    <x-slot name="content">
                        <p class="block p-2 mx-2 text-sm italic leading-5 text-left text-gray-700 border-b">{{ Auth::user()->name }}</p>
                        <x-dropdown-link :href="route('profile.edit')">設定</x-dropdown-link>
                        <x-dropdown-link :href="route('bookmarks')">ブックマーク一覧</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">ログアウト
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <a href="{{ route('login') }}" class="nav-items">ログイン</a>
                <a href="{{ route('register') }}" class="nav-items">会員登録</a>
                <a href="#" class="flex items-center px-2 mx-2 my-1 text-sm text-yellow-900 bg-yellow-200 border-2 border-yellow-800 rounded-xl hover:scale-95 active:scale-90">
                    <span class="mr-2"><i class="fa-solid fa-user-check"></i></span>
                    <span>かんたんログイン</span>
                </a>
                @endif
            </div>
        </div>
    </div>
</nav>
