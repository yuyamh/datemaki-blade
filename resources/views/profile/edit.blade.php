<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <x-slot name="title">{{ __('Profile') }}</x-slot>


    <div class="py-4 mt-8 mb-12 text-2xl font-bold bg-white rounded-md border-x-8 border-x-orange-500">
        <h1 class="ml-2">アカウント情報</h1>
    </div>
    <div>
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            {{-- ゲストユーザーの場合は、アイコン、名前、メールアドレスを変更できない --}}
            {{-- ゲストユーザーの場合は下記を表示する --}}
            @cannot ('update', $user)
            <div class="p-4 bg-red-100 shadow sm:p-8 sm:rounded-lg">
                <p class="text-red-600">※ゲストユーザーは、ユーザー情報を変更・削除できません。</p>
            </div>
            @endcannot
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
