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
        // storage/app/public/fileディレクトリと、その中身の全削除
        if (Storage::disk('public')->exists('files')) {
            Storage::deleteDirectory('public/files');
        }
        Post::factory()->count(240)->create();
    }
}
