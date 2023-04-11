<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 古いプロフ画像を取得
        $oldIconPath = $request->user()->profile_photo_path;
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email'))
        {
            $request->user()->email_verified_at = null;
        }

       $path = null;
       if ($request->hasFile('picture'))
       {
            if (app()->isLocal() || app()->runningUnitTests())
            {
                // 開発環境
                \Storage::disk('public')->delete($oldIconPath); // 古いプロフ画像を削除
                $path = $request->file('picture')->store('profile_icons', 'public');
                // $request->user()->profile_photo_path = \Storage::url($path);
                $request->user()->profile_photo_path = $path;
            } else
            {
                // 本番環境
                // TODO:ここにStorage::delete処理？
                $path = \Storage::disk('s3')->put('/profile_icons', $request->file('picture'), 'public');
                $request->user()->profile_photo_path = \Storage::disk('s3')->url($path);
            }
       }

    //    TODO:プロフ更新時に、古いプロフ画像を削除する処理を書く必要あり。

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // ユーザーが設定したプロフィールアイコン画像の削除
        if (\Storage::disk('public')->exists('profile_icons') && !is_null($user->profile_photo_path))
        {
            \Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
