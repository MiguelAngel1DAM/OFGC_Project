<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the correct User model namespace

class UserController extends Controller
{
    // GET
    public function index()
    {
        $users = User::all(); // Change to User::all()
        return response()->json($users);
    }

    // POST
    public function store(Request $request)
    {
        $user = new User; // Change to User
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->Icon = $request->Icon;
        $user->save();
        return response()->json([
            "message" => "User added"
        ], 201);
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
