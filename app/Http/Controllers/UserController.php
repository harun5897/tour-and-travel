<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getDataUser() {
        $users = User::select('id', 'name', 'email', 'role', 'created_at', 'updated_at')->get();
        return view('user', [
            'users' => $users ?? collect([])
        ]);
    }
    public function getDetailDataUser($id) {
        $user = User::findOrFail($id);
        return view('form.update-user', compact('user'));
    }
    public function createUser(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:50',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:admin,super_admin,customer',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/user')->with('success', 'User created successfully.');
    }
    public function updateUser(Request $request, $id) {
        $request->validate([
            'name'     => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'     => 'required|in:admin,super_admin,customer',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('/user')->with('success', 'User updated successfully.');
    }
    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/user')->with('success', 'User deleted successfully.');
    }
}
