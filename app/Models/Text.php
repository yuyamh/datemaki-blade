<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'text_name',
    ];

    public $timestamps = false;

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
