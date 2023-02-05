<nav class="flex w-full bg-orange-300"">
    <div class="flex items-stretch h-16">
    <div class="flex items-center mx-2 shrink-0">
        <a href="{{ route('posts.index') }}">
            <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
        </a>
    </div>

    {{-- レスポンシブメニュー
    <x-dropdown class="lg:hidden">
        <x-slot name="trigger">
            <x-primary-button><i class="fa-regular fa-bars"></i></x-primary-button>
        </x-slot>
        <x-slot name="content">
            
        </x-slot>
    </x-dropdown> --}}

    <a href="#" class="flex items-center px-4 py-2 text-xl font-bold leading-normal text-white">だてまき</a>
    </div>
    <div class="flex items-stretch flex-grow">
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
                        <x-primary-button class="m-3 text-base bg-transparent rounded-lg hover:bg-yellow-200 hover:text-yellow-800 focus:bg-yellow-200 focus:ring-yellow-800 active:bg-yellow-100 focus:text-yellow-800">
                            <span ><i class="fa-solid fa-user"></i></span>
                        </x-primary-button>
                    </x-slot>
                    <x-slot name="content">
                        <p class="block p-2 mx-2 text-sm italic leading-5 text-left text-gray-700 border-b">{{ Auth::user()->name }}</p>
                        <x-dropdown-link :href="route('profile.edit')">
                            <p>設定</p>
                        </x-dropdown-link>
                        <x-dropdown-link>
                            <p>ブックマーク一覧</p>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <p>ログアウト</p>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @else
                <a href="{{ route('login') }}" class="nav-items">ログイン</a>
                <a href="{{ route('register') }}" class="nav-items">会員登録</a>
                <x-primary-button onclick="location.href='#'" class="m-3 bg-transparent border-yellow-800 rounded-lg hover:bg-yellow-200 hover:text-yellow-800 focus:bg-yellow-200 focus:ring-yellow-800 active:bg-yellow-100 focus:text-yellow-800">
                    <span class="mr-1"><i class="fa-solid fa-user-check"></i></span>
                    <span>かんたんログイン</span>
                </x-primary-button>
            @endif
        </div>
    </div>
</nav>
