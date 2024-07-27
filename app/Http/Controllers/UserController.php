<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        try {
            $users = User::orderBy('created_at','DESC')->paginate(10);
            return view('pages.users.users',compact(
                'users'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }


    public function create(){
        try {
            $user = new User();
            return view('pages.users.create', compact('user'));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }


    public function store(Request $request){
        $rules = [
            'first_name' => ['required'],
            'last_name' => ['nullable'],
            'email' => ['required','unique:users'],
            'address' => ['required'],
            'phone_number' => ['required','numeric'],
            'password' => ['required'],
        ];
        
        try {
            
            $validatedData = $request->validate($rules);
            $validatedData['password'] = bcrypt($request->input('password'));
    
            $user = User::create($validatedData);

            $user->givePermissionTo('detail.tasks');
            $user->assignRole('user');
    
            return redirect()->route('users')->with('success', 'Data Berhasil ditambahkan');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function edit(User $user){
        try {
            return view('pages.users.edit', compact('user'));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function update(Request $request, User $user )
    {
        $validatedData = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['nullable'],
            'email' => ['required', 'email', 'max:250', 'unique:users,email,'.$user->id],
            'address' => ['required'],
            'phone_number' => ['required','numeric'],
            'password' => ['required'],
        ]);
        try {
    
            if ($request->filled('password')) {
                $validatedData['password'] = bcrypt($request->input('password'));
            } else {
                unset($validatedData['password']);
            }
    
            $user->update($validatedData);
    
            return redirect()->route('users')->with('success', 'Data Berhasil di Edit');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function destroy(User $user){

        try {
            $user->delete();
    
            return back()->with('success-danger', 'Data berhasil dihapus');
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }

    }

    public function softDelete(){
        try {
            $users = User::onlyTrashed()->orderBy('created_at','DESC')->paginate(10);
            return view('pages.users.softdelets',compact(
                'users'
            ));
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function restoreData($id){
        try {
            User::withTrashed()->find($id)->restore();
            return redirect()->route('softDeletes.users')->with('success', "Data Recovered Successfully");
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

    public function forcedelete($id)
    {
        try {
            User::onlyTrashed()->find($id)->forceDelete();
            return redirect()->route('softDeletes.users')->with('success-danger', "Data Successfully Deleted Permanently");
        } catch (\Exception $th) {
            return back()->with('success-danger', 'Ada yang Error'. $th->getMessage());
        }
    }

}
