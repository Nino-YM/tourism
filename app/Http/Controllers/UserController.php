<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'id_role' => 2, // Default role id for regular users
        ]);

        return response()->json($user, 201);
    }

    public function show($id_user)
    {
        return User::findOrFail($id_user);
    }

    public function update(Request $request, $id_user)
    {
        $request->validate([
            'username' => 'string|max:50',
            'email' => 'string|email|max:50|unique:users,email,' . $id_user . ',id_user',
            'password' => 'string|min:6',
            'id_role' => 'exists:roles,id_role'
        ]);

        $user = User::findOrFail($id_user);

        if ($request->has('username')) {
            $user->username = $request->username;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        if ($request->has('id_role')) {
            $user->id_role = $request->id_role;
        }

        $user->save();

        return response()->json($user, 200);
    }

    public function destroy($id_user)
    {
        User::findOrFail($id_user)->delete();

        return response()->json(null, 204);
    }
}
