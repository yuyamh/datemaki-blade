<?php

namespace App\Http\View;

use App\Models\Text;
use Illuminate\View\View;

class TextComposer
{
    protected $texts;

    public function __construct()
    {
        $this->texts = Text::all();
    }

    // TODO:postsもView Composerで渡す必要あり
    // app.blade.phpでgridレイアウト（検索の方の背景色ちょっと変える）

    public function compose(View $view)
    {
        $view->with('texts', $this->texts);
    }
}
