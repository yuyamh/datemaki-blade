<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->create();
        // 元々こっちで削除処理を書いていたが、このファイルはローカルのみで実行されるため、DatabaseSeederへ移動させた。
        // storage/app/public/fileディレクトリと、その中身の全削除
        // if (Storage::disk('public')->exists('files')) {
        //     Storage::deleteDirectory('public/files');
        // }

        // // アップロードされたプロフィール画像を全削除
        // if (Storage::disk('public')->exists('profile_icons')) {
        //     Storage::deleteDirectory('public/profile_icons');
        // }

        Post::factory()->count(240)->create();
    }
}
