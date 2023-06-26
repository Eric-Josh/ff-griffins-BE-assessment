<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::paginate(15));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required','string'],
            'email'     => ['required','string','email','max:50','unique:users,email'],
            'password'  => [
                'required','max:30', 'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ]);

        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'email_verified_at' => now()
        ])->assignRole($data['role']);

        return response([
            'message' => 'Please verify your account. A verification link has been sent to your email',
            'user' => $user,
            'token' => $token,
            'permissions' => '',
            'status_code' => 201,
        ], 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();

        if(!isset($data['password'])) {
            $request->validate([
                'email' => ['required','email','string'],
            ]);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email']
            ]);
        }else {
            $request->validate([
                'email' => ['required','email','string'],
                'password' => [
                    'required', 'confirmed',
                    Password::min(8)->mixedCase()->numbers()->symbols()
                ]
            ]);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        }

        return response([
            'message' => 'User updated.'
        ], 201);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response([
            'message' => 'User Deleted!'
        ]);
    }
}
