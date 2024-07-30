<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:50',
        ]);

        $role = Role::create([
            'role_name' => $request->role_name,
        ]);

        return response()->json($role, 201);
    }

    public function show($id)
    {
        return Role::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'string|max:50',
        ]);

        $role = Role::findOrFail($id);

        if ($request->has('role_name')) {
            $role->role_name = $request->role_name;
        }

        $role->save();

        return response()->json($role, 200);
    }

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
