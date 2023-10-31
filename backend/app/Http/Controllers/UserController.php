<?php

namespace App\Http\Controllers\ofgc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $User = Users::all();
        return response()->json($User);
    }

    public function store(Request $request)
    {
        $User = new Users;
        $User->name = $request->name;
        $User->lastname = $request->lastname;
        $User->email = $request->email;
        $User->password = $request->password;
        $User->Icon = $request->Icon;
        $User->save();
        return response()->json([
            "message" => "User added"
        ],201);
    }

    public function show($id)
    {
        $User = Users::find($id);
        if(!empty($User))
        {
            return response()->json($User);
        }
        else
        {
            return response()->json([
                "messaje" => "User not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if(Users::where('id', $id)->exist()) {
            $User = Users::find($id);
            $User->name = is_null($request->name) ? $User->name : $request->name;
            
        }
    }
}
