<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
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
        $request->user()->fill($request->validated());
        $profile_image_path = null;

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($delete_profile_image = $request->user()->profile_image_path){
            Storage::disk('public')->delete($delete_profile_image);
        }
        
        if ($request->hasFile('profile_image_path')){
            $profile_image_path = $request->file('profile_image_path')->store('profile_image_path','public');
            $request->user()->profile_image_path = $profile_image_path;
        }
        
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        $folders = $user->folders;//リレーションシップの結果の取得→今回はテーブル自体の取得の為こちらを採用
        //$folders = $user->folders();//リレーションシップのメソッドの取得→返されるのがクエリ形式のビルダー型、クエリの操作に使う。
        foreach($folders as $folder){
            $folder->tasks()->delete();
        }
        $user->folders()->delete();

        if ($delete_profile_image = $request->user()->profile_image_path){
            Storage::disk('public')->delete($delete_profile_image);
        }

        $user->chats()->delete();
        $user->chatRecipients()->delete();
        
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
