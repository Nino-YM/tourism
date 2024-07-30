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
            'id_role' => 'required|exists:roles,id_role'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'id_role' => $request->id_role
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'string|max:50',
            'email' => 'string|email|max:50|unique:users,email,' . $id,
            'password' => 'string|min:6',
            'id_role' => 'exists:roles,id_role'
        ]);

        $user = User::findOrFail($id);

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

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
