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

    public function updateprofile(Request $request, $id){

        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:250'],
            'last_name' => ['nullable'],
            'email' => ['required', 'email', 'max:250', 'unique:users,email,'.$id],
            'phone_number' => ['required','numeric'],
            'address' => ['required'],
        ]);

        $user = User::find($id);
        $user->update($validatedData);
        return back()->with('success', 'Data Profile Berhasil di update');
    }
}
