<x-app-layout>
    <x-slot name="header">みんなの教案一覧</x-slot>
    <x-slot name="title">みんなの教案</x-slot>
    <div class="grid grid-cols-12">
        <div class="col-span-9">
            <x-index-cards :posts="$posts" message="教案がまだ投稿されていません。"/>
        </div>
        <div class="col-span-3">
            <x-search-form :keyword="$keyword" :post="$posts" :/>
        </div>
    </div>
</x-app-layout>
