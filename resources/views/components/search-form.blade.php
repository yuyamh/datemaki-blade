
<h1>教案検索</h1>
<form action="{{ route('posts.index') }}" method="GET">
    @csrf
    <div class="form-group">
        <label for="keyword" class="block text-lg">キーワード</label>
        <input type="text" id="keyword" name="keyword" value="{{ $keyword }}" placeholder="Search" class="form-input">
    </div>
    <input type="submit" value="検索">
</form>
