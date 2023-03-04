<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Text;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 検索フォームに入力された値を取得
        $keyword = $request->keyword;
        $text_id = $request->text_id;
        $level = $request->level;

        $query = Post::latest();

        // キーワードで検索をしたときだけ実行
        if ($keyword)
        {
            $word = '%' . $keyword . '%';
            $query->where(function ($q) use ($word)
            {
                $q->where('title', 'like', $word);
                $q->orWhere('description', 'like', $word);
            $q->orWhereHas('user', function ($u) use ($word)
                {
                    $u->where('name', 'like', $word);
                });
            });
        }

        // 使用テキストの検索があったとき実行
        if ($text_id)
        {
            $query->where('text_id', $text_id);
        }

        // レベルの検索があったとき実行
        if ($level)
        {
            $query->where('level', $level);
        }

        $posts = $query->paginate(15);
        $data = ['posts' => $posts];

        return view('posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $texts = Text::all();
        return view('posts.create', ['post' => $post, 'texts' => $texts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        // ファイルの保存
        $file = $validated['file_name'];
        $ext  = $file->getClientOriginalextension();
        $fileName = time() . '.' . $ext;
        $file->storeAs('public/files', $fileName);


        $post = new Post();
        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->level = $validated['level'];
        $post->user_id = \Auth::id();
        $post->file_name = $fileName;
        $post->file_mimetype = $file->getMimeType();
        $post->file_size = $file->getSize();
        $post->text_id = $validated['text_id'];
        $post->save();

        return redirect(route('myposts.index'))->with('successMessage', '教案を投稿しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // アップロードファイルのパスを取得
        $filePath = Storage::url('files/' . $post->file_name);

        // アップロードファイルのサイズをKB, MBへ変換
        $kilobyte = 1024;
        $megabyte = $kilobyte * 1000;

        if ($megabyte <= $post->file_size)
        {
            $post->file_size = round($post->file_size / $megabyte, 2) . 'MB';
        } elseif ($kilobyte <= $post->file_size)
        {
            $post->file_size = round($post->file_size / $kilobyte, 2) . 'KB';
        } else
        {
            $post->file_size = $post->file_size . 'B';
        }

        return view('posts.show', ['post' => $post, 'filePath' => $filePath]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize($post);
        $texts = Text::all();

        // アップロードファイルのパスを取得
        $filePath = Storage::url('files/' . $post->file_name);

        return view('posts.edit', ['post' => $post, 'texts' => $texts, 'filePath' => $filePath]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\StorePostRequest $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize($post);
        $validated = $request->validated();

        // ファイルの差し替えを行う
        if (isset($validated['file_name']))
        {
            // 元ファイルの削除
            \Storage::disk('public')->delete('files/' . $post->file_name);

            // 新ファイルの保存
            $file = $validated['file_name'];
            $ext  = $file->getClientOriginalextension();
            $fileName = time() . '.' . $ext;
            $file->storeAs('public/files', $fileName);

            // 新ファイルのデータをpostsテーブルの各カラムに保存
            $post->file_name = $fileName;
            $post->file_mimetype = $file->getMimeType();
            $post->file_size = $file->getSize();
        }

        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->level = $validated['level'];
        $post->text_id = $validated['text_id'];
        $post->save();

        return redirect(route('posts.show', $post))->with('successMessage', '教案を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        dd($post->user->profile_photo_path);
        $this->authorize($post);
        $post->delete();
        // アップロードされたファイルの削除
        \Storage::disk('public')->delete('files/' . $post->file_name);

        return redirect(route('myposts.index'))->with('successMessage', '教案を削除しました。');

    }

    /**
     * Display a listing of the resource.
     *
     * ブックマークした教案を表示する
     * @return \Illuminate\Http\Response
     */
    public function bookmark_posts()
    {
        $posts = \Auth::user()->bookmark_posts()->latest()->paginate(20);
        $data = ['posts' => $posts];

        return view('posts.bookmarks', $data);
    }
}
