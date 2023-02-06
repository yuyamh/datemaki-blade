<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Text;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(20);
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
        $post->text_id = $validated['text_id'];
        $post->save();

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $filePath = Storage::url('files/' . $post->file_name);
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
        return view('posts.edit', ['post' => $post, 'texts' => $texts]);
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

        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->level = $validated['level'];
        $post->file_name = $validated['file_name'];
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
        $this->authorize($post);
        $post->delete();
        // アップロードされたファイルの削除
        if (isset($post->file_name)) {
            \Storage::disk('public')->delete($post->file_name);
        }
        return redirect(route('posts.index'))->with('successMessage', '教案を削除しました。');
    }
}
