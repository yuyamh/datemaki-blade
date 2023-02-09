<nav class="sticky top-0 z-40 flex w-full h-16 bg-gradient-to-r from-orange-300 via-yellow-400 to-orange-400">
    <div class="flex items-stretch w-full h-full">
        <div class="flex items-center h-full mx-2 shrink-0">
            <a href="{{ route('posts.index') }}">
                <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
            </a>
        </div>
        {{-- レスポンシブメニュー --}}
        <div class="flex items-center flex-grow md:hidden">
            <x-dropdown class="h-full md:hidden" align="left">
                <x-slot name="trigger" class="h-full">
                    <x-primary-button class="h-full m-3 text-base bg-transparent rounded-lg md:hidden focus:bg-transparent focus:ring-transparent active:bg-yellow-100 focus:text-yellow-800" style="margin: 0px;">
                        <span class="text-2xl md:hidden"><i class="fa-sharp fa-solid fa-bars"></i></span>
                    </x-primary-button>
                </x-slot>
                <x-slot name="content">
                @if (Auth::check())
                    <x-dropdown-link :href="route('posts.index')">みんなの教案</x-dropdown-link>
                    <x-dropdown-link>じぶんの教案</x-dropdown-link>
                @else
                    <x-dropdown-link :href="route('login')">ログイン</x-dropdown-link>
                    <x-dropdown-link :href="route('register')">会員登録</x-dropdown-link>
                @endif
                </x-slot>
            </x-dropdown>
            <a href="#" class="flex items-center py-2 pl-1 text-base font-bold leading-normal text-white">だてまき</a>
            <div class="flex items-stretch justify-end h-full ml-auto">
                @if (Auth::check())
                    <x-primary-button onclick="location.href='{{ route('posts.create') }}'" class="flex flex-col justify-center px-1 mx-1 my-2 bg-transparent border-yellow-800 rounded-lg hover:bg-yellow-200 hover:text-yellow-800 focus:bg-yellow-200 focus:ring-yellow-800 active:bg-yellow-100 focus:text-yellow-800">
                        <i class="my-1 fa-solid fa-pen"></i>
                        <div class="mx-2">投稿</div>
                    </x-primary-button>
                    <x-dropdown contentClasses="p-1 bg-white mr-2">
                        <x-slot name="trigger">
                            <x-primary-button class="m-2 text-lg bg-transparent rounded-lg hover:text-yellow-800 focus:bg-yellow-200 focus:ring-yellow-800 active:bg-yellow-100 focus:text-yellow-800 hover:bg-yellow-200">
                                <span><i class="fa-solid fa-user"></i></span>
                            </x-primary-button>
                        </x-slot>
                        <x-slot name="content">
                            <p class="block p-2 mx-2 text-sm italic leading-5 text-left text-gray-700 border-b">{{ Auth::user()->name }}</p>
                            <x-dropdown-link :href="route('profile.edit')">設定</x-dropdown-link>
                            <x-dropdown-link>ブックマーク一覧</x-dropdown-link>
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
                    <x-primary-button onclick="location.href='#'" class="px-2 m-2 bg-transparent border-yellow-800 rounded-lg hover:bg-yellow-200 hover:text-yellow-800 focus:bg-yellow-200 focus:ring-yellow-800 active:bg-yellow-100 focus:text-yellow-800">
                        <span class="mr-1"><i class="fa-solid fa-user-check"></i></span>
                        <span>かんたんログイン</span>
                    </x-primary-button>
                @endif
            </div>
        </div>

        <a href="#" class="items-center hidden px-4 py-2 pl-1 text-xl font-bold leading-normal text-white md:flex">だてまき</a>
        <div class="hidden md:items-stretch md:flex-grow md:flex">
            <div class="flex items-stretch justify-end ml-auto">
                @if (Auth::check())
                <a href="{{ route('posts.index') }}" class="nav-items{{ Request::routeIs('posts.index') ? ' border-b-2 border-yellow-800' : ''}}">みんなの教案</a>
                <a href="#" class="nav-items">じぶんの教案</a>
                <x-primary-button onclick="location.href='{{ route('posts.create') }}'" class="m-3 bg-transparent border-yellow-800 rounded-lg hover:bg-yellow-200 hover:text-yellow-800 focus:bg-yellow-200 focus:ring-yellow-800 active:bg-yellow-100 focus:text-yellow-800">
                    <span class="mr-2"><i class="fa-solid fa-pen"></i></span>
                    <span>投稿する</span>
                </x-primary-button>
                <x-dropdown contentClasses="py-1 bg-white mr-2">
                    <x-slot name="trigger">
                        <x-primary-button class="m-3 text-base bg-transparent rounded-lg hover:text-yellow-800 focus:bg-yellow-200 focus:ring-yellow-800 active:bg-yellow-100 focus:text-yellow-800 hover:bg-yellow-200">
                            <span><i class="fa-solid fa-user"></i></span>
                        </x-primary-button>
                    </x-slot>
                    <x-slot name="content">
                        <p class="block p-2 mx-2 text-sm italic leading-5 text-left text-gray-700 border-b">{{ Auth::user()->name }}</p>
                        <x-dropdown-link :href="route('profile.edit')">設定</x-dropdown-link>
                        <x-dropdown-link>ブックマーク一覧</x-dropdown-link>
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
                <x-primary-button onclick="location.href='#'" class="m-2 bg-transparent border-yellow-800 rounded-lg hover:bg-yellow-200 hover:text-yellow-800 focus:bg-yellow-200 focus:ring-yellow-800 active:bg-yellow-100 focus:text-yellow-800">
                    <span class="mr-1"><i class="fa-solid fa-user-check"></i></span>
                    <span>かんたんログイン</span>
                </x-primary-button>
                @endif
            </div>
        </div>
    </div>
</nav>
