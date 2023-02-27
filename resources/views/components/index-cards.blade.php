@if ($posts->isEmpty())
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <p>{{ $message }}</p>
            </div>
        </div>
    </div>
</div>
@else
<div class="grid grid-cols-1 gap-6 py-10 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($posts as $post)
    <div class="flex flex-col items-start justify-center w-full p-3 bg-white rounded-lg cursor-pointer sahdow-l card hover:scale-95 hover:bg-yellow-50" data-href="{{ route('posts.show', $post) }}">
        <div class="flex justify-start w-full mb-4">
            <img class="w-12 h-12 bg-gray-200 rounded-full" src="{{ isset($post->user->profile_photo_path) ? asset('storage/' . $post->user->profile_photo_path) : asset('images/user_icon.png') }}" alt="photo">
            <div class="ml-2 truncate">
                <p class="text-sm text-gray-500 truncate">{{ $post->user->name }}</p>
                <p class="mb-2 text-xl font-bold text-gray-600 truncate">{{ $post->title }}</p>
                <p class="text-sm text-gray-600">
                    @if(isset($post->text->text_name))
                    <span>{{ $post->text->text_name }}&nbsp;/&nbsp;</span>
                    @else
                    <span>-&nbsp;/&nbsp;</span>
                    @endif
                    <span>{{ $post->level }}&nbsp;</span>
                </p>
            </div>
        </div>
        <p class="h-16 m-3 mt-0 text-base font-normal leading-snug text-gray-500 line-clamp-3">{{ $post->description }}</p>
        <p class="ml-auto text-xs font-light text-gray-400">{{ $post->updated_at->format('Y/m/d') }}</p>
    </div>
    @endforeach
</div>
{{-- TODO:ページネーションの指定をあとで変更する --}}
<div class="m-4">{{ $posts->appends(request()->input())->onEachSide(1)->links() }}</div>
<script>
const cards = document.querySelectorAll('.card');

cards.forEach(card => {
  card.addEventListener('click', () => {
    const url = card.dataset.href;
    window.location.href = url;
  });
});
</script>
@endif
