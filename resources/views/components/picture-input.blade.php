<div class="flex mb-4">
    <div class="mr-3">
        {{-- ゲストユーザーの場合は、指定した画像をプロフ画像として表示する。 --}}
        @if (Auth::check() && $user->role === 'guest')
            <img src="{{ asset('images/guest_user_icon.png') }}" class="object-cover w-16 h-16 bg-gray-200 border-none rounded-full md:h-32 md:w-32" alt="photo">
        @else
            <img
                id="preview"
                src="{{ isset(Auth::user()->profile_image) ? Auth::user()->image_url : asset('images/user_icon.png') }}"
                class="object-cover w-16 h-16 bg-gray-200 border-none rounded-full md:h-32 md:w-32">
        @endif
    </div>
    <div class="flex items-center">
        {{-- ゲストユーザーの場合は、プロフ画像を変更できない --}}
        @can ('update', $user)
        <button
            {{-- x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'modal-upload-profile-icon')" --}}
            id="isNotDesktop"
            type="button"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 uppercase bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-100 active:outline-none active:ring-2 active:ring-orange-400 active:ring-offset-2 active:text-gray-500 active:bg-gray-50 focus:ring-orange-400">
            アイコンを設定
        </button>
        <x-modal name="modal-upload-profile-icon">
            <x-modal-upload-profile-icon />
        </x-modal>
        @else
        <div class="flex flex-col items-start">
            <button disabled
                    type="button"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 uppercase bg-gray-300 border border-gray-400 rounded-md shadow-sm opacity-50">
                アイコンを設定
            </button>
            <p class="mt-1 text-xs text-red-500">※変更不可</p>
        </div>
        @endcan
        <input type="file" name="image" id="iconInput" class="hidden">
    </div>
</div>
<script src="{{ asset('js/profile_icon.js') }}"></script>
