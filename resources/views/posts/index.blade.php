<x-app-layout>
    <x-slot name="header">みんなの教案一覧</x-slot>
    <x-slot name="title">みんなの教案</x-slot>
    <x-index-table :posts="$posts" message="教案がまだ投稿されていません。"/>
</x-app-layout>
