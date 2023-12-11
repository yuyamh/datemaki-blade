<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ユーザー検索
        // 検索フォームに入力された値を取得
        $keyword = $request->user_name_keyword;

        // roleカラムに'user'の値を持つユーザーのみを取得する
        $query = User::where('role', 'user')->latest();

        // キーワードで検索をしたときだけ実行
        if ($keyword)
        {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        $users = $query->paginate(15);
        $data = ['users' => $users];

        return view('users.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ユーザーが投稿した教案一覧を表示する。
        $user = User::findOrFail($id);
        $posts = $user->posts()->latest()->paginate(15);
        $user_name = $user->name;
        $data = ['posts' => $posts, 'user_name' => $user_name];

        return view('users.show', $data);
    }

    // 全ユーザ情報のCSVエクスポート
    public function exportCsv()
    {
        $callback = function ()
        {
            $stream = fopen('php://output', 'w');
            $head = [
                'ID',
                '名前',
                'メールアドレス',
                '権限',
                '投稿件数',
                '会員登録日時',
            ];

            mb_convert_variables('SJIS', 'UTF-8', $head);
            fputcsv($stream, $head);


            $users = User::with('posts')->orderBy('id');

            foreach ($users->cursor() as $user)
            {
                $data = [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->role,
                    count($user->posts),
                    $user->created_at,
                ];
                mb_convert_variables('SJIS', 'UTF-8', $data);
                fputcsv($stream, $data);
            }
            fclose($stream);
        };

        $fileName = Carbon::now()->format('YmdHis') . '_userList.csv';

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment;'

        ];

        return response()->streamDownload($callback, $fileName, $headers);
    }
}
