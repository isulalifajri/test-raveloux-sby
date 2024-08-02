<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('roles', 'permissions')->orderBy('created_at','DESC')->paginate(10);

        return view('pages.userManagements.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::where('id',$id)->with('roles', 'permissions')->first();

        $allPermissions = Permission::all();

        return view('pages.userManagements.edit', compact('user','allPermissions'));
    }

    public function update(Request $request, User $user)
    {
        if ($request->has('permission')) {
            // Hapus semua izin pengguna saat ini dan tetapkan izin baru
            $user->syncPermissions($request->permission);
        }

        return redirect()->route('managementUsers')->with('success', 'Permission Users Berhasil di Update');
    }
}
