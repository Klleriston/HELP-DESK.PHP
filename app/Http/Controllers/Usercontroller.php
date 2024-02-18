<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;


class Usercontroller extends Controller
{
    public function gealltUsers(Request $request)
    {
        try {
            $users = User::all();
            return response()->json($users);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function getUserById(Request $request)
    {
        try {
            $user = User::where("id", $request->id)->first();
            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:4",
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'Sucess !', 'user' => $user], 201);

    }

    public function updateUser(Request $request)
    {
        try {
            $user = User::where('id', $request->id)->first();

            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                "email" => "required|string|email|max:255|unique:users" . $user->id,
                "password" => "required|string|min:4",
            ]);

            $user->update($request->only(['name', 'email', 'password']));

            return response()->json(['message' => 'User updated sucessfully !', 'user' => $user]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            $user = User::where('id', $request->id)->first();

            $user->delete();

            return response()->json(['message' => 'User deleted sucessfully !']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
