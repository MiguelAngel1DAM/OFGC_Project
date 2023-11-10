<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
// GET
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

// POST

public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users',
        'password' => 'required|min:4',
        'name' => 'nullable',
        'lastname' => 'nullable',
        'Icon' => 'nullable',
    ]);

    $user = new User();
    $user->name = $request->input('name');
    $user->lastname = $request->input('lastname');
    $user->email = $request->input('email');
    $user->Icon = $request->input('Icon');
    $user->password = bcrypt($request->input('password'));
    $user->save();
    return response()->json(['message' => 'User registered successfully'], 201);
}

    // GET by id
    public function show($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            return response()->json($user);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    // PUT
    public function update(Request $request, $id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->name = is_null($request->name) ? $user->name : $request->name;
            $user->lastname = is_null($request->lastname) ? $user->lastname : $request->lastname;
            $user->email = is_null($request->email) ? $user->email : $request->email;
            $user->password = is_null($request->password) ? $user->password : $request->password;
            $user->Icon = is_null($request->Icon) ? $user->Icon : $request->Icon;

            $user->save();
            return response()->json([
                "message" => "User updated"
            ], 404);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }

    // DELETE
    public function destroy($id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->delete();

            return response()->json([
                "message" => "User deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "User not found"
            ], 404);
        }
    }
}
