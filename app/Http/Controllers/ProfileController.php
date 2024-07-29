<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
         $data = User::where('id', auth()->id())->first();
        return view('pages.profiles.profile', compact('data'));
    }

    public function updateprofile(Request $request, User $user){

        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:250'],
            'last_name' => ['nullable'],
            'email' => ['required', 'email', 'max:250', 'unique:users,email,'.$user->id],
            'phone_number' => ['required','numeric'],
            'address' => ['required'],
        ]);

        $user->update($validatedData);
        return back()->with('success', 'Data Profile Berhasil di update');
    }

    public function uploadImage(Request $request, User $user){

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif,webp|max:2048',
        ]);

        if ($user->hasMedia('images/profiles')) {
            // Remove the old media
            $user->clearMediaCollection('images/profiles');
        }
        // Add the new media
        $user->addMedia($request->image)->toMediaCollection('images/profiles');

        return back()->with('success', 'Upload Images Successfully');
    }
}
