<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // storage/app/public/fileディレクトリと、その中身の全削除
        if (Storage::exists('public/files'))
        {
            Storage::deleteDirectory('public/files');
        }

        // アップロードされたプロフィール画像を全削除
        if (Storage::exists('public/profile_icons'))
        {
            Storage::deleteDirectory('public/profile_icons');
        }

        // TODO:ローカルと本番環境で、リフレッシュ時下記のディレクトリごと削除したい。（現状S3で削除できない）
        // public/files
        // public/profile_icons

        // テキストとゲストユーザーのseeding実行
        $this->call([
            GuestUserSeeder::class,
            TextSeeder::class,
        ]);

        //開発環境の時にのみ実行するseeding。
        if (App::environment('local'))
        {
            $this->call([DummyDataSeeder::class, //ダミーデータの作成
            ]);
        }
    }
}
